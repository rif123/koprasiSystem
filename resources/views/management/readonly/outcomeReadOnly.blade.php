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
            </h2>
        </div>
        <div class="row clearfix">
            <!-- enf form -->
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="body">
                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable listTable">
                        <thead>
                            <tr>
                                <th>Jumlah</th>
                                <th>PIC</th>
                                <th>Tanggal</th>
                                <th>Keterangan</th>
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
            { "data": "pic_outcome" },
            { "data": "tgl_outcome" },
            { "data": "ket_outcome" },
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
