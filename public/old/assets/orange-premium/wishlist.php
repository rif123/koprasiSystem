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
			<?php $this->load->view('template/demo/header'); ?>
		<!---HEader----->
    </div>
<div class="section_container" style="border-top: 1px solid #C2BEBE;"> 
    <!--Mid Section Starts-->
    <section> 
      <!--CART STARTS-->
      <div id="shopping_cart" class="full_page">
        <h1>Wishlist</h1>
        <div class="cart_table">
		<form action="<?=site_url('cart/update')?>" id="frm_cart" method="post">
          <table class="data-table cart-table" id="shopping-cart-table" cellpadding="0" cellspacing="0">
            <tbody>
			<tr>
              <th width="10%"></th>
              <th width="30%">Nama Produk</th>
              <th width="30%">Harga</th>
			  <th class="align_center" width="6%"></th>
            </tr>
			<?php
			foreach($wishlist->result() as $w){
				echo'
				<tr>
					<td><a href="'.site_url('detail/'.$w->idx_product.'/'.strtolower(str_replace(" ","",$w->nm_product))).'" title="'.$w->nm_product.'" title="Pesan Produk"><img style="width:50px" src="'.base_url().'uploads/product/'.$w->thumb.'"></a></td>
					<td><a href="'.site_url('detail/'.$w->idx_product.'/'.strtolower(str_replace(" ","",$w->nm_product))).'" title="'.$w->nm_product.'" title="Pesan Produk">'.$w->nm_product.'</a></td>
					<td>Rp.'.number_format($w->harga_discount,0,',','.').'</td>
					 <td class="align_center vline"><a onClick="loading()" href="'.site_url('customer/delete/'.$w->idx_wishlist).'" class="remove"></a></td>
				</tr>';
			}
			?>
          </tbody>
		 </table>
		 </form>
      </div>
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