<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Bootstrap{
    function __construct() {
        $url = isset($_GET['url'])? $_GET['url'] :null ;
         
        $url = rtrim($url, '/');
        $url = explode('/', $url);
        
        if(empty($url[0]) || empty($url[1])){
            require 'apps/admin/index/index_Controller.php';
            $controller= new Index();
            $controller->index();
            return FALSE;
        }
        $file='apps/'.$url[0].'/' . $url[1] .'/'.$url[1]. '_Controller.php';
        if(file_exists($file)){
            require $file;
        }else{
            //chay module lỗi lên
            require 'apps/'.$url[0].'/error/error_controller.php';
            $controller= new error();
            return FALSE;
        }
        $controller = new $url[1];
        $controller->loadModel($url[1]);

        //calling method co tham so
        if (isset($url[3])) {
            if(method_exists($controller,$url[2])){
                $method=$url[2];
                $controller->$method($url[3]);
            }else{
                echo "<p>phuong thuc ko ton tai</p>";
            }
            //calling method ko co tham so
        } else {
            if (isset($url[2])) {
                if(method_exists($controller,$url[2])){
                    $controller->$url[2]();
                }else{
                    $this->error();
                }
            }else{
                $controller->index(); 
             }
        }
    }
    function error(){
        require 'apps/admin/error/error_controller.php';
        $controller= new Error_Controller();
      //  $controller->index();
        return FALSE;
    }
}
?>
