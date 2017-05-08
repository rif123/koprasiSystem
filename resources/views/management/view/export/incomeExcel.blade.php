<?php
    $nameRandonm = "report-income-view-".strtotime(date('Ymdhis'));
    header("Pragma: public");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
    header("Content-Type: application/force-download");
    header("Content-Type: application/octet-stream");
    header("Content-Type: application/download");
    header("Content-Disposition: attachment;filename=".$nameRandonm.".xls");
    header("Content-Transfer-Encoding: binary ");
 ?>


<center><th><h2> REPORT INCOME</h2></th></center>


                                   <table class="table" width="200px" cellspacing="0" border="1">
                                        <thead>
                                            <tr>
                                                <th width="20px">No</th>
                                                <th>Bulan</th>
                                                <th>Income</th>
                                                <th>Outcome</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-striped">
                                            <?php
                                            $income =0;
                                            $total =0;
                                            ?>
                                            @foreach($data as $key =>$value)
                                                <tr>
                                                    <td>{{Helpers::getRp($value->jml_income)}}</td>
                                                    <td>{{date('d M Y', strtotime($value->tgl_income) )}}</td>
                                                    <td>{{$value->ket_income}}</td>
                                                    <td>{{$value->pic_income}}</td>
                                                </tr>
                                                <?php
                                                $income += !empty ($value->jml_income) ? $value->jml_income : 0 ;
                                                ?>
                                            @endforeach
                                                <tr>
                                                    <th colspan="3">TOTAL</th>
                                                    <th >{{Helpers::getRp($income)}}</th>
                                                </tr>
                                        </tbody>
                                    </table>
