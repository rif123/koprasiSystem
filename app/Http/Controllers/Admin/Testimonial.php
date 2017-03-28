<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Testimonial as Testi;
use App\Models\Setting as ST;
use Illuminate\Support\Str;

use Illuminate\Http\Request;

class Testimonial extends Controller {
	private $parser = array();

	public function index(){
		$data['data'] = Testi::paginate(7); 
		return view("content.testimonial",$data)->with('parser', $this->parser);
	}

    public function setting(){
        $data = ST::select('setting_name','value')->whereIn('setting_name',Array("section5_title","section5_background"))->get()->toArray();
        $b= array();
        
        foreach($data as $a => $c){
             $b[$c['setting_name']] = $c['value'];
        }
        return view("content.testimonial-setting",$b)->with('parser', $this->parser);
    }

    public function settingProcess(){
        $rules = array(
            'name'    => 'required', 
            'img' => 'image|mimes:jpg,png,jpeg|max:1024|min:1',        
        );

        $validator = \Validator::make(\Input::all(), $rules);

        if($validator->fails()){
            return \Redirect::to($_ENV['ADMIN_FOLDER'].'/testimonial/setting')->withErrors($validator);
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

            $affected = \DB::update("update settings set `value` = CASE setting_name WHEN 'section5_title' THEN ? WHEN 'section5_background' THEN ? END WHERE setting_name IN('section5_title','section5_background')", [$title,$imageName]);
            
            return \Redirect::to($_ENV['ADMIN_FOLDER'].'/testimonial/setting')->with(["success"=>"Data saved"]);
        }
    }


	public function delete($id){
		$delete = Testi::find($id);
		$delete->delete();
		return \Redirect::to($_ENV['ADMIN_FOLDER'].'/testimonial')->with(["success"=>"Data deleted.."]);
	}

	public function addView(){
		return view("content.testimonial-add")->with('parser', $this->parser);	
	}

	public function addProcess(){
		$rules = array(
            'name'    => 'required', 
            'position' => 'required',
            'testimonial' => 'required|min:10',	
        );

        $validator = \Validator::make(\Input::all(), $rules);

        if($validator->fails()){
            return \Redirect::to($_ENV['ADMIN_FOLDER'].'/testimonial/add')->withErrors($validator);
        }
        else{
        	  $insert = new Testi;
        	  $insert->customer_name = \Input::get('name');
        	  $insert->customer_status = \Input::get('position');
        	  $insert->testimoni = \Input::get('testimonial');
        	  $insert->active = (\Input::has('active'))? 1:0;

        	  $insert->save();
        }

		return \Redirect::to($_ENV['ADMIN_FOLDER'].'/testimonial')->with(["success"=>"New data added.."]);
	}

	public function edit($id){
		$data = Testi::where("id",$id)->get()->toArray();
		$b= array();
		foreach($data[0] as $a => $c){
			$b[$a] = $c;
		}

		return view("content.testimonial-edit",$b)->with('parser', $this->parser);
	}

	public function editProcess($id){
		$rules = array(
            'name'    => 'required', 
            'position' => 'required',
            'testimonial' => 'required|min:10',	
        );

       	$validator = \Validator::make(\Input::all(), $rules);
 
        if($validator->fails()){
            return \Redirect::to($_ENV['ADMIN_FOLDER'].'/testimonial/edit/'.$id)->withErrors($validator);
        }
        else{
        	  $update = Testi::find($id);
        	  $update->customer_name = \Input::get('name');
        	  $update->customer_status = \Input::get('position');
        	  $update->testimoni = \Input::get('testimonial');
        	  $update->active = (\Input::has('active'))? 1:0;

        	  $update->save();

        }

        return \Redirect::to($_ENV['ADMIN_FOLDER'].'/testimonial')->with(["success"=>"Data edited."]);
	}

}
