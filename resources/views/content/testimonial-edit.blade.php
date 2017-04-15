@extends('layouts.index')
    @section('content')
        @include('layouts.left')
        @include('layouts.right')
    <section class="content">
                <div class="container-fluid">
                    <div class="block-header">
                        <h2><A href="{{url($_ENV['ADMIN_FOLDER'].'/testimonial')}}">TESTIMONIAL</a> >  EDIT</h2>
                    </div>
                    <div class="row clearfix">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="card">
                                <div class="header">
                                    <h2>Edit : {{$customer_name}}</h2>
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
                                        <h2 class="card-inside-title">Customer Name</h2>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">person</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="name" value="{{$customer_name}}" placeholder="Name" />
                                            </div>
                                        </div>
                                        <h2 class="card-inside-title">Customer Status</h2>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">card_travel</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="position" value="{{$customer_status}}" placeholder="Position in job" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <h2 class="card-inside-title">Testimonial</h2>
                                            <div class="form-line">
                                                <textarea name="testimonial" class="form-control" placeholder="Description..">{{$testimoni}}</textarea>
                                            </div>
                                        </div>
                                        <h2 class="card-inside-title">Active?</h2>
                                        <div class="switch">
                                            <label>No<input name="active" type="checkbox" {{$active == '1'? 'checked':''}}><span class="lever"></span>Yes</label>
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
