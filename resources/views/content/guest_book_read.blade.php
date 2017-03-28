
         <!--   <h2 class="card-inside-title">Name :{{$data->name}}</h2>
            <h2 class="card-inside-title">Email:{{$data->email}}</h2>
            <h2 class="card-inside-title">phone:{{$data->phone}}</h2>
            <h2 class="card-inside-title">date:{{$data->date}}</h2>
            <h2 class="card-inside-title">Massage :</h2>
            <h2>{{$data->message}}</h2> -->
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
                        <h2><a href="/{{$_ENV['ADMIN_FOLDER'].''}}"> DASHBOARD </a> >> <a href="/{{$_ENV['ADMIN_FOLDER'].'/guest_book'}}">GUEST BOOK </a> >> SHOW </h2>
                    </div>
                    <div class="row clearfix">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="card">
                                <div class="header">
                                    <h2>GUEST BOOK</h2>
                                <div class="body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs tab-nav-right" role="tablist">
                                <li role="presentation" class="active"><b>NAME :</b> {{$data->name}}</li>
                            </ul>
                            <ul class="nav nav-tabs tab-nav-right" role="tablist">
                                <li role="presentation" class="active"><b>EMAIL :</b> {{$data->email}}</li>
                            </ul>
                            <ul class="nav nav-tabs tab-nav-right" role="tablist">
                                <li role="presentation" class="active"><b>PHONE :</b> {{$data->phone}}</li>
                            </ul>
                            <ul class="nav nav-tabs tab-nav-right" role="tablist">
                                <li role="presentation" class="active"><b>DATE :</b> {{Date('d M Y',$data->date)}}</li>
                            </ul>	
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="home">
                                    <b>Message :</b>
                                    <p>
                                     {{$data->message}}   
                                    </p>
                                </div>
                               
                            </div>
                      
                                                        <a href="/{{$_ENV['ADMIN_FOLDER'].'/guest_book/delete/'.$data['id']}}" class="alertButton">
                                                            <button class="btn bg-red waves-effect" type="button">
                                                                    <i class="material-icons">delete</i>                  
                                                            </button>
                                                        </a>
                                                   
                                            
                                        
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
    @stop
@stop
