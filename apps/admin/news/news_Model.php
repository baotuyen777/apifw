<?php

class News_Model extends Model {

    function __construct() {
        parent::__construct();
    }

    /**
     * Thuc hien query CSDL de lay danh sach user
     */
    public function qry_all_news_admin($page, $display) {
       //  $this->db->debug = 1;
        $v_search = isset($_GET['search']) ? $_GET['search'] : "" ;
        $row = $this->db->getOne('SELECT COUNT(*)
                                  FROM t_cms_person AS P
                                    INNER JOIN t_cms_news AS N
                                      ON P.pk_person = N.fk_person Where N.C_TITLE like ?',array("%$v_search%"));
        $sotrang = ceil($row / $display);
        $start=0;
        if ($page <= $sotrang && $page > 0) {
            $start = $page * $display - $display;
        }
        if (isset($_GET['search'])) {//nếếu trên url tồn tại biến search
            
            $sql = "select * from t_cms_person as P 
                INNER JOIN t_cms_news as N 
                    ON P.pk_person=N.fk_person 
                INNER JOIN t_cms_type T
                    ON T.PK_TYPE=N.FK_TYPE";
            $sql .= " Where N.C_TITLE like ? ORDER BY N.PK_NEWS LIMIT ?,?";
            $recordSet = $this->db->GetAll($sql, array("%$v_search%", $start, $display));
        } else {// liệt kê danh sách tin bài, hiển thị theo thứ tự mới nhất
            $sql = "select * from t_cms_person as P 
                INNER JOIN t_cms_news as N 
                ON P.pk_person=N.fk_person
                INNER JOIN t_cms_type T
                ON T.PK_TYPE=N.FK_TYPE";
            $sql .= " ORDER BY N.PK_NEWS DESC LIMIT ?,?";
            $recordSet = $this->db->GetAll($sql, array($start,$display));
        }

        $pager = array("recordSet" => $recordSet, "sotrang" => $sotrang);
        return $pager;
    }

    public function qry_all_news_reporter($page, $display, $email) {
        $v_search = isset($_GET['search']) ? $_GET['search'] : "" ;
        $row = $this->db->getOne('SELECT COUNT(*)
                                  FROM t_cms_person AS P
                                    INNER JOIN t_cms_news AS N
                                      ON P.pk_person = N.fk_person 
                                      Where P.C_EMAIL=? And  N.C_TITLE like ? ',array($email,"%$v_search%"));
        $sotrang = ceil($row / $display);
        $start=0;
        if ($page <= $sotrang && $page > 0) {
            $start = $page * $display - $display;
        }
        if (isset($_GET['search'])) {
            //$this->db->debug=1;
            $sql = "select * from t_cms_person as P 
                INNER JOIN t_cms_news as N 
                    ON P.pk_person=N.fk_person 
                INNER JOIN t_cms_type T
                    ON T.PK_TYPE=N.FK_TYPE";
            $sql .= " Where P.C_EMAIL=? And N.C_TITLE like ? ORDER BY N.PK_NEWS DESC LIMIT ?,?";
            $recordSet = $this->db->GetAll($sql, array($email,"%$v_search%", $start, $display));
        } else {
            $sql = "select * from t_cms_person as P 
                INNER JOIN t_cms_news as N 
                ON P.pk_person=N.fk_person
                INNER JOIN t_cms_type T
                ON T.PK_TYPE=N.FK_TYPE Where P.C_EMAIL=?";
            $sql .= " ORDER BY N.PK_NEWS DESC LIMIT ?,?";
            $recordSet = $this->db->GetAll($sql, array($email,$start,$display));
        }

        $pager = array("recordSet" => $recordSet, "sotrang" => $sotrang);
        return $pager;
    }

    /**
     * Thuc hien query CSDL de lay thong tin chi tiet cua mot user
     */
    public function qry_single_news($id = "") {
        if ($id != "") {
           // $this->db->debug=10;
            $sql = "select * from t_cms_news as N 
                INNER JOIN t_cms_cate_news CN
                    ON CN.FK_NEWS=N.PK_NEWS
                INNER JOIN t_cms_cate C
                    ON CN.FK_CATE=C.PK_CATE
                WHERE N.PK_NEWS=? ";
            return $this->db->Getrow($sql, array($id));
        } else {
            return "ko tim thay id";
        }
    }

    public function qry_dsp_cmt($id) {
        $sql = "SELECT N.*,P.C_NAME AS PERSON_NAME,C.C_CONTENT AS CMT_CONTENT  FROM t_cms_cmt  C 
                            INNER JOIN t_cms_person AS P
                                ON C.fk_person=P.pk_person
                            INNER JOIN t_cms_news AS N
                                ON N.PK_NEWS=C.FK_NEWS
                WHERE N.PK_NEWS=? ";
        $recordSet = $this->db->GetAll($sql, array($id));
        // print_r($recordSet);
        return $recordSet;
    }

    /**
     * Thuc hien cap nhat thong tin user vao CSDLs
     */
    public function do_update_news() {
        if (isset($_POST)) {
            $news_id = $_POST['hdn_news_id'];
            $news_title = $_POST['txtTitle'];
            $news_content = $_POST['txtContent'];
            $news_short_content = $_POST['txtShortContent'];
            $v_person_id = Session::get('id');
            $v_type_id = $_POST['sel_type'];
            $v_lang=$_POST['sel_lang'];
            //xu ly cate
            $v_cate_id = $_POST['sel_cate'];
            $v_cate_parent_id=$this->db->getOne('SELECT C_PARENT FROM t_cms_cate WHERE PK_CATE=?',array($v_cate_id));
            $v_cate_new_id=$_POST['hdn_cate_news_id'];
            $v_cate_news_old_id=$_POST['hdn_cate_old_id'];
            $v_cate_parent_old_id=$this->db->GetOne('SELECT C_PARENT FROM t_cms_cate WHERE PK_CATE=?',array($v_cate_news_old_id));
            $v_date = date("Y-m-d");
            $arr_img = $_FILES['file_img'];
            $v_file_name = $arr_img['name'];
            if ($arr_img['size'] > 5048000) {
                echo "<script>alert('Anh phai <5Mb');</script>";
                return FALSE;
            }
            $i = strrpos($v_file_name, ".");
            if ($i) {
                $l = strlen($v_file_name) - $i;
                $ext = strtolower(substr($v_file_name, $i + 1, $l));
                if (($ext != "jpg") && ($ext != "jpeg") && ($ext != "png") && ($ext != "gif")) {
                    echo "<script>alert('Định dạng file không hợp lệ');</script>";
                    return FALSE;
                }
            }
            if (move_uploaded_file($arr_img['tmp_name'], SERVER_ROOT . "public/img/news/$v_file_name")) {
                // return FALSE;
            }
            $arr_data = array('C_TITLE' => $news_title,
                    'C_CONTENT' => $news_content,
                    'C_DATE' => $v_date,
                    'FK_PERSON' => $v_person_id,
                    'C_IMG' => $v_file_name,
                    'FK_TYPE' => $v_type_id,
                    'C_SHORT_CONTENT' => $news_short_content,
                    'C_LANG'=>$v_lang
                );
            $arr_data_cate_news=array(
                        'FK_CATE'=>$v_cate_id,
                        'FK_NEWS'=>$news_id
                    );
            $arr_data_cate_parrent_news=array(
                                'FK_CATE'=>$v_cate_parent_id,
                                'FK_NEWS'=>$news_id
                            );
            if ($news_id != "") {
               // $this->db->debug = 1;
                if ($v_file_name == "") {// cap nhat ko thay doi anh
                    unset($arr_data['C_IMG']);
                    if($this->db->AutoExecute('t_cms_news',$arr_data,'UPDATE','PK_NEWS='.$news_id)){
                        if($this->db->AutoExecute('t_cms_cate_news',$arr_data_cate_news,'UPDATE'
                                ,'FK_CATE='.$v_cate_news_old_id.' And FK_NEWS='.$news_id)){//cap nhat danh muc
                            if($v_cate_parent_old_id!=0){//cap nhat lai danh muc cha
                            //    var_dump($v_cate_parent_old_id);
                                if($this->db->AutoExecute('t_cms_cate_news',$arr_data_cate_parrent_news,'UPDATE'
                                ,'FK_CATE='.$v_cate_parent_old_id.' And FK_NEWS='.$news_id)){
                                    return true;
                                }
                            }  else {
                                return FALSE;
                            }
                        }
                    }
                } else {
                    if($this->db->AutoExecute('t_cms_news',$arr_data,'UPDATE','PK_NEWS='.$news_id)){
                        if($this->db->AutoExecute('t_cms_cate_news',$arr_data_cate_news,'UPDATE','PK_CATE_NEWS='.$v_cate_new_id)){//cap nhat danh muc
                            if($v_cate_parent_id!=0){//cap nhat lai danh muc cha
                                if($this->db->AutoExecute('t_cms_cate_news',$arr_data_cate_parrent_news,'UPDATE'
                                ,'FK_CATE='.$v_cate_parent_old_id.' And FK_NEWS='.$news_id)){
                                    return true;
                                }
                            }  else {//insert danh muc cha
                                return FALSE;
                            }
                            return true;
                        }
                    }
                }
            } else {
             //   $this->db->debug = 1;
                if ($this->db->AutoExecute('t_cms_news', $arr_data, 'INSERT')) {
                    $news_id=$this->db->GetOne("SELECT max(PK_NEWS) From t_cms_news");
                    $arr_data_cate_news=array(
                        'FK_CATE'=>$v_cate_id,
                        'FK_NEWS'=>$news_id
                    );
                    $arr_data_cate_parrent_news=array(
                                'FK_CATE'=>$v_cate_parent_id,
                                'FK_NEWS'=>$news_id
                            );  
                    if($this->db->AutoExecute('t_cms_cate_news',$arr_data_cate_news,'INSERT')){
                        if($v_cate_parent_id!=0){
                            if($this->db->AutoExecute('t_cms_cate_news',$arr_data_cate_parrent_news,'INSERT')){
                                return true;
                            }
                        }
                    }
                }
            }
            return false;
        }
    }

    /**
     * Thuc hien xoa user khoi CSDL
     */
    public function delete_news() {
       // $this->db->debug = 1;

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $this->db->Execute("DELETE FROM t_cms_news WHERE PK_NEWS=?", array($id));
        }
        if (isset($_GET['listId'])) {
            $listId = $_GET['listId'];
            $this->db->Execute("DELETE FROM t_cms_news WHERE PK_NEWS in ($listId)");
        }
    }

    public function active_new() {

        $id = $_GET['id'];
        $v_status = $_GET['status'];
        if ($v_status == 0) {
            $sql = "update t_cms_news set C_ACTIVE=1 where PK_NEWS=?";
        } else {
            $sql = "update t_cms_news set C_ACTIVE=0 where PK_NEWS=?";
        }
        $this->db->Execute($sql, $id);
    }

}

?>
