<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\MAnggota as MA;
use App\Models\User as US;

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
            'no_anggota'=>'required',
        ];
        $messages=[
            'nm_anggota.required'=>config('constants.ERROR_NAMA_ANGGOTA'),
		    'no_anggota.required'=>config('constants.ERROR_NOMOR_ANGGOTA'),
        ];
        $validator=Validator::make(\Input::all(), $rules, $messages);
        if ($validator->passes()) {
            $no_anggota = \Input::get('no_anggota');
            $nm = \Input::get('nm_anggota');
            $user = explode(' ', $nm);
            $userName = $user[0].substr($no_anggota, -3);
            $token  = $this->getToken();
            $checkUname  = US::where('uname', $userName)->count();
            if ($checkUname == 0) {
                $insert = new US;
                $insert->uname = $userName;
                $insert->password = \Hash::make($token);
                $insert->email = "";
                $insert->id_level = 4;
                $insert->user_grp = 5;
                $insert->save();
                \Session::flash('userName', $userName);
                \Session::flash('token', $token);
                return \Redirect::to(route('config.generateTokenAnggota'));
            } else {
                $message = "User dengan ".$userName." sudah terdaftar !";
                return \Redirect::back()->withErrors($message);
            }

        } else {
            $message = $validator->errors()->first();
            return \Redirect::back()->withErrors($message);
        }
    }
    private function getToken(){
        $digits_needed=8;
        $random_number=''; // set up a blank string
        $count=0;
        while ( $count < $digits_needed ) {
            $random_digit = mt_rand(0, 9);
            $random_number .= $random_digit;
            $count++;
        }
        return $random_number;
    }

    public function getAnggota(){

        $allData = MA::where('nm_anggota', 'like', '%' . \Input::get('query') . '%')->get();

        $data = array();
        foreach ($allData as $key => $value) {
            $data[] = ['id' => $value->kd_anggota, 'nm_anggota' => $value->nm_anggota];
        }
        return response()->json($data);
    }
}
