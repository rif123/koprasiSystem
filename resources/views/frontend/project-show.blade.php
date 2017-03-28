<div class="container project-view">

    <div class="row">
        <div class="col-md-8 project-images">
            @foreach($photo as $a)
                <img src="{{ URL::asset('') }}/images/image-gallery/{{$a}}" alt="" class="img-responsive" />
            @endforeach
        </div>
        <div class="col-md-4">
            <div class="project-info">
                <h2>{{$name}}</h2>

                <div class="details">
                    <div class="info-text">
                        <span class="title">Client</span>
                        <span class="val">{{$client}}</span>
                    </div>

                    <div class="info-text">
                        <span class="title">Category</span>
                        <span class="val">{{$project_category['name']}}</span>
                    </div>
                </div>

                {!! $description !!}   
                        
            </div>
        </div>
    </div>
</div>
