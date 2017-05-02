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
                Ganti Password
                <small>(isi dengan lengkap & jelas)</small>
                @include('profile.menuProfile')
            </h2>
        </div>
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="body">
                    <div class="row clearfix">
                        <div class="card">

                            @if(\Session::get('success'))
                                <div class="alert alert-success">
                                    {{\Session::get('success')}}
                                </div>
                            @endif
                            @if($errors->has())
                                <div class="alert alert-danger">
                                    <h4>Error:</h4>
                                    <ul>
                                   @foreach ($errors->all() as $error)
                                      <li>{{ $error }}</li>
                                  @endforeach
                                  </ul>
                                </div>
                            @endif
                            <div class="body">
                                <form name="edit" method="POST" action="{{url(route('profile.processGantiPassword'))}}" >
                                    <div class="form-group">
                                        <h2 class="card-inside-title">Change Password</h2>
                                        <div class="form-line">
                                            <input type="password" class="form-control" name="oldpass" placeholder="Old password" />
                                        </div>
                                        <div class="form-line">
                                            <input type="password" class="form-control" name="newpass" placeholder="New Password" />
                                        </div>
                                    </div>
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div style="text-align:center">
                                        <button type="Submit" class="btn btn-primary btn-lg m-l-15 waves-effect">Save</button>
                                    </div>
                                </form>
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
