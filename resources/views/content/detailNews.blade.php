@extends('layouts.index')
    @section('content')
    @include('layouts.left')
    @include('layouts.right')
        <section class="content">
            <div class="container-fluid">
                <div class="block-header">

                </div>
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">

                            <div class="header">
                                <h2>
                                    <?php echo $listNews[0]->judul_news ?>
                                    <small>
                                        <?php echo date("d M Y", strtotime($listNews[0]->tanggal_news)) ?>
                                    </small>
                                </h2>
                                <div class="pull-right" style="margin-top:-40px">
                                    <a href="{{url('/admin')}}" class="btn btn-warning waves-effect">Back</a>
                                </div>
                            </div>
                            <div class="body">
                                <?php echo $listNews[0]->description_news ?>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    @stop
@stop
