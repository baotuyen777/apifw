<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class errorController extends Controller {

    function __construct() {
        parent::__construct('admin', 'error');

        $result = array(
            "status" => false,
            "message" => "URL not found"
        );
        header('Content-Type: application/json');
        echo json_encode($result);
    }

}

?>
