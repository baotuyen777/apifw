<?php
$arr_all_cate=$this->arr_all_cate;
        $model=new Model();
    $arr_all_category=$model->qry_all_category();
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
                <input type="button" class="btn btn-success" value="Add News" onclick="redir('<?php echo SITE_ROOT?>admin/cate/dsp_single_cate');">&nbsp;
                <input type="button" class="btn btn-danger" value="Delete" 
                       onclick="onDelAll('<?php echo SITE_ROOT ?>admin/cate/delete_cate/');">
            </div>
            
        </div>
    </div>
    <div class="box-content">
        <div class="content">
            <div class="List">
                <table border="0" class="table table-hover">
                    <tr>
                        <th>STT</th>
                        <th width="15%">Tên danh muc</th>
                        <th>Cấp độ</th>
                        <th width="15%">Ngày tạo</th>
                        <th colspan="">Action</th>
                        <th>
                            <input type="checkbox" name="masCheck" id="masCheck" onclick="checkAll()" 
                                    >
                            <!--<input type="checkbox" name="masCheck" id="masCheck" onclick="checkAll()">-->
                            </th>
                    </tr>
                    <?php
                    if (!$arr_all_cate) {
                        echo '<tr><td colspan="8">ko tim thay du lieu</td></tr> ';
                    } else {
                        foreach ($arr_all_cate as $item) {
                            ?>          
                            <tr>
                                <td><?php echo $item["PK_CATE"] ?></td>
                                <td><?php echo $item["C_NAME"] ?></td>
                                <td>
                                    <?php 
                                    if($item["C_PARENT"]==0){
                                        echo 'Danh mục gốc';
                                    }  else {
                                        foreach ($arr_all_category as $arr_single_cate){
                                            if($arr_single_cate['PK_CATE']==$item['C_PARENT']){
                                                echo $arr_single_cate['C_NAME'];
                                                break;
                                            }
                                        }
                                    }
                                        
                                        ?>
                                </td>
                                <td><?php echo $item["C_DATE_CATE"] ?></td>
                                <td>
                                    <a href="javascript:void(0);" class="btn"
                                       onclick="onDelOne('<?php echo $item["PK_CATE"]; ?>','<?php echo $item["C_NAME"] ?>','<?php echo SITE_ROOT?>admin/cate/delete_cate/?id=<?php echo $item['PK_CATE'];?>');">
                                        <i class="icon-trash"></i>
                                    </a>&nbsp;
                                    <a href="<?php echo SITE_ROOT."admin/cate/dsp_single_cate/?id=".$item["PK_CATE"] ?>" class="btn">
                                        <i class="icon-edit"></i>
                                    </a>&nbsp;
                                    <?php if($item['C_ACTIVE_CATE']==1){?>
                                    <a href="<?php echo SITE_ROOT."admin/cate/active_cate/?id=".$item['PK_CATE']."&status=1"?>" class="btn"
                                       title="Đang hoạt động"><i class="icon-ok"></i></a>&nbsp;
                                    <?php }else{ ?>
                                       <a href="<?php echo SITE_ROOT."admin/cate/active_cate/?id=".$item['PK_CATE']."&status=0"?>" class="btn"
                                          title="Đã ngừng hoạt động"><i class="icon-off"></i></a>&nbsp;
                                    <?php }?>
                                </td>
                                <td>
                                    <input type="checkbox" name="ick[]"  value="<?php echo $item["PK_CATE"] ?>"
                                   >
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
