<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Controller {

    /** @var \Model */
    public $model;

    /** @var \result */
    public $result;

    /** @var \token */
    public $token;

    function __construct() {
        $this->result = array(
            "status" => false,
            "message" => "Something wrong!"
        );
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

    /**
     * 
     * @param type $method = GET
     * @param type $requireFields check require
     */
    function checkAPI($method = "GET", $requireFields = array()) {
        /** check method */
        if ($_SERVER['REQUEST_METHOD'] !== $method && $method !== "GET") {
            $this->result['message'] = "Please use method {" . $method . "}";
            return false;
        }
        /** check token */
        $checkTolen = Helper::checkToken();
        if (!$checkTolen['status']) {
            $this->result['message'] = $checkTolen['message'];
            return false;
        }
        /** check require field */
        $require = true;
        $field = "";
        foreach ($requireFields as $requireField) {
            if ($method == "GET") {
                if (!isset($_GET[$requireField]) || $_GET[$requireField] == '') {
                    $field .= "{" . $requireField . "}";
                    $require = false;
                    break;
                }
            }
            if ($method == "POST") {
                if (!isset($_POST[$requireField]) || $_POST[$requireField] == '') {
                    $field .= "{" . $requireField . "}";
                    $require = false;
                    break;
                }
            }
            if ($method == "PUT") {
                parse_str(file_get_contents("php://input"), $post_vars);
                if (!isset($post_vars[$requireField]) || $post_vars[$requireField] == '') {
                    $field .= "{" . $requireField . "}";
                    $require = false;
                    break;
                }
            }
        }
        if (!$require) {
            $this->result['message'] = "Please input require field " . $field;
            return false;
        }
        $this->result = array(
            "status" => true,
            "message" => '200',
        );
        $this->token = $checkTolen['data'];
        return true;
    }

    /**
     * 
     * @param type $result
     */
    function changeResult($result) {
        if ($result) {
            $this->result = array_merge($this->result, $result);
        }
    }

    /**
     * 
     * @param type $result
     */
    function showJson($data = false) {
        header('Content-Type: application/json');
        if ($data) {
            $this->changeResult($data);
        }
        echo json_encode($this->result);
    }

}

?>
