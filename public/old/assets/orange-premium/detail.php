<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="description" content="<?=$identitas->description?>,<?=$product->tag_desc?>"/>
<meta name="author" content="<?=$identitas->site_title?>">
<meta property="og:url" content="<?='http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>">
<meta name="keywords" content="<?=$identitas->keyword.','.$tag?>" />
<meta property="og:title" content="<?=$site_title?>">
<meta property="og:description" content="<?=$identitas->description?>,<?=$product->tag_desc?>">
<meta property="og:image" content="<?=base_url().'uploads/'.$identitas->logo?>">
<title><?=$site_title?></title>
<?php $this->load->view('template/demo/resource'); ?>
<script type="text/javascript" src="<?=$assets.$template?>/js/jquery.blockUI.js"></script>
<script src="<?=$assets.$template?>/js/jquery.elevatezoom.js" type="text/javascript"></script>
<script type="text/javascript" src="<?=$assets.$template?>/js/jquery.form.js"></script>
<script type="text/javascript" src="<?=$assets.$template?>/js/jquery.rate-1.4.1.js"></script>
<link rel="stylesheet" href="<?=$assets.$template?>/css/form_style.css">
<script type="text/javascript" src="<?=$assets.$template?>/js/jquery.lightbox-0.5.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?=$assets.$template?>/css/jquery.lightbox-0.5.css" media="screen" />
<!-- mobile setting -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
</head>
<body>
<div id="fb-root"></div>
<script>
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>
<style>
.fb_iframe_widget iframe{position:static;}
.bx-share{float: left;margin: 2px;}
</style>
<div class="wrapper">
    <!--HEADER-->
		<?php $this->load->view('template/demo/header'); ?>
	<!--HEADER-->
	<div class="section_container">
    <!--Mid Section Starts-->
    <section>
	<!--breadcrumb-->
     <ul class="breadcrumb">
	 <?php
		$parent	=$detail->parent_product($product->category_product);
		foreach($parent->result() as $wcp){
			echo'<li><a href="#" style="cursor: default;">'.$detail->get_nm($wcp->idx_path).'</a></li>';
		}
		echo'<li><a href="#" style="cursor: default;">'.$detail->get_nm($product->category_product).'</a></li>';
		echo'<li class="active"><a href="#" style="cursor: default;">'.$product->nm_product.'</a></li>';
	 ?>
	 </ul>
	 <!--/breadcrumb-->
      <!--PRODUCT DETAIL STARTS-->
      <div id="product_detail"> 
        <!--Product Left Starts-->
        <div class="product_leftcol">		<div class="clearfix">
			<img id="zoom_01" class="respond-img static" title="<?=$product->nm_product?>" src="<?=base_url().'uploads/product/'.$product->path_image?>" data-zoom-image="<?=base_url().'uploads/product/'.$product->path_image?>">		</div>		<div class="clearfix">
			<div id="gallery_01">
			<?php
				foreach($gallery->result() as $wg){
					$pimg=str_replace(".","_thumb.",$wg->path_image);
					echo'<a href="#" data-image="'.base_url().'uploads/product/'.$wg->path_image.'" data-zoom-image="'.base_url().'uploads/product/'.$wg->path_image.'">
							<img id="'.$wg->path_image.'" src="'.base_url().'uploads/product/'.$pimg.'" />
						  </a>';
				}
				
				echo'<a href="#" data-image="'.base_url().'uploads/product/'.$product->path_image.'" data-zoom-image="'.base_url().'uploads/product/'.$product->path_image.'">
							<img id="'.$product->path_image.'" src="'.base_url().'uploads/product/'.$product->path_image.'" />
						  </a>';
			?>
			</div>		</div>
		</div>
        <!--Product Left Ends--> 
        <!--Product Right Starts-->
        <div class="product_rightcol">
          <h1><?=$product->nm_product?></h1>
		  <div class="short-code msg error" style="display:none"></div>
          <p class="short_dc"><?=$product->ket?></p>
		  <?php
			$harga_discount='';
			$harga='Rp. '.number_format($product->harga,0,',','.');
			/*---Check Promo Discount---*/
			if($this->page_model->check_promo($product->idx_product)->num_rows()>0)
			{
				$pr=$this->page_model->check_promo($product->idx_product)->row();
				if($pr->idx_type_promo==1){
					$harga_discount	='<small>Rp. '.number_format($product->harga,0,',','.').'</small>';
					$harga			=$product->harga-($product->harga*$pr->discount/100);
					$harga			='Rp. '.number_format($harga,0,',','.');
				}
			}
			/*---Check Promo Discount---*/
			if($product->discount>0){
				$harga_discount	='<small>Rp. '.number_format($product->harga,0,',','.').'</small>';
				$harga			='Rp. '.number_format($product->harga_discount,0,',','.');	
			}
		  
		  ?>
		<div class="pr_price"> <big><?=$harga?></big><?=$harga_discount?> </div>
		<?php 
			$nm_attribute	=$attribute->row()->nm_attribute;
			if($product->type_product<>3){
					echo'<div class="size_info">
							<div class="size_sel">
								<label>'.$nm_attribute.':</label>
								<select id="attribute">
									<option value="">Pilih '.$nm_attribute.'</option>';
									foreach($attribute->result() as $attr){
										echo'<option value="'.$attr->idx_attribute_product.'" >'.$attr->desc_attribute.'</option>';
									}
								echo'
								</select>
							</div>
							<div class="stock">
								<label>Stok :</label>
								<label id="stok"></label>
							</div>
							';
							if($product->idx_ukuran<>0){
							echo'
							<div class="stock" id="gallery">
								<label><a href="'.base_url().'uploads/ukuran/'.$detail->get_panduan($product->idx_ukuran).'" title="Tabel Ukuran">Tabel Ukuran</a></label>
							</div>';
							}
							echo'
						</div>
						<div class="qty_info">
							<div class="quantity">
								<label style="width: 47px;">Beli :</label>
								<input type="number" min="1" value="1" class="qty_box"  id="jumlah_beli" style="width: 4em;">
							</div>
						</div>';
			}else{
				$stock	=$attribute->row()->stock -  $attribute->row()->stock_akhir;
				if($stock>$attribute->row()->minimum_stock){
					$label_stock="<b style='color:green;'>Tersedia</b>";
				}elseif(($stock<=$attribute->row()->minimum_stock)&&($stock<>0)){
					$label_stock="<b style='color:red;'>Terbatas (Tesedia ".$stock." Lagi)</b>";
				}else{
					$label_stock="<b style='color:red;'>Sold out</b>";
				}
				echo'<div class="size_info">
							<div class="size_sel">
								<label>'.$nm_attribute.':</label>';
								foreach($attribute->result() as $attr){
										echo'<label >'.$attr->desc_attribute.'</label>';
									}
							echo'</div>
							<div class="stock">
								<label>Stok :</label>
								<label id="stok">'.$label_stock.'</label>
							</div>
							';
							if($product->idx_ukuran<>0){
							echo'
							<div class="stock" id="gallery">
								<label><a href="'.base_url().'uploads/ukuran/'.$detail->get_panduan($product->idx_ukuran).'" title="Tabel Ukuran">Tabel Ukuran</a></label>
							</div>';
							}
							echo'
						</div>
						<div class="qty_info">
							<div class="quantity">
								<label style="width: 47px;">Beli :</label>
								<input type="number" value="1" min="1"  class="qty_box"  id="jumlah_beli" style="width: 4em;">
							</div>
						</div>';
			}
		?>
          
          <div class="add_to_buttons">
            <button class="add_cart" id="add_cart">Add to Cart</button>
			<?php if($fl_promo==1){ echo'
			<span>atau</span>
            <ul>
              <li><a href="javascript:void();" id="add_wishlist">+ Tambahkan ke Wishlist</a></li>
            </ul>';
			}
			?>
          </div>
          <div class="product_overview">
            <h4>Spesifikasi</h4>
            <ul>
            <?=$product->spesifikasi?>
            </ul>
          </div>
		<div class="add_to_buttons">
		<div class='bx-share'>
		<div id="fb-root"></div>
		<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/id_ID/all.js#xfbml=1";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>
            <div class="fb-share-button" style="top: -2px;" data-href="<?=basename($_SERVER['REQUEST_URI'])?>" data-type="button" data-width="0" data-height="10"></div>
		</div>
		<div class='bx-share'>
		<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
		<a href="<?=basename($_SERVER['REQUEST_URI'])?>" class="twitter-share-button" data-count="none">Tweet</a>
		</div>
		<div class='bx-share'>
			<div class="g-plus"  data-action="share" data-annotation="none"></div>
		</div>
		</div>
		  
        </div>
        <!--Product Right Ends--> 
        <!--Tabs-->
		<div id="tabber33" class="simpleTabs">
		    <ul class="simpleTabsNavigation">
		      <li><a class="current" id="Review_Produk" href="javascript:void();">Review Produk (<?=$rate->num_rows()?>)</a></li>
		    </ul>
		    <div id="Review_Produk" class="simpleTabsContent currentTab">
			<p class='sub-title'>Kami ingin mengetahui opini anda tentang produk ini</p>
			<?php foreach($rate->result() as $wr){
				echo'
					<div class="bx-com">
						<p><b>'.$wr->nama.' </b>';
							for($i=0;$i<$wr->score_rated;$i++){
								echo'<img src="'.$assets.'demo/images/True.png" width="15">';
							}
						echo'</p>
						<p>'.$wr->komentar.'</p>
					</div>
				';
			}
			?>
				<form class="form1" id="frm_comment" action="<?=site_url('customer/comment')?>" method="POST">
				<div class="col-tab-rate">
				<span id="ajax-status"></span>
				<span id="message"></span>
					<div data-role="fieldcontain" id="rate">
						<label>Rate</label>
						<div id="ratingRadios">
							<input type="radio" name="score_rated" id="rating1" value="1" />
							<input type="radio" name="score_rated" id="rating2" value="2" />
							<input type="radio" name="score_rated" id="rating3" value="3" />
							<input type="radio" name="score_rated" id="rating4" value="4" />
							<input type="radio" name="score_rated" id="rating5" value="5" />
						</div>
					</div>
				</div>
				<div class="col-tab">
					<div class="input">
							<div class="inputtext"><em>*</em>Nama</div>
							<div class="inputcontent">
								<input type="text" name="nama" required id="nama"/>
								<input type="hidden" name="idx_product" value="<?=$product->idx_product?>" id="idx_product"/>
							</div>
						</div>
						<div class="input nobottomborder">
							<div class="inputtext"><em>*</em>Komentar</div>
							<div class="inputcontent">
								<textarea name="komentar" required id="komentar"></textarea>
							</div>
						</div>
						<br>
						<div class="buttons">
							<input class='sc-button small green' type="submit" value="Kirim Komentar" />
						</div>
				</div>
				</form>
		    </div>
		</div>
          <!--Tabs-->        
      </div>
      <!--PRODUCT DETAIL ENDS--> 
      <style>
		.bx-com{border-bottom: 1px solid #bbb;padding: 0;}
		.bx-com p{padding: 5px!important;}
		.col-tab{width: 60%;padding: 5px 0;}
		.col-tab-rate{width: 60%;padding: 5px 20px;}
		.simpleTabsContent .sub-title{font-weight: bold;padding: 10px 0px!important;border-bottom: 1px solid #bbb;margin-bottom: 10px;	}	
		.col-tab-rate label{padding: 5px 15% 5px 8px!important;}
	  </style>
	   <!--Product List Starts-->
            <div class="products_list products_slider">
                <h2 class="sub_title">Produk Lainnya</h2>
                <div class=" jcarousel-skin-tango"><div style="position: relative; display: block;" class="jcarousel-container jcarousel-container-horizontal">
				<div style="position: relative;" class="jcarousel-clip jcarousel-clip-horizontal">
				<ul style="overflow: hidden; position: relative; top: 0px; margin: 0px; padding: 0px; left: 0px; width: 1612px;" id="first-carousel" class="first-and-second-carousel jcarousel-list jcarousel-list-horizontal">
                    <?php
							$n=1;
							if($list_other_product->num_rows()>0){
								foreach($list_other_product->result() as $w){
									$harga_discount='';
									$harga='Rp. '.number_format($w->harga,0,',','.');
									$discount		='';
									$sold_out		="";
									if($detail->check_promo($w->idx_product)->num_rows()>0)
									{
										$pr=$detail->check_promo($w->idx_product)->row();
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
									if($detail->sold_out($w->idx_product,$w->type_product)){
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
													if($detail->sold_out($w->idx_product,$w->type_product)){
														echo'<small style="color:red!important;">Tambahkan ke wishlist untuk pre order</small>';
													}else{
														$Qattr=$detail->get_attribute_group($w->idx_product);
														echo'
															<small>'.$Qattr->row()->nm_attribute.'</small>
															<table class="tb">
																<tr>';
																	foreach($Qattr->result() as $rattr){	
																		$stock=$rattr->stock-$rattr->stock_akhir;
																			if($stock>0){
																				echo'<td><span title="Stok :'.$stock.'">'.$rattr->desc_attribute.'</span></td>';
																			}
																	}
																echo'</tr>
															</table>';
														if($detail->free_ongkir($w->idx_product)>0){
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
    </section>
    <!--Mid Section Ends--> 

    </div>
    <div class="footer_container">
        <!--Footer Starts-->
       <?php $this->load->view('template/demo/footer'); ?>
	   <!--Footer Ends-->
    </div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$('#gallery a').lightBox();
		$("#zoom_01").elevateZoom({
		  zoomType:"lens",
		  lensShape:"round",
		  lensSize: 250,
		  gallery:'gallery_01', cursor: 'pointer', galleryActiveClass: "active", imageCrossfade: true
		});
		$('#rate').rate({imagePath: '<?=$assets.$template?>/images/'});
		$("#attribute").change(function(){
			if($("#attribute").val()!=""){
				$.ajax({
					url: '<?=site_url('page/look_stock')?>',
					data:'idx_attribute_product='+$("#attribute").val(),
					type: "POST",
					dataType: 'json',
					success: function (html) {
						$("#stok").html(html.mes);
					}
				});	
			}else{
				$("#stok").html('');
			}
		});
		/*-------Add to cart-------------*/
		$("#add_cart").click(function(){
			if(validation()){
				$.ajax({
					url: '<?=site_url('page/add_cart')?>',
					<?php if($product->type_product==3){ ?>
					data: { idx_product:<?=$product->idx_product?>, jumlah_beli: $("#jumlah_beli").val()},
					<?php }else{ ?>
					data: { idx_product:<?=$product->idx_product?>, jumlah_beli: $("#jumlah_beli").val(), attribute: $("#attribute").val()},
					<?php } ?>
					type: "POST",
					dataType: 'json',
					success: function (data){
						if(data.error==0){
							loading(data.message);
							location.reload();
						}else{
							$(".error").html(data.message);
							$(".error").show();
							return false;
						}
					}
				});
			}
		});
		/*-------End of Add to cart-------------*/
		<?php if($fl_promo==1){ ?>
		/*-------Add to wishlist-------------*/
		$("#add_wishlist").click(function(){
			<?php if(($this->session->userdata('set_login_cus')==TRUE)){ ?>
			if(validation()){
				$.ajax({
					url: '<?=site_url('customer/add_wishlist')?>',
					<?php if($product->type_product==3){ ?>
					data: { idx_product:<?=$product->idx_product?>, jumlah_beli: $("#jumlah_beli").val()},
					<?php }else{ ?>
					data: { idx_product:<?=$product->idx_product?>, jumlah_beli: $("#jumlah_beli").val(), attribute: $("#attribute").val()},
					<?php } ?>
					type: "POST",
					success: function (){
							location.reload();
					}
				});
				
			loading("Berhasil Ditambah ke Wishlist");
			}
			<?php }else{ ?>
				window.location="<?=site_url('page/login_user')?>";
			<?php }	?>
		});
		/*-------End of Add to wishlist-------------*/
		<?php }	?>
		function loading(mes){
			$.blockUI({ 
				css: { 
				border: 'none', 
				padding: '15px', 
				backgroundColor: '#000', 
				'font-weight':'bold',
				'-webkit-border-radius': '10px', 
				'-moz-border-radius': '10px', 
				opacity: .5, 
				color: '#fff',
				'font-size':'1em'
				}
			,message:mes }); 
			setTimeout($.unblockUI, 1000);
		}
		/*------------Validasi ------------------*/
		function validation(){
			<?php if($product->type_product<>3){ ?>
				if((!$("#jumlah_beli").val())||(!$("#attribute").val())){
					var message='<span>Silahkan isi Jumlah beli dan Attribute produk</span>';
					$(".error").html(message);
					$(".error").show();
					return false;
				}else{
					return true;
				}
			<?php }else{ ?>
				if(!$("#jumlah_beli").val()){
					var message='<span>Silahkan isi Jumlah beli</span>';
					$(".error").html(message);
					$(".error").show();
					return false;
				}else{
					return true;
				}
			<?php } ?>
		}
		/*------------Validasi ------------------*/
		$('#ajax-status').hide();
		$('#message').hide();
		$('#frm_comment').ajaxForm({
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