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


                    @if(!empty($id_income))
                    <form id="form-menu" action="{{url(route('management.incomeupdate'))}}" method="post" enctype="multipart/form-data">
                     @else
                    <form id="form-menu" action="{{url(route('management.incomesave'))}}" method="post" enctype="multipart/form-data">
                     @endif
                        {!! Form::token() !!}
                        <div class="row clearfix">
                            <h2 class="card-inside-title group-title">Jumlah Income</h2>
                            <div class="col-md-12">
                                <div class="input-group">
                                    <div class="form-line">
                                        <input type="text" name="jml_income" class="form-control date" id ="jml_bayar_spokok" placeholder="Jumlah Income " value="{{!empty($jml_income) ? $jml_income : '' }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <h2 class="card-inside-title group-title">PIC Income</h2>
                            <div class="col-md-12">
                                <div class="input-group">
                                    <div class="form-line">
                                        <input type="text" name="pic_income" class="form-control date" id ="jml_bayar_spokok" placeholder="PIC Income" value="{{!empty($pic_income) ? $pic_income : '' }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <h2 class="card-inside-title group-title">Tanggal Bayar Income</h2>
                            <div class="col-md-12">
                                <div class="input-group">
                                    <div class="form-line">
                                        <input type="text" value="{{ !empty($tgl_income) ? date('d-m-Y H:i:s' ,strtotime($tgl_income)) : ''}}" name="tgl_income" class="form-control date " id="tgl_income" placeholder="tanggal bayar Income" onClick="getAllMenu()">

                                    </div>
                        <div class="row clearfix">
                            <h2 class="card-inside-title group-title">Keterangan Income</h2>
                            <div class="col-md-12">
                         <div class="form-group form-float">
                                    <div class="form-line">
                                        <textarea name="ket_income" cols="30" rows="5" class="form-control no-resize" required>{{ !empty($ket_income) ?$ket_income : ''}}</textarea>
                                    </div>
                                </div>
                             </div>
                        </div>

                                </div>
                            </div>
                        </div >

                        @if (!empty ($id_income))
                        <div class="row clearfix">
                            <div class="col-md-12">
                                <div class="input-group">
                                    <input type="hidden" name="id_income" value="{{$id_income}}">
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
                    <th>Jumlah</th>
                    <th>PIC</th>
                    <th>Tanggal</th>
                    <th>Keterangan</th>
                    <th>action</th>
                </tr>
                      </thead>
                     @foreach($data as $key => $value)
                      <tbody>

                              <tr>
                                  <th>{{$value->jml_income}}</th>
                                  <th>{{$value->pic_income}}</th>
                                  <th>{{$value->tgl_income}}</th>
                                  <th>{{$value->ket_income}}</th>
                                     <th>

                                    <a href="{{url('/admin/management/income-edit').'/'.$value->id_income}}">

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
$('#tgl_income').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true,
        startDate: '-3d'
    });
</script>
@endsection
@stop
@stop
