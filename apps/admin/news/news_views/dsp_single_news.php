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
        <input type="hidden" name="hdn_news_id" 
               value="<?php if (isset($arr_single_news['PK_NEWS'])) echo $arr_single_news['PK_NEWS'] ?>">
        <input type="hidden" name="hdn_cate_news_id" 
               value="<? if (!empty($arr_single_news)) echo $arr_single_news['PK_CATE_NEWS'] ?>">
        <input type="hidden" name="hdn_cate_old_id" value="<?php echo $arr_single_news['FK_CATE'] ?>">
        <div class="box box-bordered box-color">
            <div class="box-title"><h3>Cập nhật tin tuc</h3> </div>
            <div class="box-content nopadding">
                <div class="control-group">
                    <div class="control-label">Danh mục</div>
                    <div class="controls">
                        <select name="sel_cate" class="input-xxlarge" >
                            <option></option>
                            <?php
                            foreach ($arr_all_cate as $arr_single_cate) {
                                $v_selected = $arr_single_news['FK_CATE'] == $arr_single_cate['PK_CATE'] ? "selected" : "";
                                if ($arr_single_cate['C_PARENT'] == 0) {
                                    ?>
                                    <optgroup label="<?php echo $arr_single_cate['C_NAME'].'('.$arr_single_cate['C_NAME_EN'].')' ?>" <?php echo $v_selected ?>>
                                        <?php
                                        $id_paraent = $arr_single_cate['PK_CATE'];
                                        foreach ($arr_all_cate as $arr_single_sub_cate) {
                                            if ($arr_single_sub_cate['C_PARENT'] == $id_paraent) {
                                                $v_selected = $arr_single_news['FK_CATE'] == $arr_single_sub_cate['PK_CATE'] ? "selected" : "";
                                                ?>
                                                <option value="<?php echo $arr_single_sub_cate['PK_CATE'] ?>" <?php echo $v_selected ?>>
                                                    <?php echo '--' . $arr_single_sub_cate['C_NAME'].'('.$arr_single_sub_cate['C_NAME_EN'].')' ?>
                                                </option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </optgroup>
                                    <?php
                                }
                            }
                            ?>
                        </select>
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
                <div class="control-group">
                    <div class="control-label">Loại tin</div>
                    <div class="controls">
                        <select name="sel_type">
                            <option></option>
                            <?php
                            $arr_all_type = $model->qry_type();
                            foreach ($arr_all_type as $arr_single_type) {
                                ?>
                                <?php $v_selected = $arr_single_news['FK_TYPE'] == $arr_single_type['PK_TYPE'] ? "selected" : "" ?>
                                <option value="<?php echo $arr_single_type['PK_TYPE'] ?>" <?php echo $v_selected ?>>
                                    <?php echo $arr_single_type['C_TYPE_NAME'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <div class="control-label">Ngôn ngữ</div>
                    <div class="controls">
                        <select name="sel_lang">
                            <?php
                            $arr_lang=array('vi'=>'Tiếng việt','en'=>'English');
                            foreach ($arr_lang as $k=>$v) {
                               $v_selected = $arr_single_news['C_LANG'] == $k ? "selected" : "" ?>
                                <option value="<?php echo $k ?>" <?php echo $v_selected ?>><?php echo $v ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label for="textfield" class="control-label">IMG</label>
                    <div class="controls">
                        <div class="fileupload fileupload-new" data-provides="fileupload">
                            <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                <?php if (isset($arr_single_news['C_IMG'])) { ?>
                                    <img src="<?php echo SITE_ROOT ?>/public/img/news/<?php echo $arr_single_news['C_IMG'] ?>" />
                                <?php } else { ?>
                                    <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image" />
                                <?php } ?>
                            </div>
                            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                            <div>
                                <span class="btn btn-file"><span class="fileupload-new">Chọn ảnh</span><span class="fileupload-exists">Change</span>
                                    <input type="file" name='file_img' id="asd" /></span>
                                <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Xóa</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="control-label">Nội dung vắn tắt</div>
                    <div class="controls">
                        <textarea name="txtShortContent" rows="5" class="span11"
                                  ><?php if (isset($arr_single_news['C_SHORT_CONTENT'])) echo $arr_single_news['C_SHORT_CONTENT'] ?></textarea>
                    </div>
                </div>
                <div class="control-group">
                    <div class="control-label">Nội dung</div>
                    <div class="controls">
                        <textarea name="txtContent" cols="" rows="5" id="content_news"
                                  ><?php if (isset($arr_single_news['C_CONTENT'])) echo $arr_single_news['C_CONTENT'] ?></textarea>
                        <script type='text/javascript'>CKEDITOR.replace( 'content_news'); </script>
                        <script type="text/javascript">
                            CKEDITOR.replace('editor',{width: 752,height: 350, language: 'vi',
                                filebrowserBrowseUrl: '../js/ckfinder/ckfinder.html',
                                filebrowserImageBrowseUrl: '../js/ckfinder/ckfinder.html?Type=Images',
                                filebrowserFlashBrowseUrl: '../js/ckfinder/ckfinder.html?Type=Flash',
                                filebrowserUploadUrl: '../js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                                filebrowserImageUploadUrl: '../js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                                filebrowserFlashUploadUrl: '../js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
                            });
                            CKEDITOR.editorConfig = function( config ){
                                config.enterMode = CKEDITOR.ENTER_BR;
                            }
                        </script>
                    </div>
                </div>
                <div class="form-actions">
                    <?php
                    if (isset($arr_single_news['C_ACTIVE'])){
                        $v_disabled='';
                        if((Session::get('role')>1)&&($arr_single_news['C_ACTIVE']==1)){
                            $v_disabled= 'disabled';
                        }
                    }
                    ?>
                    <input type="submit" class="btn btn-primary" value="Cập nhật" <?php if (isset($v_disabled)) echo $v_disabled; ?>>
                    <input type="reset" class="btn">
                </div>
            </div>
        </div>
    </form>
</div>
