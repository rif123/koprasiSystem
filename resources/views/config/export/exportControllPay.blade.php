<?php
$nameRandonm = "report-payment-".strtotime(date('Ymdhis'));
header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
header("Content-Type: application/download");
header("Content-Disposition: attachment;filename=".$nameRandonm.".xls");
header("Content-Transfer-Encoding: binary ");
 ?>
<center><th><h2> Report Payment</h2></th></center>
<table class="table" width="200px" cellspacing="0" border="1">
    <thead>
        <tr>
            <th width="20px">No</th>
            <th>Nama Anggota</th>
            <th>Nama Pembayaran</th>
            <th>Tanggal</th>
            <th>Jumlah Bayar</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody class="table-striped">
        <?php
        $income =0;
        $outcome =0;
        $total =0;
        $no =1;
        ?>
        @foreach($data as $key =>$value)
            <tr>
                <td>{{$no}}</td>
                <td>{{$value->nm_anggota}} </td>
                <td>{{!empty ($value->pay) ? $value->pay : "" }} </td>
                <td>{{!empty ($value->tgl_bayar_wajib) ? date("d M Y", strtotime($value->tgl_bayar_wajib)) : "-" }} </td>
                <td>{{!empty ($value->jml_bayar_wajib) ? Helpers::getRp($value->jml_bayar_wajib) : "Rp.0" }} </td>
                @if ($value->status == 1)
                    <td>Pending</td>
                @elseif ($value->status == 2)
                    <td>Reject</td>
                @else
                    <td>Lunas</td>
                @endif
            </tr>
            <?php
            $no++;
            $total += !empty ($value->jml_bayar_wajib) ? $value->jml_bayar_wajib : 0 ;
            ?>
        @endforeach
            <tr>
                <th colspan="5">TOTAL</th>
                <th >{{Helpers::getRp($total)}}</th>
            </tr>
    </tbody>
</table>
