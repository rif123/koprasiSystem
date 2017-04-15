@extends('layouts.index')
    @section('content')
        @include('layouts.left')
        @include('layouts.right')
    <section class="content">
                <div class="container-fluid">
                    <div class="block-header">
                        <h2><A href="{{url($_ENV['ADMIN_FOLDER'].'/skill')}}">SKILL</a> >  EDIT</h2>
                    </div>
                    <div class="row clearfix">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="card">
                                <div class="header">
                                    <h2>Edit : {{$title}}</h2>
                                </div>
                                <div class="body">
                                    <div id="modal" class="modal fade" tabindex="-1" role="dialog">
                                        <div class="modal-dialog" role="document" style="width:50%;height:20px;">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                </div>
                                                <div class="modal-body" id="ContentModal">
                                                    Loading...
                                                </div>
                                        </div>
                                    </div>
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
                                    <form name="edit" method="POST"  enctype="multipart/form-data">
                                        <h2 class="card-inside-title">Title</h2>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">title</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="title" placeholder="Name" value="{{$title}}"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <h2 class="card-inside-title">Text</h2>
                                            <div class="form-line">
                                                <textarea name="description" class="form-control" placeholder="Text Box..">{{$description}}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <h2 class="card-inside-title">Featured Image</h2>
                                            <div id="information"></div>
                                            <div class="form-line">
                                                <div class="input-group">
                                                    <input name="img" type="file" id="imgupload" /><button type="button" class="btn btn-warning waves-effect clearupload" data-target="#imgupload">Clear upload</button>
                                                </div> Or 
                                                <button type="button" href="#ContentModal" data-to="#imgUploadReplace" data-to-origin="#imgUploadReplace1" data-url="/{{$_ENV['ADMIN_FOLDER']}}/mediamanager/show" class="btn bg-light-blue waves-effect OpenMediaManager">Choose from media manager</button>
                                                <input type="text" class="form-control" value="{{$image}}" id="imgUploadReplace" disabled/>
                                                <input type="hidden" class="form-control" value="{{$image}}" name="image" id="imgUploadReplace1"/>
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
