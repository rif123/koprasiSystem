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
<script type="text/javascript" src="<?=$assets.$template?>/js/jquery.blockUI.js"></script>
<script type="text/javascript" src="<?=$assets.$template?>/js/jquery.form.js"></script>
<script type="text/javascript" src="<?=$assets.$template?>/js/jquery.countdown.js"></script>
<link rel="stylesheet" href="<?=$assets.$template?>/css/jquery.countdown.css">
<!-- mobile setting -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<meta name="google-site-verification" content="cq-ZLromvdCqY8XrJkcjhiKPt9fL1RCCpDR1yHcz-Eg" />
</head>
<body>
<div class="wrapper">
    <!--HEADER-->
		<?php $this->load->view('template/demo/header'); ?>
	<!--HEADER-->
	<div class="section_container">
        <!--Mid Section Starts-->
        <section>
            <!--Banner Starts-->
			<?php 
			if($fl_promo==1){
				if(($promo_slide->num_rows()>0)||($promo_banner->num_rows()>0)){ ?>
					<div id="banner_section">
					<?php if($promo_slide->num_rows()>0){ ?>
						<div class="flexslider">
						<div class="flex-viewport">
							<ul class="slides">
								<?php 
								$n=1;
								foreach($promo_slide->result() as $wp){
										$countdown='<script type="text/javascript">
														$(function(){
															date = new Date('.$page->date_convert($wp->tgl_akhir).');
															$("#attr'.$n.'").countdown({until:date,format: "dd:hh:mm:ss"});
														});
													</script>
													<div id="time-limit"><p>Sisa Waktu Promo</p><div id="attr'.$n.'"></div></div>';
										if((!$page->date_valid($wp->tgl_akhir))||(!$page->date_valid($wp->tgl_awal))){
											$countdown	='';
										}
										if($wp->idx_type_promo==4){ //promo selain persentasi dan ongkir
											$url=site_url('page/shop');
										}else if($wp->idx_type_promo==6){ //promo category
											$url		=site_url('category/'.$wp->nm_promo);
										}else if($wp->idx_type_promo==7){ //non promo 
											$url		="#";
										}else{
											$url=site_url('promo/view/'.$wp->idx_promo.'?name='.str_replace(" ","-",$wp->nm_promo));
										}
										echo'
										<li class="" style="width: 697px; float: left; display: block;"><a href="'.$url.'"> <img src="'.base_url().'uploads/promo_slide/'.$wp->path_slide.'">
											'.$countdown.'
											<div class="flex-caption">';
											if($wp->idx_type_promo<>6){
												echo'<h3 style="float: left;">'.$wp->nm_promo.'</h3>';
											}else{
												echo'<h3 style="float: left;">'.$page->nm_category($wp->nm_promo).'</h3>';
											}
											echo'
										  </div>
										  </a>
										</li>';
										$n++;
								}
								?>
							</ul>
						</div>
						<ul class="flex-direction-nav"><li><a class="flex-prev" href="javascript:void()">Previous</a></li><li><a class="flex-next" href="javascript:void()">Next</a></li></ul>
						</div>
						<?php }
						if($promo_banner->num_rows()>0){ ?>
						<div class="promo_banner">
						<?php 
							$n=1;
							foreach($promo_banner->result() as $wpb){
								if($wpb->idx_type_promo==4){
									$url		=site_url('page/shop');
								}else if($wpb->idx_type_promo==6){
									$url		=site_url('category/'.$wpb->nm_promo);
								}else if($wpb->idx_type_promo==7){ //non promo 
									$url		="#";
								}else{
									$url		=site_url('promo/view/'.$wpb->idx_promo.'?name='.str_replace(" ","-",$wpb->nm_promo));
								}
								if($wpb->idx_type_promo<>6){
									echo'
										 <div class="home_banner">
											<a href="'.$url.'" title="'.$wpb->nm_promo.'"><p><span>'.$wpb->nm_promo.'</span></p><img src="'.base_url().'uploads/promo_slide/'.$wpb->path_slide.'" alt="'.$wpb->nm_promo.'" style="height: 140px;width: 278px;"></a>
										</div>
									';
								}else{
									echo'
										 <div class="home_banner">
											<a href="'.$url.'" title="'.$page->nm_category($wpb->nm_promo).'"><p><span>'.$page->nm_category($wpb->nm_promo).'</span></p><img src="'.base_url().'uploads/promo_slide/'.$wpb->path_slide.'" alt="'.$page->nm_category($wpb->nm_promo).'" style="height: 140px;width: 278px;"></a>
										</div>
									';
								}
							}
						?>
						  
						</div>
						<?php } ?>
					</div>
			<?php 
				}
			}
			?>
            <!--Banner Ends-->
            <!--Product List Starts-->
            <div class="products_list products_slider">
                <h2 class="sub_title">Produk Terbaru</h2>
                <div class=" jcarousel-skin-tango"><div style="position: relative; display: block;" class="jcarousel-container jcarousel-container-horizontal">
				<div style="position: relative;" class="jcarousel-clip jcarousel-clip-horizontal">
				<ul style="overflow: hidden; position: relative; top: 0px; margin: 0px; padding: 0px; left: 0px; width: 1612px;" id="first-carousel" class="first-and-second-carousel jcarousel-list jcarousel-list-horizontal">
                    <?php
							$n=1;
							if($list_product->num_rows()>0){
								foreach($list_product->result() as $w){
									$harga_discount	='';
									$harga			='Rp. '.number_format($w->harga,0,',','.');
									$discount		='';
									$sold_out		='';
									if($page->check_promo($w->idx_product)->num_rows()>0)
									{
										$pr=$page->check_promo($w->idx_product)->row();
										if($pr->idx_type_promo==1){
											$harga_discount	='<small>Rp. '.number_format($w->harga,0,',','.').'</small>';
											$harga			=$w->harga-($w->harga*$pr->discount/100);
											$harga			='Rp. '.number_format($harga,0,',','.');
											$discount		='<span class="reduction"><span>-'.number_format($pr->discount,0,',','').'%</span></span>';
										}
									}else{
										if($w->discount>0){
											$harga_discount	='<small>Rp. '.number_format($w->harga,0,',','.').'</small>';
											$harga			='Rp. '.number_format($w->harga_discount,0,',','.');
											$discount		='<span class="reduction"><span>-'.number_format($w->discount,0,',','').'%</span></span>';
										}
									}
									if($page->sold_out($w->idx_product,$w->type_product)){
										$sold_out		='<span class="sold_out"><span>SOLD OUT</span></span>';
									}
										echo'
											<li jcarouselindex="'.$n.'" onmouseover=$(".pr_attr'.$n.'").show() onmouseout=$(".pr_attr'.$n.'").hide() style="float: left; list-style: none outside none;" class="jcarousel-item jcarousel-item-horizontal jcarousel-item-1 jcarousel-item-1-horizontal"> 
												<a href="'.site_url('detail/'.$w->idx_product.'/'.strtolower(str_replace(" ","-",$w->nm_product))).'" title="'.$w->nm_product.'" class="product_image"><img style="height: 18em;" src="'.base_url().'uploads/product/'.$w->thumb.'" alt="'.$w->nm_product.'"></a>
												<div class="product_info">
												'.$discount.$sold_out.'
													<h3><a href="'.site_url('detail/'.$w->idx_product.'/'.strtolower(str_replace(" ","-",$w->nm_product))).'" title="'.$w->nm_product.'">'.$w->nm_product.'</a></h3>
													<div class="pr_price"> <big style="font-size: 16px;">'.$harga.'</big>'.$harga_discount.'</div>
													<div class="pr_attr'.$n.'" style="display:none;">';
													if($page->sold_out($w->idx_product,$w->type_product)){
														echo'<small style="color:red!important;">Tambahkan ke wishlist untuk pre order</small>';
													}else{
														$Qattr=$page->get_attribute_group($w->idx_product);
														echo'
															<small>'.$Qattr->row()->nm_attribute.'</small>
															<table class="tb">
																<tr>';
																	foreach($Qattr->result() as $rattr){
																		echo'<td><span>'.$rattr->desc_attribute.'</span></td>';
																	}
																echo'</tr>
															</table>';
														if($page->free_ongkir($w->idx_product)>0){
															echo'<small>Pengiriman Gratis</small>';
														}
													}
													echo'
													</div>
												</div>
													
												<div class="price_info">
													<button class="price_add" onClick=window.location="'.site_url('detail/'.$w->idx_product.'/'.strtolower(str_replace(" ","-",$w->nm_product))).'" title="'.$w->nm_product.'" type="button"><span class="pr_price">Pesan</span><span class="pr_add">Pesan</span></button>
												</div>
											</li>
										
										';
								$n++;
								}
								
							}
							?>
                </ul>
				</div>
				<div disabled="disabled" style="display: block;" class="jcarousel-prev jcarousel-prev-horizontal jcarousel-prev-disabled jcarousel-prev-disabled-horizontal"></div>
				<div style="display: block;" class="jcarousel-next jcarousel-next-horizontal"></div>
				</div>
				</div>
            </div>
            <!--Product List Ends-->
             <!--Product List Starts-->
            <div class="products_list products_slider">
                <h2 class="sub_title">Produk Terlaris</h2>
                <div class=" jcarousel-skin-tango"><div style="position: relative; display: block;" class="jcarousel-container jcarousel-container-horizontal">
				<div style="position: relative;" class="jcarousel-clip jcarousel-clip-horizontal">
				<ul style="overflow: hidden; position: relative; top: 0px; margin: 0px; padding: 0px; left: 0px; width: 1612px;" id="first-carousel" class="first-and-second-carousel jcarousel-list jcarousel-list-horizontal">
                   <?php
							$i=1;
							if($best_seller->num_rows()>0){
								foreach($best_seller->result() as $w){
									$harga_discount='';
									$harga='Rp. '.number_format($w->harga,0,',','.');
									$discount		='';
									$sold_out		='';
									if($page->check_promo($w->idx_product)->num_rows()>0)
									{
										$pr=$page->check_promo($w->idx_product)->row();
										if($pr->idx_type_promo==1){
											$harga_discount	='<small>Rp. '.number_format($w->harga,0,',','.').'</small>';
											$harga			=$w->harga-($w->harga*$pr->discount/100);
											$harga			='Rp. '.number_format($harga,0,',','.');
											$discount		='<span class="reduction"><span>-'.number_format($pr->discount,0,',','').'%</span></span>';
										}
									}else{
										if($w->discount>0){
											$harga_discount	='<small>Rp. '.number_format($w->harga,0,',','.').'</small>';
											$harga			='Rp. '.number_format($w->harga_discount,0,',','.');
											$discount		='<span class="reduction"><span>-'.number_format($w->discount,0,',','').'%</span></span>';
										}
									}
									if($page->sold_out($w->idx_product,$w->type_product)){
										$sold_out		='<span class="sold_out"><span>SOLD OUT</span></span>';
									}
										echo'
											<li jcarouselindex="'.$i.'" onmouseover=$(".prl_attr'.$i.'").show() onmouseout=$(".prl_attr'.$i.'").hide() style="float: left; list-style: none outside none;" class="jcarousel-item jcarousel-item-horizontal jcarousel-item-1 jcarousel-item-1-horizontal"> 
												<a href="'.site_url('detail/'.$w->idx_product.'/'.strtolower(str_replace(" ","-",$w->nm_product))).'" title="'.$w->nm_product.'" class="product_image"><img style="height: 18em;" src="'.base_url().'uploads/product/'.$w->thumb.'" alt="'.$w->nm_product.'"></a>
												<div class="product_info">
												'.$discount.$sold_out.'
													<h3><a href="'.site_url('detail/'.$w->idx_product.'/'.strtolower(str_replace(" ","-",$w->nm_product))).'" title="'.$w->nm_product.'">'.$w->nm_product.'</a></h3>
													<div class="pr_price"> <big style="font-size: 16px;">'.$harga.'</big>'.$harga_discount.'</div>
													<div class="prl_attr'.$i.'" style="display:none;">';
													if($page->sold_out($w->idx_product,$w->type_product)){
														echo'<small style="color:red!important;">Tambahkan ke wishlist untuk pre order</small>';
													}else{
														$Qattr=$page->get_attribute_group($w->idx_product);
														echo'
															<small>'.$Qattr->row()->nm_attribute.'</small>
															<table class="tb">
																<tr>';
																	foreach($Qattr->result() as $rattr){	
																		$stock=$rattr->stock-$rattr->stock_akhir;
																		echo'<td><span>'.$rattr->desc_attribute.'</span></td>';
																	}
																echo'</tr>
															</table>';
														if($page->free_ongkir($w->idx_product)>0){
															echo'<small>Pengiriman Gratis</small>';
														}
													}
													echo'
													</div>
												</div>
													
												<div class="price_info">
													<button class="price_add" onClick=window.location="'.site_url('detail/'.$w->idx_product.'/'.strtolower(str_replace(" ","-",$w->nm_product))).'" title="'.$w->nm_product.'" type="button"><span class="pr_price">Pesan</span><span class="pr_add">Pesan</span></button>
												</div>
											</li>
										
										';
								$i++;
								}
								
							}
							?>
                </ul>
				</div>
				<div disabled="disabled" style="display: block;" class="jcarousel-prev jcarousel-prev-horizontal jcarousel-prev-disabled jcarousel-prev-disabled-horizontal"></div>
				<div style="display: block;" class="jcarousel-next jcarousel-next-horizontal"></div>
				</div>
				</div>
            </div>
            <!--Product List Ends-->
            <!--Newsletter_subscribe Starts-->
        	<span id="ajax-status"></span>
		<span id="message"></span>
            <div class="subscribe_block">
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