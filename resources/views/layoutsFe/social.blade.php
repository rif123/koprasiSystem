<div class="container">
    <div class="row">
        <div class="col-md-6">
        @if(!empty($widget_add['add_text_footer']))
            {{$footer_text}}
        @endif
        </div>
        <div class="col-md-6 text-right">
            <div class="social-icons">
                @foreach($social as $a)
                    <a href="{{$a['link']}}"><i class="fa {{$a['fa-icon']}} fa-lg"></i></a>
                @endforeach
            </div>
        </div>
    </div>
</div>