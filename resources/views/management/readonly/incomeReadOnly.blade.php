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
                Income Koprasi
            </h2>
        </div>
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="body">
                    <!-- enf form -->
                        <div class="body">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable listTable">
                                <thead>
                                    <tr>
                                        <th>Jumlah</th>
                                        <th>Tanggal</th>
                                        <th>Keterangan</th>
                                        <th>PIC</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
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
                    { "data": "tgl_income" },
                    { "data": "ket_income" },
                    { "data": "pic_income" },
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
