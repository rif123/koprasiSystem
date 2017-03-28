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
                                    <form name="edit" method="POST">
                                        <h2 class="card-inside-title">Social Link</h2>
                                        <span>Select fontawesome icon name <a href="http://fontawesome.io/icons/" target="_BLANK">here</a></span>
                                        <span>Write the link with http:// is recommended</span>
                                        @if((is_array($data)) && (count($data) > 0))
                                            @foreach($data as $a)
                                                <div class="panel panel-default">
                                                    <div class="panel-body">
                                                        <div class="form-group">
                                                            <h3 class="card-inside-title">Social name</h3>
                                                            <div class="input-group">
                                                                <span class="input-group-addon">
                                                                    <i class="material-icons">title</i>
                                                                </span>
                                                                <div class="form-line">
                                                                    <input type="text" value="{{$a['name']}}" class="form-control" name="name[]" placeholder="name" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <h3 class="card-inside-title">Fontawesome icon name</h3>
                                                            <div class="input-group">
                                                                <span class="input-group-addon">
                                                                    <i class="material-icons">insert_emoticon</i>
                                                                </span>
                                                                <div class="form-line">
                                                                    <input type="text" value="{{$a['fa-icon']}}" class="form-control" name="icon[]" placeholder="fa-facebook" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <h3 class="card-inside-title">Social link</h3>
                                                            <div class="input-group">
                                                                <span class="input-group-addon">
                                                                    <i class="material-icons">link</i>
                                                                </span>
                                                                <div class="form-line">
                                                                    <input type="text" value="{{$a['link']}}" class="form-control" name="link[]" placeholder="link" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            @endforeach
                                        @else
                                            <div class="panel panel-default">
                                                <div class="panel-body">
                                                    <div class="form-group">
                                                        <h3 class="card-inside-title">Social name</h3>
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="material-icons">title</i>
                                                            </span>
                                                            <div class="form-line">
                                                                <input type="text" class="form-control" name="name[]" placeholder="name" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <h3 class="card-inside-title">Fontawesome icon name</h3>
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="material-icons">insert_emoticon</i>
                                                            </span>
                                                            <div class="form-line">
                                                                <input type="text" class="form-control" name="icon[]" placeholder="fa-facebook" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <h3 class="card-inside-title">Social link</h3>
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="material-icons">link</i>
                                                            </span>
                                                            <div class="form-line">
                                                                <input type="text" class="form-control" name="link[]" placeholder="link" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        <button type="button" class="btn bg-light-green waves-effect" id="addNewSocial">
                                            <i class="material-icons">note_add</i>
                                        </button>
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