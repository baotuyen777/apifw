<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class DateModel extends Model {

    public $table = "date";

    public function __construct() {
        parent::__construct();
    }

    public function getAll($params = false) {
        $cond = "";
        $pagination = "";
        if ($params) {
            $cond = $params['date'] ? ' AND date = ' . filter_var($params['date'], FILTER_SANITIZE_NUMBER_INT) : "";
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


    
    public function getSingle($date) {
        $sql = "SELECT *  FROM " . $this->table . " WHERE date=:date ";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":date", $date);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * 
     * @param type $param
     */
    public function add($date) {
        $sql = "INSERT INTO " . $this->table . " SET date=:date";
        var_dump($sql);
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':date', $date);
        $stmt->execute();
        return $this->db->lastInsertId();
    }

    /**
     * 
     * @param type $param
     */
    public function update($date, $status) {
        $sql = "UPDATE " . $this->table . " SET status=:status";

        $sql .= " WHERE date= :date";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":status", $status);
        $stmt->bindValue(":date", $date);
        $result = $stmt->execute();
        return $result;
    }

//    public function delete($listId) {
//        $sql = "DELETE FROM " . $this->table . " WHERE id IN ($listId)";
//        $stmt = $this->db->prepare($sql);
////        $stmt->bindValue(":listId", $listId);
//        $result = $stmt->execute();
//        return $result;
//    }

}

?>
