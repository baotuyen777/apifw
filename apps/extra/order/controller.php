<?php

class OrderController extends Controller {

//    public $auth;

    function __construct() {
        parent::__construct();
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
     * @api {get} /product Request Product information
     * @apiName All
     * @apiGroup Product
     *
     * @apiParam {Number} id Products unique ID.
     * @apiParam {Number} postPerPage Post Per Page.
     * @apiParam {String} filter Products .
     * @apiParam {Number} page Page .
     *
     * @apiSuccess {Number} postPerPage Post Per Page.
     * @apiSuccess {String} filter  Filter of the Product.
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
            'filter' => isset($_REQUEST['filter']) ? filter_var($_REQUEST['filter'], FILTER_SANITIZE_STRING) : "",
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
     * @api {get} /product/:id Request detail Product information
     * @apiName Detail
     * @apiGroup Product
     *
     * @apiParam {Number} id Products unique ID.
     *
     * @apiSuccess {String} data Firstname of the Product.
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *       "status": true,
     *       "message": "200",
     *       "data": [],
     *     }
     *
     * @apiError ProductNotFound The id of the Product was not found.
     *
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 404 Not Found
     *     {
     *       "status": false,
     *       "message": "{id} not found or deactive"
     *     }
     */
    function detail($id) {
        if (!$this->checkAPI('GET')) {
            $this->showJson();
            return;
        }
        if ($id) {
            $arrSingleObject = $this->model->getSingle(filter_var($id, FILTER_SANITIZE_NUMBER_INT));
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
     * @api {post} /product Request Product information
     * @apiName AddProduct
     * @apiGroup Product
     *
     * @apiParam {String} cart cart 
     * @apiParam {String} date date 
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
     * @apiError ProductNotFound The id of the Product was not found.
     *
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 404 Not Found
     *     {
     *       "status": false,
     *       "message": "Please input require field {email}"
     *     }
     */
    function add() {
        $this->requireFields = array('cart');
        if (!$this->checkAPI('POST')) {
            $this->showJson();
            return;
        }
        $cart = json_decode($_POST['cart']);
        $status = true;
        $mes = "something wrong! please contact admin!";
        foreach ($cart as $productId => $quantity) {
            if (!$this->model->checkProduct($productId)) {
                $status = false;
                $mes = 'product_id not found {' . $productId . '}';
                break;
            }
        }
        if ($status) {
            $params = $_POST;
            $params['code'] = time();
            $params['user'] = $this->token->user;
            $id = $this->model->add($params);
            if ($id) {
                $status = true;
                $mes = "Create order success";
            }
        }
        $result = array(
            "status" => $status,
            "message" => $mes
        );
        $this->showJson($result);
    }

    /**
     * @api {put} /product Update Product 
     * @apiName UpdateProduct
     * @apiGroup Product
     *
     * @apiParam {Number} id Products unique ID.
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
     * @apiError ProductNotFound The id of the Product was not found.
     *
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 404 Not Found
     *     {
     *       "status": false,
     *        "message": "ID not found!"
     *     }
     */
    function update($id) {

        if (!$this->checkAPI('PUT')) {
            $this->showJson();
            return;
        }
        /** check exist id */
        $checkId = Helper::checkId($this->model->table, 'ID', $id);
        if (!$checkId['status']) {
            $this->showJson($checkId);
            return;
        }
        parse_str(file_get_contents("php://input"), $put_vars);
//validate
//..
        if ($this->model->update($id, $put_vars)) {
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
     * @api {delete} /product Update Product 
     * @apiName DeleteProduct
     * @apiGroup Product
     *
     * @apiParam {Number} id Products unique ID.
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
     * @apiError ProductNotFound The id of the Product was not found.
     *
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 404 Not Found
     *     {
     *       "status": false,
     *       "message": "ID not found!"
     *     }
     */
    function delete($id) {
        if (!$this->checkAPI('DELETE')) {
            $this->showJson();
            return;
        }
        /** check exist id */
        $checkId = Helper::checkId($this->model->table, 'ID', $id);
        if (!$checkId['status']) {
            $this->showJson($checkId);
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
     * @api {delete} /product Update Product 
     * @apiName deleteMultiProduct
     * @apiGroup Product
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
     * @apiError ProductNotFound The id of the Product was not found.
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
        if ($this->model->deleteProduct(filter_var($listId, FILTER_SANITIZE_STRING))) {
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