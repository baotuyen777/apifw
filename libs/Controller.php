<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Controller{
    /** @var \View */
    public $view;
    
    /** @var \Model */
    public $model;
    protected $app_name='';
    protected $module_name='';
    function __construct($app,$module) {
       // echo 'Main controller<br>';
        $this->app_name=$app;
        $this->module_name=$module;
//     /   $v=$app.'_View';
        $this->view =new View($app,$module);
    }
     public function  loadModel(){
       // $path='models/'.$name.'_model.php';
          $path='apps/'.$this->app_name.'/'.$this->module_name.'/'.$this->module_name.'_model.php';
        if(file_exists("$path")){
            require 'apps/'.$this->app_name.'/'.$this->module_name.'/'.$this->module_name.'_model.php';
            
            $modelName=$this->module_name.'_Model';
            $this->model=new $modelName();
        }
    }
    public function error(){
        echo 'xuat hien loi';
    }
    public function redir($v_url){
        echo "<script language='javascript'>window.location.href='".$v_url."'</script>";
    }
    
    
}
?>
