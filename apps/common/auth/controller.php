<?php

class authController extends Controller {

    public $auth;

    function __construct() {
        parent::__construct('common', 'auth');
    }

    function index() {
        $this->login();
    }

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

    function logout($abc) {
        $this->model->logout();
    }

}

?>