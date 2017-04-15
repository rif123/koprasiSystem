<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model {

	protected $table = 'projects';
	public $timestamps = false;
	protected $fillable = ['name','description','client','category_id','featured_image','photo'];

	public function project_category(){
		return $this->belongsTo("App\Models\Project_category","category_id");
	}

}
