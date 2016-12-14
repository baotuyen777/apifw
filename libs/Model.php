<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Model { //abstract

    public $db;
    protected $lang;

    function __construct() {
        $conn = new mysqli(DB_HOST, DB_HOST, DB_PASS);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $this->db = $conn;
        $this->lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'vi';
    }

    function getRow($table, $arrField = "*", $where=array()) {
        $sql = "SELECT $arrField FROM $table WHERE ";
    }

    public function qry_all_category() {
        $sql = "select * from t_cms_cate where C_ACTIVE_CATE=1   order by C_ORDER";
        return $this->db->getAssoc($sql);
    }

    public function qry_all_root_category() {
        $sql = "select * from t_cms_cate where C_PARENT=0";
        return $this->db->getAll($sql);
    }

//    public function qry_all_news_by_hl($hl) {
//        $sql = "select * from  t_cms_news Where C_HIGHT_LIGHT=? ";
//        return $this->db->getrow($sql, array($hl));
//    }
//
//    public function qry_all_news_by_hl3() {
//        $sql = "select * from  t_cms_news Where C_HIGHT_LIGHT=3 LIMIT 6";
//        return $this->db->getAll($sql);
//    }

    public function qry_all_news_new() {
        $sql = "select * from t_cms_person as PS INNER JOIN t_cms_news as N ON E.pk_person=PS.fk_person ";
        $sql.="ORDER BY N.C_DATE LIMIT 3";
        return $this->db->getAll($sql);
    }

    public function qry_all_news_hot() {
        // $this->db->debug=1;
        $sql = "SELECT * FROM t_cms_news AS N  where  C_LANG=?
                ORDER BY N.C_VIEWS DESC limit 5 ";
        return $this->db->getAll($sql, $this->lang);
    }

    public function up_views($v_views, $news_id) {
        //$this->db->debug=1;
        $sql = "UPDATE t_cms_news set C_VIEWS=? where PK_NEWS=?";
        $this->db->Execute($sql, array($v_views, $news_id));
    }

    /**
     * 
     * @param type $v_pos tren dau=1 ben phai=2
     * @return type
     */
    public function qry_adv($v_pos) {
        $sql = 'select * from t_cms_adv where C_ACTIVE=1 And C_POS=?';
        return $this->db->getAll($sql, array($v_pos));
    }

    public function qry_type() {
        //  $this->db->debug=1;
        $sql = 'select * from t_cms_type where C_TYPE_ACTIVE=1';
        return $this->db->getAll($sql);
    }

    /**
     * 
     * @param type $type
     * @param type $is_getAll
     * @return array
     */
    public function qry_all_news_feature() {
        //$this->db->debug=10;
        $sql = "SELECT * FROM t_cms_news N 
                INNER JOIN t_cms_type T
                ON N.FK_TYPE=T.PK_TYPE Where PK_TYPE=1  And C_LANG=? ORDER BY N.PK_NEWS DESC LIMIT 5
        ";
        return $this->db->GetAll($sql, $this->lang);
    }

    //tin anh
    public function qry_all_news_image($hight_light = 0) {
        // $this->db->debug=10;
        if ($hight_light == 1) {
            $sql = "SELECT * FROM t_cms_news N 
                INNER JOIN t_cms_type T
                ON N.FK_TYPE=T.PK_TYPE Where PK_TYPE=4 And C_LANG=? order by N.PK_NEWS DESC
            ";
            return $this->db->GetRow($sql, $this->lang);
        }
        $sql = "SELECT * FROM t_cms_news N 
                INNER JOIN t_cms_type T
                ON N.FK_TYPE=T.PK_TYPE Where PK_TYPE=4  And C_LANG=?
        ";

        return $this->db->GetAll($sql, $this->lang);
    }

//qry tin nổi bật
    public function qry_single_news_hight_light_in_cate($cate_id = "") {
        // $this->db->debug=10;
        $sql = "SELECT * FROM t_cms_news N 
                INNER JOIN t_cms_type T
                ON N.FK_TYPE=T.PK_TYPE
                INNER JOIN t_cms_cate_news CN ON N.PK_NEWS=CN.FK_NEWS
                INNER JOIN t_cms_cate CT ON CT.PK_CATE=CN.FK_CATE 
                 Where T.PK_TYPE=2 And CT.PK_CATE=? And N.C_ACTIVE=1  And C_LANG=? 
                 order by N.PK_NEWS DESC LIMIT 0,1
        ";
        if ($cate_id != "") {
            return $this->db->GetRow($sql, array($cate_id, $this->lang));
        } else {
            return false;
        }
    }

    public function qry_single_news_hight_light_in_cate_auto($cate_id = "") {//tự động lấy hight_light nếu ko có tin nổi bật
        //  $this->db->debug=10;
        $sql = "SELECT * FROM t_cms_news N 
                INNER JOIN t_cms_type T
                ON N.FK_TYPE=T.PK_TYPE
                INNER JOIN t_cms_cate_news CN ON N.PK_NEWS=CN.FK_NEWS
                INNER JOIN t_cms_cate CT ON CT.PK_CATE=CN.FK_CATE 
                 Where CT.PK_CATE=? And N.C_ACTIVE=1  And C_LANG=?
                 order by N.PK_NEWS DESC
        ";
        if ($cate_id != "") {
            return $this->db->GetRow($sql, array($cate_id, $this->lang));
        } else {
            return false;
        }
    }

    //query tự động lấy 1 tin adv
    public function qry_single_adv($pos) {
        $sql = "SELECT * FROM t_cms_adv 
                 Where  C_ACTIVE=1 AND C_POS=?
                 order by PK_ADV DESC ";
        return $this->db->GetRow($sql, array($pos));
    }

    public function qry_all_news_in_cate($cate_id = "") {
        //  $this->db->debug=10;
        $sql = "SELECT * FROM t_cms_news N 
                INNER JOIN t_cms_type T
                ON N.FK_TYPE=T.PK_TYPE
                INNER JOIN t_cms_cate_news CN ON N.PK_NEWS=CN.FK_NEWS
                INNER JOIN t_cms_cate CT ON CT.PK_CATE=CN.FK_CATE
                Where CT.PK_CATE=? And T.PK_TYPE<>2 And N.C_ACTIVE=1 And C_LANG=?
                order by N.PK_NEWS DESC Limit 5
        ";
        if ($cate_id != "") {
            return $this->db->GetAll($sql, array($cate_id, $this->lang));
        } else {
            return false;
        }
    }

}

?>
