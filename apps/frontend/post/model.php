<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class postModel extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function getAllPost($params = false) {
        $cond = "";
        $pagination = "";
        if ($params) {
            $cond = $params['filter'] ? ' AND post_title like "%' . filter_var($params['filter'], FILTER_SANITIZE_STRING) . '%"' : "";
            $countPage = ceil($params['total'] / $params['postPerPage']);
            $start = ($params['page'] - 1) * $params['postPerPage'];
            $pagination = "limit {$start},{$params['postPerPage']}";
        }

        $sql = "SELECT * FROM wp_posts "
                . "WHERE post_type='post' and post_status= 'publish' {$cond} {$pagination}";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    /**
     * 
     * @param type $id
     * @param type $params
     * @return type
     */
    public function getSinglePost($id,$params = false) {
        $cond = "";
        if ($params) {
            $cond = $params['filter'] ? ' AND post_title like "%' . filter_var($params['filter'], FILTER_SANITIZE_STRING) . '%"' : "";
        }
        $sql = "SELECT * FROM wp_posts "
                . "WHERE post_type='post' and post_status= 'publish' AND ID={$id} {$cond}";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    public function addPost($param){
        
    }

}

?>
