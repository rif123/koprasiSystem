<!DOCTYPE html>
<html>
<head>
<title><?=$site_title?></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="description" content="<?=$identitas->description?>"/>
<meta name="author" content="<?=$identitas->site_title?>">
<meta property="og:url" content="<?='http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>">
<meta name="keywords" content="<?=$identitas->keyword?>" />
<meta property="og:title" content="<?=$site_title?>">
<meta property="og:description" content="<?=$identitas->description?>">
<meta property="og:image" content="<?=base_url().'uploads/'.$identitas->logo?>">
<?php $this->load->view('template/demo/resource'); ?>
<script type="text/javascript" src="<?=$assets.$template?>/js/jquery.pajinate.js"></script>
<script type="text/javascript" src="<?=$assets.$template?>/js/jquery.blockUI.js"></script>
<script type="text/javascript" src="<?=$assets.$template?>/js/jquery.form.js"></script>
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
           <!--MAIN CONTENT STARTS-->
            <div id="main_content" style="width:100%;">
               <!-- <div class="category_banner"> <img src="Leisure%20Magento%20Theme_productlist_files/promo_cat_banner.jpg"> </div>-->
				<ul class="breadcrumb">
					<li><a href="<?=site_url()?>" title='<?=$identitas->site_title?>' style="cursor: default;">Home</a></li>
					<li class="active"><a href="#" title='Katalog' style="cursor: default;">Cari Produk</a></li>
				</ul>
				<p style="padding: 12px 0;font-size: 14px;">Pencarian untuk kata kunci <b><?=$key?></b></p>
				<?php if($list_product_search->num_rows()>0){	?>
                <!--Product List Starts-->
                <div class="products_list products_slider">
                    <ul class="alt_content">
						<?php 
							$n=1;
							if($list_product_search->num_rows()>0){
								foreach($list_product_search->result() as $w){
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
					<div class="alt_page_navigation"></div>
				</div>
                <!--Product List Ends-->
               <?php }else{
				echo"<p style='padding: 10px 10px;font-size: 15px;color: #E25050;'>Tidak ada produk pada kategori ini.</p>";
			   }
			   ?>
            </div>
            <!--MAIN CONTENT ENDS-->
             <!--Newsletter_subscribe Starts-->
            <div class="subscribe_block">
            <span id="ajax-status"></span>
	     <span id="message"></span>
                <div class="find_us">
                    <h3>Temukan Kami</h3>
                    <a class="twitter" href="http://www.<?=$identitas->twitter?>" target="_blank"></a>
					<a class="facebook" href="http://www.<?=$identitas->facebook?>" target="_blank"></a>
					<a class="rss" href="#"></a> </div>
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
</body>
</html>
