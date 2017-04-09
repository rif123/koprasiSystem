<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Save extends Model {
    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 't_simpan_wajib';
    protected $primaryKey = 'kd_swajib';
    public $timestamps = false;
    protected $fillable = ['kd_swajib', 'no_swajib', 'kd_anggota', 'jml_bayar_wajib', 'bkt_bayar_wajib', 'tgl_bayar_wajib'];


    public static function getAll(){
        $query = "";
        $role = \DB::select($query);
        return $role;
    }
}
