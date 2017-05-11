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
                FORM NEWS
                <small>(isi dengan lengkap & jelas)</small>
            </h2>
        </div>
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="body">
                    @if(!empty($id_news))
                    <form id="form-menu" action="{{url(route('config.newsUpdate'))}}" method="post" enctype="multipart/form-data">
                     @else
                    <form id="form-menu" action="{{url(route('config.newsSave'))}}" method="post" enctype="multipart/form-data">
                     @endif
                        {!! Form::token() !!}
                        <div class="row clearfix">
                            <h2 class="card-inside-title group-title">Judul</h2>
                            <div class="col-md-12">
                                <div class="input-group">
                                    <div class="form-line">
                                        <input type="text" name="judul_news" class="form-control date" id ="judul_news" placeholder="Judul" value="{{!empty($judul_news) ? $judul_news : '' }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                          <h2 class="card-inside-title group-title">Description</h2>
                            <div class="col-md-12">
                                <div class="input-group">
                                    <div class="form-line">
                                        <!--
                                        <input type="text" name="description_news" class="form-control date" id ="description_news" placeholder="Description News" value="{{!empty($description_news) ? $description_news : '' }}">
                                    -->
                                    <textarea id="tinymce" name="description_news">
                                        {{!empty($description_news) ? $description_news : '' }}
                                    </textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <h2 class="card-inside-title group-title">Tanggal</h2>
                            <div class="col-md-12">
                                <div class="input-group">
                                    <div class="form-line">
                                        <input type="text" value="{{ !empty($tanggal_news) ? date('d-m-Y', strtotime($tanggal_news)) : ''}}" name="tanggal_news" class="form-control date " id="tanggal_news" placeholder="tanggal" onClick="getAllMenu()">

                                    </div>
                                </div>
                            </div>
                        </div >

                      <div class="row clearfix">
                          <div class="col-md-12">
                              <h2 class="card-inside-title">Status</h2>
                              <div class="input-group">
                                  <div class="form-line">
                                      <select name="status" class="form-control">
                                          @foreach($status as $k => $v)
                                            <?php $selected = ""; ?>
                                            @if(!empty($sts))
                                            <?php print_R($sts) ?>
                                                @if ($v == $sts)
                                                    <?php $selected = "selected='selected'"; ?>
                                                @endif
                                            @endif
                                              <option  {{$selected}}  value="{{ $v }}">{{$v}}</option>
                                          @endforeach
                                      </select>
                                  </div>
                              </div>
                          </div>
                        </div>


                        @if (!empty ($id_news))
                        <div class="row clearfix">
                            <div class="col-md-12">
                                <div class="input-group">
                                    <input type="hidden" name="id_news" value="{{$id_news}}">
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
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="body">
                <table class="table table-bordered table-striped table-hover js-basic-example dataTable listTable">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Description</th>
                            <th>Tanggal</th>
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
<script src="{{ URL::asset('') }}plugins/tinymce/tinymce.js"></script>
 <script src="{{ URL::asset('') }}plugins/sweetalert/sweetalert.min.js"></script>
<script>
    var urlAjaxTable = "{{ URL::to(route('config.newsAjax')) }}";
    var  urlEdit = "{{url('/admin/config/news-edit')}}";
    var  urlDelete = "{{url('/admin/config/news-delete')}}";
    var urlBase = "{{url('/')}}";
    $(function () {
    //TinyMCE
    tinymce.init({
        selector: "textarea#tinymce",
        theme: "modern",
        height: 300,
        plugins: [
            'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            'searchreplace wordcount visualblocks visualchars code fullscreen',
            'insertdatetime media nonbreaking save table contextmenu directionality',
            'emoticons template paste textcolor colorpicker textpattern imagetools'
        ],
        toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        toolbar2: 'print preview media | forecolor backcolor emoticons',
        image_advtab: true
    });
    tinymce.suffix = ".min";
    tinyMCE.baseURL = urlBase+'/plugins/tinymce';
});
$('#tanggal_news').datepicker({
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
            { "data": "judul_news" },
            { "data": "description_news" },
            { "data": "tanggal_news" },

            { "data": "status" },
            { "render": function (data, type, row, meta) {

                        var edit = $('<a><button>')
                                    .attr('class', "btn bg-blue-grey waves-effect edit-menu")
                                    .attr('href',urlEdit+'/'+row.id_news)
                                    .text('Edit')
                                    .wrap('<div></div>')
                                    .parent()
                                    .html();
                        var del = $('<button>')
                                    .attr('class', "btn btn-danger waves-effect delete-menu")
                                    .attr('onclick', "deletProcess('"+row.id_news+"')")
                                    .text('Delete')
                                    .wrap('<div></div>')
                                    .parent()
                                    .html();
                        return edit+" | "+del;
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
       ],
        "aoColumnDefs": [
         { "bSortable": false, "aTargets": [ 4 ] }
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
                            var del = $('<button>')
                                        .attr('class', "btn btn-danger waves-effect delete-menu")
                                        .attr('onclick', "deletProcess('"+row.id_news+"')")
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
            "destroy" : true,
            "aoColumnDefs": [
              { "bSortable": false, "aTargets": [ 4 ] }
            ]
      });
    });

function deletProcess(id_news){
    swal({
        title: "Apakah anda yakin ?",
        text: "Anda akan menghapus data.",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete ",
        closeOnConfirm: true,
    }, function () {
         window.location.href = urlDelete+'/'+id_news;
    });
}
</script>
@endsection
@stop
@stop
