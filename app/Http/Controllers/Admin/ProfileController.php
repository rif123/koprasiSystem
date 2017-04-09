<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\Input;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
// model
use App\Models\MdataPribadi as mdp;
use App\Models\MAnggota as MA;
use App\Models\MdataPribadi as MP;
use App\Models\MDocLegal as MD;
use App\Models\MDataUsaha as MDU;

class ProfileController extends Controller
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
        return view("profile.index", $data)->with('parser', $this->parser);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $rules=[
            'nm_anggota'=>'required'
        ];
        $messages=[
            'nm_anggota.required'=>config('constants.ERROR_NAMA_ANGGOTA'),
        ];
        $validator=Validator::make(\Input::all(), $rules, $messages);
        if ($validator->passes()) {


            // save M_anggota
            $mAnggota = new MA;
            $mAnggota->nm_anggota = \Input::get('nm_anggota');
            $mAnggota->pasPhoto_anggota = $this->uploadFile();
            $mAnggota->save();

            // get last id
            $insertedId = $mAnggota->id;

            // save m_pribadi
            $this->savePribadi($insertedId);

            // save M_doc_file
            $this->saveDataUsaha($insertedId);

            // save M_doc_file
            $this->saveDocFile($insertedId);

            return response()->json(['status' => true, 'message' => config('constants.SUCCESS_FORM') ]);
        } else {
            $message = $validator->errors()->first();
            return response()->json(['status' => false, 'message' => $message]);
        }
    }

    /**
     * save table m_data_pribadi
     * @return save
     */
    private function savePribadi($insertedId)
    {
        $mPribadi = new MP;
        $mPribadi->tempat_lahir_pribadi = \Input::get('tempat_lahir_pribadi');
        $mPribadi->kd_anggota = $insertedId;
        $mPribadi->npwp_pribadi = \Input::get('npwp_pribadi');
        $mPribadi->noHp_pribadi = \Input::get('noHp_pribadi');
        $mPribadi->email_pribadi = \Input::get('email_pribadi');
        $mPribadi->alamat_pribadi = \Input::get('alamat_pribadi');
        $mPribadi->rtRw_pribadi = \Input::get('rtRw_pribadi');
        $mPribadi->kec_pribadi = \Input::get('kec_pribadi');
        $mPribadi->desKel_pribadi = \Input::get('desKel_pribadi');
        $mPribadi->wubTahun_pribadi = \Input::get('wubTahun_pribadi');
        $mPribadi->wubDinas_pribadi = \Input::get('wubDinas_pribadi');
        $mPribadi->created = "aku";
        $mPribadi->save();
    }

    /**
     * save table m_data_usaha
     * @return post
     */
    private function saveDataUsaha($insertedId)
    {
        $mDataUsaha = new MDU;
        $mDataUsaha->kd_anggota = $insertedId;
        $mDataUsaha->brand_usaha = \Input::get('brand_usaha');
        $mDataUsaha->lama_usaha = \Input::get('lama_usaha');
        $mDataUsaha->jenisProd_usaha = \Input::get('jenisProd_usaha');
        $mDataUsaha->alamat_usaha = \Input::get('alamat_usaha');
        $mDataUsaha->rtRw_usaha = \Input::get('rtRw_usaha');
        $mDataUsaha->kec_usaha = \Input::get('kec_usaha');
        $mDataUsaha->kabKot_usaha = \Input::get('kabKot_usaha');
        $mDataUsaha->kapasitas_usaha = \Input::get('kapasitas_usaha');
        $mDataUsaha->harga_usaha = \Input::get('harga_usaha');
        $mDataUsaha->wilayah_offline_usaha = \Input::get('wilayah_offline_usaha');
        $mDataUsaha->wilayah_online_usaha = \Input::get('wilayah_online_usaha');
        $mDataUsaha->jumlahTenagaKerja_usaha = \Input::get('jumlahTenagaKerja_usaha');
        $mDataUsaha->omset_usaha = \Input::get('omset_usaha');
        $mDataUsaha->fb_usaha = \Input::get('fb_usaha');
        $mDataUsaha->insta_usaha = \Input::get('insta_usaha');
        $mDataUsaha->twiiter_usaha = \Input::get('twiiter_usaha');
        $mDataUsaha->created = "aku";
        $mDataUsaha->save();
    }

    /**
     * save table m_data_docLegal
     * @return post
     */
    private function saveDocFile($insertedId)
    {
        $mDocFile = new MD;
        $mDocFile->npwp_docLegal = \Input::get('npwp_docLegal');
        $mDocFile->kd_anggota = $insertedId;
        $mDocFile->situ_docLegal = \Input::get('situ_docLegal');
        $mDocFile->siup_docLegal = \Input::get('siup_docLegal');
        $mDocFile->tdp_docLegal = \Input::get('tdp_docLegal');
        $mDocFile->bpom_docLegal = \Input::get('bpom_docLegal');
        $mDocFile->pirt_docLegal = \Input::get('pirt_docLegal');
        $mDocFile->halal_docLegal = \Input::get('halal_docLegal');
        $mDocFile->bpom_docLegal = \Input::get('bpom_docLegal');
        $mDocFile->hki_docLegal = \Input::get('hki_docLegal');
        $mDocFile->merk_docLegal = \Input::get('merk_docLegal');
        $mDocFile->lainnya_docLegal = \Input::get('lainnya_docLegal');
        $mDocFile->created = "aku";
        $mDocFile->save();
    }

    /**
     * upload image
     * @return [type] [description]
     */
    private function uploadFile (){
        $file = \Input::file('pasPhoto_anggota')->isValid();
        $destinationPath = public_path().'/uploads'; // upload path
        $extension = \Input::file('pasPhoto_anggota')->getClientOriginalExtension(); // getting image extension
        $fileName = rand(11111, 99999).'.'.$extension; // renameing image
        \Input::file('pasPhoto_anggota')->move($destinationPath, $fileName); // uploading file to given path;
        return $fileName;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
