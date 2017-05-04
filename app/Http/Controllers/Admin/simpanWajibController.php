<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\Input;
use Illuminate\Support\Facades\Validator;
use App\liblary\Format;
use Illuminate\Http\Request;
use App\Models\Swajib as SW;

class simpanWajibController extends Controller
{
    private $parser = array();
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $data['data'] = SW::all();
        return view("simpanan.wajib.simpanWajib",$data);
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
        $listWajib = new SW;
        // ======= count ===== //
        $total=SW::count();
        // ======= count ===== //

        $output=array();
        $output['draw']=$draw;
        $output['recordsTotal']=$output['recordsFiltered']=$total;
        $output['data']=array();
        $query = SW::getAll();

        $list = [];
        $ex = new Format;
        foreach ($query as $key => $row) {
            $json['jml_bayar_wajib'] = Format::getRp($row->jml_bayar_wajib);
            $json['bkt_bayar_wajib'] = $row->bkt_bayar_wajib;
            $json['tgl_bayar_wajib'] = date('M',strtotime($row->tgl_bayar_wajib));
            // $json['kd_anggota'] = $row->kd_anggota;
            if ($row->status == 1) {
                $json['status']  = "Pending";
            } elseif($row->status == 2) {
                $json['status']  = "Reject";
            } else {
                $json['status']  = "Lunas";
            }
            $json['isButton']  = $row->status ;
            $json['kd_swajib'] = $row->kd_swajib;
            $list[] = $json;
        }

        $output['data']  = $list;
        echo json_encode($output);
    }


    public function create()
    {
        $rules=[
            'jml_bayar_wajib'=>'required',
            'tgl_bayar_wajib'=>'required',
            'bkt_bayar_wajib'=>'required',
        ];
        $messages=[
            'jml_bayar_wajib.required'=>config('constants.ERROR_JML_WAJIB'),
            'tgl_bayar_wajib.required'=>config('constants.ERROR_TGL_BAYAR_WAJIB'),
            'bkt_bayar_wajib.required'=>config('constants.ERROR_BKT_WAJIB'),
        ];
        $validator=Validator::make(\Input::all(), $rules, $messages);

        if ($validator->passes()) {
           $Swajib = new SW;
           $Swajib->jml_bayar_wajib = \Input::get('jml_bayar_wajib');
           $Swajib->bkt_bayar_wajib = $this->uploadfile('bkt_bayar_wajib');
           $Swajib->tgl_bayar_wajib = date('Y-m-d',strtotime(\Input::get('tgl_bayar_wajib')));
           $Swajib->status = 1;

         /*  $Swajib->no_swajib = \Input::get('no_swajib');*/
           $Swajib->kd_anggota = \Session::get('kd_anggota');
           $Swajib->save();
           return \Redirect::to(route('simpanan.moduleSimpan'));
        } else {
            $message = $validator->errors()->first();
            return \Redirect::back()->withErrors($message);
        }


    }
     public function edit($kd_swajib)
    {

        $update = SW::where('kd_swajib',$kd_swajib)->get();
        $data   = [];
        $data['data'] = SW::all();
        foreach ($update as $key => $value) {
                $data['jml_bayar_wajib'] = $value->jml_bayar_wajib;
                $data['bkt_bayar_wajib'] = $value->bkt_bayar_wajib;
                $data['tgl_bayar_wajib'] = $value->tgl_bayar_wajib;
                $data['kd_swajib'] = $value->kd_swajib;
        }
        return view ("simpanan.wajib.simpanWajib",$data);
    }

         public function update()
        {
            $rules=[
                'jml_bayar_wajib'=>'required',
                'tgl_bayar_wajib'=>'required',
            ];
            $messages=[
                'jml_bayar_wajib.required'=>config('constants.ERROR_JML_WAJIB'),
                'tgl_bayar_wajib.required'=>config('constants.ERROR_TGL_BAYAR_WAJIB'),
            ];
            $validator=Validator::make(\Input::all(), $rules, $messages);

            if ($validator->passes()) {

               $Swajib = SW::find(\Input::get('kd_swajib'));
               $Swajib->jml_bayar_wajib = \Input::get('jml_bayar_wajib');
               if (!empty(\Input::file('bkt_bayar_wajib'))) {
               $Swajib->bkt_bayar_wajib = $this->uploadfile('bkt_bayar_wajib');
               }

               $Swajib->tgl_bayar_wajib = date('Y-m-d',strtotime(\Input::get('tgl_bayar_wajib')));
             /*  $Swajib->no_swajib = \Input::get('no_swajib');*/
               $Swajib->kd_anggota = \Session::get('kd_anggota');
               $Swajib->update();
               return \Redirect::to(route('simpanan.moduleSimpan'));
           } else {
               $message = $validator->errors()->first();
               return \Redirect::back()->withErrors($message);
           }

        }
         public function delete($kd_swajib)
    {

       $Swajib = SW::find($kd_swajib);

       $Swajib->delete();
       return \Redirect::to(route('simpanan.moduleSimpan'));


    }



     private function uploadfile($fn)
    {

        if (!empty(\Input::file($fn))) {
            $file = \Input::file($fn)->isValid();
            $destinationPath = public_path().'/uploads/'.$fn; // upload path
            $extension = \Input::file($fn)->getClientOriginalExtension(); // getting image extension
            $fileName = rand(11111, 99999).'.'.$extension; // renameing image
            \Input::file($fn)->move($destinationPath, $fileName); // uploading file to given path;
            return $fileName;
        }
    }


}
