<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class authModel extends Model {

    public function __construct() {
        parent::__construct();
        // echo "111";
    }

    /**
     * 
     * @param type $email
     * @param type $pass
     * @return boolean
     */
    public function login($email, $password) {
        $sql = 'SELECT count(*) FROM wp_users '
                . 'WHERE user_email= :email AND user_pass= :pass';
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':pass', $password);
        $stmt->execute();
        $result = $stmt->fetchAll();
        var_dump($result);

        if ($count > 0) {
//            $person_id = ($data['PK_PERSON']);
            return true;
        } else {
            return FALSE;
        }
    }

    public function logout() {
        echo 12121;
    }

}

?>
