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
        Helper::checkAPI('POST', array("a", "b"));
        $filter = isset($_POST['$filter']) ? $_POST['$filter'] : "";
        $checkTolen = Helper::checkToken();
        $result = array(
            "status" => false,
            "message" => ""
        );
        if ($checkTolen['status']) {
            $arrAllData = $this->model->getAllPost($filter);
            $result = array(
                "status" => true,
                'data' => $arrAllData
            );
        } else {
            $result['message'] = $checkTolen['message'];
        }

        Helper::showData($result);
    }

    function logout($abc) {
        $this->model->logout();
    }

}

?>