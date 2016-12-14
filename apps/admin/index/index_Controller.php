<?php
    class Index extends Controller{
        function __construct() {
            parent::__construct('admin','index');
            
        }
        function index(){
           $this->redir(SITE_ROOT."admin/news");
            $this->view->render('index');
        }
    }
?>