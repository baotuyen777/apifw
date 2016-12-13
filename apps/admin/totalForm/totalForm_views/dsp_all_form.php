<i class="icon-home"></i>
<form action="#" method="POST" class='form-horizontal'>
    <div class="control-group">
        <label for="textfield" class="control-label">Minimal skin</label>
        <div class="controls">
            <div class="check-demo-col">
                <div class="check-line">
                    <input type="checkbox" class='icheck-me' id="c1" data-skin="minimal"> <label class='inline' for="c1">Default</label>
                </div>
                <div class="check-line">
                    <input type="checkbox" class='icheck-me' id="c2" data-skin="minimal" checked> <label class='inline' for="c2">Checked</label>
                </div>
                <div class="check-line">
                    <input type="checkbox" class='icheck-me' data-skin="minimal" disabled> <label class='inline'>Disabled</label>
                </div>
                <div class="check-line">
                    <input type="checkbox" class='icheck-me' data-skin="minimal" checked disabled> <label class='inline'>Disabled &amp; checked</label>
                </div>
            </div>
            <div class="check-demo-col">
                <div class="check-line">
                    <input type="radio" id="c3" class='icheck-me' name="same" data-skin="minimal"> <label class='inline' for="c3">Default</label>
                </div>
                <div class="check-line">
                    <input type="radio" id="c4" class='icheck-me' name="same" data-skin="minimal" checked> <label class='inline' for="c4">Checked</label>
                </div>
                <div class="check-line">
                    <input type="radio" class='icheck-me' name="same2" data-skin="minimal" disabled> <label class='inline'>Disabled</label>
                </div>
                <div class="check-line">
                    <input type="radio" class='icheck-me' name="same2" data-skin="minimal" checked disabled> <label class='inline'>Disabled &amp; checked</label>
                </div>
            </div>
        </div>
    </div>

</form>

<form action="#" method="POST" class='form-horizontal'>
    <div class="control-group">
        <label for="textfield" class="control-label">Date</label>
        <div class="controls">
            <input type="text" name="textfield" id="textfield" class="input-xlarge mask_date">
            <span class="help-block">Format: 9999/99/99</span>
        </div>
    </div>
    <div class="control-group">
        <label for="textfield" class="control-label">Phone number</label>
        <div class="controls">
            <input type="text" name="textfield" id="textfield" class="input-xlarge mask_phone">
            <span class="help-block">Format: (999) 999-9999</span>
        </div>
    </div>
    <div class="control-group">
        <label for="textfield" class="control-label">Serial number</label>
        <div class="controls">
            <input type="text" name="textfield" id="textfield" class="input-xlarge mask_serialNumber">
            <span class="help-block">Format: 9999-9999-99</span>
        </div>
    </div>
    <div class="control-group">
        <label for="textfield" class="control-label">Product number</label>
        <div class="controls">
            <input type="text" name="textfield" id="textfield" class="input-xlarge mask_productNumber">
            <span class="help-block">Format: AAA-9999-A</span>
        </div>
    </div>
</form>
<hr/>
<h1>datetime picker</h1>
<hr/>
<form action="#" method="POST" class='form-horizontal'>
    <div class="control-group">
        <label for="textfield" class="control-label">Datepicker</label>
        <div class="controls">
            <input type="text" name="textfield" id="textfield" class="input-medium datepick">
            <span class="help-block">As dropdown</span>
        </div>
    </div>
    <div class="control-group">
        <label for="textfield" class="control-label">Date-Range picker</label>
        <div class="controls">
            <input type="text" name="textfield" id="textfield" class="input-large daterangepick">
        </div>
    </div>

    <div class="control-group">
        <label for="timepicker" class="control-label">Timepicker</label>
        <div class="controls">
            <div class="bootstrap-timepicker">
                <input type="text" name="timepicker" id="timepicker" class="input-small timepick">
                <span class="help-block">As dropdown</span>
            </div>
        </div>
    </div>
    <div class="control-group">
        <label for="textfield" class="control-label">Colorpicker</label>
        <div class="controls">
            <input type="text" name="textfield" id="textfield" class="input-mini colorpick">
            <span class="help-block">Useful for backend-theme settings</span>
        </div>
    </div>
    <div class="control-group">
        <label for="textfield" class="control-label"></label>
        <div class="controls">
            <div class="input-append color colorpick" data-color="rgb(255, 146, 180)" data-color-format="rgb">
                <input type="text" class="span12" value="" disabled>
                <span class="add-on"><i style="background-color: rgb(255, 146, 180)"></i></span>
            </div>
            <span class="help-block">Colorpicker as component</span>
        </div>
    </div>
</form>


<div class="box">
    <div class="box-title">
        <h3><i class="icon-th"></i> WYSIWYG (CKEditor)</h3>
    </div>
    <div class="box-content nopadding">
        <form action="#" method="POST" class='form-wysiwyg'>
            <textarea name="ck" class='ckeditor span12' rows="5"></textarea>
        </form>
    </div>
</div>