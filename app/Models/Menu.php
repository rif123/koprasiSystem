<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model {

	protected $table = 'menu';
	public $timestamps = false;
	protected $fillable = ['name', 'link', 'order_show'];

}
