<?php

class postController extends Controller {

    public $auth;

    function __construct() {
        parent::__construct('frontend', 'post');
    }

    function index() {
        $this->getAllPost();
    }

    function getAllPost() {
        if (!$this->checkAPI('POST', array("a", "b"))) {
            $this->showJson();
            return;
        }

        $total = 100;
        $params = array(
            'limit' => isset($_POST['filter']) ? filter_var($_POST['filter'], FILTER_SANITIZE_STRING) : 10,
            'filter' => isset($_POST['filter']) ? filter_var($_POST['filter'], FILTER_SANITIZE_STRING) : "",
            'page' => isset($_POST['page']) ? filter_var($_POST['page'], FILTER_SANITIZE_STRING) : 1
        );
        $arrAllData = $this->model->getAllPost($params);
        $result = array(
            "status" => true,
            'data' => $arrAllData
        );
        $this->showJson($result);
    }

    function logout($abc) {
        $this->model->logout();
    }

}

?>