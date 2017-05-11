<div class="row clearfix">
    <div class="col-md-12">
        <h2 class="card-inside-title">Jenis Usaha</h2>
        <div class="input-group">
            <div class="form-line">
                <select name="jenis_usaha" class="form-control jenis_usaha">
                    @foreach($jenisUsaha as $k => $v)
                        <option value="{{ $v->nama_jenis_usaha }}">{{$v->nama_jenis_usaha}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</div>
<div class="row clearfix">
    <h2 class="card-inside-title group-title">Brand</h2>
    <div class="col-md-6">
        <div class="input-group">
            <div class="form-line">
                <input type="text" name="brand_usaha" class="form-control date"
                value="{{!empty($allData->brand_usaha) ? $allData->brand_usaha : '' }}"
                placeholder="nama Brand">
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="input-group">
            <div class="form-line">
                <input type="text" name="lama_usaha" class="form-control date"
                        value="{{!empty($allData->lama_usaha) ? $allData->lama_usaha : '' }}"
                placeholder="Lama Usaha">
            </div>
        </div>
    </div>
</div>
<div class="row clearfix">
    <h2 class="card-inside-title group-title">Jenis Produk</h2>
    <div class="col-md-12">
        <div class="input-group">
            <div class="form-line">
                <input type="text" name="jenisProd_usaha" class="form-control date"
                value="{{!empty($allData->jenisProd_usaha) ? $allData->jenisProd_usaha : '' }}"
                placeholder="Jenis Produk">
            </div>
        </div>
    </div>
</div>
<div class="row clearfix">
    <div class="input-group" style="width:0px">
        <div class="input-group input-group-lg" style="margin-right: 30px;">
           <span class="input-group-addon">
                   <input type="checkbox" class="filled-in event-address-pribadi" id="ig_checkbox">
               <label for="ig_checkbox">Pilih jika alamat sama alamat pribadi</label>
           </span>
       </div>
    </div>
</div>
<div class="row clearfix">
    <h2 class="card-inside-title group-title">Alamat</h2>
    <div class="col-md-4">
        <div class="input-group">
            <div class="form-line">
                <input type="text" name="alamat_usaha" class="form-control date"
                value="{{!empty($allData->alamat_usaha) ? $allData->alamat_usaha : '' }}"
                placeholder="Alamat">
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="input-group">
            <div class="form-line">
                <input type="text" name="rtRw_usaha" class="form-control date"
                value="{{!empty($allData->rtRw_usaha) ? $allData->rtRw_usaha : '' }}"
                placeholder="Rt/Rw">
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="input-group">
            <div class="form-line">
                <input type="text" name="kec_usaha" class="form-control date"
                value="{{!empty($allData->kec_usaha) ? $allData->kec_usaha : '' }}"
                placeholder="Kecamatan">
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="input-group">
            <div class="form-line">
                <input type="text" name="kel_usaha" class="form-control date"
                value="{{!empty($allData->kel_usaha) ? $allData->kel_usaha : '' }}"
                placeholder="Kelurahan">
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="input-group">
            <div class="form-line">
                <input type="text" name="kabKot_usaha" class="form-control date"
                    value="{{!empty($allData->kabKot_usaha) ? $allData->kabKot_usaha : '' }}"
                placeholder="Kab/Kot">
            </div>
        </div>
    </div>
</div>

<div class="row clearfix">
    <h2 class="card-inside-title group-title">Kapasitas Produksi</h2>
    <div class="col-md-6">
        <div class="input-group">
            <div class="form-line">
                <input type="text" name="kapasitas_usaha" class="form-control date"
                value="{{!empty($allData->kapasitas_usaha) ? $allData->kapasitas_usaha : '' }}"
                placeholder="Kapasitas">
            </div>
            <span class="input-group-addon">/Bulan</span>
        </div>
    </div>
    <div class="col-md-6">
        <div class="input-group">
            <div class="form-line">
                <input type="text" name="harga_usaha" class="form-control date"
                    value="{{!empty($allData->harga_usaha) ? $allData->harga_usaha : '' }}"
                placeholder="Harga Jual">
            </div>
            <span class="input-group-addon">/Bulan</span>
        </div>
    </div>
    <!--
    <div class="col-md-1">
        <div class="input-group">
            <div class="form-line">
                <input type="text" name="harga_usaha" class="form-control date"
                placeholder="/Bulan" value="/Bulan" disabled>
            </div>
        </div>
    </div>
-->
</div>


<div class="row clearfix">
    <h2 class="card-inside-title group-title">Wilayah Pemasaran</h2>
    <div class="col-md-6">
        <div class="input-group">
            <div class="form-line">
                <input type="text" name="wilayah_offline_usaha" class="form-control date"
                value="{{!empty($allData->wilayah_offline_usaha) ? $allData->wilayah_offline_usaha : '' }}"
                placeholder="Offline">
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="input-group">
            <div class="form-line">
                <input type="text" name="wilayah_online_usaha" class="form-control date"
                    value="{{!empty($allData->wilayah_online_usaha) ? $allData->wilayah_online_usaha : '' }}"
                placeholder="Online">
            </div>
        </div>
    </div>
</div>


<div class="row clearfix">
    <h2 class="card-inside-title group-title">Jumlah Tenaga</h2>
    <div class="col-md-6">
        <div class="input-group">
            <div class="form-line">
                <input type="text" name="jumlahTenagaKerja_usaha" class="form-control date"
                value="{{!empty($allData->jumlahTenagaKerja_usaha) ? $allData->jumlahTenagaKerja_usaha : '' }}"
                placeholder="Jumlah Tenaga Kerja">
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="input-group">
            <div class="form-line">
                <input type="text" name="omset_usaha" class="form-control date"
                value="{{!empty($allData->omset_usaha) ? $allData->omset_usaha : '' }}"
                placeholder="Omset Usaha">
            </div>
        </div>
    </div>
</div>

<div class="row clearfix">
    <h2 class="card-inside-title group-title">Media Sosial</h2>
    <div class="col-md-4">
        <div class="input-group">
            <div class="form-line">
                <input type="text" name="fb_usaha" class="form-control date"
                value="{{!empty($allData->fb_usaha) ? $allData->fb_usaha : '' }}"
                placeholder="Facebook">
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="input-group">
            <div class="form-line">
                <input type="text" name="insta_usaha" class="form-control date"
                    value="{{!empty($allData->insta_usaha) ? $allData->insta_usaha : '' }}"
                placeholder="Instagram">
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="input-group">
            <div class="form-line">
                <input type="text" name="twiiter_usaha" class="form-control date"
                    value="{{!empty($allData->twiiter_usaha) ? $allData->twiiter_usaha : '' }}"
                 placeholder="Twiiter">
            </div>
        </div>
    </div>
</div>
