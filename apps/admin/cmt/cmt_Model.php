<?php

class cmt_Model extends Model {

    public function qry_all_cmt($page) {
        //  $this->db->debug = 1;
        
        
        $display = 5;
        $row = $this->db->getOne('SELECT COUNT(*) FROM t_cms_cmt CM INNER JOIN t_cms_news N ON CM.FK_NEWS=N.PK_NEWS ');
        $sotrang = ceil($row / $display);
        $start = 0;
        if ($page <= $sotrang && $page > 0) {
            $start = $page * $display - $display;
        }

        $sql = "SELECT CM.*, N.C_TITLE FROM t_cms_cmt CM INNER JOIN t_cms_news N ON CM.FK_NEWS=N.PK_NEWS ";
        $sql .= " ORDER BY CM.PK_CMT DESC  LIMIT ?,?";
        $recordSet = $this->db->GetAll($sql, array($start, $display));
        $pager = array("recordSet" => $recordSet, "sotrang" => $sotrang);
        return $pager;
    }
    /**
     * Thuc hien xoa user khoi CSDL
     */
    public function delete_cmt() {
        $this->db->debug = 1;

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $this->db->Execute("DELETE FROM t_cms_cmt WHERE PK_CMT=?", array($id));
        }
        if (isset($_GET['listId'])) {
            $listId = $_GET['listId'];
            $this->db->Execute("DELETE FROM t_cms_cmt WHERE PK_CMT in (?)", array($listId));
        }
    }
    public function active_cmt() {

        $id = $_GET['id'];
        $v_status = $_GET['status'];
        if ($v_status == 0) {
            $sql = "update t_cms_cmt set C_ACTIVE=1 where PK_CMT=?";
        } else {
            $sql = "update t_cms_cmt set C_ACTIVE=0 where PK_CMT=?";
        }
        $this->db->Execute($sql, $id);
    }


}

?>
