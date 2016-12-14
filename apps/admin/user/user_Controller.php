<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class User extends Controller {

    function __construct() {
        parent::__construct('admin', 'user');
        Session::init();
        $user = Session::get('loggedIn');

        if ($user == FALSE) {
            Session::destroy();
            $this->redir(SITE_ROOT . "login");
            exit;
        }
        $role = Session::get("role");
        if ($role > 1) {
            die('Bạn không có quyền thực hiện chức năng này');
        }
        $this->view->active_menu = "user";
    }

    function index() {
        $role = Session::get("role");
        $email = Session::get("email");
        if ($role == 1) {
            $this->dsp_all_user();
        } else {
            $this->dsp_single_user($email);
        }
    }

    function dsp_all_user() {
        if (isset($_GET['p']) && (int) $_GET['p']) {
            $page = $_GET['p'];
        } else {
            $page = 1;
        }
        $display = 5;
        $pager = $this->model->qry_all_user($page, $display);
        $recordSet = $pager['recordSet'];
        $sotrang = $pager['sotrang'];
        if ($page <= $sotrang && $page > 1) {
            $prev = $page - 1;
        } else {
            $prev = -1;
        }
        if ($page < $sotrang) {
            $next = $page + 1;
        } else {
            $next = -1;
        }
        $this->view->prev = $prev;
        $this->view->next = $next;
        $this->view->sotrang = $sotrang;
        $this->view->recordSet = $recordSet;
        $this->view->render('dsp_all_user');
    }

    function dsp_single_user() {
        @$id = $_GET['id'];
        $data = $this->model->qry_single_user($id);
        $this->view->arr_single_user = $data;
        $this->view->render("dsp_single_user");
    }

    function update_user() {
        $this->model->update_user();
        $this->redir(SITE_ROOT . "admin/user");
    }

    function delete_user() {
        $this->model->delete_user();
        $this->redir(SITE_ROOT."admin/user");
    }

    function active_user() {
        $this->model->active_user();
        $this->redir(SITE_ROOT . "admin/user");
    }

    function change_pass() {
        $this->model->change_pass();
        $this->redir(SITE_ROOT . "admin/user");
    }

}

?>
