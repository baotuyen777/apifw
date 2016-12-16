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
        $this->app_name=$app;
        $this->module_name=$module;
    }
    /** 
     * @function \loadModel
     */
     public function  loadModel(){
          $path='apps/'.$this->app_name.'/'.$this->module_name.'/model.php';
        if(file_exists($path)){
            require $path;
            $modelName=$this->module_name.'Model';
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
