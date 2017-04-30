<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\Input;
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
    
    public function create()
    {

       $Swajib = new SW;
       $Swajib->jml_bayar_wajib = \Input::get('jml_bayar_wajib');
       $Swajib->bkt_bayar_wajib = $this->uploadfile('bkt_bayar_wajib');
       $Swajib->tgl_bayar_wajib = date('Y-m-d',strtotime(\Input::get('tgl_bayar_wajib')));
       $Swajib->status = 1;

     /*  $Swajib->no_swajib = \Input::get('no_swajib');*/
       $Swajib->kd_anggota = \Session::get('kd_anggota');
       $Swajib->save();
       return \Redirect::to(route('simpanan.moduleSimpan'));

      
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
