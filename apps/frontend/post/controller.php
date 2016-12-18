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
        $filter = isset($_POST['$filter']) ? $_POST['$filter'] : "";
        $checkTolen = Helper::checkToken();
        $result = array(
            "status" => false,
            "message" => ""
        );
        if ($checkTolen['status']) {
            $arrAllData = $this->model->getAllPost($filter);
//            var_dump( $arrAllData);
            $result = array(
                "status" => true,
                'data' => $arrAllData
            );
        }else{
            $result['message']=$checkTolen['message'];
        }


        header('Content-Type: application/json');
        echo json_encode($result);
    }

    function logout($abc) {
        $this->model->logout();
    }

}

?>