<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php $this->load->view('template/demo/resource'); ?>
<!-- mobile setting -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
</head>
<body>
<div class="wrapper">
<div class="section_container" style="border-top: 1px solid #C2BEBE;"> 
    <!--Mid Section Starts-->
    <section> 
      <!--CART STARTS-->
      <div id="shopping_cart" class="full_page">
        <div class="cart_table">
          <table class="data-table cart-table" id="shopping-cart-table" cellpadding="0" cellspacing="0">
            <tbody>
			<tr>
              <th colspan="2">Produk</th>
              <th class="align_center" width="6%"></th>
			   <th class="align_center" width="12%">Berat (Kg)</th>
              <th class="align_center" width="12%">Harga</th>
			  <th class="align_center" width="12%">Diskon (%)</th>
              <th class="align_center" width="10%">Jumlah</th>
              <th class="align_center" width="12%">Subtotal Produk</th>
            </tr>
			<?php 
			$nt=0;
			foreach($list_product->result() as $item){
				$bonus="";
				if($page->cek_bogof($item->idx_product)->num_rows()>0){
					$bonus="<b style='color:green'>Bonus ".$page->cek_bogof($item->idx_product)->row()->bogof_caption."</b>";
				}
				$price	=$item->harga-($item->discount_order/100*$item->harga);
				echo'
				<tr>
				  <td width="10%"><img style="width:100%" src="'.base_url().'uploads/product/'.$item->thumb.'"></td>
				  <td class="align_left" width="44%"><a class="pr_name" href="#">'.$item->nm_product.'</a><span class="pr_info">'.$item->ket.'<br>'.$bonus.'</span></td>
				  <td class="align_center"></td>
				   <td class="align_center vline"><span class="price">'.($item->berat*$item->qty/1000).'</span></td>
				   <td class="align_center vline"><span class="price">Rp.'.number_format($item->harga,0,',','.').'</span></td>
				  <td class="align_center vline"><span class="price">'.$item->discount_order.'</span></td>
				  <td class="align_center vline">'.$item->qty.'</td>
				  <td class="align_right vline"><span class="price">Rp.'.number_format($price*$item->qty,0,',','.').'</span></td>
				</tr>';
				$nt=$nt+($price*$item->qty);
			}
			
			?>
				<tr>
				  <td style='text-align: right;vertical-align: middle;' colspan="6"><span class="price">Subtotal</span></td>
				  <td class="align_center vline" colspan="2"><span class="price">Rp. <?=number_format($nt,0,',','.')?></span></td>
				</tr>
          </tbody>
		 </table>
		 <?php
								/*---Check Promo Pembelian---*/
									$promo_pembelian	="";
									if($order->discount_pembelian>0){
											$promo_pembelian		='<tr>
																		<td colspan="1" class="align_left" width="55%">Diskon Pembelian</td>
																		<td class="align_left" style=""><span class="price"><b style="color:#50E00D">'.$order->discount_pembelian.' %</b></span></td>
																	</tr>';
									}
								/*---Check Promo Pembelian---*/
							?>
		  <div class="totals">
							<table id="totals-table" style="width:55%">
								<tbody>
								<?php if($order->fl_set_shipping==1){ ?>
								<tr class="expedisi_area">
									<td colspan="1" class="align_left" width="50%">Expedisi JNE</td>
									<td class="align_left" width="55%"><?=$page->convert_expedisi($order->jne_expedisi)?></td>
								</tr>
								<tr>
								  <td colspan="1" class="align_left" width="50%">Ongkos Kirim</td>
								  <?php
									if($order->ongkir_dasar==0){
										$ongkir_dasar	="<b style='color:green'>Gratis</b>";
										$ongkir			="<b style='color:green'>Gratis</b>";
									}else{
										$ongkir_dasar	="Rp. ".number_format($order->ongkir_dasar,0,',','.')." /Kg";
										$ongkir			="Rp. ".number_format($order->ongkir,0,',','.');
									}
								  ?>
								  <td class="align_left"  width="55%"><span class="price" id="ongkir_dasar"><?=$ongkir_dasar?></span></td>
								</tr>
								<tr>
								  <td colspan="1" class="align_left" width="50%">Berat</td>
								  <td class="align_left" width="55%"><?=($order->berat/1000)?> Kg</td>
								</tr>
								<tr>
								  <td colspan="1" class="align_left" width="50%">Total Ongkos Kirim</td>
								  <td class="align_left"  width="55%"><span class="price" id="ongkir"><?=$ongkir?></span></td>
								</tr>
								<?php } ?>
								<?=$promo_pembelian?>
								<tr>
								  <td colspan="1" class="align_left total" width="50%">Total</td>
								  <td class="align_left"  width="55%"><span class="total" id="total"><?='Rp.'.number_format($order->total_tagihan,0,',','.')?></span></td>
								</tr>
								<?php if($order->fl_set_shipping==0){ ?>
								<tr>
								  <td colspan="2" class="align_left" width="50%"><p style="color:red;">Harga belum termasuk ongkos kirim</p></td>
								</tr>
								<?php } ?>
							</tbody>
							</table>
						  </div>
        </div>
      </div>
      <!--CART ENDS-->
    </section>
    <!--Mid Section Ends--> 
  </div>
</body>
</html>