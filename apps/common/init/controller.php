<?php

class initController extends Controller {

    function __construct() {
        
    }

    function index() {
        
        $status = true;
        if (!$this->model->createProduct()) {
            $status = false;
        }
        if (!$this->model->createOrder()) {
            $status = false;
        }
        if (!$this->model->createOrderDetail()) {
            $status = false;
        }
        if (!$this->model->createUser()) {
            $status = false;
        }
         if (!$this->model->createDate()) {
            $status = false;
        }
        $result = array(
            "status" => $status,
            'message' => $status==true? "Generate DB successful" : "Command does not work(may be database gennerated)!",
        );
        $this->showJson($result);
    }

}

?>