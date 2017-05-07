<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['uname', 'email', 'password','user_grp', 'id_level'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function user_level()
    {
        return $this->belongsTo("App\Models\User_level", "id_level");
    }
    public static function column_order()
    {
        return  ['uname', 'group_name', 'pasPhoto_anggota','kdAggota','id'];
    }

    public static function mGroup()
    {
		$query = "select * from users as u
				LEFT JOIN menu_group as mg on u.user_grp = mg.user_grp";
        $role = \DB::select($query);
        return $role;
    }

    public static function mAnggota($id)
    {
        $query = "select * from users as u
                LEFT JOIN m_anggota as ma on u.id = ma.id_users
                where u.id  = '".$id."'
                ";
        $role = \DB::select($query);
        return $role;
    }
    public static function mAnggotaDetail($id)
    {
        $query = "select * from users as u
                    LEFT JOIN m_anggota as ma on u.id = ma.id_users
                    LEFT JOIN m_data_doclegal as mdd on mdd.kd_anggota = ma.kd_anggota
                    LEFT JOIN m_data_pribadi as mdp on mdp.kd_anggota = ma.kd_anggota
                    LEFT JOIN m_data_usaha as mdu on mdu.kd_anggota = ma.kd_anggota
                where ma.kd_anggota  = '".$id."'
                ";
        $role = \DB::select($query);
        return $role;
    }
    public static function mAllAnggota()
    {
        $kdAnggota = \Session::get('kd_anggota');
        $input = \Input::get('search.value');
        $get = \Input::all();

        $where = " where u.user_grp = 5 ";
        if (!empty($input)) {
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
                select *, ma.kd_anggota as kdAggota from users as u
                LEFT JOIN m_anggota as ma on u.id = ma.id_users
                LEFT JOIN menu_group as mg on u.user_grp = mg.user_grp
                LEFT JOIN m_data_usaha as mdu on mdu.kd_anggota = ma.kd_anggota
                ".$where."
				".$order."
                ".$limit."
                ";
        $listData = \DB::select($query);
        return $listData;
    }

    public static function mAllAnggotaCount()
    {
        $kdAnggota = \Session::get('kd_anggota');
        $input = \Input::get('search.value');
        $get = \Input::all();

        $where = " where u.user_grp = 5 ";
        if (!empty($input)) {
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
        $query = "
                select count(id) as count from users as u
                LEFT JOIN m_anggota as ma on u.id = ma.id_users
                LEFT JOIN menu_group as mg on u.user_grp = mg.user_grp
                LEFT JOIN m_data_usaha as mdu on  mdu.kd_anggota = ma.kd_anggota
                ".$where."
				".$order."
                ".$limit."
                ";
        $listData = \DB::select($query);
        return $listData;
    }
}
