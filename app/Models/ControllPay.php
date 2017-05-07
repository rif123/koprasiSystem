<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ControllPay extends Model
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
    private static $field = ['no_swajib', 'kd_anggota', 'jml_bayar_wajib', 'bkt_bayar_wajib', 'tgl_bayar_wajib'];
    public static function column_order()
    {
        return  ['nm_anggota', 'pay', 'payMonth','jml_bayar_wajib'];
    }
    public static function getAll()
    {
        $kdAnggota = \Session::get('kd_anggota');
        $input = \Input::get('search.value');
        $get = \Input::all();

        $where = "";
        if (!empty($input)) {
            $where = "WHERE ";
            $count = count(self::column_order()) -1;
            foreach (self::column_order() as $key => $value) {
                $where .= $value . " LIKE '%".$input."%'";
                if ($key <  $count) {
                    $where .= " OR ";
                }
            }
        }
        if (!empty($get['bln'])) {
            if (!empty($where)) {
                $where .= " and MONTH(tgl_bayar_wajib) = ".$get['bln'];
            } else {
                $where .= " WHERE MONTH(tgl_bayar_wajib) = ".$get['bln'];
            }
        }
        $order = "";
        if (!empty(\Input::get('order'))) { // here order processing
            $colum  = self::column_order();
            $col  = $colum[$_GET['order']['0']['column']];
            $order = "ORDER BY  ".$col." ".$_GET['order']['0']['dir'];
        }
        // limit 10 OFFSET 1
        $start = \Input::get('start');
        $length = \Input::get('length');
        $limit = "";
        if (!empty($start) && !empty($length)) {
            $limit  = "LIMIT ".$length." OFFSET ".$start;
        }
        $query = "
                select * from (
                    select  tsw.tgl_bayar_wajib,  tsw.kd_anggota,  tsw.status, tsw.jml_bayar_wajib, tsw.bkt_bayar_wajib,  'Simpanan wajib' as pay,  MONTHNAME(tgl_bayar_wajib) as payMonth, kd_swajib as id_pay
                    from t_simpan_wajib as tsw
                    UNION ALL
                    select tsp.tgl_bayar_spokok,  tsp.kd_anggota, tsp.status,  tsp.jml_bayar_spokok, tsp.bukti_bayar_spokok,  'Simpanan Pokok' as pay, MONTHNAME(tgl_bayar_spokok) as payMonth, kd_spokok as id_pay
                    from t_simpan_pokok  as tsp
                    ORDER BY pay asc
                    ) as hh
                    JOIN m_anggota as ma on hh.kd_anggota = ma.kd_anggota
                ".$where."
				".$order."
                ".$limit."
                ";
        $listData = \DB::select($query);
        return $listData;
    }


    public static function getOne($parameter)
    {
        $query = "select * from (
   select  tsw.tgl_bayar_wajib,  tsw.kd_anggota,  tsw.status, tsw.jml_bayar_wajib, tsw.bkt_bayar_wajib,  'Simpanan wajib' as pay,  MONTHNAME(tgl_bayar_wajib) as payMonth, kd_swajib as id_pay
    from t_simpan_wajib as tsw
    UNION ALL
    select tsp.tgl_bayar_spokok,  tsp.kd_anggota, tsp.status,  tsp.jml_bayar_spokok, tsp.bukti_bayar_spokok,  'Simpanan Pokok' as pay, MONTHNAME(tgl_bayar_spokok) as payMonth, kd_spokok as id_pay
    from t_simpan_pokok  as tsp
    ORDER BY pay asc
        ) as hh
        JOIN m_anggota as ma on hh.kd_anggota = ma.kd_anggota
    where hh.id_pay = '".$parameter['id_pay']."' and LOWER (hh.pay) = LOWER('".$parameter['pay']."')";
        $listData = \DB::select($query);
        return $listData;
    }
}
