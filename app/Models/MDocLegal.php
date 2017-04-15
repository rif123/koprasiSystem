<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MDocLegal extends Model
{

    /*The table associated with the model.
    *
    * @var string
    */
    protected $table = 'm_data_docLegal';
    public $timestamps = false;
    protected $fillable = [ 'kd_anggota','npwp_docLegal','situ_docLegal', 'siup_docLegal', 'tdp_docLegal', 'pirt_docLegal', 'halal_docLegal', 'hki_docLegal','bpom_docLegal','merk_docLegal', 'lainnya_docLegal', 'created', 'create_date', 'updated', 'update_date'];
}
