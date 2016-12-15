<?php

class Login extends Controller{
        function __construct(){
            parent::__construct('admin','login');
//            $this->views->active_menu="";
           echo 222;
        }
        function index(){    
            echo 1111;
             $this->view->render('dsp_login');
        }  
        function login(){
            echo 222;
            if($this->model->login()){
                $this->redir(SITE_ROOT."admin/news");
            }  else {
                $this->redir(SITE_ROOT."admin/login");
            }
        }
        function logout(){
            Session::destroy();
            $this->redir(SITE_ROOT."admin/login");
        }

    }
?>