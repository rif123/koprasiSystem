<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\Input;
use Illuminate\Http\Request;
use App\Models\Income as Ic;
class managementincomeController extends Controller
{
    private $parser = array();
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        $data['data'] = Ic::all();


        return view("management.income.income",$data);
    }

    public function create()
    {

     $Income = new Ic;
      $Income->tgl_income = date('Y-m-d H:s:i',strtotime(\Input::get('tgl_income')));
      $Income->jml_income = \Input::get('jml_income');
      $Income->pic_income = \Input::get('pic_income');
      $Income->ket_income = \Input::get('ket_income');

      $Income->kd_anggota = \Session::get('kd_anggota');
      $Income->save();
      return \Redirect::to(route('management.income'));
    }
     public function edit($id_income)
    {

        $update = Ic::where('id_income',$id_income)->get();
        $data   = [];
        $data['data'] = Ic::all();
        foreach ($update as $key => $value) {
                $data['jml_income'] = $value->jml_income;
                $data['pic_income'] = $value->pic_income;
                $data['ket_income'] = $value->ket_income;
                $data['tgl_income'] = $value->tgl_income;
                $data['id_income'] = $value->id_income;
        }
        return view("management.income.income",$data);
    }

         public function update()
        {

      $Income = Ic::find(\Input::get('id_income'));
      $Income->jml_income = \Input::get('jml_income');
      $Income->pic_income = \Input::get('pic_income');
      $Income->ket_income = \Input::get('ket_income');
      $Income->tgl_income = date('Y-m-d H:s:i',strtotime(\Input::get('tgl_income')));
      $Income->kd_anggota = \Session::get('kd_anggota');
      $Income->update();
      return \Redirect::to(route('management.income'));

        }
         public function delete($kd_spokok)
    {

       /*$Spokok = SP::find($kd_spokok);

       $Spokok->delete();
       return \Redirect::to(route('simpanan.simpanPokok'));
*/

    }


}
