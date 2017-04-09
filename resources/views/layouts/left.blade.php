<body class="theme-red">
        <!-- Top Bar -->
        <nav class="navbar">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                    <a href="javascript:void(0);" class="bars"></a>
                    <a class="navbar-brand" href="{{url($_ENV['ADMIN_FOLDER'])}}">ADMIN</a>
                </div>
            </div>
        </nav>
        <!-- #Top Bar -->
        <section>
            <aside id="leftsidebar" class="sidebar">
                <!-- User Info -->
                <div class="user-info">
                    <div class="image">
                        <img src="{{asset('images/user.png')}}" width="48" height="48" alt="User" />
                    </div>
                    <div class="info-container">
                        <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{Auth::user()['uname']}}</div>
                        <div class="email">{{Auth::user()['email']}}</div>
                        <div class="btn-group user-helper-dropdown">
                            <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="{{url($_ENV['ADMIN_FOLDER'].'/setting/profile')}}"><i class="material-icons">person</i>Profile</a></li>
                                <li role="seperator" class="divider"></li>
                                <li role="seperator" class="divider"></li>
                                <li><a href="{{url($_ENV['ADMIN_FOLDER'].'/logout')}}"><i class="material-icons">input</i>Sign Out</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- #User Info -->

                <div class="menu">
                    <ul class="list">
                        @foreach(Helpers::getMenu() as $key => $value)

                            @if(!empty($value['child']))
                                <li>
                                    <a href="javascript:void(0);" class="menu-toggle">
                                       <i class="material-icons">
                                           @if(!empty($value['icon_menu']))
                                                {{$value['icon_menu']}}
                                           @else
                                                list
                                           @endif
                                       </i>
                                       <span>{{$value['name_menu']}}</span>
                                   </a>
                                    <ul class="ml-menu">
                                        <?php echo Helpers::printRecursiveList($value['child']) ?>
                                    </ul>
                                </li>
                            @else
                                <li>
                                    <a href="{{ url($value['url_menu']) }}">
                                       <i class="material-icons">
                                           @if(!empty($value['icon_menu']))
                                                {{$value['icon_menu']}}
                                           @else
                                                list
                                           @endif
                                       </i>
                                       <span>{{$value['name_menu']}}</span>
                                   </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </aside>
