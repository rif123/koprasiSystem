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
            <!-- Left Sidebar -->
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
                <!-- Menu -->
                <div class="menu">
                    <ul class="list">
                        <li class="header">MAIN NAVIGATION</li>
                        <li class="active">
                            <a href="{{$_ENV['ADMIN_FOLDER'].''}}">
                                <i class="material-icons">home</i>
                                <span>Home</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{url(route('profile.index'))}}">
                                <i class="material-icons">home</i>
                                <span>Profile</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{url('/')}}">
                                <i class="material-icons">home</i>
                                <span>E-doc</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{url('/')}}">
                                <i class="material-icons">home</i>
                                <span>Simpan Anggota</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{url('/')}}">
                                <i class="material-icons">home</i>
                                <span>Keuangan Anggota</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{url('/')}}">
                                <i class="material-icons">home</i>
                                <span>Info</span>
                            </a>
                        </li>

                        @if((\Session::get('rules') == '1') || (in_array("admin/fe", \Session::get('rules'))))
                        <li>
                            <a href="{{url($_ENV['ADMIN_FOLDER'].'/fe')}}">
                                <i class="material-icons">dashboard</i>
                                <span>Frontend Manager</span>
                            </a>
                        </li>
                        @endif
                        @if((\Session::get('rules') == '1') || (in_array("admin/guest_book_read", \Session::get('rules'))) || (in_array("admin/guest_book/delete", \Session::get('rules'))))
                        <li>
                            <a href="{{url($_ENV['ADMIN_FOLDER'].'/guest_book')}}">
                                <i class="material-icons">library_books</i>
                                <span>Guest Book</span>
                            </a>
                        </li>
                        @endif
                        @if((\Session::get('rules') == '1') || (in_array("admin/mediamanager/delete", \Session::get('rules'))))
                        <li>
                            <a href="{{url($_ENV['ADMIN_FOLDER'].'/mediamanager')}}">
                                <i class="material-icons">perm_media</i>
                                <span>Media</span>
                            </a>
                        </li>
                        @endif
                        @if((\Session::get('rules') == '1') || (in_array("admin/user/add", \Session::get('rules'))) || (in_array("admin/user/add", \Session::get('rules'))) || (in_array("admin/user/edit", \Session::get('rules'))) || (in_array("admin/user_level/add", \Session::get('rules'))) || (in_array("admin/user_level/add", \Session::get('rules')) || (in_array("admin/user_level/edit", \Session::get('rules')))))
                         <li>
                            <a href="javascript:void(0);" class="menu-toggle">
                                <i class="material-icons">accessibility</i>
                                <span>User</span>
                            </a>
                            <ul class="ml-menu">
                                @if((\Session::get('rules') == '1') || (in_array("admin/user/add", \Session::get('rules'))) || (in_array("admin/user/add", \Session::get('rules'))) || (in_array("admin/user/edit", \Session::get('rules'))))
                                <li>
                                    <a href="{{url($_ENV['ADMIN_FOLDER'].'/user')}}">
                                        <i class="material-icons">person</i>
                                    <span>User</span>
                                    </a>
                                </li>
                                @endif
                                @if((\Session::get('rules') == '1') || (in_array("admin/user_level/add", \Session::get('rules'))) || (in_array("admin/user_level/add", \Session::get('rules'))) || (in_array("admin/user_level/edit", \Session::get('rules'))))
                                <li>
                                    <a href="{{url($_ENV['ADMIN_FOLDER'].'/user_level')}}">
                                        <i class="material-icons">group</i>
                                    <span>User Group</span>
                                    </a>
                                </li>
                                @endif
                            </ul>
                        </li>
                        @endif
                        @if((\Session::get('rules') == '1') || (in_array("admin/menu/add", \Session::get('rules'))) || (in_array("admin/menu/delete", \Session::get('rules'))) || (in_array("admin/menu/edit", \Session::get('rules'))))
                        <li>
                            <a href="{{url($_ENV['ADMIN_FOLDER'].'/menu')}}">
                                <i class="material-icons">menu</i>
                                <span>Menu</span>
                            </a>
                        </li>
                        @endif
                        @if((\Session::get('rules') == '1') || (in_array("admin/carousel/add", \Session::get('rules'))) || (in_array("admin/carousel/delete", \Session::get('rules'))) || (in_array("admin/carousel/edit", \Session::get('rules'))) || (in_array("admin/carousel/setting", \Session::get('rules'))) || (in_array("admin/post/add", \Session::get('rules'))) || (in_array("admin/post/delete", \Session::get('rules'))) || (in_array("admin/post/edit", \Session::get('rules'))) || (in_array("admin/post/setting", \Session::get('rules'))) || (in_array("admin/process_text/add", \Session::get('rules'))) || (in_array("admin/process_text/delete", \Session::get('rules'))) || (in_array("admin/process_text/edit", \Session::get('rules'))) || (in_array("admin/process_text/setting", \Session::get('rules'))) || (in_array("admin/project/category/add", \Session::get('rules'))) || (in_array("admin/project/category/delete", \Session::get('rules'))) || (in_array("admin/project/category/edit", \Session::get('rules'))) || (in_array("admin/project/add", \Session::get('rules'))) || (in_array("admin/project/delete", \Session::get('rules'))) || (in_array("admin/project/edit", \Session::get('rules'))) || (in_array("admin/project/setting", \Session::get('rules'))) || (in_array("admin/skill/add", \Session::get('rules'))) || (in_array("admin/skill/delete", \Session::get('rules'))) || (in_array("admin/skill/edit", \Session::get('rules'))) || (in_array("admin/skill/setting", \Session::get('rules'))) || (in_array("admin/team/add", \Session::get('rules'))) || (in_array("admin/team/delete", \Session::get('rules'))) || (in_array("admin/team/edit", \Session::get('rules'))) || (in_array("admin/team/setting", \Session::get('rules'))) || (in_array("admin/testimonial/add", \Session::get('rules'))) || (in_array("admin/testimonial/delete", \Session::get('rules'))) || (in_array("admin/testimonial/edit", \Session::get('rules'))) || (in_array("admin/testimonial/setting", \Session::get('rules'))))
                        <li>
                            <a href="javascript:void(0);" class="menu-toggle">
                                <i class="material-icons">assignment</i>
                                <span>Forms</span>
                            </a>
                            <ul class="ml-menu">
                                @if((\Session::get('rules') == '1') || (in_array("admin/carousel/add", \Session::get('rules'))) || (in_array("admin/carousel/delete", \Session::get('rules'))) || (in_array("admin/carousel/edit", \Session::get('rules'))) || (in_array("admin/carousel/setting", \Session::get('rules'))))
                                <li>
                                    <a href="{{url($_ENV['ADMIN_FOLDER'].'/carousel')}}">
                                        <i class="material-icons">view_carousel</i>
                                    <span>Slide</span>
                                    </a>
                                </li>
                                @endif
                                @if((\Session::get('rules') == '1') || (in_array("admin/post/add", \Session::get('rules'))) || (in_array("admin/post/delete", \Session::get('rules'))) || (in_array("admin/post/edit", \Session::get('rules'))) || (in_array("admin/post/setting", \Session::get('rules'))))
                                <li>
                                    <a href="{{url($_ENV['ADMIN_FOLDER'].'/post')}}">
                                        <i class="material-icons">receipt</i>
                                    <span>Post</span>
                                    </a>
                                </li>
                                @endif
                                @if((\Session::get('rules') == '1') || (in_array("admin/process_text/add", \Session::get('rules'))) || (in_array("admin/process_text/delete", \Session::get('rules'))) || (in_array("admin/process_text/edit", \Session::get('rules'))) || (in_array("admin/process_text/setting", \Session::get('rules'))))
                                <li>
                                    <a href="{{url($_ENV['ADMIN_FOLDER'].'/process_text')}}">
                                        <i class="material-icons">view_column</i>
                                    <span>Process Text</span>
                                    </a>
                                </li>
                                @endif
                                @if((\Session::get('rules') == '1') || (in_array("admin/project/add", \Session::get('rules'))) || (in_array("admin/project/delete", \Session::get('rules'))) || (in_array("admin/project/edit", \Session::get('rules'))) || (in_array("admin/project/setting", \Session::get('rules'))) || (in_array("admin/project/category/add", \Session::get('rules'))) || (in_array("admin/project/category/delete", \Session::get('rules'))) || (in_array("admin/project/category/edit", \Session::get('rules'))) || (in_array("admin/project/add", \Session::get('rules'))) || (in_array("admin/project/delete", \Session::get('rules'))) || (in_array("admin/project/edit", \Session::get('rules'))) || (in_array("admin/project/setting", \Session::get('rules'))))
                                <li>
                                    <a href="javascript:void(0);" class="menu-toggle">
                                        <i class="material-icons">speaker_notes</i>
                                        <span>Project</span>
                                    </a>
                                    <ul class="ml-menu">
                                        @if((\Session::get('rules') == '1') || (in_array("admin/project/add", \Session::get('rules'))) || (in_array("admin/project/delete", \Session::get('rules'))) || (in_array("admin/project/edit", \Session::get('rules'))) || (in_array("admin/project/setting", \Session::get('rules'))))
                                        <li>
                                            <a href="{{url($_ENV['ADMIN_FOLDER'].'/project')}}">
                                                <i class="material-icons">done_all</i>
                                                <span>Project</span>
                                            </a>
                                        </li>
                                        @endif
                                        @if((\Session::get('rules') == '1') || (in_array("admin/project/category/add", \Session::get('rules'))) || (in_array("admin/project/category/delete", \Session::get('rules'))) || (in_array("admin/project/category/edit", \Session::get('rules'))))
                                        <li>
                                            <a href="{{url($_ENV['ADMIN_FOLDER'].'/project/category')}}">
                                                <i class="material-icons">short_text</i>
                                                <span>Project Category</span>
                                            </a>
                                        </li>
                                        @endif
                                    </ul>
                                </li>
                                @endif
                                @if((\Session::get('rules') == '1') || (in_array("admin/skill/add", \Session::get('rules'))) || (in_array("admin/skill/delete", \Session::get('rules'))) || (in_array("admin/skill/edit", \Session::get('rules'))) || (in_array("admin/skill/setting", \Session::get('rules'))))
                                <li>
                                    <a href="{{url($_ENV['ADMIN_FOLDER'].'/skill')}}">
                                        <i class="material-icons">pan_tool</i>
                                    <span>Skills</span>
                                    </a>
                                </li>
                                @endif
                                @if((\Session::get('rules') == '1') || (in_array("admin/team/add", \Session::get('rules'))) || (in_array("admin/team/delete", \Session::get('rules'))) || (in_array("admin/team/edit", \Session::get('rules'))) || (in_array("admin/team/setting", \Session::get('rules'))))
                                <li>
                                    <a href="{{url($_ENV['ADMIN_FOLDER'].'/team')}}">
                                        <i class="material-icons">people</i>
                                    <span>Team</span>
                                    </a>
                                </li>
                                @endif
                                @if((\Session::get('rules') == '1') || (in_array("admin/testimonial/add", \Session::get('rules'))) || (in_array("admin/testimonial/delete", \Session::get('rules'))) || (in_array("admin/testimonial/edit", \Session::get('rules'))) || (in_array("admin/testimonial/setting", \Session::get('rules'))))
                                <li>
                                    <a href="{{url($_ENV['ADMIN_FOLDER'].'/testimonial')}}">
                                        <i class="material-icons">perm_contact_calendar</i>
                                    <span>Testimonial</span>
                                    </a>
                                </li>
                                @endif
                            </ul>
                        </li>
                        @endif
                        <li>
                            <a href="javascript:void(0);" class="menu-toggle">
                                <i class="material-icons">settings</i>
                                <span>Settings</span>
                            </a>
                            <ul class="ml-menu">
                                @if((\Session::get('rules') == '1') || (in_array("admin/setting", \Session::get('rules'))))
                                <li>
                                    <a href="{{url($_ENV['ADMIN_FOLDER'].'/setting')}}">
                                        <i class="material-icons">settings</i>
                                    <span>General</span>
                                    </a>
                                </li>
                                @endif
                                @if((\Session::get('rules') == '1') || (in_array("admin/setting/social", \Session::get('rules'))) || (in_array("admin/setting/footer", \Session::get('rules'))))
                                <li>
                                    <a href="javascript:void(0);" class="menu-toggle">
                                        <i class="material-icons">settings_applications</i>
                                        <span>Footer</span>
                                    </a>
                                    <ul class="ml-menu">
                                        @if((\Session::get('rules') == '1') || (in_array("admin/setting/footer", \Session::get('rules'))))
                                        <li>
                                            <a href="{{url($_ENV['ADMIN_FOLDER'].'/setting/footer')}}">
                                                <i class="material-icons">view_stream</i>
                                            <span>Footer Text</span>
                                            </a>
                                        </li>
                                        @endif
                                        @if((\Session::get('rules') == '1') || (in_array("admin/setting/social", \Session::get('rules'))))
                                        <li>
                                            <a href="{{url($_ENV['ADMIN_FOLDER'].'/setting/footer/social')}}">
                                                <i class="material-icons">supervisor_account</i>
                                            <span>Social Link</span>
                                            </a>
                                        </li>
                                        @endif
                                    </ul>
                                </li>
                                @endif
                                @if((\Session::get('rules') == '1') || (in_array("admin/setting/location", \Session::get('rules'))))
                                <li>
                                    <a href="{{url($_ENV['ADMIN_FOLDER'].'/setting/location')}}">
                                        <i class="material-icons">add_location</i>
                                    <span>Location</span>
                                    </a>
                                </li>
                                @endif
                                 <li>
                                    <a href="{{url($_ENV['ADMIN_FOLDER'].'/setting/profile')}}">
                                        <i class="material-icons">person</i>
                                    <span>Profile</span>
                                    </a>
                                </li>
                                @if((\Session::get('rules') == '1') || (in_array("admin/setting/contact", \Session::get('rules'))))
                                   <li>
                                    <a href="/{{$_ENV['ADMIN_FOLDER'].'/contact'}}">
                                        <i class="material-icons">contacts</i>
                                    <span>Contact_info</span>
                                    </a>
                                </li>
                                @endif


                            </ul>
                        </li>
                    </ul>
                </div>
                <!-- #Menu -->
                <!-- Footer -->
                <div class="legal">
                    <div class="copyright">
                        &copy; 2016 <a href="javascript:void(0);">Admin</a>.
                    </div>
                </div>
                <!-- #Footer -->
            </aside>
            <!-- #END# Left Sidebar -->
