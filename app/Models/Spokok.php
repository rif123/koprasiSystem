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
    public static function column_order()
    {
        return  ['jml_bayar_spokok', 'tgl_bayar_spokok', 'bukti_bayar_spokok','kd_anggota','status_spokok'];
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
                $where .= " and MONTH(tgl_bayar_spokok) = ".$get['bln'];
            } else {
                $where .= " WHERE MONTH(tgl_bayar_spokok) = ".$get['bln'];
            }
        }

        if (!empty($get['wilayah'])) {
            if (!empty($where)) {
                $where .= " or wilayah_offline_usaha  like '%".$get['wilayah']."%'";
            } else {
                $where .= " WHERE wilayah_offline_usaha like '%".$get['wilayah']."%'";
            }
            if (!empty($where)) {
                $where .= " or wilayah_online_usaha  like '%".$get['wilayah']."%'";
            } else {
                $where .= " WHERE wilayah_online_usaha like '%".$get['wilayah']."%'";
            }
        }

        if (!empty($kdAnggota)) {
            if (!empty($where)) {
                $where .= " and tsw.kd_anggota = ".$kdAnggota;
            } else {
                $where .= " WHERE tsw.kd_anggota = ".$kdAnggota;
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
        $query = " select * from t_simpan_pokok as tsw
                    LEFT JOIN m_anggota ma on tsw.kd_anggota  = ma.kd_anggota
                    LEFT JOIN m_data_usaha mdu on mdu.kd_anggota = tsw.kd_anggota
				".$where."
				".$order."
                ".$limit."
                ";
        // print_R($query);die;
        $listData = \DB::select($query);
        return $listData;
    }

}
