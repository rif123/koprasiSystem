@extends('layouts.index')
    @section('header')
        <link href="{{ URL::asset('') }}plugins/jquery-datatable/style.css" rel="stylesheet" />
        <link href="{{ URL::asset('') }}plugins/sweetalert/sweetalert.css" rel="stylesheet" />
        <script type="text/javascript">
        function chk(ele){
            var chk = document.getElementsByName("chk[]");
            for(var i=0;i<chk.length;i++){
                chk[i].checked = ele.checked;
            }

            chk1(ele);
        }

        function chk1(ele){
            var chk = document.getElementsByName("chk[]");
            var a=0;
            for(var i=0;i<chk.length;i++){
                if(chk[i].checked) a+=1;
            }

            if(a>0){
                document.getElementById("delete").style.display = "block";
            }
            else{
                document.getElementById("delete").style.display = "none";
            }
        }
        </script>
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
                                    <h2>Media Manager</h2>
                                </div>
                                @if(\Session::get('success'))
                                    <div class="alert alert-success">
                                        {{\Session::get('success')}}
                                    </div>
                                @endif
                                @if (\Session::get('error'))
                                    <div class="alert alert-danger">
                                        {{\Session::get('error')}}
                                    </div>
                                @endif

                                <div class="body">
                                <form method="post" action="mediamanager/deletegroup">
                                            <span id="delete" style="display:none;position:fixed;z-index:99;right:40%;bottom:20%;"><button class="btn bg-red waves-effect" style="border-radius: 15px;" type="submit">
                                              <i class="material-icons">delete</i>
                                            </button></span>
                                    <table class="table" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th style="width:5%"><input type="checkbox" name="ch" onChange="chk(this)" id="all"/><label for="all"></label></th>
                                                <th>Photo</th>
                                                <th>Name</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-striped">
                                            @foreach($data as $a)
                                                <tr>
                                                    <td><input type="checkbox" name="chk[]" onChange="chk1(this)" value="{{$a['id']}}" id="{{$a['id']}}"/><label for="{{$a['id']}}"></label></td>
                                                    @if(file_exists(public_path().'/images/image-gallery/'.$a['id']))
                                                        <td class="photo-team"><img src="{{asset('images/image-gallery/'.$a['id'])}}" style="display:block;width:100%;"/></td>
                                                    @endif
                                                    <td>{{$a['id']}}</td>
                                                    <td>
                                                        <a href="{{url($_ENV['ADMIN_FOLDER'].'/mediamanager/delete/'.urlencode($a['id']))}}" class="alertButton">
                                                            <button class="btn bg-red waves-effect" type="button">
                                                                    <i class="material-icons">delete</i>
                                                            </button>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
    @stop
@stop
