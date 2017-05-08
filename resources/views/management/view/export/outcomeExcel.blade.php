<?php
   $nameRandonm = "report-outcome-view-".strtotime(date('Ymdhis'));
    header("Pragma: public");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
    header("Content-Type: application/force-download");
    header("Content-Type: application/octet-stream");
    header("Content-Type: application/download");
    header("Content-Disposition: attachment;filename=".$nameRandonm.".xls");
    header("Content-Transfer-Encoding: binary ");
 ?>


<center><th><h2> REPORT OUTCOME</h2></th></center>


                                   <table class="table" width="200px" cellspacing="0" border="1">
                                        <thead>
                                            <tr>
                                                <th width="20px">No</th>
                                                <th>Bulan</th>
                                                <th>Keterangan</th>
                                                <th>PIC</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-striped">
                                            <?php
                                            $outcome =0;
                                            $total =0;
                                            ?>
                                            @foreach($data as $key =>$value)
                                                <tr>
                                                    <td>{{Helpers::getRp($value->jml_outcome)}}</td>
                                                    <td>{{date('d M Y', strtotime($value->tgl_outcome) )}}</td>
                                                    <td>{{$value->ket_outcome}}</td>
                                                    <td>{{$value->pic_outcome}}</td>
                                                </tr>
                                                <?php
                                                $outcome += !empty ($value->jml_outcome) ? $value->jml_outcome : 0 ;
                                                ?>
                                            @endforeach
                                                <tr>
                                                    <th colspan="3">TOTAL</th>
                                                    <th >{{Helpers::getRp($outcome)}}</th>
                                                </tr>
                                        </tbody>
                                    </table>
<!--  -->