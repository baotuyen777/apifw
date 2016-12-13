<?php

class widget_Model extends Model{
    function qry_single_widget($id=""){
        if($id!=""){
            $sql = "select * from t_cms_widget WHERE PK_WIDGET=? ";
            return $this->db->Getrow($sql,array($id));  
        }  else {
            return "";
        }
    }
    public function qry_all_widget($page,$display)
    {
       // $this->db->debug = 1;
        $row= ($this->db->Getone('select count(*) from t_cms_widget'));
        $sotrang=  ceil($row/$display);   
        if($page<=$sotrang && $page>0){
            $start=$page*$display-$display;
        }
        $sql = "select * from t_cms_widget";
        $sql .= " ORDER BY PK_WIDGET LIMIT ?,?";
        $recordSet = $this->db->GetAll($sql, array($start,$display));
         $pager=array("recordSet"=>$recordSet,"sotrang"=>$sotrang);
         return $pager;
    }
      /**
     * Thuc hien cap nhat thong tin user vao CSDLs
     */
    public function update_widget()
    {
        if (isset($_POST)){
                    $widget_id=$_POST['hdn_widget_id'];
                    $widget_name=$_POST['txtName'];
                    $widget_name_en=$_POST['txtNameEn'];
                    $widget_parent= $_POST['sel_parent']!="" ? $_POST['sel_parent'] : 0;
                    $widget_order=$_POST['txtOrder'];
                    $v_date=  date("Y-m-d");
                    if($widget_id !=""){
                            $this->db->debug = 1;
                           
                            $this->db->Execute("UPDATE t_cms_widget SET C_NAME=?,C_PARENT=?,C_DATE_CATE=?,C_ORDER=? C_NAME_EN=?
                                                WHERE PK_WIDGET=?",array($widget_name,$widget_parent,$v_date,$widget_order,$widget_name_en,$widget_id));
                    }else {
                        $this->db->debug = 1;
                        $this->db->Execute("INSERT INTO t_cms_widget(C_NAME,C_PARENT,C_ACTIVE_CATE,C_DATE_CATE,C_ORDER,C_NAME_EN)
                                      VALUES(?,?,0,?,?,?)",array($widget_name,$widget_parent,$v_date,$widget_order,$widget_name_en));
                        
                    }
                    return true;
        }
    }
    
    /**
     * Thuc hien xoa user khoi CSDL
     */
    public function delete_widget()
    {   
        $this->db->debug = 1;
        
        if(isset($_GET['id'])){
            $id=$_GET['id'];
            $this->db->Execute("DELETE FROM t_cms_widget WHERE PK_WIDGET=?",array($id));
        }
        if(isset($_GET['listId'])){
            $listId=$_GET['listId'];
             $this->db->Execute("DELETE FROM t_cms_widget WHERE PK_WIDGET in (?)",array($listId));
        } 
    }
    public function active_widget(){
        
        $id=$_GET['id'];
        $v_status=$_GET['status'];
        if($v_status==0){
            $sql="update t_cms_widget set C_ACTIVE_CATE=1 where PK_WIDGET=?";
        }  else {
            $sql="update t_cms_widget set C_ACTIVE_CATE=0 where PK_WIDGET=?";
        }
        $this->db->Execute($sql,$id);
    }
}
?>
