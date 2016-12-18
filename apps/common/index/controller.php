<?php

class Index extends Controller {

    function __construct() {
        parent::__construct('admin', 'index');
    }
    function index() {
        $result = array(
            "status" => true,
            "message" => "WellCome to NANO API!"
        );
        header('Content-Type: application/json');
        echo json_encode($result);
    }
}

?>