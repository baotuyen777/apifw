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
            if ($email && $password) {
                $result = $this->model->login($email, $password);
            }
//            $result = array(
//                "status" => true,
//                "message" => "Login success"
//            );
        } else {
            $result = array(
                "status" => false,
                "message" => "Please use method post"
            );
        }
        header('Content-Type: application/json');
        echo json_encode($result);
    }

    function logout($abc) {
        $this->model->logout();
    }

}

?>