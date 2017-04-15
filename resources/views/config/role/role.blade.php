@extends('layouts.index')
@section('content')
@include('layouts.left')
@include('layouts.right')


<section class="content">
    <div class="container-fluid">
        <div class="card">
        <div class="header">
            <h2>
                FORM ROLE
                <small>(isi dengan lengkap & jelas)</small>
            </h2>
        </div>
            <form id="form-menu-role" action="{{url(route('config.menuSave'))}}" method="post" enctype="multipart/form-data">
        <div class="row clearfix">
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                <div class="body">
                    <!-- Vertical Layout -->
                        {!! Form::token() !!}
                       <div class="row clearfix">
                           <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                   <label for="email_address">User Group</label>
                                   <div class="form-group">
                                       <div class="form-line">
                                           <select class="form-control" name="group_name">
                                               <option value=""> ----- </option>
                                               @foreach($listGroup as $key => $val)
                                                    <option value="{{$val->user_grp}}">{{$val->group_name}}</option>
                                               @endforeach
                                           </select>
                                       </div>
                                   </div>
                                   <br>
                                   <button type="button" class="btn btn-primary waves-effect btn-save-role">SAVE</button>
                           </div>
                       </div>

                </div>
            </div> <!-- enf form -->
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 menu-left-list">
                @include('config.role.roleMenu')
            </div>
        </div>
        </form>
    </div>
    <style>
        h2.group-title{
            margin-left:15px
        }
        [type="checkbox"]:not(:checked), [type="checkbox"]:checked {
            position: relative !important;
            left: 0px !important;
            opacity: 1 !important;
        }
    </style>
</section>
<div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">Modal title</h4>
                        </div>
                        <div class="modal-body">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin sodales orci ante, sed ornare eros vestibulum ut. Ut accumsan
                            vitae eros sit amet tristique. Nullam scelerisque nunc enim, non dignissim nibh faucibus ullamcorper.
                            Fusce pulvinar libero vel ligula iaculis ullamcorper. Integer dapibus, mi ac tempor varius, purus
                            nibh mattis erat, vitae porta nunc nisi non tellus. Vivamus mollis ante non massa egestas fringilla.
                            Vestibulum egestas consectetur nunc at ultricies. Morbi quis consectetur nunc.
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                        </div>
                    </div>
                </div>
            </div>
<script>
    var urlEditMenuSelected = "{{url(route('config.reloadMenu'))}}";
    var urlEditUserGroup = "{{url(route('config.editGroup'))}}";
</script>
@stop
@stop
