<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class authModel extends Model {

    public $table = "users";

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
        $sql = 'SELECT ID FROM ' . $this->table
                . ' WHERE email= :email AND password= :pass';
        $params = array(
            ":email" => $email,
            ":pass" => md5($password)
        );
        $id = $this->getVar($sql, $params);
        return $id;
    }

    public function resetPassword($user, $url) {
        $sql = "UPDATE " . $this->table . " SET activation_key =:key WHERE id = :id ";
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

        $sql = "UPDATE " . $this->table . " SET password=:pass, activation_key = :key";
        $sql .= " WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":pass", md5($password));
        $stmt->bindValue(":key", time());
        $stmt->bindValue(":id", $user->id);
        $result = $stmt->execute();
        return $result;
    }

    /**
     * 
     * @param type $param
     */
    public function register($params) {
        $sql = "INSERT INTO " . $this->table . " SET ";
        $count = count($params);
        $i = 0;
        foreach ($params as $field => $val) {
            $i++;

            $sql .= trim($field) . "='" . filter_var($val, FILTER_SANITIZE_STRING) . "'";
            if ($i !== $count) {
                $sql .= ", ";
            }
        }
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $this->db->lastInsertId();
    }

    public function logout() {
        echo 12121;
    }

}

?>
