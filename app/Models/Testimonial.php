<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model {

	protected $table = 'testimonial';
	public $timestamps = false;
	protected $fillable = ['customer_name', 'customer_status', 'testimomo', 'active'];

}
