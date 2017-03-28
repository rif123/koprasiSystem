@extends('layoutsFe.index')
    @section('content')
    		@foreach($widget as $a)
    			@if($a['parent'] == '1')
    				@include('layoutsFe.'.$a['blade_name'])
    			@endif
    		@endforeach
    @stop
@stop
