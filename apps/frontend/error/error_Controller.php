<?php
class error extends Controller{
    function __construct() {
        parent::__construct('frontedn', 'err');
        echo "Xuất hiện lỗi,vui lòng xem lại đường dẫn";
    }
}
?>
