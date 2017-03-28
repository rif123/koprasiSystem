<!-- section begin -->
                <section id="section-team">
                    <div class="container">
                        <div class="col-md-6 col-md-offset-3 text-center wow fadeInUp">
                            <h1>{{$section4_title}}</h1>
                            <div class="separator"><span><i class="fa fa-circle"></i></span></div>
                            <div class="spacer-single"></div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 container-4 wow fadeInUp">

                                <!-- team member -->
                                @foreach($team as $a)
                                <div class="de-team-list">
                                    <div class="team-pic">
                                        @if(file_exists(public_path().'/images/image-gallery/team/'.$a->id.'.jpg'))
                                            <img style="width:100%;max-height:284px;" src="{{ URL::asset('') }}/images/image-gallery/team/{{$a->id}}.jpg" class="img-responsive" alt="" />
                                        @else
                                            <img style="width:100%;max-height:284px;" src="{{ URL::asset('') }}/images/image-gallery/team/avatar.jpg" class="img-responsive" alt="" />
                                        @endif
                                    </div>
                                    <div class="team-desc col-md-12">
                                        <h3>{{$a->name}}</h3>
                                        <p class="lead">{{$a->position}}</p>
                                        <div class="small-border"></div>
                                        <p>{{$a->description}}</p>

                                        <div class="social">
                                            <a href="{{$a->social['fb']}}"><i class="fa fa-facebook fa-lg" aria-hidden="true"></i></a>
                                            <a href="{{$a->social['tw']}}"><i class="fa fa-twitter fa-lg" aria-hidden="true"></i></a>
                                            <a href="{{$a->social['ig']}}"><i class="fa fa-instagram fa-lg" aria-hidden="true"></i></a>
                                            <a href="{{$a->social['gp']}}"><i class="fa fa-google-plus fa-lg" aria-hidden="true"></i></a>    
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                <!-- team close -->

                                <div class="clearfix"></div>

                            </div>
                        </div>
                    </div>
                </section>
                <!-- section close -->