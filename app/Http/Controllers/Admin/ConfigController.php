<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

// get helpers


// models
use App\Models\MenuAdmin as MA;
use App\Models\Mrole as MR;
use App\Models\Mgroup as MG;
use App\Models\User as US;
use App\liblary\Format;


// use App\liblary\Helpers as HP;


class ConfigController extends Controller
{
    private $parser = [];
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function menu()
    {
        $listMenu = MA::all()->sortByDesc("id_menu");
        $data['listMenu'] = $listMenu;
        return view("config.menu", $data)->with('parser', $this->parser);
    }

    public function menuSave()
    {
        $rules=[
            'name_menu'=>'required',
            'url_menu'=>'required',
            'parent_menu'=>'required',
            'icon_menu'=>'required',

        ];
        $messages=[
            'name_menu.required'=>config('constants.ERROR_NAME_MENU'),
            'url_menu.required'=>config('constants.ERROR_URL_NAME'),
            'parent_menu.required'=>config('constants.ERROR_PARENT_MENU'),
            'icon_menu.required'=>config('constants.ERROR_ICON_MENU'),
        ];
        $validator=Validator::make(\Input::all(), $rules, $messages);
        // echo "<pre>";
        // print_R(\Input::all());die;
        if ($validator->fails()) {
            $message = $validator->errors()->first();
            return \Redirect::back()->withErrors($message);
        } else {
            $data = new MA;
            $data->name_menu = \Input::get('name_menu');
            $data->url_menu = \Input::get('url_menu');
            $data->parent_menu = \Input::get('parent_menu');
            $data->icon_menu = \Input::get('icon_menu');
            $data->save();
            return \Redirect::to(route('config.menu'));
        }
    }


    public function menuUpdate()
    {
        $rules=[
            'name_menu'=>'required',
            'url_menu'=>'required',
            'parent_menu'=>'required',
            'id_menu'=>'required',
            'icon_menu'=>'required',

        ];
        $messages=[
            'name_menu.required'=>config('constants.ERROR_NAME_MENU'),
            'url_menu.required'=>config('constants.ERROR_URL_NAME'),
            'parent_menu.required'=>config('constants.ERROR_PARENT_MENU'),
            'id_menu.required'=>config('constants.ERROR_ID_MENU_NOT_DEFINE'),
            'icon_menu.required'=>config('constants.ERROR_ICON_MENU'),
        ];
        $validator=Validator::make(\Input::all(), $rules, $messages);
        if ($validator->fails()) {
            $message = $validator->errors()->first();
            return \Redirect::back()->withErrors($message);
        } else {
            $id_menu = \Input::get('id_menu');
            $updateData = [
                'name_menu' => \Input::get('name_menu'),
                'url_menu' => \Input::get('url_menu'),
                'parent_menu' => \Input::get('parent_menu'),
                'icon_menu' => \Input::get('icon_menu')
            ];
            $data = MA::find($id_menu)->update($updateData);
            return \Redirect::to(route('config.menu'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function menuDestroy()
    {

        $rules = [
            'id_menu'=>'required',
        ];
        $messages = [
            'id_menu.required'=>config('constants.ERROR_ID_MENU_NOT_DEFINE'),
        ];
        $validator=Validator::make(\Input::all(), $rules, $messages);
        if ($validator->fails()) {
            $message = $validator->errors()->first();
            return \Redirect::back()->withErrors($message);
        } else {
            $id_menu = \Input::get('id_menu');
            // delete related tabel
            $delete = MR::roleDeleteIdMenu($id_menu);
            $data = MA::find($id_menu);
            $data->delete();
            return \Redirect::to(route('config.menu'));
        }
    }

    /**
     * List Show all menu
     *
     * @param  int  $id
     * @return Response
     */
    public function menuShowAll()
    {
        $this->parser['allMenu'] = \Helpers::getMenuAll();
        return view("config.listMenu", $this->parser);
    }
    /**
     * List Show all menu
     *
     * @param  int  $id
     * @return Response
     */
    public function menuIcon()
    {
        return view("config.listMenuIcon", $this->parser);
    }


    public function configRole()
    {
        $listGroup = MG::all();
        $data['listGroup'] = $listGroup;
        $data['allMenu'] = \Helpers::getMenuAll();
        $data['listSelected']  = [];
        return view("config.role.role", $data)->with('parser', $this->parser);
    }
    public function reloadMenu()
    {
        $listGroup = MG::all();
        $data['listGroup'] = $listGroup;
        $data['allMenu'] = \Helpers::getMenuAll();
        $usr_grp = \Input::get('user_grp');
        $data['listSelected']  = MR::getSelected($usr_grp);
        $result['html'] = view("config.role.roleMenu", $data)->with('parser', $this->parser)->render();
        return response()->json($result);
    }
    public function editRole()
    {
        $data = \Input::all();
        $delete = MR::roleDelete($data['group_name']);
        if (!empty($data['id_menu'])) {
            foreach ($data['id_menu'] as $key => $value) {
                $roleInsert = new MR;
                $roleInsert->user_grp = $data['group_name'];
                $roleInsert->id_menu = $value;
                $roleInsert->save();
            }
        }
        $result['status'] = true;
        return response()->json($result);
    }


    /**
     * List group
     *
     * @return Response
     */
    public function menuGroup() {
        $listGroup = MG::all();
        $data['list'] = $listGroup;
        return view("config.group.group", $data)->with('parser', $this->parser);
    }

    public function groupSave() {
        // save M_anggota
        $mGroup = new MG;
        $mGroup->group_name = \Input::get('group_name');
        $mGroup->save();
        return response()->json(['status' => true, 'message' => config('constants.SUCCESS_FORM') ]);

    }


    public function groupShow() {
        // show GROUP
        $user_grp = \Input::get('user_grp');
        $dataGroup = MG::find($user_grp);
        return response()->json(['status' => true, 'data' => $dataGroup ]);

    }

    public function groupEdit() {
        // show GROUP
        $user_grp = \Input::get('user_grp');
        $group_name = \Input::get('group_name');
        $updateData = ['group_name' => $group_name];
        $data = MG::find($user_grp)->update($updateData);
        return response()->json(['status' => true, 'message' => config('constants.SUCCESS_FORM')]);

    }

    public function groupDelete() {
        // show GROUP
        $user_grp = \Input::get('user_grp');
        $data = MG::find($user_grp);
        $data->delete();
        return \Redirect::to(route('config.menuGroup'));
    }

    public function anggotaDetail(){
        $query  = "select * from m_jenis_usaha";
        $getJenisUsaha = \DB::select($query);
        $data['jenisUsaha'] = $getJenisUsaha;
        return view("config.anggota", $data)->with('parser', $this->parser);
    }
    public function anggotaDetailAjax () {
        $draw=$_REQUEST['draw'];
        $length=$_REQUEST['length'];
        $start=$_REQUEST['start'];
        $search=$_REQUEST['search']["value"];
       // ======= count ===== //
        $getCount = US::mAllAnggotaCount();
        $total = !empty($getCount[0]->count) ? $getCount[0]->count : 0;
       // ======= count ===== //

       $output=array();
        $output['draw']=$draw;
        $output['recordsTotal']=$output['recordsFiltered']=$total;
        $output['data']=array();
        $query = US::mAllAnggota();
        $list = [];
        $ex = new Format;
        $no = 1;
        foreach ($query as $key => $row) {
            $json['no'] = $no;
            $json['uname'] = $row->uname;
            $json['nm_anggota'] = $row->nm_anggota;
            $json['no_anggota'] = $row->no_anggota;
            $json['kabKot_usaha'] = $row->kabKot_usaha;
            $json['jenisProd_usaha'] = $row->jenisProd_usaha;
            $json['kd_anggota'] = $row->kdAggota;
            $json['id'] = $row->id;
            $list[] = $json;
            $no++;
        }
        $output['data']  = $list;
        echo json_encode($output);
    }

    public function anggotaDetailAll($id) {
        $listGroup = US::mAnggotaDetail($id);
        $data['list'] = $listGroup[0];
        return view("config.anggota.detailAnggota", $data)->with('parser', $this->parser);
    }

    public function anggotaDetailExcel (){
        $id = \Input::get('kd');
        $listGroup = US::mAnggotaDetail($id);
        $data['list'] = $listGroup[0];
        return view("config.anggota.export.detailAnggotaExcel", $data)->with('parser', $this->parser);
    }
    public function anggotaDetailExcelList (){
        $id = \Input::get('kd');
        $listGroup = US::mAnggotaList();
        $data['list'] = $listGroup;
        return view("config.anggota.export.listAnggotaExcel", $data)->with('parser', $this->parser);
    }


}
