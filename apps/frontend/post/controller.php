<?php

class postController extends Controller {

    public $auth;

    function __construct() {
        parent::__construct('frontend', 'post');
    }

    function index() {
        $this->getAllPost();
    }

    /**
     * 
     * @return type
     * postPerPage: 10,
     * filter: "",
     * page : 1,
     */
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
        $allFieldsAllow = array_merge($requireFields, array('post_excerpt'));

        if (!$this->checkAPI('POST', $requireFields)) {
            $this->showJson();
            return;
        }
        /** remove useless element */
        $flip = array_flip($_POST);
        $intersect = array_intersect($flip, $allFieldsAllow);
        $params = array_flip($intersect);
        /** add default field */
        $defaultField = array(
            'to_ping' => '',
            'pinged' => "",
            'post_content_filtered' => "",
            "post_excerpt" => "",
            "post_author" => $this->token->user
        );
        $params = array_merge($defaultField, $params);
        $id = $this->model->addPost($params);
        if ($id) {
            $result = array(
                "status" => true,
                'id' => $id,
            );
        } else {
            $result = array(
                "status" => false,
                'message' => "something wrong! please contact admin!",
            );
        }

        $this->showJson($result);
    }

    function update($id) {
        $requireFields = array();
        $allFieldsAllow = array_merge($requireFields, array('post_title', 'post_content', 'post_name', 'post_type', 'post_status', 'post_excerpt'));

        if (!$this->checkAPI('PUT', $requireFields)) {
            $this->showJson();
            return;
        }
        /** check exist id */
        $checkId = Helper::checkId("wp_posts", 'ID', $id);
        if (!$checkId['status']) {
            $this->showJson($checkId);
            return;
        }
        parse_str(file_get_contents("php://input"), $put_vars);

        /** remove useless element */
        $flip = array_flip($put_vars);
        $intersect = array_intersect($flip, $allFieldsAllow);
        $params = array_flip($intersect);

        if ($this->model->updatePost($id, $params)) {
            $result = array(
                "status" => true,
                'message' => "200",
            );
        } else {
            $result = array(
                "status" => false,
                'message' => "you should use x-www-form-urlencoded or please contact admin!",
            );
        }
        $this->showJson($result);
    }

    function delete($id) {
        if (!$this->checkAPI('DELETE')) {
            $this->showJson();
            return;
        }
        /** check exist id */
        $checkId = Helper::checkId("wp_posts", 'ID', $id);
        if (!$checkId['status']) {
            $this->showJson($checkId);
            return;
        }
        if ($this->model->deletePost($id)) {
            $result = array(
                "status" => true,
                'message' => "200",
            );
        } else {
            $result = array(
                "status" => false,
                'message' => "something wrong, please contact admin!",
            );
        }
        $this->showJson($result);
    }

    function deleteMulti($listId) {
        if (!$this->checkAPI('DELETE')) {
            $this->showJson();
            return;
        }
        if (!$listId) {
            $this->result = array(
                "status" => false,
                "message" => "please input {listID} in URL eg:{/deleteMulti/1,2,5}"
            );
            $this->showJson();
            return;
        }
        if ($this->model->deletePost(filter_var($listId, FILTER_SANITIZE_STRING))) {
            $result = array(
                "status" => true,
                'message' => "200",
            );
        } else {
            $result = array(
                "status" => false,
                'message' => "something wrong, please contact admin!",
            );
        }
        $this->showJson($result);
    }

}

?>