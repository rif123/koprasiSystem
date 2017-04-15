<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<body style="background-color:#fff; margin:0px; padding:0px;">
<style>
td{font-family: Arial;
font-size: 11px;}
p{font-family: Arial;
margin: 10px 0px;
font-size: 20px;
line-height: 20px;
color: #000;
padding: 5px 5px;font-weight:bold;}
</style>
<table style="background-color:#fff; font-family:Arial;" border="0" width="408">
<!--HEADER CONTAINER STARTS-->
<tbody>
<!--MID CONTAINER STARTS-->
<tr>
	<td>
		<table align="left" border="0" cellpadding="0" cellspacing="0" width="408">
		<tbody>
		<tr>
			<td style="background-color:#FFFFFF; border:solid 1px #d8d8d4; border-width:0px 1px 0px;" align="center" valign="top" width="408">
				<!--CONTENT SECTION STARTS-->
				<!--Billing Info Starts-->
				<table border="2"   width="100%">
				<tbody>
				<tr>
					<td colspan="2" height="20">
						<p>
							Pengembalian Barang
						</p>
					</td>
				</tr>
				<tr>
					<td align="left" width="60%">
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
								<b>'.$pelanggan->full_name.'</b>
							</td>
						</tr>
						<tr>
							<td>
								'.$pelanggan->alamat.' '.$pelanggan->kec.' '.$pelanggan->kota.'<br>
								'.$pelanggan->provinsi.'
							</td>
						</tr>
						<tr>
							<td>
								'.$pelanggan->hp.'
							</td>
						</tr>
						'; }else{ echo'
						<tr>
							<td width="76">
								<b>'.$pengirim->full_name.'</b>
							</td>
						</tr>
						<tr>
							<td>
								'.$pengirim->hp.'
							</td>
						</tr>
						'; } ?>
						</tbody>
						</table>
					</td>
					<td align="center" width="39%">
						<table style="color:#5a5a5a; line-height:18px;" border="0"   width="100%">
						<tbody>
						<tr>
							<td colspan="2" align="left" valign="top">
								<strong style="font-weight:bold; color:#000;">Kepada:</strong>
							</td>
						</tr>
						<tr>
							<td colspan="2" align="left">
								<b><?=$toko->nm_toko?></b><br>
								<?=$toko->alamat?> <?=$toko->kota?> <?=$toko->telp?>
							</td>
						</tr>
						</tbody>
						</table>
					</td>
				</tr>
				</tbody>
				</table>
				<!--Billing Info Ends-->
				<table border="0"   width="100%" style="margin:5px 0;"></table>
				<table style="border:solid 2px #000;" border="0" cellpadding="0" cellspacing="0"  width="100%">
				<tbody>
				<tr>
					<td>
						<p style="color:red;font-size: 9px;border:none;padding: 0px 10px;margin: 0;">
							* Centang produk yang akan dikembalikan
						</p>
					</td>
				</tr>
				<tr>
					<td>
						<!--Invoice Table Starts-->
						<table style="border:solid 1px #fff;" border="0" cellpadding="0" cellspacing="0"  width="100%">
						<tbody>
						<tr>
							<th style="background-color:rgb(106, 196, 64); color:#FFF;" align="center" height="15" valign="middle">
								Kolom Centang
							</th>
							<th style="background-color:rgb(106, 196, 64); color:#FFF;" align="center" height="15" valign="middle">
								No
							</th>
							<th style="background-color:rgb(106, 196, 64); color:#FFF;" align="left" height="15" valign="middle">
								Nama Produk
							</th>
							<th style="background-color:rgb(106, 196, 64); color:#FFF;" align="center" height="15" valign="middle">
								Jumlah Beli
							</th>
							<th style="background-color:rgb(106, 196, 64); color:#FFF;" align="center" height="15" valign="middle">
								Jumlah Pengembalian
							</th>
						</tr>
						<?php 
					$n=1;
					foreach($product->
						result() as $wp){ echo'
						<tr>
							<td style="color:#000;" align="left">
								<input type="checkbox"/>
							</td>
							<td style="color:#000;" align="left">
								'.$n.'
							</td>
							<td style="color:#000;" align="left">
								'.$wp->nm_product.'
							</td>
							<td style="color:#000;" align="left">
								'.$wp->qty.'
							</td>
							<td style="color:#000;" align="center">
								<input type="text" style="width:40px;border:1px solid #bbb;"/>
							</td>
						</tr>
						'; $n++; } ?>
						<tr>
							<table border="0" width="100%" cellpadding="0" cellspacing="0">
								<tr>
									<td>Alasan Pengembalian</td>
									<td>_________________________________________________</td>
								</tr>
								<tr>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
								</tr>
								<tr>
									<td>____________________</td>
									<td>_________________________________________________</td>
								</tr>
								<tr>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
								</tr>
								<tr>
									<td>____________________</td>
									<td>_________________________________________________</td>
								</tr>
								<tr>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
								</tr>
								<tr>
									<td>____________________</td>
									<td>_________________________________________________</td>
								</tr>
							</table>
						</tr>
						</tbody>
						</table>
						<!--Invoice Table Ends-->
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