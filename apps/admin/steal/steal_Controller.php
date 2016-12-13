<?php
    class steal extends Controller{
        function __construct() {
            parent::__construct('admin', 'steal');
        }
        function index(){
            $this->model->steal_news();
        }
    }
    
?>
