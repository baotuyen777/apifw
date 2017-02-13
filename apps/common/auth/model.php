<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class authModel extends Model {

    protected $adapter = array(
        'id' => 'ID',
        'email' => 'user_email',
        'password' => 'user_pass',
        'name' => 'display_name'
    );
    public $table = "wp_users";

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

    public function resetPassword($user, $url) {
        $sql = "UPDATE " . $this->table . " SET user_activation_key =:key WHERE ID = :id ";
        $key = time();
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":id", $user->id);
        $stmt->bindValue(":key", $key);
        $stmt->execute();
        $url = $url . '?email=' . $user->email . '&key=' . $key;
        $content = "<html><body>"
                . "Please click below link to confirm reset password <br><br>"
                . "<a href='" . $url . "'>" . $url . "</a><br>"
                . "<p>If this is the mistake, please do not do anything!</p>"
                . "<p style='color:#ccc'>/***** This is email automatic send by zaiko system *****/<p>"
                . "</body></html>";

        Helper::sendMail($user->email, 'Reset password!', $content);
        return true;
    }

    /**
     * 
     * @param type $param
     */
    public function changePassword($user, $password) {

        $sql = "UPDATE " . $this->table . " SET user_pass=:pass, user_activation_key = :key";
        $sql .= " WHERE ID= :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":pass", md5($password));
        $stmt->bindValue(":key", time());
        $stmt->bindValue(":id", $user->id);
        $result = $stmt->execute();
        return $result;
    }

    public function logout() {
        echo 12121;
    }

}

?>
