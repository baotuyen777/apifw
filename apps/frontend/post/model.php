<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class postModel extends Model {

    public function __construct() {
        parent::__construct();
    }

  
    public function getAllPost($filter) {
        $cond= $filter!="" ? ' AND post_title like "%'.$filter.'%"' : "";
        $sql = 'SELECT * FROM wp_posts '
                . 'WHERE post_type="post" and post_status= "publish"'.$cond;
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }


}

?>
