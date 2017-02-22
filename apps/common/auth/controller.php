<?php

class authController extends Controller {

    public $auth;

    function __construct() {
        parent::__construct();
    }

    function index() {
        $this->login();
    }

    /**
     * @api {post} /login Login 
     * @apiName Login
     * @apiGroup Auth
     *
     * @apiParam {String} email Email .
     *
     * @apiSuccess {String} password Password of the User.
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *       "status": "true",
     *       "message": "Login success",
     *       "token": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJkYXZpZGJ1aSIsImV4cCI6MTQ4NjQzMjQyMywidXNlciI6IjIifQ.cc705f8a13a9839ee685336ac682faf4",
     *       "data": {
     *          "ID": "2",
     *          "user_login": "tuyen",
     *          "user_email": "tuyen@gmail.com",
     *          "user_status": "0",
     *          "display_name": "tuyen"
     *      }
     *     }
     *
     * @apiError UserNotFound The id of the User was not found.
     *
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 404 Not Found
     *     {
     *         "status": false,
     *         "message": "Wrong {password} or {email}!"
     *     }
     */
    function login() {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $email = isset($_POST['email']) ? $_POST['email'] : false;
            $password = isset($_POST['password']) ? $_POST['password'] : false;
            $result = array(
                "status" => false,
                "message" => ""
            );
            if ($email && $password) {
                $id = $this->model->login($email, $password);
                if ($id) {
                    $userData = $this->model->getUserById($id);
                    $result = array(
                        "status" => true,
                        "message" => "Login success",
                        'token' => Helper::genarateToken($id),
                        'data' => $userData
                    );
                } else {
                    $result['message'] = "Wrong {password} or {email}!";
                }
            } else {
                $result['message'] = "Please add param {password} and {email}";
            }
        } else {
            $result['message'] = "Please use method post";
        }
        header('Content-Type: application/json');
        echo json_encode($result);
    }

    /**
     * @api {post} /logout Logout 
     * @apiName Logout
     * @apiGroup Auth
     *
     * @apiSuccess {String} password Password of the User.
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *       "status": "true",
     *       "message": "Logout success",
     *     }
     *
     * @apiError UserNotFound The id of the User was not found.
     *
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 404 Not Found
     *     {
     *         "status": false,
     *         "message": "Wrong {password} or {email}!"
     *     }
     */
    function logout() {
        $result = array(
            "status" => true,
            "message" => "Logout success"
        );
        header('Content-Type: application/json');
        echo json_encode($result);
    }

    /**
     * @api {post} /resetPassword1 resetPassword1 
     * @apiName resetPassword1
     * @apiGroup Auth
     *
     * @apiSuccess {String} email Email of the User.
     * @apiSuccess {String} url URL confirm send in mail.
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *       "status": "true",
     *       "message": "Success! please check your email",
     *     }
     *
     * @apiError UserNotFound The email of the User was not found.
     *
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 404 Not Found
     *     {
     *         "status": false,
     *         "message": "email not exist!"
     *     }
     */
    public function resetPassword1() {
        $status = false;
        $mes = 'something wrong! please contact admin!';
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $status = true;
            if (!isset($_POST['email']) || !isset($_POST['url'])) {
                $mes = "email and url are required!";
                $status = false;
            } elseif (!filter_var($email = ($_POST["email"]), FILTER_VALIDATE_EMAIL)) {
                $mes = "Invalid email format";
                $status = false;
            } else if (!$user = $this->model->getUserByEmail($email)) {
                $status = false;
                $mes = 'email not exist!';
            }
            if ($status) {
                $data = $this->model->resetPassword($user, $_POST['url']);
                $mes = 'Success! please check your email';
            }
        } else {
            $result['message'] = "Please use method post";
        }
        $result = array(
            'status' => $status,
            'message' => $mes
        );
        $this->showJson($result);
    }

    /**
     * @api {post} /resetPassword2 resetPassword2 
     * @apiName resetPassword2
     * @apiGroup Auth
     *
     * @apiSuccess {String} key Key confirm in mail.
     * @apiSuccess {String} email Email .
     * @apiSuccess {String} password Password .
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *       "status": "true",
     *       "message": "Success! Your password has been reset",
     *     }
     *
     * @apiError UserNotFound The email of the User was not found.
     *
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 404 Not Found
     *     {
     *         "status": false,
     *         "message": "email not exist!"
     *     }
     */
    public function resetPassword2() {
        $this->requireFields = array('email', 'key', 'password');

        $mes = 'something wrong! please contact admin!';
        $status = true;
//        var_dump($_POST);
        if (!isset($_POST['email']) || !isset($_POST['key']) || !isset($_POST['password'])) {
            $mes = "email and key and password are required!";
            $status = false;
        } elseif (!filter_var($email = ($_REQUEST["email"]), FILTER_VALIDATE_EMAIL)) {
            $mes = "Invalid email format";
            $status = false;
        } else if (!$user = $this->model->getUserByEmail($email)) {
            $status = false;
            $mes = 'email not exist!';
        } else if ($user->activation_key !== $_REQUEST['key']) {
            $status = false;
            $mes = 'wrong key!';
        }
        if ($status) {
            if ($this->model->changePassword($user, filter_var($_REQUEST['password'], FILTER_SANITIZE_STRING))) {
                $mes = 'Success! Your password has been reset!';
            } else {
                $status = false;
            }
        }
        $result = array(
            'status' => $status,
            'message' => $mes
        );
        $this->showJson($result);
    }

    /**
     * @api {post} /auth Register
     * @apiName Register
     * @apiGroup Auth
     *
     * @apiParam {String} email Email unique id.
     * @apiParam {String} password Password .
     * @apiParam {String} name Name .
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
     * @apiError UserNotFound The id of the User was not found.
     *
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 404 Not Found
     *     {
     *       "status": false,
     *       "message": "Please input require field {email}"
     *     }
     */
    function register() {
        $this->requireFields = array('email', 'password', 'name');
        $status = false;
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $params = $_POST;
            $params['password'] = md5($_POST['password']);
            $email = ($_POST["email"]);
            //validate email

            $mes = "something wrong! please contact admin!";
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $mes = "Invalid email format";
            } else if ($this->model->getUserByEmail($email)) {
                $mes = "Email existed!";
            } else {
                $id = $this->model->register($params);
                if ($id) {
                    $mes = "Success";
                    $status = true;
                } else {
                    $mes = "Server overload!";
                }
            }
        } else {
            $mes = "Please use method post";
        }
        $result = array(
            "status" => $status,
            'message' => $mes,
        );
        $this->showJson($result);
    }

}

?>