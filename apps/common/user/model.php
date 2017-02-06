<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class UserModel extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function getAllUser($params = false) {
        $cond = "";
        $pagination = "";
        if ($params) {
            $cond = $params['filter'] ? ' AND display_name like "%' . filter_var($params['filter'], FILTER_SANITIZE_STRING) . '%"' : "";
            $countPage = ceil($params['total'] / $params['postPerPage']);
            $start = ($params['page'] - 1) * $params['postPerPage'];
            $pagination = "limit {$start},{$params['postPerPage']}";
        }

        $sql = "SELECT * FROM wp_users "
                . "WHERE 1=1 {$cond} {$pagination}";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * 
     * @param type $id
     * @return type
     */
    public function getSingleUser($id) {
        $sql = "SELECT * FROM wp_users WHERE ID=:id ";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * 
     * @param type $param
     */
    public function addUser($params) {
        $sql = "INSERT INTO wp_users SET ";
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

    /**
     * 
     * @param type $param
     */
    public function updateUser($id, $params) {
        $sql = "UPDATE wp_users SET ";
        $count = count($params);
        $i = 0;
        foreach ($params as $field => $val) {
            $i++;
            $sql .= trim($field) . "='" . filter_var($val, FILTER_SANITIZE_STRING) . "'";
            if ($i !== $count) {
                $sql .= ", ";
            }
        }
        $sql .= " WHERE ID= :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":id", $id);
        $result = $stmt->execute();
        return $result;
    }

    public function deleteUser($listId) {
        $sql = "DELETE FROM wp_users WHERE ID IN ($listId)";
        $stmt = $this->db->prepare($sql);
//        $stmt->bindValue(":listId", $listId);
        $result = $stmt->execute();
        return $result;
    }

}

?>
