<?php
class News_Model extends Model{
    function __construct() {
        parent::__construct();
       
        
    }
    
    /**
     * Thuc hien query CSDL de lay danh sach user
     */

    public function qry_all_news($page,$display)
    {
       // $this->db->debug=1;
        if(isset($_GET['search'])){
            $v_search=$_GET['search'];
            $row= $this->db->GetOne('SELECT count(*) FROM t_cms_person AS P 
                INNER JOIN t_cms_news AS N ON P.pk_person=N.fk_person 
                INNER JOIN t_cms_cate_news CN ON CN.FK_NEWS=N.PK_NEWS
                INNER JOIN t_cms_cate AS CT ON CN.FK_CATE=CT.PK_CATE WHERE N.C_TITLE like ?',array("%$v_search%"));
            $sotrang=  ceil($row/$display);   
            $start=0;
            if($page<=$sotrang && $page>0){
                $start=$page*$display-$display;
            }
            $sql = "SELECT N.*,CT.*,P.C_NAME AS PERSON_NAME FROM t_cms_person AS P 
                INNER JOIN t_cms_news AS N ON P.pk_person=N.fk_person 
                INNER JOIN t_cms_cate_news CN ON CN.FK_NEWS=N.PK_NEWS
                INNER JOIN t_cms_cate AS CT ON CN.FK_CATE=CT.PK_CATE ";
            $sql .= "Where N.C_TITLE like ? ORDER BY N.C_DATE LIMIT ?,?";
            $recordSet = $this->db->GetAll($sql, array("%$v_search%",$start,$display));
        }  else {
             $row= $this->db->GetOne('SELECT count(*) FROM t_cms_person AS P 
                INNER JOIN t_cms_news AS N ON P.pk_person=N.fk_person 
                INNER JOIN t_cms_cate_news CN ON CN.FK_NEWS=N.PK_NEWS
                INNER JOIN t_cms_cate AS CT ON CN.FK_CATE=CT.PK_CATE ');
            $sotrang=  ceil($row/$display);   
            if($page<=$sotrang && $page>0){
                $start=$page*$display-$display;
            }
            $sql = "SELECT N.*,CT.*,P.C_NAME AS PERSON_NAME FROM t_cms_person AS P 
                INNER JOIN t_cms_news AS N ON P.pk_person=N.fk_person 
                INNER JOIN t_cms_cate_news CN ON CN.FK_NEWS=N.PK_NEWS
                INNER JOIN t_cms_cate AS CT ON CN.FK_CATE=CT.PK_CATE ";
            $sql .= " ORDER BY N.C_DATE LIMIT ?,?";
            $recordSet = $this->db->GetAll($sql, array($start,$display));
        }
         $pager=array("recordSet"=>$recordSet,"sotrang"=>$sotrang);
         return $pager;
    }
   

    public function qry_all_news_new(){
        $sql="SELECT * FROM t_cms_news where C_ACTIVE=1  And C_LANG=? ORDER BY PK_NEWS  DESC LIMIT 10";
        return $this->db->getAll($sql,  $this->lang);
    }
    public function qry_all_news_hot(){
        $sql="SELECT * FROM t_cms_news where C_ACTIVE=1 And C_LANG=? ORDER BY C_VIEWS DESC LIMIT 10 ";
        return $this->db->getAll($sql,$this->lang);
    }
   public function qry_all_news_by_category($page,$display,$v_cate_id) {
     //  $this->db->debug=10;
       $row= ($this->db->GetOne("select count(*) from t_cms_news N 
                                    INNER JOIN t_cms_cate_news CN 
                                    ON N.PK_NEWS=CN.FK_NEWS
                                    INNER JOIN t_cms_cate CT ON CT.PK_CATE=CN.FK_CATE
           where FK_CATE = {$v_cate_id} And C_LANG=?",array($this->lang)));
        $sotrang=  ceil($row/$display);   
        $start=0;
        if($page<=$sotrang && $page>0){
            $start=$page*$display-$display;
        }
        $sql = "SELECT N.*,CT.*,P.C_NAME AS PERSON_NAME 
            FROM t_cms_person AS P 
            INNER JOIN t_cms_news AS N ON P.pk_person=N.FK_PERSON 
            INNER JOIN t_cms_cate_news CN ON N.PK_NEWS=CN.FK_NEWS 
            INNER JOIN t_cms_cate AS CT ON CN.FK_CATE=CT.PK_CATE ";
        $sql.=" where CT.PK_CATE=?  And C_LANG=? and N.C_ACTIVE=1 ORDER BY N.C_DATE DESC LIMIT ?,?";
        $recordSet = $this->db->GetAll($sql, array($v_cate_id,$this->lang,$start,$display));
         $pager=array("recordSet"=>$recordSet,"sotrang"=>$sotrang);
         return $pager;
    }
    


    /**
     * Thuc hien query CSDL de lay thong tin chi tiet cua mot user
     */
    public function qry_single_news($id)
    {
            $sql = "select * from t_cms_person as PS
                INNER JOIN t_cms_news as N 
                ON PS.pk_person=N.fk_person WHERE N.PK_NEWS=? ";
            return  $this->db->GetRow($sql,array($id));  
    }

    public function qry_dsp_cmt($id){
        $sql = "SELECT N.*,P.C_NAME AS PERSON_NAME,C.C_CONTENT AS CMT_CONTENT,C.C_NAME_PERSON  FROM t_cms_cmt  C 
                            LEFT JOIN t_cms_person AS P
                                ON C.fk_person=P.pk_person
                            INNER JOIN t_cms_news AS N
                                ON N.PK_NEWS=C.FK_NEWS
                WHERE N.PK_NEWS=? AND C.C_ACTIVE=1";
        return  $this->db->GetAll($sql,array($id));
    }


    public function do_insert_cmt(){
        $this->db->debug=1;
        if (isset($_POST)){
                    $id=$_POST['txtNewId'];
                    $content=$_POST['txtCmt'];
                    $v_name_person=$_POST['txtNamePerson'];
                   
                    $this->db->Execute("INSERT INTO 
                        t_cms_cmt (FK_NEWS,C_NAME_PERSON,C_CONTENT) 
                        VALUE(?,?,?)",array($id,$v_name_person,$content));

                }
    }
   
    
  
}
?>
