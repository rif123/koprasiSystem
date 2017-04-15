@extends('layouts.index_no_require')
@section('content')
@include('layouts.left')
@include('layouts.right')
<section class="content">
    <div class="container-fluid">
        <div class="card">
        <div class="header">
            <h2>Generate Token</h2>
        </div>
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="body">
                    <form action="{{url(route('config.generateToken'))}}" method="post" enctype="multipart/form-data">
                        {!! Form::token() !!}
                        <div class="row clearfix">
                            <h2 class="card-inside-title group-title">Nama Anggota</h2>
                            <div class="col-md-12">
                                <div class="input-group">
                                    <div class="form-line">
                                        <input type="text" name="nm_anggota" class="form-control" placeholder="Nama Anggota">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <h2 class="card-inside-title group-title">Nomor Anggota</h2>
                            <div class="col-md-12">
                                <div class="input-group">
                                    <div class="form-line">
                                        <input type="text" name="nomor_anggota" class="form-control" placeholder="Nomor Anggota">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-md-12">
                                <button type="submit" class="btn bg-primary waves-effect" >Generate</button>
                            </div>
                        </div>
                    </form>
                    <hr></hr>
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-md-offset-4 body bg-pink" style="border:1px solid #000;">
                        Generate Berhasil
                        <ul class="dashboard-stat-list">
                            <li>
                                User
                                <span class="pull-right"><b>tester.com</b></span>
                            </li>
                            <li>
                                Password
                                <span class="pull-right"><b>asdqwe123</b></span>
                            </li>
                        </ul>
                    </div>
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
@stop
@stop
