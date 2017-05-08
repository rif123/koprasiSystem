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
            <h2> FORM MENU </h2>
        </div>
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
              <div class="body pull-right">
                  <button class="btn bg-blue waves-effect showFilter">Filter</button>
                  <button class="btn bg-blue-grey waves-effect exportExcel">Excel</button>
              </div>
          </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
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
    <style>
        h2.group-title{
        margin-left:15px
        }
    </style>
    <div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
       <div class="modal-dialog" role="document">
           <div class="modal-content">
               <div class="modal-header">
                   <h4 class="modal-title" id="defaultModalLabel">Filter Data</h4>
               </div>
               <div class="modal-body" style="height:100% !important;overflow-y:initial">
                   <div class="row clearfix">
                       <div class="col-md-12">
                           <h5 class="card-inside-title group-title">Bulan</h5>
                           <div class="input-group">
                               <div class="form-line">
                                   <select class="form-control" id="blnFilter">
                                       <option value=""> ---- Pilih Bulan --- </option>
                                       @foreach(Helpers::getMonth() as $key => $val)
                                           <option value="{{$key}}">{{$val}}</option>
                                       @endforeach
                                   </select>
                               </div>
                           </div>
                       </div>
                   </div>
                   <div class="row clearfix">
                       <div class="col-md-12">
                           <h5 class="card-inside-title group-title">PIC</h5>
                           <div class="input-group">
                               <div class="form-line">
                                   <input type="text" name="pic" class="form-control PIC" placeholder="PIC" value="" style="z-index:0 !important">
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
               <div class="modal-footer">
                   <button type="button" class="btn bg-blue-grey waves-effect filterData">Cari</button>
               </div>
           </div>
       </div>
   </div>
</section>
@section('js')
<script src="{{ URL::asset('') }}plugins/bootsrap-datepicker/bootstrap-datepicker.min.js"></script>
<script>
var urlAjaxTable = "{{ url(route('management.viewIncomeAjax')) }}";
var urlAjaxExcel = "{{ url(route('management.viewIncomeExcel')) }}";
var urlEdit = "{{url('/admin/management/income-edit')}}";
    $('#tgl_income').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true,
            startDate: '-3d'
        });
        // jquery datatables
        var listTable = $('.listTable').DataTable( {
                "processing": true,
                "bFilter": false,
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

            $('.showFilter').click(function(){
                $('#defaultModal').modal('show');
            });
            $('.filterData').click(function(){
                $('#defaultModal').modal('hide');
                var bln  = $('#blnFilter :selected').val();
                var PIC  = $('.PIC').val();
                $('.listTable').DataTable( {
                    "processing": true,
                    "bFilter": false,
                    "bInfo": false,
                    "bLengthChange": false,
                    "serverSide": true,
                    "ajax": {
                         "url": urlAjaxTable,
                         "type": "GET",
                         "data" : {bln : bln, PIC : PIC}
                     },
                     "columns": [
                        { "data": "jml_income" },
                        { "data": "tgl_income" },
                        { "data": "ket_income" },
                        { "data": "pic_income" },
                    ],
                  "destroy" : true
              });
            });
    $('.exportExcel').click(function() {
        var bln  = $('#blnFilter :selected').val();
        var PIC  = $('.PIC').val();
        window.location = urlAjaxExcel+"?bln="+bln+"&pic="+PIC;
    });
</script>
@endsection
@stop
@stop
