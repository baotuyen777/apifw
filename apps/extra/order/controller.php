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
     * @api {get} /product All
     * @apiName All
     * @apiGroup Order
     *
     * @apiParam {Number} user userId unique ID.
     * @apiParam {Number} postPerPage Post Per Page.
     * @apiParam {String} date Date .
     * @apiParam {Number} page Page .
     *
     * @apiSuccess {Number} postPerPage Post Per Page.
     * @apiSuccess {String} filter  Filter of the Order.
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
            'postPerPage' => isset($_REQUEST['postPerPage']) ? filter_var($_REQUEST['postPerPage'], FILTER_SANITIZE_NUMBER_INT) : 30,
            'user_id' => isset($_REQUEST['user']) ? filter_var($_REQUEST['user'], FILTER_SANITIZE_NUMBER_INT) : "",
            'date' => isset($_REQUEST['date']) ? filter_var($_REQUEST['date'], FILTER_SANITIZE_NUMBER_INT) : "",
            'page' => isset($_REQUEST['page']) ? filter_var($_REQUEST['page'], FILTER_SANITIZE_NUMBER_INT) : 1,
            'total' => count($arrAllData)
        );

        $arrAllDataPagination = $this->model->getAll($params);
        $reData = array();
//        foreach ($arrAllDataPagination as $object) {
//            $order[$object['order_id']] = array(
//                'orderId' => (int)$object['order_id'],
//                'note' => $object['note'],
//                'date' => $object['date'],
//                'status' => (int)$object['status']
//            );
//            foreach ($arrAllDataPagination as $object2) {
//                if ($object['order_id'] == $object2['order_id']) {
//                    $order[$object['order_id']]['cart'] = array('productId' => $object2['product_id'], 'quantity' => $object2['quantity']);
//                }
//            }
//            $reData[]=$order;
//        }
        foreach ($arrAllDataPagination as $object) {
            $cart = $this->model->getCart($object['id']);
            $reData[] = array(
                'orderId' => (int) $object['id'],
                'note' => $object['note'],
                'date' => $object['date'],
                'status' => (int) $object['status'],
                'cart' => $cart
            );
        }
        $result = array(
            "status" => true,
            'data' => $reData,
        );

//        foreach ($result as )
        $result = array_merge($params, $result);
        $this->showJson($result);
    }

    /**
     * @api {get} /product/:id Detail
     * @apiName Detail
     * @apiGroup Order
     *
     * @apiParam {Number} id Orders unique ID.
     *
     * @apiSuccess {String} data Firstname of the Order.
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *       "status": true,
     *       "message": "200",
     *       "data": [],
     *     }
     *
     * @apiError OrderNotFound The id of the Order was not found.
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
            $cart = $this->model->getCart($arrSingleObject['id']);
            $reData = array(
                'orderId' => (int) $object['id'],
                'note' => $arrSingleObject['note'],
                'date' => $arrSingleObject['date'],
                'status' => (int) $arrSingleObject['status'],
                'cart' => $cart
            );
            $result = array(
                "status" => true,
                'data' => $reData,
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
     * @api {post} /product Add
     * @apiName Add
     * @apiGroup Order
     *
     * @apiParam {String} cart Stringify cart object 
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
     * @apiError OrderNotFound The id of the Order was not found.
     *
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 404 Not Found
     *     {
     *       "status": false,
     *       "message": "Please input require field {email}"
     *     }
     */
    function add() {
        $this->requireFields = array('cart', 'date');
        if (!$this->checkAPI('POST')) {
            $this->showJson();
            return;
        }
        $cart = (array) json_decode($_POST['cart']);
        $status = true;
        $mes = "something wrong! please contact admin!";
        if (!$cart) {
            $status = false;
            $mes = 'cart invalid! eg {"1":2,"3":2}';
        } else {
            $params = array();
            foreach ($cart as $productId => $quantity) {
                if (!$this->model->checkProduct($productId)) {
                    $status = false;
                    $mes = 'product_id not found {' . $productId . '}';
                    break;
                }
            }
        }
//        $params[] = "(" . "'" . $time . "'," . "'" . $this->token->user . "'," . "'" . $productId . "'," . "'" . $quantity . "'," . "'" . $_POST['date'] . "'," . "'" . $node . "')";
        $order = array(
            'user_id' => $this->token->user,
            'date' => $_POST['date'],
            'note' => isset($_POST['note']) ? $_POST['note'] : ''
        );
        if ($status) {
            $id = $this->model->add($order, $cart);
            if ($id) {
                $status = true;
                $mes = "Create order success";
            }
        }
        $result = array(
            "status" => $status,
            "message" => $mes,
        );
        $this->showJson($result);
    }

    /**
     * @api {put} /product Update  
     * @apiName Update
     * @apiGroup Order
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
    function update($id) {
        $this->requireFields = array('cart', 'date');
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
        $cart = (array) json_decode($put_vars['cart']);

        $status = true;
        $mes = "something wrong! please contact admin!";
        if (!$cart) {
            $status = false;
            $mes = 'cart invalid! eg {"1":2,"3":2}';
        } else {

            $params = array();
            foreach ($cart as $productId => $quantity) {
                if (!$this->model->checkProduct($productId)) {
                    $status = false;
                    $mes = 'product_id not found {' . $productId . '}';
                    break;
                }
            }
        }
//       var_dump($cart);die;
        if ($this->model->update($id, $cart)) {
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
     * @api {put} /product/updateStatus/:id UpdateStatus 
     * @apiName Update
     * @apiGroup Order
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
    function updateStatus($id) {
        $this->requireFields = array('status');
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
        $status = false;
        $mes = "something wrong! please contact admin!";
        if ($this->model->updateStatus($id, $put_vars['status'])) {
            $mes = "success";
            $status = true;
        }
        $result = array(
            "status" => $status,
            'message' => $mes,
        );
        $this->showJson($result);
    }

    /**
     * @api {delete} /product/:id Delete 
     * @apiName Delete
     * @apiGroup Order
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
     * @api {delete} /product/:listId deleteMulti
     * @apiName deleteMulti
     * @apiGroup Order
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
     * @apiError OrderNotFound The id of the Order was not found.
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