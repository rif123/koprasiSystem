<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Laporan-Data-Pelanggan.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<table border='1' width="70%">
<tr>
<td style='background: #7A7878;color: #fff;'>No</td>
<td style='background: #7A7878;color: #fff;'>Nama Pelanggan</td>
<td style='background: #7A7878;color: #fff;'>Email</td>
<td style='background: #7A7878;color: #fff;'>Alamat</td>
<td style='background: #7A7878;color: #fff;'>Kecamatan</td>
<td style='background: #7A7878;color: #fff;'>Kota</td>
<td style='background: #7A7878;color: #fff;'>No Telepon</td>
<td style='background: #7A7878;color: #fff;'>Handphone</td>
<td style='background: #7A7878;color: #fff;'>Total Transaksi</td>
</tr>
<?
$n=1;
foreach($SQl->result() as $item) {
?>
<tr>
<td><?=$n?></td>
<td><?=$item->full_name?></td>
<td><?=$item->email?></td>
<td><?=$item->alamat?></td>
<td><?=$item->kec?></td>
<td><?=$item->kota?></td>
<td><?=$item->no_telepon?></td>
<td><?=$item->hp?></td>
<td><?=$report->count_transaksi($item->idx_pelanggan)?></td>
</tr>
<? $n++;
 } ?>
</table>
