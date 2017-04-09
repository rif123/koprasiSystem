@extends('layouts.index')
@section('content')
@include('layouts.left')
@include('layouts.right')
<section class="content">
    <div class="container-fluid">
        <div class="card">
        <div class="header">
            <h2>
                FORM MENU
                <small>(isi dengan lengkap & jelas)</small>
            </h2>
        </div>
        <div class="row clearfix">
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                <div class="body">
                    <form id="form-menu" action="{{url(route('config.menuSave'))}}" method="post" enctype="multipart/form-data">
                        {!! Form::token() !!}
                        <div class="row clearfix">
                            <h2 class="card-inside-title group-title">Menu Name</h2>
                            <div class="col-md-12">
                                <div class="input-group">
                                    <div class="form-line">
                                        <input type="text" name="name_menu" class="form-control date" placeholder="Nama Menu">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <h2 class="card-inside-title group-title">Url / Link</h2>
                            <div class="col-md-12">
                                <div class="input-group">
                                    <div class="form-line">
                                        <input type="text" name="url_menu" class="form-control date" placeholder="URL / Link">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <h2 class="card-inside-title group-title">Parent</h2>
                            <div class="col-md-12">
                                <div class="input-group">
                                    <div class="form-line">
                                        <input type="text" name="parent_menu_name" class="form-control date " id="parent_menu_name" placeholder="Parent" onClick="getAllMenu()">

                                        <input type="hidden" name="parent_menu" class="form-control date " id="parent_menu" placeholder="Parent" onClick="getAllMenu()" value="0">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <h2 class="card-inside-title group-title">Icon</h2>
                            <div class="col-md-12">
                                <div class="input-group">
                                    <div class="form-line">
                                        <input type="text" name="icon_menu_name" class="form-control date " id="icon_menu_name" placeholder="Parent" onClick="getAllMenuIcon()">
                                        <input type="hidden" name="icon_menu" class="form-control date " id="icon_menu" placeholder="Parent" value="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-md-12">
                                <div class="input-group">
                                    <button type="submit" class="btn btn-primary waves-effect btn-save">SAVE</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div> <!-- enf form -->
            <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                <div class="body">
                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                      <thead>
                          <tr>
                              <th>Name</th>
                              <th>Url</th>
                              <th>Parent</th>
                              <th>Icon</th>
                              <th>#</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach($listMenu  as $key => $value)
                              <tr>
                                  <th>{{$value->name_menu}}</th>
                                  <th>{{$value->url_menu}}</th>
                                  <th>{{$value->parent_menu}}</th>
                                  <th><i class="material-icons">{{$value->icon_menu}}</i> </th>
                                  <th>
                                      <button type="button" class="btn bg-blue-grey waves-effect edit-menu" data-name-menu="{{$value->name_menu}}" data-id-menu="{{$value->id_menu}}" data-parent-menu="{{$value->parent_menu}}"  data-url-menu="{{$value->url_menu}}" data-icon-menu="{{$value->icon_menu}}" >EDIT</button>
                                      <button type="button" class="btn btn-danger waves-effect delete-menu"  data-id-menu="{{$value->id_menu}}">DELETE</button>
                                  </th>
                              </tr>
                          @endforeach
                      </tbody>
                  </table>
                </div>
            </div>
        </div>
    </div>
    <style>
        h2.group-title{
            margin-left:15px
        }
    </style>
</section>
<script>
    var urlUpdate = "{{url(route('config.menuUpdate'))}}";
    var urlDelete = "{{url(route('config.menuDestroy'))}}";
    var urlShowMenu = "{{url(route('config.menuShowAll'))}}";
    var urlShowMenuIcon = "{{url(route('config.menuIcon'))}}";
</script>
@stop
@stop
