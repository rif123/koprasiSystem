<div class="row clearfix">
    <div class="col-md-12">
        <h2 class="card-inside-title">Npwp</h2>
        <div class="col-md-4">
            <div class="input-group">
                <div class="form-line">
                    <input type="text" name="npwp_docLegal" class="form-control date"
                        value="{{!empty($allData->npwp_docLegal) ? $allData->npwp_docLegal : '' }}"
                     placeholder="Npwp">
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="input-group">
                <div class="form-line">
                    <input type="file" name="file_npwp_docLegal" class="form-control date" placeholder="Npwp">
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="input-group">
                <img style="width:100%; height:100%" alt="NO IMAGE"  src="{{ url('/uploads/file_npwp_docLegal') }}/{{!empty($allData->file_npwp_docLegal) ? $allData->file_npwp_docLegal : '' }}" />
            </div>
        </div>
    </div>


    <div class="col-md-12">
        <h2 class="card-inside-title">SITU</h2>
        <div class="col-md-4">
            <div class="input-group">
                <div class="form-line">
                    <input type="text" name="situ_docLegal" class="form-control date"
                        value="{{!empty($allData->situ_docLegal) ? $allData->situ_docLegal : '' }}"
                    placeholder="SITU">
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="input-group">
                <div class="form-line">
                    <input type="file" name="file_situ_docLegal" class="form-control date" placeholder="SItu">
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="input-group">
                <img style="width:100%; height:100%" alt="NO IMAGE"  src="{{ url('/uploads/file_situ_docLegal') }}/{{!empty($allData->file_situ_docLegal) ? $allData->file_situ_docLegal : '' }}" />
            </div>
        </div>

    </div>





    <div class="col-md-12">
        <h2 class="card-inside-title">SIUP</h2>
        <div class="col-md-4">
            <div class="input-group">
                <div class="form-line">
                    <input type="text" name="siup_docLegal" class="form-control date"
                            value="{{!empty($allData->siup_docLegal) ? $allData->siup_docLegal : '' }}"
                    placeholder="SIUP">
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="input-group">
                <div class="form-line">
                    <input type="file" name="file_siup_docLegal" class="form-control" placeholder="siup">
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="input-group">
                <img style="width:100%; height:100%" alt="NO IMAGE"  src="{{ url('/uploads/file_siup_docLegal') }}/{{!empty($allData->file_siup_docLegal) ? $allData->file_siup_docLegal : '' }}" />
            </div>
        </div>

    </div>



    <div class="col-md-12">
        <h2 class="card-inside-title">TDP</h2>
        <div class="col-md-4">
            <div class="input-group">
                <div class="form-line">
                    <input type="text" name="tdp_docLegal" class="form-control date"
                    value="{{!empty($allData->tdp_docLegal) ? $allData->tdp_docLegal : '' }}"
                     placeholder="TDP">
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="input-group">
                <div class="form-line">
                    <input type="file" name="file_tdp_docLegal" class="form-control date" placeholder="Npwp">
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="input-group">
                <img style="width:100%; height:100%" alt="NO IMAGE"  src="{{ url('/uploads/file_tdp_docLegal') }}/{{!empty($allData->file_tdp_docLegal) ? $allData->file_tdp_docLegal : '' }}" />
            </div>
        </div>
    </div>


    <div class="col-md-12">
        <h2 class="card-inside-title">PIRT</h2>
        <div class="col-md-4">
            <div class="input-group">
                <div class="form-line">
                    <input type="text" name="pirt_docLegal" class="form-control date"
                    value="{{!empty($allData->pirt_docLegal) ? $allData->pirt_docLegal : '' }}"
                    placeholder="PIRT">
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="input-group">
                <div class="form-line">
                    <input type="file" name="file_pirt_docLegal" class="form-control date" placeholder="Npwp">
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="input-group">
                <img style="width:100%; height:100%" alt="NO IMAGE"  src="{{ url('/uploads/file_pirt_docLegal') }}/{{!empty($allData->file_pirt_docLegal) ? $allData->file_pirt_docLegal : '' }}" />
            </div>
        </div>
    </div>


    <div class="col-md-12">
        <h2 class="card-inside-title">HALAL</h2>
        <div class="col-md-4">
            <div class="input-group">
                <div class="form-line">
                    <input type="text" name="halal_docLegal" class="form-control date" placeholder="HALAL">
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="input-group">
                <div class="form-line">
                    <input type="file" name="file_halal_docLegal" class="form-control date" placeholder="Npwp">
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="input-group">
                <img style="width:100%; height:100%" alt="NO IMAGE"  src="{{ url('/uploads/file_halal_docLegal') }}/{{!empty($allData->file_halal_docLegal) ? $allData->file_halal_docLegal : '' }}" />
            </div>
        </div>
    </div>


    <div class="col-md-12">
        <h2 class="card-inside-title">BPOM</h2>
        <div class="col-md-4">
            <div class="input-group">
                <div class="form-line">
                    <input type="text" name="bpom_docLegal" class="form-control date"
                        value="{{!empty($allData->bpom_docLegal) ? $allData->bpom_docLegal : '' }}"
                     placeholder="BPOM">
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="input-group">
                <div class="form-line">
                    <input type="file" name="file_bpom_docLegal" class="form-control date" placeholder="Npwp">
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="input-group">
                <img style="width:100%; height:100%" alt="NO IMAGE"  src="{{ url('/uploads/file_bpom_docLegal') }}/{{!empty($allData->file_bpom_docLegal) ? $allData->file_bpom_docLegal : '' }}" />
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <h2 class="card-inside-title">HKI</h2>
        <div class="col-md-4">
            <div class="input-group">
                <div class="form-line">
                    <input type="text" name="hki_docLegal" class="form-control date"
                        value="{{!empty($allData->hki_docLegal) ? $allData->hki_docLegal : '' }}"
                    placeholder="HKI">
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="input-group">
                <div class="form-line">
                    <input type="file" name="file_hki_docLegal" class="form-control date" placeholder="Npwp">
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="input-group">
                <img style="width:100%; height:100%" alt="NO IMAGE"  src="{{ url('/uploads/file_hki_docLegal') }}/{{!empty($allData->file_hki_docLegal) ? $allData->file_hki_docLegal : '' }}" />
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <h2 class="card-inside-title">Merk Dagang</h2>
        <div class="col-md-4">
            <div class="input-group">
                <div class="form-line">
                    <input type="text" name="merk_docLegal" class="form-control date" placeholder="Merek Dagang">
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="input-group">
                <div class="form-line">
                    <input type="file" name="file_merk_docLegal" class="form-control date" placeholder="Npwp">
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="input-group">
                <img style="width:100%; height:100%" alt="NO IMAGE"  src="{{ url('/uploads/file_merk_docLegal') }}/{{!empty($allData->file_merk_docLegal) ? $allData->file_merk_docLegal : '' }}" />
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <h2 class="card-inside-title">Lainnya</h2>
        <div class="col-md-4">
            <div class="input-group">
                <div class="form-line">
                    <input type="text" name="agreement_docLegal" class="form-control date"
                    value="{{!empty($allData->agreement_docLegal) ? $allData->agreement_docLegal : '' }}"
                    placeholder="Lainnya">
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="input-group">
                <div class="form-line">
                    <input type="file" name="file_agreement_docLegal" class="form-control date" placeholder="Npwp">
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="input-group">
                <img style="width:100%; height:100%" src="{{ url('/uploads/file_agreement_docLegal') }}/{{ !empty($allData->file_agreement_docLegal) ? $allData->file_agreement_docLegal : '' }}" alt="NO IMAGE" />
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <h2 class="card-inside-title">Lainnya</h2>
        <div class="col-md-7">
            <div class="input-group">
                <div class="form-line">
                    <input type="file" name="pasPhoto_anggota" class="form-control"
                        value="{{!empty($allData->pasPhoto_anggota) ? $allData->pasPhoto_anggota : '' }}"
                    placeholder="Pas Photo">
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="input-group">
                <img style="width:100%; height:100%" src="{{ url('/uploads/pasPhoto_anggota') }}/{{ !empty($allData->pasPhoto_anggota) ? $allData->file_agreement_docLegal : '' }}" alt="NO IMAGE" />
            </div>
        </div>

    </div>

    <div class="col-md-12">
        <h2 class="card-inside-title">Agreement</h2>
        <div class="input-group">
            <div class="input-group input-group-lg">
               <span class="input-group-addon">
                   <input type="checkbox" class="filled-in" id="ig_checkbox">
                   <label for="ig_checkbox"></label>
               </span>
               <div class="form-line">
                   Dengan ini saya menyatakan pengajuan menjadi anggota Koperasi WUB Jabar Sejahtera (WJS) serta menyetujui Simpanan Pokok dibayar 1x selama menjadi anggota dan dapat dicicil selama 2 (dua) bulan sebesar Rp.250.000,- serta menyetujui simpanan wajib yang dapat diambil ketika anggota mengundurkan diri atau keluar dari koperasi. Simpanan wajib sebesar Rp.50.000,- perbulan. (PEMBAYARAN HANYA DILAKUKAN KEPADA BENDAHARA WJS DAN WAJIB MENGGUNAKAN TANDA BUKTI PEMBAYARAN).
               </div>
           </div>
        </div>
    </div>
</div>
