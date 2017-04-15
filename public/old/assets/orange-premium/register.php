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
<script type="text/javascript" src="<?=$assets.$template?>/js/jquery.blockUI.js"></script>
<script type="text/javascript" src="<?=$assets.$template?>/js/jquery-ui.js"></script>
<link rel="stylesheet" href="<?=$assets.$template?>/css/jquery-ui-1.8.4.custom.css" class="skin-color">
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
					<form class="form1" id="frm_register" action="<?=site_url('page/register_proses')?>" method="POST">
						<h3>Daftar Akun <?=$identitas->site_title?><em>* Wajib diisi</em></h3>
						<span id="ajax-status"></span>
						<span id="message"></span>
						<br>
						<div class="input nobottomborder">
							<div class="inputtext"><em>*</em>Nama Lengkap</div>
							<div class="inputcontent">
								<input type="text" name="full_name" placeholder="Nama Lengkap" id="full_name"/>
							</div>
						</div>
						<div class="input">
							<div class="inputtext"><em>*</em>Email</div>
							<div class="inputcontent">
								<input type="text" name="email" placeholder="Email" id="email"/>
							</div>
						</div>
						<div class="input nobottomborder">
							<div class="inputtext"><em>*</em>Password</div>
							<div class="inputcontent">
								<input type="password" name="password" placeholder="Password" id="password"/>
							</div>
						</div>
						<div class="input">
							<div class="inputtext"><em>*</em>Tanggal Lahir</div>
							<div class="inputcontent">
								<input type="text"  placeholder="Tanggal Lahir" name="tgl_lahir" id="tgl_lahir" />
							</div>
						</div>
						<div class="input nobottomborder">
							<div class="inputtext"><em>*</em>Jenis Kelamin</div>
							<div class="inputcontent">
								<input type="radio" checked name="jenis_kelamin" id="jenis_kelamin" value="Pria" style="width: 15px;" /> Pria
								<input type="radio"  name="jenis_kelamin" id="jenis_kelamin" value="Wanita" style="width: 15px;" /> Wanita
							</div>
						</div>
						<div class="input">
							<div class="inputcontent" style="width:7%;">
								<input type="checkbox" name="fl_newsletter" checked id="fl_newsletter" />
							</div>
							<div class="inputtext" style="width:70%;padding: 2px;">Daftar Newsletter</div>
						</div>
						<div class="buttons">
							<input class='sc-button small green' type="submit" value="Daftar" />
							<input class='sc-button small orange' type="reset" value="Reset" />
						</div>
					</form>
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
		$("#tgl_lahir").datepicker({dateFormat: 'yy-mm-dd',changeMonth: true,changeYear: true,yearRange: "-100:+0"});
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