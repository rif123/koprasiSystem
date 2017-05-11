@extends('layouts.index_no_require')
@section('header')
<link href="{{ URL::asset('') }}plugins/bootsrap-datepicker/bootstrap-datepicker.css" rel="stylesheet" />
@stop
@section('content')
@include('layouts.left')
@include('layouts.right')
<section class="content">

    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="header">
                        <h2>Controll Pay</h2>
                    </div>
                    <div class="body">
                        <a class="exportExcel" href="#" >
                            <button type="button" class="btn bg-teal waves-effect">
                                <i class="material-icons">print</i>Excel
                            </button>
                        </a>
                            <table class="table listTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Nama Anggota</th>
                                        <th>Nama Pembayaran</th>
                                        <th>Bulan</th>
                                        <th>Jumlah Bayar</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@section('js')
<script src="{{ URL::asset('') }}plugins/sweetalert/sweetalert.min.js"></script>
<script>
var exportExcel = "{{url(route('config.exportExcel'))}}";
var urlAjaxTable = "{{ URL::to(route('config.payAjax')) }}";
var  urlEdit = "{{url('/admin/config/controll-Pay-detail/')}}";
var  urlDelete = "{{url('/admin/simpan-wajib-delete')}}";
$('.exportExcel').click(function(){
    var filter = $('div.dataTables_filter input').val();
    window.location  = exportExcel+"?search="+filter;
});


var listTable = $('.listTable').DataTable({
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
            { "data": "nm_anggota" },
            { "data": "pay" },
            { "data": "payMonth" },
            { "data": "jml_bayar_wajib" },
            { "data": "status" },
            { "render": function (data, type, row, meta) {
                if (row.pay =='Simpanan wajib') {
                    var pay = 1;
                }else{
                    var pay = 2;
                }
                        var edit = $('<a><button>')
                                    .attr('class', "btn bg-blue-grey waves-effect edit-menu")
                                    .attr('href',urlEdit+'/'+row.id_pay+"?pay="+pay)
                                    .text('Edit')
                                    .wrap('<div></div>')
                                    .parent()
                                    .html();
                        /*var del = $('<a><button>')
                                    .attr('class', "btn btn-danger waves-effect delete-menu")
                                    .attr('onclick', "deletProcess('"+row.id_pay+"')")
                                    .text('Delete')
                                    .wrap('<div></div>')
                                    .parent()
                                    .html();*/
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
function deletProcess(id_pay){
    swal({
        title: "Apakah anda yakin ?",
        text: "Anda akan menghapus data.",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete ",
        closeOnConfirm: true,
    }, function () {
         window.location.href = urlDelete+'/'+id_pay+"?pay="+pay;
     });
    }
</script>
@endsection
@stop
@stop
