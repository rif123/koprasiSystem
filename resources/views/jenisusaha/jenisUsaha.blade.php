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
                FORM JENIS USAHA
                <small>(isi dengan lengkap & jelas)</small>
            </h2>
        </div>
        <div class="row clearfix">
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                <div class="body">
                    @if(!empty($kd_jenis_usaha))
                    <form id="form-menu" action="{{url(route('jenis.usahaUpdate'))}}" method="post" enctype="multipart/form-data">
                        @else
                    <form id="form-menu" action="{{url(route('jenis.usahaSave'))}}" method="post" enctype="multipart/form-data">
                        @endif
                        {!! Form::token() !!}
                        <div class="row clearfix">
                            <h2 class="card-inside-title group-title">NAMA JENIS USAHA</h2>
                            <div class="col-md-12">
                                <div class="input-group">
                                    <div class="form-line">
                                        <input type="text" name="nama_jenis_usaha" class="form-control date" id ="nama_jenis_usaha" placeholder="nama jenis usaha " value="{{!empty($nama_jenis_usaha) ? $nama_jenis_usaha : '' }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if (!empty ($kd_jenis_usaha))
                        <div class="row clearfix">
                            <div class="col-md-12">
                                <div class="input-group">
                                    <input type="hidden" name="kd_jenis_usaha" value="{{$kd_jenis_usaha}}">
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
                                <th>Nama Jenis Usaha</th>
                                <th>action</th>
                            </tr>
                        </thead>
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
var urlAjaxTable = "{{ url(route('jenis.usahaajax')) }}";
var urlEdit = "{{url('/admin/jenis-Usaha-edit')}}";
var  urlDelete = "{{url('/admin/jenis-Usaha-delete')}}";
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
            { "data": "nama_jenis_usaha" },
            { "render": function (data, type, row, meta) {
                console.log(row)
                var edit = $('<a><button>')
                            .attr('class', "btn bg-blue-grey waves-effect edit-menu")
                            .attr('href',urlEdit+'/'+row.kd_jenis_usaha)
                            .text('Edit')
                            .wrap('<div></div>')
                            .parent()
                            .html();
                 var del = $('<a><button>')
                        .attr('class', "btn btn-danger waves-effect delete-menu")
                        .attr('href',urlDelete+'/'+row.kd_jenis_usaha)
                        .text('Delete')
                        .wrap('<div></div>')
                        .parent()
                        .html();
                 return edit+" | "+del;
                }
            },
        ],
        "aoColumnDefs": [
          { "bSortable": false, "aTargets": [ 1 ] }
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
