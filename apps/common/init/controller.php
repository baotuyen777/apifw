<?php

class initController extends Controller {

    function __construct() {
        
    }

    function index() {
        if (!$this->checkAPI('POST')) {
            $this->showJson();
            return;
        }
        $status = $this->model->createStruct();
        $result = array(
            "status" => $status,
            'message' => "",
        );
        $this->showJson($result);
    }

}

?>