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
                    Daftar anggota
                </h2>
            </div>
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="body">
                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable listTable">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Group</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
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
    var urlAjaxTable = "{{ URL::to(route('config.anggotaDetailAjax')) }}";
    var  urlDetail = "{{url('admin/config/anggota-detail')}}";
    var  urlImage = "{{url('/uploads/bkt_bayar_spokok/')}}";
$('#tgl_bayar_spokok').datepicker({
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
            { "data": "uname" },
            { "data": "group_name" },
            {
                "data": "pasPhoto_anggota",
                "render": function(data, type, row) {
                    return '<img src="'+urlImage+"/"+row.pasPhoto_anggota+'" width="30px"/>';
                }
            },
            { "render": function (data, type, row, meta) {
                    if (row.kd_anggota != null) {
                        var detail = $('<a><button>')
                                    .attr('class', "btn bg-blue-grey waves-effect edit-menu")
                                    .attr('href',urlDetail+'/'+row.kd_anggota)
                                    .text('Detail')
                                    .wrap('<div></div>')
                                    .parent()
                                    .html();
                        return detail;
                    } else {
                        return "-";
                    }
                }
            }
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
</script>
@endsection
@stop
@stop
