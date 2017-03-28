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
                            <li>Post</li>
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
                            @foreach($post as $a)
                                <li>
                                <div class="post-content">
                                    @if(file_exists(public_path().'/images/image-gallery/'.$a->featured_image))
                                        <div class="post-image">
                                            <img src="{{ URL::asset('') }}/images/image-gallery/{{$a->featured_image}}" alt="" />
                                        </div>
                                    @endif
                                    


                                    <div class="date-box">
                                        <div class="day">{{Date('d',$a->date)}}</div>
                                        <div class="month">{{Date('M',$a->date)}}</div>
                                    </div>

                                    <div class="post-text">
                                        <h3><a href="/blog/{{$a->id}}">{{$a->title}}</a></h3>
                                            <p>{!! \Illuminate\Support\Str::words(strip_tags($a->text), 15,'....')  !!}</p>
                                        </div>

                                    <a href="/blog/{{$a->id}}" class="btn-more">Read More</a>
                                </div>
                            </li>
                            @endforeach
                        </ul>

                        <div class="text-center">
                            <ul class="pagination">
                                {!! $post->render() !!}
                            </ul>
                        </div>
                    </div>

                    <div id="sidebar" class="col-md-4">
                        <div class="widget widget-post">
                            <h4>Recent Posts</h4>
                            <div class="small-border"></div>
                            <ul>
                                @foreach($post as $a)
                                    <li><a href="/blog/{{$a['id']}}">{{$a['title']}}</a></li>
                                @endforeach

                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    @stop
@stop
