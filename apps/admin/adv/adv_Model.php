<?php

class adv_Model extends Model{
    function qry_single_adv($id=""){
        if($id!=""){
            $sql = "select * from t_cms_adv WHERE PK_ADV=? ";
            return $this->db->Getrow($sql,array($id));  
        }  else {
            return "";
        }
    }
    public function qry_all_adv($page,$display)
    {
       // $this->db->debug = 1;
        $row= ($this->db->GetOne('select count(*) from t_cms_adv'));
        $sotrang=  ceil($row/$display); 
        $start=0;
        if($page<=$sotrang && $page>0){
            $start=$page*$display-$display;
        }
        $sql = "select * from t_cms_adv ORDER BY PK_ADV DESC LIMIT ?,? ";
        $recordSet = $this->db->GetAll($sql, array($start,$display));
         $pager=array("recordSet"=>$recordSet,"sotrang"=>$sotrang);
         return $pager;
    }
      /**
     * Thuc hien cap nhat thong tin user vao CSDLs
     */
    public function update_adv()
    {
        if (isset($_POST)){
                    $adv_id=$_POST['hdn_adv_id'];
                    $adv_title=$_POST['txtTitle'];
                    $pos= $_POST['sel_pos'];
                    $link=$_POST['txtLink'];
                    $v_date=  date("Y-m-d");
                    $arr_img = $_FILES['file_img'];
                    $v_file_name=$arr_img['name'];
                    if($arr_img['size']>5048000){
                        echo "<script>alert('Anh phai <5Mb');</script>";
                        return FALSE;
                    }
                    $i = strrpos($v_file_name,"."); 
                    if ($i) {  
                        $l = strlen($v_file_name) - $i; 
                        $ext = strtolower( substr($v_file_name,$i+1,$l));
                        if (($ext != "jpg") && ($ext != "jpeg") && ($ext !="png") && ($ext != "gif")) 
                        { 
                             echo "<script>alert('Định dạng file không hợp lệ');</script>";
                             return FALSE;
                        }
                    } 
                    if(move_uploaded_file($arr_img['tmp_name'],SERVER_ROOT."public/img/adv/$v_file_name")){
                       // return FALSE;
                    }
                    if($adv_id !=""){
                            $this->db->debug = 1;
                           if($v_file_name==""){
                                $this->db->Execute("UPDATE t_cms_adv SET C_TITLE=?,C_DATE=?,C_LINK=?,C_POS=?
                                                WHERE PK_ADV=?",array($adv_title,$v_date,$link,$pos,$adv_id));
                             }else{  
                                $this->db->Execute("UPDATE t_cms_adv SET C_TITLE=?,C_DATE=?,C_LINK=?,C_POS=?,C_IMG=?
                                                WHERE PK_ADV=?",array($adv_title,$v_date,$link,$pos,$v_file_name,$adv_id));
                             }
                    }else {
                        $this->db->debug = 1;
                        $this->db->Execute("INSERT INTO t_cms_adv(C_TITLE,C_DATE,C_LINK,C_POS,C_IMG)
                                      VALUES(?,?,?,?,?)",array($adv_title,$v_date,$link,$pos,$v_file_name));
                        
                    }
                    return true;
        }
    }
    
    /**
     * Thuc hien xoa user khoi CSDL
     */
    public function delete_adv()
    {   
        $this->db->debug = 1;
        
        if(isset($_GET['id'])){
            $id=$_GET['id'];
            $this->db->Execute("DELETE FROM t_cms_adv WHERE PK_ADV=?",array($id));
        }
        if(isset($_GET['listId'])){
            $listId=$_GET['listId'];
             $this->db->Execute("DELETE FROM t_cms_adv WHERE PK_ADV in (?)",array($listId));
        } 
    }
    public function active_adv(){
        
        $id=$_GET['id'];
        $v_status=$_GET['status'];
        if($v_status==0){
            $sql="update t_cms_adv set C_ACTIVE=1 where PK_ADV=?";
        }  else {
            $sql="update t_cms_adv set C_ACTIVE=0 where PK_ADV=?";
        }
        $this->db->Execute($sql,$id);
    }
}
?>
