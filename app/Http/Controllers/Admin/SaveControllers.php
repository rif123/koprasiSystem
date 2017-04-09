<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Save as SV;
use App\Models\Spokok as SP;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class SaveControllers extends Controller
{
    private $parser = [];

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function wajibList()
    {
        $list = SV::all();
        $data['list'] = $list;
        $listMonth = [];
        for ($i=0; $i < 4 ; $i++) {
            $listMonth[$i] = date('M', strtotime("+".$i." months"));
        }
        $data['monthLates'] =  $listMonth;

        SV::getAll();


        return view("save.wajib.list", $data)->with('parser', $this->parser);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function wajibSave()
    {
        $post = \Input::all();
        $rules=[
            'jml_bayar_wajib'=>'required',
            'tgl_bayar_wajib'=>'required'
        ];
        $messages=[
            'jml_bayar_wajib.required'=>config('constants.ERROR_NAME_MENU'),
            'tgl_bayar_wajib.required'=>config('constants.ERROR_URL_NAME'),
        ];
        $validator=Validator::make($post, $rules, $messages);
        if ($validator->fails()) {
            $message = $validator->errors()->first();
            return \Redirect::back()->withErrors($message);
        } else {
            $saveWajib = new SV;
            $saveWajib->jml_bayar_wajib = $post['jml_bayar_wajib'];
            $saveWajib->tgl_bayar_wajib = $post['tgl_bayar_wajib'];
            $saveWajib->bkt_bayar_wajib = $this->uploadFile();
            $saveWajib->kd_anggota = \Session::get('kd_anggota');
            $saveWajib->save();
            return response()->json(['status' => true, 'message' => config('constants.SUCCESS_FORM') ]);
        }
    }

    public function pokokList()
    {
        $list = SV::all();
        $data['list'] = $list;
        $listMonth = [];
        for ($i=0; $i < 4 ; $i++) {
            $listMonth[$i] = date('M', strtotime("+".$i." months"));
        }
        $data['monthLates'] =  $listMonth;
        return view("save.pokok.list", $data)->with('parser', $this->parser);
    }


    public function pokokSave()
    {
        $post = \Input::all();
        $rules=[
            'jml_bayar_spokok'=>'required',
            'tgl_bayar_spokok'=>'required'
        ];
        $messages=[
            'jml_bayar_spokok.required'=>config('constants.ERROR_NAME_MENU'),
            'tgl_bayar_spokok.required'=>config('constants.ERROR_URL_NAME'),
        ];
        $validator=Validator::make($post, $rules, $messages);
        if ($validator->fails()) {
            $message = $validator->errors()->first();
            return \Redirect::back()->withErrors($message);
        } else {
            $savePokok = new SP;
            $savePokok->jml_bayar_spokok = $post['jml_bayar_spokok'];
            $savePokok->tgl_bayar_spokok = $post['tgl_bayar_spokok'];
            $savePokok->bukti_bayar_spokok = $this->uploadFileSpokok();
            $savePokok->kd_anggota = \Session::get('kd_anggota');
            $savePokok->save();
            return response()->json(['status' => true, 'message' => config('constants.SUCCESS_FORM') ]);
        }
    }





    /**
     * upload image
     * @return [type] [description]
     */
    private function uploadFile()
    {
        $file = \Input::file('bkt_bayar_wajib')->isValid();
        $destinationPath = public_path().'/uploads/buktiSimpan'; // upload path
        $extension = \Input::file('bkt_bayar_wajib')->getClientOriginalExtension(); // getting image extension
        $fileName = rand(11111, 99999).'.'.$extension; // renameing image
        \Input::file('bkt_bayar_wajib')->move($destinationPath, $fileName); // uploading file to given path;
        return $fileName;
    }


	/**
     * upload image
     * @return [type] [description]
     */
    private function uploadFileSpokok()
    {
        $file = \Input::file('bukti_bayar_spokok')->isValid();
        $destinationPath = public_path().'/uploads/buktiSpokok'; // upload path
        $extension = \Input::file('bukti_bayar_spokok')->getClientOriginalExtension(); // getting image extension
        $fileName = rand(11111, 99999).'.'.$extension; // renameing image
        \Input::file('bukti_bayar_spokok')->move($destinationPath, $fileName); // uploading file to given path;
        return $fileName;
    }
}
