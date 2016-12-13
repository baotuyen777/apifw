<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<!-- Apple devices fullscreen -->
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<!-- Apple devices fullscreen -->
	<meta names="apple-mobile-web-app-status-bar-style" content="black-translucent" />
	
	<title>FLAT - Dashboard</title>

	<!-- Bootstrap -->
	<link rel="stylesheet" href="<?php  echo URL ;?>public/css/bootstrap.min.css">
	<!-- Bootstrap responsive -->
	<link rel="stylesheet" href="<?php  echo URL ;?>public/css/bootstrap-responsive.min.css">
	<!-- jQuery UI -->
	<link rel="stylesheet" href="<?php echo URL ;?>public/css/plugins/jquery-ui/smoothness/jquery-ui.css">
	<link rel="stylesheet" href="<?php echo URL ;?>public/css/plugins/jquery-ui/smoothness/jquery.ui.theme.css">
        <!-- Notify -->
	<link rel="stylesheet" href="<?php echo URL ;?>public/css/plugins/gritter/jquery.gritter.css">
        <!-- timepicker -->
	<link rel="stylesheet" href="<?php echo URL ;?>public/css/plugins/timepicker/bootstrap-timepicker.min.css">
        <!-- colorpicker -->
	<link rel="stylesheet" href="<?php echo URL ;?>public/css/plugins/colorpicker/colorpicker.css">
        <!--DatePicker -->
        <link rel="stylesheet" href="<?php echo URL ;?>public/css/plugins/datepicker/datepicker.css">
        <!-- Daterangepicker -->
	<link rel="stylesheet" href="<?php echo URL ;?>public/css/plugins/daterangepicker/daterangepicker.css">
        <!-- colorpicker -->
	<link rel="stylesheet" href="<?php echo URL ;?>public/css/plugins/colorpicker/colorpicker.css">
	<!-- PageGuide -->
	<link rel="stylesheet" href="<?php echo URL ;?>public/css/plugins/pageguide/pageguide.css">
	<!-- Fullcalendar -->
	<link rel="stylesheet" href="<?php echo URL ;?>public/css/plugins/fullcalendar/fullcalendar.css">
	<link rel="stylesheet" href="<?php echo URL ;?>public/css/plugins/fullcalendar/fullcalendar.print.css" media="print">
	<!-- chosen -->
	<link rel="stylesheet" href="<?php echo URL ;?>public/css/plugins/chosen/chosen.css">
	<!-- select2 -->
	<link rel="stylesheet" href="<?php echo URL ;?>public/css/plugins/select2/select2.css">
	<!-- icheck -->
	<link rel="stylesheet" href="<?php echo URL ;?>public/css/plugins/icheck/all.css">
	<!-- Theme CSS -->
	<link rel="stylesheet" href="<?php echo URL ;?>public/css/style.css">
        <link rel="stylesheet" href="<?php echo URL ;?>public/css/mystyle.css" type="text/css">
	<!-- Color CSS -->
	<link rel="stylesheet" href="<?php echo URL ;?>public/css/themes.css">

        <script src="<?php echo URL ;?>public/js/function.js" type="text/javascript"></script>
	<!-- jQuery -->
	<script src="<?php echo URL ;?>public/js/jquery.min.js"></script>
        <!-- Plupload -->
	<link rel="stylesheet" href="<?php echo URL ;?>public/css/plugins/plupload/jquery.plupload.queue.css">
	
	
	<!-- Nice Scroll -->
	<script src="<?php echo URL ;?>public/js/plugins/nicescroll/jquery.nicescroll.min.js"></script>
	<!-- jQuery UI -->
	<script src="<?php echo URL ;?>public/js/plugins/jquery-ui/jquery.ui.core.min.js"></script>
	<script src="<?php echo URL ;?>public/js/plugins/jquery-ui/jquery.ui.widget.min.js"></script>
	<script src="<?php echo URL ;?>public/js/plugins/jquery-ui/jquery.ui.mouse.min.js"></script>
	<script src="<?php echo URL ;?>public/js/plugins/jquery-ui/jquery.ui.draggable.min.js"></script>
	<script src="<?php echo URL ;?>public/js/plugins/jquery-ui/jquery.ui.resizable.min.js"></script>
	<script src="<?php echo URL ;?>public/js/plugins/jquery-ui/jquery.ui.sortable.min.js"></script>
        <!-- Notify -->
	<script src="<?php echo URL ;?>public/js/plugins/gritter/jquery.gritter.min.js"></script>
	<!-- Touch enable for jquery UI -->
	<script src="<?php echo URL ;?>public/js/plugins/touch-punch/jquery.touch-punch.min.js"></script>
	<!-- slimScroll -->
	<script src="<?php echo URL ;?>public/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<!-- Bootstrap -->
	<script src="<?php echo URL ;?>public/js/bootstrap.min.js"></script>
	<!-- vmap -->
	<script src="<?php echo URL ;?>public/js/plugins/vmap/jquery.vmap.min.js"></script>
	<script src="<?php echo URL ;?>public/js/plugins/vmap/jquery.vmap.world.js"></script>
	<script src="<?php echo URL ;?>public/js/plugins/vmap/jquery.vmap.sampledata.js"></script>
	<!-- Bootbox -->
	<script src="<?php echo URL ;?>public/js/plugins/bootbox/jquery.bootbox.js"></script>
	<!-- Flot -->
	<script src="<?php echo URL ;?>public/js/plugins/flot/jquery.flot.min.js"></script>
	<script src="<?php echo URL ;?>public/js/plugins/flot/jquery.flot.bar.order.min.js"></script>
	<script src="<?php echo URL ;?>public/js/plugins/flot/jquery.flot.pie.min.js"></script>
	<script src="<?php echo URL ;?>public/js/plugins/flot/jquery.flot.resize.min.js"></script>
	<!-- imagesLoaded -->
	<script src="<?php echo URL ;?>public/js/plugins/imagesLoaded/jquery.imagesloaded.min.js"></script>
	<!-- PageGuide -->
	<script src="<?php echo URL ;?>public/js/plugins/pageguide/jquery.pageguide.js"></script>
	<!-- FullCalendar -->
	<script src="<?php echo URL ;?>public/js/plugins/fullcalendar/fullcalendar.min.js"></script>
	<!-- Chosen -->
	<script src="<?php echo URL ;?>public/js/plugins/chosen/chosen.jquery.min.js"></script>
	<!-- select2 -->
	<script src="<?php echo URL ;?>public/js/plugins/select2/select2.min.js"></script>
	<!-- icheck -->
	<script src="<?php echo URL ;?>public/js/plugins/icheck/jquery.icheck.min.js"></script>
        <!-- Masked inputs -->
	<script src="<?php echo URL ;?>public/js/plugins/maskedinput/jquery.maskedinput.min.js"></script>
        <!-- Timepicker -->
	<script src="<?php echo URL ;?>public/js/plugins/timepicker/bootstrap-timepicker.min.js"></script>
	<!-- Colorpicker -->
	<script src="<?php echo URL ;?>public/js/plugins/colorpicker/bootstrap-colorpicker.js"></script>
        <!-- Datepicker -->
	<script src="<?php echo URL ;?>public/js/plugins/datepicker/bootstrap-datepicker.js"></script>
	<!-- Daterangepicker -->
	<script src="<?php echo URL ;?>public/js/plugins/daterangepicker/daterangepicker.js"></script>
	<script src="<?php echo URL ;?>public/js/plugins/daterangepicker/moment.min.js"></script>
	<!-- Timepicker -->
	<script src="<?php echo URL ;?>public/js/plugins/timepicker/bootstrap-timepicker.min.js"></script>
        <!-- CKEditor -->
	<script src="<?php echo URL ;?>public/js/plugins/ckeditor/ckeditor.js"></script>


	<!-- Theme framework -->
	<script src="<?php echo URL ;?>public/js/eakroko.min.js"></script>
	<!-- Theme scripts -->
	<script src="<?php echo URL ;?>public/js/application.min.js"></script>
	<!-- Just for demonstration -->
	<script src="<?php echo URL ;?>public/js/demonstration.min.js"></script>
	
	<!--[if lte IE 9]>
		<script src="js/plugins/placeholder/jquery.placeholder.min.js"></script>
		<script>
			$(document).ready(function() {
				$('input, textarea').placeholder();
			});
		</script>
	<![endif]-->

	<!-- Favicon -->
	<link rel="shortcut icon" href="img/favicon.ico" />
	<!-- Apple devices Homescreen icon -->
	<link rel="apple-touch-icon-precomposed" href="img/apple-touch-icon-precomposed.png" />

</head>

<body>

	
	<div class="container-fluid" id="content">
		
		<div id="main">
			<div class="container-fluid">
				<div class="row-fluid mycontent">