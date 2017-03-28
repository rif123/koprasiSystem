<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model {

	protected $table = 'contacts_info';
	public $timestamps = false;
	protected $fillable = ['location', 'phone', 'fax', 'email','web'];

}
