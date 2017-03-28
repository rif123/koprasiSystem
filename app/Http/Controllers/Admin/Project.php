<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Project_category as PJC;
use App\Models\Project as PJ;
use App\Models\Setting as ST;

use Illuminate\Http\Request;

class Project extends Controller {
	private $parser = array();

	public function index()
	{
		$data['data'] = PJ::with('project_category')->paginate(7);

		return view("content.project",$data)->with('parser', $this->parser);
	}

    public function add(){
        $data['category'] = PJC::all();
        return view("content.project-add",$data)->with('parser', $this->parser);
    }

    public function addProcess(){
        $rules = array(
            'name'    => 'required',
            'client' => 'required',
            'category' => 'required|numeric',
            'description' => 'required|min:10',
            'featuredimg' => 'image|mimes:jpg,png,jpeg|max:1024|min:1',
        );

        if(\Input::hasFile("imggallery")){
            $imgcount =  count(\Input::file("imggallery"));     
        }
        else{
            $imgcount = 0;
        }

        for($i=0;$i<$imgcount;$i++){
            $rules['imggallery.'.$i] = 'image|mimes:jpg,png,jpeg|max:1024|min:1';
        }

         $validator = \Validator::make(\Input::all(), $rules);

        if($validator->fails()){
            return \Redirect::to($_ENV['ADMIN_FOLDER'].'/project/add')->withErrors($validator);
        }
        else{
             $insert = new PJ;
             $insert->name = \Input::get('name');
             $insert->description = \Input::get('description');
             $insert->client = \Input::get('client');
             $insert->category_id = \Input::get('category');
             $imggallery = Array();
             if($imgcount > 0){
                 for($i=0;$i<$imgcount;$i++){
                    $imgname = \Input::file('imggallery')[$i]->getClientOriginalName();
                    \Input::file('imggallery')[$i]->move(public_path().'/images/image-gallery/', $imgname);
                    $imggallery[] = $imgname;
                 }
             }

             if(\Input::has('imagegallery')){
                $inp = explode(";",\Input::get('imagegallery'));
                foreach ($inp as $a) {
                    $imggallery[] = $a;
                }
             }

             if(\Input::hasFile('featuredimg')){
                $imageName = \Input::file('featuredimg')->getClientOriginalName();
                \Input::file("featuredimg")->move(public_path().'/images/image-gallery/', $imageName);
                $insert->featured_image = $imageName;
              }
              else if(\Input::has('featuredimage')){
                $insert->featured_image = \Input::get('featuredimage');
              }

              $insert->photo = serialize($imggallery);

            $insert->save();
        }
        return \Redirect::to($_ENV['ADMIN_FOLDER'].'/project')->with(["success"=>"New data added.."]);
    }

    public function edit($id){
        $data= PJ::where("id",$id)->get()->toArray();
        
        $b= array();
        $b['category'] = PJC::all();
        foreach($data[0] as $a => $c){
             if($a == "photo"){
                $b['img'] = implode(";",unserialize($c));
             }
             $b[$a] = $c;
        }

        return view("content.project-edit",$b)->with('parser', $this->parser);
    }

    public function editProcess($id){
        $rules = array(
            'name'    => 'required',
            'client' => 'required',
            'category' => 'required|numeric',
            'description' => 'required|min:10',
            'featuredimg' => 'image|mimes:jpg,png,jpeg|max:1024|min:1',
        );

        if(\Input::hasFile("imggallery")){
            $imgcount =  count(\Input::file("imggallery"));     
        }
        else{
            $imgcount = 0;
        }

        for($i=0;$i<$imgcount;$i++){
            $rules['imggallery.'.$i] = 'image|mimes:jpg,png,jpeg|max:1024|min:1';
        }

         $validator = \Validator::make(\Input::all(), $rules);

        if($validator->fails()){
            return \Redirect::to($_ENV['ADMIN_FOLDER'].'/project/add')->withErrors($validator);
        }
        else{
             $insert = PJ::find($id);
             $insert->name = \Input::get('name');
             $insert->description = \Input::get('description');
             $insert->client = \Input::get('client');
             $insert->category_id = \Input::get('category');
             $imggallery = Array();
             if($imgcount > 0){
                 for($i=0;$i<$imgcount;$i++){
                    $imgname = \Input::file('imggallery')[$i]->getClientOriginalName();
                    \Input::file('imggallery')[$i]->move(public_path().'/images/image-gallery/', $imgname);
                    $imggallery[] = $imgname;
                 }
             }

             if(\Input::has('imagegallery')){
                $inp = explode(";",\Input::get('imagegallery'));
                foreach ($inp as $a) {
                    $imggallery[] = $a;
                }
             }

             if(\Input::hasFile('featuredimg')){
                $imageName = \Input::file('featuredimg')->getClientOriginalName();
                \Input::file("featuredimg")->move(public_path().'/images/image-gallery/', $imageName);
                $insert->featured_image = $imageName;
              }
              else if(\Input::has('featuredimage')){
                $insert->featured_image = \Input::get('featuredimage');
              }

              $insert->photo = serialize($imggallery);

            $insert->save();
        }
        return \Redirect::to($_ENV['ADMIN_FOLDER'].'/project')->with(["success"=>"New data added.."]);

    }

  public function category(){
    $data['data'] = PJC::paginate(7);
    return view("content.project-category",$data)->with('parser', $this->parser);
  }

  public function categoryAdd(){
    return view("content.project-category-add")->with('parser', $this->parser);
  }


  public function categoryAddProcess(){
    $rules = array(
            'name'    => 'required|min:5'
        );

        $validator = \Validator::make(\Input::all(), $rules);

        if($validator->fails()){
            return \Redirect::to($_ENV['ADMIN_FOLDER'].'/project/category')->withErrors($validator);
        }
        else{
            $insert = new PJC;
            $insert->name = \Input::get('name');

            $insert->save();
        }

    return \Redirect::to($_ENV['ADMIN_FOLDER'].'/project/category')->with(["success"=>"New data added.."]);
  }

	public function editCategory($id){
		$data= PJC::where("category_id",$id)->get()->toArray();
		$b= array();
		foreach($data[0] as $a => $c){
			 $b[$a] = $c;
		}

		return view("content.project-category-edit",$b)->with('parser', $this->parser);
	}

	public function editCategoryProcess($id){
    $rules = array(
            'name'    => 'required|min:5'
        );

        $validator = \Validator::make(\Input::all(), $rules);

        if($validator->fails()){
            return \Redirect::to($_ENV['ADMIN_FOLDER'].'/project/category')->withErrors($validator);
        }
        else{
            $update = PJC::find($id);
            $update->name = \Input::get('name');

            $update->save();
        }

    return \Redirect::to($_ENV['ADMIN_FOLDER'].'/project/category')->with(["success"=>"New data added.."]);

		}

  public function setting(){
    $data = ST::select('setting_name','value')->whereIn('setting_name',Array("project_title","project_category_title","project_button_text","project_button_link","project_button_text_full","project_button_link_full"))->get()->toArray();
        $b= array();
        
        foreach($data as $a => $c){
             $b[$c['setting_name']] = $c['value'];
        }
    return view("content.project-setting",$b)->with('parser', $this->parser);
  }

  public function settingProcess(){
    $rules = array(
            'pr_title'    => 'required',  
            'pr_cate_title'    => 'required',   
            'pr_button_text'    => 'required',     
            'pr_button_link'    => 'required',     
            'pr_button_text_full'    => 'required',     
            'pr_button_link_full'    => 'required',     
        );

        $validator = \Validator::make(\Input::all(), $rules);

        if($validator->fails()){
            return \Redirect::to($_ENV['ADMIN_FOLDER'].'/project/setting')->withErrors($validator);
        }
        else{
            $title = \Input::get('pr_title');
            $cate_title = \Input::get('pr_cate_title');
            $button_text = \Input::get('pr_button_text');
            $button_link = \Input::get('pr_button_link');
            $button_text_full = \Input::get('pr_button_text_full');
            $button_link_full = \Input::get('pr_button_link_full');

            $affected = \DB::update("update settings set `value` = CASE setting_name WHEN 'project_title' THEN ? WHEN 'project_category_title' THEN ? WHEN 'project_button_text' THEN ? WHEN 'project_button_link' THEN ? WHEN 'project_button_text_full' THEN ? WHEN 'project_button_link_full' THEN ?  END WHERE setting_name IN('project_title','project_category_title','project_button_text','project_button_link','project_button_text_full','project_button_link_full')", [$title,$cate_title,$button_text,$button_link,$button_text_full,$button_link_full]);
            
            return \Redirect::to($_ENV['ADMIN_FOLDER'].'/project/setting')->with(["success"=>"Data saved"]);
        }
  }

  public function deleteProject($id){
    $delete = PJ::find($id);
    $delete->delete();
    return \Redirect::to($_ENV['ADMIN_FOLDER'].'/project')->with(["success"=>"Data deleted.."]);
  }

}