<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Skills as SkillModel;
use App\Models\Setting as ST;

use Illuminate\Http\Request;

class Skill extends Controller {
	private $parser = array();
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(){
		$data['data'] = SkillModel::paginate(3);
		return view("content.skill",$data)->with('parser', $this->parser);
	}

    public function setting(){
        $data['data'] = ST::select('value')->where('setting_name','section2_title')->get()->first();
        return view("content.skill-setting",$data)->with('parser', $this->parser);
    }

    public function settingProcess(){
        $rules = array(
            'name'    => 'required'
        );

        $validator = \Validator::make(\Input::all(), $rules);

        if($validator->fails()){
            return \Redirect::to($_ENV['ADMIN_FOLDER'].'/skill/setting')->withErrors($validator);
        }
        else{
            $title = \Input::get('name');
            $update = ST::where('setting_name','section2_title');
            $update->update(['value' => $title]);


            return \Redirect::to($_ENV['ADMIN_FOLDER'].'/skill/setting')->with(["success"=>"Data saved"]);
        }
    }

	public function add(){
		return view("content.skill-add")->with('parser', $this->parser);
	}

	public function addProcess(){
		$rules = array(
            'title'    => 'required|min:6',
            'description' => 'required|min:10',
            'img' => 'image|mimes:jpg,png,jpeg|max:1024|min:1',
        );

        $validator = \Validator::make(\Input::all(), $rules);

        if($validator->fails()){
            return \Redirect::to($_ENV['ADMIN_FOLDER'].'/skill/add')->withErrors($validator);
        }
        else{

        	  $insert = new SkillModel;
        	  $insert->title = \Input::get('title');
        	  $insert->description = \Input::get('description');

        	  if(\Input::hasFile('img')){
        	  	$imageName = \Input::file('img')->getClientOriginalName();
        	  	\Input::file("img")->move(public_path().'/images/image-gallery/', $imageName);
        	  	$insert->image = $imageName;
        	  }
        	  else if(\Input::has('image')){
        	  	$insert->image = \Input::get('image');
        	  }

        	  $insert->save();
        }

		return \Redirect::to($_ENV['ADMIN_FOLDER'].'/skill')->with(["success"=>"New data added.."]);
	}

	public function delete($id){
		$delete = SkillModel::find($id);
		$delete->delete();

		return \Redirect::to($_ENV['ADMIN_FOLDER'].'/skill')->with(["success"=>"Data deleted.."]);

	}

	public function edit($id){
		$data = SkillModel::where("id",$id)->get()->toArray();
		$b= array();
		foreach($data[0] as $a => $c){
			 $b[$a] = $c;
		}

		return view("content.skill-edit",$b)->with('parser', $this->parser);
	}

	public function editProcess($id){
		$rules = array(
            'title'    => 'required|min:6',
            'description' => 'required|min:10',
            'img' => 'image|mimes:jpg,png,jpeg|max:1024|min:1',
        );

       	$validator = \Validator::make(\Input::all(), $rules);

        if($validator->fails()){
            return \Redirect::to($_ENV['ADMIN_FOLDER'].'/skill/edit/'.$id)->withErrors($validator);
        }
        else{

              $update = SkillModel::find($id);
              $update->title = \Input::get('title');
              $update->description = \Input::get('description');

        	  if(\Input::hasFile('img')){
        	  	$imageName = \Input::file('img')->getClientOriginalName();
        	  	\Input::file("img")->move(public_path().'/images/image-gallery/', $imageName);
        	  	$update->image = $imageName;
        	  }
        	  else if(\Input::has('image')){
        	  	$update->image = \Input::get('image');
        	  }

        	  $update->save();
        }

        return \Redirect::to($_ENV['ADMIN_FOLDER'].'/skill')->with(["success"=>"Data edited."]);
	}

}
