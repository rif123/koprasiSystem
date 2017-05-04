<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ControllPay as CP;
use App\Models\Swajib as SW;
use App\Models\Spokok as SP;
use App\liblary\Format;

class controllPayController extends Controller
{

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
        return view('config.controll.controllPay');
    }
    public function indexAjax()
    {
        $draw=$_REQUEST['draw'];
        $length=$_REQUEST['length'];
        $start=$_REQUEST['start'];
        $search=$_REQUEST['search']["value"];
        $listWajib = new CP;
       // ======= count ===== //
        $total=CP::count();
       // ======= count ===== //

       $output=array();
        $output['draw']=$draw;
        $output['recordsTotal']=$output['recordsFiltered']=$total;
        $output['data']=array();
        $query = CP::getAll();

        $list = [];
        $ex = new Format;
        foreach ($query as $key => $row) {

            $json['nm_anggota'] = $row->nm_anggota;
            $json['pay'] = $row->pay;
            $json['payMonth'] = $row->payMonth;
            $json['jml_bayar_wajib'] = Format::getRp($row->jml_bayar_wajib);
            if ($row->status == 1) {
                $json['status']  = "Pending";
            } elseif ($row->status == 2) {
                $json['status']  = "Reject";
            } else {
                $json['status']  = "Lunas";
            }
			$json['isButton']  = $row->status ;
            $json['id_pay'] = $row->id_pay;
            $list[] = $json;
        }

        $output['data']  = $list;
        echo json_encode($output);
    }



    public function detail($id_pay)
    {
        $parameter =[];
        $parameter['id_pay'] =$id_pay;
        if (\Input::get('pay') == 1) {
            $pay = 'Simpanan wajib';
        } else {
            $pay = 'Simpanan Pokok';
        }
        $parameter['pay'] =$pay;
        $result['result'] =CP::getOne($parameter);

        return view('config.controll.controllDetail', $result);
    }
    public function edit($id_pay)
    {
        if (\Input::get('pay')== 1) {
            $parameter = SW::find($id_pay);
        } elseif (\Input::get('pay') == 2) {
            $parameter = SP::find($id_pay);
        }
        $parameter->status = \Input::get('status');
        $parameter->kd_anggota = \Session::get('kd_anggota');
        $parameter->update();
        $url ='admin/config/controll-Pay-detail/'.$id_pay.'?pay='.\Input::get('pay');

        return \Redirect::to($url);
    }
}
