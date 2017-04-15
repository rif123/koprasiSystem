
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="body">
                            <b>Image Media</b>
                            <p>
                                Click to get the link
                            </p>
                            <div id="aniimated-thumbnials" class="list-unstyled row clearfix">
                                @foreach($data as $a)
                                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                    <a href="#" data-name="{{$a['id']}}" class="img-media">
                                        <img class="img-responsive thumbnail" src="{{asset('')}}images/image-gallery/{{$a['id']}}">
                                    </a>
                                </div>
                                @endforeach
                            </div>
                </div>
            </div>
        </div>
    </div>