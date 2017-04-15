@extends('layoutsFe.index')
    @section('content')
            <!-- subheader -->
            <section id="subheader" data-speed="8" data-type="background">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h1>{{$project_title}}</h1>
                            <ul class="crumb">
                                <li><a href="/">Home</a></li>
                                <li class="sep">/</li>
                                <li>{{$project_title}}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>
            <!-- subheader close -->

            <!-- content begin -->
            <div id="content" class="no-bottom no-top">

                <section id="section-portfolio" class="no-top no-bottom" aria-label="section-portfolio">
                    <div class="container">

                        <div class="spacer-single"></div>

                        <!-- portfolio filter begin -->
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <ul id="filters" class="wow fadeInUp" data-wow-delay="0s">
                                    <li><a href="#" data-filter="*" class="selected">All Projects</a></li>
                                    @foreach($project_category as $a)
                                        <li><a href="#" data-filter=".{{$a}}">{{$a}}</a></li>
                                    @endforeach
                                </ul>

                            </div>
                        </div>
                        <!-- portfolio filter close -->

                    </div>

                    <div id="gallery" class="gallery full-gallery de-gallery pf_full_width wow fadeInUp" data-wow-delay=".3s">

                        <!-- gallery item -->
                        @foreach($project as $a)
                        <div class="item {{$a->project_category->name}}">
                            <div class="picframe">
                                <a class="simple-ajax-popup-align-top" href="/project/{{$a->id}}">
                                    <span class="overlay">
                                        <span class="pf_text">
                                            <span class="project-name">{{$a->name}}</span>
                                        </span>
                                    </span>
                                </a>
                                <img src="{{ URL::asset('') }}/images/image-gallery/{{$a->featured_image}}" alt="" />
                            </div>
                        </div>
                        @endforeach
                        <!-- close gallery item -->
                    </div>

                    <div id="loader-area">
                        <div class="project-load"></div>
                    </div>
                </section>
                <!-- section close -->

                <!-- section begin -->
                <section id="call-to-action" class="call-to-action bg-color dark text-center" data-speed="5" data-type="background" aria-label="call-to-action">
                    <a href="#" class="btn btn-line-black btn-big">Get Quotation</a>
                </section>
                <!-- logo carousel section close -->
    @stop
@stop
