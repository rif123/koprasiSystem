@extends('layouts.index')
@section('content')
@include('layouts.left')
@include('layouts.right')
<section class="content">
    <div class="container-fluid">
        <div class="card">
        <div class="header">
            <h2>
                FORMULIR PENDAFTARAN ANGGOTA BARU
                <small>(isi dengan lengkap & jelas)</small>
            </h2>
            <ul class="header-dropdown m-r--5">
                <li class="dropdown">
                     <button type="button" class="btn btn-primary waves-effect btn-profile">SAVE</button>
                </li>
            </ul>
        </div>
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="body">
                    <form id="form-anggota" action="{{url(route('profile.create'))}}" method="post" enctype="multipart/form-data">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs tab-nav-right" role="tablist">
                       <li role="presentation" class="active"><a href="#home" data-toggle="tab">DATA PRIBADI</a></li>
                       <li role="presentation"><a href="#profile" data-toggle="tab">DATA USAHA</a></li>
                       <li role="presentation"><a href="#messages" data-toggle="tab">DOC & LEGAL</a></li>
                    </ul>

                        {!! Form::token() !!}
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade in active" id="home">
                                 @include('profile.index.dataPribadi')
                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="profile">
                                @include('profile.index.dataUsaha')
                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="messages">
                                @include('profile.index.dataDocLegal')
                            </div>
                        </div>
                    </form>
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
