<!-- section begin -->
                <section id="section-portfolio" class="no-top no-bottom" aria-label="section-portfolio">
                    <div class="container">

                        <div class="spacer-single"></div>

                        <!-- portfolio filter begin -->
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <ul id="filters" class="wow fadeInUp" data-wow-delay="0s">
                                    <li><a href="#" data-filter="*" class="selected">Jenis usaha</a></li>
                                    @foreach($project_category as $a)
                                        <li><a href="#" data-filter=".{{str_replace(" ","_",$a)}}">{{$a}}</a></li>
                                    @endforeach
                                </ul>

                            </div>
                        </div>
                        <!-- portfolio filter close -->

                    </div>
                    <div id="gallery" class="gallery full-gallery de-gallery pf_full_width wow fadeInUp" data-wow-delay=".3s">
                        <!-- gallery item -->
                        @foreach($project as $a)
                            @foreach($a as $k)
                            <div class="item {{str_replace(" ","_",$k['jenis_usaha'])}}">
                                <div class="picframe">
                                        <a  href="{{ url('/') }}/project/{{$k['kd_jenis_usaha']}}">
                                        <span class="overlay">
                                            <span class="pf_text">
                                                <span class="project-name">{{$k['brand_usaha']}}</span>
                                            </span>
                                        </span>
                                    </a>
                                    <img src="{{ URL::asset('') }}/uploads/produk/{{$k['pasPhotoProduk']}}" alt="" />
                                </div>
                            </div>
                            @endforeach
                        @endforeach
                        <!-- close gallery item -->
                    </div>

                    <div id="loader-area">
                        <div class="project-load"></div>
                    </div>
                </section>
                <!-- section close -->
                 <!-- section begin -->
                <section id="view-all-projects" class="call-to-action bg-color text-center" data-speed="5" data-type="background" aria-label="view-all-projects">
                    <a href="{{ url('/') }}/project" class="btn btn-line-black btn-big">View All Projects</a>
                </section>
                <!-- logo carousel section close -->
