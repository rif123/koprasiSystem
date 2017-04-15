<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="description" content="<?=$identitas->description?>"/>
<meta name="author" content="<?=$identitas->site_title?>">
<meta property="og:url" content="<?='http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>">
<meta name="keywords" content="<?=$identitas->keyword?>,Pembayaran,Chekcout" />
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
			<?php $this->load->view('template/demo/header_2'); ?>
		<!---HEader----->
    </div>
 <div class="section_container" style="border-top: 1px solid #C2BEBE;">
        <!--Mid Section Starts-->
        <section>
		<form class="form1" id="frm_checkout" method="POST" action="<?=site_url("checkout/proses")?>">
		    <div class="full_page">
                <h4>Silahkan isi Data diri dan alamat pengiriman.<a class='katalog' href="<?=site_url('page/shop')?>">Kembali ke Katalog</a></h4>
				<div class="col-left">
					<h3>Identitas Pembeli<em>* Wajib diisi<em></h3>
					<span id="ajax-status"></span>
					<span id="message"></span>
					
						<div class="input">
							<div class="inputtext"><em>*</em>Email</div>
							<div class="inputcontent">
								<input type="hidden" name="idx_pelanggan" value="<?=$idx_pelanggan?>"/>
								<input type="text" <?=$readonly?>  name="email" value="<?=$email?>" placeholder="Email" id="email" />
							</div>
						</div>
						<?php 
						if($password==""){
							echo'
								<div class="input">
									<div class="inputtext"><em>*</em>Password</div>
									<div class="inputcontent">
										<input type="password" name="password" id="password" />
									</div>
								</div>						
							';
						}else{
							echo'
								<input type="hidden" value="'.$password.'" name="password" id="password" />
							';
						}
						?>
						
						<div class="input">
							<div class="inputtext"><em>*</em>Nama Lengkap</div>
							<div class="inputcontent">
								<input type="text"  name="full_name"  value="<?=$full_name?>" placeholder="Nama Lengkap" id="full_name" />
							</div>
						</div>
						<?php if(!is_numeric($idx_pelanggan)){ ?>
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
						<?php } ?>
						<div class="input">
							<div class="inputtext"><em></em>Telepon</div>
							<div class="inputcontent">
								<input type="text"  placeholder="Telepon" value="<?=$no_telepon?>" name="no_telepon" class="dev" id="no_telepon" />
							</div>
						</div>
						<div class="input">
							<div class="inputtext"><em>*</em>Handphone</div>
							<div class="inputcontent">
								<input type="text"  name="hp" class="dev" value="<?=$hp?>" placeholder="No Handphone" id="hp" />
							</div>
						</div>
						<div class="input">
							<div class="inputtext"><em>*</em>Alamat</div>
							<div class="inputcontent">
								<input type="text" name="alamat"  placeholder="Alamat" value="<?=$alamat?>" id="alamat" />
							</div>
						</div>
						<div class="input">
							<div class="inputtext"><em>*</em>Provinsi</div>
							<div class="inputcontent">
								<select onChange="count_price()" name="provinsi" id="provinsi">
								<option value="">--Pilih Provinsi--</option>
									<?php
										foreach($shipping->result() as $s){
											$selected="";
											if($provinsi==$s->provinsi){
												$selected="selected";
											}
											echo'<option '.$selected.' value="'.$s->provinsi.'">'.$s->provinsi.'</option>';
										}
									?>
								</select>
							</div>
						</div>
						<div class="input">
							<div class="inputtext"><em>*</em>Kota/Kabupaten</div>
							<div class="inputcontent">
								<select onChange="count_price()" name="kota" id="kota">
									<?php
									if($kec){
										echo'<option selected value="'.$kota.'">'.$kota.'</option>';
									}
									?>
								</select>
							</div>
						</div>
						<div class="input">
							<div class="inputtext"><em>*</em>Kecamatan</div>
							<div class="inputcontent">
								<select name="kec" onChange="count_price()" id="kec">
								<?php
								if($kec){
									echo'<option selected value="'.$zona.'|'.$city_code.'|'.$kec.'">'.$kec.'</option>';
								}
								?>
								</select>
							</div>
						</div>
						<div class="input">
							<div class="inputtext"><em></em>Kode Pos</div>
							<div class="inputcontent">
								<input type="text" class="dev" placeholder="Zip Kode" value="<?=$zip_code?>"  name="zip_code" id="zip_code" />
							</div>
						</div>
						<?php
						if(!$idx_pelanggan){
						echo'
						<div class="input">
							<div class="inputcontent" style="width:7%;">
								<input type="checkbox" name="fl_newsletter" checked id="fl_newsletter" />
							</div>
							<div class="inputtext" style="width:70%;padding: 2px;">Daftar Newsletter</div>
						</div>';
						}?>
						<div class="input">
							<div class="inputcontent" style="width:7%;">
								<input type="checkbox" name="fl_drop_shipper" onClick="count_price()" checked id="fl_drop_shipper" />
							</div>
							<div class="inputtext" style="width:70%;padding: 2px;">Kirim ke alamat yg sama</div>
							
						</div>
						
						<div class="input">
							<div class="inputcontent" style="width:7%;">
							</div>
							<div class="inputtext" style="width:70%;padding: 0 10px;font-size: 10px;color: red;">* Hapus Checklist untuk Dropship</div>
						</div>
						<div id="drop_shipper">
							<h3>Alamat Pengiriman</h3>
							<div class="input">
								<div class="inputtext"><em>*</em>Nama Lengkap</div>
								<div class="inputcontent">
									<input type="text" name="full_name_2" placeholder="Nama Lengkap" id="full_name_2" />
								</div>
							</div>
							<div class="input">
								<div class="inputtext"><em></em>Telepon</div>
								<div class="inputcontent">
									<input type="text" placeholder="Telepon"  name="no_telepon_2" class="dev" id="no_telepon_2" />
								</div>
							</div>
							<div class="input">
								<div class="inputtext"><em>*</em>Handphone</div>
								<div class="inputcontent">
									<input type="text" name="hp_2" class="dev" placeholder="No Handphone" id="hp_2" />
								</div>
							</div>
							<div class="input">
								<div class="inputtext"><em>*</em>Alamat</div>
								<div class="inputcontent">
									<input type="text" name="alamat_2" placeholder="Alamat" id="alamat_2" />
								</div>
							</div>
							<div class="input">
								<div class="inputtext"><em>*</em>Provinsi</div>
								<div class="inputcontent">
									<select onChange="count_price()" name="provinsi_2" id="provinsi_2">
									<option value="">--Pilih Provinsi--</option>
										<?php
											foreach($shipping->result() as $s){
												echo'<option value="'.$s->provinsi.'">'.$s->provinsi.'</option>';
											}
										?>
									</select>
								</div>
							</div>
							<div class="input">
								<div class="inputtext"><em>*</em>Kota/Kabupaten</div>
								<div class="inputcontent">
									<select name="kota_2" onChange="count_price()" id="kota_2">
									</select>
								</div>
							</div>
							<div class="input">
								<div class="inputtext"><em>*</em>Kecamatan</div>
								<div class="inputcontent">
									<select name="kec_2" onChange="count_price()" id="kec_2">
									</select>
								</div>
							</div>
							<div class="input">
								<div class="inputtext"><em></em>Kode Pos</div>
								<div class="inputcontent">
									<input type="text" class="dev" placeholder="Zip Kode" name="zip_code_2" id="zip_code_2" />
								</div>
							</div>
						</div>
				</div>
				<div class="col-right">
					<!--<h3>Metode Pembayaran</h3>-->
						
					<h3>Pesanan Anda</h3>
						<div class="cart_table" style="margin:15px">
						<table class="data-table cart-table" id="shopping-cart-table" cellpadding="0" cellspacing="0">
							<tbody>
							<tr>
							  <th colspan="2">Produk</th>
							  <th class="align_center" width="12%">Harga</th>
							  <th class="align_center" width="12%">Diskon</th>
							  <th class="align_center" width="10%">Jumlah</th>
							  <th class="align_center" width="12%">Subtotal Produk</th>
							</tr>
							<?php
							$subtotal=0; $free=0;$berat	=0;$subtotal_produk	=0;$syarat='';
							//if($from=="cart"){							
								/*---------------Checkout from cart--------------------*/ 
								foreach($this->cart->contents() as $item){									$id=$item['id'];
									$elm_product	=$this->db->query("SELECT a.*,b.stock-stock_akhir as total_stock FROM product a join attribute_product b on a.idx_product=b.idx_product where a.idx_product='$id'")->row();									$mes_stock		="";
									$promo_message	="";									if($elm_product->total_stock==0){										$mes_stock	="<p style='color:red;font-size:8px;'>Sold Out</p>";										$style		="style='background: #EBEBEB;text-decoration: line-through;'";									}else{										$mes_stock	="<p style='color:green;font-size:8px;'>Stok Tersedia</p>";										$style		="";									}
									/*---Check Promo & Discount---*/
										$discount	=$elm_product->discount;
										if($checkout->promo_persentasi($item['id'])<>false){
											$discount		=$checkout->promo_persentasi($item['id']);
											$promo_message	="Promo Diskon ".$discount." %";
										}
									/*---Check Promo & Discount---*/
									/*---Check Promo Bogof---*/
										if($checkout->promo_bogof($item['id'])->num_rows()>0){
											$promo_message	=$checkout->promo_bogof($item['id'])->row()->bogof_caption;
										}
									/*---Check Promo Bogof---*/
									if($fl_shipping==1){
									/*---Check Promo Ongkir---*/
										if($checkout->free_ongkir($item['id'])==0){
											$free=$free+1;
										}else{
											$promo_message	="Gratis Pengiriman";
											$syarat='<tr>
														<td colspan="2" class="align_left" width="50%"><a style="text-transform: uppercase;color: red;font-size: .8em;" href="javascript:void()" onClick=window.open("'.site_url('promo/syarat').'","_blank","width=800,height=500,scrollbars=yes,status=yes,resizable=yes,screenx=0,screeny=0"); title="Persyaratan gratis pengiriman">Persyaratan gratis pengiriman</a></td>
													</tr>';
										}
									/*---Check Promo Ongkir---*/
									}
									$price	=$elm_product->harga-($discount/100*$elm_product->harga);
									echo'
									<tr '.$style.'>
									  <td width="10%"><img style="width:100%" src="'.base_url().'uploads/product/'.$elm_product->thumb.'"></td>
									  <td class="align_left" width="44%"><a class="pr_name" href="#">'.$item['name'].'<p class="add">'.$promo_message.$mes_stock.'</p></a></td>
									  <td class="align_center vline"><span class="price">Rp.'.number_format($elm_product->harga,0,',','.').'</span></td>
									   <td class="align_center vline"><span class="price">'.$discount.' %</span></td>
									  <td class="align_center vline">'.$item['qty'].'</td>
									  <td class="align_center vline"><span class="price">Rp.'.number_format($price*$item['qty'],0,',','.').'</span></td>
									</tr>';																		if($elm_product->total_stock<>0){									
										$berat			=$berat + ($elm_product->berat*$item['qty']);										
										$subtotal		=$subtotal + ($price*$item['qty']);
										$subtotal_produk=$subtotal_produk+($price*$item['qty']);																		}
								}
								/*---------------Checkout from cart--------------------*/ 
							//}
							if($from=="wishlist"){
									$mes_stock		="";									$promo_message	="";									if($product_wishlist->total_stock==0){										$mes_stock	="<p style='color:red;font-size:8px;'>Sold Out</p>";										$style		="style='background: #EBEBEB;text-decoration: line-through;'";									}else{										$mes_stock	="<p style='color:green;font-size:8px;'>Stok Tersedia</p>";										$style		="";									}
									/*---Check Promo & Discount---*/
										$discount	=$product_wishlist->discount;
										if($checkout->promo_persentasi($idx_product)<>false){
											$discount		=$checkout->promo_persentasi($idx_product);
											$promo_message	="Promo Diskon ".$discount." %";
										}
									/*---Check Promo & Discount---*/
									/*---Check Promo Bogof---*/
										if($checkout->promo_bogof($idx_product)->num_rows()>0){
											$promo_message	=$checkout->promo_bogof($idx_product)->row()->bogof_caption;
										}
									/*---Check Promo Bogof---*/
									if($fl_shipping==1){
									/*---Check Promo Ongkir---*/
										if($checkout->free_ongkir($idx_product)==0){
											$free=$free+1;
										}else{
											$promo_message	="Gratis Pengiriman";
											$syarat='<tr>
														<td colspan="2" class="align_left" width="50%"><a style="text-transform: uppercase;color: red;font-size: .8em;" href="javascript:void()" onClick=window.open("'.site_url('promo/syarat').'","_blank","width=800,height=500,scrollbars=yes,status=yes,resizable=yes,screenx=0,screeny=0"); title="Persyaratan gratis pengiriman">Persyaratan gratis pengiriman</a></td>
													</tr>';
										}
									/*---Check Promo Ongkir---*/
									}
									$price	=$product_wishlist->harga-($discount/100*$product_wishlist->harga);
									echo'
									<tr '.$style.'>
									  <td width="10%"><img style="width:100%" src="'.base_url().'uploads/product/'.$product_wishlist->thumb.'"></td>
									  <td class="align_left" width="44%"><a class="pr_name" href="#">'.$product_wishlist->nm_product.'<p class="add">'.$promo_message.$mes_stock.'</p></a></td>
									  <td class="align_center vline"><span class="price">Rp.'.number_format($product_wishlist->harga,0,',','.').'</span></td>
									   <td class="align_center vline"><span class="price">'.$discount.' %</span></td>
									  <td class="align_center vline">'.$qty.'</td>
									  <td class="align_center vline"><span class="price">Rp.'.number_format($price*$qty,0,',','.').'</span></td>
									</tr>';								if($product_wishlist->total_stock<>0){
									$berat			=$berat + ($product_wishlist->berat*$qty);
									$subtotal		=$subtotal + ($price*$qty);
									$subtotal_produk=$subtotal_produk+($price*$qty);								}
							}
							?>
							<tr>
								<td colspan="4" class="align_center" style="text-align:right;"><b>Subtotal<b></td>
								<td colspan="2" class="align_center vline"><span class="price">Rp. <?=number_format($subtotal,0,',','.')?></span></td>
							</tr>
						  </tbody>
						 </table>
							<?php
								/*---Check Promo Pembelian---*/
									$promo_pembelian	="";
									$discount_max_pembelian	=0;
									if($discount_pembelian->num_rows>0){
										if($subtotal>=$discount_pembelian->row()->minimum_transaksi){
											$discount_max_pembelian	=$discount_pembelian->row()->discount;
											$subtotal				=$subtotal-($subtotal*$discount_max_pembelian/100);
											$promo_pembelian		='<tr>
																		<td colspan="1" class="align_left" width="55%">Diskon Pembelian</td>
																		<td class="align_left" style=""><span class="price"><b style="color:#50E00D">'.$discount_max_pembelian.' %</b></span></td>
																	</tr>';
										}
									}
								/*---Check Promo Pembelian---*/
							?>
						<!--Pengaturan shipping-->
						<input type="hidden" name="fl_set_shipping" value="<?=$fl_shipping?>" id="fl_set_shipping"/>
						<!--Promo pembelian-->
						<input type="hidden" name="discount_max_pembelian" value="<?=$discount_max_pembelian?>" id="discount_max_pembelian"/>
						<!--Promo gratis ongkir-->
						<input type="hidden" name="fl_free_shipping" value="<?=$free?>" id="fl_free_shipping"/>
						<!--data product-->
						<input type="hidden" name="berat" value="<?=$berat?>"/>
						<input type="hidden" name="total_harga" id="total_harga" value="<?=$subtotal?>"/>
						<input type="hidden" name="total_harga_produk" id="total_harga_produk" value="<?=$subtotal_produk?>"/>
						<!--Wishlist-->
						<input type="hidden" name="idx_wishlist" id="idx_wishlist" value="<?=$idx_wishlist?>"/>
						 <div class="totals">
							<table id="totals-table" style="width:55%">
								<tbody>
								<?php if($fl_shipping==1){ ?>
									<?=$syarat?>
									<tr class="expedisi_area">
									  <td colspan="1" class="align_left" width="50%">Pilih Expedisi</td>
									  <td class="align_left" width="55%"><input type="radio" onClick='count_price();' name="expedisi" checked value="reg" />JNE Reguler</td>
									</tr>
									<tr class="expedisi_area">
									  <td colspan="1" class="align_left" width="50%"></td>
									  <td class="align_left" width="55%"><input type="radio" onClick='count_price();' name="expedisi" value="oke" />JNE Oke</td>
									</tr>
									<tr class="expedisi_area">
									  <td colspan="1" class="align_left" width="50%"></td>
									  <td class="align_left" width="55%"><input type="radio" onClick='count_price();' name="expedisi" value="yes" />JNE Yes</td>
									</tr>
								<tr>
								  <td colspan="1" class="align_left" width="50%">Ongkos Kirim</td>
								  <td class="align_left"  width="55%"><span class="price" id="ongkir_dasar"></span></td>
								</tr>
								<tr>
								  <td colspan="1" class="align_left" width="50%">Berat</td>
								  <td class="align_left" width="55%"><?=($berat/1000)?> Kg</td>
								</tr>
								<tr>
								  <td colspan="1" class="align_left" width="50%">Total Ongkos Kirim</td>
								  <td class="align_left"  width="55%"><span class="price" id="ongkir"></span></td>
								</tr>
								<?php } ?>
								<?=$promo_pembelian?>
								<tr>
								  <td colspan="1" class="align_left total" width="50%">Total</td>
								  <td class="align_left"  width="55%"><span class="total" id="total"><?='Rp.'.number_format($subtotal,0,',','.')?></span></td>
								</tr>
								<?php if($fl_shipping==0){ ?>
								<tr>
								  <td colspan="2" class="align_left" width="50%"><p style="color:red;">* Harga belum termasuk ongkos kirim</p></td>
								</tr>
								<?php } ?>
								<tr>
								  <td colspan="2" class="align_left" width="50%"><input type="checkbox" name="fl_approve"><a style="color: #000;font-size: .9em;" href="javascript:void()" onClick=window.open("<?=site_url('page/syarat_dan_ketentuan')?>","_blank","width=800,height=500,scrollbars=yes,status=yes,resizable=yes,screenx=0,screeny=0"); title="Ketentuan dan Syarat">Setujui Syarat dan Ketentuan</a></td>
								</tr>
							</tbody>
							</table>
						  </div>
						</div>
					<input class='sc-button small green'style="float: right;margin-right: 3em!important;" id="Proses" type="button" value="Proses Checkout" />
				</div>
            </div>
		</form>
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
	function ListSelect(Obj,Trg,Source,Var,Type,Method){
		if($("#"+Obj).val()!=""){
			$.ajax({
				url: Source,
				data:Var+'='+$("#"+Obj).val(),
				type: Type,
				success: function (html) {
				if(Method=="html"){
					$("#"+Trg).html(html);		
				}
				if(Method=="append"){
					$("#"+Trg).append(html);
				}
				}
			});
		}else{
			$("#"+Trg).empty();
		}
	}
	function count_price(){
		if (typeof kalkulasi_harga == 'function'){ 
			kalkulasi_harga(); 
		}
	}
	<?php if($kec){ echo'window.onload=count_price;';}
	if($fl_shipping==1){
	echo"
		function kalkulasi_harga(){
			if(validasi_kalkulasi()){
				$.ajax({
					url: '".site_url('checkout/kalkulasi')."',
					data: $('#frm_checkout').serialize(),
					type: 'POST',
					dataType: 'json',
					success: function (data) {
						$('#ongkir').html(data.ongkir);
						$('#ongkir_dasar').html(data.ongkir_dasar);
						$('#total').html(data.total);
						if(data.gratis==1){
							$('.expedisi_area').hide();
						}else{
							$('.expedisi_area').show();
						}
					}
				});
			}
		}
		function validasi_kalkulasi(){
			if($('#fl_drop_shipper').is(':checked')==true){
				if(($('#kota').val()!='')&&($('#provinsi').val()!='')){
					return true;
				}else{
					return false;
				}
			}else{
				if(($('#kota_2').val()!='')&&($('#provinsi_2').val()!='')){
					return true;
				}else{
					return false;
				}
			}
		}";
	}
	?>
$(document).ready(function(){
	$("#tgl_lahir").datepicker({dateFormat: 'yy-mm-dd',changeMonth: true,changeYear: true,yearRange: "-100:+0"});
		$('#ajax-status').hide();
		$('#message').hide();
		$('#frm_checkout').ajaxForm({
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
	<?php if($kota){ echo 'ListSelect("provinsi","kota","'.site_url('checkout/look_kota').'","provinsi","POST","append");'; } ?>
	<?php if($kec){ echo 'ListSelect("kota","kec","'.site_url('checkout/look_kecamatan').'","kota","POST","append");'; } ?>
	$("#kota").change(function(){ ListSelect("kota","kec","<?=site_url('checkout/look_kecamatan')?>","kota","POST","html"); });
	$("#kota_2").change(function(){ ListSelect("kota_2","kec_2","<?=site_url('checkout/look_kecamatan')?>","kota","POST","html"); });
	$("#provinsi").change(function(){$("#kec").empty(); ListSelect("provinsi","kota","<?=site_url('checkout/look_kota')?>","provinsi","POST","html"); });
	$("#provinsi_2").change(function(){$("#kec_2").empty(); ListSelect("provinsi_2","kota_2","<?=site_url('checkout/look_kota')?>","provinsi","POST","html"); });
	$("#drop_shipper").hide();
	$("#fl_drop_shipper").click(function(){
		if($('#fl_drop_shipper').is(':checked')==true){
			$("#drop_shipper").hide();
		}else{
			$("#drop_shipper").show();
		}
	});
	$("#Proses").click(function(){
		$("#frm_checkout").submit();
	});
});
</script>
</body>
</html>