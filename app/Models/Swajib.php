<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Swajib extends Model {

	protected $table = 't_simpan_wajib';
	protected $primaryKey = 'kd_swajib';
	public $timestamps = false;
	protected $fillable = ['kd_wajib', 'jml_bayar_wajib', 'bkt_bayar_wajib', 'tgl_bayar_wajib','no_swajib','kd_anggota','status'];

}
