@extends('layouts.index')
    @section('content')
    @include('layouts.left')
    @include('layouts.right')
        <section class="content">

            <div class="container-fluid">
                <div class="block-header">
                    <h2>DASHBOARD</h2>
                </div>
                <!-- Widgets -->
                <div class="row clearfix">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="header">
                                <h2>ERROR!</h2>       
 
                            </div>
                            
                            <div class="body">
                            <div class="row clearfix">
                                You don't have privilege to access this page! 
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
                <!-- #END# CPU Usage -->
        </section>
    @stop
@stop
