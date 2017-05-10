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
use App\Models\User as US;

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
        $kd_anggota = \Session::get('kd_anggota');
        $getAll = MA::getALlData($kd_anggota);
        $query  = "select * from m_jenis_usaha";
        $getJenisUsaha = \DB::select($query);
        $data['jenisUsaha'] = $getJenisUsaha;
        $data['allData'] = $getAll[0];
        $data['selectedMenu'] = '';
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
            'nm_anggota'=>'required',
        ];
        $messages=[
            'nm_anggota.required'=>config('constants.ERROR_NAMA_ANGGOTA'),

        ];
        $validator=Validator::make(\Input::all(), $rules, $messages);
        if ($validator->passes()) {
            // check exsiting
            $kd_anggota = \Session::get('kd_anggota');
            $checkAnggota = MA::checkDataAnggota('m_anggota', $kd_anggota);

            // save M_anggota
            if ($checkAnggota[0]->kdAggota >= 1) {
                $mAnggota =  MA::find($kd_anggota);
                $mAnggota->nm_anggota = \Input::get('nm_anggota');
                $mAnggota->pasPhoto_anggota = $this->uploadFile();
                $mAnggota->update();
            } else {
                $mAnggota = new MA;
                $mAnggota->nm_anggota = \Input::get('nm_anggota');
                $mAnggota->pasPhoto_anggota = $this->uploadFile();
                $mAnggota->save();
            }
            // get last id
            $insertedId = $mAnggota->id;

            // save m_pribadi
            $checkAnggota = MA::checkDataAnggota('m_data_pribadi', $kd_anggota);
            if ($checkAnggota[0]->kdAggota >= 1) {
                $insertedId = $kd_anggota;
                $this->savePribadi('update', $insertedId);
            } else {
                $insertedId = !empty($insertedId) ? $insertedId : $kd_anggota;
                $this->savePribadi('save', $insertedId);
            }

            // save M_doc_file
            $checkAnggota = MA::checkDataAnggota('m_data_usaha', $kd_anggota);
            if ($checkAnggota[0]->kdAggota >= 1) {
                $insertedId = $kd_anggota;
                $this->saveDataUsaha('update', $insertedId);
            } else {
                $insertedId = !empty($insertedId) ? $insertedId : $kd_anggota;
                $this->saveDataUsaha('save', $insertedId);
            }

            // save M_doc_file
            $checkAnggota = MA::checkDataAnggota('m_data_docLegal', $kd_anggota);
            if ($checkAnggota[0]->kdAggota >= 1) {
                $insertedId = $kd_anggota;
                $this->saveDocFile('update', $insertedId);
            } else {
                $insertedId = !empty($insertedId) ? $insertedId : $kd_anggota;
                $this->saveDocFile('save', $insertedId);
            }
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
    private function savePribadi($status, $insertedId)
    {
        if ($status == 'update') {
            $mPribadi['tempat_lahir_pribadi'] = !empty(\Input::get('tempat_lahir_pribadi')) ? \Input::get('tempat_lahir_pribadi') : "";
            $mPribadi['kd_anggota'] = $insertedId;
            $mPribadi['npwp_pribadi'] = !empty(\Input::get('npwp_pribadi')) ? \Input::get('npwp_pribadi') : "";
            $mPribadi['noHp_pribadi'] = !empty(\Input::get('noHp_pribadi')) ? \Input::get('noHp_pribadi') : "";
            $mPribadi['email_pribadi']= !empty(\Input::get('email_pribadi')) ? \Input::get('email_pribadi') : "";
            $mPribadi['alamat_pribadi'] = !empty(\Input::get('alamat_pribadi')) ? \Input::get('alamat_pribadi') : "";
            $mPribadi['rtRw_pribadi'] = !empty(\Input::get('rtRw_pribadi')) ? \Input::get('rtRw_pribadi') : "";
            $mPribadi['kec_pribadi'] = !empty(\Input::get('kec_pribadi')) ? \Input::get('kec_pribadi') : "";
            $mPribadi['kabkot_pribadi'] = !empty(\Input::get('kec_pribadi')) ? \Input::get('kabkot_pribadi') : "";
            $mPribadi['desKel_pribadi'] = !empty(\Input::get('desKel_pribadi')) ? \Input::get('desKel_pribadi') : "";
            $mPribadi['wubTahun_pribadi'] = !empty(\Input::get('wubTahun_pribadi')) ? \Input::get('wubTahun_pribadi') : "";
            $mPribadi['wubDinas_pribadi'] = !empty(\Input::get('wubDinas_pribadi')) ? \Input::get('wubDinas_pribadi') : "";
            $execute = MP::where("kd_anggota", $insertedId)->update($mPribadi);
        } else {
            $mPribadi = new MP;
            $mPribadi->tempat_lahir_pribadi = \Input::get('tempat_lahir_pribadi');
            $mPribadi->kd_anggota = $insertedId;
            $mPribadi->npwp_pribadi = \Input::get('npwp_pribadi');
            $mPribadi->noHp_pribadi = \Input::get('noHp_pribadi');
            $mPribadi->email_pribadi = \Input::get('email_pribadi');
            $mPribadi->alamat_pribadi = \Input::get('alamat_pribadi');
            $mPribadi->rtRw_pribadi = \Input::get('rtRw_pribadi');
            $mPribadi->kec_pribadi = \Input::get('kec_pribadi');
            $mPribadi->kabkot_pribadi = \Input::get('kabkot_pribadi');
            $mPribadi->desKel_pribadi = \Input::get('desKel_pribadi');
            $mPribadi->wubTahun_pribadi = \Input::get('wubTahun_pribadi');
            $mPribadi->wubDinas_pribadi = \Input::get('wubDinas_pribadi');
            $mPribadi->created = "aku";
            $mPribadi->save();
        }
    }

    /**
     * save table m_data_usaha
     * @return post
     */
    private function saveDataUsaha($status, $insertedId)
    {

        if ($status == 'update') {
            $mDataUsaha['kd_anggota'] = $insertedId;
            $mDataUsaha['brand_usaha'] = \Input::get('brand_usaha');
            $mDataUsaha['lama_usaha'] = \Input::get('lama_usaha');
            $mDataUsaha['jenisProd_usaha'] = \Input::get('jenisProd_usaha');
            $mDataUsaha['alamat_usaha'] = \Input::get('alamat_usaha');
            $mDataUsaha['rtRw_usaha'] = \Input::get('rtRw_usaha');
            $mDataUsaha['kec_usaha'] = \Input::get('kec_usaha');
            $mDataUsaha['kel_usaha'] = \Input::get('kel_usaha');
            $mDataUsaha['kabKot_usaha'] = \Input::get('kabKot_usaha');
            $mDataUsaha['kapasitas_usaha'] = \Input::get('kapasitas_usaha');
            $mDataUsaha['harga_usaha'] = \Input::get('harga_usaha');
            $mDataUsaha['wilayah_offline_usaha'] = \Input::get('wilayah_offline_usaha');
            $mDataUsaha['wilayah_online_usaha'] = \Input::get('wilayah_online_usaha');
            $mDataUsaha['jumlahTenagaKerja_usaha'] = \Input::get('jumlahTenagaKerja_usaha');
            $mDataUsaha['omset_usaha'] = \Input::get('omset_usaha');
            $mDataUsaha['fb_usaha'] = \Input::get('fb_usaha');
            $mDataUsaha['insta_usaha'] = \Input::get('insta_usaha');
            $mDataUsaha['twiiter_usaha'] = \Input::get('twiiter_usaha');
            $mDataUsaha['created'] = "aku";
            $execute = MDU::where("kd_anggota", $insertedId)->update($mDataUsaha);
        } else {
            $mDataUsaha = new MDU;
            $mDataUsaha->kd_anggota = $insertedId;
            $mDataUsaha->brand_usaha = \Input::get('brand_usaha');
            $mDataUsaha->lama_usaha = \Input::get('lama_usaha');
            $mDataUsaha->jenisProd_usaha = \Input::get('jenisProd_usaha');
            $mDataUsaha->alamat_usaha = \Input::get('alamat_usaha');
            $mDataUsaha->rtRw_usaha = \Input::get('rtRw_usaha');
            $mDataUsaha->kec_usaha = \Input::get('kec_usaha');
            $mDataUsaha->kel_usaha = \Input::get('kel_usaha');
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
    }

    /**
     * save table m_data_docLegal
     * @return post
     */
    private function saveDocFile($status, $insertedId)
    {

        if ($status == 'update') {
            $mDocFile['kd_anggota'] = $insertedId;
            $mDocFile['npwp_docLegal'] = \Input::get('npwp_docLegal');
            $mDocFile['file_npwp_docLegal'] =  $this->uploadFileDocFIle('file_npwp_docLegal');
            $mDocFile['situ_docLegal'] = \Input::get('situ_docLegal');
            $mDocFile['file_situ_docLegal'] =  $this->uploadFileDocFIle('file_situ_docLegal');
            $mDocFile['siup_docLegal'] = \Input::get('siup_docLegal');
            $mDocFile['file_siup_docLegal'] =  $this->uploadFileDocFIle('file_siup_docLegal');
            $mDocFile['tdp_docLegal'] = \Input::get('tdp_docLegal');
            $mDocFile['file_tdp_docLegal'] =  $this->uploadFileDocFIle('file_tdp_docLegal');
            $mDocFile['bpom_docLegal'] = \Input::get('bpom_docLegal');
            $mDocFile['file_bpom_docLegal'] =  $this->uploadFileDocFIle('file_bpom_docLegal');

            $mDocFile['pirt_docLegal'] = \Input::get('pirt_docLegal');
            $mDocFile['file_pirt_docLegal'] =  $this->uploadFileDocFIle('file_pirt_docLegal');

            $mDocFile['halal_docLegal'] = \Input::get('halal_docLegal');
            $mDocFile['file_halal_docLegal'] =  $this->uploadFileDocFIle('file_halal_docLegal');

            $mDocFile['hki_docLegal'] = \Input::get('hki_docLegal');
            $mDocFile['file_hki_docLegal'] =  $this->uploadFileDocFIle('file_hki_docLegal');

            $mDocFile['merk_docLegal'] = \Input::get('merk_docLegal');
            $mDocFile['file_merk_docLegal'] =  $this->uploadFileDocFIle('file_merk_docLegal');

            $mDocFile['agreement_docLegal'] = \Input::get('agreement_docLegal');
            $mDocFile['file_agreement_docLegal'] =  $this->uploadFileDocFIle('file_agreement_docLegal');
            $mDocFile['created'] = "aku";
            $execute = MD::where("kd_anggota", $insertedId)->update(array_filter($mDocFile));
        } else {
            $mDocFile = new MD;
            $mDocFile->kd_anggota = $insertedId;
            $mDocFile->npwp_docLegal = \Input::get('npwp_docLegal');
            $mDocFile->file_npwp_docLegal =  $this->uploadFileDocFIle('file_npwp_docLegal');
            $mDocFile->situ_docLegal = \Input::get('situ_docLegal');
            $mDocFile->file_situ_docLegal =  $this->uploadFileDocFIle('file_situ_docLegal');
            $mDocFile->siup_docLegal = \Input::get('siup_docLegal');
            $mDocFile->file_siup_docLegal =  $this->uploadFileDocFIle('file_siup_docLegal');
            $mDocFile->tdp_docLegal = \Input::get('tdp_docLegal');
            $mDocFile->file_tdp_docLegal =  $this->uploadFileDocFIle('file_tdp_docLegal');
            $mDocFile->bpom_docLegal = \Input::get('bpom_docLegal');
            $mDocFile->file_bpom_docLegal =  $this->uploadFileDocFIle('file_bpom_docLegal');
            $mDocFile->pirt_docLegal = \Input::get('pirt_docLegal');
            $mDocFile->file_pirt_docLegal =  $this->uploadFileDocFIle('file_pirt_docLegal');
            $mDocFile->halal_docLegal = \Input::get('halal_docLegal');
            $mDocFile->file_halal_docLegal =  $this->uploadFileDocFIle('file_halal_docLegal');
            $mDocFile->hki_docLegal = \Input::get('hki_docLegal');
            $mDocFile->file_hki_docLegal =  $this->uploadFileDocFIle('file_hki_docLegal');
            $mDocFile->merk_docLegal = \Input::get('merk_docLegal');
            $mDocFile->file_merk_docLegal =  $this->uploadFileDocFIle('file_merk_docLegal');
            $mDocFile->agreement_docLegal = \Input::get('agreement_docLegal');
            $mDocFile->file_agreement_docLegal =  $this->uploadFileDocFIle('file_agreement_docLegal');
            $mDocFile->created = "aku";
            $mDocFile->save();
        }
    }

    /**
     * upload image
     * @return [type] [description]
     */
    private function uploadFile()
    {
        if (!empty(\Input::file('pasPhoto_anggota'))) {
            $file = \Input::file('pasPhoto_anggota')->isValid();
            $destinationPath = public_path().'/uploads'; // upload path
            $extension = \Input::file('pasPhoto_anggota')->getClientOriginalExtension(); // getting image extension
            $fileName = rand(11111, 99999).'.'.$extension; // renameing image
            \Input::file('pasPhoto_anggota')->move($destinationPath, $fileName); // uploading file to given path;
            return $fileName;
        }
    }

    /**
     * upload image
     * @return [type] [description]
     */
    private function uploadFileDocFIle($fn)
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
    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function photoProfile()
    {
        $kd_anggota = \Session::get('kd_anggota');
        $getPhoto = MA::where("kd_anggota", $kd_anggota)->first();
        $data['photo'] = !empty($getPhoto->pasPhotoProfile) ? $getPhoto->pasPhotoProfile : "";
        $data['kd_anggota'] = $kd_anggota;
        $data['selectedMenu'] = 'photoProfile';
        return view("profile.pasPhoto.photoProfile", $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function photoProfileUpload()
    {
        if (!empty(\Input::file('file'))) {
            $file = \Input::file('file')->isValid();
            $destinationPath = public_path().'/uploads/profile'; // upload path
            $extension = \Input::file('file')->getClientOriginalExtension(); // getting image extension
            $fileName = rand(11111, 99999).'.'.$extension; // renameing image
            \Input::file('file')->move($destinationPath, $fileName); // uploading file to given path;

            $kd_anggota = \Session::get('kd_anggota');
            $mAnggota =  MA::find($kd_anggota);
            ;
            $mAnggota->pasPhotoProfile = $fileName;
            $mAnggota->update();

            $result['filename'] = url('uploads/profile/'.$fileName);
            return response()->json($result);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function photoProduk()
    {
        $kd_anggota = \Session::get('kd_anggota');
        $getPhoto = MA::where("kd_anggota", $kd_anggota)->first();
        $data['photo'] = !empty($getPhoto->pasPhotoProduk) ? $getPhoto->pasPhotoProduk : "";
        $data['selectedMenu'] = 'photo-produk';
        return view("profile.pasPhoto.photoProduk", $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function photoProdukUpload()
    {
        if (!empty(\Input::file('file'))) {
            $file = \Input::file('file')->isValid();
            $destinationPath = public_path().'/uploads/produk'; // upload path
            $extension = \Input::file('file')->getClientOriginalExtension(); // getting image extension
            $fileName = rand(11111, 99999).'.'.$extension; // renameing image
            \Input::file('file')->move($destinationPath, $fileName); // uploading file to given path;

            $kd_anggota = \Session::get('kd_anggota');
            $mAnggota =  MA::find($kd_anggota);
            ;
            $mAnggota->pasPhotoProduk = $fileName;
            $mAnggota->update();

            $result['filename'] = url('uploads/produk/'.$fileName);
            return response()->json($result);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function gantiPassword()
    {
        $id = \Auth::user()->id;
        $data = US::where('id', $id)->get()->toArray();
        $sendData= array();
        foreach ($data[0] as $a => $c) {
            $sendData[$a] = $c;
        }

        $sendData['selectedMenu'] = 'ganti-password';
        return view("profile.gantiPassword", $sendData);
    }

    public function processGantiPassword()
    {

        $id = \Auth::user()->id;
        $rules = array(
            'oldpass'    => 'required',
            'newpass' => 'required',
        );
        $validator = \Validator::make(\Input::all(), $rules);

        if ($validator->fails()) {
            return \Redirect::to($_ENV['ADMIN_FOLDER'].'/profile-ganti-password')->withErrors($validator);
        } else {

            $update = US::find($id);
            if (\Input::has("newpass")) {
                $oldpassword = \Input::get('oldpass');
                $newpassword = \Input::get("newpass");

                if (\Hash::check($oldpassword, \Auth::user()->password)) {
                    $update->password = \Hash::make($newpassword);
                } else {
                    return \Redirect::to($_ENV['ADMIN_FOLDER'].'/profile-ganti-password')->withErrors(["Wrong old password"]);
                }
            }

            $update->save();
            return \Redirect::to($_ENV['ADMIN_FOLDER'].'/profile-ganti-password')->with(["success"=>"Data saved"]);
        }
    }
}
