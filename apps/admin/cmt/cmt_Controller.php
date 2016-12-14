<?php
class cmt extends Controller{
    function __construct() {
        parent::__construct('admin','cmt');
        Session::init();
            if(Session::get('loggedIn')==FALSE){
                Session::destroy();
//                header('location: /mvc4/admin/login');
                exit;
            }
         $role=  Session::get("role");
         
        if($role>1){
            die("bạn không đủ quyền vào trang này!! :v");
        }
        $this->view->active_menu="cmt";
    }
    function index(){
        $this->dsp_all_cmt();
    }
    function dsp_all_cmt(){
        if(isset($_GET['p'])&& (int)$_GET['p']){
            $page=$_GET['p'];
        }else{
            $page=1;
        }
        $pager=$this->model->qry_all_cmt($page);
        $recordSet =$pager['recordSet'] ;
        $sotrang=$pager['sotrang'];
        
        $this->view->page=$page;
        $this->view->sotrang=$sotrang;
        $this->view->recordSet=$recordSet;
        $this->view->render('dsp_all_cmt');
    }
    function delete_cmt(){
             $this->model->delete_cmt();
             $this->redir(SITE_ROOT."admin/cmt");
   
    }
    function active_cmt(){
        $this->model->active_cmt();
        $this->redir(SITE_ROOT."admin/cmt");
    }
}
?>
