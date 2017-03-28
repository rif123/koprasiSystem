@extends('layouts.index')
    @section('header')
    <link href="{{ URL::asset('') }}plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet"/>
    @stop
    @section('js')
        <script src="{{ URL::asset('') }}plugins/ckeditor/ckeditor.js"></script>
        <script type="text/javascript">
                CKEDITOR.replace( 'ckNoImage' ,{
                                    customConfig: '{{ URL::asset('') }}plugins/ckeditor/configNoImage.js'
                                });
        </script>
    @stop
    @section('content')
        @include('layouts.left')
        @include('layouts.right')
    <section class="content">
                <div class="container-fluid">
                    <div class="block-header">
                        <h2><A href="{{url($_ENV['ADMIN_FOLDER'].'/project')}}">PROJECT</a> >  EDIT</h2>
                    </div>
                    <div class="row clearfix">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="card">
                                <div class="header">
                                    <h2>EDIT : {{$name}}</h2>
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
                                        <h2 class="card-inside-title">Project Name</h2>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">title</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="name" value="{{$name}}" placeholder="Name" />
                                            </div>
                                        </div>
                                        <h2 class="card-inside-title">Project Client</h2>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">face</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="client" value="{{$client}}" placeholder="Client Name" />
                                            </div>
                                        </div>
                                        <h2 class="card-inside-title">Project Category</h2>
                                        <div class="row clearfix">
                                            <div class="col-sm-6">
                                                <select class="form-control"  name="category">
                                                    @foreach($category as $a => $b)
                                                        @if($b->category_id==$category_id)
                                                            <option value="{{$b->category_id}}" selected>{{$b->name}}</option>
                                                        @else
                                                            <option value="{{$b->category_id}}" >{{$b->name}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <h2 class="card-inside-title">Description</h2>
                                            <div class="form-line">
                                                <textarea name="description" id="ckNoImage" class="form-control" placeholder="Text Box..">{{$description}}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <h2 class="card-inside-title">Image Gallery</h2>
                                            (Multiple select support)
                                            <div class="form-line">
                                                <div class="input-group">
                                                    <input type="file" id="imgGallery" name="imggallery[]" multiple /><button type="button" class="btn btn-warning waves-effect clearupload" data-target="#imgGallery">Clear upload</button>
                                                </div> And Choose from media manager
                                                <button type="button"  href="#ContentModal" data-multiple="1" data-to-origin="#imgUploadReplaceGallery" data-url="/{{$_ENV['ADMIN_FOLDER']}}/mediamanager/show" class="btn bg-light-blue waves-effect OpenMediaManager">Choose from media manager</button>
                                                <input type="text" name="imagegallery" class="form-control" value="{{$img}}" id="imgUploadReplaceGallery"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <h2 class="card-inside-title">Featured Image</h2>
                                            <div id="information"></div>
                                            <div class="form-line">
                                                <div class="input-group">
                                                    <input name="featuredimg" type="file" id="imgupload" /><button type="button" class="btn btn-warning waves-effect clearupload" data-target="#imgupload">Clear upload</button>
                                                </div> Or 
                                                <button type="button" href="#ContentModal" data-to="#imgUploadReplace" data-to-origin="#imgUploadReplace1" data-url="/{{$_ENV['ADMIN_FOLDER']}}/mediamanager/show" class="btn bg-light-blue waves-effect OpenMediaManager" >Choose from media manager</button>
                                                <input type="text" class="form-control" value="{{$featured_image}}" id="imgUploadReplace" disabled/>
                                                <input type="hidden" class="form-control" value="{{$featured_image}}" name="featuredimage" id="imgUploadReplace1"/>
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
