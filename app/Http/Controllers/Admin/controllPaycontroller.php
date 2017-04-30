<?php namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\ControllPay as CP;
use App\Models\Swajib as SW;
use App\Models\Spokok as SP;

class controllPayController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//$this->middleware('auth');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		$query['data']=CP::getAll();

		return view('config.controll.controllPay',$query);
	}
	public function detail($id_pay)
	{
		$parameter =[];
		$parameter['id_pay'] =$id_pay;
		if (\Input::get('pay') == 1) {
			$pay = 'Simpanan wajib';
		}else{
			$pay = 'Simpanan Pokok';
		}
		$parameter['pay'] =$pay;
		$result['result'] =CP::getOne($parameter);
		
		return view('config.controll.controllDetail',$result);


	}
	public function edit($id_pay)
	{



		if (\Input::get('pay')== 1) {
	   $parameter = SW::find($id_pay);
		
		}elseif(\Input::get('pay') == 2){
	   $parameter = SP::find($id_pay);
        }   
       $parameter->status = \Input::get('status');    
       $parameter->kd_anggota = \Session::get('kd_anggota');
       $parameter->update();		
       $url ='admin/config/controll-Pay-detail/'.$id_pay.'?pay='.\Input::get('pay');
       
       return \Redirect::to($url);

	}
}
