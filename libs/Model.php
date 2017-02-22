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
        function getVar($sql, $params = array()) {
        $stmt = $this->db->prepare($sql);
        if (isset($params)) {
            $i = 0;
            foreach ($params as $k => $v) {
                $i++;
                $stmt->bindValue($k, $v);
            }
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
        $sql = 'SELECT id, activation_key, email,name,birthday,avatar,gender,role,wallet,status FROM users WHERE id= :id';
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
        $sql = "SELECT id, activation_key, email,name FROM users WHERE email=:email ";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":email", $email);
        $stmt->execute();
        $result = $stmt->fetchObject();
        return $result;
    }

//    function transforms($result) {
//        return array_map([$this, 'transform'], $result);
//    }
//
//    function transform($result) {
//        $adapter = array_flip($this->adapter);
//        $data = array();  // set up a return array
//        foreach ($result as $k => $v) {
//            foreach ($adapter as $virtual => $real) {
//                if ($k == $virtual) {
//                    $data[$real] = $v;
//                }
//            }
//        }
//        return $data;
//    }
//
//    function transformInvert($result) {
//        $adapter = ($this->adapter);
//        $data = array();  // set up a return array
//        foreach ($result as $k => $v) {
//            foreach ($adapter as $virtual => $real) {
//                if ($k == $virtual) {
//                    $data[$real] = $v;
//                }
//            }
//        }
//        return $data;
//    }
}

?>
