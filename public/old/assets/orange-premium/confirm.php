<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="description" content="<?=$identitas->description?>"/>
<meta name="author" content="<?=$identitas->site_title?>">
<meta property="og:url" content="<?='http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>">
<meta name="keywords" content="<?=$identitas->keyword?>,Konfirmasi Pembayaran" />
<meta property="og:title" content="<?=$site_title?>">
<meta property="og:description" content="<?=$identitas->description?>">
<meta property="og:image" content="<?=base_url().'uploads/'.$identitas->logo?>">
<title><?=$site_title?></title>
<?php $this->load->view('template/demo/resource'); ?>
<script type="text/javascript" src="<?=$assets.$template?>/js/jquery.form.js"></script>
<link rel="stylesheet" href="<?=$assets.$template?>/css/form_style.css">
<script type="text/javascript" src="<?=$assets.$template?>/js/jquery-ui.js"></script>
<link rel="stylesheet" href="<?=$assets.$template?>/css/jquery-ui-1.8.4.custom.css" class="skin-color">
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
					<form class="form1" id="frm_register" action="<?=site_url('page/confirm_proses')?>" method="POST" style="overflow:visible;">
						<h3>Konfirmasi Pembayaran <?=$identitas->site_title?><em>* Wajib diisi</em></h3>
						<span id="ajax-status"></span>
						<span id="message"></span>
						<div class="input nobottomborder" style="overflow:visible;height:2.4em;position:relative;">
							<div class="inputtext"><em>*</em>No Transaksi</div>
							<div class="inputcontent">
								<input type="text" value="<?=$id_pesanan?>" name="id_pesanan" id="id_pesanan" style="float: left;width: 70%;"/><a href="#" style="float:left;" id="button-tip"><img src="<?=$assets.$template?>/images/qmark.png"/></a>
								<div class="tip" id="tip">
									<p>No Transaksi Anda dapat dilihat di email yang Anda gunakan untuk memesan, atau dengan login ke <a href="<?=site_url('page/my_account/order_history')?>" target="_blank">My Account</a><p>
								</div>
							</div>
						</div>
						<div class="input">
							<div class="inputtext"><em>*</em>Tujuan Transfer</div>
							<div class="inputcontent">
								<select name="idx_rek" id="idx_rek">
									<?php
										foreach($rek->result() as $rek){
											echo"<option value='".$rek->idx_account_bank."'>".$rek->nm_bank."</option>";
										}
									?>
								</select>
							</div>
						</div>
						
						<div class="input nobottomborder">
							<div class="inputtext"><em>*</em>Tgl Transfer</div>
							<div class="inputcontent">
								<input type="text" name="tgl_transfer" id="tgl_transfer"/>
							</div>
						</div>
						
						<div class="input nobottomborder">
							<div class="inputtext"><em>*</em>Bank Pengirim</div>
							<div class="inputcontent">
								<input type="text" name="user_bank" id="user_bank"/>
							</div>
						</div>
						
						<div class="input nobottomborder">
							<div class="inputtext"><em>*</em>No Rekening</div>
							<div class="inputcontent">
								<input type="text" name="user_acc" id="user_acc"/>
							</div>
						</div>
						
						<div class="input nobottomborder">
							<div class="inputtext"><em>*</em>Atas Nama</div>
							<div class="inputcontent">
								<input type="text" name="nm_acc" id="nm_acc"/>
							</div>
						</div>
						
						<div class="input nobottomborder">
							<div class="inputtext"><em>*</em>Total Transfer</div>
							<div class="inputcontent">
								<input type="text" name="total_pembayaran" id="total_pembayaran"/>
							</div>
						</div>
						
						<div class="input nobottomborder">
							<div class="inputtext"><em></em>Bukti Transfer</div>
							<div class="inputcontent">
								<input type="file" name="bukti_pembayaran" id="bukti_pembayaran"/>
							</div>
						</div>
						
						<div class="buttons">
							<input class='sc-button small green' type="submit" value="Proses" />
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
		$("#tgl_transfer").datepicker({dateFormat: 'yy-mm-dd',changeMonth: true,changeYear: true,yearRange: "-100:+0"});
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
		$("#button-tip").mouseover(function() {
		  $("#tip").toggle();
		});
	});
</script>
</body>
</html>