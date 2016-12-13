 <?php 
    $arr_single_adv = $this->arr_single_adv;
 ?>

<div class="content">
    
    <form action="<?php echo SITE_ROOT?>admin/adv/update_adv" method="post" id="frmMain"
          class="form-bordered form-horizontal form-wysiwyg form-validate" enctype="multipart/form-data" >
        <input type="hidden" name="hdn_adv_id" 
               value="<?php if(isset($arr_single_adv['PK_ADV'])){echo $arr_single_adv['PK_ADV'];}?>">
        <div class="box box-bordered box-color">
            <div class="box-title"><h3>Cập nhật quảng cáo</h3> </div>
            <div class="box-content nopadding">
                
                <div class="control-group">
                    <div class="control-label">Tiêu đề</div>
                    <div class="controls">
                        <input type="text" name="txtTitle" class="input-xxlarge" 
                               value="<?php if(isset($arr_single_adv['C_TITLE'])) echo $arr_single_adv['C_TITLE']?>"
                               data-rule-required="true" data-rule-minlength="2" id="txtTitle">
                    </div>
                </div>
                <div class="control-group">
                    <div class="control-label">Link</div>
                    <div class="controls">
                        <textarea name="txtLink"
                                  ><?php if(isset($arr_single_adv['C_LINK'])) echo $arr_single_adv['C_LINK']?></textarea>
                    </div>
                </div>
                <div class="control-group">
                        <label for="textfield" class="control-label">IMG</label>
                        <div class="controls">
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                        <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                            <?php if(isset($arr_single_adv['C_IMG'])){?>
                                                <img src="<?php echo SITE_ROOT?>/public/img/adv/<?php echo $arr_single_adv['C_IMG'] ?>" />
                                            <?php }else{?>
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
                    <div class="control-label">Vị trí</div>
                    <div class="controls">
                        <select name="sel_pos">
                            <option></option>
                        <?php 
                            $arr_pos=array(1=>"Trên đầu",2=>'Bên phải');
                            foreach ($arr_pos as $k=>$v){?>
                            <?php 
                                $v_selected='';
                                if(isset($arr_single_adv['C_POS']))  {
                                $v_selected= $arr_single_adv['C_POS']==$k ? "selected" :""?><?php }
                        ?><option value="<?php echo $k ?>" <?php echo $v_selected?>><?php echo $v?></option>
                          <?php  }
                        ?>
                        </select>
                    </div>
                </div>
                <div class="form-actions">
                    <input type="submit" class="btn btn-primary" value="Cập nhật">
                    <input type="reset" class="btn">
                </div>
            </div>
        </div>
    </form>
</div>
