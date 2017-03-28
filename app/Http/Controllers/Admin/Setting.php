<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Setting as ST;
use App\Models\User as US;

use Illuminate\Http\Request;

class Setting extends Controller {
	private $parser = array();


	public function index(){
        $data = ST::select('setting_name','value')->whereIn('setting_name',Array("site_title","site_description","meta_description","meta_keyword","site_logo"))->get()->toArray();
        $b= array();
        
        foreach($data as $a => $c){
             $b[$c['setting_name']] = $c['value'];
        }
		return view("content.setting",$b)->with('parser', $this->parser);
	}

    public function location(){
        $data = ST::select('setting_name','value')->whereIn('setting_name',Array("latitude","longitude","marker_text"))->get()->toArray();
        $b= array();
        
        foreach($data as $a => $c){
             $b[$c['setting_name']] = $c['value'];
        }
        return view("content.setting-location",$b)->with('parser', $this->parser);
    }

    public function locationProcess(){
        $rules = array(
            'marker_text'    => 'required',
            'lat'    => 'required',
            'long'    => 'required',
        );

        $validator = \Validator::make(\Input::all(), $rules);

        if($validator->fails()){
            return \Redirect::to($_ENV['ADMIN_FOLDER'].'/setting/location')->withErrors($validator);
        }
        else{
            $title = \Input::get('marker_text');
            $latitude = \Input::get('lat');
            $longitude = \Input::get('long');
            $affected = \DB::update("update settings set `value` = CASE setting_name WHEN 'latitude' THEN ? WHEN 'longitude' THEN ?  WHEN 'marker_text' THEN ? END  where setting_name IN('latitude','longitude','marker_text')", [$latitude,$longitude,$title]);

            return \Redirect::to($_ENV['ADMIN_FOLDER'].'/setting/location')->with(["success"=>"Data saved"]);


        }

    }

    public function footer(){
        $data = ST::select('setting_name','value')->whereIn('setting_name',Array("footer_text"))->get()->toArray();
        $b= array();
        
        foreach($data as $a => $c){
             $b[$c['setting_name']] = $c['value'];
        }
        return view("content.setting-footer",$b)->with('parser', $this->parser);
    }

    public function social(){
        $data = ST::select('setting_name','value')->whereIn('setting_name',Array("social_link"))->get()->toArray();
        $link['data'] = unserialize($data[0]['value']);

        return view("content.setting-social",$link)->with('parser', $this->parser);
    }

    public function socialProcess(){
        $input = \Input::all();
        $data = Array();

        foreach($input['name'] as $a => $b){
            if(($input['icon'][$a] != "") && ($input['link'][$a] != "")){
                $data[$a]['name'] = strip_tags($b);
                $data[$a]['fa-icon'] = strip_tags($input['icon'][$a]);
                $data[$a]['link'] = strip_tags($input['link'][$a]);
            }
        }

        $data = serialize($data);

        $update = ST::where('setting_name','social_link');
        $update->update(['value' => $data]);


        return \Redirect::to($_ENV['ADMIN_FOLDER'].'/setting/footer/social')->with(["success"=>"Data saved"]);



    }

    public function footerProcess(){
        $rules = array(
            'footertext'    => 'required'    
        );

        $validator = \Validator::make(\Input::all(), $rules);

        if($validator->fails()){
            return \Redirect::to($_ENV['ADMIN_FOLDER'].'/setting/footer')->withErrors($validator);
        }
        else{
            $title = \Input::get('footertext');
            $update = ST::where('setting_name','footer_text');
            $update->update(['value' => $title]);


            return \Redirect::to($_ENV['ADMIN_FOLDER'].'/setting/footer')->with(["success"=>"Data saved"]);
        }
    }

    public function generalProcess(){
        $rules = array(
            'title'    => 'required', 
            'description' => 'required',    
            'metadescription' => 'required', 
            'metakeyword' => 'required', 
            'img' => 'image|mimes:jpg,png,jpeg|max:1024|min:1',        
        );

        $validator = \Validator::make(\Input::all(), $rules);

        if($validator->fails()){
            return \Redirect::to($_ENV['ADMIN_FOLDER'].'/setting')->withErrors($validator);
        }
        else{
            $title = (strlen(\Input::get('title')) < 1)?"Default":\Input::get('title');
            $description = (strlen(\Input::get('description')) < 1)?"Default":\Input::get('description');
            $metadescription = (strlen(\Input::get('metadescription')) < 1)?"Default":\Input::get('metadescription');
            $metakeyword = (strlen(\Input::get('metakeyword')) < 1)?"Default":\Input::get('metakeyword');
            $imageName = '/default/logo.png';
              
            if(\Input::hasFile('img')){
                $imageName = \Input::file('img')->getClientOriginalName();
                \Input::file("img")->move(public_path().'/images/image-gallery/', $imageName);
              }
              else if(\Input::has('image')){
                $imageName = \Input::get('image');
              }

            $affected = \DB::update("update settings set `value` = CASE setting_name WHEN 'site_title' THEN ? WHEN 'site_description' THEN ?  WHEN 'meta_description' THEN ?  WHEN 'meta_keyword' THEN ?  WHEN 'site_logo' THEN ? END where setting_name IN('site_title','site_description','meta_description','meta_keyword','site_logo')", [$title,$description,$metadescription,$metakeyword,$imageName]);
            
            return \Redirect::to($_ENV['ADMIN_FOLDER'].'/setting')->with(["success"=>"Data saved"]);
        }

    }

	public function profile(){
		$id = \Auth::user()->id;
        
		$data = US::where('id',$id)->get()->toArray();
		$b= array();
		foreach($data[0] as $a => $c){
			$b[$a] = $c;
		}
		return view("content.setting-profile",$b)->with('parser', $this->parser);
	}

	public function profileProcess(){
		$id = \Auth::user()->id;
		$rules = array(
            'uname'    => 'required|min:4', 
            'email' => 'required|email',	
        );

        $validator = \Validator::make(\Input::all(), $rules);

        if($validator->fails()){
            return \Redirect::to($_ENV['ADMIN_FOLDER'].'/setting/profile')->withErrors($validator);
        }
        else{
        	$update = US::find($id);
        	$update->uname = \Input::get('uname');
        	$update->email = \Input::get('email');
        	  
        	if(\Input::has("newpass")){
        		$oldpassword = \Input::get('oldpass');
        		$newpassword = \Input::get("newpass");

        		if(\Hash::check($oldpassword, \Auth::user()->password)){
        			$update->password = \Hash::make($newpassword);
        		}
        		else{
        			return \Redirect::to($_ENV['ADMIN_FOLDER'].'/setting/profile')->withErrors(["Wrong old password"]);
        		}
        	}

        	$update->save();
			return \Redirect::to($_ENV['ADMIN_FOLDER'].'/setting/profile')->with(["success"=>"Data saved"]);

        }
	}
}
