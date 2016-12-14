<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="EN" lang="EN" dir="ltr">
<head profile="http://gmpg.org/xfn/11">
<title>News Magazine</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="imagetoolbar" content="no" />
<link rel="stylesheet" href="<?php echo SITE_ROOT; ?>templates/frontend/styles/layout.css" type="text/css" />
<script type="text/javascript" src="<?php echo SITE_ROOT; ?>templates/frontend/scripts/jquery-1.4.1.min.js"></script>
<script type="text/javascript" src="<?php echo SITE_ROOT; ?>templates/frontend/scripts/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="<?php echo SITE_ROOT; ?>templates/frontend/scripts/jquery.timers.1.2.js"></script>
<script type="text/javascript" src="<?php echo SITE_ROOT; ?>templates/frontend/scripts/jquery.galleryview.2.1.1.min.js"></script>
<script type="text/javascript" src="<?php echo SITE_ROOT; ?>templates/frontend/scripts/jquery.galleryview.setup.js"></script>
</head>
<body id="top">
<div class="wrapper col0">
  <div id="topline">
    <p>Tel: xxxxx xxxxxxxxxx | Mail: info@domain.com</p>
    <ul>
      <li><a href="#">Libero</a></li>
      <li><a href="#">Maecenas</a></li>
      <li><a href="#">Mauris</a></li>
      <li class="last"><a href="#">Suspendisse</a></li>
    </ul>
    <br class="clear" />
  </div>
</div>
<!-- ####################################################################################################### -->
<div class="wrapper">
  <div id="header">
    <div class="fl_left">
      <h1><a href="#"><strong>Cổng thông tin điện tử HVQLGD</strong></a></h1>
      <p>Free CSS Website Template</p>
    </div>
    <div class="fl_right">
            BANNER
    </div>
    <br class="clear" />
  </div>
</div>
<!-- ####################################################################################################### -->
<div class="wrapper col2">
  <div id="topbar">
    <div id="topnav">
         
      <ul>
        <li class="active"><a href="index.html">Trang chủ</a></li>
        <li class=""><a href="#">Danh mục tin tức</a>
          <ul>
             <?php $model= new Model();
            
            foreach($model->qry_all_category() as $arr_single_cate){
            ?>
            <li><a href="#"><?php echo $arr_single_cate['C_NAME']?></a></li>

            <?php }?>
          </ul>
        </li>
        <li class="last"><a href="#">Liên hệ</a></li>
      </ul>
    </div>
    <div id="search">
      <form action="#" method="post">
        <fieldset>
          <legend>Site Search</legend>
          <input type="text" value="Search Our Website&hellip;"  onfocus="this.value=(this.value=='Search Our Website&hellip;')? '' : this.value ;" />
          <input type="submit" name="go" id="go" value="Search" />
        </fieldset>
      </form>
    </div>
    <br class="clear" />
  </div>
</div>
<!-- ####################################################################################################### -->

