<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class OrderModel extends Model {

    public $table = "orders";

    public function __construct() {
        parent::__construct();
    }

    public function getAll($params = false) {
        $condUser = "";
        $condUser = "";
        $pagination = "";
        if ($params) {
            $condUser = $params['user_id'] ? ' AND user_id = ' . $params['user_id'] : "";
            $condDate = $params['date'] ? ' AND date = ' . $params['date'] : "";
            $cond = $params['user_id'] ? ' AND user_id = ' . $params['user_id'] : "";
            $countPage = ceil($params['total'] / $params['postPerPage']);
            $start = ($params['page'] - 1) * $params['postPerPage'];
            $pagination = "limit {$start},{$params['postPerPage']}";
        }
//        var_dump($params);
        $sql = "SELECT * FROM " . $this->table //. " O INNER JOIN orders_detail OD ON O.id = OD.order_id "
                . " WHERE 1=1 {$condUser} {$condUser} {$pagination}";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return ($result);
    }

    public function getCart($order_id) {
        $sql = "SELECT *  FROM orders_detail WHERE order_id=:id ";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":id", $order_id);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
//        var_dump($result);die;
        return $result;
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
    public function add($order, $cart) {

        $sql = "INSERT INTO " . $this->table . " SET ";
        $count = count($order);
        $i = 0;
        $result = false;
        foreach ($order as $field => $val) {
            $i++;
            $sql .= trim($field) . "='" . filter_var($val, FILTER_SANITIZE_STRING) . "'";
            if ($i !== $count) {
                $sql .= ", ";
            }
        }
        $stmt = $this->db->prepare($sql);
        if ($stmt->execute()) {
            //insert orderdetal
            $orderId = $this->db->lastInsertId();
            $this->addCart($orderId, $cart);
        }
        return $result;
    }

    public function addCart($orderId, $cart) {
        $sqlOrderDetail = "INSERT INTO orders_detail(order_id,product_id,quantity) values ";
        $i = 0;
        $countCart = count($cart);
        foreach ($cart as $productId => $quantity) {
            $i++;
            $sqlOrderDetail .= "(" . $orderId . "," . $productId . "," . $quantity . ")";
            if ($i !== $countCart) {
                $sqlOrderDetail .= ", ";
            }
        }
        $stmtDetail = $this->db->prepare($sqlOrderDetail);
        $result = $stmtDetail->execute();
        return $result;
    }

    /**
     * 
     * @param type $param
     */
    public function update($orderId, $cart) {
        $result = false;
        if ($this->deleteCart($orderId)) {
            $result = $this->addCart($orderId, $cart);
        }
        return $result;
    }

    public function deleteCart($orderId) {
        $sql = "DELETE FROM orders_detail WHERE order_id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":id", $orderId);
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

    /**
     * 
     * @param type $id
     * @return type
     */
    public function checkProduct($id) {
        $sql = "SELECT *  FROM products WHERE id=:id ";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

}

?>