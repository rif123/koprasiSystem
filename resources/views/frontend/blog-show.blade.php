@extends('layoutsFe.index')
    @section('content')
            <!-- subheader -->
        <section id="subheader" data-speed="8" data-type="background">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1>Post</h1>
                        <ul class="crumb">
                            <li><a href="/">Home</a></li>
                            <li class="sep">/</li>
                            <li><a href="/blog">Post</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <!-- subheader close -->

        <!-- content begin -->
        <div id="content">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <ul class="blog-list">
                            <li>
                                <div class="post-content">
                                    @if(file_exists(public_path().'/images/image-gallery/'.$dt->featured_image))
                                        <div class="post-image">
                                            <img src="{{ URL::asset('') }}/images/image-gallery/{{$dt->featured_image}}" alt="" />
                                        </div>
                                    @endif
                                    
                                    <div class="date-box">
                                        <div class="day">{{Date('d',$dt->date)}}</div>
                                        <div class="month">{{Date('M',$dt->date)}}</div>
                                    </div>

                                    <div class="post-text">
                                        <h3><a href="/blog/{{$dt->id}}">{{$dt->title}}</a></h3>
                                            <p>{!! $dt->text !!}</p>
                                        </div>
                                </div>
                            </li>
                        </ul>
                </div>
            </div>
        </div>

    @stop
@stop
