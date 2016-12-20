<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class postModel extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function getAllPost($params) {
        $cond = "";
        if ($params) {
            $cond = $params['filter'] ? ' AND post_title like "%' . filter_var($params['filter'], FILTER_SANITIZE_STRING) . '%"' : "";
            $countPage = $params['total'] / $params['limit'];
            $limit = ($params['page']-1) * $params['limit'];
        }

        $sql = "SELECT * FROM wp_posts "
                . "WHERE post_type='post' and post_status= 'publish' {$cond} limit {$limit},{$params['limit']}";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

}

?>
