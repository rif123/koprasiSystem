<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Save extends Model
{
    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 't_simpan_wajib';
    protected $primaryKey = 'kd_swajib';
    public $timestamps = false;
    protected $fillable = ['kd_swajib', 'no_swajib', 'kd_anggota', 'jml_bayar_wajib', 'bkt_bayar_wajib', 'tgl_bayar_wajib'];
    static private $field = ['no_swajib', 'kd_anggota', 'jml_bayar_wajib', 'bkt_bayar_wajib', 'tgl_bayar_wajib'];

    public static function getAll()
    {
        $kdAnggota = \Session::get('kd_anggota');
        $input = \Input::get('search.value');
        $where = "";
        if (!empty($input)) {
                $where = " WHERE pay like '%".$input."%' OR total like '%".$input."%' ";
        }
        // limit 10 OFFSET 1
        $start = \Input::get('start');
        $length = \Input::get('length');
        $limit  = "LIMIT ".$length." OFFSET ".$start;
        $query = "
                select * from (
                    select *, 'Simpanan wajib' as pay,  MONTHNAME(tgl_bayar_wajib) as payMonth,
                    sum(bkt_bayar_wajib) as total
                    from t_simpan_wajib as tsw  where tsw.kd_anggota = '".$kdAnggota."'
                    and  MONTH(tsw.tgl_bayar_wajib) >= MONTH(now())
                     and MONTH(tsw.tgl_bayar_wajib) <= MONTH(DATE_ADD( CURDATE(), INTERVAL 4 MONTH))
                    GROUP BY YEAR(tsw.tgl_bayar_wajib), MONTH(tsw.tgl_bayar_wajib)
                    UNION ALL
                    select *, 'Simpanan Pokok', MONTHNAME(tgl_bayar_spokok) as payMonth,  sum(jml_bayar_spokok) as total from t_simpan_pokok  as tsp
                    where kd_anggota = '".$kdAnggota."'
                    and  MONTH(tsp.tgl_bayar_spokok) >= MONTH(now())
                     and MONTH(tsp.tgl_bayar_spokok) <= MONTH(DATE_ADD( CURDATE(), INTERVAL 4 MONTH))
                    GROUP BY YEAR(tsp.tgl_bayar_spokok), MONTH(tsp.tgl_bayar_spokok)
                    ORDER BY pay asc
                ) as hh
                ".$where."
                ".$limit."
                ";
        $listData = \DB::select($query);
        return $listData;
    }
    public static function getCountAll()
    {
        $kdAnggota = \Session::get('kd_anggota');
        $input = \Input::get('search.value');
        $where = "";
        if (!empty($input)) {
            $where = " WHERE pay like '%".$input."%' OR total like '%".$input."%' ";
        }

        $query = "
                select count(*) as count from (
                    select *, 'Simpanan wajib' as pay,  sum(bkt_bayar_wajib) as total
                    from t_simpan_wajib as tsw  where tsw.kd_anggota = '".$kdAnggota."'
                    and  MONTH(tsw.tgl_bayar_wajib) >= MONTH(now())
                     and MONTH(tsw.tgl_bayar_wajib) <= MONTH(DATE_ADD( CURDATE(), INTERVAL 4 MONTH))
                    GROUP BY YEAR(tsw.tgl_bayar_wajib), MONTH(tsw.tgl_bayar_wajib)
                    UNION ALL
                    select  *, 'Simpanan Pokok',  sum(jml_bayar_spokok) as total from t_simpan_pokok  as tsp
                    where kd_anggota = '".$kdAnggota."'
                    and  MONTH(tsp.tgl_bayar_spokok) >= MONTH(now())
                    and MONTH(tsp.tgl_bayar_spokok) <= MONTH(DATE_ADD( CURDATE(), INTERVAL 4 MONTH))
                    GROUP BY YEAR(tsp.tgl_bayar_spokok), MONTH(tsp.tgl_bayar_spokok)
                ) as unionTable
                ".$where."
                ";
        $listData = \DB::select($query);
        return $listData;
    }
}
