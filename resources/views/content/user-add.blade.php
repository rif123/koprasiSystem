@extends('layouts.index')
    @section('header')
    <link href="{{ URL::asset('') }}plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet"/>
    @stop
    @section('content')
        @include('layouts.left')
        @include('layouts.right')
    <section class="content">
                <div class="container-fluid">
                    <div class="block-header">
                        <h2><A href="{{url($_ENV['ADMIN_FOLDER'].'/user')}}">USER</a> >  ADD</h2>
                    </div>
                    <div class="row clearfix">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="card">
                                <div class="header">
                                    <h2>ADD</h2>
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
                                    <form name="edit" method="POST">
                                        <h2 class="card-inside-title">Username</h2>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">title</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="uname" placeholder="uname" />
                                            </div>
                                        </div>
                                        <h2 class="card-inside-title">password</h2>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">remove_red_eye</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="password" class="form-control" name="password" placeholder="password" />
                                            </div>
                                        </div>
                                        <h2 class="card-inside-title">email</h2>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">email</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="email" class="form-control" name="email" placeholder="email" />
                                            </div>
                                        </div>
                                        <h2 class="card-inside-title">User Group</h2>
                                        <div class="row clearfix">
                                            <div class="col-sm-6">
                                                <select class="form-control"  name="ugroup">
                                                    @foreach($data as $b)
                                                        <option value="{{$b->user_grp}}">{{$b->group_name}}</option>
                                                    @endforeach
                                                </select>
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
            </section>
    @stop
@stop
