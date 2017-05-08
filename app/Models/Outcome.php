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
    public static function column_order()
    {
        return  ['tgl_outcome', 'jml_outcome','ket_outcome','pic_outcome', "id_outcome"];
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
                if ($value == 'tgl_outcome') {
                    $where .= "MONTHNAME(".$value.")" . " LIKE '%".$input."%'";
                    if ($key <  $count) {
                        $where .= " OR ";
                    }
                } else {
                    $where .= $value . " LIKE '%".$input."%'";
                    if ($key <  $count) {
                        $where .= " OR ";
                    }
                }
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
        $query = " select * from t_outcome
				".$where."
				".$order."
                ".$limit."
                ";
        $listData = \DB::select($query);
        return $listData;
    }

    public static function getAllOutcome()
    {
        $kdAnggota = \Session::get('kd_anggota');
        $input = \Input::get('search.value');
        $get = \Input::all();
        $where = "";
        if (!empty($input)) {
            $where = "WHERE ";
            $count = count(self::column_order()) -1;
            foreach (self::column_order() as $key => $value) {
                if ($value == 'tgl_outcome') {
                    $where .= "MONTHNAME(".$value.")" . " LIKE '%".$input."%'";
                    if ($key <  $count) {
                        $where .= " OR ";
                    }
                } else {
                    $where .= $value . " LIKE '%".$input."%'";
                    if ($key <  $count) {
                        $where .= " OR ";
                    }
                }
            }
        }


        if (!empty($get['bln'])) {
            if (!empty($where)) {
                $where .= " and MONTH(tgl_outcome) = '".$get['bln']."'";
            } else {
                $where .= " WHERE MONTH(tgl_outcome) = '".$get['bln']."'";
            }
        }
        if (!empty($get['PIC'])) {
            if (!empty($where)) {
                $where .= " and pic_outcome like '%".$get['PIC']."%'";
            } else {
                $where .= " WHERE pic_outcome  like '%".$get['PIC']."%'";
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
        if (!empty($length) &&  !empty($length)) {
            $limit  = "LIMIT ".$length." OFFSET ".$start;
        }
        $query = " select * from t_outcome
                ".$where."
                ".$order."
                ".$limit."
                ";
        $listData = \DB::select($query);
        return $listData;


    }
}

