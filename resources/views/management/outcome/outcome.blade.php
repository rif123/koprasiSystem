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
                    @if(!empty($id_outcome))
                    <form id="form-menu" action="{{url(route('management.outcomeupdate'))}}" method="post" enctype="multipart/form-data">
                        @else
                    <form id="form-menu" action="{{url(route('management.outcomesave'))}}" method="post" enctype="multipart/form-data">
                        @endif
                        {!! Form::token() !!}
                        <div class="row clearfix">
                            <h2 class="card-inside-title group-title">Jumlah</h2>
                            <div class="col-md-12">
                                <div class="input-group">
                                    <div class="form-line">
                                        <input type="text" name="jml_outcome" class="form-control date" id ="jml_bayar_spokok" placeholder="Jumlah Outcome " value="{{!empty($jml_outcome) ? $jml_outcome : '' }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <h2 class="card-inside-title group-title">Tanggal</h2>
                            <div class="col-md-12">
                                <div class="input-group">
                                    <div class="form-line">
                                        <input type="text" value="{{ !empty($tgl_outcome) ? date('d-m-Y H:i:s' ,strtotime($tgl_outcome)) : ''}}" name="tgl_outcome" class="form-control date " id="tgl_outcome" placeholder="tanggal bayar Outcome" onClick="getAllMenu()">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <h2 class="card-inside-title group-title">Keterangan</h2>
                            <div class="col-md-12">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" value="{{ !empty($ket_outcome) ?$ket_outcome : ''}}" name="ket_outcome" cols="30" rows="5" class="form-control no-resize" required />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <h2 class="card-inside-title group-title">PIC</h2>
                            <div class="col-md-12">
                                <div class="input-group">
                                    <div class="form-line">
                                        <input type="text" name="pic_outcome" class="form-control date" id ="jml_bayar_spokok" placeholder="PIC Outcome" value="{{!empty($pic_outcome) ? $pic_outcome : '' }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if (!empty ($id_outcome))
                        <div class="row clearfix">
                            <div class="col-md-12">
                                <div class="input-group">
                                    <input type="hidden" name="id_outcome" value="{{$id_outcome}}">
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
                                <th>Tanggal</th>
                                <th>Keterangan</th>
                                <th>PIC</th>
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
var urlAjaxTable = "{{ url(route('management.outcomeajax')) }}";
var urlEdit = "{{url('/admin/management/outcome-edit')}}";
    $('#tgl_outcome').datepicker({
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
            { "data": "jml_outcome" },
            { "data": "tgl_outcome" },
            { "data": "ket_outcome" },
            { "data": "pic_outcome" },
            { "render": function (data, type, row, meta) {
                var edit = $('<a><button>')
                            .attr('class', "btn bg-blue-grey waves-effect edit-menu")
                            .attr('href',urlEdit+'/'+row.id_outcome)
                            .text('Edit')
                            .wrap('<div></div>')
                            .parent()
                            .html();
                return edit;
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
