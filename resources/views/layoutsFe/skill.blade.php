<!-- section begin -->
                <section id="section-services">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 col-md-offset-3 text-center wow fadeInUp">
                                <h1>{{$section2_title}}</h1>
                                <div class="separator"><span><i class="fa fa-circle"></i></span></div>
                                <div class="spacer-single"></div>
                            </div>

                            @foreach($skill as $a)
                                <div class="col-md-4 wow fadeInLeft">
                                    <h3><span class="id-color">{{strstr($a->title," ",true)}}</span> {{substr(strstr($a->title," "),1)}}</h3>
                                    {{$a->description}}
        							<div class="spacer-single"></div>
                                    <img src="{{ URL::asset('') }}/images/image-gallery/{{$a->image}}" class="img-responsive" alt="">
                                </div>
                            @endforeach

                        </div>
                    </div>
                </section>
                <!-- section close -->