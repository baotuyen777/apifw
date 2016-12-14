<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class News extends Controller{
    function __construct() {
        parent::__construct('admin','news');
            Session::init();
            if(Session::get('loggedIn')==FALSE){
                Session::destroy();
                header('location: /apifw/admin/login');
                exit;
            }
            echo 111;
           // var_dump(__('update'));die;
            $this->view->active_menu="news";
    }  
    function index(){
        $role=  Session::get("role");
        $email=  Session::get("email");
        if($role==1){
            $this->dsp_all_news_admin();
        }  else {
            $this->dsp_all_news_reporter($email);
        }
    }
    function dsp_all_news_admin(){
        $role=  Session::get("role");
        if($role>1){
            die("bạn không đủ quyền vào trang này!! :v");
        }
        if(isset($_GET['p'])&& (int)$_GET['p']){
            $page=$_GET['p'];
        }else{
            $page=1;
        }
        $display=5;
        $pager=$this->model->qry_all_news_admin($page,$display);
        $recordSet =$pager['recordSet'] ;
        $sotrang=$pager['sotrang'];
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
        $this->view->recordSet=$recordSet;
        $this->view->render('dsp_all_news');
    }
    function dsp_all_news_reporter($email){
        if(isset($_GET['p'])&& (int)$_GET['p']){
            $page=$_GET['p'];
        }else{
            $page=1;
        }
        $display=5;
        $pager=$this->model->qry_all_news_reporter($page,$display,$email);
        $recordSet =$pager['recordSet'] ;
       
        $sotrang=$pager['sotrang'];
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
        $this->view->recordSet=$recordSet;
        $this->view->render('dsp_all_news');
    }
  
    function dsp_single_news(){
        if(isset($_GET['id'])){
            $new_id=$_GET['id'];
            $arr_single_news= $this->model->qry_single_news($new_id);
            $this->view->new_id=$new_id;
            $this->view->arr_single_news=$arr_single_news;
        }  else {
            $this->view->arr_single_news=array();
        }
        $this->view->render("dsp_single_news");
    }
    function do_update_news(){
        $this->model->do_update_news();
        $this->redir(SITE_ROOT."admin/news");
    }
    function delete_news(){
             $this->model->delete_news();
             $this->redir(SITE_ROOT."admin/news");
   
    }
    function active_news(){
        $this->model->active_new();
        $this->redir(SITE_ROOT."admin/news");
    }
            
    function logout(){
        Session::init();
        Session::destroy();
        header("location: /mvc3/login");
    }

}
?>
