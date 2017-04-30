<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Spokok extends Model {

    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 't_simpan_pokok';
    protected $primaryKey = 'kd_spokok';
    public $timestamps = false;
    protected $fillable = ['kd_spokok', 'no_spokok', 'jml_bayar_spokok', 'tgl_bayar_spokok', 'bukti_bayar_spokok', 'kd_anggota','status'];
}
