<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Bootstrap {

    function __construct() {
        $url = isset($_GET['url']) ? filter_var($_GET['url'], FILTER_SANITIZE_STRING) : null;

        $url = rtrim($url, '/');
        $url = explode('/', $url);
//        var_dump($url);
        if (empty($url[0])) {
            
        }
        /** find languate */
        if (isset($_GET['lang'])) {
            $file = 'libs/lang/' . $_GET['lang'] . '.php';
        } else {
            $file = 'libs/lang/en.php';
        }
        if (file_exists($file)) {
            require $file;
        } else {
            require 'lang/en.php';
        }
        /**  run default */
        if (empty($url[0])) {
            require 'apps/common/index/controller.php';
            $controller = new Index();
            $controller->index();
            return FALSE;
        } else {
            $this->loadModule($url);
        }
    }

    function loadModule($url) {
        //find in common
        $app = 'common';
        $file = 'apps/' . $app . '/' . $url[0] . '/controller.php';
        if (file_exists($file)) {
            require $file;
            $module = $url[0];
            $method = isset($url[1]) ? $url[1] : false;
            if ($method > 0) {
                $param = $method;
                $method = 'index';
            } else {
                $param = isset($url[2]) ? $url[2] : false;
            }
        } else {
            // find in module
            if (isset($url[1])) {
                $file = 'apps/' . $url[0] . '/' . $url[1] . '/controller.php';
                if (file_exists($file)) {
                    require $file;
                    $app = $url[0];
                    $module = $url[1];
                    $method = isset($url[2]) ? $url[2] : false;
                    $param = isset($url[3]) ? $url[3] : false;
                }
            } else {
                $this->error();
                return;
            }
        }
        $classColtroller = $module . "Controller";
        $controller = new $classColtroller;
        $controller->loadModel($app, $module);
        $this->loadMethod($controller, $method, $param);
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
