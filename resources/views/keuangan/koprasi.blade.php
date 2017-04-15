@extends('layouts.index_no_require')
@section('content')
@include('layouts.left')
@include('layouts.right')
<section class="content">
    <div class="container-fluid">
        <div class="card">
        <div class="header">
            <h2> Keuangan Koprasi</h2>
        </div>
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="body">
                    <h4>Income</h4>
                    <table class="table-bordered table-striped table-hover js-basic-example dataTable ">
                          <thead>
                              <tr>
                                  <th>No</th>
                                  <th>Tanggal</th>
                                  <th>Keterangan</th>
                                  <th>Jumlah</th>
                                  <th>PIC</th>
                              </tr>
                          </thead>
                          <tbody>

                          </tbody>
                    </table>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="body">
                    <h4>Outcome</h4>
                    <table class="table-bordered table-striped table-hover js-basic-example dataTable ">
                          <thead>
                              <tr>
                                  <th>No</th>
                                  <th>Tanggal</th>
                                  <th>Keterangan</th>
                                  <th>Jumlah</th>
                                  <th>PIC</th>
                              </tr>
                          </thead>
                          <tbody>

                          </tbody>
                    </table>
                </div>
            </div>


        </div>
    </div>
    <style>
        h2.group-title{
            margin-left:15px
        }
    </style>
</section>
@stop
@stop
