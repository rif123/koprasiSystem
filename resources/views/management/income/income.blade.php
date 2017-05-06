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
                FORM MENU
                <small>(isi dengan lengkap & jelas)</small>
            </h2>
        </div>
        <div class="row clearfix">
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                <div class="body">
                    @if(!empty($id_income))
                    <form id="form-menu" action="{{url(route('management.incomeupdate'))}}" method="post" enctype="multipart/form-data">
                        @else
                    <form id="form-menu" action="{{url(route('management.incomesave'))}}" method="post" enctype="multipart/form-data">
                        @endif
                        {!! Form::token() !!}
                        <div class="row clearfix">
                            <h2 class="card-inside-title group-title">Jumlah</h2>
                            <div class="col-md-12">
                                <div class="input-group">
                                    <div class="form-line">
                                        <input type="text" name="jml_income" class="form-control date" id ="jml_bayar_spokok" placeholder="Jumlah Income " value="{{!empty($jml_income) ? $jml_income : '' }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <h2 class="card-inside-title group-title">Tanggal</h2>
                            <div class="col-md-12">
                                <div class="input-group">
                                    <div class="form-line">
                                        <input type="text" value="{{ !empty($tgl_income) ? date('d-m-Y H:i:s' ,strtotime($tgl_income)) : ''}}" name="tgl_income" class="form-control date " id="tgl_income" placeholder="tanggal bayar Income" onClick="getAllMenu()">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <h2 class="card-inside-title group-title">Keterangan</h2>
                            <div class="col-md-12">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" name="ket_income" value="{{ !empty($ket_income) ?$ket_income : ''}}" cols="30" rows="5" class="form-control no-resize" required />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <h2 class="card-inside-title group-title">PIC</h2>
                            <div class="col-md-12">
                                <div class="input-group">
                                    <div class="form-line">
                                        <input type="text" name="pic_income" class="form-control date" id ="jml_bayar_spokok" placeholder="PIC Income" value="{{!empty($pic_income) ? $pic_income : '' }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if (!empty ($id_income))
                        <div class="row clearfix">
                            <div class="col-md-12">
                                <div class="input-group">
                                    <input type="hidden" name="id_income" value="{{$id_income}}">
                                    <button type="submit" class="btn btn-primary waves-effect btn-save">EDIT</button>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="row clearfix">
                            <div class="col-md-12">
                                <div class="input-group">
                                    <button type="submit" class="btn btn-primary waves-effect btn-save">SAVE</button>
                                </div>
                            </div>
                        </div>
                        @endif
                    </form>
                </div>
            </div>
            <!-- enf form -->
            <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                <div class="body">
                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable listTable">
                        <thead>
                            <tr>
                                <th>Jumlah</th>
                                <th>PIC</th>
                                <th>Tanggal</th>
                                <th>Keterangan</th>
                                <th>action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
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
@section('js')
<script src="{{ URL::asset('') }}plugins/bootsrap-datepicker/bootstrap-datepicker.min.js"></script>
<script>
var urlAjaxTable = "{{ url(route('management.incomeajax')) }}";
var urlEdit = "{{url('/admin/management/income-edit')}}";
    $('#tgl_income').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true,
            startDate: '-3d'
        });
        // jquery datatables
        var listTable = $('.listTable').DataTable( {
                "processing": true,
                "bFilter": true,
                "bInfo": false,
                "bLengthChange": false,
                "serverSide": true,
                "ajax": {
                     "url": urlAjaxTable,
                     "type": "GET"
                 },
                 "columns": [
                    { "data": "jml_income" },
                    { "data": "pic_income" },
                    { "data": "tgl_income" },
                    { "data": "ket_income" },
                    { "render": function (data, type, row, meta) {
                            // if (row.isButton == 1) {
                                var edit = $('<a><button>')
                                            .attr('class', "btn bg-blue-grey waves-effect edit-menu")
                                            .attr('href',urlEdit+'/'+row.id_income)
                                            .text('Edit')
                                            .wrap('<div></div>')
                                            .parent()
                                            .html();
                                // var del = $('<a><button>')
                                //             .attr('class', "btn btn-danger waves-effect delete-menu")
                                //             .attr('href',urlDelete+'/'+row.id_outcome)
                                //             .text('Delete')
                                //             .wrap('<div></div>')
                                //             .parent()
                                //             .html();
                                return edit;
                            // } else {
                            //     return "-";
                            // }
                        }
                    },
                ],
                "buttons": [
                   {
                       extend: 'collection',
                       text: 'Export',
                       buttons: [
                           'copy',
                           'excel',
                           'csv',
                           'pdf',
                           'print'
                       ]
                   }
               ]
            });

            $('.showFilter').click(function(){
                $('#defaultModal').modal('show');
            });
            $('.filterData').click(function(){
                $('#defaultModal').modal('hide');
                var bln  = $('#blnFilter :selected').val();
                var wilayah  = $('.wilayah').val();
                $('.listTable').DataTable( {
                    "processing": true,
                    "bFilter": false,
                    "bInfo": false,
                    "bLengthChange": false,
                    "serverSide": true,
                    "ajax": {
                         "url": urlAjaxTable,
                         "type": "GET",
                         "data" : {bln : bln, wilayah : wilayah}
                     },
                     "columns": [
                        { "data": "jml_bayar_spokok" },
                        {
                            "data": "bukti_bayar_spokok",
                            "render": function(data, type, row) {
                                return '<img src="'+urlImage+"/"+data+'" width="30px"/>';
                            }
                        },
                        { "data": "tgl_bayar_spokok" },
                        { "data": "status" },
                        { "render": function (data, type, row, meta) {
                                if (row.isButton == 1) {
                                    var edit = $('<a><button>')
                                                .attr('class', "btn bg-blue-grey waves-effect edit-menu")
                                                .attr('href',urlEdit+'/'+row.kd_spokok)
                                                .text('Edit')
                                                .wrap('<div></div>')
                                                .parent()
                                                .html();
                                    var del = $('<a><button>')
                                                .attr('class', "btn btn-danger waves-effect delete-menu")
                                                .attr('href',urlDelete+'/'+row.kd_spokok)
                                                .text('Delete')
                                                .wrap('<div></div>')
                                                .parent()
                                                .html();
                                    return edit+" | "+del;
                                } else {
                                    return "-";
                                }
                            }
                        },
                    ],
                  "destroy" : true
              });
            });
</script>
@endsection
@stop
@stop
