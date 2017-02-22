<?php

class DateController extends Controller {

//    public $auth;

    function __construct() {
        parent::__construct();
    }

    function index($id) {
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            $this->all();
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
     * @api {get} /date All
     * @apiName All
     * @apiGroup Date
     *
     * @apiParam {String} date Date.
     * @apiParam {Number} postPerPage Post Per Page.
     * @apiParam {Number} page Page .
     *
     * @apiSuccess {Number} postPerPage Post Per Page.
     * @apiSuccess {String} filter  Filter of the Date.
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

        $arrAllData = $this->model->getAll();
        $params = array(
            'postPerPage' => isset($_REQUEST['postPerPage']) ? filter_var($_REQUEST['postPerPage'], FILTER_SANITIZE_STRING) : 10,
            'date' => isset($_REQUEST['date']) ? filter_var($_REQUEST['date'], FILTER_SANITIZE_STRING) : "",
            'page' => isset($_REQUEST['page']) ? filter_var($_REQUEST['page'], FILTER_SANITIZE_STRING) : 1,
            'total' => count($arrAllData)
        );

        $arrAllDataPagination = $this->model->getAll($params);
        $result = array(
            "status" => true,
            'data' => $arrAllDataPagination,
        );
        $result = array_merge($params, $result);
        $this->showJson($result);
    }

    /**
     * @api {post} /date Add
     * @apiName Add
     * @apiGroup Date
     *
     * @apiParam {String} date date unique .
     *
     * @apiSuccess {String} status status of the API.
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *       "status": true,
     *       "message": "200",
     *       "id": 10
     *     }
     *
     * @apiError DateNotFound The id of the Date was not found.
     *
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 404 Not Found
     *     {
     *       "status": false,
     *       "message": "Please input require field {date}"
     *     }
     */
    function add() {
        $this->requireFields = array('date');
        if (!$this->checkAPI('POST')) {
            $this->showJson();
            return;
        }
        /** check exist date */
        $checkId = $this->model->getSingle($_POST['date']);
        $mes = "something wrong! please contact admin!";
        $status = false;
        if ($checkId) {
            $mes = "date existed!";
        } else {
            $id = $this->model->add($_POST['date']);
            if ($id) {
                $status = true;
                $mes = "Success!";
            }
        }
        $result = array(
            "status" => $status,
            'message' => $mes,
        );

        $this->showJson($result);
    }

    /**
     * @api {put} /date/:date Update  
     * @apiName Update
     * @apiGroup Date
     *
     * @apiParam {Number} date Date unique .
     *
     * @apiSuccess {String} status status of the API.
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *       "status": true,
     *       "message": "200",
     *     }
     *
     * @apiError DateNotFound The id of the Date was not found.
     *
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 404 Not Found
     *     {
     *       "status": false,
     *        "message": "date not found!"
     *     }
     */
    function update($date) {
        $this->requireFields = array('status');
        if (!$this->checkAPI('PUT')) {
            $this->showJson();
            return;
        }

        parse_str(file_get_contents("php://input"), $put_vars);
        if ($this->model->update($date, $put_vars['status'])) {
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
     * @api {delete} /date/:date Delete
     * @apiName Delete
     * @apiGroup Date
     *
     * @apiParam {Number} date Date unique ID.
     *
     * @apiSuccess {String} status status of the API.
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *       "status": true,
     *       "message": "200",
     *     }
     *
     * @apiError DateNotFound The id of the Date was not found.
     *
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 404 Not Found
     *     {
     *       "status": false,
     *       "message": "date not found!"
     *     }
     */
    function delete($id) {
        if (!$this->checkAPI('DELETE')) {
            $this->showJson();
            return;
        }
        if ($this->model->delete($id)) {
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

    /**
     * @api {delete} /date/:date deleteMulti
     * @apiName deleteMultiDate
     * @apiGroup Date
     *
     * @apiParam {String} listId eg: /deleteMulti/1,2,5.
     *
     * @apiSuccess {String} status status of the API.
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *       "status": true,
     *       "message": "200",
     *     }
     *
     * @apiError DateNotFound The id of the Date was not found.
     *
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 404 Not Found
     *     {
     *       "status": false,
     *       "message": "ID not found!"
     *     }
     */
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
        if ($this->model->deleteDate(filter_var($listId, FILTER_SANITIZE_STRING))) {
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

    /**
     * @api {put} /date/updateStatus/:id UpdateStatus 
     * @apiName UpdateStatus
     * @apiGroup Date
     *
     * @apiParam {Number} id Orders unique ID.
     *
     * @apiSuccess {String} status status of the API.
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *       "status": true,
     *       "message": "200",
     *     }
     *
     * @apiError OrderNotFound The id of the Order was not found.
     *
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 404 Not Found
     *     {
     *       "status": false,
     *        "message": "ID not found!"
     *     }
     */
    function updateStatus($date) {
        $this->requireFields = array('status');
        if (!$this->checkAPI('PUT')) {
            $this->showJson();
            return;
        }
        parse_str(file_get_contents("php://input"), $put_vars);
        $status = false;
        $mes = "something wrong! please contact admin!";
        if ($this->model->updateStatus($date,  $put_vars['status'])) {
            $mes = "success";
            $status = true;
        }
        $result = array(
            "status" => $status,
            'message' => $mes,
        );
        $this->showJson($result);
    }

}

?>