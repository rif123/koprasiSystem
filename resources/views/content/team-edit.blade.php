@extends('layouts.index')
    @section('header')
    <link href="{{ URL::asset('') }}fe/fonts/font-awesome/css/font-awesome.css" rel="stylesheet"/>
    @stop
    @section('content')
        @include('layouts.left')
        @include('layouts.right')
    <section class="content">
                <div class="container-fluid">
                    <div class="block-header">
                        <h2><A href="{{url($_ENV['ADMIN_FOLDER'].'/team')}}">TEAM</a> >  EDIT</h2>
                    </div>
                    <div class="row clearfix">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="card">
                                <div class="header">
                                    <h2>Edit : {{$name}}</h2>
                                </div>
                                <div class="body">
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
                                    <form name="edit" method="POST" enctype="multipart/form-data">
                                        <div id="edit-img">
                                        @if(file_exists(public_path().'/images/image-gallery/team/'.$id.'.jpg'))
                                            <img class="img-responsive thumbnail" src="{{asset('/images/image-gallery/team/'.$id.'.jpg')}}"/>
                                        @else
                                            <img class="img-responsive thumbnail" src="{{asset('/images/image-gallery/team/avatar.jpg')}}"/>
                                        @endif
                                        </div>
                                        <h2 class="card-inside-title">Name</h2>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">person</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="name" value="{{$name}}" placeholder="Name" />
                                            </div>
                                        </div>
                                        <h2 class="card-inside-title">Position</h2>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">card_travel</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="position" value="{{$position}}" placeholder="Position in job" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <h2 class="card-inside-title">Description</h2>
                                            <div class="form-line">
                                                <textarea name="description" class="form-control" placeholder="Description..">{{$description}}</textarea>
                                            </div>
                                        </div>
                                        <div class="input-group">
                                            <h2 class="card-inside-title">Change Photo</h2>
                                            <input name="photo" type="file">
                                        </div>
                                        <h2 class="card-inside-title">Social Media Link</h2>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-facebook-official" aria-hidden="true"></i>
                                            </span>
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="fb" value="{{$social['fb']}}" placeholder="facebook link" />
                                            </div>
                                        </div>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-twitter-square" aria-hidden="true"></i>
                                            </span>
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="tw" value="{{$social['tw']}}" placeholder="twitter link" />
                                            </div>
                                        </div>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-instagram" aria-hidden="true"></i>
                                            </span>
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="ig" value="{{$social['ig']}}" placeholder="instagram link" />
                                            </div>
                                        </div>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-google-plus-square" aria-hidden="true"></i>
                                            </span>
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="gp" value="{{$social['gp']}}" placeholder="Google Plus link" />
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
            </section>
    @stop
@stop
