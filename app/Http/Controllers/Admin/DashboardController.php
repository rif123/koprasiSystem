<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\guest_book as GuestModel;
use App\Models\Team as TeamModel;
use App\Models\Post as PS;
use App\Models\Project as PJ;
use App\Models\Swajib as SW;
use App\Models\Income as Ic;
use App\liblary\Format;
use App\Models\News as NW;
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
        if ( \Session::get('user_grp') == 5) {
            // $data['simpanan'] = get();
            $swajib = SW::getAll();
            $sumSwajib = 0;
            if (!empty($swajib)) {
                foreach ($swajib as $key => $value) {
                    $sumSwajib += $value->jml_bayar_wajib;
                }
            }
            $data['sumSwajib'] = Format::getRp($sumSwajib);
            $incomeWajib = Ic::getAllForSum();
            $sumSwajib = 0;
            if (!empty($incomeWajib)) {
                foreach ($incomeWajib as $key => $value) {
                    $sumSwajib += $value->jml_income;
                }
            }
            $data['sumSwajib'] = Format::getRp($sumSwajib);
        }
        $data['listNews'] = NW::where('status', "Active")->get();
        return view("content.dashboard",$data)->with('parser', $this->parser);
    }

    public function detail () {
        $data['listNews'] = NW::where('id_news', \Input::get('id'))->get();
        return view("content.detailNews",$data)->with('parser', $this->parser);
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
