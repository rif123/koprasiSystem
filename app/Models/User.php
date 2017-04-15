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
}
