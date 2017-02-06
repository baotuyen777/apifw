<?php

class authController extends Controller {

    public $auth;

    function __construct() {
        parent::__construct('common', 'auth');
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
     * @api {post} /logout Login 
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

}

?>