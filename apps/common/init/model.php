<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class initModel extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function createStruct($params = false) {
        $sql = "ALTER TABLE wp_users ADD avatar VARCHAR( 255 )";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute();
        return $result;
    }

}

?>
