<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Process_text extends Model {

	protected $table = 'process_text';
	public $timestamps = false;
	protected $fillable = ['title', 'textbox'];

}
