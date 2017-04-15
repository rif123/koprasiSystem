<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<body style="background-color:#fff; margin:0px; padding:0px;">
<style>
@page { 
  size: landscape; 
}
td{font-family: Arial;
font-size: 11px;}
</style>
<table style="background-color:#fff; font-family:Arial;" border="0"   width="408">
<!--HEADER CONTAINER STARTS-->
<tbody>
<!--MID CONTAINER STARTS-->
<tr>
	<td>
		<table align="left" border="0" width="408">
		<tbody>
		<tr>
			<td style="background-color:#FFFFFF; border:solid 1px #d8d8d4; border-width:0px 1px 0px;" align="center" valign="top" width="408">
				<!--CONTENT SECTION STARTS-->
				<!--Billing Info Starts-->
				<table border="2"   width="100%">
				<tbody>
				<tr>
					<td align="left" width="45%">
						<!--Billing From-->
						<table style="color:#5a5a5a; line-height:18px;" border="0" width="100%">
						<tbody>
						<tr>
							<td colspan="2" align="left" valign="top">
								<strong style="font-weight:bold; color:#000;">Dari</strong>
							</td>
						</tr>
						<?php
							if($Qorder->fl_drop_shipper==0){ echo'
						<tr>
							<td width="76">
								<b>'.$toko->nm_toko.'</b><br>'.$toko->telp.'
							</td>
						</tr>
						'; }else{ echo'
						<tr>
							<td width="76">
								<b>'.$pengirim->full_name.'</b><br>'.$pengirim->hp.'
							</td>
						</tr>
						'; } ?>
						<tr>
							<td>
								<?=str_replace("http://","",site_url())?>
							</td>
						</tr>
						</tbody>
						</table>
					</td>
					<td align="center" width="54%">
						<table style="color:#5a5a5a; line-height:18px;" border="0"   width="100%">
						<tbody>
						<tr>
							<td colspan="2" align="left" valign="top">
								<strong style="font-weight:bold; color:#000;">Kepada:</strong>
							</td>
						</tr>
						<tr>
							<td colspan="2" align="left">
								<b><?=$pelanggan->full_name?></b><br>
								<?=$pelanggan->alamat?> <?=$pelanggan->kec?> <?=$pelanggan->kota?><br>
								<?=$pelanggan->provinsi?><br>
								<?=$pelanggan->hp?>
								<br>
								<b><?=$order->convert_expedisi($Qorder->jne_expedisi)?></b>
							</td>
						</tr>
						</tbody>
						</table>
					</td>
				</tr>
				</tbody>
				</table>
				<!--Billing Info Ends-->
				<table border="0"   width="100%" style="border-bottom: 2px dashed #000;margin:5px 0;"></table>
				<table style="border:solid 2px #000;" border="0"   width="100%">
				<tbody>
				<tr>
					<td>
						<!--Invoice Table Starts-->
						<table style="border:solid 1px #fff;" border="0" cellpadding="10"  width="100%">
						<tbody>
						<tr>
							<th style="background-color:rgb(167, 167, 167); color:#FFF; align="center" height="15" valign="middle">
								No
							</th>
							<th style="background-color:rgb(167, 167, 167); color:#FFF; align="center" height="15" valign="middle">
								Nama Barang
							</th>
							<th style="background-color:rgb(167, 167, 167); color:#FFF; align="center" height="15" valign="middle">
								Jumlah
							</th>
							<?php if($Qorder->fl_drop_shipper==0){ ?>
							<th style="background-color:rgb(167, 167, 167); color:#FFF; align="center" height="15" valign="middle">
								Harga
							</th>
							<th style="background-color:rgb(167, 167, 167); color:#FFF; align="center" height="15" valign="middle">
								Diskon
							</th>
							<th style="background-color:rgb(167, 167, 167); color:#FFF; align="center" height="15" valign="middle">
								Sub total
							</th>
							<?php } ?>
						</tr>
						<?php 
					$n=1;
					foreach($product->result() as $wp){ 
						$harga 		=$wp->harga; 
						$discount	=$wp->discount_order;
						if($wp->discount_order>0) { 
							$harga =$wp->harga-($wp->harga*$wp->discount_order/100); 
						}
						echo'
						<tr>
							<td style="color:#000;border-bottom: 1px solid #bbb;" align="center">
								'.$n.'
							</td>
							<td style="color:#000;border-bottom: 1px solid #bbb;" align="center">
								'.$wp->nm_product.'
							</td>
							<td style="color:#000;border-bottom: 1px solid #bbb;" align="center">
								'.$wp->qty.'
							</td>
							'; if($Qorder->fl_drop_shipper==0){ echo'
							<td style="color:#000;border-bottom: 1px solid #bbb;" align="right">
								Rp. '.number_format($harga,0,',','.').'
							</td>
							<td style="color:#000;border-bottom: 1px solid #bbb;" align="right">
								'.$discount.' %
							</td>
							<td style="color:#000;border-bottom: 1px solid #bbb;" align="right">
								Rp. '.number_format($wp->qty*$harga,0,',','.').'
							</td>
							'; } echo'
						</tr>
						'; $n++; } ?> 
						<?php 
							/*---Check Promo Pembelian---*/
									$promo_pembelian="";
									if($Qorder->discount_pembelian>0){
										$promo_pembelian	='<tr>
																<td>
																	&nbsp;
																</td>
																<td>
																	&nbsp;
																</td>
																<td>
																	&nbsp;
																</td>
																<td>
																	&nbsp;
																</td>
																<td style="color:#000; font-weight:normal; padding-right:30px;" align="right">
																	Diskon Pembelian:
																</td>
																<td style="color:#000; font-weight:normal; padding-right:20px;" align="right">
																	<b>'.$Qorder->discount_pembelian.' %</b>
																</td>
															</tr>';
									}
								/*---Check Promo Pembelian---*/
						if($Qorder->fl_set_shipping==1){ ?>
						<tr>
							<td>
								&nbsp;
							</td>
							<td>
								&nbsp;
							</td>
							<td>
								&nbsp;
							</td>
							<td>
								&nbsp;
							</td>
							<td style="color:#000; font-weight:normal; padding-right:30px;" align="right">
								Expedisi Pengiriman:
							</td>
							<td style="color:#000; font-weight:normal; padding-right:20px;" align="right">
								<?=$order->
								convert_expedisi($Qorder->jne_expedisi)?>
							</td>
						</tr>
						<tr>
							<td>
								&nbsp;
							</td>
							<td>
								&nbsp;
							</td>
							<td>
								&nbsp;
							</td>
							<td>
								&nbsp;
							</td>
							<td style="color:#000; font-weight:normal; padding-right:30px;" align="right">
								Biaya Pengiriman:
							</td>
							<td style="color:#000; font-weight:normal; padding-right:20px;" align="right">
								<b>Rp. <?=number_format($Qorder->ongkir,0,',','.')?></b>
							</td>
						</tr>
						
						<?php 
							echo $promo_pembelian;
						} ?>
						<tr>
							<td>
								&nbsp;
							</td>
							<td>
								&nbsp;
							</td>
							<td>
								&nbsp;
							</td>
							<td>
								&nbsp;
							</td>
							<td style="color:#000; font-weight:normal; padding-right:30px;" align="right">
								Total:
							</td>
							<td style="color:#000; font-weight:normal; padding-right:20px;" align="right">
								<b>Rp. <?=number_format($Qorder->total_tagihan,0,',','.')?></b>
							</td>
						</tr>
						</tbody>
						</table>
						<!--Invoice Table Ends-->
					</td>
				</tr>
				</tbody>
				</table>
				<table border="0"   width="100%">
				<tbody>
				<tr>
					<td rowspan="3" width="50">
						&nbsp;
					</td>
					<td colspan="2" height="20">
					</td>
					<td rowspan="3" width="28">
						&nbsp;
					</td>
				</tr>
				<tr>
					<td align="left" valign="bottom" width="150">
						<!--Billing From-->
						<table style="color:#5a5a5a; line-height:18px;" border="0"   width="100%">
						<tbody>
						<tr>
							<td colspan="2" align="left" valign="top">
							</td>
						</tr>
						<?php
							if($Qorder->fl_drop_shipper==0){ echo"
						<tr>
							<td colspan='2' align='center'>
								<b>".$toko->nm_toko."</b><br>
								<br>
								<br>
								<hr>
							</td>
						</tr>
						"; }else{ echo"
						<tr>
							<td colspan='2' align='center'>
								<b>".$pengirim->full_name."</b><br>
								<br>
								<br>
								<hr>
							</td>
						</tr>
						"; } ?>
						</tbody>
						</table>
					</td>
					<td align="center" valign="bottom" width="270">
						<table style="color:#5a5a5a; line-height:18px;" border="0"   width="150">
						<tbody>
						<tr>
							<td colspan="2" align="left" valign="top">
							</td>
						</tr>
						<tr>
							<td colspan="2" align="center">
								<b><?=$pelanggan->full_name?></b><br>
								<br>
								<br>
								<hr>
							</td>
						</tr>
						</tbody>
						</table>
					</td>
				</tr>
				<tr>
					<td colspan="2" height="20">
					</td>
				</tr>
				</tbody>
				</table>
			</td>
		</tr>
		</tbody>
		</table>
	</td>
</tr>
<!--MID CONTAINER ENDS-->
</tbody>
</table>
</body>
</html>