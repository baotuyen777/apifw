<?php

class postController extends Controller {

    public $auth;

    function __construct() {
        parent::__construct('frontend', 'post');
    }

    function index() {
        $this->getAllPost();
    }

    function getAllPost($filter = "") {
        if (!$this->checkAPI('POST', array("a", "b"))) {
            $this->showJson();
            return;
        }
        $filter = isset($_POST['filter']) ? filter_var($_POST['filter'],FILTER_SANITIZE_STRING) : "";
        $arrAllData = $this->model->getAllPost($filter);
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