<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\User as US;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    private $parser = array();
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        if((\Auth::check()) || \Auth::viaRemember()){
            return redirect($_ENV['ADMIN_FOLDER']);
        }
        return view("auth.login")->with('parser', $this->parser);
    }

    /**
     * Test
     *
     * @return Response
     */
    public function checkLogin(){
        $rules = array(
            'username'    => 'required|min:3', // username
            'password' => 'required|alphaNum|min:3' // password
        );
        $remember = (\Input::has('rememberme')) ? true : false;
        $validator = \Validator::make(\Input::all(), $rules);

        if($validator->fails()) {
            return \Redirect::to('/auth/login')
                ->withErrors($validator)
                ->withInput(\Input::except('password'));
        } else {
            $userdata = array(
                        'uname' => \Input::get('username'),
                        'password' => \Input::get('password')
                        );
            if(\Auth::attempt($userdata,$remember)){
                    if(\Auth::User()->user_level->rules != '1'){
                        \Session::put('rules', unserialize(\Auth::User()->user_level->rules));
                    }
                    else{
                        $anggota = US::mAnggota(\Auth::User()->id);
                        $dataSession = [
                            'UserId' =>     \Auth::User()->id,
                            'kd_anggota' => $anggota[0]->kd_anggota,
                            'id' =>         \Auth::User()->user_level->rules,
                            'user_grp' =>   \Auth::User()->user_grp,
                            'uname' =>      \Auth::User()->uname,
                            'email' =>      \Auth::User()->email,
                            'rules' =>      \Auth::User()->user_level->rules
                        ];
                        \Session::put($dataSession);
                    }
                    $a = array("admin","admin/error","admin/home","admin/logout","admin/logout","admin/setting/profile");
                    \Session::put('whitelist', $a);
                    return redirect('admin');
            }else{
                    return view("auth.login",["error"=>"1"])->with('parser', $this->parser);
            }
        }

        return view("auth.login")->with('parser', $this->parser);
    }
}
