@extends('layouts.index_no_require')
@section('header')
    <link href="{{ URL::asset('') }}plugins/bootsrap-datepicker/bootstrap-datepicker.css" rel="stylesheet" />
@stop

@section('content')
@include('layouts.left')
@include('layouts.right')
<section class="content">
	@if ($result[0]->pay == "Simpanan wajib")
                          	<?php $tranfer ='bkt_bayar_wajib'; ?>
                          @else
                          	<?php $tranfer ='bkt_bayar_spokok'; ?>
                          @endif
<!-- Basic Table -->
<div class="container-fluid">
		<a href="{{url(route('config.pay'))}}">
			<button type="button" class="btn btn-warning waves-effect">BACK</button>
		</a>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Tabel Detail <?php echo $result[0]->nm_anggota; ?>
                            </h2>
                        </div>
                        <div class="body table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Name </th>
                                        <th>:<?php echo $result[0]->nm_anggota; ?></th>         
                                    </tr>
                                    <tr>
                                        <th>Pay </th>
                                        <th>:<?php echo $result[0]->pay; ?></th>         
                                    </tr>
                                    <tr>
                                        <th>Bulan </th>
                                        <th>:<?php echo $result[0]->payMonth; ?></th>         
                                    </tr>
                                    <tr>
                                        <th>Tanggal Bayar </th>
                                        <th>:<?php echo date('d-m-Y',strtotime($result[0]->tgl_bayar_wajib)); ?></th>         
                                    </tr>
                                    <tr>
                                        <th>Bukti Bayar </th>
                                        <th>:<img src="{{url('/uploads/').'/'.$tranfer.'/'.$result[0]->bkt_bayar_wajib }}" width="80px"></th>         
                                    </tr>
                                </thead>
                            </table>
                            	<?php $approve = 0;
                            		  $pending = 1;
                            		  $reject = 2;

                            	 ?>

                            @if ($result[0]->pay=='Simpanan wajib')
                                <?php $pay =1; ?>
                            @else
                                <?php $pay=2; ?> 
                            @endif
                            @if ($result[0]->status == 1 )

                            <a href="{{url('/admin/config/controll-Pay-edit/').'/'.$result[0]->id_pay.'?pay='.$pay.'&status='.$approve}}">	
                                <button type="button" class="btn btn-info waves-effect">APPROVE</button>
                            </a>  
                                <button type="button" class="btn btn-success waves-effect" disabled >PENDING</button>
                            <a href="{{url('/admin/config/controll-Pay-edit/').'/'.$result[0]->id_pay.'?pay='.$pay.'&status='.$reject}}">
                                <button type="button" class="btn btn-info waves-effect">REJECT</button>
                            </a>  
                             @elseif($result[0]->status == 2)
                            <a href="{{url('/admin/config/controll-Pay-edit/').'/'.$result[0]->id_pay.'?pay='.$pay.'&status='.$approve}}">	
                        	<button type="button" class="btn btn-info waves-effect">APPROVE</button>
                            </a>  
                            <a href="{{url('/admin/config/controll-Pay-edit/').'/'.$result[0]->id_pay.'?pay='.$pay.'&status='.$pending}}">	
                              <button type="button" class="btn btn-info waves-effect" >PENDING</button>
                            </a>  
                              <button type="button" class="btn btn-success waves-effect" disabled >REJECT</button>
                        	@else
                              <button type="button" class="btn btn-success waves-effect" disabled >APPROVE</button>
                            <a href="{{url('/admin/config/controll-Pay-edit/').'/'.$result[0]->id_pay.'?pay='.$pay.'&status='.$pending}}">	
                              <button type="button" class="btn btn-info waves-effect" >PENDING</button>
                            </a>  
                              <a href="{{url('/admin/config/controll-Pay-edit/').'/'.$result[0]->id_pay.'?pay='.$pay.'&status='.$reject}}">
                              <button type="button" class="btn btn-info waves-effect">REJECT</button>
                            </a>  
                             @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Basic Table -->
		</div>
      </section>
@endsection
@stop
@stop