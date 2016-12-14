<?php
$arr_all_adv=$this->arr_all_adv;
?>
<script type="text/javascript">
  
</script>
<form method="post">
<div class="box box-color box-bordered">
    <div class="box-title">
        <h3>
            <i class="icon-th-large"></i>
            Quản lý tin tức
        </h3>
       
        <div class="pull-right">
             <div class="input-append">
                <input type="text" name="txtName" value="<?php if (isset($_GET['txtName'])) {echo $_GET['txtName'];} ?>">
                <button type="submit" formaction="" class="btn btn-light-grey">Tìm kiếm</button> &nbsp;
                <input type="button" class="btn btn-success" value="Thêm mới" 
                       onclick="redir('<?php echo SITE_ROOT?>admin/adv/dsp_single_adv');">&nbsp;
                <input type="button" class="btn btn-danger" value="Xóa" 
                       onclick="onDelAll('<?php echo SITE_ROOT ?>admin/adv/delete_adv/');">
            </div>
            
        </div>
    </div>
    <div class="box-content nopadding">
        <div class="content">
            <div class="List">
                <table border="0" class="table table-hover">
                    <tr>
                        <th>STT</th>
                        <th width="15%">Tiêu đề</th>
                        <th width="15%">vị trí</th>
                        <th width="15%">Ngày tạo</th>
                        <th width="15%">Hình ảnh</th>
                        <th>Link</th>
                        <th colspan="">Action</th>
                        <th>
                            <input type="checkbox" name="masCheck" id="masCheck" onclick="checkAll()">
                            </th>
                    </tr>
                    <?php
                    if (!$arr_all_adv) {
                        echo '<tr><td colspan="8">ko tim thay du lieu</td></tr> ';
                    } else {
                        $i=1;
                        foreach ($arr_all_adv as $item) {
                            ?>          
                            <tr>
                                <td><?php echo $i; $i++; ?></td>
                                <td><?php echo $item["C_TITLE"] ?></td>
                                <td>
                                    <?php 
                                    if($item["C_POS"]==1){
                                        echo 'Trên đầu';
                                    }  else {
                                        echo 'Bên phải';
                                    }
                                        
                                        ?>
                                </td>
                                <td><?php echo $item["C_DATE"] ?></td>
                                <td><img src="<?php echo SITE_ROOT ?>public/img/adv/<?php echo $item["C_IMG"] ?>" width="40"></td>
                                <td><?php echo $item["C_LINK"] ?></td>
                                <td>
                                    <a href="javascript:void(0);" class="btn"
                                       onclick="onDelOne('<?php echo $item["PK_ADV"]; ?>','<?php echo $item["C_TITLE"] ?>','<?php echo SITE_ROOT?>admin/adv/delete_adv/?id=<?php echo $item['PK_ADV'];?>');">
                                        <i class="icon-trash"></i>
                                    </a>&nbsp;
                                    <a href="<?php echo SITE_ROOT."admin/adv/dsp_single_adv/?id=".$item["PK_ADV"] ?>" class="btn">
                                        <i class="icon-edit"></i>
                                    </a>&nbsp;
                                    <?php if($item['C_ACTIVE']==1){?>
                                    <a href="<?php echo SITE_ROOT."admin/adv/active_adv/?id=".$item['PK_ADV']."&status=1"?>" class="btn"
                                       title="Đang hoạt động"><i class="icon-ok"></i></a>&nbsp;
                                    <?php }else{ ?>
                                       <a href="<?php echo SITE_ROOT."admin/adv/active_adv/?id=".$item['PK_ADV']."&status=0"?>" class="btn"
                                       title="Đã dừng hoạt động"><i class="icon-off"></i></a>&nbsp;
                                    <?php }?>
                                </td>
                                <td>
                                    <input type="checkbox" name="ick[]"  value="<?php echo $item["PK_ADV"] ?>" >
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
