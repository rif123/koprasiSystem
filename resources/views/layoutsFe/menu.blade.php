<body id="homepage">
        <div id="wrapper">
            <header>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-4">
                                <div class="nav-header-logo">
                                    <div class="example6">
                                      &nbsp;
                                    </div>
                                </div>

                                <!-- small button begin -->
                                <span id="menu-btn"></span>
                            <!-- small button close -->
                            </div>
  <div class="col-md-8">
    						<!-- mainmenu begin -->
@if(!empty($widget_add['add_menu']))
                            <nav>
                                <ul id="mainmenu">
                                    @foreach($menu as $a)
                                        <li><a href="{{$a->link}}">{{$a->name}}</a></li>
                                    @endforeach
                                </ul>
                            </nav>
@endif
                        <!-- mainmenu close -->


                        </div>

                    </div>
                </div>
            </header>
            <style type="text/css">
            .example6 {
                background: url({{ URL::asset('') }}/images/image-gallery/{{$site_logo}}) center / contain no-repeat;
                /*width: 200px;*/
                 width: 100%;
                height: 100px;
                background-repeat: no-repeat;
                 background-size: contain;
            }
            .nav-header-logo {
                /*padding-top: 30px;*/
            }

            </style>
            <!-- header close -->