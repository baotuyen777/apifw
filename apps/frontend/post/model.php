<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class postModel extends Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * 
     * @param type $email
     * @param type $pass
     * @return boolean
     */
    public function getAllPost($filter) {
        $sql = 'SELECT * FROM wp_posts '
                . 'WHERE post_type="post" and post_status= "publish"';
        $stmt = $this->db->prepare($sql);
//        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function logout() {
        echo 12121;
    }

}

?>
