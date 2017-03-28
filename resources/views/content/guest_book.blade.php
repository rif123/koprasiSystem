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
                        <h2><a href="/{{$_ENV['ADMIN_FOLDER'].''}}">DASHBOARD </a> >>GUEST BOOK </h2>
                    </div>
                    <div class="row clearfix">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="card">
                                <div class="header">
                                    <h2>GUEST BOOK</h2>
                                <div class="body">
                                    
                                    <table class="table" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Status</th>
                                                <th>Date</th>
                                                <th>action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-striped">
                                            @foreach($data as $a)
                                                @if($a['has_read'] == '0')
                                                    <tr style="color:red">
                                                @else    
                                                    <tr>
                                                @endif    
                                                    <td>{{$a['name']}}</td>
                                                    <td>{{$a['email']}}</td>
                                                    <td>{{$a['phone']}}</td>
                                                    @if($a['has_read'] == '0')
                                                        <td>Unread</td>
                                                    @else    
                                                        <td>Read</td>
                                                    @endif  
                                                    <td>{{Date('d M Y',$a['date'])}}</td>
                                                    <td>
                                                        <a href="/{{$_ENV['ADMIN_FOLDER'].'/guest_book/delete/'.$a['id']}}" class="alertButton">
                                                            <button class="btn bg-red waves-effect" type="button">
                                                                    <i class="material-icons">delete</i>                  
                                                            </button>
                                                        </a>
                                                          <a href="/{{$_ENV['ADMIN_FOLDER'].'/guest_book_read/'.$a['id']}}">
                                                            <button type="button" class="btn btn-primary  waves-effect">
                                                                    <i class="material-icons">remove_red_eye</i>                
                                                            </button>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
    @stop
@stop
