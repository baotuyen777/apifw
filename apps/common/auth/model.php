<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class authModel extends Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * 
     * @param type $email
     * @param type $pass
     * @return boolean
     */
    public function login($email, $password) {
        $sql = 'SELECT ID FROM wp_users '
                . 'WHERE user_email= :email AND user_pass= :pass';
        $params = array(
            ":email" => $email,
            ":pass" => md5($password)
        );
        $id = $this->getVar($sql, $params);
        return $id;
    }

    public function logout() {
        echo 12121;
    }

}

?>
