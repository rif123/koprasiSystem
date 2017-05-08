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
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
                <div class="body pull-right">
                    <button class="btn bg-blue waves-effect showFilter"><i class="material-icons">remove_red_eye</i>Filter</button>
                    <button class="btn bg-teal waves-effect exportToExcel"><i class="material-icons">print</i>Excel</button>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="body">
                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable listTable">
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
    <div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">Filter Data</h4>
                </div>
                <div class="modal-body" style="height:100% !important;overflow-y:initial">
                    <div class="row clearfix">
                        <div class="col-md-12">
                            <h5 class="card-inside-title group-title">Jenis Usaha</h5>
                            <div class="input-group">
                                <div class="form-line">
                                    <select name="jenisProd_usaha" class="form-control jenisProd_usaha">
                                        <option value=""> -- Jenis usaha -- </option>
                                        @foreach($jenisUsaha as $k => $v)
                                            <option value="{{ $v->nama_jenis_usaha }}">{{$v->nama_jenis_usaha}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-md-12">
                            <h5 class="card-inside-title group-title">Kab/Kot</h5>
                            <div class="input-group">
                                <div class="form-line">
                                    <input type="text" name="kabKot_usaha" class="form-control kabKot_usaha" placeholder="kab/kot" value="" style="z-index:0 !important">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-md-12">
                            <h5 class="card-inside-title group-title">Wilayah</h5>
                            <div class="input-group">
                                <div class="form-line">
                                    <input type="text" name="kabKot_usaha" class="form-control kabKot_usaha" placeholder="kab/kot" value="" style="z-index:0 !important">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-md-12">
                            <h5 class="card-inside-title group-title">Omset</h5>
                            <div class="input-group">
                                <div class="form-line">
                                    <input type="text" name="omset_usaha" class="form-control omset_usaha" placeholder="Omset usaha" value="" style="z-index:0 !important">
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
    var urlAjaxTable = "{{ URL::to(route('config.anggotaDetailAjax')) }}";
    var urlExportExcel = "{{ URL::to(route('config.anggotaDetailExcelList')) }}";
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
            { "data": "no" },
            { "render": function (data, type, row, meta) {
                if (row.kd_anggota != null) {
                    var detail = $('<a>')
                                            .attr('class', "")
                                            .attr('href',urlDetail+'/'+row.kd_anggota)
                                            .text(row.uname)
                                            .wrap('<div></div>')
                                            .parent()
                                            .html();
                                return detail;
                    } else {
                        return "-";
                    }
                }
            },

            { "render": function (data, type, row, meta) {
                if (row.no_anggota != null) {
                    var detail = $('<a>')
                                            .attr('class', "")
                                            .attr('href',urlDetail+'/'+row.kd_anggota)
                                            .text(row.no_anggota)
                                            .wrap('<div></div>')
                                            .parent()
                                            .html();
                                return detail;
                    } else {
                        return "-";
                    }
                }
            },
            { "data": "kabKot_usaha" },
            { "data": "jenisProd_usaha" },
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
       ],
       "aoColumnDefs": [
          { 'bSortable': false, 'aTargets': [ 0] }
       ]
    });
    $('.showFilter').click(function(){
        $('#defaultModal').modal('show');
    });
    $('.filterData').click(function(){
        $('#defaultModal').modal('hide');
        var kabKot_usaha  = $('.kabKot_usaha').val();
        var jenisProd_usaha  = $('.jenisProd_usaha :selected').val();
        var omset_usaha  = $('.omset_usaha').val();
        $('.listTable').DataTable({
            "processing": true,
            "bFilter": true,
            "bInfo": false,
            "bLengthChange": false,
            "serverSide": true,
            "ajax": {
                 "url": urlAjaxTable,
                 "type": "GET",
                 "data" : {kabKot_usaha : kabKot_usaha, jenisProd_usaha : jenisProd_usaha, omset_usaha : omset_usaha}
             },
             "columns": [
                { "data": "no" },
                { "render": function (data, type, row, meta) {
                    if (row.kd_anggota != null) {
                        var detail = $('<a>')
                                                .attr('class', "")
                                                .attr('href',urlDetail+'/'+row.kd_anggota)
                                                .text(row.uname)
                                                .wrap('<div></div>')
                                                .parent()
                                                .html();
                                    return detail;
                        } else {
                            return "-";
                        }
                    }
                },

                { "render": function (data, type, row, meta) {
                    if (row.no_anggota != null) {
                        var detail = $('<a>')
                                                .attr('class', "")
                                                .attr('href',urlDetail+'/'+row.kd_anggota)
                                                .text(row.no_anggota)
                                                .wrap('<div></div>')
                                                .parent()
                                                .html();
                                    return detail;
                        } else {
                            return "-";
                        }
                    }
                },
                { "data": "kabKot_usaha" },
                { "data": "jenisProd_usaha" },
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
           ],
            "aoColumnDefs": [
              { 'bSortable': false, 'aTargets': [ 0] }
            ],
            "destroy" : true
      });
    });
    $('.exportToExcel').click(function(){
        var kabKot_usaha  = $('.kabKot_usaha').val();
        var jenisProd_usaha  = $('.jenisProd_usaha').val();
        var omset_usaha  = $('.omset_usaha').val();
        window.location = urlExportExcel+"?kabKot_usaha="+kabKot_usaha+"&jenisProd_usaha="+jenisProd_usaha+"&omset_usaha="+omset_usaha;
    });
</script>
@endsection
@stop
@stop
