<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carousel extends Model {

	protected $table = 'carousel';
	public $timestamps = false;
	protected $fillable = ['title','text_top','text_middle','button_text','button_link'];
}
