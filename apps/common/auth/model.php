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

    public function resetPassword($email) {
        $user = $this->getUserByEmail($email);
        if ($user) {
            $sql = "UPDATE " . $this->table . " SET user_activation_key =:key WHERE ID = :id ";
            $key = rand(1000, 9999);
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(":id", $user->id);
            $stmt->bindValue(":key", $key);
            $result = $stmt->execute();

            return array(
                'status' => true,
                'message' => 'Success! please check your email'
            );
        }
        return array(
            'status' => false,
            'message' => 'email not exist!'
        );
    }

    public function logout() {
        echo 12121;
    }

}

?>
