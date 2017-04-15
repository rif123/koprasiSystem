<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MdataPribadi extends Model
{
    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'm_data_pribadi';

    public $timestamps = false;
    protected $fillable = ['kd_anggota','tempat_lahir_pribadi', 'npwp_pribadi', 'noHp_pribadi', 'email_pribadi', 'alamat_pribadi', 'rtRw_pribadi', 'kec_pribadi', 'desKel_pribadi', 'wubTahun_pribadi', 'wubDinas_pribadi', 'created', 'create_date','updated', 'update_date'];
}
