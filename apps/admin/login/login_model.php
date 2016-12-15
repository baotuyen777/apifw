<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Login_Model extends Model {

    public function __construct() {
        parent::__construct();
        // echo "111";
    }

    public function login() {
echo 1111;
        $email = $_POST['txtEmail'];
        $pass = $_POST['txtPass'];
        $this->getAll("SELECT * FROM user");
        
        return;
        $data = $this->db->getAll("SELECT * FROM user ");


        $count = count($data);
        if ($count > 0) {
            $person_id = ($data['PK_PERSON']);
            //login - SS có 2 bước : gán, gọi, sử dụng như 1 biến bt => lưu trữ thông tin
            Session::init(); //khoi tao ss
            Session::set('role', $data['C_ROLE']); //thiet lap, gan ss
            Session::set('id', $person_id);
            Session::set('avatar', $data['C_AVATAR']);
            Session::set('loggedIn', true); //gán
            Session::set('email', $email);
            return true;
        } else {
            echo "<script>alert('Email hoặc mật khẩu không đúng!!');</script>";
            return FALSE;
        }
    }

}

?>
