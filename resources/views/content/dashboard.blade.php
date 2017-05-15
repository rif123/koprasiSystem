@extends('layouts.index')
    @section('content')
    @include('layouts.left')
    @include('layouts.right')
        <section class="content">
            <div class="container-fluid">
                <div class="block-header">

                </div>
                <!-- Widgets -->
                <div class="row clearfix">
                    @if ( \Session::get('user_grp') != 5)
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <a href="/{{$_ENV['ADMIN_FOLDER'].'/post'}}" style="text-decoration:none">
                            <div class="info-box bg-pink hover-expand-effect" style="cursor:pointer">
                                <div class="icon">
                                    <i class="material-icons">receipt</i>
                                </div>
                                <div class="content">
                                    <div class="text">POST</div>
                                    <div class="number count-to" data-from="0" data-to="{{$post->count()}}" data-speed="15" data-fresh-interval="20">{{$post->count()}}</div>
                                </div>
                            </div>
                        </a>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                             <a href="/{{$_ENV['ADMIN_FOLDER'].'/project'}}" style="text-decoration:none">
                            <div class="info-box bg-cyan hover-expand-effect" style="cursor:pointer">
                                <div class="icon">
                                    <i class="material-icons">speaker_notes</i>
                                </div>
                                <div class="content">
                                    <div class="text">PROJECT</div>
                                    <div class="number count-to" data-from="0" data-to="{{$project->count()}}" data-speed="1000" data-fresh-interval="20">{{$project->count()}}</div>
                                </div>
                            </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <a href="/{{$_ENV['ADMIN_FOLDER'].'/guest_book'}}" style="text-decoration:none">
                            <div class="info-box bg-light-green hover-expand-effect" style="cursor:pointer">
                                <div class="icon">
                                    <i class="material-icons">forum</i>
                                </div>
                                <div class="content">
                                    <div class="text">NEW MESSAGE</div>
                                    <div class="number count-to" data-from="0" data-to="{{$data->count()}}" data-speed="1000" data-fresh-interval="20">{{$data->count()}}</div>
                                </div>
                            </div>
                                    </a>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                             <a href="/{{$_ENV['ADMIN_FOLDER'].'/team'}}" style="text-decoration:none">
                            <div class="info-box bg-orange hover-expand-effect" style="cursor:pointer">
                                <div class="icon">
                                    <i class="material-icons">person_add</i>
                                </div>
                                <div class="content">
                                    <div class="text">TEAM</div>
                                    <div class="number count-to" data-from="0" data-to="{{$team->count()}}" data-speed="1000" data-fresh-interval="20">{{$team->count()}}</div>
                                </div>
                            </div>
                            </a>
                        </div>
                    @endif

                    @if ( \Session::get('user_grp') == 5)
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <a href="{{url('admin/profile')}}" style="text-decoration:none">
                            <div class="info-box bg-pink hover-expand-effect" style="cursor:pointer">
                                <div class="icon">
                                    <i class="material-icons">receipt</i>
                                </div>
                                <div class="content">
                                    <div class="text">PROFILE</div>
                                    <div class="number count-to" data-from="0" data-to="{{$post->count()}}" data-speed="15" data-fresh-interval="20">-</div>
                                </div>
                            </div>
                        </a>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                             <a  href="{{url('admin/simpan-wajib')}}"  style="text-decoration:none">
                            <div class="info-box bg-cyan hover-expand-effect" style="cursor:pointer">
                                <div class="icon">
                                    <i class="material-icons">speaker_notes</i>
                                </div>
                                <div class="content">
                                    <div class="text">SIMPANAN</div>
                                    <div class="number count-to" data-from="0" data-to="{{$project->count()}}" data-speed="1000" data-fresh-interval="20">{{$sumSwajib}}</div>
                                </div>
                            </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <a href="{{url('admin/keuangan/income')}}"  style="text-decoration:none">
                            <div class="info-box bg-light-green hover-expand-effect" style="cursor:pointer">
                                <div class="icon">
                                    <i class="material-icons">forum</i>
                                </div>
                                <div class="content">
                                    <div class="text">KEUANGAN</div>
                                    <div class="number count-to" data-from="0" data-to="{{$data->count()}}" data-speed="1000" data-fresh-interval="20">{{$data->count()}}</div>
                                </div>
                            </div>
                            </a>
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <a href="#"  style="text-decoration:none">
                            <div class="info-box bg-orange hover-expand-effect" style="cursor:pointer">
                                <div class="icon">
                                    <i class="material-icons">forum</i>
                                </div>
                                <div class="content">
                                    <div class="text">News</div>
                                    <div class="number count-to" data-from="0" data-to="{{$news}}" data-speed="1000" data-fresh-interval="20">{{$news}}</div>
                                </div>
                            </div>
                            </a>
                        </div>
                    @endif

                </div>
                <!-- #END# Widgets -->
                <!-- CPU Usage -->
            @if( \Session::get('user_grp') != 5)
                <div class="row clearfix">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                        <div class="card">
                            <div class= "header">
                                <h2>FAST LINK</h2>
                            </div>

                            <div class="body">
                            <div class="    row clearfix">

                            @if( \Session::get('rules') == '1')
                                <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
                                    <a href="{{$_ENV['ADMIN_FOLDER'].'/carousel/add'}}">
                                    <button class="btn btn-success btn-lg btn-block waves-effect" type="button">ADD SLIDE </button>
                                    </a>
                                </div>
                            @endif

                            @if( \Session::get('rules') == '1')
                                <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
                                    <a href="{{$_ENV['ADMIN_FOLDER'].'/post/add'}}">
                                    <button class="btn btn-primary btn-lg btn-block waves-effect" type="button">ADD POST</button>
                                    </a>
                                </div>
                            @endif
                            @if(\Session::get('rules') == '1')
                                <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
                                    <a href="{{$_ENV['ADMIN_FOLDER'].'/process_text/add'}}">
                                    <button class="btn bg-purple btn-lg btn-block waves-effect" type="button">ADD PROCESS TEXT</button>
                                    </a>
                                </div>
                            @endif
                            @if(\Session::get('rules') == '1')
                                <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
                                    <a href="{{$_ENV['ADMIN_FOLDER'].'/project/add'}}">
                                        <button class="btn btn-danger btn-lg btn-block waves-effect" type="button">ADD PROJECT</button>
                                    </a>
                                </div>
                            @endif
                            @if(\Session::get('rules') == '1')
                                <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
                                    <a href="{{$_ENV['ADMIN_FOLDER'].'/project/category/add'}}">
                                    <button class="btn btn-warning btn-lg btn-block waves-effect" type="button">ADD PROJECT CATEGORY</button>
                                    </a>
                                </div>
                            @endif
                            @if(\Session::get('rules') == '1')
                                <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
                                    <a href="{{$_ENV['ADMIN_FOLDER'].'/skill/add'}}">
                                    <button class="btn bg-pink btn-lg btn-block waves-effect" type="button">ADD SKILL</button>
                                    </a>
                                </div>
                            @endif
                            @if((\Session::get('rules') == '1')  )
                                <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
                                    <a href="{{$_ENV['ADMIN_FOLDER'].'/team/add'}}">
                                    <button class="btn bg-teal btn-lg btn-block waves-effect" type="button">ADD TEAM</button>
                                    </a>
                                </div>
                            @endif
                            @if(\Session::get('rules') == '1')
                                <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
                                    <a href="{{$_ENV['ADMIN_FOLDER'].'/testimonial/add'}}">
                                    <button class="btn bg-cyan btn-lg btn-block waves-effect" type="button">ADD TESTIMONIAL</button>
                                    </a>
                                </div>
                            @endif
                            @if(\Session::get('rules') == '1' )
                                 <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
                                    <a href="{{$_ENV['ADMIN_FOLDER'].'/setting'}}">
                                    <button class="btn bg-purple btn-lg btn-block waves-effect" type="button">SETTING GENERAL</button>
                                    </a>
                                </div>
                            @endif
                            @if(\Session::get('rules') == '1')
                                <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
                                    <a href="{{$_ENV['ADMIN_FOLDER'].'/setting/footer'}}">
                                    <button class="btn btn-success btn-lg btn-block waves-effect" type="button">SETTING FOOTER TEXT </button>
                                    </a>
                                </div>
                            @endif
                            @if(\Session::get('rules') == '1')
                                <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
                                    <a href="{{$_ENV['ADMIN_FOLDER'].'/setting/footer/social'}}">
                                    <button class="btn btn-primary btn-lg btn-block waves-effect" type="button">SETTING FOOTER SOCIAL</button>
                                    </a>
                                </div>
                            @endif
                            @if(\Session::get('rules') == '1')
                                <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
                                    <a href="{{$_ENV['ADMIN_FOLDER'].'/setting/location'}}">
                                    <button class="btn bg-blue btn-lg btn-block waves-effect" type="button">SETTING LOCATION</button>
                                    </a>
                                </div>
                            @endif
                            @if(\Session::get('rules') == '1')
                                  <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
                                    <a href="{{$_ENV['ADMIN_FOLDER'].'/setting/profile'}}">
                                        <button class="btn btn-danger btn-lg btn-block waves-effect" type="button">SETTING PROFIL</button>
                                    </a>
                                  </div>
                            @endif
                            @if(\Session::get('rules') == '1')
                                 <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
                                    <a href="{{$_ENV['ADMIN_FOLDER'].'/contact'}}">
                                    <button class="btn btn-warning btn-lg btn-block waves-effect" type="button">SETTING CONTACT INFO</button>
                                    </a>
                                </div>
                            @endif
                            @if(\Session::get('rules') == '1' )
                                 <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
                                    <a href="{{$_ENV['ADMIN_FOLDER'].'/config/controll-Pay'}}">
                                    <button class="btn btn-warning btn-lg btn-block waves-effect" type="button">CONTROLL PAYMENT</button>
                                    </a>
                                </div>
                            @endif

                            </div>
                        </div>
                            <div id="real_time_chart" class="dashboard-flot-chart"></div>
                        </div>

                    </div>
                </div>
                @else
                <!-- Basic Card -->

                   <div class="row clearfix">
                       @foreach($listNews as $key => $val)
                       <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 showDetail">
                           <div class="card">
                               <div class="header">
                                   <h2>{{$val->judul_news}}</h2>
                                   <small><?php echo date("d M Y", strtotime($listNews[0]->tanggal_news)) ?></small>
                               </div>
                               <div class="body">
                                  <?php echo strip_tags(substr($val->description_news, 0, 100)) ."..";  ?>
                               </div>
                               <center>
                                   <a href="{{url('/admin/detail')}}?id={{$val->id_news}}" class="btn btn-warning waves-effect">
                                      load more ...
                                    </a>
                               </center>
                               <br />
                           </div>
                       </div>
                       @endforeach
                   </div>

       <!-- #END# Basic Card -->
                @endif
                <!-- #END# CPU Usage -->
                </div>
        </section>
    @stop
@stop
