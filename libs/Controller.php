<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Controller {

    /** @var \View */
    public $view;

    /** @var \Model */
    public $model;

    function __construct() {
        
    }

    /**
     * @function \loadModel
     */
    public function loadModel($appName, $module) {
        $path = 'apps/' . $appName . '/' . $module . '/model.php';
        if (file_exists($path)) {
            require $path;
            $modelName = $module . 'Model';
            $this->model = new $modelName();
        }
    }

    public function error() {
        echo 'xuat hien loi';
    }

    public function redir($v_url) {
        echo "<script language='javascript'>window.location.href='" . $v_url . "'</script>";
    }

}

?>
