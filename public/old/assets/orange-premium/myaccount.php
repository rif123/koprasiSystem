<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
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
<script type="text/javascript" src="<?=$assets?>demo/js/jquery.form.js"></script>
<script type="text/javascript" src="<?=$assets?>demo/js/jquery.blockUI.js"></script>
<link rel="stylesheet" href="<?=$assets?>demo/css/form_style.css">
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
          <!--SIDE NAV STARTS-->
            <div id="side_nav">
                <div class="sideNavCategories">
                    <h3>My Account</h3>
                    <ul class="category collection">
						<li><a href="<?=site_url('page/my_account')?>" title="My Account">My Account</a></li>
                        <li><a href="<?=site_url('page/my_account/account')?>" title="Informasi Account">Informasi Account</a></li>
						<li><a href="<?=site_url('page/my_account/change_password')?>" title="Ganti Password">Ganti Password</a></li>
						<li><a href="<?=site_url('page/my_account/address')?>" title="Data Alamat">Data Alamat</a></li>
                        <li><a href="<?=site_url('page/my_account/order_history')?>" title="Riwayat Pesanan">Riwayat Pesanan</a></li>
						<?php if($fl_wishlist==1){ echo'
                        <li><a href="'.site_url('page/my_account/wishlist').'" title="Wishlist saya">Wishlist saya</a></li>';
						}
						?>
						<li><a href="<?=site_url('page/my_account/testimoni')?>" title="Berikan Testimoni">Berikan Testimoni</a></li>
						<?php if($fl_refund==1){
							echo'<li><a href="'.site_url('page/my_account/pengembalian').'" title="Laporkan">Pengembalian Barang</a></li>';
						}
						?>
						<li><a href="<?=site_url('page/my_account/laporkan')?>" title="Laporkan">Laporkan</a></li>
                    </ul>
                </div>
            </div>
            <!--SIDE NAV ENDS-->
           <!--MAIN CONTENT STARTS-->
            <div id="main_content" class='akun' style="margin:1px 5px;">
			<?php if(!$Target) { ?>
                <h3 class='account'>My Account</h3>
				<p><b>Hi <?=$this->session->userdata('full_name')?></b></p>
				<p>Anda dapat melihat semua aktivitas terbaru account dan memperbarui informasi 
				account Anda di Dashboard Account Anda. Pilih link dibawah ini untuk melihat atau edit informasi Anda</p>
				<div>
					<div class='box-inf'>
						 <h3 class='account'>Informasi Account</h3>
						 <p><?=$akun->full_name?></p>
						 <p><?=$akun->email?></p>
						 <p><?=$akun->no_telepon?></p>
						 <p><?=$akun->hp?></p>
						 <p><b><?=$newsletter_status?></b></p>
						<input class='sc-button small orange'	style="margin-top:2em!important;" onClick="window.location='<?=site_url('page/my_account/account')?>'" id="Proses" type="button" value="Ubah" />
					</div>
					<div class='box-inf'>
						 <h3 class='account'>Alamat</h3>
						  <p><?=$akun->alamat?></p>
						  <p><?=$akun->kec?></p>
						  <p><?=$akun->kota?></p>
						  <p><?=$akun->provinsi?></p>
						  <input class='sc-button small orange'	style="margin-top:3em!important;" onClick="window.location='<?=site_url('page/my_account/address')?>'" id="Proses" type="button" value="Ubah" />
					</div>
				</div>
			<?php }elseif($Target=="account"){?>
				<h3 class='account'>Informasi Account</h3>
				<p>Anda dapat mengubah data account anda pada kolom di bawah.</p>
				<div class='box-form'>
				<form class="form1" id="frm_register" method="POST" action="<?=site_url("customer/update_account")?>">
						<span id="ajax-status"></span>
						<span id="message"></span>
						<br>
						<div class="input">
							<div class="inputtext"><em>*</em>Email</div>
							<div class="inputcontent">
								<input type="text" readonly name="email" value="<?=$akun->email?>" placeholder="Email" id="email" />
							</div>
						</div>
						<div class="input">
							<div class="inputtext"><em>*</em>Nama Lengkap</div>
							<div class="inputcontent">
								<input type="hidden" name="idx_pelanggan" value="<?=$akun->idx_pelanggan?>"/>
								<input type="text"  name="full_name" value="<?=$akun->full_name?>" placeholder="Nama Lengkap" id="full_name" />
							</div>
						</div>
						<div class="input">
							<div class="inputtext"><em></em>No Telepon</div>
							<div class="inputcontent">
								<input type="text"  name="no_telepon" value="<?=$akun->no_telepon?>" placeholder="No Telepon" id="no_telepon" />
							</div>
						</div>
						<div class="input">
							<div class="inputtext"><em>*</em>Handphone</div>
							<div class="inputcontent">
								<input type="text"  name="hp" value="<?=$akun->hp?>" placeholder="Handphone" id="hp" />
							</div>
						</div>
						<div class="input">
							<div class="inputtext"><em>*</em>Newsletter</div>
							<div class="inputcontent">
							<?php if($newsletter>0){
								echo'
								<input type="radio" checked name="newsletter" value="1" style="width: 15px;" /> Ya
								<input type="radio"  name="newsletter" value="0" style="width: 15px;" /> Tidak';
								}else{
									echo'
									<input type="radio"  name="newsletter" value="1" style="width: 15px;" /> Ya
									<input type="radio" checked name="newsletter" value="0" style="width: 15px;" /> Tidak';
								}
							?>
							</div>
						</div>
						<div class="buttons">
							<input class='sc-button small green' type="submit" value="Simpan" />
							<input class='sc-button small orange' type="reset" value="Reset" />
						</div>
				</form>
				</div>
			<?php }elseif($Target=="change_password"){?>
				<h3 class='account'>Ganti Password</h3>
				<div class='box-form'>
				<form class="form1" id="frm_register" method="POST" action="<?=site_url("customer/update_password")?>">
						<span id="ajax-status"></span>
						<span id="message"></span>
						<br>
						<div class="input">
							<div class="inputtext"><em>*</em>Password Baru</div>
							<div class="inputcontent">
								<input type="hidden" name="idx_pelanggan" value="<?=$akun->idx_pelanggan?>"/>
								<input type="password"  name="password" placeholder="Password Baru" id="password" />
							</div>
						</div>
						<div class="buttons">
							<input class='sc-button small green' type="submit" value="Simpan" />
							<input class='sc-button small orange' type="reset" value="Reset" />
						</div>
				</form>
				</div>
			<?php }elseif($Target=="testimoni"){?>
				<h3 class='account'>Berikan Testimoni anda tentang kami.</h3>
				<div class='box-form'>
				<form class="form1" id="frm_register" method="POST" action="<?=site_url("customer/testimoni")?>">
						<span id="ajax-status"></span>
						<span id="message"></span>
						<br>
						<div class="input">
							<div class="inputtext"><em>*</em>Isi Testimoni</div>
							<div class="inputcontent">
								<textarea name="testimoni" id="testimoni"></textarea>
							</div>
						</div>
						<div class="buttons">
							<input class='sc-button small green' type="submit" value="OK" />
							<input class='sc-button small orange' type="reset" value="Reset" />
						</div>
				</form>
				</div>
			<?php }elseif($Target=="address"){?>
				<h3 class='account'>Data Alamat</h3>
				<p>Anda dapat mengubah data alamat anda pada kolom di bawah.</p>
				<div class='box-form'>
				<form class="form1" id="frm_register" method="POST" action="<?=site_url("customer/update_address")?>">
						<span id="ajax-status"></span>
						<span id="message"></span>
						<br>
						<div class="input">
							<div class="inputtext"><em>*</em>Alamat</div>
							<div class="inputcontent">
								<input type="text" name="alamat" value="<?=$akun->alamat?>" placeholder="Alamat" id="alamat" />
							</div>
						</div>
						<div class="input">
							<div class="inputtext"><em>*</em>Provinsi</div>
							<div class="inputcontent">
								<select name="provinsi" id="provinsi">
								<option value="">--Pilih Provinsi--</option>
									<?php
										foreach($shipping->result() as $s){
											$selected="";
											if($akun->provinsi==$s->provinsi){
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
								<input type="hidden" name="idx_pelanggan" value="<?=$akun->idx_pelanggan?>"/>
								<select name="kota" id="kota">
								<option selected value="<?=$akun->kota?>"><?=$akun->kota?></option>
								</select>
							</div>
						</div>
						<div class="input">
							<div class="inputtext"><em>*</em>Kecamatan</div>
							<div class="inputcontent">
								<select name="kec" id="kec">
									<option  selected value="<?=$akun->kec?>"><?=$akun->kec?></option>
								</select>
							</div>
						</div>
						<div class="buttons">
							<input class='sc-button small green' type="submit" value="Simpan" />
							<input class='sc-button small orange' type="reset" value="Reset" />
						</div>
				</form>
				</div>
				<script>
					$(document).ready(function(){
						if($("#kota").val()!=""){
								$.ajax({
										url: '<?=site_url('checkout/look_kecamatan_account')?>',
										data:'kota='+$("#kota").val(),
										type: "POST",
										success: function (html) {
											$("#kec").append(html);
										}
									});
							}else{
								$("#kec").empty();
							}
						if($("#provinsi").val()!=""){
								$.ajax({
										url: '<?=site_url('checkout/look_kota')?>',
										data:'provinsi='+$("#provinsi").val(),
										type: "POST",
										success: function (html) {
											$("#kota").append(html);
										}
									});
							}else{
								$("#kota").empty();
							}
						$("#provinsi").change(function(){
							$("#kec").empty();
							if($("#provinsi").val()!=""){
								$.ajax({
										url: '<?=site_url('checkout/look_kota')?>',
										data:'provinsi='+$("#provinsi").val(),
										type: "POST",
										success: function (html) {
											$("#kota").html(html);
										}
									});
							}else{
								$("#kota").empty();
							}
						});
						$("#kota").change(function(){
							if($("#kota").val()!=""){
								$.ajax({
										url: '<?=site_url('checkout/look_kecamatan_account')?>',
										data:'kota='+$("#kota").val(),
										type: "POST",
										success: function (html) {
											$("#kec").html(html);
										}
									});
							}else{
								$("#kec").empty();
							}
						});
					});
				</script>
			<?php }elseif($Target=="order_history"){?>
				<h3 class='account'>Riwayat Pesanan</h3>
					<div class="cart_table">
						  <table class="data-table cart-table" id="shopping-cart-table" cellpadding="0" cellspacing="0">
							<tbody>
							<tr>
							  <th class="align_center" width="12%">No Transaksi</th>
							  <th class="align_center" width="12%">Tanggal Pesanan</th>
                                                          <th class="align_center" width="12%">Total Tagihan</th>
							   <th class="align_center" width="12%">Status</th>
							   <th class="align_center" width="10%">No Resi</th>
							</tr>
							<?php 
							function DateToIndo($date){  
								$BulanIndo = array("Januari", "Februari", "Maret",  
												   "April", "Mei", "Juni",  
												   "Juli", "Agustus", "September",  
												   "Oktober", "November", "Desember");  
							  
								$tahun = substr($date, 0, 4);  
								$bulan = substr($date, 5, 2);  
								$tgl   = substr($date, 8, 2);  
								  
								$result = $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun;       
								return($result);  
							}
							foreach($order_his->result() as $item){
								if($item->cd_status==0){
									$status="<a href='".site_url('page/payment_confirm?q='.$item->id_pesanan)."' title='Konfirmasi Pembayaran' style='text-decoration:none;'><b style='color:#c00000;font-size: 11px;'>Menunggu Pembayaran</b></a>";
								}
								if($item->cd_status==1){
									$status='<b style="color: #1355B9;font-size: 11px;">Pesanan diterima</b>';
								}
								if($item->cd_status==2){
									$status='<b style="color: #1355B9;font-size: 11px;">Pengemasan</b>';
								}
								if($item->cd_status==3){
									$status='<b style="color: #1355B9;font-size: 11px;">Dikirim</b>';
								}
								if($item->cd_status==4){
									$status='<b style="color: #1355B9;font-size: 11px;">Selesai</b>';
								}
								if($item->cd_status==8){
									$status='<b style="color:orange;font-size: 11px;">Menunggu Verifikasi Pembayaran</b>';
								}
								if($item->no_pengiriman){
                                    $no_pengiriman= $item->no_pengiriman;
                                }else{
									if($item->cd_status==3){
										$no_pengiriman='<b style="color: #1355B9;font-size: 11px;">Menunggu</b>';
									}else{
										$no_pengiriman="-";
									}
                                }
                                echo'
								<tr>
								  <td class="align_center vline"><span class="price">'.$item->id_pesanan.'<br><br><a class="new" href="javascript:void()" onClick=window.open("'.site_url('page/show_product').'/'.$item->idx_order.'","_blank","width=800,height=500,scrollbars=yes,status=yes,resizable=yes,screenx=0,screeny=0"); title="Lihat Detail Pesanan">Lihat Detail Pesanan<a></span></td>
								  <td class="align_center vline"><span class="price">'.DateToIndo($item->tgl_order).'</span></td>
                                                                  <td class="align_center vline"><span class="price">Rp.'.number_format($item->total_tagihan,0,',','.').'</span></td>
								  <td class="align_center vline"><span class="price">'.$status.'</span></td>
							          <td class="align_center vline"><span class="price">'.$no_pengiriman.'</span></td>
								</tr>';
							}
							?>
						  </tbody>
						 </table>
					</div>
					<?php }elseif($Target=="wishlist"){?>
						<h3 class='account'>Wishlist Saya</h3>
						<p style='color:red'>* Produk sewaktu waktu dapat berubah tanpa pemberitahuan terlebih dahulu.</p>
						 <div class="cart_table">
							<form action="<?=site_url('cart/update')?>" id="frm_cart" method="post">
							  <table class="data-table cart-table" id="shopping-cart-table" cellpadding="0" cellspacing="0">
								<tbody>
								<tr>
									<th class="align_center" width="5%">No</th>
									<th width="10%"></th>
									<th width="15%">Tanggal</th>
									<th width="20%">Nama Produk</th>
									<th width="15%">Harga</th>
									<th width="10%">Diskon</th>
									<th width="15%">Keterangan</th>
									<th width="15%">Stok</th>
									<th width="10%">Proses</th>
									<th class="align_center" width="6%"></th>
								</tr>
								<?php
								$n=1;
								foreach($wishlist->result() as $w){
									/*---Check Promo & Discount---*/
									$elm_product	=$this->db->get_where("product", array("idx_product" =>$w->idx_product))->row();
									$discount	=$elm_product->discount;
									if($page->promo_persentasi($w->idx_product)<>false){
										$discount		=$page->promo_persentasi($w->idx_product);
									}
									/*---Check Promo & Discount---*/																		$pc				=explode("||",$page->look_stock_ext($w->idx_attribute_product,$w->idx_product));									$status_stock	=$pc[0];									$stock			=$pc[1];																		$checkout='<p style="color:#bbb;">Checkout</p>';																				if($stock<>0){											$checkout='<a href="'.site_url('checkout/wishlist/'.$w->idx_wishlist).'">Checkout</a>';																					}
									echo'
									<tr>
										<td class="align_center">'.$n.'</td>
										<td><a href="'.site_url('detail/'.$w->idx_product.'/'.strtolower(str_replace(" ","-",$w->nm_product))).'" title="'.$w->nm_product.'" title="Pesan Produk"><img style="width:50px" src="'.base_url().'uploads/product/'.$w->thumb.'"></a></td>
										<td>'.$page->DateToIndo($w->tgl).'</td>
										<td>'.$w->nm_product.'</td>
										<td>Rp.'.number_format($w->harga,0,',','.').'</td>
										<td>'.$discount.' %</td>
										<td>'.$page->ket_order($w->idx_attribute_product,$w->idx_product,$w->qty).'</td>
										<td>'.$status_stock.'</td>				
										<td>'.$checkout.'</td>
										<td class="align_center vline"><a onClick="loading()" href="'.site_url('customer/delete/'.$w->idx_wishlist).'" class="remove"></a></td>
									</tr>';
								$n++;
								}
								?>
							  </tbody>
							 </table>
							 </form>
						  </div>
					<?php }elseif($Target=="laporkan"){?>
						<h3 class='account'>Laporkan</h3>
						<p>* Harap gunakan menu laporkan dengan bijak,<br>Pastikan informasi yang anda berikan benar.</p>
						<div class='box-form'>
							<form class="form1" id="frm_register" method="POST" action="<?=$main_url?>/pelanggan/pengaduan" enctype='multipart/form-data'>
									<span id="ajax-status"></span>
									<span id="message"></span>
									<br>
									<div class="input">
										<div class="inputtext"><em>*</em>No Transaksi</div>
										<div class="inputcontent">
											<input type="text" name="id_pesanan"  placeholder="No Transaksi" id="id_pesanan" />
											<input type="hidden" name="id_pelanggan"  value="<?=$id_pelanggan?>" id="id_pelanggan" />
										</div>
									</div>
									<div class="input">
										<div class="inputtext"><em>*</em>Nama Pelapor</div>
										<div class="inputcontent">
											<input type="text" name="nm_pelapor"  placeholder="Nama Pelapor" id="nm_pelapor" />
										</div>
									</div>
									<div class="input">
										<div class="inputtext"><em>*</em>No Telepon</div>
										<div class="inputcontent">
											<input type="text" name="telepon"  placeholder="No Telepon" id="telepon" />
										</div>
									</div>
									<div class="input">
										<div class="inputtext"><em>*</em>Email</div>
										<div class="inputcontent">
											<input type="text" name="email"  placeholder="Email" id="email" />
										</div>
									</div>
									<div class="input">
										<div class="inputtext"><em>*</em>Alasan</div>
										<div class="inputcontent">
											<textarea name="reason" id="reason"></textarea>
										</div>
									</div>
									<div class="input">
										<div class="inputtext"><em>*</em>Upload Bukti</div>
										<div class="inputcontent">
											<input type="file" name="path_file[]" id="path_file" multiple  />
										</div>
									</div>
									<div class="buttons">
										<input class='sc-button small green' type="submit" value="Laporkan" />
										<input class='sc-button small orange' type="reset" value="Reset" />
									</div>
							</form>
						</div>
					<?php }elseif($Target=="pengembalian"){?>
						<h3 class='account'>Pengembalian Barang</h3>
						<div class='box-form'>
							<form class="form1" id="frm_register" method="POST" action="<?=site_url("customer/refund")?>">
									<span id="ajax-status"></span>
									<span id="message"></span>
									<br>
									<div class="input">
										<div class="inputtext"><em>*</em>No Transaksi</div>
										<div class="inputcontent">
											<input type="text" name="id_pesanan"  placeholder="No Transaksi" id="id_pesanan" />
										</div>
									</div>
									<div class="input">
										<div class="inputtext"><em>*</em>Nama Produk</div>
										<div class="inputcontent">
											<input type="text" name="nm_product"  placeholder="Nama Produk" id="nm_product" />
										</div>
									</div>
									<div class="input">
										<div class="inputtext"><em>*</em>Keterangan Produk</div>
										<div class="inputcontent">
											<input type="text" name="ket_product"  placeholder="Ukuran/Warna" id="ket_product" />
										</div>
									</div>
									<div class="input">
										<div class="inputtext"><em>*</em>Jumlah Pengembalian</div>
										<div class="inputcontent">
											<input type="text" name="total_refund"  placeholder="Jumlah Pengembalian" id="total_refund" />
										</div>
									</div>
									<div class="input">
										<div class="inputtext"><em></em>Alasan</div>
										<div class="inputcontent">
											<textarea name="alasan_refund" id="alasan_refund"></textarea>
										</div>
									</div>
									<div class="buttons">
										<input class='sc-button small green' type="submit" value="OK" />
										<input class='sc-button small orange' type="reset" value="Reset" />
									</div>
							</form>
						</div>
					<?php  } ?>
			</div>
            <!--MAIN CONTENT ENDS-->
        </section>
        <!--Mid Section Ends-->
    </div>
    <div class="footer_container">
        <!--Footer Starts-->
       <?php $this->load->view('template/demo/footer'); ?>
	   <!--Footer Ends-->
    </div>
</div>
<style>
.new{font-family: arial;color: #0184EB;font-size: 11px;}
</style>
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
