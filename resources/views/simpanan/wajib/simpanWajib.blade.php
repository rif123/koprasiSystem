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
             <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
                        <div id="DataTables_Table_0_filter" class="dataTables_filter">
                            <label>Search:<input type="search" class="" placeholder="" aria-controls="DataTables_Table_0"></label>
                        </div>
                     </div>
        </div>
        <div class="row clearfix">
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                <div class="body">
                                                        
                        @if(!empty($kd_swajib))
                    <form id="form-menu" action="{{url(route('simpanan.update'))}}" method="post" enctype="multipart/form-data">
                        @else
                    <form id="form-menu" action="{{url(route('simpanan.save'))}}" method="post" enctype="multipart/form-data">
                        @endif
                        {!! Form::token() !!}
                        <div class="row clearfix">
                            <h2 class="card-inside-title group-title">Jumlah Bayar Wajib</h2>
                            <div class="col-md-12">
                                <div class="input-group">
                                    <div class="form-line">
                                        <input type="text" name="jml_bayar_wajib" class="form-control date" id ="jml_bayar_wajib" placeholder="Jumlah Bayar Wajib" value="{{!empty($jml_bayar_wajib) ? $jml_bayar_wajib : '' }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <h2 class="card-inside-title group-title">bkt bayar wajib</h2>
                            <div class="col-md-12">
                                <div class="input-group">
                                    <div class="form-line">
                                        <input type="file" name="bkt_bayar_wajib" class="form-control date" id = "bkt_bayar_wajib" placeholder="bkt bayar wajib">
                                        @if (!empty($bkt_bayar_wajib))
                                        <img src="{{url('/uploads/bkt_bayar_wajib/').'/'.$bkt_bayar_wajib}}" width="30px">
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <h2 class="card-inside-title group-title">tanggal bayar wajib</h2>
                            <div class="col-md-12">
                                <div class="input-group">
                                    <div class="form-line">
                                        <input type="text" value="{{!empty($tgl_bayar_wajib) ? $tgl_bayar_wajib : '' }}" name="tgl_bayar_wajib" class="form-control date " id="tgl_bayar_wajib" placeholder="tanggal bayar wajib" onClick="getAllMenu()">

                                    </div>
                                </div>
                            </div>
                        </div > 
                        @if(!empty($kd_swajib))

                        <div class="row clearfix">
                            <div class="col-md-12">
                                <div class="input-group">
                                    <input type="hidden" name="kd_swajib" value="{{$kd_swajib}}">
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
            <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                <div class="body">
                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                      <thead>
           <tr>
                    <th>Jumlah bayar wajib</th>
                    <th>bkt bayar wajib</th>
                    <th>tanggal bayar wajib</th>
                    <th>no swajib</th>
                    <th>kode anggota</th>
                    <th>Status</th>
                    <th>action</th>
                </tr>
                      </thead>
                      @foreach($data as $key => $value)
                      <tbody>
                          
                              <tr>
                                  <th>{{$value->jml_bayar_wajib}}</th>
                        
                                  <th><img src="{{url('/uploads/bkt_bayar_wajib/').'/'.$value->bkt_bayar_wajib}}" width="50px"></th>
                                  <th>{{date('d-m-Y',strtotime($value->tgl_bayar_wajib))}}</th>
                                  <th>{{$value->no_swajib}}</th>
                                  
                                  <th>{{$value->kd_anggota}}</th>
                        @if ($value->status == 1)
                            <th>Pending</th>
                                  <th>
                                  <a href="{{url('/admin/simpan-wajib-edit').'/'.$value->kd_swajib}}">
                                      
                                      <button type="button" class="btn bg-blue-grey waves-effect edit-menu" data-name-menu="" data-id-menu="" data-parent-menu=""  data-url-menu="" data-icon-menu="" >EDIT</button>
                                  </a>
                                  <a href="{{url('/admin/simpan-wajib-delete').'/'.$value->kd_swajib}}">
                                      <button type="button" class="btn btn-danger waves-effect delete-menu"  data-id-menu="">DELETE</button>
                                  </a>
                                  </th>
                        @elseif($value->status == 2)
                            <th>Reject</th>
                            <th></th>
                        @else
                            <th>Approve</th>
                            <th></th>
                        @endif

                              </tr>
                    
                      </tbody>
                        @endforeach
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
$('#tgl_bayar_wajib').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true,
        startDate: '-3d'
    });

</script>
@endsection
@stop
@stop
