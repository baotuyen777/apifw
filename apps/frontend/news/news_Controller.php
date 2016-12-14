<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class News extends Controller{
    function __construct() {
        parent::__construct('frontend','news');
       // var_dump(__('update'));die;
    }  
    function index(){
       
            $this->dsp_all_news();
    }

    function dsp_all_news(){
//        if(isset($_GET['p'])&& (int)$_GET['p']){
//            $page=$_GET['p'];
//        }else{
//            $page=1;
//        }
//        $display=5;
//        
//       $pager=$this->model->qry_all_news($page,$display);
//        $sotrang=$pager['sotrang'];
//        if($page<=$sotrang && $page>1){
//            $prev=$page-1;
//        }  else {
//            $prev=-1;
//        }
//        if($page<$sotrang){
//            $next=$page+1;
//        }  else {
//            $next=-1;
//        }
//        
//        $recordSet =$pager['recordSet'] ;
        //
        $this->view->arr_all_news_new=$this->model->qry_all_news_new();
        $this->view->arr_all_news_hot=$this->model->qry_all_news_hot();
        $this->view->arr_all_cate=$this->model->qry_all_category();
     
        $this->view->render('dsp_all_news');
    }
    function dsp_all_news_cate(){
        $page=1;
        if(isset($_GET['p'])&& (int)$_GET['p']){
            $page=$_GET['p'];
        }
        @$cate_id=$_GET['id'];
        $display=5;
        
       $pager=$this->model->qry_all_news_by_category($page,$display,$cate_id);
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
        
        $recordSet =$pager['recordSet'] ;
        //
        $this->view->cate_id=$cate_id;
        $this->view->arr_all_news_cate=$recordSet;
        $this->view->prev=$prev;
        $this->view->next=$next;
        $this->view->sotrang=$sotrang;
        $this->view->recordSet=$recordSet;
        $this->view->render('dsp_all_news_cate');
    }
    
    function dsp_list_all_news(){
         $page=1;
        if(isset($_GET['p'])&& (int)$_GET['p']){
            $page=$_GET['p'];
        }
        @$cate_id=$_GET['id'];
        $display=5;
        
       $pager=$this->model->qry_all_news($page,$display);
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
        
        $recordSet =$pager['recordSet'] ;
        //
        $this->view->cate_id=$cate_id;
        $this->view->arr_all_news=$recordSet;
        $this->view->prev=$prev;
        $this->view->next=$next;
        $this->view->sotrang=$sotrang;
        $this->view->recordSet=$recordSet;
        $this->view->render('dsp_list_all_news');
    }



    function  dsp_content_news(){
           // $this->view->email=$email;
        $id=$_GET['id'];
        $this->view->id=$id;
        $data= $this->model->qry_single_news($id);
      //  $user= $this->model->qry_single_user($email);
        $v_capcha=  rand(0, 9999);
        Session::init();
        Session::set('capcha', $v_capcha);
        $cmt=$this->model->qry_dsp_cmt($id);

        $this->view->data=$data;
        $this->view->cmt=$cmt;
        $this->view->render("dsp_content_news");
        
    }

    function do_insert_cmt(){
        
        $v_msg=$this->model->do_insert_cmt();
            $id=$_POST['txtNewId'];
            header("location: ".SITE_ROOT."frontend/news/dsp_content_news/?id=$id");
    }
            
    function logout(){
        Session::init();
        Session::destroy();
        header("location: /mvc3/login");
    }
    function set_lang(){
        $lang=isset($_GET['lang']) ? $_GET['lang'] : "vi";//nếu trên trình duyệt có biến lang, thì lấy ....
        if($lang=='vi'){
            $_SESSION['lang']='vi';
        }elseif ($lang=='en') {
            $_SESSION['lang']='en';
        }  
        else {
            $_SESSION['lang']='vi';
        }
        header("location: ".SITE_ROOT."frontend/news/");
    }

}
?>
