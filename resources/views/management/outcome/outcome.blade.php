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

                                
                    @if(!empty($id_outcome))       
                    <form id="form-menu" action="{{url(route('management.outcomeupdate'))}}" method="post" enctype="multipart/form-data">
                     @else
                    <form id="form-menu" action="{{url(route('management.outcomesave'))}}" method="post" enctype="multipart/form-data">
                     @endif   
                        {!! Form::token() !!}
                        <div class="row clearfix">
                            <h2 class="card-inside-title group-title">Jumlah Income</h2>
                            <div class="col-md-12">
                                <div class="input-group">
                                    <div class="form-line">
                                        <input type="text" name="jml_outcome" class="form-control date" id ="jml_bayar_spokok" placeholder="Jumlah Outcome " value="{{!empty($jml_outcome) ? $jml_outcome : '' }}">
                                    </div>
                                </div>
                            </div>
                        </div>  
                        <div class="row clearfix">
                            <h2 class="card-inside-title group-title">PIC Income</h2>
                            <div class="col-md-12">
                                <div class="input-group">
                                    <div class="form-line">
                                        <input type="text" name="pic_outcome" class="form-control date" id ="jml_bayar_spokok" placeholder="PIC Outcome" value="{{!empty($pic_outcome) ? $pic_outcome : '' }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <h2 class="card-inside-title group-title">Tanggal Bayar Income</h2>
                            <div class="col-md-12">
                                <div class="input-group">
                                    <div class="form-line">
                                        <input type="text" value="{{ !empty($tgl_outcome) ? date('d-m-Y H:i:s' ,strtotime($tgl_outcome)) : ''}}" name="tgl_outcome" class="form-control date " id="tgl_outcome" placeholder="tanggal bayar Outcome" onClick="getAllMenu()">

                                    </div>
                        <div class="row clearfix">
                            <h2 class="card-inside-title group-title">Keterangan Income</h2>
                            <div class="col-md-12">
                         <div class="form-group form-float">
                                    <div class="form-line">
                                        <textarea name="ket_outcome" cols="30" rows="5" class="form-control no-resize" required>{{ !empty($ket_outcome) ?$ket_outcome : ''}}</textarea>
                                    </div>
                                </div>
                             </div>
                        </div>   

                                </div>
                            </div>
                        </div >
                          
                        @if (!empty ($id_outcome))
                        <div class="row clearfix">
                            <div class="col-md-12">
                                <div class="input-group">
                                    <input type="hidden" name="id_outcome" value="{{$id_outcome}}">
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
                    <th>Jumla Outcome</th>
                    <th>PIC Outcome</th>
                    <th>Tanggal Bayar Outcome</th>
                    <th>Keterangan Outcome</th>
                    <th>Kode Anggota</th>
                    <th>action</th>
                </tr>
                      </thead>
                     @foreach($data as $key => $value) 
                      <tbody>
                          
                              <tr>
                                  <th>{{$value->jml_outcome}}</th>
                                  <th>{{$value->pic_outcome}}</th>
                                  <th>{{$value->tgl_outcome}}</th>
                                  <th>{{$value->ket_outcome}}</th>
                                  <th>{{$value->kd_anggota}}</th>
                                     <th> 
                                  
                                    <a href="{{url('/admin/management/outcome-edit').'/'.$value->id_outcome}}">
                                        
                                      <button type="button" class="btn bg-blue-grey waves-effect edit-menu" data-name-menu="" data-id-menu="" data-parent-menu=""  data-url-menu="" data-icon-menu="" >EDIT</button>
                                 </a>
                                  </th>
                                  
                    
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
$('#tgl_outcome').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true,
        startDate: '-3d'
    });

</script>
@endsection
@stop
@stop
