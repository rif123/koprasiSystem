@extends('layouts.index')
    @section('header')
        <link href="{{ URL::asset('') }}plugins/jquery-datatable/style.css" rel="stylesheet" />
        <link href="{{ URL::asset('') }}plugins/sweetalert/sweetalert.css" rel="stylesheet" />
    @stop

    @section('content')
        @include('layouts.left')
        @include('layouts.right')
            <section class="content">

                <div class="container-fluid">
                    <div class="block-header">
                        <h2>TEAM</h2>
                    </div>
                    <div class="row clearfix">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="card">
                                <div class="header">
                                    <h2>Table Team</h2>
                                </div>
                                @if(\Session::get('success'))
                                    <div class="alert alert-success">
                                        {{\Session::get('success')}}
                                    </div>
                                @endif
                                <div style="text-align:right;padding:5px">
                                    <a href="{{url($_ENV['ADMIN_FOLDER'].'/team/add')}}">
                                        <button type="button" class="btn btn-success waves-effect">
                                           <i class="material-icons">add_box</i>
                                        </button>
                                    </a>
                                    <a href="{{url($_ENV['ADMIN_FOLDER'].'/team/setting')}}">
                                        <button type="button" class="btn btn-primary waves-effect">
                                           <i class="material-icons">settings</i>
                                        </button>
                                    </a>
                                </div>
                                <div class="body">
                                    <table class="table" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Photo</th>
                                                <th>Name</th>
                                                <th>Position</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-striped">
                                            @foreach($data as $a)
                                                <tr>
                                                    @if(file_exists(public_path().'/images/image-gallery/team/'.$a['id'].'.jpg'))
                                                        <td class="photo-team"><img src="{{asset('/images/image-gallery/team/'.$a['id'].'.jpg')}}" style="display:block;width:100%;"/></td>
                                                    @else
                                                        <td class="photo-team"><img src="{{asset('/images/image-gallery/team/avatar.jpg')}}" style="display:block;width:100%;"/></td>
                                                    @endif
                                                    
                                                    <td>{{$a['name']}}</td>
                                                    <td style="width:50%">{{$a['position']}}</td>
                                                    <td>
                                                        <a href="{{url($_ENV['ADMIN_FOLDER'].'/team/edit/'.$a['id'])}}">
                                                            <button class="btn btn-info waves-effect" type="button">
                                                                    <i class="material-icons" style="color:white">mode_edit</i>     
                                                            </button>
                                                        </a>
                                                        <a href="{{url($_ENV['ADMIN_FOLDER'].'/team/delete/'.$a['id'])}}" class="alertButton">
                                                            <button class="btn bg-red waves-effect" type="button">
                                                                    <i class="material-icons">delete</i>                  
                                                            </button>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {!! $data->render() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
    @stop
@stop
