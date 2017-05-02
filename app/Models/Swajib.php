<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Swajib extends Model
{
    protected $table = 't_simpan_wajib';
    protected $primaryKey = 'kd_swajib';
    public $timestamps = false;
    protected $fillable = ['kd_wajib', 'jml_bayar_wajib', 'bkt_bayar_wajib', 'tgl_bayar_wajib','no_swajib','kd_anggota','status'];

    public static function column_order()
    {
        return  ['jml_bayar_wajib', 'bkt_bayar_wajib', 'tgl_bayar_wajib','status','no_swajib'];
    }
    public static function getAll()
    {
        $kdAnggota = \Session::get('kd_anggota');
        $input = \Input::get('search.value');
		$get = \Input::all();
		$where = "";
        if (!empty($input)) {
            $where = " WHERE pay like '%".$input."%' OR total like '%".$input."%' ";
        }

		if (!empty($get['bln'])) {
			if (!empty($where)) {
				$where .= " and MONTH(tgl_bayar_wajib) = ".$get['bln'];
			} else {
				$where .= " WHERE MONTH(tgl_bayar_wajib) = ".$get['bln'];
			}
		}

        if (!empty($kdAnggota)) {
            if (!empty($where)) {
                $where .= " and kd_anggota = ".$kdAnggota;
            } else {
                $where .= " WHERE kd_anggota = ".$kdAnggota;
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
        $limit  = "LIMIT ".$length." OFFSET ".$start;
        $query = " select * from t_simpan_wajib
				".$where."
				".$order."
                ".$limit."
                ";
        $listData = \DB::select($query);
        return $listData;
    }
}
