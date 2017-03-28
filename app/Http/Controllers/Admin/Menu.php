<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Menu as MN;

use Illuminate\Http\Request;

class Menu extends Controller {
	private $parser = array();

	public function index()
	{
		$data['data'] = MN::paginate(7);
		return view("content.menu",$data)->with('parser', $this->parser);
	}

	public function add(){
		return view("content.menu-add")->with('parser', $this->parser);
	}

	public function addProcess(){
		$rules = array(
            'name'    => 'required', 
            'link' => 'required',
            'order' => 'required|numeric|min:1',		
        );

        $validator = \Validator::make(\Input::all(), $rules);

        if($validator->fails()){
            return \Redirect::to($_ENV['ADMIN_FOLDER'].'/menu/add')->withErrors($validator);
        }
        else{
        	  $insert = new MN;
        	  $insert->name = \Input::get('name');
        	  $insert->link = \Input::get('link');
        	  $insert->order_show = \Input::get('order');
        	  $insert->save();
        }

		return \Redirect::to($_ENV['ADMIN_FOLDER'].'/menu')->with(["success"=>"New data added.."]);
	}

	public function delete($id){
		$delete = MN::find($id);
		$delete->delete();

		return \Redirect::to($_ENV['ADMIN_FOLDER'].'/menu')->with(["success"=>"Data deleted.."]);
	}



	public function edit($id){
		$data = MN::where("id",$id)->get()->toArray();
		$b= array();
		foreach($data[0] as $a => $c){
			 $b[$a] = $c;
		}

		return view("content.menu-edit",$b)->with('parser', $this->parser);
	}

	public function editProcess($id){
		$rules = array(
            'name'    => 'required', 
            'link' => 'required',
            'order' => 'required|numeric|min:1',    
        );

       	$validator = \Validator::make(\Input::all(), $rules);
 
        if($validator->fails()){
            return \Redirect::to($_ENV['ADMIN_FOLDER'].'/team/edit/'.$id)->withErrors($validator);
        }
        else{
              $update = MN::find($id);
              $update->name = \Input::get('name');
              $update->link = \Input::get('link');
              $update->order_show = \Input::get('order');

        	    $update->save();
        }

        return \Redirect::to($_ENV['ADMIN_FOLDER'].'/menu')->with(["success"=>"Data edited."]);
	}

}
