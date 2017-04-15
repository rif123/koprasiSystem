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
      <!--CART STARTS-->
      <div id="shopping_cart" class="full_page">
        <h4>Terimakasih atas pesananya, invoice sudah dikirim ke email anda.</h4>
        <div class="cart_table">
          <table class="data-table cart-table" id="shopping-cart-table" cellpadding="0" cellspacing="0">
            <tbody>
				<tr>
				  <th class="align_center" width="12%">No Transaksi</th>
				  <th  width="10%">Pemesan</th>
				  <th  width="12%">Total Tagihan</th>
				</tr>
				<tr>
				  <td class="align_center" width="12%"><?=$order->id_pesanan?></td>
				  <td width="10%"><p><?=$order->full_name?></p><br><p><?=$order->email?></p></td>
				  <td width="12%"><?='Rp.'.number_format($order->total_tagihan,0,',','.')?></td>
				</tr>
			</tbody>
		 </table>
        </div>
        <div class="action_buttonbar">
          <button type="button" onClick="window.location='<?=site_url('page/shop');?>';" title="Kembali ke Katalog" class="continue">Kembali ke Katalog</button>
          <button type="button" onClick="window.location='<?=site_url('page/payment_confirm?q='.$order->id_pesanan);?>';" title="Konfirmasi Pembayaran" class="checkout">Konfirmasi Pembayaran</button>
        </div>
      </div>
      <!--CART ENDS--> 
    </section>
    <!--Mid Section Ends--> 
  </div>
  
    <div class="footer_container">
        <!--Footer Starts-->
       <?php $this->load->view('template/demo/footer'); ?>
	   <!--Footer Ends-->
    </div>
</div>
</body>
</html>