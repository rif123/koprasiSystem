    <h2 class="card-inside-title">Name</h2>
    <div class="input-group">
        <div class="form-line">
            <input type="text" class="form-control" name="nm_anggota" placeholder="Name"
            value=""/>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
      <h2 class="card-inside-title">Tempat Lahir</h2>
     <div class="input-group">
        <div class="form-line">
            <input type="text" class="form-control" name="tempat_lahir_pribadi" placeholder="Tempat Lahir"
            value="" 
            />
        </div>
      </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
        <h2 class="card-inside-title">Tanggal Lahir</h2>
        <div class="input-group">
            <div class="form-line">
                <input type="text" class="form-control" name="tanggal_lahir_pribadi" placeholder="Tanggal Lahir"
                value="" id = "tanggal_lahir_pribadi" onClick="getAllMenu()"
            />
            </div>
        </div>
      </div>
  
    <h2 class="card-inside-title">NPWP</h2>
    <div class="input-group">
        <div class="form-line">
            <input type="text" class="form-control" name="npwp_pribadi" placeholder="npwp"
                value="{{!empty($allData->npwp_pribadi) ? $allData->npwp_pribadi : '' }}"
            />
        </div>
    </div>
    <h2 class="card-inside-title">No Hp/ WA</h2>
    <div class="input-group">
        <div class="form-line">
            <input type="text" class="form-control" name="noHp_pribadi"
            value="{{!empty($allData->noHp_pribadi) ? $allData->noHp_pribadi : '' }}"
            placeholder="No Handphone / Wa" />
        </div>
    </div>
    <h2 class="card-inside-title">Email</h2>
    <div class="input-group">
        <div class="form-line">
            <input type="text" class="form-control" name="email_pribadi"
                value="{{!empty($allData->email_pribadi) ? $allData->email_pribadi : '' }}"
            placeholder="Email" />
        </div>
    </div>
    <h2 class="card-inside-title">Alamat</h2>
    <div class="input-group">
        <div class="form-line">
            <input type="text" class="form-control" name="alamat_pribadi"
            value="{{!empty($allData->alamat_pribadi) ? $allData->alamat_pribadi : '' }}"
            placeholder="Alamat" />
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
        <h2 class="card-inside-title">Rt/Rw</h2>
        <div class="form-group form-float">
            <div class="form-line">
                <input type="text" class="form-control"
                value="{{!empty($allData->rtRw_pribadi) ? $allData->rtRw_pribadi : '' }}"
                name="rtRw_pribadi">
                <label class="form-label">Rt/Rw</label>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
        <h2 class="card-inside-title">Desa/Kelurahan</h2>
        <div class="form-group form-float">
            <div class="form-line">
                <input type="text" class="form-control" name="desKel_pribadi"
                    value="{{!empty($allData->desKel_pribadi) ? $allData->desKel_pribadi : '' }}"
                >
                <label class="form-label">Desa/Kelurahan</label>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
        <h2 class="card-inside-title">Kecamatan</h2>
        <div class="form-group form-float">
            <div class="form-line">
                <input type="text" class="form-control" name="kec_pribadi"
                    value="{{!empty($allData->kec_pribadi) ? $allData->kec_pribadi : '' }}"
                >
                <label class="form-label">Kecamatan</label>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
        <h2 class="card-inside-title">Kab/kot</h2>
        <div class="form-group form-float">
            <div class="form-line">
                <input type="text" class="form-control" name="kabkot_pribadi"
                    value="{{!empty($allData->kabkot_pribadi) ? $allData->kabkot_pribadi : '' }}"
                >
                <label class="form-label">Kecamatan</label>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
        <h2 class="card-inside-title">WUB Tahun</h2>
        <div class="form-group form-float">
            <div class="form-line">
                <input type="text" class="form-control" name="wubTahun_pribadi"
                    value="{{!empty($allData->wubTahun_pribadi) ? $allData->wubTahun_pribadi : '' }}"
                >
                <label class="form-label">WUB Tahun</label>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
        <h2 class="card-inside-title">WUB Dinas</h2>
        <div class="form-group form-float">
            <div class="form-line">
                <input type="text" class="form-control" name="wubDinas_pribadi"
                    value="{{!empty($allData->wubDinas_pribadi) ? $allData->wubDinas_pribadi : '' }}"
                >
                <label class="form-label">Wub Dinas</label>
            </div>
        </div>
    </div>

