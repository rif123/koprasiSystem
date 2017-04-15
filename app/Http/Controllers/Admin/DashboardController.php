<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\guest_book as GuestModel;
use App\Models\Team as TeamModel;
use App\Models\Post as PS;
use App\Models\Project as PJ;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private $parser = array();
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $data['team'] = TeamModel::select('id','name','position')->get();
        $data['post'] = PS::select('id','title','date','active')->get();
        $data['project'] = PJ::with('project_category')->get();
        $data['data'] = GuestModel::where('has_read','0')->get();
        return view("content.dashboard",$data)->with('parser', $this->parser);
    }

    public function privilege()
    {

        return view("content.privilege")->with('parser', $this->parser);
    }

    public function logout()
    {
        //
        \Auth::logout();
        \Session::flush();
        return redirect("auth/login");
    }


}
