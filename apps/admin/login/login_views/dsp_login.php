
<form action="login/login" method="post" class="form-validate form-horizontal" id="frmLogin">
<div style="margin: auto; width: 600px;" class="box box-color box-bordered">
    <div class="box-title"><h3>Xin mời đăng nhập</h3></div>
    <div class="box-content">
        <div class="control-group">
                    <div class="control-label">Email</div>
                    <div class="controls">
                        <input type="email" name="txtEmail" id="txtPass"  data-rule-required="true" data-rule-minlength="2">
                    </div>
                </div>
         <div class="control-group">
                    <div class="control-label">Mật khẩu</div>
                    <div class="controls">
                        <input type="password" name="txtPass" id="txtPass"  data-rule-required="true" data-rule-minlength="2">
                    </div>
                </div>
        <div class="form-actions">
            <input type="submit" class="btn btn-primary">
        </div>
        
    </div>
</div>
</form>
