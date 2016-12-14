
<?php
    foreach($this->data as $item){
?>        
 
<div class="content">
    <h1>Sửa thông tin</h1>
    <form action="<?php echo URL?>user/do_update_user" method="post">
        <input type="hidden" name="hdn_user_id" value="<?php echo $item['PK_PERSON']?>">
        <span>Email</span><input type="text" name="txtEmail" value="<?php echo $item['C_EMAIL'];?>" disabled="disabled"><br>
        <span>PassWord</span><input type="text" name="txtPass"><br>
        <span>fullname</span><input type="text" name="txtName" value="<?php echo $item['C_NAME'];?>"><br>
        <span>phone</span><input type="text" name="txtPhone" value="<?php echo $item['C_PHONE'];?>"><br>
        <span>address</span><input type="text" name="txtAdd" value="<?php echo $item['C_ADDRESS'];?>"><br>
        <span>Age</span><input type="text" name="txtAge" value="<?php //echo $item['emp_age'];?>"><br>
        <span>Gender</span><input type="radio" name="txtGender" value="nam">Male <input type="radio" name="txtGender" value="nu">Female<br>
        <input type="submit" value="Sửa thông tin"><input type="reset">
    </form>
</div>
<?php        
   }
?>