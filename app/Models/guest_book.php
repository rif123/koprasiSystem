<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class guest_book extends Model {

	protected $table = 'guest_book';
	public $timestamps = false;
	protected $fillable = ['name', 'email', 'phone', 'message','date'];

}
