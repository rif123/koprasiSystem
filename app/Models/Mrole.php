<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Mrole extends Model {

    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'menu_role';
    protected $primaryKey = 'kd_role';
    public $timestamps = false;
    protected $fillable = ['kd_role', 'user_grp', 'id_menu'];

    /**
     * Get the comments for the blog post.
     */
    public static function groupRole()
    {
        $query = "select mr.kd_role, ma.name_menu, mg.group_name from menu_role as mr
                    LEFT JOIN menu_admin as ma on mr.id_menu = ma.id_menu
                    LEFT JOIN menu_group as mg on mr.user_grp = mg.user_grp
                    ";
        $role = \DB::select($query);
        return $role;
    }
    /**
     * Get the comments for the blog post.
     */
    public static function roleDelete($grp)
    {
        $role = Mrole::where('user_grp', '=', $grp)->delete();
        return $role;
    }

    /**
     * Get the comments for the blog post.
     */
    public static function roleDeleteIdMenu($id_menu)
    {
        $role = Mrole::where('id_menu', '=', $id_menu)->delete();
        return $role;
    }
    /**
     * Get the comments for the blog post.
     */
    public static function roleInsert($param)
    {
        $role = MR::find($param);
        $role->delete();
        return $role;
    }

    /**
     * Get the comments for the blog post.
     */
    public static function getSelected($user_grp=1)
    {
        $user = Mrole::where('user_grp', '=', $user_grp)
                ->get();
        $result = $user->toArray();
        return $result;
    }


}
