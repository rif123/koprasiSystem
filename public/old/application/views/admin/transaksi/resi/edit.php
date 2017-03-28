<!--Content-->
<div id="content">
<ul class="breadcrumb">
	<li><a href="#" class="glyphicons home">Home</a></li>
	<li class="divider"></li>
	<li>Pesanan</li>
	<li class="divider"></li>
	<li>Masukan No Resi Pesanan</li>
</ul>
<div class="separator bottom"></div>
<div class="innerLR">

<form class="form-horizontal" id="form_input" method="POST" action="<?=site_url('order/update_resi')?>">
	<!-- Widget -->
        <div class="widget widget-gray widget-body-gray">
                <!-- Widget heading -->
                <div class="widget-head"><h4 class="heading">asukan No Resi Pesanan</h4></div>
                <!-- // Widget heading END -->
                <div class="widget-body">
                        <!-- Row -->
                        <div class="row" style="border-bottom: 1px solid #C4C4C4;margin-bottom: 10px;">
						<span id="ajax-status"></span>
						<span id="message"  ></span>
						  <?php 
							$style="display: none";
							if($Result_form->cd_status<>3){ ?>
								<div class="col-md-6" style="width: 40%;">
									 <div class="form-group">
										 <label class="col-md-4 control-label" for="Status">Ubah Status ke</label>
										 <div class="col-md-8">
											 <select name="status_order" onChange="toogle_resi(this.value);" id="status_order" class="form-control">
											 <?php 
											 if($Result_form->cd_status==1){
												echo'
												<option value="2">Pengemasan</option>
												<option value="3">Sedang Dikirim</option>';
											 }
											 ?>
											  <?php 
											 if($Result_form->cd_status==2){
												echo'
												<option value="3">Sedang Dikirim</option>';
												$style="";
											 }
											 ?>
											 </select>
										 </div>
									 </div>
								</div>
								<?php 
								}else{
									$style="";
								}
								?>
								<script>
									function toogle_resi(i){
										if(i==3){
											$("#no_resi").show();
										}else{
											$("#no_resi").hide();
										}
									}
								</script>
								<div class="col-md-6" style="width: 40%;<?=$style?>;" id="no_resi">
									 <div class="form-group">
										 <label class="col-md-4 control-label" for="id_pesanan">No Resi</label>
										 <div class="col-md-8">
											 <input type="text" name="no_pengiriman" class="form-control">
										 </div>
									 </div>
								</div>
								 <!-- Column -->
						</div>
						<div class="row">
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
													<br><?=$Result_form->alamat?><br><?=$Result_form->kec?><br><?=$Result_form->kota?>
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
															<br>'.$Result_form->alamat.'<br>'.$Result_form->kec.'<br>'.$Result_form->kota.'
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
															<br>'.$res->alamat.'<br>'.$res->kec.'<br>'.$res->kota.'
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
									<td>Subtotal</td>
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
								if($order->cek_bogof($p->idx_product)->num_rows()>0){
									$bonus='<b style="color:green;">Bonus '.$order->cek_bogof($p->idx_product)->row()->bogof_caption.'</b>';
								}
								if($p->thumb){$img="<img src='".base_url()."uploads/product/".$p->thumb."' style='width: 6em;height: 5em;'/>";}
									$discount		=0;
									$harga			=$p->harga_discount;
									if($order->check_promo($p->idx_product)->num_rows()>0)
									{
										$pr=$order->check_promo($p->idx_product)->row();
										if($pr->idx_type_promo==1){
											$discount		=$pr->discount;
											$harga			=$p->harga_discount-($p->harga_discount*$discount/100);
										}
									}else{
										if($p->discount>0){
											$discount		=$p->discount;
										}
									}
									$berat=$berat+($p->berat*$p->qty);
								echo'
									<tr>
										<td width="10%">'.$img.'</td>
										<td>'.$p->nm_product.'<br>'.$bonus.'</td>
										<td>'.($p->berat*$p->qty/1000).'</td>
										<td>Rp.'.number_format($p->harga_discount,0,',','.').'</td>
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
							}else{
								$fl_shipping='Rp. '.number_format($Result_form->ongkir,0,',','.');
								$ongkir_dasar	=$Result_form->ongkir_dasar;
								
							}
							/*---Check Promo Pembelian---*/
									$promo_pembelian="";
									if($discount_pembelian->num_rows>0){
											$discount			=$discount_pembelian->row()->discount;
											$promo_pembelian	='<tr>
																	<td colspan="1" class="align_left" width="80%">Diskon Pembelian</td>
																	<td class="align_right" style=""><span class="price"><b style="color:#50E00D">'.$discount.' %</b></span></td>
																</tr>';
									}
								/*---Check Promo Pembelian---*/
						?>
						<div id="sub_table">
							<table class="table" width="100%">
								<tr><td></td><td></td></tr>
								<tr><td>Expedisi Pengiriman</td><td><?=$order->convert_expedisi($Result_form->jne_expedisi)?></td></tr>
								<tr><td>Ongkos Kirim</td><td><?=$ongkir_dasar?> /Kg</td></tr>
								<tr><td>Berat</td><td><?=($berat/1000)?> Kg</td></tr>
								<?=$promo_pembelian?>
								<tr><td>Total Ongkos Kirim</td><td><?=$fl_shipping?></td></tr>
								<tr><td>Total Tagihan</td><td>Rp. <?=number_format($Result_form->total_tagihan,0,',','.')?></td></tr>
							    <tr><td><button type="submit" class="btn btn-icon btn-primary glyphicons circle_ok"><i></i>Proses</button></td><td><button type="button" onClick="window.location='<?=site_url("order/resi")?>'" class="btn btn-icon btn-primary glyphicons circle_ok"><i></i>Kembali</button></td></tr>
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
<script>
$(document).ready(function() {
    $('#ajax-status').hide();
        $('#message').hide();
        $('#form_input').ajaxForm({
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


