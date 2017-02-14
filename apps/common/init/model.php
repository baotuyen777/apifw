<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class initModel extends Model {

    public function __construct() {
        parent::__construct();
    }

//    public function createStruct($params = false) {
//        $sql = "ALTER TABLE wp_users ADD avatar VARCHAR( 255 )";
//        $stmt = $this->db->prepare($sql);
//        $result = $stmt->execute();
//        return $result;
//    }

    public function createProduct() {
        $sql = "CREATE TABLE products (
            id INT (6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR (30) NOT NULL,
            slug VARCHAR (30) NOT NULL,
            price INT (11) NOT NULL,
            category INT (11) NOT NULL,
            description VARCHAR (255) NOT NULL,
            image VARCHAR (255),
            status INT (2) DEFAULT 1
          ) ;";

        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute();
        return $result;
    }

    public function createOrder() {
        $sql = "CREATE TABLE orders (
            id INT (6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            user_id INT (11) NOT NULL,
            date DATE NOT NULL,
            note VARCHAR (255) ,
            status INT (2) DEFAULT 1
          ) ;";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute();
        return $result;
    }

    public function createOrderDetail() {
        $sql = "CREATE TABLE orders_detail (
            id INT (6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            order_id INT (11) UNSIGNED NOT NULL ,
            product_id INT (11) NOT NULL,
            quantity INT (11) DEFAULT 1
          ) ;";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute();
        return $result;
    }

    public function createUser() {
        $sql = "CREATE TABLE users (
            id INT (6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            email VARCHAR(100) NOT NULL,
            password VARCHAR(100) NOT NULL,
            activation_key VARCHAR(100) ,
            name VARCHAR(100) NOT NULL,
            birthday DATE ,
            avatar VARCHAR(255) ,
            gender TINYINT   DEFAULT 1 ,
            role TINYINT DEFAULT 1,
            wallet  FLOAT DEFAULT 0,
            status INT (2) DEFAULT 1
          ) ;";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute();
        return $result;
    }

    public function createDate() {
        $sql = "CREATE TABLE date (
            id INT (6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            date DATE NOT NULL,
            status TINYINT  DEFAULT 1
          ) ;";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute();
        return $result;
    }

}

?>
