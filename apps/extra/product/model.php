<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class ProductModel extends Model {

 
    public $table = "products";

    public function __construct() {
        parent::__construct();
    }

    public function getAll($params = false) {
        $cond = "";
        $pagination = "";
        if ($params) {
            $cond = $params['filter'] ? ' AND name like "%' . filter_var($params['filter'], FILTER_SANITIZE_STRING) . '%"' : "";
            $countPage = ceil($params['total'] / $params['postPerPage']);
            $start = ($params['page'] - 1) * $params['postPerPage'];
            $pagination = "limit {$start},{$params['postPerPage']}";
        }

        $sql = "SELECT * FROM " . $this->table . " "
                . "WHERE 1=1 {$cond} {$pagination}";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return ($result);
    }

    /**
     * 
     * @param type $id
     * @return type
     */
    public function getSingle($id) {
        $sql = "SELECT *  FROM " . $this->table . " WHERE id=:id ";
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
    public function add($params) {
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

    /**
     * 
     * @param type $param
     */
    public function update($id, $params) {
        $sql = "UPDATE " . $this->table . " SET ";
        $count = count($params);
        $i = 0;
        foreach ($params as $field => $val) {
            $i++;
            $sql .= trim($field) . "='" . filter_var($val, FILTER_SANITIZE_STRING) . "'";
            if ($i !== $count) {
                $sql .= ", ";
            }
        }
        $sql .= " WHERE id= :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":id", $id);
        $result = $stmt->execute();
        return $result;
    }

    public function delete($listId) {
        $sql = "DELETE FROM " . $this->table . " WHERE id IN ($listId)";
        $stmt = $this->db->prepare($sql);
//        $stmt->bindValue(":listId", $listId);
        $result = $stmt->execute();
        return $result;
    }

}

?>
