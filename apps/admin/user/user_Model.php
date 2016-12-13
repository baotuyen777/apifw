<?php

class User_Model extends Model {

    function __construct() {
        parent::__construct();
    }

    /**
     * Thuc hien query CSDL de lay danh sach user
     */
    public function qry_all_user($page, $display) {
        $recordSet = $this->db->Execute('select * from t_cms_person');
        // $this->db->debug = 1;

        $row = count($this->db->GetAll('select * from t_cms_person'));
        $sotrang = ceil($row / $display);
        if ($page <= $sotrang && $page > 0) {
            $start = $page * $display - $display;
        }
        $sql = "select * from t_cms_person ";

        $sql .= " ORDER BY pk_person DESC LIMIT ?,?";
        $recordSet = $this->db->GetAll($sql, array($start, $display));
        // GetAll,GetOne, GetRow
        $pager = array("recordSet" => $recordSet, "sotrang" => $sotrang);
        return $pager;
    }

    /**
     * Thuc hien query CSDL de lay thong tin chi tiet cua mot user
     */
    public function qry_single_user($id) {
        $sql = "select * from t_cms_person WHERE PK_PERSON=? ";
        return $this->db->Getrow($sql, array($id));
    }

    /**
     * Thuc hien cap nhat thong tin user vao CSDLs
     */
    public function update_user() {
        $this->db->debug = 1;
        if (isset($_POST)) {
            $user_id = $_POST['hdn_user_id'];
            var_dump($user_id);
            $pass = $_POST['txtPass'];
            $email = $_POST['txtEmail'];
            $name = $_POST['txtName'];
            $role = $_POST['sel_role'];
            $phone = $_POST['txtPhone'];
            $add = $_POST['txtAddress'];
            $birth = $_POST['txtBirth'];
            $gender = $_POST['txtGender'];



            $arr_img = $_FILES['file_img'];
            $v_file_name = $arr_img['name'];
            if ($arr_img['size'] > 5048000) {
                echo "<script>alert('Anh phai <5Mb');</script>";
                return FALSE;
            }
            $i = strrpos($v_file_name, ".");
            if ($i) {
                $l = strlen($v_file_name) - $i;
                $ext = strtolower(substr($v_file_name, $i + 1, $l));
                if (($ext != "jpg") && ($ext != "jpeg") && ($ext != "png") && ($ext != "gif")) {
                    echo "<script>alert('Định dạng file không hợp lệ');</script>";
                    return FALSE;
                }
            }
            if (move_uploaded_file($arr_img['tmp_name'], SERVER_ROOT . "public/img/user/$v_file_name")) {
                // return FALSE;
            }
            $arr_data = array(
                'C_NAME' => $name,
                'C_EMAIL' => $email,
                'C_PASS' => $pass,
                'C_ROLE' => $role,
                'C_BIRTH' => $birth,
                'C_ADDRESS' => $add,
                'C_PHONE' => $phone,
                'C_AVATAR' => $v_file_name
            );

            if ($user_id == "") {
                $find_email = $this->db->getOne("SELECT COUNT(*) FROM t_cms_person WHERE C_EMAIL=?", array($email));
                //var_dump($find_email);
                if ($find_email == 0) {
                    $this->db->AutoExecute('t_cms_person', $arr_data, 'INSERT');
                } else {
                    echo "<script>alert('Email đã tồn tại!');</script>";
                    return FALSE;
                }
            } else {
                if (empty($arr_img)) {
                    unset($arr_data['V_AVATAR']);
                }
                $this->db->AutoExecute('t_cms_person', $arr_data, 'UPDATE', 'PK_PERSON=' . $user_id);
            }

            //img
        } else {
            return FALSE;
        }
    }

    /**
     * Thuc hien xoa user khoi CSDL
     */
    public function delete_user() {
        //$this->db->debug = 1;

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $this->db->Execute("DELETE FROM t_cms_person WHERE PK_PERSON=?", array($id));
        }
        if (isset($_GET['listId'])) {
            $listId = $_GET['listId'];
            $this->db->Execute("DELETE FROM t_cms_person WHERE PK_PERSON in ($listId)");
        }
    }

    public function active_user() {
        //$this->db->debug = 1;
        $id = $_GET['id'];
        $v_status = $_GET['status'];
        if ($v_status == 0) {
            $sql = "update t_cms_person set C_ACTIVE_PERSON=1 where PK_PERSON=?";
        } else {
            $sql = "update t_cms_person set C_ACTIVE_PERSON=0 where PK_PERSON=?";
        }
        $this->db->Execute($sql, $id);
    }

    public function change_pass() {
        $person = $this->qry_single_user(Session::get('id'));

        $v_news_pass = $_POST['txtNewPass'];
        if ($person['C_PASS'] == $_POST['txtOldPass']) {
            $sql = "update t_cms_person set C_PASS=? where PK_PERSON=?";
        } else {
            echo "<script>alert('Mật khẩu hiện hành chưa đúng');</script>";
            return FALSE;
        }
        $this->db->Execute($sql, array($v_news_pass, $person['PK_PERSON']));
    }

}

?>
