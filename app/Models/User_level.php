<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User_level extends Model {

	protected $table = 'user_level';
	public $primaryKey  = 'id_level';
	public $timestamps = false;
	protected $fillable = ['level_name','rules'];

	public function user(){
		return $this->hasOne("App\Models\User","id_level");
	}

	public function menuGroup(){
		return $this->hasOne("App\Models\User","menuGroup");
	}

}
