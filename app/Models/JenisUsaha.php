<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisUsaha extends Model
{
    protected $table = 'm_jenis_usaha';
    protected $primaryKey = 'kd_jenis_usaha';
    public $timestamps = false;
    protected $fillable = ['kd_jenis_usaha','nama_jenis_usaha'];

 
  public static function column_order()
    {
        return  ['nama_jenis_usaha'];
    }
    public static function getAll()
    {
        $input = \Input::get('search.value');
        $get = \Input::all();
        $where = "";
        if (!empty($input)) {
            $where = "where ";
            $count = count(self::column_order()) -1;
            foreach (self::column_order() as $key => $value) {
                $where .= $value . " LIKE '%".$input."%'";
                if ($key <  $count) {
                    $where .= " OR ";
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
        $query = " select * from m_jenis_usaha 
				".$where."				
				".$order."				
                ".$limit."
                ";
        // print_R($query);die;
        $listData = \DB::select($query);
        return $listData;
    }
  }