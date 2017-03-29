<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MAnggota extends Model {
    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'm_anggota';
    public $timestamps = false;
	protected $fillable = ['kd_anggota', 'nm_anggota', 'kd_jabatan', 'pasPhoto_anggota'];

}
