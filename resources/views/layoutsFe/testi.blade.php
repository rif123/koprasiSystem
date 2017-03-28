 <!-- section begin -->
                <section id="section-testimonial" class="text-light" style="background:url('{{ URL::asset('') }}/images/image-gallery/{{$section5_background}}') top fixed;">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 col-md-offset-3 text-center wow fadeInUp">
                                <h1>{{$section5_title}}</h1>
                                <div class="separator"><span><i class="fa fa-circle"></i></span></div>
                                <div class="spacer-single"></div>
                            </div>
                        </div>
                        <div id="testimonial-carousel" class="de_carousel  wow fadeInUp" data-wow-delay=".3s">

                            @foreach($testi as $a)
                            <div class="col-md-6 item">
                                <div class="de_testi">
                                    <blockquote>
                                        <p>{{$a->testimoni}}</p>
                                        <div class="de_testi_by">
                                            {{$a->customer_name}}, {{$a->customer_status}}
                                        </div>
                                    </blockquote>

                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </section>
                <!-- section close -->