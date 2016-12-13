    
 <?php 
    $item=$this->data;
    $cmt=$this->cmt;
    $model= new Model();
    $model->up_views($item['C_VIEWS']+1, $item['PK_NEWS']);
    
 ?>
<div style="border: 1px solid #e4c199;width: 650px; padding: 20px" >
    <div style="font-weight: bold;font-size: 25px; padding: 10px; font-family: sans-serif;" class="pull-left">
        <?php echo $item['C_TITLE'] ?>
    </div>
    <div class="pull-right">(<?php echo $item['C_DATE'] ?>)   </div>
    <div class="clr"></div>
    <hr/><br><br>
    <p><?php echo $item['C_SHORT_CONTENT']?></p><br>
    <img src="<?php echo SITE_ROOT ?>/public/img/news/<?php echo $item['C_IMG'] ?>" width="99%"><br><br>
    <p><?php echo $item['C_CONTENT']?></p><br>
    <hr/>   
     <?php 
    if(!empty($cmt)){
        foreach ($cmt as $value){?>
    <p><b><?php echo $value['C_NAME_PERSON']?> : </b><?php echo $value['CMT_CONTENT']?> (<?php echo date_create($value['C_DATE'])->format('d/m/Y');?>)</p>
    <? }}?>
    <hr/>
    <h4>BÌNH LUẬN</h4>
    <form action="<?php echo SITE_ROOT?>frontend/news/do_insert_cmt" method="post">
            <input type="hidden" name="txtNewId" value="<?php echo $this->id;?>">
            <table class="table">
            <tr>
                <td>Nhập tên:</td>
                <td><input type="text" name="txtNamePerson"/></td>
            </tr>
            <tr>
                <td>Bình luận :</td>
                <td><textarea name="txtCmt" cols="60" rows="3" class="input-xxlarge"></textarea><br></td>
            </tr>
            <tr>
                <td>Nhập mã xác nhận</td>
                <td colspan="">
                    <div class="input-append">
                        <span class="add-on"><?php echo Session::get('capcha'); ?></span><input type="text" name="txtCapcha" >
                    </div>
                </td>
            </tr>
            <tr><td><input type="submit" value="Gui binh luan" class="btn btn-primary"></td></tr>
        </table>
    </form>
    
   
  </div>
