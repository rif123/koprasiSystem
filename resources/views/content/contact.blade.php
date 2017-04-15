@extends('layouts.index')
    @section('header')
         <link href="{{ URL::asset('') }}fe/fonts/font-awesome/css/font-awesome.css" rel="stylesheet"/>
    @stop

    @section('content')
    @include('layouts.left')
    @include('layouts.right')
        <section class="content">

  <!-- Modal Structure -->
  <div id="modal1" class="modal">
    <div class="modal-content">
      <h4>Modal Header</h4>
      <p>A bunch of text</p>
    </div>
    <div class="modal-footer">
      <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Agree</a>
    </div>
  </div>

            <div class="container-fluid">
                <div class="block-header">
                    <h2>Contact</h2>
                </div>
                <div class="row clearfix">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="header">
                                <h2>Contact Info</h2>
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
                                        <h2 class="card-inside-title">Location</h2>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">location_on</i>
                                            </span>
                                            
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="location" value="{{$data->location}}" />
                                            </div>
                                        </div>
                                        <h2 class="card-inside-title">Phone</h2>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">phone</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="phone" value="{{$data->phone}}" />
                                            </div>
                                        </div>
                                            <h2 class="card-inside-title">Fax</h2>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                               <i class="material-icons">chrome_reader_mode</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="fax" value="{{$data->fax}}" />
                                            </div>
                                        </div>
                                            <h2 class="card-inside-title">Email</h2>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                              <i class="material-icons">email</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="email" value="{{$data->email}}" />
                                            </div>
                                        </div>
                                            <h2 class="card-inside-title">Web</h2>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                               <i class="material-icons">web_asset</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="web" value="{{$data->web}}" />
                                            </div>
                                       
                                        </div>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div style="text-align:center">
                                            <button type="Submit" class="btn btn-primary btn-lg m-l-15 waves-effect">Edit</button>
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
