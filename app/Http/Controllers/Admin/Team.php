<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Team as TeamModel;
use App\Models\Setting as ST;
use Intervention\Image;


use Illuminate\Http\Request;

class Team extends Controller {
	private $parser = array();

	public function index()
	{
		$data['data'] = TeamModel::select('id','name','position')->paginate(7);
		return view("content.team",$data)->with('parser', $this->parser);
	}

  public function setting(){
        $data['data'] = ST::select('value')->where('setting_name','section4_title')->get()->first();
        return view("content.team-setting",$data)->with('parser', $this->parser);
    }

    public function settingProcess(){
        $rules = array(
            'name'    => 'required'    
        );

        $validator = \Validator::make(\Input::all(), $rules);

        if($validator->fails()){
            return \Redirect::to($_ENV['ADMIN_FOLDER'].'/team/setting')->withErrors($validator);
        }
        else{
            $title = \Input::get('name');
            $update = ST::where('setting_name','section4_title');
            $update->update(['value' => $title]);


            return \Redirect::to($_ENV['ADMIN_FOLDER'].'/team/setting')->with(["success"=>"Data saved"]);
        }
    }

	public function addPerson(){
		return view("content.team-add")->with('parser', $this->parser);
	}

	public function addPersonProcess(){
		$rules = array(
            'name'    => 'required', 
            'position' => 'required',
            'photo' => 'image|mimes:jpg,png,jpeg|max:1024|min:1',		
        );

        $validator = \Validator::make(\Input::all(), $rules);

        if($validator->fails()){
            return \Redirect::to($_ENV['ADMIN_FOLDER'].'/team/add')->withErrors($validator);
        }
        else{
              $social = array(
                            "fb"=>\Input::get('fb'),
                            "tw"=>\Input::get('tw'),
                            "ig"=>\Input::get('ig'),
                            "gp"=>\Input::get('gp'),
                        );

        	  $insert = new TeamModel;
        	  $insert->name = \Input::get('name');
        	  $insert->position = \Input::get('position');
        	  $insert->description = \Input::get('description');
              $insert->social = serialize($social);

        	  $insert->save();

              if(\Input::hasFile("photo")){
              	$imageName = $insert->id.'.jpg';
    			      \Input::file("photo")->move(public_path().'/images/image-gallery/team/', $imageName);
              }
        }

		return \Redirect::to($_ENV['ADMIN_FOLDER'].'/team')->with(["success"=>"New data added.."]);
	}

	public function delete($id){
		$delete = TeamModel::find($id);
		$delete->delete();

    if(file_exists(public_path()."/images/image-gallery/team/".$id.".jpg")){
      unlink(public_path()."/images/image-gallery/team/".$id.".jpg");
    }

		
		return \Redirect::to($_ENV['ADMIN_FOLDER'].'/team')->with(["success"=>"Data deleted.."]);
	}



	public function editPerson($id){
		$data = TeamModel::where("id",$id)->get()->toArray();
		$b= array();
		foreach($data[0] as $a => $c){
            if($a == "social"){
                $b[$a] = unserialize($c);
            }
            else{
			 $b[$a] = $c;
            }
		}

		return view("content.team-edit",$b)->with('parser', $this->parser);
	}

	public function editPersonProcess($id){
		$rules = array(
            'name'    => 'required', 
            'position' => 'required',
            'photo' => 'image|mimes:jpg,png,jpeg|max:1024|min:1',		
        );

       	$validator = \Validator::make(\Input::all(), $rules);
 
        if($validator->fails()){
            return \Redirect::to($_ENV['ADMIN_FOLDER'].'/team/edit/'.$id)->withErrors($validator);
        }
        else{
        	  $social = array(
                            "fb"=>\Input::get('fb'),
                            "tw"=>\Input::get('tw'),
                            "ig"=>\Input::get('ig'),
                            "gp"=>\Input::get('gp'),
                        );

              $update = TeamModel::find($id);
              $update->name = \Input::get('name');
              $update->position = \Input::get('position');
              $update->description = \Input::get('description');
              $update->social = serialize($social);

        	  $update->save();

              if(\Input::hasFile("photo")){
                $image = \Input::file('photo');
              	$imageName = $id.'.'.$image->getClientOriginalExtension();
                $path = public_path().'/images/image-gallery/team/';
                $image->move($path,$imageName);
                //$img = \Image::make($image->getRealPath());
                //$height = 600 * $img->height()/$img->width();
                //$img->resize(600, $height);
                //$img->save($path);
              }
        }

        return \Redirect::to($_ENV['ADMIN_FOLDER'].'/team')->with(["success"=>"Data edited."]);
	}

}
