<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Error_Controller extends Controller{
    function __construct() {
        parent::__construct('admin','error');
        echo "xuất hiện lỗi,vui lòng xem lại đường dẫn!!<br>";
    }
    
}
?>
