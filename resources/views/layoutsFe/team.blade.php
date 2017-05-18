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
                                        <?php
                                            // var_dump(public_path());die;
                                        ?>
                                        @if(file_exists(public_path().'/uploads/profile/'.$a->pasPhoto_anggota) && !empty($a->pasPhoto_anggota) )
                                            <img style="width:100%;max-height:284px;" src="{{ url('/') }}/uploads/profile/{{$a->pasPhoto_anggota}}" class="img-responsive" alt="" />
                                        @endif
                                    </div>
                                    <div class="team-desc col-md-12">
                                        <h3>{{$a->nm_anggota}}</h3>
                                        <p class="lead">Anggota</p>
                                        <div class="small-border"></div>
                                        <div class="social">
                                            <a href="{{$a->fb_usaha}}" target="_blank"><i class="fa fa-facebook fa-lg" aria-hidden="true"></i></a>
                                            <a href="{{$a->twiiter_usaha}}" target="_blank"><i class="fa fa-twitter fa-lg" aria-hidden="true"></i></a>
                                            <a href="{{$a->insta_usaha}}" target="_blank"><i class="fa fa-instagram fa-lg" aria-hidden="true"></i></a>
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
