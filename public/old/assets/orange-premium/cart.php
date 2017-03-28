<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="description" content="<?=$identitas->description?>"/>
<meta name="author" content="<?=$identitas->site_title?>">
<meta property="og:url" content="<?='http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>">
<meta name="keywords" content="<?=$identitas->keyword?>,Cart,Keranjang Belanja" />
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
        <h1>Daftar Pesanan</h1>
		<div class="short-code msg error" style="display:none"></div>
        <div class="action_buttonbar">
           <button type="button" title="Kembali ke Katalog" onclick="redirect('<?=site_url('page/shop')?>');" class="continue">Kembali ke Katalog</button>
          <button type="button" title="Perbaharui Cart" id="update" class="checkout">Perbaharui Cart</button>
        </div>
        <div class="cart_table">
		<form action="#" id="frm_cart" method="post">
          <table class="data-table cart-table" id="shopping-cart-table" cellpadding="0" cellspacing="0">
            <tbody>
			<tr>
              <th colspan="2">Products</th>
              <th class="align_center" width="6%"></th>
			  <th class="align_center" width="12%">Berat (Kg)</th>
              <th class="align_center" width="12%">Harga</th>
			  <th class="align_center" width="12%">Diskon</th>
              <th class="align_center" width="10%">Jumlah Beli</th>
              <th class="align_center" width="12%">Subtotal</th>
              <th class="align_center" width="6%"></th>
            </tr>
			<?php 
			$subtotal			=0;
			foreach($this->cart->contents() as $item){
				$elm_product	=$cart->get_wh($item['id']);
				$promo_message	="";
				/*---Check Promo & Discount---*/
				$discount	=$elm_product->discount;
				if($cart->promo_persentasi($item['id'])<>false){
					$discount		=$cart->promo_persentasi($item['id']);
					$promo_message	='<span style="color:green;" class="pr_info">Promo Diskon '.$discount.' %</span>';
				}
				/*---Check Promo & Discount---*/
				/*---Check Promo Bogof---*/
				if($cart->promo_bogof($item['id'])->num_rows()>0){
					$promo_message	='<span style="color:green;" class="pr_info">Bonus : '.$cart->promo_bogof($item['id'])->row()->bogof_caption.'</span>';
				}
				/*---Check Promo Bogof---*/
				/*---Check Promo Gratis Ongkir---*/
				if($cart->promo_ongkir($item['id'])>0){
					$promo_message	='<span style="color:green;" class="pr_info">Gratis Pengiriman</span>';
				}
				/*---Check Promo Gratis Ongkir---*/
				$opt="";
				foreach ($this->cart->product_options($item['rowid']) as $option_name => $option_value){
					$opt=$option_name;
				}
				$price	=$elm_product->harga-($discount/100*$elm_product->harga);
				echo'
				<tr>
				  <td width="10%"><img style="width:100%" src="'.base_url().'uploads/product/'.$elm_product->thumb.'"></td>
				  <td class="align_left" width="44%">
					<a class="pr_name" href="#">'.$item['name'].'</a>
					<span class="pr_info">'.$elm_product->ket.'</span><br>
					'.$promo_message.'
				</td>
				  <td class="align_center"></td>
				  <td class="align_center vline"><span class="price">'.($elm_product->berat*$item['qty']/1000).'</span></td>
				  <td class="align_center vline"><span class="price">Rp.'.number_format($elm_product->harga,0,',','.').'</span></td>
				  <td class="align_center vline"><span class="price">'.$discount.' %</span></td>
				  <td class="align_center vline"><input class="qty_box" name="qty[]" type="number" min="1" value="'.$item['qty'].'"><input type="hidden" name="add_val[]" value="'.$item['rowid'].'||'.$item['id'].'||'.$opt.'"></td>
				  <td class="align_center vline"><span class="price">Rp.'.number_format($price*$item['qty'],0,',','.').'</span></td>
				  <td class="align_center vline"><a onClick="loading()" href="'.site_url('cart/delete/'.$item['rowid']).'" class="remove"></a></td>
				</tr>';
				$subtotal=$subtotal + $price*$item['qty'];	
			}
				/*---Check Promo Pembelian---*/
				$promo_pembelian="";
				if($discount_pembelian->num_rows>0){
					if($subtotal>=$discount_pembelian->row()->minimum_transaksi){
						$discount			=$discount_pembelian->row()->discount;
						$subtotal			=$subtotal-($subtotal*$discount/100);
						$promo_pembelian	='<tr>
												<td colspan="1" class="align_left" width="80%">Diskon Pembelian</td>
												<td class="align_right" style=""><span class="price"><b style="color:#50E00D">'.$discount.' %</b></span></td>
											</tr>';
					}
				}
				/*---Check Promo Pembelian---*/	
								
								
			?>
          </tbody>
		 </table>
		 </form>
          <div class="totals">
            <table id="totals-table">
                <tbody>
               <!-- <tr>
                  <td colspan="1" class="align_left" width="60%"><a href="#">Daftar Ongkos Kirim</a></td>
                  <td class="align_right" style=""><span class="price"></span></td>
                </tr>-->
				<?=$promo_pembelian?>
                <tr>
                  <td colspan="1" class="align_left total" width="60%">Total</td>
                  <td class="align_right" style=""><span class="total"><?='Rp.'.number_format($subtotal,0,',','.')?></span></td>
                </tr>                
            </tbody>
			</table>
          </div>
        </div>
        <div class="action_buttonbar">
          <button type="button" title="Kembali ke Katalog" onclick="redirect('<?=site_url('page/shop')?>');" class="continue">Kembali ke Katalog</button>
          <button type="button" onclick="redirect('<?=site_url('page/login')?>');" title="" class="checkout">Bayar</button>
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
<script type="text/javascript">
	$(document).ready(function(){
		$("#update").click(function(){
			$.ajax({
				url: '<?=site_url('cart/update')?>',
				data: $('#frm_cart').serialize(),
				type: "POST",
				dataType: 'json',
				success: function (data){
					if(data.error==0){
						loading(data.message);
						location.reload();
					}else{
						$(".error").html(data.message);
						$(".error").show();
						return false;
					}
				}
			});
		});
	});
	function loading(mes){
	$.blockUI({	css: { 
						border: 'none', 
						padding: '15px', 
						backgroundColor: '#000', 
						'font-weight':'bold',
						'-webkit-border-radius': '10px', 
						'-moz-border-radius': '10px', 
						opacity: .5, 
						color: '#fff',
						'font-size':'1em'
					}
					,message:mes
			}); 
			setTimeout($.unblockUI, 1000);
	}
	function redirect(url){
			window.location=url;
		}
</script>

</body>
</html>