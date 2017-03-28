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
                        <h2>TESTIMONIAL</h2>
                    </div>
                    <div class="row clearfix">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="card">
                                <div class="header">
                                    <h2>Table Testimonial</h2>
                                </div>
                                @if(\Session::get('success'))
                                    <div class="alert alert-success">
                                        {{\Session::get('success')}}
                                    </div>
                                @endif
                                <div style="text-align:right;padding:5px">
                                    <a href="{{url($_ENV['ADMIN_FOLDER'].'/testimonial/add')}}">
                                        <button type="button" class="btn btn-success waves-effect">
                                           <i class="material-icons">add_box</i>
                                        </button>
                                    </a>
                                    <a href="{{url($_ENV['ADMIN_FOLDER'].'/testimonial/setting')}}">
                                        <button type="button" class="btn btn-primary waves-effect">
                                           <i class="material-icons">settings</i>
                                        </button>
                                    </a>
                                </div>
                                <div class="body">
                                    <table class="table" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Active</th>
                                                <th>Name</th>
                                                <th>Customer Status</th>
                                                <th>Testimonial</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-striped">
                                            @foreach($data as $a)
                                                <tr>
                                                    <td style="text-align:center"><input class="filled-in chk-col-cyan" name="active[]" type="checkbox" id="a{{$a['id']}}" value="{{$a['id']}}" {{$a['active'] == 1? "checked": ''}} disabled/> <label for="a{{$a['id']}}" style="color:white">{{$a['active'] == 1? 1: 0}}</label></td>                             
                                                    <td>{{$a['customer_name']}}</td>
                                                    <td>{{$a['customer_status']}}</td>
                                                    <td style="width:50%">{!! \Illuminate\Support\Str::words($a['testimoni'], 8,'....')  !!}</td>
                                                    <td>
                                                        <a href="{{url($_ENV['ADMIN_FOLDER'].'/testimonial/edit/'.$a['id'])}}">
                                                            <button class="btn btn-info waves-effect" type="button">
                                                                    <i class="material-icons" style="color:white">mode_edit</i>     
                                                            </button>
                                                        </a>
                                                        <a href="{{url($_ENV['ADMIN_FOLDER'].'/testimonial/delete/'.$a['id'])}}" class="alertButton">
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
