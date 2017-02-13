<?php

class initController extends Controller {

    function __construct() {
        
    }

    function index() {
        if (!$this->checkAPI('POST')) {
            $this->showJson();
            return;
        }
        $status = true;
        if (!$this->model->createProduct()) {
            $status = false;
        } 
        if (!$this->model->createOrder()) {
            $status = false;
        }
        $result = array(
            "status" => $status,
            'message' => "",
        );
        $this->showJson($result);
    }

}

?>