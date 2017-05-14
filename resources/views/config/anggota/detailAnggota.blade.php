@extends('layouts.index_no_require')
@section('header')
<link href="{{ URL::asset('') }}plugins/bootsrap-datepicker/bootstrap-datepicker.css" rel="stylesheet" />
@stop
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="header">
                <h2>Detail Anggota</h2>
                <small>{{$list->nm_anggota}}</small>
                <div class="header-dropdown m-r--5">
                    <a href="{{ url(route('config.anggotaDetailExcel')).'?kd='.$list->kd_anggota }}">
                        <button class="btn bg-blue-grey waves-effect">Excel</button>
                    </a>
                    <a href="{{ url(route('config.anggotaDetail')) }}">
                        <button class="btn btn-warning waves-effect">Back</button>
                    </a>
                </div>
            </div>
            <div class="body">
                <div id="wizard_vertical">
                    <h2>Data Pribadi</h2>
                    <section>
                        <div class="body table-responsive">
                            <table class="table table-striped">
                                <tr>
                                    <th>Tempat Lahir</th>
                                    <td>{{$list->tempat_lahir_pribadi}}</td>
                                </tr>
                                <tr>
                                    <th>NPWP</th>
                                    <td>{{$list->npwp_pribadi}}</td>
                                </tr>
                                <tr>
                                    <th>Handphone</th>
                                    <td>{{$list->noHp_pribadi}}</td>
                                </tr>
                                <tr>
                                    <th>Alamat</th>
                                    <td>{{$list->alamat_pribadi ." ". $list->rtRw_pribadi. " ".$list->kec_pribadi." ".$list->desKel_pribadi }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{$list->email_pribadi}}</td>
                                </tr>
                                <tr>
                                    <th>Wub Tahun</th>
                                    <td>{{$list->wubTahun_pribadi}}</td>
                                </tr>
                                <tr>
                                    <th>Wub Dinas</th>
                                    <td>{{$list->wubDinas_pribadi}}</td>
                                </tr>
                            </table>
                        </div>
                    </section>
                    <h2>Data Usaha</h2>
                    <section>
                        <div class="body table-responsive">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <table class="table table-striped">
                                <tr>
                                    <th>Brand</th>
                                    <td>{{$list->brand_usaha}}</td>
                                </tr>
                                <tr>
                                    <th>Lama</th>
                                    <td>{{$list->lama_usaha}}</td>
                                </tr>
                                <tr>
                                    <th>Jenis Produk</th>
                                    <td>{{$list->jenisProd_usaha}}</td>
                                </tr>
                                <tr>
                                    <th>Alamat</th>
                                    <td>{{$list->alamat_usaha." ".$list->rtRw_usaha." ".$list->kec_usaha." ".$list->kabKot_usaha}}</td>
                                </tr>
                                <tr>
                                    <th>Kapasitas</th>
                                    <td>{{$list->kapasitas_usaha}}</td>
                                </tr>
                                <tr>
                                    <th>Harga</th>
                                    <td>{{Helpers::getRp($list->harga_usaha)}}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <table class="table table-striped">
                                <tr>
                                    <th>Wilayah Offline</th>
                                    <td>{{$list->wilayah_offline_usaha}}</td>
                                </tr>
                                <tr>
                                    <th>Wilayah Online</th>
                                    <td>{{$list->wilayah_online_usaha}}</td>
                                </tr>
                                <tr>
                                    <th>Jumlah Tenaga</th>
                                    <td>{{$list->jumlahTenagaKerja_usaha}}</td>
                                </tr>
                                <tr>
                                    <th>Omset</th>
                                    <td>{{$list->omset_usaha}}</td>
                                </tr>
                                <tr>
                                    <th>Fb</th>
                                    <td>{{$list->fb_usaha}}</td>
                                </tr>
                                <tr>
                                    <th>Instagram</th>
                                    <td>{{$list->insta_usaha}}</td>
                                </tr>
                                <tr>
                                    <th>Twiiter</th>
                                    <td>{{$list->twiiter_usaha}}</td>
                                </tr>
                            </table>
                        </div>
                        </div>
                    </section>
                    <h2>DOC & LEGAL</h2>
                    <section>
                        <div class="body table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Jenis</th>
                                        <th>Dec</th>
                                        <th>File</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>NPWP</td>
                                        <td>{{$list->npwp_docLegal}}</td>
                                        <td><img src="{{ url('/uploads/file_npwp_docLegal')."/".$list->file_npwp_docLegal}}"  /></td>
                                    </tr>
                                    <tr>
                                        <td>SITU</td>
                                        <td>{{$list->npwp_docLegal}}</td>
                                        <td><img src="{{ url('/uploads/file_situ_docLegal')."/".$list->file_situ_docLegal}}"  /></td>
                                    </tr>
                                    <tr>
                                        <td>SIUP</td>
                                        <td>{{$list->siup_docLegal}}</td>
                                        <td><img src="{{ url('/uploads/file_siup_docLegal')."/".$list->file_siup_docLegal}}"  /></td>
                                    </tr>
                                    <tr>
                                        <td>TDP</td>
                                        <td>{{$list->tdp_docLegal}}</td>
                                        <td><img src="{{ url('/uploads/file_tdp_docLegal')."/".$list->file_tdp_docLegal}}"  /></td>
                                    </tr>
                                    <tr>
                                        <td>PIRT</td>
                                        <td>{{$list->pirt_docLegal}}</td>
                                        <td><img src="{{ url('/uploads/file_pirt_docLegal')."/".$list->file_pirt_docLegal}}"  /></td>
                                    </tr>
                                    <tr>
                                        <td>HALAL</td>
                                        <td>{{$list->halal_docLegal}}</td>
                                        <td><img src="{{ url('/uploads/file_halal_docLegal')."/".$list->file_halal_docLegal}}"  /></td>
                                    </tr>
                                    <tr>
                                        <td>BPOM</td>
                                        <td>{{$list->bpom_docLegal}}</td>
                                        <td><img src="{{ url('/uploads/bpom_docLegal')."/".$list->bpom_docLegal}}"  /></td>
                                    </tr>
                                    <tr>
                                        <td>HKI</td>
                                        <td>{{$list->hki_docLegal}}</td>
                                        <td><img src="{{ url('/uploads/hki_docLegal')."/".$list->hki_docLegal}}"  /></td>
                                    </tr>
                                    <tr>
                                        <td>MERK</td>
                                        <td>{{$list->merk_docLegal}}</td>
                                        <td><img src="{{ url('/uploads/file_merk_docLegal')."/".$list->file_merk_docLegal}}"  /></td>
                                    </tr>
                                    <tr>
                                        <td>Agreement</td>
                                        <td>{{$list->agreement_docLegal}}</td>
                                        <td><img src="{{ url('/uploads/file_agreement_docLegal')."/".$list->file_agreement_docLegal}}"  /></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
    <style>
        h2.group-title{
        margin-left:15px
        }
        section.content{
        margin : 0px 0 0 0px;
        }
    </style>
</section>
@section('js')
<script src="{{url('/plugins/jquery-steps/jquery.steps.js')}}"></script>
<script>
    $('#wizard_vertical').steps({
        headerTag: 'h2',
        bodyTag: 'section',
        transitionEffect: 'slideLeft',
        stepsOrientation: 'vertical',
        onInit: function (event, currentIndex) {
            setButtonWavesEffect(event);
        },
        onStepChanged: function (event, currentIndex, priorIndex) {
            setButtonWavesEffect(event);
        }
    });
</script>
@endsection
@stop
@stop
