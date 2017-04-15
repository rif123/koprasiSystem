<!-- section begin -->
                <section id="section-blog" class="text-light" style="background:url('{{ URL::asset('') }}/images/image-gallery/{{$section6_background}}') top fixed;">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 col-md-offset-3 text-center wow fadeInUp">
                                <h1>{{$section6_title}}</h1>
                                <div class="separator"><span><i class="fa fa-circle"></i></span></div>
                                <div class="spacer-single"></div>
                            </div>

    						<div class="clearfix"></div>

                            <ul id="blog-carousel" class="blog-list blog-snippet wow fadeInUp">
                                @foreach($post as $a)
                                <li class="col-md-6 item">
                                    <div class="post-content">
                                        <div class="post-image">
                                            @if(file_exists(public_path().'/images/image-gallery/'.$a['featured_image']))
                                                <img src="{{ URL::asset('') }}/images/image-gallery/{{$a['featured_image']}}" alt="" />
                                            @else
                                                <img src="{{ URL::asset('') }}/images/image-gallery/default/video-poster.jpg" alt="" />
                                            @endif
                                            
                                        </div>


                                        <div class="date-box">
                                            <div class="day">{{$a['date']['day']}}</div>
                                            <div class="month">{{$a['date']['month']}}</div>
                                        </div>

                                        <div class="post-text">
                                            <h3><a href="/blog/{{$a['id']}}">{{$a['title']}}</a></h3>
                                            <p>{!! \Illuminate\Support\Str::words($a['text'], 15,'....')  !!}</p>
                                        </div>

                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </section>
                <!-- section close -->