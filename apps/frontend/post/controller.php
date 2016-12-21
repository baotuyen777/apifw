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
        if (!$this->checkAPI('GET')) {
            $this->showJson();
            return;
        }

        $total = 100;
        $params = array(
            'postPerPage' => isset($_REQUEST['postPerPage']) ? filter_var($_REQUEST['postPerPage'], FILTER_SANITIZE_STRING) : 10,
            'filter' => isset($_REQUEST['filter']) ? filter_var($_REQUEST['filter'], FILTER_SANITIZE_STRING) : "",
            'page' => isset($_REQUEST['page']) ? filter_var($_REQUEST['page'], FILTER_SANITIZE_STRING) : 1,
            'total' => $total
        );
        $arrAllData = $this->model->getAllPost($params);
        $result = array(
            "status" => true,
            'data' => $arrAllData,
        );
        $result = array_merge($params,$result);
        $this->showJson($result);
    }

    function logout($abc) {
        $this->model->logout();
    }

}

?>