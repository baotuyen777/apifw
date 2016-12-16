<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Bootstrap {
    function __construct() {
        $url = isset($_GET['url']) ? $_GET['url'] : null;

        $url = rtrim($url, '/');
        $url = explode('/', $url);
//        check module
        if (empty($url[0])) {
            require 'apps/common/index/controller.php';
            $controller = new Index();
            $controller->index();
            return FALSE;
        } else {
            //find in common
            $file = 'apps/common/' . $url[0] . '/controller.php';
            if (file_exists($file)) {
                require $file;
                $class = $url[0];
                $method = isset($url[1]) ? $url[1] : false;
                $param = isset($url[2]) ? $url[2] : false;
            } else {
                // find in module
                if (isset($url[1])) {
                    $file = 'apps/' . $url[0] . '/' . $url[1] . '/controller.php';
                    if (file_exists($file)) {
                        require $file;
                        $module = $url[0];
                        $class = $url[1];
                        $method = isset($url[2]) ? $url[2] : false;
                        $param = isset($url[3]) ? $url[3] : false;
                    }
                } else {
                    $this->error();
                    return;
                }
            }
            $classColtroller = $class . "Controller";
            $controller = new $classColtroller;
            $controller->loadModel($class);
            $this->loadMethod($controller, $method, $param);
        }
    }

    /**
     * 
     * @param type $controller
     * @param type $method
     * @param type $param
     * @return boolean
     */
    function loadMethod($controller, $method, $param) {
        if (!$method) {
            if (method_exists($controller, 'index')) {
                $controller->index();
            } else {
                $this->error();
            }
        } else {
            if (method_exists($controller, $method)) {
                //calling method no param
                if (isset($param)) {
                    $controller->$method($param);
                    return true;
                }
                $controller->$method();
            } else {
                $this->error();
            }
        }
    }

    /**
     * 
     * @return boolean
     */
    function error() {
        require 'apps/common/error/controller.php';
        new errorController();
        return FALSE;
    }

}

?>
