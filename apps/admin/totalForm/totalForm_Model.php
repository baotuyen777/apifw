<?php
class totalForm_Model extends Model{
    function __construct() {
        parent::__construct();
    }
    
    /**
     * Thuc hien query CSDL de lay danh sach user
     */
    public function qry_all_news_admin()
    {

        $sql = "select * from tbl_employee as E INNER JOIN news as N ON E.emp_id=N.emp_id";
        
          return  $recordSet = $this->db->GetAll($sql);

    }
    public function qry_all_news_guest($page,$display,$email)
    {
        $row= count($this->db->GetAll('select * from tbl_employee as E INNER JOIN news as N ON E.emp_id=N.emp_id'));
        $sotrang=  ceil($row/$display);   
        if($page<=$sotrang && $page>0){
            $start=$page*$display-$display;
          //  echo $start;
        }
        $sql = "select * from tbl_employee as E INNER JOIN news as N ON E.emp_id=N.emp_id WHERE E.emp_email=?";
        $sql .= " ORDER BY E.emp_id LIMIT ?,?";
            $recordSet = $this->db->GetAll($sql, array($email,$start,$display));
         $pager=array("recordSet"=>$recordSet,"sotrang"=>$sotrang);
         return $pager;
    }
    
    /**
     * Thuc hien query CSDL de lay thong tin chi tiet cua mot user
     */
    public function qry_single_news($id)
    {
       // echo $id;
        $email="";
        if($email==""){
            $sql = "select * from tbl_employee as E INNER JOIN news as N ON E.emp_id=N.emp_id WHERE N.news_id=? ";
            $recordSet = $this->db->GetAll($sql,array($id));  
        }  else {
            $sql = "select * from tbl_employee as E INNER JOIN news as N ON E.emp_id=N.emp_id WHERE E.emp_email=? AND N.news_id=? ";
            $recordSet = $this->db->GetAll($sql,array($id,$email));  
        }
        
       // print_r($recordSet);
        return $recordSet;
    }
    public function qry_single_user($email)
    {
        
        $sql = "select * from user WHERE user_email=? ";
        $recordSet = $this->db->getRow($sql,array($email));
       // print_r($recordSet);die;
        return $recordSet;
    }
    public function qry_dsp_cmt($id){
        $sql = "select * from comment as M 
                            INNER JOIN tbl_employee as E
                                ON M.emp_id=E.emp_id
                            INNER JOIn news as N
                                ON N.news_id=M.news_id
                WHERE M.news_id=? ";
        $recordSet = $this->db->GetAll($sql,array($id));
       // print_r($recordSet);
        return $recordSet;
    }
    /**
     * Thuc hien cap nhat thong tin user vao CSDLs
     */
    public function do_update_news()
    {
        if (isset($_POST)){
                    $emp_id=$_POST['hdn_user_id'];
                    $news_id=$_POST['hdn_news_id'];
                    $news_title=$_POST['txtTitle'];
                    $news_content=$_POST['txtContent'];
                    if($news_id !==""){
                            $this->db->debug = 1;
                            $this->db->Execute("UPDATE news SET
                                                emp_id=?,news_title=?,news_content=?
                                                WHERE news_id=?",array($emp_id,$news_title,$news_content,$new_id));

                    }else {
                        $this->db->debug = 1;
                        $this->db->Execute("INSERT INTO news(emp_id,news_title,news_content)
                                            VALUES(?,?,?)",array($emp_id,$news_title,$news_content));
                        echo 'them thanh cong';
                    }
        }
    }
    
    /**
     * Thuc hien xoa user khoi CSDL
     */
    public function do_delete_news($id,$control)
    {   
        $this->db->debug = 1;
        if($control==1){
            return $this->db->Execute("DELETE FROM tbl_employee WHERE emp_id=?",array($id));
        }
        if($control==2){
            return $this->db->Execute("DELETE FROM tbl_employee WHERE emp_id in (?)",array($id));
        }  else {
            return FALSE;
        }
    }
    public function do_insert_cmt(){
        $this->db->debug=1;
        if (isset($_POST)){
                    $id=$_POST['txtNewId'];
                    $content=$_POST['txtCmt'];
                    $emp_id=$_POST['txtEmpId'];
                   
                    $this->db->Execute("INSERT INTO 
                        COMMENT (news_id,emp_id,cmt_content) 
                        VALUE(?,?,?)",array($id,$emp_id,$content));

                   // var_dump($this->db->Error);
                  // print_r($mes);
                }
    }
  
}
?>
