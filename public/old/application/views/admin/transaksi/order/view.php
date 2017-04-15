<!--Content-->
<div id="content">
<ul class="breadcrumb">
	<li><a href="#" class="glyphicons home">Home</a></li>
	<li class="divider"></li>
	<li>Pesanan</li>
	<li class="divider"></li>
	<li>Lihat <?=$site_title?></li>
</ul>
<div class="separator bottom"></div>
<div class="innerLR">

<form class="form-horizontal" id="form_input" method="POST" action="#">
	<!-- Widget -->
        <div class="widget widget-gray widget-body-gray">
                <!-- Widget heading -->
                <div class="widget-head"><h4 class="heading">Lihat <?=$site_title?></h4></div>
                <!-- // Widget heading END -->
                <div class="widget-body">
                        <!-- Row -->
                       <div class="row" style="border-bottom: 1px solid #C4C4C4;margin-bottom: 10px;">
						<span id="ajax-status"></span>
						<span id="message"  ></span>
								<div class="col-md-6" style="width: 30%;">
									 <div class="form-group">
										 <label class="col-md-4 control-label" for="Status">Status Pesanan</label>
										  <label class="col-md-4 control-label" style="font-weight:normal;width: 180px;text-align: left;" for="No Resi"><?=$order->convert_status($Result_form->cd_status)?></label>
									 </div>
									 <?php if($fl_refund==1){ ?>
									 <div class="form-group">
										 <label class="col-md-4 control-label" for="Cetak form Pengembalian Barang"></label>
										 <label class="col-md-4 control-label" style="font-weight:normal;width: 180px;text-align: left;" for="Cetak form Pengembalian Barang"><a href="<?=site_url('order/print_form_pengembalian/'.$Result_form->idx_order)?>" target="_blank" title="Cetak form Pengembalian Barang">Cetak form Pengembalian Barang</a></label>
									</div>
									<?php } ?>
								</div>
								<?php
									if($order->convert_status($Result_form->cd_status)==3){
										$resi="Menunggu";
									}else{
										$resi=$Result_form->no_pengiriman;
									}
								?>
								<div class="col-md-6" style="width: 30%;" id="no_resi">
									 <div class="form-group">
										 <label class="col-md-4 control-label" for="No Resi">No Resi</label>
										 <label class="col-md-4 control-label" style="font-weight:normal;width: 180px;text-align: left;" for="No Resi"><?=$resi?></label>
									</div>
								</div>
								 <!-- Column -->
						</div>
						<div class="row">
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
													<br><?=$Result_form->hp?>
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
													<br><?=$Result_form->hp?>
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
															<br>'.$Result_form->hp.'
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
															<br>'.$res->hp.'
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
							.title-product{margin: 12px 0;padding: 5px 0;font-weight: bold;}
							#sub_table{width:30%;float:right;}
							#sub_table .table tr td{border:none!important;font-weight: bold;font-size: 13px;}
						</style>
						<p class='title-product'>Data Barang Pesanan</p>
                        <table class="table" style="border:1px solid #bbb;margin-bottom:0;" width="100%">
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
								if($p->idx_attribute_product<>0){
									$q=$this->order_model->get_atribute_order($p->idx_attribute_product)->row();
									$idx_attribute_product=$q->nm_attribute.': '.$q->desc_attribute;
								}
								$bonus='';
								if($Result_form->fl_set_shipping==1){
									if($order->free_ongkir($p->idx_product)>0){
										$bonus='<b style="color:green;">Gratis pengiriman</b>';
									}
								}
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
						if($Result_form->fl_set_shipping==1){
							if(($Result_form->ongkir_dasar==0)&&($Result_form->ongkir==0)){
								$fl_shipping	="Gratis";
								$ongkir_dasar	="Gratis";
								$expedisi		="";
							}else{
								$fl_shipping	='Rp. '.number_format($Result_form->ongkir,0,',','.');
								$ongkir_dasar	=$Result_form->ongkir_dasar ."/Kg";
								$expedisi		="<tr><td>Expedisi Pengiriman</td><td>".$order->convert_expedisi($Result_form->jne_expedisi)."</td></tr>";
							}
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
								<?php if($Result_form->fl_set_shipping==1){ ?>
								<?=$expedisi?>
								<tr><td>Ongkos Kirim</td><td><?=$ongkir_dasar?></td></tr>
								<tr><td>Berat</td><td><?=($berat/1000)?> Kg</td></tr>
								<tr><td>Total Ongkos Kirim</td><td><?=$fl_shipping?></td></tr>
								<?php }else{ ?>
								<tr><td>Berat</td><td><?=($berat/1000)?> Kg</td></tr>
								<?php } ?>
								<?=$promo_pembelian?>
								<tr><td>Total Tagihan</td><td>Rp. <?=number_format($Result_form->total_tagihan,0,',','.')?></td></tr>
								<?php if($Result_form->fl_set_shipping==0){ ?>
								<tr><td colspan="2">Harga belum termasuk ongkos kirim</td></tr>
								<?php } ?>
								<tr><td> <a href='<?=$back?>' class="btn btn-icon btn-primary glyphicons circle_ok"><i></i>Kembali</a></td><td></td></tr>
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



