<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="description" content="<?=$identitas->description?>"/>
<meta name="author" content="<?=$identitas->site_title?>">
<meta property="og:url" content="<?='http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>">
<meta name="keywords" content="<?=$identitas->keyword?>" />
<meta property="og:title" content="<?=$site_title?>">
<meta property="og:description" content="<?=$identitas->description?>">
<meta property="og:image" content="<?=base_url().'uploads/'.$identitas->logo?>">
<title><?=$site_title?></title>
<?php $this->load->view('template/demo/resource'); ?>
<script type="text/javascript" src="<?=$assets.$template?>/js/jquery.form.js"></script>
<link rel="stylesheet" href="<?=$assets.$template?>/css/form_style.css">
<!-- mobile setting -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
</head>
<body>
<div class="wrapper">
 <div class="header_container">
        <!---HEader----->
			<?php $this->load->view('template/demo/header'); ?>
		<!---HEader----->
    </div>
 <div class="section_container" style="border-top: 1px solid #C2BEBE;">
        <!--Mid Section Starts-->
        <section>
            <div class="full_page">
				<div class="col-left">
					<h3>Login <?=$identitas->site_title?></h3>
					<form class="form1" id="frm_register" action="<?=site_url('page/login_proses')?>" method="POST">
						<span id="ajax-status"></span>
						<span id="message"></span>
						<br>
						<div class="input">
							<div class="inputtext"><em>*</em>Email</div>
							<div class="inputcontent">
								<input type="text" name="email" id="email"/>
							</div>
						</div>
						<div class="input nobottomborder">
							<div class="inputtext"><em>*</em>Password</div>
							<div class="inputcontent">
								<input type="password" name="password" id="password"/>
							</div>
						</div>
						<div class="input nobottomborder">
							<div class="inputtext"><em></em></div>
							<div class="inputcontent" id="gallery">
								<p><a href="<?=site_url('page/forgot')?>" title="Lupa Password">Lupa Password</a></p>
							</div>
						</div>
						<br>
						<div class="buttons">
							<input class='sc-button small green' type="submit" value="Login" />
							<input class='sc-button small orange' type="reset" value="Reset" />
						</div>
					</form>
				</div>
				<div class="col-right">
					<h3>Belum Punya Akun <?=$identitas->site_title?>?</h3>
					<div id='bx-next'><button onClick="window.location='<?=site_url('page/daftar')?>'" class='sc-button small orange'>Daftar</button></div>
				</div>
            </div>
        </section>
        <!--Mid Section Ends-->
    </div>
   
    <div class="footer_container">
        <!--Footer Starts-->
       <?php $this->load->view('template/demo/footer'); ?>
	   <!--Footer Ends-->
    </div>
</div>
<script>
	$(document).ready(function(){
		$('#ajax-status').hide();
		$('#message').hide();
		$('#frm_register').ajaxForm({
			target: '#message',
			success: function() {
				$('#message').show();
			}
		});
		$('#ajax-status').ajaxStart(function(){
			$('#message').hide();
			$(this).fadeIn('fast');
			$(this).html("<div id='shadow'><p>Loading..</p></div>");
		});
		$('#ajax-status').ajaxSuccess(function(){
			$(this).hide();
		});
	});
</script>
</body>
</html>