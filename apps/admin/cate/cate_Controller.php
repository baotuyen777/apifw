<?php

class cate extends Controller{
    function __construct() {
        parent::__construct('admin', 'cate');
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
            $this->view->active_menu="cate";
    }
    public function index(){
        $this->dsp_all_cate();
    }
    public function dsp_all_cate(){
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
        
        $pager=$this->model->qry_all_cate($page,$display);
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
        
        @$this->view->arr_all_cate=$pager['recordSet'];
        @$this->view->sotrang=$pager['sotrang'];
        $this->view->render('dsp_all_cate');
    }
    public function dsp_single_cate(){
        @$id=$_GET['id'];
        $this->view->arr_single_cate=$this->model->qry_single_cate($id);
        $this->view->render('dsp_single_cate');
    }
    function update_cate(){
        $this->model->update_cate();
        $this->redir(SITE_ROOT."admin/cate");
    }
    function delete_cate(){
             $this->model->delete_cate();
             $this->redir(SITE_ROOT."admin/cate");
   
    }
    function active_cate(){
        $this->model->active_cate();
        $this->redir(SITE_ROOT."admin/cate");
    }
}
?>
