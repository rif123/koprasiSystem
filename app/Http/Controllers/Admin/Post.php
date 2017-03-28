<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Post as PS;
use App\Models\Setting as ST;

use Illuminate\Http\Request;

class Post extends Controller {
	private $parser = array();


	public function index(){
        $data['data'] = PS::select('id','title','date','active')->paginate(7);
        return view("content.post",$data)->with('parser', $this->parser);
    }

        public function setting(){
        $data = ST::select('setting_name','value')->whereIn('setting_name',Array("section6_title","section6_background"))->get()->toArray();
        $b= array();
        
        foreach($data as $a => $c){
             $b[$c['setting_name']] = $c['value'];
        }
        return view("content.post-setting",$b)->with('parser', $this->parser);
    }

    public function settingProcess(){
        $rules = array(
            'name'    => 'required', 
            'img' => 'image|mimes:jpg,png,jpeg|max:1024|min:1',        
        );

        $validator = \Validator::make(\Input::all(), $rules);

        if($validator->fails()){
            return \Redirect::to($_ENV['ADMIN_FOLDER'].'/post/setting')->withErrors($validator);
        }
        else{
            $title = \Input::get('name');
              
            if(\Input::hasFile('img')){
                $imageName = \Input::file('img')->getClientOriginalName();
                \Input::file("img")->move(public_path().'/images/image-gallery/', $imageName);
              }
              else if(\Input::has('image')){
                $imageName = \Input::get('image');
              }

            $affected = \DB::update("update settings set `value` = CASE setting_name WHEN 'section6_title' THEN ? WHEN 'section6_background' THEN ? END WHERE setting_name IN('section6_title','section6_background')", [$title,$imageName]);
            
            return \Redirect::to($_ENV['ADMIN_FOLDER'].'/post/setting')->with(["success"=>"Data saved"]);
        }
    }

    public function add(){
        return view("content.post-add")->with('parser', $this->parser);
    }

    public function addProcess(){
        $rules = array(
            'title'    => 'required',
            'description' => 'required',
            'featuredimg' => 'image|mimes:jpg,png,jpeg|max:1024|min:1',
        );

         $validator = \Validator::make(\Input::all(), $rules);

        if($validator->fails()){
            return \Redirect::to($_ENV['ADMIN_FOLDER'].'/post/add')->withErrors($validator);
        }
        else{
             $insert = new PS;
             $insert->title = \Input::get('title');
             $insert->text = \Input::get('description');
             $insert->active = (\Input::has('active'))? 1:0;
             $insert->date = time();

             if(\Input::hasFile('featuredimg')){
                $imageName = \Input::file('featuredimg')->getClientOriginalName();
                \Input::file("featuredimg")->move(public_path().'/images/image-gallery/', $imageName);
                $insert->featured_image = $imageName;
              }
              else if(\Input::has('featuredimage')){
                $insert->featured_image = \Input::get('featuredimage');
              }


                $insert->save();
        }
        return \Redirect::to($_ENV['ADMIN_FOLDER'].'/post')->with(["success"=>"New data added.."]);
    }

    public function edit($id){
        $data = PS::where("id",$id)->get()->toArray();
        $b= array();
        foreach($data[0] as $a => $c){
            $b[$a] = $c;
        }

        return view("content.post-edit",$b)->with('parser', $this->parser);
    }

    public function editProcess($id){
        $rules = array(
            'title'    => 'required',
            'description' => 'required',
            'featuredimg' => 'image|mimes:jpg,png,jpeg|max:1024|min:1',
        );

        $validator = \Validator::make(\Input::all(), $rules);
 
        if($validator->fails()){
            return \Redirect::to($_ENV['ADMIN_FOLDER'].'/post/edit/'.$id)->withErrors($validator);
        }
        else{
              $update = PS::find($id);
              $update->title = \Input::get('title');
              $update->text = \Input::get('description');
              $update->active = (\Input::has('active'))? 1:0;

             if(\Input::hasFile('featuredimg')){
                $imageName = \Input::file('featuredimg')->getClientOriginalName();
                \Input::file("featuredimg")->move(public_path().'/images/image-gallery/', $imageName);
                $update->featured_image = $imageName;
              }
              else if(\Input::has('featuredimage')){
                $update->featured_image = \Input::get('featuredimage');
              }

              $update->save();

        }

        return \Redirect::to($_ENV['ADMIN_FOLDER'].'/post')->with(["success"=>"Data edited."]);

    }

    public function delete($id){
        $delete = PS::find($id);
        $delete->delete();

        return \Redirect::to($_ENV['ADMIN_FOLDER'].'/post')->with(["success"=>"Data deleted.."]);

    }

	
}
