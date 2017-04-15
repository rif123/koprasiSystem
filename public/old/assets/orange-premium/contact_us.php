<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="description" content="<?=$identitas->description?>"/>
<meta name="author" content="<?=$identitas->site_title?>">
<meta property="og:url" content="<?='http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>">
<meta name="keywords" content="<?=$identitas->keyword?>,Kontak Kami" />
<meta property="og:title" content="<?=$site_title?>">
<meta property="og:description" content="<?=$identitas->description?>">
<meta property="og:image" content="<?=base_url().'uploads/'.$identitas->logo?>">
<title><?=$site_title?></title>
<?php $this->load->view('template/demo/resource'); ?>
<script type="text/javascript" src="<?=$assets.$template?>/js/jquery.form.js"></script>
<script type="text/javascript" src="<?=$assets.$template?>/js/jquery.blockUI.js"></script>
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
					<form class="form1" id="frm_register" action="<?=site_url('customer/contact_proses')?>" method="POST">
						<h3>Tinggalkan Pesan <?=$identitas->site_title?><em>* Wajib diisi</em></h3>
						<span id="ajax-status"></span>
						<span id="message"></span>
						<br>
						<div class="input nobottomborder">
							<div class="inputtext"><em>*</em>Nama Lengkap</div>
							<div class="inputcontent">
								<input type="text" name="nama" id="nama"/>
							</div>
						</div>
						<div class="input">
							<div class="inputtext"><em>*</em>Email</div>
							<div class="inputcontent">
								<input type="text" name="email" id="email"/>
							</div>
						</div>
						<div class="input nobottomborder">
							<div class="inputtext"><em>*</em>Judul Pesan</div>
							<div class="inputcontent">
								<input type="text" name="judul_pesan" id="judul_pesan"/>
							</div>
						</div>
						<div class="input nobottomborder">
							<div class="inputtext"><em>*</em>Isi Pesan</div>
							<div class="inputcontent">
								<textarea name="isi_pesan" id="isi_pesan"></textarea>
							</div>
						</div>
						<div class="buttons">
							<input class='sc-button small green' type="submit" value="Submit" />
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