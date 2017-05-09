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
    public static function column_order()
    {
        return  ['tgl_income', 'jml_income','pic_income','ket_income', "id_income"];
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
                if ($value == 'tgl_income') {
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
        $limit = "";
        if(!empty($length) && !empty($start)) {
            $limit  = "LIMIT ".$length." OFFSET ".$start;
        }
        $query = " select * from t_income
				".$where."
				".$order."
                ".$limit."
                ";
        $listData = \DB::select($query);
        return $listData;
    }

    public static function getAllForSum()
    {
        $kdAnggota = \Session::get('kd_anggota');
        $input = \Input::get('search.value');
        $get = \Input::all();
        $where = "";
        if (!empty($input)) {
            $where = "WHERE ";
            $count = count(self::column_order()) -1;
            foreach (self::column_order() as $key => $value) {
                if ($value == 'tgl_income') {
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
        if (!empty($kdAnggota)) {
            if (!empty($where)) {
                $where .= " and kd_anggota = '".$kdAnggota."'";
            } else {
                $where .= " WHERE kd_anggota = '".$kdAnggota."'";
            }
        }
        // limit 10 OFFSET 1
        $start = \Input::get('start');
        $length = \Input::get('length');
        $limit = "";
        if(!empty($length) && !empty($start)) {
            $limit  = "LIMIT ".$length." OFFSET ".$start;
        }
        $query = " select * from t_income
				".$where."
				".$order."
                ".$limit."
                ";
        $listData = \DB::select($query);
        return $listData;
    }
    public static function getAllIncome()
    {
        $kdAnggota = \Session::get('kd_anggota');
        $input = \Input::get('search.value');
        $get = \Input::all();
        $where = "";
        if (!empty($input)) {
            $where = "WHERE ";
            $count = count(self::column_order()) -1;
            foreach (self::column_order() as $key => $value) {
                if ($value == 'tgl_income') {
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

        if (!empty($get['bln'])) {
            if (!empty($where)) {
                $where .= " and MONTH(tgl_income) = '".$get['bln']."'";
            } else {
                $where .= " WHERE MONTH(tgl_income) = '".$get['bln']."'";
            }
        }
        if (!empty($get['PIC'])) {
            if (!empty($where)) {
                $where .= " and pic_income  like '%".$get['PIC']."%'";
            } else {
                $where .= " WHERE pic_income  like '%".$get['PIC']."%'";
            }
        }
        // limit 10 OFFSET 1
        $start = \Input::get('start');
        $length = \Input::get('length');
        $limit = "";
        if (!empty($length) &&  !empty($length)) {
            $limit  = "LIMIT ".$length." OFFSET ".$start;
        }
        $query = " select * from t_income
				".$where."
				".$order."
                ".$limit."
                ";
        $listData = \DB::select($query);
        return $listData;
    }

}
