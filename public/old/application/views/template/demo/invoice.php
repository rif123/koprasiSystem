<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body style="background-color:#fff; margin:0px; padding:0px;">
<style>
p{font-family: arial;
font-size: 13px;
line-height: 20px;
margin:2px;}
</style>

<div style="min-height: 10em;">
	<p>Hallo <?=$order->full_name?>.</p>
	<p>Dengan ini diberitahukan bahwa invoice Anda telah kami terbitkan pada tanggal <?=$checkout->DateToIndo($order->tgl_order)?>.</p>
	<p>Metode pembayaran adalah: Bank Transfer</p>
	<br>
</div>

<table style="background-color:#fff; font-family:Arial, Helvetica, sans-serif;" border="0" cellpadding="0" cellspacing="0" width="100%">
  <!--HEADER CONTAINER STARTS-->
  <tbody><tr>
    <td align="center"><!--HEADER STARTS-->
      <table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
        <tbody><tr>
          <td colspan="2" align="center" height="27">&nbsp;</td>
        </tr>        
        <tr>
          <td colspan="2" height="7"></td>
        </tr>
      </tbody></table>
      <!--HEADER ENDS--></td>
  </tr>
  <!--HEADER CONTAINER ENDS-->
  <!--MID CONTAINER STARTS-->
  <tr>
    <td><table align="left" border="0" cellpadding="0" cellspacing="0" width="620">
        <tbody>
        <tr>
          <td class="lsh" align="right" valign="top" width="10"></td>
          <td style="background-color:#FFFFFF; border:solid 1px #d8d8d4; border-width:0px 1px 0px;" align="center" valign="top" width="600"><!--CONTENT SECTION STARTS-->
            <table align="center" border="0" cellpadding="0" cellspacing="0" height="50" width="570">
              <tbody><tr>
                 <td align="left" valign="middle"><h1 style="color:#F38256; font-size:40px; margin:0px; padding:0px; font-weight:normal; line-height:28px;"><?=$toko->nm_toko?></h1></td>
                <!--Section Title-->
                <td align="center" valign="bottom" width="177"></td>
              </tr>
            </tbody></table>
			 <table border="0" cellpadding="0" cellspacing="0" width="570">
              <tbody><tr>
                <td>
                
                <table a="a" style="background-color:#dadada;margin-top: 15px;" border="0" cellpadding="0" cellspacing="0" height="25" width="250">
                    <tbody><tr>
                      <td width="10"></td>
                      <!--Invoice No-->
					  <td width="10">&nbsp;</td>
                      <td style="font-weight:bold; color:#000; font-size:15px;" align="center" valign="middle" width="180">No Transaksi. <?=$order->id_pesanan?></td>
                    </tr>
                  </tbody>
				 </table>
				</td>
              </tr>
              <tr>
                <td height="25">&nbsp;</td>
              </tr>
            </tbody></table>
            <!--Billing Info Starts-->
            <table style="background-color:#f3f3f3; border-top:solid 2px #F38256;" border="0" cellpadding="0" cellspacing="0" width="600">
              <tbody><tr>
                <td rowspan="3" width="28">&nbsp;</td>
                <td colspan="2" height="20"></td>
                <td rowspan="3" width="28">&nbsp;</td>
              </tr>
              <tr>
                <td style="border-right:solid 1px #cacaca;" align="left" valign="bottom" width="270">
                <!--Billing From-->
                <table style="color:#5a5a5a; font-size:12px; line-height:18px;" border="0" cellpadding="0" cellspacing="0" width="230">
                    <tbody><tr>
                      <td colspan="2" align="left" height="30" valign="top"><strong style="font-weight:bold; color:#000;"><?=$identitas->site_title?></strong></td>
                    </tr>
                    <tr>
                      <td width="76">Kontak</td>
                      <td width="154">:  &nbsp;<?=$toko->nm_toko?></td>
                    </tr>
                    <tr>
                      <td>E-Mail </td>
                      <td>:   &nbsp;<?=$identitas->email?></td>
                    </tr>
                    <tr>
                      <td>Telepon </td>
                      <td>:  &nbsp;<?=$toko->telp?></td>
                    </tr>
                    <tr>
                      <td >Alamat </td>
                      <td >:  &nbsp;<?=$toko->alamat?><br><?=$toko->kota?></td>
                    </tr>
                  </tbody></table></td>
               <td align="center" valign="bottom" width="270">
                <!--Billing To-->
                <table style="color:#5a5a5a; font-size:12px; line-height:18px;" border="0" cellpadding="0" cellspacing="0" width="220">
                    <tbody><tr>
                      <td colspan="2" align="left" height="30" valign="top"><strong style="font-weight:bold; color:#000;">Penagihan kepada:</strong></td>
                    </tr>
                    <tr>
                      <td colspan="2" align="left"><?=$order->full_name?><br>
                        <?=$order->alamat?>, <?=$order->kec?>, <?=$order->kota?><br> <?=$order->provinsi?><br>
                        Telepon: <?=$order->no_telepon?><br>
						Handphone: <?=$order->hp?><br>
                        <?=$order->email?></td>
                    </tr>
                  </tbody>
				</table>
			</td>
              </tr>
              <tr>
                <td colspan="2" height="20"></td>
              </tr>
            </tbody></table>
            <!--Billing Info Ends-->
           
            <table style="border:solid 1px #d1d1d1;" border="0" cellpadding="0" cellspacing="0" width="570">
              <tbody><tr>
                <td>
                <!--Invoice Table Starts-->
                <table style="border:solid 1px #fff;" border="0" cellpadding="10" cellspacing="0" width="570">
                    <tbody>
					<tr>
                      <th style="background-color:#545454; color:#FFF; font-size:12px; font-weight:normal" align="left" height="30" valign="middle" width="220">Nama Barang</th>
					  <th style="background-color:#545454; color:#FFF; font-size:12px; font-weight:normal" align="center" height="30" valign="middle" width="80">Harga Satuan</th>
					  <th style="background-color:#545454; color:#FFF; font-size:12px; font-weight:normal" align="center" height="30" valign="middle" width="80">Diskon</th>
                      <th style="background-color:#545454; color:#FFF; font-size:12px; font-weight:normal" align="center" height="30" valign="middle" width="50">Jumlah</th>
                      <th style="background-color:#545454; color:#FFF; font-size:12px; font-weight:normal" align="center" height="30" valign="middle" width="80">Subtotal</th>
                    </tr>
					<?php 
					$subtotal=0;
					foreach($product->result() as $wp){
						$promo_message	="";
						if($wp->bonus_bogof<>""){
							$promo_message='<b style="color:green;">Bonus '.$wp->bonus_bogof.'</b>';
						}
						if($checkout->check_promo($wp->idx_product)->num_rows()>0){
							$promo_message='<b style="color:green;">Promo Diskon</b>';
						}
						if($order->fl_set_shipping==1){
							if($checkout->free_ongkir($wp->idx_product)>0){
								$promo_message	='<b style="color:green;">Gratis Pengiriman</b>';
							}
						}
						$harga			=$wp->harga-($wp->harga*$wp->discount/100);
						echo'
							<tr>
							  <td style="color:#000; font-weight:normal; font-size:12px;" align="left">'.$wp->nm_product.'<br>'.$promo_message.'</td>
							  <td style="color:#000; font-weight:normal; font-size:12px;" align="left">Rp.'.number_format($wp->harga,0,',','.').'</td>
							  <td style="color:#000; font-weight:normal; font-size:12px;" align="center">'.$wp->discount.' %</td>
							  <td style="color:#000; font-weight:normal; font-size:12px;" align="center">'.$wp->qty.'</td>
							  <td style="color:#000; font-weight:normal; font-size:12px;" align="center">Rp.'.number_format($harga*$wp->qty,0,',','.').'</td>
							</tr>';
						$subtotal=$subtotal +($harga*$wp->qty);
					}
					if($order->fl_set_shipping==1){
						if(($order->ongkir_dasar==0)&&($order->ongkir==0)){
							$ongkir_dasar	="<b style='color:#50E00D'>Gratis</b>";
							$ongkir			="<b style='color:#50E00D'>Gratis</b>";
							$expedisi		="";
						}else{
							$ongkir_dasar	='Rp. '.number_format($order->ongkir_dasar,0,',','.').' /Kg';
							$ongkir			='Rp. '.number_format($order->ongkir,0,',','.');
							$expedisi		='<tr>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
												<td style="color:#000; font-weight:normal; font-size:12px; padding-right:30px;" align="right">JNE Expedisi:</td>
												<td style="color:#000; font-weight:normal; font-size:12px; padding-right:20px;" align="right">'.$checkout->convert_expedisi($order->jne_expedisi).'</td>
											</tr>';
						}
						echo $expedisi;
						echo'
						<tr>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td style="color:#000; font-weight:normal; font-size:12px; padding-right:30px;" align="right">Ongkos Kirim:</td>
						  <td style="color:#000; font-weight:normal; font-size:12px; padding-right:20px;" align="right">
							'.$ongkir_dasar.'
						  </td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							  <td>&nbsp;</td>
							  <td>&nbsp;</td>
							  <td style="color:#000; font-weight:normal; font-size:12px; padding-right:30px;" align="right">Berat:</td>
							  <td style="color:#000; font-weight:normal; font-size:12px; padding-right:20px;" align="right">'.($order->berat/1000).' Kg</td>
						</tr>
						<tr>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td style="color:#000; font-weight:normal; font-size:12px; padding-right:30px;" align="right">Total Ongkos Kirim:</td>
						  <td style="color:#000; font-weight:normal; font-size:12px; padding-right:20px;" align="right">
							'.$ongkir.'
						  </td>
						</tr>';
					}
					/*---Check Promo Pembelian---*/
						$promo_pembelian="";
						if($order->discount_pembelian>0){
							$promo_pembelian	='<tr>
													 <td>&nbsp;</td>
													  <td>&nbsp;</td>
													  <td>&nbsp;</td>
													  <td style="color:#000; font-weight:normal; font-size:12px; padding-right:30px;" align="right">Diskon Pembelian:</td>
													  <td style="color:#000; font-weight:normal; font-size:12px; padding-right:20px;" align="right">'.$order->discount_pembelian.' %</td>
												</tr>';
						}
					/*---Check Promo Pembelian---*/
					echo $promo_pembelian;
					?>
                    <tr style="background-color:#d0d7d8;">
                      <td>&nbsp;</td>
					  <td>&nbsp;</td>
					  <td>&nbsp;</td>
                      <td style="color:#000; font-weight:normal; font-size:12px; padding-right:30px; font-weight:bold;" align="right">TOTAL:</td>
                      <!--TOTAL-->
                      <td style="color:#000; font-weight:normal; font-size:12px; padding-right:20px; font-weight:bold;" align="right">Rp.<?=number_format($order->total_tagihan,0,',','.')?></td>
                    </tr>
					<?php if($order->fl_set_shipping==0){
					echo'
					<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td colspan="2" style="color:#000; font-weight:normal; font-size:12px; padding-right:30px;" align="right"><p style="color:red">* Harga belum termasuk ongkos kirim</p></td>
					</tr>';
					}
					?>
                  </tbody></table>
                  <!--Invoice Table Ends-->
                  </td>
              </tr>
            </tbody></table>
            <!--CONTENT SECTION ENDS--></td>
          <td class="rsh" align="left" valign="bottom" width="9"></td>
        </tr>
      </tbody>
	  </table>
	 </td>
  </tr>
  <!--MID CONTAINER ENDS-->
		</tbody>
	</table>

<div style="min-height: 10em;">
	<p><b>Informasi Rekening</b></p>
	<?php
	foreach($bank->result() as $b){
		echo"
		<p>".$b->nm_bank."</p>
		<p>A/N : ".$b->atas_nama."</p>
		<p>No Rekening : <b>".$b->no_rek."</b></p>
		<br>
		";
	}
	?>
	<p>Setelah melakukan pembayaran harap lakukan konfirmasi pembayaran <a href="<?=site_url("page/payment_confirm?q=".$order->id_pesanan)?>" target="_blank">Konfirmasi Pembayaran</a></p>
</div>
	
	<div style="min-height: 2em;">
	<p>Hormat Kami,</p>
	<p><?=$toko->nm_toko?></p>
	</div>
	</body>
</html>