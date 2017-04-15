<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Widget extends Model {

	protected $table = 'widget';
	public $timestamps = false;
	protected $fillable = ['order_show', 'active'];

}
