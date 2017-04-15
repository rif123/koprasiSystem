<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Process_text as PC;
use App\Models\Setting as ST;

use Illuminate\Http\Request;

class Process_text extends Controller {
	private $parser = array();
	
	public function index(){
		$data['data'] = PC::paginate(7);
		return view("content.process_text",$data)->with('parser', $this->parser);
	}

	public function setting(){
		$data = ST::select('setting_name','value')->whereIn('setting_name',Array("section3_title","section3_background"))->get()->toArray();
        $b= array();
        
        foreach($data as $a => $c){
             $b[$c['setting_name']] = $c['value'];
        }
		return view("content.process_text-setting",$b)->with('parser', $this->parser);
	}

	public function settingProcess(){
		$rules = array(
            'name'    => 'required', 
            'img' => 'image|mimes:jpg,png,jpeg|max:1024|min:1',        
        );

        $validator = \Validator::make(\Input::all(), $rules);

        if($validator->fails()){
            return \Redirect::to($_ENV['ADMIN_FOLDER'].'/process_text/setting')->withErrors($validator);
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

            $affected = \DB::update("update settings set `value` = CASE setting_name WHEN 'section3_title' THEN ? WHEN 'section3_background' THEN ? END WHERE setting_name IN('section3_title','section3_background')", [$title,$imageName]);
            
            return \Redirect::to($_ENV['ADMIN_FOLDER'].'/process_text/setting')->with(["success"=>"Data saved"]);
        }
	}

	public function add(){
		return view("content.process_text-add")->with('parser', $this->parser);
	}

	public function addProcess(){
		$rules = array(
            'title'    => 'required|min:6', 
            'textbox' => 'required|min:15',
        );

        $validator = \Validator::make(\Input::all(), $rules);

        if($validator->fails()){
            return \Redirect::to($_ENV['ADMIN_FOLDER'].'/process_text/add')->withErrors($validator);
        }
        else{

        	  $insert = new PC;
        	  $insert->title = \Input::get('title');
        	  $insert->textbox = \Input::get('textbox');

        	  $insert->save();
        }

		return \Redirect::to($_ENV['ADMIN_FOLDER'].'/process_text')->with(["success"=>"New data added.."]);
	}

	public function edit($id){
		$data = PC::where("id",$id)->get()->toArray();
		$b= array();
		foreach($data[0] as $a => $c){
			 $b[$a] = $c;
		}

		return view("content.process_text-edit",$b)->with('parser', $this->parser);
	}

	public function editProcess($id){
		$rules = array(
            'title'    => 'required|min:6', 
            'textbox' => 'required|min:15',
        );

       	$validator = \Validator::make(\Input::all(), $rules);
 
        if($validator->fails()){
            return \Redirect::to($_ENV['ADMIN_FOLDER'].'/process_text/edit/'.$id)->withErrors($validator);
        }
        else{

              $update = PC::find($id);
        	  $update->title = \Input::get('title');
        	  $update->textbox = \Input::get('textbox');

        	  $update->save();
        }

        return \Redirect::to($_ENV['ADMIN_FOLDER'].'/process_text')->with(["success"=>"Data edited."]);
	}


	public function delete($id){
		$delete = PC::find($id);
		$delete->delete();

		return \Redirect::to($_ENV['ADMIN_FOLDER'].'/process_text')->with(["success"=>"Data deleted.."]);

	}

}
