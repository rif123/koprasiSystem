<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body style="background-color:#fff; margin:5pxpx; padding:0px;">
<style>
*{font-family:arial;}
p{font-family: arial;
font-size: 13px;
line-height: 20px;
margin:2px;}
</style>
	<div style="min-height: 10em;padding: 5px 5px;">
	<p>Hallo <b><?=$elm_cus->full_name?></b>.</p>
		<p>Pada tanggal <?=$cus->DateToIndo(date('Y-m-d'))?> anda telah memasukan salah satu produk <?=$identitas->site_title?> ke dalam wishlist anda</p>
		<br>
		<p><b>Berikut informasi produk yg anda pilih</b></p>
		<?php
			$promo_message	="";
			/*---Check Promo & Discount---*/
				$discount	=$elm_product->discount;
				if($cus->promo_persentasi($elm_product->idx_product)<>false){
					$discount		=$cus->promo_persentasi($elm_product->idx_product);
					$promo_message	="Promo Diskon ".$discount." %";
				}
			/*---Check Promo & Discount---*/
			/*---Check Promo Bogof---*/
				if($cus->promo_bogof($elm_product->idx_product)->num_rows()>0){
					$promo_message	=$cus->promo_bogof($elm_product->idx_product)->row()->bogof_caption;
				}
			/*---Check Promo Bogof---*/
			/*---Check Promo Ongkir---*/
				if($cus->free_ongkir($elm_product->idx_product)>0){
					$promo_message	="Gratis Ongkos Kirim";
				}
			/*---Check Promo Ongkir---*/
			$price	=$elm_product->harga-($discount/100*$elm_product->harga);
		?>
		<div style="overflow:hidden;"><p style="float: left;margin:5px;margin-right: 10px;width: 8em;"><img src="<?=base_url()?>uploads/product/<?=$elm_product->thumb?>"/></p></div>
		<div style="overflow:hidden;"><p style="float: left;margin:5px;margin-right: 10px;width: 8em;"><b>Nama Produk</b></p><p style="float: left;margin:5px;"><?=$elm_product->nm_product?></p></div>
		<div style="overflow:hidden;"><p style="float: left;margin:5px;margin-right: 10px;width: 8em;"></p><p style="float: left;margin:5px;"><b style='color:green;'><?=$promo_message?></b></p></div>
		<div style="overflow:hidden;"><p style="float: left;margin:5px;margin-right: 10px;width: 8em;"><b>Harga Satuan</b></p><p style="float: left;margin:5px;">Rp. <?=number_format($elm_product->harga,0,',','.')?></p></div>
		<div style="overflow:hidden;"><p style="float: left;margin:5px;margin-right: 10px;width: 8em;"><b>Diskon</b></p><p style="float: left;margin:5px;"><?=$discount?> %</p></div>
		<div style="overflow:hidden;"><p style="float: left;margin:5px;margin-right: 10px;width: 8em;"><b>Harga Setelah Diskon</b></p><p style="float: left;margin:5px;">Rp. <?=number_format($price,0,',','.')?></p></div>
		<div style="overflow:hidden;"><p style="float: left;margin:5px;margin-right: 10px;width: 8em;"><b>Jumlah produk Masuk ke Wishlist</b></p><p style="float: left;margin:5px;"><?=$qty?></p></div>
		<div style="overflow:hidden;"><p style="float: left;margin:5px;margin-right: 10px;width: 8em;"><b>Stok Tersedia</b></p><p style="float: left;margin:5px;"><?=$cus->stock_available($idx_attribute_product,$elm_product->idx_product)?></p></div>
		
		<br>
		<p>Untuk Memesan Produk tersebut silahkan lakukan transaksi pada web online kami <a href="<?=site_url()?>" target="_blank"><?=$identitas->site_title?></a></p>
		<p style='color:red'>* Produk sewaktu waktu dapat berubah tanpa pemberitahuan terlebih dahulu.</p>
		<br><br>
	<p><?=$identitas->site_title?></p>
	</div>
	
</body>
</html>