<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mgroup extends Model {

    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'menu_group';
    protected $primaryKey = 'user_grp';
    public $timestamps = false;
    protected $fillable = ['user_grp', 'group_name'];

    // public function user_grp(){
    //     return $this->hasMany("App\Models\User","user_grp");
    // }
}
