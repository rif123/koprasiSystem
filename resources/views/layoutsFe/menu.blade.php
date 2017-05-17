<body id="homepage">
        <div id="wrapper">
            <header>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- logo begin -->
                            <div id="logo" style="margin-top:5px">
                                <a href="/">
                                    <img style="width:30%" class="logo" src="{{ URL::asset('') }}/images/image-gallery/{{$site_logo}}" alt="">
                                </a>
                            </div>
                            <!-- logo close -->

                            <!-- small button begin -->
                            <span id="menu-btn"></span>
                            <!-- small button close -->

    						<!-- mainmenu begin -->
@if(!empty($widget_add['add_menu']))
                            <nav>
                                <ul id="mainmenu">
                                    @foreach($menu as $a)
                                        <li><a href="{{$a->link}}">{{$a->name}}</a></li>
                                    @endforeach
                                </ul>
                            </nav>

                        </div>
@endif
                        <!-- mainmenu close -->

                    </div>
                </div>
            </header>
            <!-- header close -->
