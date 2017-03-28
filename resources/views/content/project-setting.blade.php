@extends('layouts.index')
    @section('content')
        @include('layouts.left')
        @include('layouts.right')
            <section class="content">

                <div class="container-fluid">
                    <div class="block-header">
                        <h2><A href="{{url($_ENV['ADMIN_FOLDER'].'/project')}}">PROJECT</a> > Setting</h2>
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
                                        <h2 class="card-inside-title">Header Title</h2>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">title</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="pr_title" value="{{$project_title}}" placeholder="title" />
                                            </div>
                                        </div>
                                        <h2 class="card-inside-title">Category title</h2>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">title</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="pr_cate_title" value="{{$project_category_title}}" placeholder="title" />
                                            </div>
                                        </div>
                                        <h2 class="card-inside-title">Button Text</h2>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">title</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="pr_button_text" value="{{$project_button_text}}" placeholder="title" />
                                            </div>
                                        </div>
                                        <h2 class="card-inside-title">Button Link</h2>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">link</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="pr_button_link" value="{{$project_button_link}}" placeholder="title" />
                                            </div>
                                        </div>
                                        <h2 class="card-inside-title">Button Text(On page)</h2>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">title</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="pr_button_text_full" value="{{$project_button_text_full}}" placeholder="title" />
                                            </div>
                                        </div>
                                        <h2 class="card-inside-title">Button link(On page)</h2>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">link</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="pr_button_link_full" value="{{$project_button_link_full}}" placeholder="title" />
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