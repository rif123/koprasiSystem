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
                <div class="pull-right" style="margin-top:-20px">
                    <a href="{{ url(route('config.anggotaDetail')) }}">
                        <button class="btn btn-warning waves-effect">Back</button>
                    </a>
                    <a href="{{ url(route('config.anggotaDetailExcel')).'?kd='.$list->kd_anggota }}">
                        <button class="btn bg-blue-grey waves-effect">Excel</button>
                    </a>
                </div>
            </div>
            <div class="row clearfix">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="body table-responsive">
                            <h5>Data Pribadi</h5>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Tempat Lahir</th>
                                        <th>NPWP</th>
                                        <th>No HP</th>
                                        <th>Email</th>
                                        <th>Alamat (rt/rw kec des )</th>
                                        <th>Wub Tahun</th>
                                        <th>Wub Dinas</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{$list->tempat_lahir_pribadi}}</td>
                                        <td>{{$list->npwp_pribadi}}</td>
                                        <td>{{$list->noHp_pribadi}}</td>
                                        <td>{{$list->email_pribadi}}</td>
                                        <td>{{$list->alamat_pribadi ." ". $list->rtRw_pribadi. " ".$list->kec_pribadi." ".$list->desKel_pribadi }}</td>
                                        <td>{{$list->wubTahun_pribadi}}</td>
                                        <td>{{$list->wubDinas_pribadi}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="body table-responsive">
                                <h5>Data Usaha</h5>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Brand</th>
                                            <th>Lama</th>
                                            <th>Jenis Produk</th>
                                            <th>Alamat Usaha</th>
                                            <th>Kapasitas</th>
                                            <th>Harga</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{$list->brand_usaha}}</td>
                                            <td>{{$list->lama_usaha}}</td>
                                            <td>{{$list->jenisProd_usaha}}</td>
                                            <td>{{$list->alamat_usaha." ".$list->rtRw_usaha." ".$list->kec_usaha." ".$list->kabKot_usaha}}</td>
                                            <td>{{$list->kapasitas_usaha}}</td>
                                            <td>{{$list->harga_usaha}}</td>

                                        </tr>
                                    </tbody>
                                </table>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Wilayah Offline</th>
                                            <th>Wilayah Online</th>
                                            <th>Jumlah Tenaga</th>
                                            <th>Omset</th>
                                            <th>Fb</th>
                                            <th>Instagram</th>
                                            <th>Twiiter</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <td>{{$list->wilayah_offline_usaha}}</td>
                                        <td>{{$list->wilayah_online_usaha}}</td>
                                        <td>{{$list->jumlahTenagaKerja_usaha}}</td>
                                        <td>{{$list->omset_usaha}}</td>
                                        <td>{{$list->fb_usaha}}</td>
                                        <td>{{$list->insta_usaha}}</td>
                                        <td>{{$list->twiiter_usaha}}</td>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="body table-responsive">
                                <h5>Document & file</h5>
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

@stop
@stop
