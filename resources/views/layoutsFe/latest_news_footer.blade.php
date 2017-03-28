<div class="col-md-4">
    <div class="widget widget_recent_post">
        <h3>Latest News</h3>
        <ul>
            @foreach($post as $a)
                <li><a href="/blog/{{$a['id']}}">{{$a['title']}}</a></li>
            @endforeach
        </ul>
    </div>
</div>