<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Income extends Model {

    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 't_income';
    protected $primaryKey = 'id_income';
    public $timestamps = false;
    protected $fillable = ['id_income', 'kd_anggota', 'tgl_income', 'jml_income', 'pic_income','ket_income'];
}
