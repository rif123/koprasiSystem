<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    private $parser = [];
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function generateTokenAnggota()
    {
        $data['monthLates'] =  "";
        return view("anggota.generateToken", $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function generateToken()
    {
        $rules=[
            'nm_anggota'=>'required',
            'nomor_anggota'=>'required'
        ];
        $messages=[
            'nm_anggota.required'=>config('constants.ERROR_NAMA_ANGGOTA'),
		    'nomor_anggota.required'=>config('constants.ERROR_NOMOR_ANGGOTA'),
        ];
        $validator=Validator::make(\Input::all(), $rules, $messages);
        if ($validator->passes()) {
            print_R(\Input::all());
            die;
        } else {
            $message = $validator->errors()->first();
            return \Redirect::back()->withErrors($message);
        }
    }
}
