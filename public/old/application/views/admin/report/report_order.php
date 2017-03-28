<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=".$nm_file.".xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<table border='1' widtd="70%">
<tr>
<td style='background: #7A7878;color: #fff;'>No</td>
<td style='background: #7A7878;color: #fff;'>No Transaksi</td>
<td style='background: #7A7878;color: #fff;'>Tanggal</td>
<td style='background: #7A7878;color: #fff;'>Nama Barang</td>
<td style='background: #7A7878;color: #fff;'>Kategori</td>
<td style='background: #7A7878;color: #fff;'>Harga Satuan</td>
<td style='background: #7A7878;color: #fff;'>Diskon</td>
<td style='background: #7A7878;color: #fff;'>Harga Jual</td>
<td style='background: #7A7878;color: #fff;'>Jumlah</td>
<td style='background: #7A7878;color: #fff;'>Total</td>
</tr>
<?
$n=1;
foreach($SQl->result() as $item){
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
$harga_jual		=$item->harga-($item->discount/100*$item->harga);
$total_harga	=$harga_jual*$item->qty;
	echo'
	<tr>
	<td>'.$n.'</td>
	<td>'.$item->id_pesanan.'</td>
	<td>'.$report->DateToIndo($item->tgl_order).'</td>
	<td>'.$item->nm_product.'</td>
	<td>'.$cat.'</td>
	<td>'.$item->harga.'</td>
	<td>'.$item->discount.'</td>
	<td>'.$harga_jual.'</td>
	<td>'.$item->qty.'</td>
	<td>'.$total_harga.'</td>
	</tr>';
 $n++;
 } 
 ?>
</table>
