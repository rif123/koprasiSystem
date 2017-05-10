<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MDataUsaha extends Model {
    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'm_data_usaha';
    public $timestamps = false;
    protected $fillable = ['kd_anggota', 'brand_usaha','lama_usaha','jenisProd_usaha', 'alamat_usaha', 'rtRw_usaha', 'kec_usaha','kel_usaha', 'kabKot_usaha', 'kapasitas_usaha','harga_usaha','wilayah_offline_usaha', 'wilayah_online_usaha', 'jumlahTenagaKerja_usaha', 'omset_usaha', 'fb_usaha', 'insta_usaha', 'twiiter_usaha', 'created', 'create_date', 'edited', 'edited_date'];
}
