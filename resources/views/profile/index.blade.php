@extends('layouts.index')
@section('content')
@include('layouts.left')
@include('layouts.right')
<link href="{{ URL::asset('') }}plugins/bootsrap-datepicker/bootstrap-datepicker.css" rel="stylesheet" />
<section class="content">
    <div class="container-fluid">
        <div class="card">
        <div class="header">
            <h2>
                FORMULIR PENDAFTARAN ANGGOTA BARU
                <small>(isi dengan lengkap & jelas)</small>
                @include('profile.menuProfile')
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
                        <div id="wizard_horizontal">
                                {!! Form::token() !!}
                                <input  type="hidden" name="kd_anggota" value="{{Session::get('kd_anggota')}}" />
                                <h2>DATA PRIBADI</h2>
                                <section>
                                    @include('profile.index.dataPribadi')
                                </section>
                                <h2>DATA USAHA</h2>
                                <section>
                                    @include('profile.index.dataUsaha')
                                </section>
                                <h2>DOC & LEGAL</h2>
                                <section>
                                    @include('profile.index.dataDocLegal')
                                </section>
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
