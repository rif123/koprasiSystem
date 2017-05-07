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
                    
                    </div>
                    <div class="row clearfix">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="card">
                                <div class="header">
                                    <h2>Table Post</h2>
                                </div>
                                @if(\Session::get('success'))
                                    <div class="alert alert-success">
                                        {{\Session::get('success')}}
                                    </div>
                                @endif
                                <div style="text-align:right;padding:5px">
                                    <a href="{{url($_ENV['ADMIN_FOLDER'].'/post/add')}}">
                                        <button type="button" class="btn btn-success waves-effect">
                                           <i class="material-icons">add_box</i>
                                        </button>
                                    </a>
                                    <a href="{{url($_ENV['ADMIN_FOLDER'].'/post/setting')}}">
                                        <button type="button" class="btn btn-primary waves-effect">
                                           <i class="material-icons">settings</i>
                                        </button>
                                    </a>
                                </div>
                                <div class="body">
                                    <table class="table" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Title</th>
                                                <th>Publish Date</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-striped">
                                            @foreach($data as $a)
                                                <tr>
                                                    <td>{{$a->title}}</td>
                                                    <td>{{date('d M y',$a->date)}}</td>
                                                    <td>{{$a->active == 1? 'Publish': 'Draft'}}</td>
                                                    <td>
                                                        <a href="{{url($_ENV['ADMIN_FOLDER'].'/post/edit/'.$a->id)}}">
                                                            <button class="btn btn-info waves-effect" type="button">
                                                                    <i class="material-icons" style="color:white">mode_edit</i>
                                                            </button>
                                                        </a>
                                                        <a href="{{url($_ENV['ADMIN_FOLDER'].'/post/delete/'.$a->id)}}" class="alertButton">
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
