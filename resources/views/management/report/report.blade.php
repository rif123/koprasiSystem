@extends('layouts.index_no_require')
@section('header')
    <link href="{{ URL::asset('') }}plugins/bootsrap-datepicker/bootstrap-datepicker.css" rel="stylesheet" />
@stop
@section('content')
@include('layouts.left')
@include('layouts.right')
<section class="content">.
                <div class="container-fluid">
                    <div class="row clearfix">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="card">
                                <div class="header">
                                    <h2>Report Keuangan Income</h2>
                                </div>
                            <div class="body">
                                <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
                                    <div id="DataTables_Table_0_filter" class="dataTables_filter">
                                    <label>Search:<input type="search" class="" placeholder="" aria-controls="DataTables_Table_0"></label>
                                    </div>
                                </div>
                            </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6"></div>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"> </div>
                                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                <a href="{{url('/admin/management/report-excel')}}">
                                    <button type="button" class="btn bg-teal waves-effect">
                                        <i class="material-icons">print</i>Excel
                                    </button>
                                </a>
                                <a href="{{url('/admin/management/report-pdf')}}" class="hidden">
                                <button type="button" class="btn bg-red waves-effect">
                                    <i class="material-icons">print</i>PDF
                                </button>
                                </a>


                                </div>
                                        <thead>
                                   <table class="table" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Bulan</th>
                                                <th>Income</th>
                                                <th>Outcome</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-striped">

                                            @foreach($data as $key =>$value)
                                                <tr>
                                                    <td>{{$key}}</td>
                                                    <td>{{Helpers::convertMonth($key)}} </td>
                                                    <td>{{!empty ($value[0]->jml_income) ? Helpers::getRp($value[0]->jml_income) : "Rp.0" }} </td>
                                                    <td>{{!empty ($value[0]->jml_outcome) ? Helpers::getRp($value[0]->jml_outcome) : "Rp.0" }} </td>
                                                    <td>{{!empty ($value[0]->total) ? Helpers::getRp($value[0]->total) : "Rp.0" }} </td>

                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
@endsection
@stop
@stop
