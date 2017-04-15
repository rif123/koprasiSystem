@extends('layouts.index_no_require')
@section('header')
    <link href="{{ URL::asset('') }}plugins/bootsrap-datepicker/bootstrap-datepicker.css" rel="stylesheet" />
@stop
@section('content')
@include('layouts.left')
@include('layouts.right')
<section class="content">
    <div class="container-fluid">
        <div class="card">
        <div class="header">
            <h2>
                Simpanan Anggota
                <small>(isi dengan lengkap & jelas)</small>
            </h2>
        </div>
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="body">
                    <table class="table table-bordered table-striped table-hover js-basic-example" id="listSimpananNew">
                        <thead>
                            <tr>
                                <th>Jenis Simpanan</th>
                                @foreach($monthLates as $val)
                                      <th>{{$val}}</th>
                                @endforeach
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="body">
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <button type="button" class="btn bg-light-blue waves-effect btn-block btn-simpan-wajib">Bayar Simpan Wajib</button>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <button type="button" class="btn bg-indigo waves-effect btn-block btn-simpan-pokok" >Bayar Simpan Pokok</button>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="body">
                    <form id="form-menu-wajib" action="{{url(route('config.wajibSave'))}}" method="post" enctype="multipart/form-data">
                        {!! Form::token() !!}
                        <div class="row clearfix">
                            <h2 class="card-inside-title group-title">Jumlah Bayar</h2>
                            <div class="col-md-12">
                                <div class="input-group">
                                    <div class="form-line">
                                        <input type="text" name="jml_bayar_wajib" class="form-control" placeholder="Jumlah Bayar">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <h2 class="card-inside-title group-title">Tanggal Bayar</h2>
                            <div class="col-md-12">
                                <div class="input-group">
                                    <div class="form-line">
                                        <input type="text" name="tgl_bayar_wajib" class="form-control date" placeholder="Tanggal bayar" id="datepicker">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <h2 class="card-inside-title group-title">Bukti Pembayaran</h2>
                            <div class="col-md-12">
                                <div class="input-group">
                                    <div class="form-line">
                                        <input type="file" name="bkt_bayar_wajib" class="form-control" placeholder="Bukti Pembayaran">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-md-12">
                                <button type="submit" class="btn bg-primary waves-effect btn-simpan-wajib" >Bayar Simpan Wajib</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <style>
        h2.group-title{
            margin-left:15px
        }
    </style>
</section>
@stop
@stop
@section('js')
<script src="{{ URL::asset('') }}js/save/save.js"></script>
<script src="{{ URL::asset('') }}plugins/bootsrap-datepicker/bootstrap-datepicker.min.js"></script>
<script>
    var urlListWajib = "{{url(route('config.wajibList'))}}";
    var urlListPokok = "{{url(route('config.pokokList'))}}";
    var urlGetListSimpanan = "{{url(route('config.listSave'))}}";
    $('#datepicker').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true,
        startDate: '-3d'
    });
</script>
@stop
