<?php

class cate_Model extends Model{
    function qry_single_cate($id=""){
        if($id!=""){
            $sql = "select * from t_cms_cate WHERE PK_CATE=? ";
            return $this->db->Getrow($sql,array($id));  
        }  else {
            return "";
        }
    }
    public function qry_all_cate($page,$display)
    {
       // $this->db->debug = 1;
        $row= ($this->db->Getone('select count(*) from t_cms_cate'));
        $sotrang=  ceil($row/$display);   
        if($page<=$sotrang && $page>0){
            $start=$page*$display-$display;
        }
        $sql = "select * from t_cms_cate";
        $sql .= " ORDER BY C_PARENT LIMIT ?,?";
        $recordSet = $this->db->GetAll($sql, array($start,$display));
         $pager=array("recordSet"=>$recordSet,"sotrang"=>$sotrang);
         return $pager;
    }
      /**
     * Thuc hien cap nhat thong tin user vao CSDLs
     */
    public function update_cate()
    {
        if (isset($_POST)){
                    $cate_id=$_POST['hdn_cate_id'];
                    $cate_name=$_POST['txtName'];
                    $cate_name_en=$_POST['txtNameEn'];
                    $cate_parent= $_POST['sel_parent']!="" ? $_POST['sel_parent'] : 0;
                    $cate_order=$_POST['txtOrder'];
                    $v_date=  date("Y-m-d");
                    if($cate_id !=""){
                            $this->db->debug = 1;
                           
                            $this->db->Execute("UPDATE t_cms_cate SET C_NAME=?,C_PARENT=?,C_DATE_CATE=?,C_ORDER=? C_NAME_EN=?
                                                WHERE PK_CATE=?",array($cate_name,$cate_parent,$v_date,$cate_order,$cate_name_en,$cate_id));
                    }else {
                        $this->db->debug = 1;
                        $this->db->Execute("INSERT INTO t_cms_cate(C_NAME,C_PARENT,C_ACTIVE_CATE,C_DATE_CATE,C_ORDER,C_NAME_EN)
                                      VALUES(?,?,0,?,?,?)",array($cate_name,$cate_parent,$v_date,$cate_order,$cate_name_en));
                        
                    }
                    return true;
        }
    }
    
    /**
     * Thuc hien xoa user khoi CSDL
     */
    public function delete_cate()
    {   
        $this->db->debug = 1;
        
        if(isset($_GET['id'])){
            $id=$_GET['id'];
            $this->db->Execute("DELETE FROM t_cms_cate WHERE PK_CATE=?",array($id));
        }
        if(isset($_GET['listId'])){
            $listId=$_GET['listId'];
             $this->db->Execute("DELETE FROM t_cms_cate WHERE PK_CATE in (?)",array($listId));
        } 
    }
    public function active_cate(){
        
        $id=$_GET['id'];
        $v_status=$_GET['status'];
        if($v_status==0){
            $sql="update t_cms_cate set C_ACTIVE_CATE=1 where PK_CATE=?";
        }  else {
            $sql="update t_cms_cate set C_ACTIVE_CATE=0 where PK_CATE=?";
        }
        $this->db->Execute($sql,$id);
    }
}
?>
