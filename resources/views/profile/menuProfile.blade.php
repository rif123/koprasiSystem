{{--*/
    $btnMenu = ['photoProfile' => 'Photo Profile', 'photo-produk' => 'Photo Produk']
/*--}}



@if(Request::segment(2) == 'profile')
<button type="button" class="btn btn-primary waves-effect btn-rubah-data" >Rubah Data</button>
@else
<a href="{{url(route('profile.index'))}}">
    <button type="button" class="btn btn-primary waves-effect btn-rubah-data" >Rubah Data</button>
</a>
@endif
@foreach($btnMenu as $key => $value)
    {{--*/ $selected = "" /*--}}
    @if($key == $selectedMenu)
        {{--*/ $selected = 'disabled="disabled"' /*--}}
    @endif
    <a href="<?php echo url(route('profile.'.$key.'')); ?>">
        <button type="button" class="btn btn-primary waves-effect" {{$selected}} >{{$value}}</button>
    </a>
@endforeach
