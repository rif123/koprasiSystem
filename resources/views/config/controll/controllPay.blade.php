@extends('layouts.index_no_require')
@section('header')
    <link href="{{ URL::asset('') }}plugins/bootsrap-datepicker/bootstrap-datepicker.css" rel="stylesheet" />
@stop

@section('content')
@include('layouts.left')
@include('layouts.right')
<section class="content">.

                <div class="container-fluid">
                    <div class="row clearfix">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="card">


                                <div class="header">
                                    <h2>Controll Pay</h2>

                                
                                </div>

                            <div class="body">
                                <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
                                    <div id="DataTables_Table_0_filter" class="dataTables_filter">
                                    <label>Search:<input type="search" class="" placeholder="" aria-controls="DataTables_Table_0"></label>
                                    </div>
                                </div>
                                        <thead>
                                   <table class="table" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Anggota</th>
                                                <th>Nama Pembayaran</th>
                                                <th>Bulan</th>
                                                <th>Jumlah Bayar</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-striped">
                                        <?php $no =1; ?>
                                        @foreach($data as $key => $value)
                                                
                                                <tr>
                                                <td>{{$no}}</td>
                                                    <td>{{$value->nm_anggota}}</td>
                                                    <td>{{$value->pay}}</td>
                                                    <td>{{$value->payMonth}}</td>
                                                    <td>{{$value->jml_bayar_wajib}}</td>
                                                    @if ($value->status == 1)
                                                        <th>Pending</th>
                                                    @elseif($value->status ==2)
                                                        <th>Reject</th>
                                                    @elseif($value->status ==0)
                                                        <th>Approve</th>
                                                    @endif
                                                    <td>

                                                    @if ($value->pay =='Simpanan wajib')
                                                        <?php $pay =1; ?>
                                                    @else
                                                        <?php $pay=2; ?> 
                                                    @endif
                                                        <a href="{{url('/admin/config/controll-Pay-detail/').'/'.$value->id_pay.'?pay='.$pay}}">
                                                            <button class="btn btn-info waves-effect" type="button">
                                                                    <i class="material-icons" style="color:white">remove_red_eyet</i>     
                                                            Detail
                                                            </button>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php $no++; ?>
                                          @endforeach     
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
@endsection
@stop
@stop
