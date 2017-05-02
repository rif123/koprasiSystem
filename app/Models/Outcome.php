<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Outcome extends Model {

    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 't_outcome';
    protected $primaryKey = 'id_outcome';
    public $timestamps = false;
    protected $fillable = ['id_outcome', 'kd_anggota', 'tgl_outcome', 'jml_outcome', 'pic_outcome','ket_outcome'];
}
