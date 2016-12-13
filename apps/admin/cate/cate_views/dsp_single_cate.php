 <?php 
   // $data=$this->data;
  //  $item=$data[0];
    $model=new Model();
    $arr_all_cate=$model->qry_all_root_category();
    $arr_single_cate = $this->arr_single_cate;
 ?>

<div class="content">
    
    <form action="<?php echo SITE_ROOT?>admin/cate/update_cate" method="post" id="frmMain"
          class="form-bordered form-horizontal form-wysiwyg form-validate" enctype="multipart/form-data" >
        <input type="hidden" name="hdn_cate_id" 
               value="<?php if(isset($arr_single_cate['PK_CATE'])){echo $arr_single_cate['PK_CATE'];}?>">
        <div class="box box-bordered box-color">
            <div class="box-title"><h3>Cập nhật danh muc</h3> </div>
            <div class="box-content nopadding">
                <div class="control-group">
                    <div class="control-label">Danh mục gốc</div>
                    <div class="controls">
                        <select name="sel_parent" >
                            <option></option>
                            <?php foreach($arr_all_cate as $arr_single_category){?>
                            <?php $v_selected=$arr_single_cate['C_PARENT']==$arr_single_category['PK_CATE'] ? "selected" : ""?>
                            <option value="<?php echo $arr_single_category['PK_CATE']?>" <?php echo $v_selected?>>
                                <?php echo $arr_single_category['C_NAME']?></option>
                            <? } ?>
                        </select>
                        <span class="help-block">Không chọn hệ thống sẽ mặc định là danh mục gốc</span>
                    </div>
                </div>
                <div class="control-group">
                    <div class="control-label">Tên danh mục</div>
                    <div class="controls">
                        <input type="text" name="txtName" class="input-xxlarge" 
                               value="<?php if(isset($arr_single_cate['C_NAME'])) echo $arr_single_cate['C_NAME']?>"
                               data-rule-required="true" data-rule-minlength="2" id="txtTitle">
                    </div>
                </div>
                <div class="control-group">
                    <div class="control-label">Tên tiếng anh</div>
                    <div class="controls">
                        <input type="text" name="txtNameEn" class="input-xxlarge" 
                               value="<?php if(isset($arr_single_cate['C_NAME_EN'])) echo $arr_single_cate['C_NAME_EN']?>"
                               data-rule-required="true" data-rule-minlength="2" id="txtTitle">
                    </div>
                </div>
                <div class="control-group">
                    <div class="control-label">Sắp xếp</div>
                    <div class="controls">
                        <input type="number" name="txtOrder" id="txtOrder"
                               value="<?php if(isset($arr_single_cate['C_ORDER'])) echo $arr_single_cate['C_ORDER']?>"  >
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
