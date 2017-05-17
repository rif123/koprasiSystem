<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

    class MAnggota extends Model {
    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'm_anggota';
    protected $primaryKey = 'kd_anggota';
    public $timestamps = false;
	protected $fillable = ['kd_anggota', 'nm_anggota', 'kd_jabatan', 'pasPhoto_anggota'];


    public static function getALlData ($kd_anggota) {
        $query  = "select * from m_anggota  as ma
                    LEFT JOIN m_data_pribadi as mdp on ma.kd_anggota = mdp.kd_anggota
                    LEFT JOIN m_data_docLegal as mdd on ma.kd_anggota = mdd.kd_anggota
                    LEFT JOIN m_data_usaha as mdu on ma.kd_anggota = mdu.kd_anggota
                    WHERE ma.kd_anggota  = '".$kd_anggota."'
                    ";
        $listData = \DB::select($query);
        return $listData;
    }

    public static function checkDataAnggota($db,$kd_anggota) {
        $query  = 'select count(*) as kdAggota from '.$db.' where kd_anggota = "'.$kd_anggota.'" ';
        $listData = \DB::select($query);
        return $listData;
    }

    public static function getALlNoWhere () {
        $query  = "select * from m_anggota  as ma
                    LEFT JOIN m_data_pribadi as mdp on ma.kd_anggota = mdp.kd_anggota
                    LEFT JOIN m_data_docLegal as mdd on ma.kd_anggota = mdd.kd_anggota
                    LEFT JOIN m_data_usaha as mdu on ma.kd_anggota = mdu.kd_anggota
                    WHERE  ma.pasPhoto_anggota IS NOT NULL
                    ORDER BY RAND()
                    LIMIT 10
                    ";
        $listData = \DB::select($query);
        return $listData;
    }

}
