@extends('layouts.index')
    @section('content')
        @include('layouts.left')
        @include('layouts.right')
            <section class="content">
                <div class="container-fluid">
                    <div class="block-header">
                        <h2>Setting</h2>
                    </div>
                    <div class="row clearfix">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="card">
                                <div class="header">
                                    <h2>Front End Setting</h2>
                                </div>
                                @if(\Session::get('success'))
                                    <div class="alert alert-success">
                                        {{\Session::get('success')}}
                                    </div>
                                @endif
                                @if($errors->has())
                                    <div class="alert alert-danger">
                                        <h4>Error:</h4>
                                        <ul>
                                       @foreach ($errors->all() as $error)
                                          <li>{{ $error }}</li>
                                      @endforeach
                                      </ul>
                                    </div>
                                @endif
                                <div class="body">
                                <form name="save" method="post">
                                    <table class="table" id="table">
                                        <thead>
                                            <tr>
                                                <th>Section</th>
                                                <th>Active</th>
                                                <th>Sort</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($data as $a)
                                            <tr>
                                                <td>{{$a->name}}</td>
                                                <td>
                                                @if($a->active == '1')
                                                    <input type="checkbox" name="active[{{$a->id}}]" id="a{{$a->id}}" value="1" checked />
                                                @else
                                                    <input type="checkbox" name="active[{{$a->id}}]" id="a{{$a->id}}"/>
                                                @endif
                                                <label for="a{{$a->id}}"> </label>

                                                </td>
                                                <td>
                                                    @if($a->parent == '1')
                                                        <input type="number" style="width: 20%" name="sort[{{$a->id}}]" size="2" class="form-control" value="{{$a->order_show}}" placeholder="Sort" />
                                                    @else
                                                        <input type="hidden" name="sort[{{$a->id}}]" value="{{$a->order_show}}" />
                                                    @endif
                                                </td>
                                                    
                                                <input type="hidden" name="id[]" value="{{$a->id}}" />
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div style="text-align:center">
                                            <button type="Submit" class="btn btn-primary btn-lg m-l-15 waves-effect">Save</button>
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
    @stop
@stop