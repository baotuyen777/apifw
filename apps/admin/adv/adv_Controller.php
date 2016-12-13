<?php

class adv extends Controller{
    function __construct() {
        parent::__construct('admin', 'adv');
        Session::init();
            if(Session::get('loggedIn')==FALSE){
                Session::destroy();
                $this->redir(SITE_ROOT."admin/login");
            }
            if(Session::get('role')!=1){
                echo "<script>alert('Bạn không đủ quyền sử dụng chức năng này');</script>";
               $this->redir(SITE_ROOT."admin/login");
               
            }
            $this->view->active_menu="adv";
    }
    public function index(){
        $this->dsp_all_adv();
    }
    public function dsp_all_adv(){
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
        
        $pager=$this->model->qry_all_adv($page,$display);
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
        
        @$this->view->arr_all_adv=$pager['recordSet'];
        @$this->view->sotrang=$pager['sotrang'];
        
        $this->view->render('dsp_all_adv');
    }
    public function dsp_single_adv(){
        @$id=$_GET['id'];
        $this->view->arr_single_adv=$this->model->qry_single_adv($id);
        $this->view->render('dsp_single_adv');
    }
    function update_adv(){
        $this->model->update_adv();
        $this->redir(SITE_ROOT."admin/adv");
    }
    function delete_adv(){
             $this->model->delete_adv();
             $this->redir(SITE_ROOT."admin/adv");
   
    }
    function active_adv(){
        $this->model->active_adv();
        $this->redir(SITE_ROOT."admin/adv");
    }
}
?>
