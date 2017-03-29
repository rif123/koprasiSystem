<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\Input;
use Illuminate\Http\Request;
// model flight
use App\Models\MdataPribadi as mdp;
use App\Models\MAnggota as MA;
use App\Models\MdataPribadi as MP;


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
		return view("profile.index",$data)->with('parser', $this->parser);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

		// $data = MA::all();
		echo "<pre>";
		// print_r(\Session::all());die;
        print_R(\Input::all());die;
		$mAnggota = new MA;
        $mAnggota->nm_anggota = \Input::get('nm_anggota');
        $mAnggota->save();

		$mPribadi = new MP;
		$mPribadi->tempat_lahir_pribadi = \Input::get('tempat_lahir_pribadi');
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
