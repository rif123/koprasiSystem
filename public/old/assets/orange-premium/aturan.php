<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php $this->load->view('template/demo/resource'); ?>
<!-- mobile setting -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
</head>
<body>
<style>
p{padding: 10px 0;
line-height: 1.4em;
color: #DD2323;
font-size: 1.2em;}
</style>
<div class="wrapper">
<div class="section_container" style="border-top: 1px solid #C2BEBE;"> 
    <!--Mid Section Starts-->
    <section> 
      <!--CART STARTS-->
      <div id="shopping_cart" class="full_page" style='margin:2em;'>
	  <p>- Berikut adalah kota yg termasuk dalam area gratis pengiriman.</p>
        <div class="cart_table">
          <table class="data-table cart-table" id="shopping-cart-table" cellpadding="0" cellspacing="0">
            <tbody>
			<tr>
              <th width="8%">No</th>
              <th class="align_left" >Nama Kota</th>
            </tr>
			<?php
				$n=1;
				foreach($city->result() as $wcty){
					echo'
						<tr>
						<td class="align_center vline"><span class="price">'.$n.'</span></td>
						<td class="align_left vline"><span class="price">'.$wcty->kota.'</span></td>
						</tr>
					';
					$n++;
				}
			?>
          </tbody>
		 </table>
        </div>
		<p>- Gratis pengiriman hanya berlaku untuk transaksi produk yang terdapat dalam promo ini dan tidak dapat digabung dengan transaksi produk di luar promo.</p>
      </div>
      <!--CART ENDS-->
    </section>
    <!--Mid Section Ends--> 
  </div>
</body>
</html>