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

        if (empty($url[0])) {
            
        }
        /**  run default */
        if (empty($url[0])) {
            require 'apps/common/index/controller.php';
            require 'lang/en.php';
            $controller = new Index();
            $controller->index();
            return FALSE;
        } else {
            /** find languate */
            $file = 'libs/lang/' . $url[0] . '.php';
            if (file_exists($file)) {
                require $file;
                $this->loadModule($url,1);
            } else {
                require 'lang/en.php';
                $this->loadModule($url,0);
            }
        }
    }

    function loadModule($url,$indexCustom) {
        //find in common
        $app = 'common';
        $file = 'apps/' . $app . '/' . $url[0+$indexCustom] . '/controller.php';
        if (file_exists($file)) {
            require $file;

            $module = $url[0+$indexCustom];
                 
            $method = isset($url[1+$indexCustom]) ? $url[1+$indexCustom] : false;
            $param = isset($url[2+$indexCustom]) ? $url[2+$indexCustom] : false;
        } else {
            // find in module
            if (isset($url[1+$indexCustom])) {
                $file = 'apps/' . $url[0+$indexCustom] . '/' . $url[1+$indexCustom] . '/controller.php';
                if (file_exists($file)) {
                    require $file;
                    $app = $url[0+$indexCustom];
                    $module = $url[1+$indexCustom];
                    $method = isset($url[2+$indexCustom]) ? $url[2+$indexCustom] : false;
                    $param = isset($url[3+$indexCustom]) ? $url[3+$indexCustom] : false;
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
