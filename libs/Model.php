<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

abstract class Model {

    public $db;
    protected $lang;

    function __construct() {
        $this->db = new PDO(DB_DSN, DB_USER, DB_PASS);
        $this->lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'vi';
    }

    /**
     * 
     * @param type $sql
     * @param type $params
     * @return type
     */
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

    /**
     * 
     * @param type $id
     * @return type
     */
    function getUserById($id) {
        $sql = 'SELECT ID, user_login, user_email, user_status, display_name FROM wp_users WHERE ID= :id';
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $result = $stmt->fetchObject();
        return $result;
    }

    /**
     * 
     * @param type $id
     * @return type
     */
    public function getUserByEmail($email) {
        $sql = "SELECT ID as id FROM " . $this->table . " WHERE user_email=:email ";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":email", $email);
        $stmt->execute();
        $result = $stmt->fetchObject();
        return $result;
    }

    function transforms($result) {
        return array_map([$this, 'transform'], $result);
    }

    function transform($result) {
        $adapter = array_flip($this->adapter);
        $data = array();  // set up a return array
        foreach ($result as $k => $v) {
            foreach ($adapter as $virtual => $real) {
                if ($k == $virtual) {
                    $data[$real] = $v;
                }
            }
        }
        return $data;
    }

    function transformInvert($result) {
        $adapter = ($this->adapter);
        $data = array();  // set up a return array
        foreach ($result as $k => $v) {
            foreach ($adapter as $virtual => $real) {
                if ($k == $virtual) {
                    $data[$real] = $v;
                }
            }
        }
        return $data;
    }

//    function transform($object) {
//        return [
//            'id' => $object['ID'],
//            'password' => $object['user_pass'],
//            'email' => $object['user_email'],
//            'name' => $object['display_name']
//        ];
//    }
}

?>
