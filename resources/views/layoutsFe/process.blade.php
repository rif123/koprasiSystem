<!-- section begin -->
                <section id="section-steps" class="text-light" style="background:url('{{ URL::asset('') }}/images/image-gallery/{{$section3_background}}') top fixed;">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 col-md-offset-3 text-center wow fadeInUp">
                                <h1>{{$section3_title}}</h1>
                                <div class="separator"><span><i class="fa fa-circle"></i></span></div>
                                <div class="spacer-single"></div>
                            </div>

                            <div class="col-md-12">
                                <div class="de_tab tab_steps">
                                    <ul class="de_nav">
                                        @foreach($process_title as $a => $b)
                                            @if($a==0)
                                                <li class="active wow fadeIn" data-wow-delay="0s"><span>{{$b->title}}</span><div class="v-border"></div></li>
                                            @else
                                                <li class="wow fadeIn" data-wow-delay="0s"><span>{{$b->title}}</span><div class="v-border"></div></li>
                                            @endif
                                        @endforeach
                                    </ul>

                                    <div class="de_tab_content">
                                        @foreach($process_textbox as $a => $b)
                                            <div id="tab{{$a+1}}">
                                                {{$b->textbox}}
                                            </div>
                                        @endforeach
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- section close -->