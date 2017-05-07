<?php
$nameRandonm = "list-anggota-".strtotime(date('Ymdhis'));
header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
header("Content-Type: application/download");
header("Content-Disposition: attachment;filename=".$nameRandonm.".xls");
header("Content-Transfer-Encoding: binary ");
 ?>
@extends('layouts.index_no_require')
    @section('header')
        <link href="{{ URL::asset('') }}plugins/bootsrap-datepicker/bootstrap-datepicker.css" rel="stylesheet" />
    @stop
    @section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="card">
            <div class="header">
                <center>
                    <h2>List Anggota</h2>
                </center>
            </div>
            <div class="row clearfix">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="body table-responsive" >
                            <table border="1px" class="table table-bordered table-striped table-hover js-basic-example dataTable listTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Nomor Anggota</th>
                                    <th>Kab/kot</th>
                                    <th>Jenis Usaha</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no =1; ?>
                                @foreach($list as $key => $value)
                                    <tr>
                                        <td>{{$no}}</td>
                                        <td>{{$value->uname}}</td>
                                        <td>{{$value->no_anggota}}</td>
                                        <td>{{$value->kabKot_usaha}}</td>
                                        <td>{{$value->jenisProd_usaha}}</td>
                                    </tr>
                                <?php $no++; ?>
                                @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <style>
            h2.group-title{
                margin-left:15px
            }
            section.content{
                margin : 0px 0 0 0px;
            }
        </style>
    </section>

@stop
@stop
