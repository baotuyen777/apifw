<?php

class Register extends Controller{
        function __construct(){
            parent::__construct();
           // echo "we are in register<br>";
           
        }
        
        function index(){
            $this->view->render("register","index");
        }
        function do_register(){
            if($this->model->do_register()){
                header("location:  ../user");
                exit();
            }
        }
        
}        
?>
