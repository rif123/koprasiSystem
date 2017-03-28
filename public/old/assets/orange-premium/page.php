<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="description" content="<?=$identitas->description?>"/>
<meta name="author" content="<?=$identitas->site_title?>">
<meta property="og:url" content="<?='http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>">
<meta name="keywords" content="<?=$identitas->keyword?>,<?=$nm_page?>" />
<meta property="og:title" content="<?=$site_title?>">
<meta property="og:description" content="<?=$identitas->description?>">
<meta property="og:image" content="<?=base_url().'uploads/'.$identitas->logo?>">
<title><?=$site_title?></title>
<?php $this->load->view('template/demo/resource'); ?>
<script type="text/javascript" src="<?=$assets?>demo/js/jquery.form.js"></script>
<!-- mobile setting -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
</head>
<body>
<div class="wrapper">
    <!--HEADER-->
		<?php $this->load->view('template/demo/header'); ?>
	<!--HEADER-->
	<div class="section_container">
        <!--Mid Section Starts-->
        <section>
			<div id="" class="full_page">
				 <h1><?=$nm_page?></h1>
				 <div class="col_left_main contact_page">
					<?=$content?>
                </div>
				<style>
				p{line-height: 21px;font-family: arial;font-size: 14px;}
				</style>
			</div>
             <!--Newsletter_subscribe Starts-->
        	<div class="subscribe_block">
			<span id="ajax-status"></span>
			<span id="message"></span>
                <div class="find_us">
                    <h3>Temukan Kami</h3>
                    <a class="twitter" href="http://www.<?=$identitas->twitter?>" target="_blank"></a>
					<a class="facebook" href="http://www.<?=$identitas->facebook?>" target="_blank"></a>
					<a class="youtube" href="#"></a> </div>
                <div class="subscribe_nl">
                    <h3>Daftar Newsletter Sekarang  </h3>
                    <small>Daftar & dapatkan update terbaru serta penawaran spesial.</small>
                    <form id="newsletter" method="post" action="<?=site_url('page/register_newsletter')?>">
                        <input class="input-text"  placeholder="Email Anda" title="Email Anda" id="newsletter" name="email" type="email" required />
                        <button class="button" title="Daftar Newsletter" type="submit"></button>
                    </form>
                </div>
            </div>
            <!--Newsletter_subscribe Ends-->
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
		$('#newsletter').ajaxForm({
			target: '#message',
			success: function() {
				$('#message').show();
			}
		});
		$('#ajax-status').ajaxSuccess(function(){
			$(this).hide();
		});
	});
</script>
</body>
</html>