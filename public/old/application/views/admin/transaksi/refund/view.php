<!--Content-->
<div id="content">
<ul class="breadcrumb">
	<li><a href="#" class="glyphicons home">Home</a></li>
	<li class="divider"></li>
	<li>Pesanan</li>
	<li class="divider"></li>
	<li>Lihat Pengembalian Barang</li>
</ul>
<div class="separator bottom"></div>
<div class="innerLR">

<form class="form-horizontal" id="form_input" method="POST" action="#">
	<!-- Widget -->
        <div class="widget widget-gray widget-body-gray">
                <!-- Widget heading -->
                <div class="widget-head"><h4 class="heading">Lihat Pengembalian Barang</h4></div>
                <!-- // Widget heading END -->
                <div class="widget-body">
                        <!-- Row -->
                       <div class="row" style="border-bottom: 1px solid #C4C4C4;margin-bottom: 10px;">
						<span id="ajax-status"></span>
						<span id="message"  ></span>
						<p class='title-product'>Data Pengembalian Barang</p>
								<div class="col-md-6" style="width: 30%;">
									 <div class="form-group">
										 <label class="col-md-4 control-label" for="Status">Status</label>
										  <label class="col-md-4 control-label" style="font-weight:normal;width: 180px;text-align: left;" for="Status"><?=$order->convert_status_refund($refund->cd_status)?></label>
									 </div>
									 <div class="form-group">
										 <label class="col-md-4 control-label" for="Status">Tanggal</label>
										  <label class="col-md-4 control-label" style="font-weight:normal;width: 180px;text-align: left;" for="Tanggal"><?=DateToIndo($refund->tgl_refund)?></label>
									 </div>
									 <div class="form-group">
										 <label class="col-md-4 control-label" for="Status">No Transaksi</label>
										  <label class="col-md-4 control-label" style="font-weight:normal;width: 180px;text-align: left;" for="No Transaksi"><?=$refund->id_pesanan?></label>
									 </div>
									 <div class="form-group">
										 <label class="col-md-4 control-label" for="Status">Nama Produk</label>
										  <label class="col-md-4 control-label" style="font-weight:normal;width: 180px;text-align: left;" for="Nama Produk"><?=$refund->nm_product?></label>
									 </div>
									 <div class="form-group">
										 <label class="col-md-4 control-label" for="Status">Keterangan Produk</label>
										  <label class="col-md-4 control-label" style="font-weight:normal;width: 180px;text-align: left;" for="Keterangan Produk"><?=$refund->ket_product?></label>
									 </div>
									 <div class="form-group">
										 <label class="col-md-4 control-label" for="Status">Jumlah Pengembalian</label>
										  <label class="col-md-4 control-label" style="font-weight:normal;width: 180px;text-align: left;" for="Jumlah Pengembalian"><?=$refund->total_refund?></label>
									 </div>
									 <div class="form-group">
										 <label class="col-md-4 control-label" for="Status">Alasan Pengembalian</label>
										  <label class="col-md-4 control-label" style="font-weight:normal;width: 180px;text-align: left;" for="Alasan Pengembalian"><?=$refund->alasan_refund?></label>
									 </div>
								</div>
								<div class="col-md-6" style="width: 30%;" id="no_resi">
									 <div class="form-group">
										 <label class="col-md-4 control-label" for="Nama Pelanggan">Nama Pelanggan</label>
										 <label class="col-md-4 control-label" style="font-weight:normal;width: 180px;text-align: left;" for="Nama Pelanggan"><?=$refund->full_name?></label>
									</div>
									<div class="form-group">
										 <label class="col-md-4 control-label" for="Alamat">Alamat</label>
										 <label class="col-md-4 control-label" style="font-weight:normal;width: 180px;text-align: left;" for="Alamat"><?=$refund->alamat?><br><?=$refund->kec?></label>
									</div>
									<div class="form-group">
										 <label class="col-md-4 control-label" for="Kota">Kota</label>
										 <label class="col-md-4 control-label" style="font-weight:normal;width: 180px;text-align: left;" for="Kota"><?=$refund->kota?></label>
									</div>
									<div class="form-group">
										 <label class="col-md-4 control-label" for="Provinsi">Provinsi</label>
										 <label class="col-md-4 control-label" style="font-weight:normal;width: 180px;text-align: left;" for="Provinsi"><?=$refund->provinsi?></label>
									</div>
									<div class="form-group">
										 <label class="col-md-4 control-label" for="No Telepon">No Telepon</label>
										 <label class="col-md-4 control-label" style="font-weight:normal;width: 180px;text-align: left;" for="No Telepon"><?=$refund->no_telepon?></label>
									</div>
									<div class="form-group">
										 <label class="col-md-4 control-label" for="Handphone">Handphone</label>
										 <label class="col-md-4 control-label" style="font-weight:normal;width: 180px;text-align: left;" for="Handphone"><?=$refund->hp?></label>
									</div>
									<div class="form-group">
										 <label class="col-md-4 control-label" for="Email">Email</label>
										 <label class="col-md-4 control-label" style="font-weight:normal;width: 180px;text-align: left;" for="Email"><?=$refund->email?></label>
									</div>
								</div>
								 <!-- Column -->
						</div>
						<div class="row">
						<p class='title-product'>Data Transaksi</p>
								 <!-- Column -->
                                <div class="col-md-6" style="width: 30%;">
                                        <!-- Group -->
                                        <div class="form-group">
                                                <label class="col-md-4 control-label" for="id_pesanan">No Transaksi</label>
												<input name="idx_order" id="idx_order" value="<?=$Result_form->idx_order?>" type="hidden">
                                                <label class="col-md-4 control-label" style="font-weight:normal;width: 180px;text-align: left;" for="id_pesanan"><?=$Result_form->id_pesanan?></label>
										</div>
                                        <!-- // Group END --> 
										<!-- Group -->
                                        <div class="form-group">
                                                <label class="col-md-4 control-label" for="tgl_order">Tanggal Pesanan</label>
                                                <label class="col-md-4 control-label" style="font-weight:normal;width: 180px;text-align: left;" for="tgl_order"><?=DateToIndo($Result_form->tgl_order)?></label>
										</div>
                                        <!-- // Group END --> 
										<!-- Group -->
                                        <div class="form-group">
                                                <label class="col-md-4 control-label" for="total_tagihan">Total Tagihan</label>
                                                <label class="col-md-4 control-label" style="font-weight:normal;width: 180px;text-align: left;" for="total_tagihan">Rp.<?=number_format($Result_form->total_tagihan,0,',','.')?></label>
										</div>
                                        <!-- // Group END --> 
										<!-- Group -->
                                        <div class="form-group" style="margin-bottom: 0;">
                                                <label class="col-md-4 control-label" for="pemesan">Pemesan</label>
                                                <label class="col-md-4 control-label" style="font-weight:normal;width: 180px;text-align: left;" for="full_name">
													<?=$Result_form->full_name?>
													<br><?=$Result_form->email?>
													<br><?=$Result_form->no_telepon?>
												</label>
										</div>
                                        <!-- // Group END --> 
								</div>
                                <!-- // Column END -->
								<!-- Column -->
                                <div class="col-md-6" style="width: 35%;">
                                        <!-- Group -->
                                        <div class="form-group" style="margin-bottom: 0;">
                                                <label class="col-md-4 control-label" for="pemesan">Alamat Penagihan</label>
                                                <label class="col-md-4 control-label" style="font-weight:normal;width: 180px;text-align: left;" for="full_name">
													<?=$Result_form->full_name?>
													<br><?=$Result_form->alamat?><br><?=$Result_form->kec?><br><?=$Result_form->kota?><br><?=$Result_form->provinsi?>
													<br><?=$Result_form->no_telepon?>
												</label>
										</div>
                                        <!-- // Group END -->
								</div>
                                <!-- // Column END -->
								<?php
									if($Result_form->fl_drop_shipper==0){
										echo'
										<div class="col-md-6" style="width: 35%;">
											<div class="form-group" style="margin-bottom: 0;">
												<label class="col-md-4 control-label" for="pemesan">Alamat Pengiriman</label>
												<label class="col-md-4 control-label" style="font-weight:normal;width: 180px;text-align: left;" for="full_name">
															'.$Result_form->full_name.'
															<br>'.$Result_form->alamat.'<br>'.$Result_form->kec.'<br>'.$Result_form->kota.'<br>'.$Result_form->provinsi.'
															<br>'.$Result_form->no_telepon.'
												</label>
											</div>
												
										</div>';
										$kec	=$Result_form->kec;
										$kota	=$Result_form->kota;
									}else{
										$res		=$this->additional_model->get_where_row('drop_shipper','idx_drop_shipper',$Result_form->idx_drop_shipper);
										echo'
										<div class="col-md-6" style="width: 35%;">
											<div class="form-group" style="margin-bottom: 0;">
												<label class="col-md-4 control-label" for="pemesan">Alamat Pengiriman</label>
												<label class="col-md-4 control-label" style="font-weight:normal;width: 180px;text-align: left;" for="full_name">
															'.$res->full_name.'
															<br>'.$res->alamat.'<br>'.$res->kec.'<br>'.$res->kota.'<br>'.$res->provinsi.'
															<br>'.$res->no_telepon.'
												</label>
											</div>
												
										</div>';
									$kec	=$res->kec;
									$kota	=$res->kota;
									}
								?>
                           </div>
                        <!-- // Row END -->
						<style>
							.table tr td{padding: 5px 5px;font-family: arial;border:1px solid #bbb;font-size: 11px;}
							.title-product{margin: 12px 0;padding: 5px 0;font-weight: bold;color: #D30D0D;border-bottom: 1px solid #A09A9A;}
							#sub_table{width:30%;float:right;}
							#sub_table .table tr td{border:none!important;font-weight: bold;font-size: 13px;}
						</style>
                        <table class="table" style="border:1px solid #bbb;margin-bottom:0;margin-top:10px;" width="100%">
							<thead>
								<tr>
									<td width="10%">Gambar Produk</td>
									<td>Nama Produk</td>
									<td>Berat (Kg)</td>
									<td>Harga</td>
									<td>Diskon (%)</td>
									<td>Atribut</td>
									<td width="7%" >Jumlah Beli</td>
									<td width="10%">Subtotal</td>
								</tr>
							</thead>
							<tbody>
							<?php
							$fl_shipping=1;
							$sub_t		=0;
							$berat		=0;
							foreach($product->result() as $p){
								$idx_attribute_product="-";
								$img="";
								if($order->free_ongkir($p->idx_product)>0){
									$fl_shipping=$fl_shipping*0;
								}
								if($p->idx_attribute_product<>0){
									$q=$this->order_model->get_atribute_order($p->idx_attribute_product)->row();
									$idx_attribute_product=$q->nm_attribute.': '.$q->desc_attribute;
								}
								$bonus='';
								if($p->bonus_bogof<>""){
									$bonus='<b style="color:green;">Bonus '.$p->bonus_bogof.'</b>';
								}
								if($p->thumb){$img="<img src='".base_url()."uploads/product/".$p->thumb."' style='width: 6em;height: 5em;'/>";}
									$discount		=$p->discount_order;
									$harga			=$p->harga-($p->harga*$discount/100);
									$berat=$berat+($p->berat*$p->qty);
								echo'
									<tr>
										<td width="10%">'.$img.'</td>
										<td>'.$p->nm_product.'<br>'.$bonus.'</td>
										<td>'.($p->berat*$p->qty/1000).'</td>
										<td>Rp.'.number_format($p->harga,0,',','.').'</td>
										<td>'.$discount.'</td>
										<td>'.$idx_attribute_product.'</td>
										<td>'.$p->qty.'</td>
										<td>Rp. '.number_format($harga*$p->qty,0,',','.').'</td>
									</tr>
								';
								$sub_t=$sub_t+($harga*$p->qty);
							}
							?>
								<tr>
									<td colspan="7" align="right"><b>Sub Total Harga</b></td>
									<td><b>Rp. <?=number_format($sub_t,0,',','.')?></b></td>
								</tr>
							</tbody>
						</table>
						<?php
							if(($Result_form->ongkir_dasar==0)&&($Result_form->ongkir==0)){
								$fl_shipping	="Gratis";
								$ongkir_dasar	="Gratis";
								$expedisi		="";
							}else{
								$fl_shipping	='Rp. '.number_format($Result_form->ongkir,0,',','.');
								$ongkir_dasar	=$Result_form->ongkir_dasar ."/Kg";
								$expedisi		="<tr><td>Expedisi Pengiriman</td><td>".$order->convert_expedisi($Result_form->jne_expedisi)."</td></tr>";
							}
							/*---Check Promo Pembelian---*/
									$promo_pembelian="";
									if($Result_form->discount_pembelian>0){
										$promo_pembelian	='<tr>
																<td>Diskon Pembelian</td>
																<td><span class="price"><b style="color:#50E00D">'.$Result_form->discount_pembelian.' %</b></span></td>
															</tr>';
									}
								/*---Check Promo Pembelian---*/
						?>
						<div id="sub_table">
							<table class="table" width="100%">
								<tr><td></td><td></td></tr>
								<?=$expedisi?>
								<tr><td>Ongkos Kirim</td><td><?=$ongkir_dasar?></td></tr>
								<tr><td>Berat</td><td><?=($berat/1000)?> Kg</td></tr>
								<?=$promo_pembelian?>
								<tr><td>Total Ongkos Kirim</td><td><?=$fl_shipping?></td></tr>
								<tr><td>Total Tagihan</td><td>Rp. <?=number_format($Result_form->total_tagihan,0,',','.')?></td></tr>
								<tr><td><?php if($refund->cd_status==0){ ?><a href='<?=site_url('order/edit/refund/'.$refund->idx_refund)?>' class="btn btn-icon btn-primary glyphicons circle_ok"><i></i>Proses</a><?php } ?></td><td> <a href='<?=site_url('order/refund')?>' class="btn btn-icon btn-primary glyphicons circle_ok"><i></i>Kembali</a></td></tr>
							</table>
						</div>
                    </div>
	

</div>
</form>
</div>
<!-- End Wrapper -->
</div>
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
?>		



