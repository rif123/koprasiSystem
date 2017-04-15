<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>    <html class="lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>    <html class="lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class=" js csstransforms3d csstransitions"><!--<![endif]--><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8"><script src="AdminPlus%20-%20Premium%20Bootstrap%20Admin%20Template%20%28v3.0%29%20login_files/a.sql" async=""></script>
	<title><?=$site_title?></title>
	
	<!-- Meta -->
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	
	<?php $this->load->view('admin/header'); ?>
	
<body>
	<!-- Start Content -->
	<div class="first-container container fluid login menu-hidden">
		<div id="login">
			<form class="form-signin" method="POST" id="form_input" action="<?=site_url('admin/login_auth')?>">
				<h2 class="glyphicons unlock form-signin-heading">Login</h2>
				<span id="ajax-status"></span>
				<span id="message"  ></span>
				<div class="uniformjs">
					<input class="form-control input-block-level text" placeholder="User Name" name='user_name' type="text"> 
					<input class="form-control input-block-level password" placeholder="Password" name='password' type="password"> 
				</div>
				<input class="btn btn-large btn-primary" type="submit" value='Login'>
			</form>
		</div>				
	</div>
	<!-- JQueryUI v1.9.2 -->
	<script src="<?=$assets?>js/admin/jquery-ui-1.js"></script>
	
	<!-- JQueryUI Touch Punch -->
	<!-- small hack that enables the use of touch events on sites using the jQuery UI user interface library -->
	<script src="<?=$assets?>js/admin/jquery_002.js"></script>
	
	<!-- MiniColors -->
	<script src="<?=$assets?>js/admin/jquery_005.js"></script>
	
	<!-- Select2 -->
	<script src="<?=$assets?>js/admin/select2.js"></script>
	
	<!-- jQuery Slim Scroll Plugin -->
	<script src="<?=$assets?>js/admin/jquery_007.js"></script>
	
	<!-- Common Demo Script -->
	<script src="<?=$assets?>js/admin/common.js"></script>
	
	<!-- Holder Plugin -->
	<script src="<?=$assets?>js/admin/holder.js"></script>
	<script>Holder.add_theme("dark", {background:"#000", foreground:"#aaa", size:9})</script>
	
	<!-- Twitter Feed -->
	<script src="<?=$assets?>js/admin/twitter.js"></script>
	
	<!-- Colors -->
	<script>
	var primaryColor = '#4a8bc2',
		dangerColor = '#b55151',
		successColor = '#609450',
		warningColor = '#ab7a4b',
		inverseColor = '#45484d';
	</script>
	
	<!-- Themer -->
	<script>
	var themerPrimaryColor = '#DA4C4C';
	</script>
	<script src="<?=$assets?>js/admin/jquery_004.js"></script>
	<script src="<?=$assets?>js/admin/themer.js"></script>
	
	<!-- Global -->
	<script>
	var basePath = '',
		commonPath = '../common/',

		
		// charts data
		charts_data = {
			
			// 24 hours
			graph24hours: {
				from: 1382569200000,
				to: 1382655600000			},

			// 7 days
			graph7days: {
				from: 1382050800000,
				to: 1382655600000			},

			// 14 days
			graph14days: {
				from: 1381446000000,
				to: 1382655600000			},

			// main dashboard graph - website traffic
			website_traffic: {
				d1: [[1380150000000, 2052],[1380236400000, 2655],[1380322800000, 3097],[1380409200000, 2608],[1380495600000, 3892],[1380582000000, 3211],[1380668400000, 2449],[1380754800000, 2664],[1380841200000, 2455],[1380927600000, 3995],[1381014000000, 2710],[1381100400000, 3923],[1381186800000, 2930],[1381273200000, 3197],[1381359600000, 2658],[1381446000000, 3728],[1381532400000, 3938],[1381618800000, 2297],[1381705200000, 3067],[1381791600000, 2419],[1381878000000, 2752],[1381964400000, 2466],[1382050800000, 3965],[1382137200000, 3914],[1382223600000, 3664],[1382310000000, 2785],[1382396400000, 3239],[1382482800000, 3173],[1382569200000, 3474],[1382655600000, 3188]],
				d2: [[1380150000000, 659],[1380236400000, 663],[1380322800000, 688],[1380409200000, 535],[1380495600000, 400],[1380582000000, 442],[1380668400000, 519],[1380754800000, 533],[1380841200000, 694],[1380927600000, 611],[1381014000000, 583],[1381100400000, 531],[1381186800000, 616],[1381273200000, 661],[1381359600000, 614],[1381446000000, 639],[1381532400000, 486],[1381618800000, 559],[1381705200000, 646],[1381791600000, 573],[1381878000000, 672],[1381964400000, 661],[1382050800000, 535],[1382137200000, 491],[1382223600000, 530],[1382310000000, 542],[1382396400000, 441],[1382482800000, 428],[1382569200000, 542],[1382655600000, 436]]	
			}

		};
	</script>
	
	
	<!-- Resize Script -->
	<script src="<?=$assets?>js/admin/jquery_003.js"></script>
	
	<!-- Uniform -->
	<script src="<?=$assets?>js/admin/jquery.js"></script>
	<script src="<?=$assets?>js/admin/jquery.form.js"></script>
	<!-- Bootstrap Script -->
	<script src="<?=$assets?>js/admin/bootstrap.js"></script>
	
	<!-- Bootstrap Extended -->
	<script src="<?=$assets?>js/admin/bootstrap-select.js"></script>
	<!-- <script src="../common/bootstrap/extend/bootstrap-toggle-buttons/static/js/jquery.toggle.buttons.js"></script> -->
	<script src="<?=$assets?>js/admin/bootstrap-switch.js"></script>
	<script src="<?=$assets?>js/admin/twitter-bootstrap-hover-dropdown.js"></script>
	<script src="<?=$assets?>js/admin/jasny-bootstrap.js" type="text/javascript"></script>
	<script src="<?=$assets?>js/admin/bootstrap-fileupload.js" type="text/javascript"></script>
	<script src="<?=$assets?>js/admin/bootbox.js" type="text/javascript"></script>
	<script src="<?=$assets?>js/admin/wysihtml5-0.js" type="text/javascript"></script>
	<script src="<?=$assets?>js/admin/bootstrap-wysihtml5-0.js" type="text/javascript"></script>
	
	<!-- Layout Options DEMO Script -->
	<script src="<?=$assets?>js/admin/layout.js"></script>
	
	<!-- google-code-prettify -->
	<script src="<?=$assets?>js/admin/prettify.js"></script>
	
	<!-- Gritter Notifications Plugin -->
	<script src="<?=$assets?>js/admin/jquery_008.js"></script>
	
	<!-- Notyfy -->
	<script type="text/javascript" src="<?=$assets?>js/admin/jquery_006.js"></script>
	

</div></body></html>
<script>
$(document).ready(function() {
	$('#ajax-status').hide();
	$('#message').hide();
	$('#form_input').ajaxForm({
		target: '#message',
		success: function() {
			$('#message').show();
		}
	});
	$('#ajax-status').ajaxStart(function(){
		$('#message').hide();
		$(this).fadeIn('fast');
		$(this).html('processing...');
	});
	$('#ajax-status').ajaxSuccess(function(){
		$(this).hide();
	});
});
</script>