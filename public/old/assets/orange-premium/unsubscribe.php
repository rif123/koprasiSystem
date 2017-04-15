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
<link rel="stylesheet" href="<?=$assets.$template?>/css/form_style.css">
<!-- mobile setting -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
</head>
<body>
<div class="wrapper">
 <div class="header_container">
        <!---HEader----->
			<?php $this->load->view('template/demo/header_2'); ?>
		<!---HEader----->
    </div>
 <div class="section_container" style="border-top: 1px solid #C2BEBE;">
        <!--Mid Section Starts-->
        <section>
            <div class="full_page">
				<div class="col-single">
					<form class="form1" id="frm_register" action="<?=site_url('customer/unsubscribe')?>" method="POST">
						<h3>Berhenti Berlangganan Newsletter</h3>
						<p>Untuk berhenti berlangganan silahkan klik tombol di bawah</p>
						<div class="input nobottomborder">
							<div class="inputtext"><em></em>Alamat Email</div>
							<div class="inputcontent">
								<input type="text" name="email" value="<?=$email?>" readonly placeholder="email" id="email"/>
							</div>
						</div>
						<div class="buttons">
							<input class='sc-button small green' type="submit" value="Berhenti" />
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
</body>
</html>