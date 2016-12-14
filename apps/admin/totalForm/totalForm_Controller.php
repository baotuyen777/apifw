<?php

    class TotalForm extends Controller{
        public function __construct() {
            parent::__construct();
        }
        public function index(){
            
            $this->view->render("totalForm","dsp_all_form");
        }
        public function dsp_modal(){
            $recordSet=$this->model->qry_all_news_admin();
            $this->view->recordSet=$recordSet;
            $this->view->render("totalForm","dsp_modal");
        }
        function dsp_all_news_admin(){
            $recordSet=$this->model->qry_all_news_admin();
            $this->view->recordSet=$recordSet;
            $this->view->render('totalForm','dsp_modal');
        }
    }
?>
