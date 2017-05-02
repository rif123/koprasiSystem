<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\Input;
use Illuminate\Http\Request;
use App\Models\Spokok as SP;
use App\liblary\Format;

class simpanPokokController extends Controller
{
    private $parser = array();
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $data['data'] = SP::all();
        return view("simpanan.pokok.simpanPokok", $data);
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
       $listWajib = new SP;
       // ======= count ===== //
       $total=SP::count();
       // ======= count ===== //

       $output=array();
       $output['draw']=$draw;
       $output['recordsTotal']=$output['recordsFiltered']=$total;
       $output['data']=array();
       $query = SP::getAll();

       $list = [];
       $ex = new Format;
       foreach ($query as $key => $row) {
           $json['jml_bayar_spokok'] = Format::getRp($row->jml_bayar_spokok);
           $json['bukti_bayar_spokok'] = $row->bukti_bayar_spokok;
           $json['tgl_bayar_spokok'] = date('M', strtotime($row->tgl_bayar_spokok));
           if ($row->status == 1) {
               $json['status']  = "Pending";
           } elseif ($row->status == 2) {
               $json['status']  = "Reject";
           } else {
               $json['status']  = "Lunas";
           }
           $json['isButton']  = $row->status ;
           $json['kd_spokok'] = $row->kd_spokok;
           $list[] = $json;
       }
       $output['data']  = $list;
       echo json_encode($output);
   }


    public function create()
    {
        $Spokok = new SP;
        $Spokok->jml_bayar_spokok = \Input::get('jml_bayar_spokok');
        $Spokok->bukti_bayar_spokok = $this->uploadfile('bkt_bayar_spokok');
        $Spokok->tgl_bayar_spokok = date('Y-m-d', strtotime(\Input::get('tgl_bayar_spokok')));
        $Spokok->status = 1;

        $Spokok->kd_anggota = \Session::get('kd_anggota');
        $Spokok->save();
        return \Redirect::to(route('simpanan.simpanPokok'));
    }
    public function edit($kd_spokok)
    {
        $update = SP::where('kd_spokok', $kd_spokok)->get();
        $data   = [];
        $data['data'] = SP::all();
        foreach ($update as $key => $value) {
            $data['jml_bayar_spokok'] = $value->jml_bayar_spokok;
            $data['bukti_bayar_spokok'] = $value->bukti_bayar_spokok;
            $data['tgl_bayar_spokok'] = $value->tgl_bayar_spokok;
            $data['kd_spokok'] = $value->kd_spokok;
        }
        return view("simpanan.pokok.simpanPokok", $data);
    }

    public function update()
    {
        $Spokok = SP::find(\Input::get('kd_spokok'));
        $Spokok->jml_bayar_spokok = \Input::get('jml_bayar_spokok');
        if (!empty(\Input::file('bkt_bayar_spokok'))) {
            $Spokok->bukti_bayar_spokok = $this->uploadfile('bkt_bayar_spokok');
        }
        $Spokok->tgl_bayar_spokok = date('Y-m-d', strtotime(\Input::get('tgl_bayar_spokok')));
        $Spokok->kd_anggota = \Session::get('kd_anggota');
        $Spokok->update();
        return \Redirect::to(route('simpanan.simpanPokok'));
           /*$Swajib = SW::find(\Input::get('kd_swajib'));
           $Swajib->jml_bayar_wajib = \Input::get('jml_bayar_wajib');
           if (!empty(\Input::file('bkt_bayar_wajib'))) {
           $Swajib->bkt_bayar_wajib = $this->uploadfile('bkt_bayar_wajib');
           }

           $Swajib->tgl_bayar_wajib = date('Y-m-d',strtotime(\Input::get('tgl_bayar_wajib')));
         /*  $Swajib->no_swajib = \Input::get('no_swajib');*/
           /*$Swajib->kd_anggota = \Session::get('kd_anggota');
           $Swajib->update();
           return \Redirect::to(route('simpanan.moduleSimpan'));*/
    }
    public function delete($kd_spokok)
    {
        $Spokok = SP::find($kd_spokok);

        $Spokok->delete();
        return \Redirect::to(route('simpanan.simpanPokok'));
    }



    private function uploadfile($fn)
    {
        if (!empty(\Input::file($fn))) {
            $file = \Input::file($fn)->isValid();
            $destinationPath = public_path().'/uploads/'.$fn;
            $extension =\Input::file($fn)->getClientOriginalExtension();
            $fileName = rand(11111, 99999).'.'.$extension;
            \Input::file($fn)->move($destinationPath, $fileName);
            return $fileName;
        /*if (!empty(\Input::file($fn))) {
            $file = \Input::file($fn)->isValid();
            $destinationPath = public_path().'/uploads/'.$fn; // upload path
            $extension = \Input::file($fn)->getClientOriginalExtension(); // getting image extension
            $fileName = rand(11111, 99999).'.'.$extension; // renameing image
            \Input::file($fn)->move($destinationPath, $fileName); // uploading file to given path;
            return $fileName;*/
        }
    }
}
