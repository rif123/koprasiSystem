@extends('layouts.index')
@section('content')
@include('layouts.left')
@include('layouts.right')


<section class="content">
    <div class="container-fluid">
        <div class="card">
        <div class="header">
            <h2>
                FORM GROUP
                <small>(isi dengan lengkap & jelas)</small>
            </h2>
        </div>
        <div class="row clearfix">
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                <div class="body">
                    <form id="form-menu-group" action="{{url(route('config.menuSave'))}}" method="post" enctype="multipart/form-data">
                        {!! Form::token() !!}
                        <div class="row clearfix">
                            <h2 class="card-inside-title group-title">Group Name</h2>
                            <div class="col-md-12">
                                <div class="input-group">
                                    <div class="form-line">
                                        <input type="text" name="group_name" class="form-control date" placeholder="Nama Menu">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-md-12">
                                <div class="input-group btn-process">
                                    <button type="button" class="btn btn-primary waves-effect btn-save-group">SAVE</button>
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
                              <th>#</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach($list  as $key => $value)
                              <tr>
                                  <th>{{$value->group_name}}</th>
                                  <th>
                                      <button type="button" class="btn bg-blue-grey waves-effect edit-group" data-id-grp="{{$value->user_grp}}" >EDIT</button>
                                      <button type="button" class="btn btn-danger waves-effect delete-group"  data-id-grp="{{$value->user_grp}}">DELETE</button>
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
    var urlSave = "{{url(route('config.groupSave'))}}";
    var urlShow = "{{url(route('config.groupShow'))}}";
    var urlEditGroup = "{{url(route('config.groupEdit'))}}";
    var urlDeleteGroup = "{{url(route('config.groupDelete'))}}";
</script>
@stop
@stop
