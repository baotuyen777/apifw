<?php
// $data=$this->data;form-wysiwyg 
//  $item=$data[0];
$model = new Model();
$arr_all_cate = $model->qry_all_category();
$arr_single_news = $this->arr_single_news;
?>

<div class="content">

    <form action="<?php echo SITE_ROOT ?>admin/news/do_update_news" method="post" id="frmMain"
          class="form-bordered form-horizontal form-validate" enctype="multipart/form-data" >
        <div class="box box-bordered box-color">
            <div class="box-title"><h3>Cập nhật tin tuc</h3> </div>
            <div class="box-content nopadding">
                <div class="control-group">
                    <div class="control-label">Danh mục</div>
                    <div class="controls">
                        
                    </div>
                </div>
                <div class="control-group">
                    <div class="control-label">Tiêu đề</div>
                    <div class="controls">
                        <input type="text" name="txtTitle" class="input-xxlarge" 
                               value="<?php if (isset($arr_single_news['C_TITLE'])) echo $arr_single_news['C_TITLE'] ?>"
                               data-rule-required="true" data-rule-minlength="2" id="txtTitle">
                    </div>
                </div>
                
             
            </div>
        </div>
    </form>
</div>
