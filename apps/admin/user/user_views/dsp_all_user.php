<?php
/*
 * To change this tuserlate, choose Tools | Tuserlates
 * and open the tuserlate in the editor.
 */
/**
 * @var \view
 */
?>
<script type="text/javascript">
    
</script>
<div class="box box-color box-bordered">
    <div class="box-title">
        <h3>
            <i class="icon-th-large"></i>
            Quản lý người dùng
        </h3>

        <div class="pull-right">
            <div class="input-append">
                <input type="text" name="txtName" value="<?php
if (isset($_GET['txtName'])) {
    echo $_GET['txtName'];
}
?>">
                <button type="submit" formaction="" class="btn btn-light-grey">Tìm kiếm</button> &nbsp;
                <input type="button" class="btn btn-success" value="Thêm mới" onclick="redir('<?php echo SITE_ROOT ?>admin/user/dsp_single_user');">&nbsp;
                <input type="button" class="btn btn-danger" value="Xóa" onclick="onDelAll('<?php echo SITE_ROOT ?>admin/user/delete_user/');">
            </div>

        </div>
    </div>
    <div class="box-content">
        <div class="content">
            <div class="List">
                <table border="0" class="table table-hover">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Họ tên</th>
                            <th>Điện thoại</th>
                            <th>Email</th>
                            <th>địa chỉ</th>
                            <th>Giới tính</th>
                            <th>Ngày sinh</th>
                            <th>Ảnh đại diện</th>
                            <th colspan="">Action</th>
                            <th><input type="checkbox" name="masCheck" id="masCheck" onclick="checkAll()"></th>
                        </tr>
                    </thead>
                    <?php
                    // var_dump($this->get_controller_url());
                    Session::init();
                    $email = Session::get('email');
                    $recordSet = $this->recordSet;
                    if (!$recordSet) {
                        echo '<tr><td colspan="8">ko tim thay du lieu</td></tr> ';
                    } else {
                        $i=0;
                        foreach ($recordSet as $item) {
                            $i++;
                            ?>          
                            <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo $item["C_NAME"] ?></td>
                                <td><?php echo $item["C_PHONE"] ?></td>
                                <td><?php echo $item["C_EMAIL"] ?></td>
                                <td><?php echo $item["C_ADDRESS"] ?></td>
                                <td><?php
                            if ($item["C_GENDER"] == 1) {
                                echo "Nam";
                            } else {
                                echo "Nữ";
                            }
                            ?></td>
                                <td><?php echo $item["C_BIRTH"] ?></td>
                                <td><?php if (($item["C_AVATAR"]) != "") { ?>
                                            <img src="<?php echo SITE_ROOT . "public/img/user/" . $item["C_AVATAR"] ?>" width="50">
                                        <?php
                                        } else {
                                            echo "không có ảnh";
                                        }
                                        ?></td>
                                <td>
                                    <a href="javascript:void(0);" class="btn"
                                       onclick="onDelOne('<?php echo $item["PK_PERSON"]; ?>','<?php echo $item["C_NAME"] ?>','<?php echo SITE_ROOT ?>admin/user/delete_user/?id=<?php echo $item['PK_PERSON']; ?>');">
                                        <i class="icon-trash"></i>
                                    </a>&nbsp;
                                    <a href="<?php echo SITE_ROOT . "admin/user/dsp_single_user/?id=" . $item["PK_PERSON"] ?>" class="btn">
                                        <i class="icon-edit"></i>
                                    </a>&nbsp;
                                       <?php if ($item['C_ACTIVE_PERSON'] == 1) { ?>
                                        <a href="<?php echo SITE_ROOT . "admin/user/active_user/?id=" . $item['PK_PERSON'] . "&status=1" ?>" class="btn"
                                           title="Đang hoạt động"><i class="icon-ok"></i></a>&nbsp;
                                       <?php } else { ?>
                                        <a href="<?php echo SITE_ROOT . "admin/user/active_user/?id=" . $item['PK_PERSON'] . "&status=0" ?>" class="btn"
                                           title="Đã dừng hoạt động"><i class="icon-off"></i></a>&nbsp;
        <?php } ?>
                                </td>
                                
                                <td><a href=""><input type="checkbox" name="ick[]" id="ick[]" value="<?php echo $item["PK_PERSON"] ?>"></a></td>
                            </tr> 
                            <?php
                        }
                    }
                    ?>
                </table>
            </div>
            <div class="pagination pagination-centered">
                <ul>
                    <?php
                    $sotrang = $this->sotrang;
                    $prev = $this->prev;
                    $next = $this->next;
                    if ($prev != -1) {
                        echo "<li><a href='?p={$prev}'>Previous</a></li>";
                    } else {
                        echo "<li><a>Previous</a></li>";
                    }
                    for ($page = 1; $page <= $sotrang; $page++) {

                        echo "<li><a href='?p={$page}' class='pager_tuyen'>$page</a></li>";
                    }
                    if ($next != -1) {
                        echo "<li><a href='?p={$next}'>Next</a></li>";
                    } else {
                        echo "<li><a>Next</a></li>";
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>
