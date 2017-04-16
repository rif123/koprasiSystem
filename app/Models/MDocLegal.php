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
    protected $fillable = [ 'kd_anggota','npwp_docLegal','situ_docLegal', 'siup_docLegal', 'tdp_docLegal', 'pirt_docLegal', 'halal_docLegal', 'hki_docLegal','bpom_docLegal','merk_docLegal', 'agreement_docLegal',
    'file_npwp_docLegal',
    'file_situ_docLegal',
    'file_siup_docLegal',
    'file_tdp_docLegal',
    'file_bpom_docLegal',
    'file_pirt_docLegal',
    'file_halal_docLegal',
    'file_hki_docLegal',
    'file_merk_docLegal',
    'file_agreement_docLegal',
    'created', 'create_date', 'updated', 'update_date'];
}
