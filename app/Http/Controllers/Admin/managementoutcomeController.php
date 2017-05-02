<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\Input;
use Illuminate\Http\Request;
use App\Models\Outcome as Oc;
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
        
        $data['data'] = Oc::all();


        return view("management.outcome.outcome",$data);
    }
    
    public function create()
    {

     $Outcome = new Oc;
      $Outcome->tgl_outcome = date('Y-m-d H:s:i',strtotime(\Input::get('tgl_outcome')));
      $Outcome->jml_outcome = \Input::get('jml_outcome');
      $Outcome->pic_outcome = \Input::get('pic_outcome');
      $Outcome->ket_outcome = \Input::get('ket_outcome');

      $Outcome->kd_anggota = \Session::get('kd_anggota');
      $Outcome->save();
      return \Redirect::to(route('management.outcome'));
    }
     public function edit($id_outcome)
    {
        
        $update = Oc::where('id_outcome',$id_outcome)->get();
        $data   = [];
        $data['data'] = Oc::all();
        foreach ($update as $key => $value) {
                $data['jml_outcome'] = $value->jml_outcome;
                $data['pic_outcome'] = $value->pic_outcome;
                $data['ket_outcome'] = $value->ket_outcome;
                $data['tgl_outcome'] = $value->tgl_outcome;
                $data['id_outcome'] = $value->id_outcome;
        }
        return view("management.outcome.outcome",$data);
    }

         public function update()
        {

      $Outcome = Oc::find(\Input::get('id_outcome'));
      $Outcome->jml_outcome = \Input::get('jml_outcome');
      $Outcome->pic_outcome = \Input::get('pic_outcome');
      $Outcome->ket_outcome = \Input::get('ket_outcome');
      $Outcome->tgl_outcome = date('Y-m-d H:s:i',strtotime(\Input::get('tgl_outcome')));
      $Outcome->kd_anggota = \Session::get('kd_anggota');
      $Outcome->update();
      return \Redirect::to(route('management.outcome'));
          
        }
         public function delete($kd_spokok)
    {
        
       /*$Spokok = SP::find($kd_spokok);
       
       $Spokok->delete();
       return \Redirect::to(route('simpanan.simpanPokok'));
*/
      
    }


}
