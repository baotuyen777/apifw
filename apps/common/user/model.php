<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class UserModel extends Model {

    protected $adapter = array(
        'id' => 'ID',
        'email' => 'user_email',
        'password' => 'user_pass',
        'name' => 'display_name'
    );
    public $table = "wp_users";

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

        $sql = "SELECT ID, user_email, display_name FROM " . $this->table . " "
                . "WHERE 1=1 {$cond} {$pagination}";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $this->transforms($result);
    }

    /**
     * 
     * @param type $id
     * @return type
     */
    public function getSingleUser($id) {
        $sql = "SELECT ID, user_email, display_name  FROM " . $this->table . " WHERE ID=:id ";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $this->transform($result);
    }

    

    /**
     * 
     * @param type $param
     */
    public function addUser($put_vars) {
        $params = $this->transformInvert($put_vars);
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
    public function updateUser($id, $put_vars) {
        $params = $this->transformInvert($put_vars);

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
        $sql .= " WHERE ID= :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":id", $id);
        $result = $stmt->execute();
        return $result;
    }

    public function deleteUser($listId) {
        $sql = "DELETE FROM " . $this->table . " WHERE ID IN ($listId)";
        $stmt = $this->db->prepare($sql);
//        $stmt->bindValue(":listId", $listId);
        $result = $stmt->execute();
        return $result;
    }

//    function transform($result) {
//        return [
//            'id' => $result['ID'],
////            'password' => $result['user_pass'],
//            'email' => $result['user_email'],
//            'name' => $result['display_name']
//        ];
//    }
}

?>
