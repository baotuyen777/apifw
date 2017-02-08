<?php

class UserController extends Controller {

    public $auth;

    function __construct() {
        parent::__construct('frontend', 'post');
    }

    function index($id) {
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            if ($id) {
                $this->detail($id);
            } else {
                $this->all();
            }
        }
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $this->add();
        }
        if ($_SERVER['REQUEST_METHOD'] == "PUT") {
            $this->update($id);
        }
        if ($_SERVER['REQUEST_METHOD'] == "DELETE") {
            $this->delete($id);
        }
    }

    /**
     * @api {get} /user/:id Request User information
     * @apiName All
     * @apiGroup User
     *
     * @apiParam {Number} id Users unique ID.
     *
     * @apiSuccess {Number} postPerPage Post Per Page.
     * @apiSuccess {String} filter  Filter of the User.
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *       "status": true,
     *       "message": "200",
     *       "postPerPage": 10,
     *       "filter": "",
     *       "page": 1,
     *       "total": 1,
     *       "data":[]
     *     }
     *
     * @apiError Token invalid.
     *
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 404 Not Found
     *     {
     *       "status": false,
     *       "message": "token invalid!"
     *     }
     */
    function all() {
        if (!$this->checkAPI('GET')) {
            $this->showJson();
            return;
        }

        $arrAllData = $this->model->getAllUser();
        $params = array(
            'postPerPage' => isset($_REQUEST['postPerPage']) ? filter_var($_REQUEST['postPerPage'], FILTER_SANITIZE_STRING) : 10,
            'filter' => isset($_REQUEST['filter']) ? filter_var($_REQUEST['filter'], FILTER_SANITIZE_STRING) : "",
            'page' => isset($_REQUEST['page']) ? filter_var($_REQUEST['page'], FILTER_SANITIZE_STRING) : 1,
            'total' => count($arrAllData)
        );

        $arrAllDataPagination = $this->model->getAllUser($params);
        $result = array(
            "status" => true,
            'data' => $arrAllDataPagination,
        );
        $result = array_merge($params, $result);
        $this->showJson($result);
    }

    /**
     * @api {get} /user/:id Request User information
     * @apiName GetUser
     * @apiGroup User
     *
     * @apiParam {Number} id Users unique ID.
     *
     * @apiSuccess {String} firstname Firstname of the User.
     * @apiSuccess {String} lastname  Lastname of the User.
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *       "status": true,
     *       "message": "200",
     *       "postPerPage": 10,
     *       "filter": "",
     *       "page": 1,
     *       "total": 1,
     *       "data":[]
     *     }
     *
     * @apiError UserNotFound The id of the User was not found.
     *
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 404 Not Found
     *     {
     *       "status": false,
     *       "message": "token invalid!"
     *     }
     */
    function detail($id) {
        if (!$this->checkAPI('GET')) {
            $this->showJson();
            return;
        }
        if ($id) {
            $arrSingleObject = $this->model->getSingleUser(filter_var($id, FILTER_SANITIZE_NUMBER_INT));
            $result = array(
                "status" => true,
                'data' => $arrSingleObject,
            );
            if (!$arrSingleObject) {
                $result = array(
                    "status" => false,
                    'message' => "{id} " . LANG::__("IdNotFound"),
                );
            }
        }

        $this->showJson($result);
    }

    /**
     * @api {post} /user Request User information
     * @apiName AddUser
     * @apiGroup User
     *
     * @apiParam {String} email Email unique ID.
     *
     * @apiSuccess {String} pass Passoword of the User.
     * @apiSuccess {String} name  Display name of the User.
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *       "status": true,
     *       "message": "200",
     *       "id": 10
     *     }
     *
     * @apiError UserNotFound The id of the User was not found.
     *
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 404 Not Found
     *     {
     *       "status": false,
     *       "message": "token invalid!"
     *     }
     */
    function add() {
        $requireFields = array('email', 'password', 'name');
        $allFieldsAllow = array_merge($requireFields, array());

        if (!$this->checkAPI('POST', $requireFields)) {
            $this->showJson();
            return;
        }

        $params = array(
            'user_email' => $_POST['email'],
            'user_pass' => $_POST['password'],
            'display_name' => $_POST['name']
        );
        $id = $this->model->addUser($params);
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

    /**
     * @api {put} /user Update User 
     * @apiName UpdateUser
     * @apiGroup User
     *
     * @apiParam {String} email Email unique ID.
     *
     * @apiSuccess {String} pass Passoword of the User.
     * @apiSuccess {String} name  Display name of the User.
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *       "status": true,
     *       "message": "200",
     *       "postPerPage": 10,
     *       "filter": "",
     *       "page": 1,
     *       "total": 1,
     *       "data":[]
     *     }
     *
     * @apiError UserNotFound The id of the User was not found.
     *
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 404 Not Found
     *     {
     *       "status": false,
     *       "message": "token invalid!"
     *     }
     */
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

        if ($this->model->updateUser($id, $params)) {
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

    /**
     * @api {delete} /user Update User 
     * @apiName DeleteUser
     * @apiGroup User
     *
     * @apiParam {String} email Email unique ID.
     *
     * @apiSuccess {String} pass Passoword of the User.
     * @apiSuccess {String} name  Display name of the User.
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *       "status": true,
     *       "message": "200",
     *     }
     *
     * @apiError UserNotFound The id of the User was not found.
     *
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 404 Not Found
     *     {
     *       "status": false,
     *       "message": "token invalid!"
     *     }
     */
    
    function delete($id) {
        if (!$this->checkAPI('DELETE')) {
            $this->showJson();
            return;
        }
        /** check exist id */
        $checkId = Helper::checkId("wp_user", 'ID', $id);
        if (!$checkId['status']) {
            $this->showJson($checkId);
            return;
        }
        if ($this->model->deleteUser($id)) {
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
        if ($this->model->deleteUser(filter_var($listId, FILTER_SANITIZE_STRING))) {
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