@extends('layouts.index')
    @section('content')
        @include('layouts.left')
        @include('layouts.right')
            <section class="content">

                <div class="container-fluid">
                    <div class="block-header">
                        <h2>General Setting</h2>
                    </div>
                    <div class="row clearfix">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="card">
                                <div class="header">
                                    <h2>Setting</h2>
                                </div>
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
                                    <form name="edit" method="POST" enctype="multipart/form-data">
                                        <h2 class="card-inside-title">Site Title</h2>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">title</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="title" value="{{$site_title}}" placeholder="title" />
                                            </div>
                                        </div>
                                        <h2 class="card-inside-title">Site Description</h2>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">description</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="description" value="{{$site_description}}" placeholder="description" />
                                            </div>
                                        </div>
                                        <h2 class="card-inside-title">Site Meta Description</h2>
                                        <div class="input-group">
                                            <div class="form-line">
                                                <textarea class="form-control" name="metadescription">{{$meta_description}}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <h2 class="card-inside-title">Site Keyword</h2>
                                            <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">subject</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="metakeyword" value="{{$meta_keyword}}" placeholder="Separate Keyword with comma" />
                                            </div>
                                        </div>
                                        </div>
                                        <div class="form-group">
                                            <h2 class="card-inside-title">Site Logo</h2>
                                            <div id="information"></div>
                                            <div class="form-line">
                                                <div class="input-group">
                                                    <input name="img" type="file" id="imgupload" /><button type="button" class="btn btn-warning waves-effect clearupload" data-target="#imgupload">Clear upload</button>
                                                </div> Or 
                                                <button type="button" href="#ContentModal" data-to="#imgUploadReplace" data-to-origin="#imgUploadReplace1" data-url="/{{$_ENV['ADMIN_FOLDER']}}/mediamanager/show" class="btn bg-light-blue waves-effect OpenMediaManager">Choose from media manager</button>
                                                <input type="text" class="form-control" value="{{$site_logo}}" id="imgUploadReplace" disabled/>
                                                <input type="hidden" class="form-control" value="{{$site_logo}}" name="image" id="imgUploadReplace1"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <h2 class="card-inside-title">favicon</h2>
                                            <div id="information"></div>
                                            <div class="form-line">
                                            <input type="file" name="favicon" id="favicon">
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