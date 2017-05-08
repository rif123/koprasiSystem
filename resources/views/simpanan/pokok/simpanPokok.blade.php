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
                FORM SIMPANAN POKOK
                <small>(isi dengan lengkap & jelas)</small>
            </h2>
        </div>
        <div class="row clearfix">
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                <div class="body">
                    @if(!empty($kd_spokok))
                    <form id="form-menu" action="{{url(route('simpanan.updatePokok'))}}" method="post" enctype="multipart/form-data">
                     @else
                    <form id="form-menu" action="{{url(route('simpanan.savePokok'))}}" method="post" enctype="multipart/form-data">
                     @endif
                        {!! Form::token() !!}
                        <div class="row clearfix">
                            <h2 class="card-inside-title group-title">Jumlah Bayar</h2>
                            <div class="col-md-12">
                                <div class="input-group">
                                    <div class="form-line">
                                        <input type="text" name="jml_bayar_spokok" class="form-control date" id ="jml_bayar_spokok" placeholder="Jumlah Bayar Pokok" value="{{!empty($jml_bayar_spokok) ? $jml_bayar_spokok : '' }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <h2 class="card-inside-title group-title">Tanggal Bayar</h2>
                            <div class="col-md-12">
                                <div class="input-group">
                                    <div class="form-line">
                                        <input type="text" value="{{ !empty($tgl_bayar_spokok) ? date('d-m-Y' ,strtotime($tgl_bayar_spokok)) : ''}}" name="tgl_bayar_spokok" class="form-control date " id="tgl_bayar_spokok" placeholder="tanggal bayar Pokok" onClick="getAllMenu()">

                                    </div>
                                </div>
                            </div>
                        </div >
                        <div class="row clearfix">
                            <h2 class="card-inside-title group-title">Bukti Bayar</h2>
                            <div class="col-md-12">
                                <div class="input-group">
                                    <div class="form-line">
                                        <input type="file" name="bkt_bayar_spokok" class="form-control date" id = "bkt_bayar_spokok" placeholder="bukti bayar spokok">
                                        @if (!empty ($bukti_bayar_spokok))
                                        <img src="{{url('/uploads/bkt_bayar_spokok').'/'.$bukti_bayar_spokok}}" width="30px">
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if (!empty ($kd_spokok))
                        <div class="row clearfix">
                            <div class="col-md-12">
                                <div class="input-group">
                                    <input type="hidden" name="kd_spokok" value="{{$kd_spokok}}">
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
            </div> <!-- enf form -->
            <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 ">
              <div class="body pull-right">
                  <button class="btn bg-blue-grey waves-effect showFilter">Filter</button>
              </div>
          </div>
            <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                <div class="body">
                <table class="table table-bordered table-striped table-hover js-basic-example dataTable listTable">
                    <thead>
                        <tr>
                            <th>Jumlah</th>
                            <th>Tanggal</th>
                            <th>Bukti</th>
                            <th>Status</th>
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
                       @if(\Session::get('user_grp') == 1)
                   <div class="row clearfix">
                       <div class="col-md-12">
                           <h5 class="card-inside-title group-title">Wilayah</h5>
                           <div class="input-group">
                               <div class="form-line">
                                   <input type="text" name="wilayah" class="form-control wilayah" placeholder="Wilayah" value="" style="z-index:0 !important">
                               </div>
                           </div>
                       </div>
                   </div>
                   @endif
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
    var urlAjaxTable = "{{ URL::to(route('simpananPokok.indexAjax')) }}";
    var  urlEdit = "{{url('/admin/simpan-pokok-edit')}}";
    var  urlDelete = "{{url('/admin/simpan-pokok-delete')}}";
    var  urlImage = "{{url('/uploads/bkt_bayar_spokok/')}}";
$('#tgl_bayar_spokok').datepicker({
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
            { "data": "jml_bayar_spokok" },
            { "data": "tgl_bayar_spokok" },
            {
                "data": "bukti_bayar_spokok",
                "render": function(data, type, row) {
                    return '<img src="'+urlImage+"/"+data+'" width="30px"/>';
                }
            },
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
