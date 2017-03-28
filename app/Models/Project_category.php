<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project_category extends Model {

	protected $table = 'projects_category';
	public $primaryKey  = 'category_id';
	public $timestamps = false;
	protected $fillable = ['name'];

	public function project(){
		return $this->hasOne("App\Models\Project","category_id");
	}

}
