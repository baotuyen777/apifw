<?php
// $data=$this->data;
//  $item=$data[0];
$arr_single_user = $this->arr_single_user;
?>

<div class="content">

    <form action="<?php echo SITE_ROOT ?>admin/user/update_user" method="post" id="frmMain"
          class="form-bordered form-horizontal form-wysiwyg form-validate" enctype="multipart/form-data" >
        <input type="hidden" name="hdn_user_id" 
               value="<?php if (isset($arr_single_user['PK_PERSON'])) echo $arr_single_user['PK_PERSON'];?>">
        <div class="box box-bordered box-color">
            <div class="box-title"><h3>Cập nhật danh muc</h3> </div>
            <div class="box-content nopadding">
                <div class="control-group">
                    <div class="control-label">Email</div>
                    <div class="controls">
                        <input type="email" name="txtEmail" value="<?php if(!empty($arr_single_user))echo $arr_single_user['C_EMAIL']; ?>">
                    </div>
                </div>
                <div class="control-group">
                    <div class="control-label">Mật khẩu</div>
                    <div class="controls">
                        <input type="password" name="txtPass" id="txtPas" class="input-xxlarge" data-rule-required="true" data-rule-minlength="2">
                    </div>
                </div>
                <div class="control-group">
                    <div class="control-label">Đánh lại mật khẩu</div>
                    <div class="controls">
                        <input type="password" class="input-xxlarge" equalTo="#txtPas"
                               data-rule-required="true" data-rule-minlength="2" >
                    </div>
                </div>
                <div class="control-group">
                    <div class="control-label">Họ tên</div>
                    <div class="controls">
                        <input type="text" name="txtName" class="input-xxlarge" 
                               value="<?php if (isset($arr_single_user['C_NAME'])) echo $arr_single_user['C_NAME'] ?>"
                               data-rule-required="true" data-rule-minlength="2" id="txtTitle">
                    </div>
                </div>
                <div class="control-group">
                    <div class="control-label">Địa chỉ</div>
                    <div class="controls">
                        <textarea type="text" name="txtAddress" class="input-xxlarge" 
                               data-rule-required="true" data-rule-minlength="2" id="txtAddress"
                               ><?php if (isset($arr_single_user['C_ADDRESS'])) echo $arr_single_user['C_ADDRESS'] ?></textarea>
                    </div>
                </div>
                <div class="control-group">
                    <label for="textfield" class="control-label">IMG</label>
                    <div class="controls">
                        <div class="fileupload fileupload-new" data-provides="fileupload">
                            <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                <?php if (isset($arr_single_user['C_AVATAR'])) { ?>
                                    <img src="<?php echo SITE_ROOT ?>/public/img/user/<?php echo $arr_single_user['C_AVATAR'] ?>" />
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
                    <div class="control-label">Giới tinh</div>
                    <div class="controls">
                        <?php $arr_gender=array(0=>'Nữ',1=>'Nam');
                        $checked='';
                        foreach ($arr_gender as $k=>$v):
                            if(!empty($arr_single_user)){
                               $checked=$arr_single_user['C_GENDER']==$k ? "checked" : "";
                            }
                        ?>
                        <label>
                            <input type="radio" name="txtGender" value="<?php echo $k;?>" <?php echo $checked ?>
                                   id="txtGender">
                        <?php echo $v?>
                        </label>
                        <?php endforeach;?>
                    </div>
                </div>
                <div class="control-group">
                    <div class="control-label">Ngày sinh</div>
                    <div class="controls">
                        <input type="date" name="txtBirth" class="input-xxlarge" 
                               value="<?php if (isset($arr_single_user['C_BIRTH'])) echo $arr_single_user['C_BIRTH'] ?>"
                               data-rule-required="true" data-rule-minlength="2" id="txtBirth">
                    </div>
                </div>
                <div class="control-group">
                    <div class="control-label">Số điện thoại</div>
                    <div class="controls">
                        <input type="number" name="txtPhone" class="input-xxlarge" 
                               value="<?php if (isset($arr_single_user['C_PHONE'])) echo $arr_single_user['C_PHONE'] ?>"
                               data-rule-minlength="2" id="txtPhone">
                    </div>
                </div>
                <div class="control-group">
                    <div class="control-label">Quyền</div>
                    <div class="controls">
                        <?php 
                            $arr_role=array(1=>"Quản trị viên",2=>'Phóng viên',3=>'Thành viên')
                        ?>
                        <select name="sel_role" data-rule-required="true">
                            <option></option>
                            <?php foreach ($arr_role as $k=>$v){?>
                            <?php $selected=$k==$arr_single_user['C_ROLE'] ? "selected" : ""?>
                            <option value="<?php echo $k?>" <?php echo $selected ?>><?php echo $v ?></option>
                            <?php }?>
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
