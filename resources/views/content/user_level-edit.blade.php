@extends('layouts.index')
@section('js')
        <script>
    function Check(frm,selectControl){
      var checkBoxes = frm.elements['rules[]'];
      for (i = 0; i < checkBoxes.length; i++){
        checkBoxes[i].checked = (selectControl.innerHTML == "Select All") ? 'checked' : '';
      }
      selectControl.innerHTML = (selectControl.innerHTML == "Select All") ? "Unselect All" : 'Select All';
    }

    window.onload = function(){
      var selectControl = document.getElementById("all");
      selectControl.onclick = function(){Check(document.edit,selectControl)};
    };
  </script>

    @stop
@section('header')
    <style type="text/css">
        .pjg{
            width: 30%;
        }
        
    </style>

    @stop
    @section('content')
        @include('layouts.left')
        @include('layouts.right')
    <section class="content">
                <div class="container-fluid">
                    <div class="block-header">
                        <h2><A href="{{url($_ENV['ADMIN_FOLDER'].'/user_level')}}">USER LEVEL</a> >  EDIT</h2>
                    </div>
                    <div class="row clearfix">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="card">
                                <div class="header">
                                    <h2>Edit : {{$level_name}}</h2>
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
                                        <h2 class="card-inside-title">Name</h2>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">title</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="name" value="{{$level_name}}" placeholder="Name" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <h2 class="card-inside-title">Authorize</h2>
                                            <div>
                                                <label for="all" id="all">Select All</label>
                                                <input type="checkbox" id="all" >
                                            </div>
                                             @foreach($data as $a)
                                                @if(in_array($a->url_slug,$rules))
                                                    <input id="{{$a->name}}" type="checkbox" name="rules[]" value="{{$a->url_slug}}" class="pjg" checked>
                                                @else
                                                    <input id="{{$a->name}}" type="checkbox" name="rules[]" class="pjg" value="{{$a->url_slug}}">
                                                @endif
                                                <label class="pjg" for="{{$a->name}}">{{$a->name}}</label>
                                            @endforeach     
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
