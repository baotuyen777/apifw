<?php

class postController extends Controller {

    public $auth;

    function __construct() {
        parent::__construct('frontend', 'post');
    }

    function index() {
        $this->getAllPost();
    }

    function all() {
        if (!$this->checkAPI('GET')) {
            $this->showJson();
            return;
        }

        $arrAllData = $this->model->getAllPost();
        $params = array(
            'postPerPage' => isset($_REQUEST['postPerPage']) ? filter_var($_REQUEST['postPerPage'], FILTER_SANITIZE_STRING) : 10,
            'filter' => isset($_REQUEST['filter']) ? filter_var($_REQUEST['filter'], FILTER_SANITIZE_STRING) : "",
            'page' => isset($_REQUEST['page']) ? filter_var($_REQUEST['page'], FILTER_SANITIZE_STRING) : 1,
            'total' => count($arrAllData)
        );

        $arrAllDataPagination = $this->model->getAllPost($params);
        $result = array(
            "status" => true,
            'data' => $arrAllDataPagination,
        );
        $result = array_merge($params, $result);
        $this->showJson($result);
    }

    function detail($id) {
        if (!$this->checkAPI('GET')) {
            $this->showJson();
            return;
        }
        if ($id) {
            $arrSingleObject = $this->model->getSinglePost(filter_var($id, FILTER_SANITIZE_NUMBER_INT));
            $result = array(
                "status" => true,
                'data' => $arrSingleObject,
            );
            if (!$arrSingleObject) {
                $result = array(
                    "status" => false,
                    'message' => "{id} not found or deactive",
                );
            }
        }

        $this->showJson($result);
    }

    function add() {
        $requireFields = array('post_title', 'post_content', 'post_name', 'post_type', 'post_status');
        $allFields = array_merge($requireFields, array('post_excerpt'));

        if (!$this->checkAPI('POST', $requireFields)) {
            $this->showJson();
            return;
        }
        /** remove useless element */
        $flip = array_flip($_POST);
        $intersect = array_intersect($flip, $allFields);
        $params = array_flip($intersect);
        $id = $this->model->addPost($params);
//        $result = array(
//            "status" => true,
//            'id' => $id,
//        );
//        $result = array_merge($params, $result);
//        $this->showJson($result);
    }

}

?>