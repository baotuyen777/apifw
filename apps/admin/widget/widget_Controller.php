<?php

class widget extends Controller{
    function __construct() {
        parent::__construct('admin', 'widget');
        Session::init();
            if(Session::get('loggedIn')==FALSE){
                Session::destroy();
                $this->redir(SITE_ROOT."admin/login");
                exit;
            }
            if(Session::get('role')!=1){
                echo "<script>alert('Bạn không đủ quyền sử dụng chức năng này');</script>";
                $this->redir(SITE_ROOT."admin/login");
               
            }
            $this->view->active_menu="widget";
    }
    public function index(){
        $this->dsp_all_widget();
    }
    public function dsp_all_widget(){
        $role=  Session::get("role");
        if($role>1){
           // die("bạn không đủ quyền vào trang này!! :v");
        }
        if(isset($_GET['p'])&& (int)$_GET['p']){
            $page=$_GET['p'];
        }else{
            $page=1;
        }
        $display=5;
        
        $pager=$this->model->qry_all_widget($page,$display);
        @$recordSet =$pager['recordSet'] ;
        @$sotrang=$pager['sotrang'];
        if($page<=$sotrang && $page>1){
            $prev=$page-1;
        }  else {
            $prev=-1;
        }
        if($page<$sotrang){
            $next=$page+1;
        }  else {
            $next=-1;
        }
        $this->view->prev=$prev;
        $this->view->next=$next;
        $this->view->sotrang=$sotrang;
        
        @$this->view->arr_all_widget=$pager['recordSet'];
        @$this->view->sotrang=$pager['sotrang'];
        $this->view->render('dsp_all_widget');
    }
    public function dsp_single_widget(){
        @$id=$_GET['id'];
        $this->view->arr_single_widget=$this->model->qry_single_widget($id);
        $this->view->render('dsp_single_widget');
    }
    function update_widget(){
        $this->model->update_widget();
        $this->redir(SITE_ROOT."admin/widget");
    }
    function delete_widget(){
             $this->model->delete_widget();
             $this->redir(SITE_ROOT."admin/widget");
   
    }
    function active_widget(){
        $this->model->active_widget();
        $this->redir(SITE_ROOT."admin/widget");
    }
}
?>
