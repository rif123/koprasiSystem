<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\News as NW;
use App\liblary\Format;

class configNewsController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Home Controller
    |--------------------------------------------------------------------------
    |
    | This controller renders your application's "dashboard" for users that
    | are authenticated. Of course, you are free to change or remove the
    | controller as you wish. It is just here to get your app started!
    |
    */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard to the user.
     *
     * @return Response
     */
    public function index()
    {
        $data['data'] = NW::all();
        $data['status'] = ['Active','Non Active'];
        return view('config.news.news',$data);
    }
   public function indexAjax()
   {
       $draw=$_REQUEST['draw'];
       $length=$_REQUEST['length'];
       $start=$_REQUEST['start'];
       $search=$_REQUEST['search']["value"];
       $listWajib = new NW;
       // ======= count ===== //
       $total=count(NW::getAll());
       // ======= count ===== //
       $output=array();
       $output['draw']=$draw;
       $output['recordsTotal']=$output['recordsFiltered']=$total;
       $output['data']=array();
       $query = NW::getAll();

       $list = [];
       $ex = new Format;
       foreach ($query as $key => $row) {
           $json['id_news'] =$row->id_news;
           $json['judul_news'] =$row->judul_news;
           $json['description_news'] = substr($row->description_news, 0, 20)."...";
           $json['tanggal_news'] = date('d-m-Y', strtotime($row->tanggal_news));
           $json['status']  = $row->status ;
           $list[] = $json;
       }
       $output['data']  = $list;
       return response()->json($output);
   }


    public function create()
    {
        $rules=[
            'judul_news'=>'required',
            'description_news'=>'required',
            'tanggal_news'=>'required',
            'status'=>'required',
        ];
        $messages=[
            'judul_news.required'=>config('constants.ERROR_judul_news'),
            'description_news.required'=>config('constants.ERROR_description_news'),
            'tanggal_news.required'=>config('constants.ERROR_tanggal_news'),
            'status.required'=>config('constants.ERROR_status'),
        ];
        $validator=Validator::make(\Input::all(), $rules, $messages);

        if ($validator->passes()) {
            $news = new NW;
            $news->judul_news = \Input::get('judul_news');
            $news->description_news = \Input::get('description_news');
            $news->tanggal_news = date('Y-m-d', strtotime(\Input::get('tanggal_news')));
            $news->status = \Input::get('status');
            $news->file_news = $this->uploadFileDocFIle('file_news');
            $news->save();
            return \Redirect::to(route('config.news'));
        } else {
            $message = $validator->errors()->first();
            return \Redirect::back()->withErrors($message);
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
            $fileName = strtotime(date('Ymdhis')).'.'.$extension; // renameing image
            \Input::file($fn)->move($destinationPath, $fileName); // uploading file to given path;
            return $fileName;
        }
    }

    public function edit($id_news)
    {
        $update = NW::where('id_news', $id_news)->get();
        $data   = [];
        $data['data'] = NW::all();
        $data['status'] = ['Active','Non Active'];
        foreach ($update as $key => $value) {
            $data['judul_news'] = $value->judul_news;
            $data['description_news'] = $value->description_news;
            $data['tanggal_news'] = $value->tanggal_news;
            $data['sts'] = $value->status;
            $data['id_news'] = $value->id_news;
        }
     return view('config.news.news',$data);    }

    public function update()
    {

         $rules=[
            'judul_news'=>'required',
            'description_news'=>'required',
            'tanggal_news'=>'required',
            'status'=>'required',
        ];
        $messages=[
            'judul_news.required'=>config('constants.ERROR_judul_news'),
            'description_news.required'=>config('constants.ERROR_description_news'),
            'tanggal_news.required'=>config('constants.ERROR_tanggal_news'),
            'status.required'=>config('constants.ERROR_status'),
        ];
         $validator=Validator::make(\Input::all(), $rules, $messages);

        if ($validator->passes()) {
          $news = NW::find(\Input::get('id_news'));
            $news->judul_news = \Input::get('judul_news');
            $news->description_news = \Input::get('description_news');
            $news->tanggal_news = date('Y-m-d', strtotime(\Input::get('tanggal_news')));
            $news->status = \Input::get('status');
            if (!empty(\Input::file('file_news'))) {
                $news->file_news = $this->uploadFileDocFIle('file_news');
            }
            $news->update();
            return \Redirect::to(route('config.news'));
        } else {
            $message = $validator->errors()->first();
            return \Redirect::back()->withErrors($message);
        }
    }
    public function delete($id_news)
    {
        $news = NW::find($id_news);

        $news->delete();
        return \Redirect::to(route('config.news'));
    }

}
