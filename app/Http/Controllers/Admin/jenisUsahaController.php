<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\JenisUsaha as JU;
use App\liblary\Format;

class jenisUsahaController extends Controller
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
         $data['data'] = JU::all();
        return view('jenisusaha.jenisUsaha',$data);
    }
     public function indexAjax()
    {

        $draw=$_REQUEST['draw'];
        $length=$_REQUEST['length'];
        $start=$_REQUEST['start'];
        $search=$_REQUEST['search']["value"];
        $listWajib = new JU;
        // ======= count ===== //
        $total=count(JU::getAll());
        // ======= count ===== //

        $output=array();
        $output['draw']=$draw;
        $output['recordsTotal']=$output['recordsFiltered']=$total;
        $output['data']=array();
        $query = JU::getAll();

        $list = [];
        foreach ($query as $key => $row) {
            $json['nama_jenis_usaha'] = $row->nama_jenis_usaha;
            $json['kd_jenis_usaha'] = $row->kd_jenis_usaha;
            $list[] = $json;
        }
        $output['data']  = $list;
        return response()->json($output);
    }
    public function update()
    {

        $rules=[
            'nama_jenis_usaha'=>'required',
            
        ];
        $messages=[
            'nama_jenis_usaha.required'=>config('constants.ERROR_NM_JNS_USAHA'),
        ];
        $validator=Validator::make(\Input::all(), $rules, $messages);

        if ($validator->passes()) {

            $Spokok = JU::find(\Input::get('kd_jenis_usaha'));
            $Spokok->nama_jenis_usaha = \Input::get('nama_jenis_usaha');
            $Spokok->update();
            return \Redirect::to(route('jenis.usaha'));
        } else {
            $message = $validator->errors()->first();
            return \Redirect::back()->withErrors($message);
        }
    }
     public function create()
    {
   $rules=[
            'nama_jenis_usaha'=>'required',
        
        ];
        $messages=[
            'nama_jenis_usaha.required'=>config('constants.ERROR_NM_JNS_USAHA'),
        ];
        $validator=Validator::make(\Input::all(), $rules, $messages);
            
             
        if ($validator->passes()) {                     
            $Spokok = new JU;
            $Spokok->nama_jenis_usaha = \Input::get('nama_jenis_usaha');
            $Spokok->save();
            return \Redirect::to(route('jenis.usaha'));
            
                  
            
        } else {
            $message = $validator->errors()->first();
            return \Redirect::back()->withErrors($message);
        }
    }


  
    public function edit($kd_jenis_usaha)
    {
        $update = JU::where('kd_jenis_usaha', $kd_jenis_usaha)->get();
        $data   = [];
        $data['data'] = JU::all();
        foreach ($update as $key => $value) {
            $data['nama_jenis_usaha'] = $value->nama_jenis_usaha;
            $data['kd_jenis_usaha'] = $value->kd_jenis_usaha;
        }
        return view('jenisusaha.jenisUsaha',$data);
    }

    public function delete($kd_jenis_usaha)
    {
        $Spokok = JU::find($kd_jenis_usaha);

        $Spokok->delete();
            return \Redirect::to(route('jenis.usaha'));
        
    }
}
