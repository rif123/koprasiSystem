<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=".$nm_file.".xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<table border='1' width="70%">
<tr>
<td style='background: #7A7878;color: #fff;'>No</td>
<td style='background: #7A7878;color: #fff;'>Brand</td>
<td style='background: #7A7878;color: #fff;'>Nama Produk</td>
<td style='background: #7A7878;color: #fff;'>Kategori</td>
<td style='background: #7A7878;color: #fff;'>Harga Satuan</td>
<td style='background: #7A7878;color: #fff;'>Discount (%)</td>
<td style='background: #7A7878;color: #fff;'>Harga Jual</td>
<td style='background: #7A7878;color: #fff;'>Stok</td>
<td style='background: #7A7878;color: #fff;'>Nilai Total Produk</td>
</tr>
<?
$n=1;
foreach($SQl->result() as $item) {
	$attr		=$report->attr_product($item->idx_product);
	$attr_label	='';
	$st			=0;
	foreach($attr->result() as $attr_el){
		if($attr_el->stock-$attr_el->stock_akhir>$item->minimum_stock){
			$color="Green";
		}else{
			$color="Red";
		}
		$s=$attr_el->stock - $attr_el->stock_akhir;
		$attr_label=$attr_label."<p style='color:".$color.";'>".$attr_el->desc_attribute." : ".$s."</p>";
		$st=$st+$s;
	}
					$nm="";
					$cat="";
					$query=$this->db->get_where("category_product",array("idx_category_product"=>$item->category_product))->row();
					if($query->parent!=0){
						$res	=$this->db->query("SELECT * FROM (`category_path`) WHERE `idx_category` ='$query->parent' order by level asc");
						foreach($res->result() as $wcp){
							if($nm==""){
								$nm=$report->get_nm($wcp->idx_path);
							}else{
								$nm=$nm." > ".$report->get_nm($wcp->idx_path);
							}
						}
						$cat=$nm." > ";
					}
					$cat=$cat.$report->get_nm($item->category_product);
		$discount		=$item->discount;
		$get_discount	=$this->db->query("SELECT a.discount from content_prom a join promo_management b on a.idx_promo=b.idx_promo where b.idx_type_promo=1 and a.idx_product='$item->idx_product'");
		if($get_discount->num_rows()>0){
			$discount	=$get_discount->row()->discount;
		}
		$harga_jual		=$item->harga-($discount/100*$item->harga);
		$nilai_total	=$st*$harga_jual;
?>
<tr>
<td><?=$n?></td>
<td><?=$report->get_nm_brand($item->idx_brand)?></td>
<td><?=$item->nm_product?></td>
<td><?=$cat?></td>
<td><?=$item->harga?></td>
<td><?=$discount?></td>
<td><?=$harga_jual?></td>
<td><?=$attr_label?></td>
<td><?=$nilai_total?></td>
</tr>
<? $n++;
 } ?>
</table>
