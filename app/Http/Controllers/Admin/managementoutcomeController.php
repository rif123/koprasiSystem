<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\Input;
use Illuminate\Http\Request;
use App\Models\Outcome as Oc;
use App\liblary\Format;

class managementoutcomeController extends Controller
{
    private $parser = array();
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $data['data'] = "";
        return view("management.outcome.outcome", $data);
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function indexReadOnly()
    {
        $data['data'] = "";
        return view("management.readonly.outComeReadOnly", $data);
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function indexAjax()
    {
        $draw=$_REQUEST['draw'];
        $length=$_REQUEST['length'];
        $start=$_REQUEST['start'];
        $search=$_REQUEST['search']["value"];
        $listWajib = new Oc;
        // ======= count ===== //
        $total=Oc::count();
        // ======= count ===== //

        $output=array();
        $output['draw']=$draw;
        $output['recordsTotal']=$output['recordsFiltered']=$total;
        $output['data']=array();
        $query = Oc::getAll();

        $list = [];
        $ex = new Format;
        foreach ($query as $key => $row) {
            $json['jml_outcome'] = Format::getRp($row->jml_outcome);
            $json['pic_outcome'] = $row->pic_outcome;
            $json['tgl_outcome'] = date('M', strtotime($row->tgl_outcome));
            $json['ket_outcome'] = $row->ket_outcome;
            $json['id_outcome'] = $row->id_outcome;
            $list[] = $json;
        }
        $output['data']  = $list;
        return response()->json($output);
    }


    public function create()
    {
        $Outcome = new Oc;
        $Outcome->tgl_outcome = date('Y-m-d H:s:i', strtotime(\Input::get('tgl_outcome')));
        $Outcome->jml_outcome = \Input::get('jml_outcome');
        $Outcome->pic_outcome = \Input::get('pic_outcome');
        $Outcome->ket_outcome = \Input::get('ket_outcome');

        $Outcome->kd_anggota = \Session::get('kd_anggota');
        $Outcome->save();
        return \Redirect::to(route('management.outcome'));
    }
    public function edit($id_outcome)
    {
        $update = Oc::where('id_outcome', $id_outcome)->get();
        $data   = [];
        $data['data'] = Oc::all();
        foreach ($update as $key => $value) {
            $data['jml_outcome'] = $value->jml_outcome;
            $data['pic_outcome'] = $value->pic_outcome;
            $data['ket_outcome'] = $value->ket_outcome;
            $data['tgl_outcome'] = $value->tgl_outcome;
            $data['id_outcome'] = $value->id_outcome;
        }
        return view("management.outcome.outcome", $data);
    }

    public function update()
    {
        $Outcome = Oc::find(\Input::get('id_outcome'));
        $Outcome->jml_outcome = \Input::get('jml_outcome');
        $Outcome->pic_outcome = \Input::get('pic_outcome');
        $Outcome->ket_outcome = \Input::get('ket_outcome');
        $Outcome->tgl_outcome = date('Y-m-d H:s:i', strtotime(\Input::get('tgl_outcome')));
        $Outcome->kd_anggota = \Session::get('kd_anggota');
        $Outcome->update();
        return \Redirect::to(route('management.outcome'));
    }
     public function viewOutcome (){
        $data = [];
        return view("management.view.voutcome",$data);
    }
  
        public function viewOutcomeAjax()
    {

        $draw=$_REQUEST['draw'];
        $length=$_REQUEST['length'];
        $start=$_REQUEST['start'];
        $search=$_REQUEST['search']["value"];
        $listWajib = new Oc;
        // ======= count ===== //
        $total=Oc::getAllOutcome();
        $total=count($total);
        // ======= count ===== //

        $output=array();
        $output['draw']=$draw;
        $output['recordsTotal']=$output['recordsFiltered']=$total;
        $output['data']=array();
        $query = Oc::getAllOutcome();

        $list = [];
        $ex = new Format;
        foreach ($query as $key => $row) {
            $json['jml_outcome'] = Format::getRp($row->jml_outcome);
            $json['pic_outcome'] = $row->pic_outcome;
            $json['tgl_outcome'] = date('M', strtotime($row->tgl_outcome));
            $json['ket_outcome'] = $row->ket_outcome;
            $json['id_outcome'] = $row->id_outcome;
            $list[] = $json;
        }
        $output['data']  = $list;
        return response()->json($output);
    }
    public function viewOutcomeExcel(){
          $query = Oc::getAllOutcome();
        $param['data'] = $query;
        return view("management.view.export.outcomeExcel",$param);




    }




}
