<?php
$nameRandonm = "report-income-".strtotime(date('Ymdhis'));
header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
header("Content-Type: application/download");
header("Content-Disposition: attachment;filename=".$nameRandonm.".xls");
header("Content-Transfer-Encoding: binary ");
 ?>


<center><th><h2> REPORT INCOME AND OUTCOME </h2></th></center>


                                   <table class="table" width="200px" cellspacing="0" border="1">
                                        <thead>
                                            <tr>
                                                <th width="20px">No</th>
                                                <th>Bulan</th>
                                                <th>Income</th>
                                                <th>Outcome</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-striped">
                                            <?php
                                            $income =0;
                                            $outcome =0;
                                            $total =0;

                                            ?>
                                            @foreach($data as $key =>$value)
                                                <tr>
                                                    <td>{{$key}}</td>
                                                    <td>{{Helpers::convertMonth($key)}} </td>
                                                    <td>{{!empty ($value[0]->jml_income) ? Helpers::getRp($value[0]->jml_income) : "Rp.0" }} </td>
                                                    <td>{{!empty ($value[0]->jml_outcome) ? Helpers::getRp($value[0]->jml_outcome) : "Rp.0" }} </td>
                                                    <td>{{!empty ($value[0]->total) ? Helpers::getRp($value[0]->total) : "Rp.0" }} </td>

                                                </tr>
                                                <?php
                                                $income += !empty ($value[0]->jml_income) ? $value[0]->jml_income : 0 ;
                                                $outcome += !empty ($value[0]->jml_outcome) ? $value[0]->jml_outcome : 0 ;
                                                $total += !empty ($value[0]->total) ? $value[0]->total : 0 ;

                                                ?>
                                            @endforeach

                                                <tr>
                                                    <th colspan="2">TOTAL</th>
                                                    <th >{{Helpers::getRp($income)}}</th>
                                                    <th >{{Helpers::getRp($outcome)}}</th>
                                                    <th >{{Helpers::getRp($total)}}</th>

                                                </tr>
                                        </tbody>
                                    </table>
