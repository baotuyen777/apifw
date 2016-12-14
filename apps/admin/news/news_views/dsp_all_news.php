<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<script type="text/javascript">
  
</script>
<form method="get">
    <div class="box box-color box-bordered">
        <div class="box-title">
            <h3>
                <i class="icon-th-large"></i>
                Quản lý tin tức
            </h3>

            <div class="pull-right">
                <div class="input-append">
                    <input type="text" name="search" value="<?php
if (isset($_GET['txtName'])) {
    echo $_GET['txtName'];
}
?>">
                    <button type="submit" formaction="" class="btn btn-light-grey">Tìm kiếm</button> &nbsp;
                    <input type="button" class="btn btn-success" value="Add News" onclick="redir('<?php echo SITE_ROOT ?>admin/news/dsp_single_news');">&nbsp;
                    <input type="button" class="btn btn-danger" value="Delete" 
                           onclick="onDelAll('<?php echo SITE_ROOT ?>admin/news/delete_news/');">
                </div>

            </div>
        </div>
        <div class="box-content">
            <div class="content">
                <div class="List">
                    <table border="0" class="table table-hover">
                        <tr>
                            <th>STT</th>
                            <th width="15%">Tên người đăng</th>
                            <th>Tiêu đề</th>
                            <th>Loại tin</th>
                            <th>Ảnh</th>
                            <th width="">Ngày đăng</th>
                            <th width="">Lượt xem</th>
                            <th colspan="">Hành động</th>
                            <th>
                                <input type="checkbox" name="masCheck" id="masCheck" onclick="checkAll()">
                            </th>
                        </tr>
                        <?php
                        Session::init();
                        $email = Session::get('email');
                        $recordSet = $this->recordSet;
                       // var_dump($recordSet);
                        if (!$recordSet) {
                            echo '<tr><td colspan="8">ko tim thay du lieu</td></tr> ';
                        } else {
                            $i = 1;
                            foreach ($recordSet as $item) {
                                ?>          
                                <tr>
                                    <td><?php echo $i++; ?></td>
                                    <td><?php echo $item["C_NAME"] ?></td>
                                    <td><a href="<?php echo SITE_ROOT; ?>admin/news/dsp_single_news/?id=<?php echo $item['PK_NEWS']; ?>">
                                        <?php echo $item["C_TITLE"] ?></a></td>
                                    
                                    <td>
        <?php echo ($item['C_TYPE_NAME']); ?>
                                    </td>
                                    <td><?php if (($item["C_IMG"]) != "") { ?>
                                            <img src="<?php echo SITE_ROOT . "public/img/news/" . $item["C_IMG"] ?>" width="50">
                                        <?php
                                        } else {
                                            echo "không có ảnh";
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo $item["C_DATE"] ?></td>
                                    <td><?php echo $item["C_VIEWS"] ?></td>
                                    <td>
                                        <a href="javascript:void(0);" class="btn"
                                           onclick="onDelOne('<?php echo $item["PK_NEWS"]; ?>','<?php echo $item["C_TITLE"] ?>','<?php echo SITE_ROOT ?>admin/news/delete_news/?id=<?php echo $item['PK_NEWS']; ?>');">
                                            <i class="icon-trash"></i>
                                        </a>&nbsp;
                                        <?php if (Session::get('role')==1){?>
                                        <a href="<?php echo SITE_ROOT . "admin/news/dsp_single_news/?id=" . $item["PK_NEWS"] ?>" class="btn">
                                            <i class="icon-edit"></i>
                                        </a>&nbsp;<?php } else { 
                                            if($item['C_ACTIVE']!=1){?>
                                        <a href="<?php echo SITE_ROOT . "admin/news/dsp_single_news/?id=" . $item["PK_NEWS"] ?>" class="btn">
                                            <i class="icon-edit"></i>
                                        </a>&nbsp;
                                            <?php }?>
                                        <?php } ?>
                                           <?php if (Session::get('role') == 1) {
                                               if ($item['C_ACTIVE'] == 1) {
                                                   ?>
                                                <a href="<?php echo SITE_ROOT . "admin/news/active_news/?id=" . $item['PK_NEWS'] . "&status=1" ?>" class="btn"
                                                   title="Đang hoạt động"><i class="icon-ok"></i></a>&nbsp;
                                               <?php } else { ?>
                                                <a href="<?php echo SITE_ROOT . "admin/news/active_news/?id=" . $item['PK_NEWS'] . "&status=0" ?>" class="btn"
                                                   title="Đang chờ duyệt"><i class="icon-off"></i></a>&nbsp;
                                               <?php
                                               }
                                           } else {
                                               if ($item['C_ACTIVE'] == 1) {
                                                   ?>
                                                <a href="" class="btn" disabled onclick="alert('Chỉ tổng biên tập mới có quyền duyệt')"
                                                   title="Đang hoạt động"><i class="icon-ok"></i></a>&nbsp;
            <?php } else { ?>
                                                <a href="" class="btn" disabled onclick="alert('Chỉ tổng biên tập mới có quyền duyệt')"
                                                   title="Đang chờ duyệt"><i class="icon-off"></i></a>&nbsp;
                                    <?php } ?>
                                <?php } ?>
                                    </td>
                                    <td>
                                        <input type="checkbox" name="ick[]"  value="<?php echo $item["PK_NEWS"] ?>" >
                                    </td>
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
                            echo "<li  ><a disabled >Next</a></li>";
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</form>
