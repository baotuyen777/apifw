<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Model { //abstract

    public $db;
    protected $lang;

    function __construct() {

        $this->db = new PDO(DB_DSN, DB_USER, DB_PASS);

        $this->lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'vi';
    }

    function getVar($sql, $params) {
        $stmt = $this->db->prepare($sql);
        $i = 0;
        foreach ($params as $k => $v) {
            $i++;
            $stmt->bindValue($k, $v);
        }
        $stmt->execute();
        $result = $stmt->fetchColumn();
        return $result;
    }

    function getUserById($id) {
        $sql = 'SELECT ID, user_login, user_email, user_status, display_name FROM wp_users WHERE ID= :id';
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $result = $stmt->fetchObject();
        return $result;
    }

}

?>
