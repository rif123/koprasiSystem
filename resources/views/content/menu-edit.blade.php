@extends('layouts.index')
    @section('content')
        @include('layouts.left')
        @include('layouts.right')
    <section class="content">
                <div class="container-fluid">
                    <div class="block-header">
                        <h2><A href="{{url($_ENV['ADMIN_FOLDER'].'/menu')}}">MENU</a> >  EDIT</h2>
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
                                    <form name="add" method="POST">
                                        <h2 class="card-inside-title">Name</h2>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">title</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="text" value="{{$name}}" class="form-control" name="name" placeholder="Name" />
                                            </div>
                                        </div>
                                        <h2 class="card-inside-title">Link</h2>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">toc</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="text" value="{{$link}}" class="form-control" name="link" placeholder="/" />
                                            </div>
                                        </div>
                                        <h2 class="card-inside-title">Order Show</h2>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                               <i class="material-icons">toc</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="text" value="{{$order_show}}" class="form-control" name="order" value="1" />
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
