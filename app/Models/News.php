<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'm_news';
    protected $primaryKey = 'id_news';
    public $timestamps = false;
    protected $fillable = ['id_news','judul_news','description_news','tanggal_news','status'];

 
  public static function column_order()
    {
        return  ['judul_news','description_news','tanggal_news','status'];
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
        $query = " select * from m_news 
				".$where."				
				".$order."				
                ".$limit."
                ";
        // print_R($query);die;
        $listData = \DB::select($query);
        return $listData;
    }
      public static function getJenisUsaha()
    {
         $nama_usaha = \Input::get('nama_jenis_usaha');   
        $query = "SELECT nama_jenis_usaha FROM m_jenis_usaha 
               WHERE nama_jenis_usaha= '".$nama_usaha."'";

        // print_R($query);die;
        $listData = \DB::select($query);
        return $listData;

    }    


  }