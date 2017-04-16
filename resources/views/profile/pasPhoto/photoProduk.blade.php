@extends('layouts.index_no_require')
@section('header')
    <link href="{{ URL::asset('') }}plugins/dropzone/min/dropzone.min.css" rel="stylesheet" />
@stop

@section('content')
@include('layouts.left')
@include('layouts.right')

<section class="content">
    <div class="container-fluid">
        <div class="card">
        <div class="header">
            <h2>
                Simpanan Anggota Photo Produk
                <small>(isi dengan lengkap & jelas)</small>
                @include('profile.menuProfile')
            </h2>
            <ul class="header-dropdown m-r--5">
                <li class="dropdown">
                     <button type="button" class="btn btn-primary waves-effect btn-pas-profile">SAVE</button>
                </li>
            </ul>
        </div>
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="body">
                    <div class="row clearfix">
                       <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                           <div class="card">
                               <div class="header">
                                   <h2>
                                       FILE UPLOAD - DRAG & DROP OR WITH CLICK & CHOOSE
                                   </h2>
                                   <ul class="header-dropdown m-r--5">
                                       <li class="dropdown">
                                           <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                               <i class="material-icons">more_vert</i>
                                           </a>
                                           <ul class="dropdown-menu pull-right">
                                               <li><a href="javascript:void(0);">Action</a></li>
                                               <li><a href="javascript:void(0);">Another action</a></li>
                                               <li><a href="javascript:void(0);">Something else here</a></li>
                                           </ul>
                                       </li>
                                   </ul>
                               </div>
                               <div class="body">
                                   <form action="{{url(route('profile.photoProdukUpload'))}}" id="frmProfile" class="dropzone" method="post"  enctype="multipart/form-data">
                                            {!! Form::token() !!}
                                       <div class="dz-message">
                                           <div class="drag-icon-cph">
                                               <i class="material-icons">touch_app</i>
                                           </div>
                                           <h3>Drop files here or click to upload.</h3>
                                           <em>(This is just a demo dropzone. Selected files are <strong>not</strong> actually uploaded.)</em>
                                       </div>
                                       <div class="fallback">
                                           <input name="file"  type="file" multiple />
                                       </div>
                                   </form>
                               </div>
                           </div>
                       </div>

                       <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                           <div class="card">
                               <div class="body">
                                   <div class="fallback photoProfile">
                                       <img src="{{url('uploads/produk/'.$photo)}}"  id="idProfilePhoto" alt="no-image"/>
                                   </div>
                               </div>
                           </div>
                       </div>


                   </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        h2.group-title{
            margin-left:15px
        }
        .photoProfile {
            min-height: 150px;
            border: 2px solid rgba(0,0,0,0.3);
            background: white;
            padding: 20px 20px;
            border: 2px solid transparent !important;
            background-color: #eee !important;
        }
    </style>
</section>
@stop
@stop
@section('js')
<script src="{{ URL::asset('') }}plugins/dropzone/min/dropzone.min.js"></script>
<script>
    $(document).ready(function(){
        Dropzone.options.frmProfile = {
          maxFiles: 1,
          accept: function(file, done) {
              done();
          },
          init: function() {
            this.on("maxfilesexceeded", function(file){
                alert("FIle minimal 1");
            });
            this.on("success", function(file, response) {
                $('#idProfilePhoto').attr('src', response.filename);
           })
          }
        };
});

</script>
@stop
