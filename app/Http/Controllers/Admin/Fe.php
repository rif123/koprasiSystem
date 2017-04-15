<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Widget as WG;

use Illuminate\Http\Request;

class Fe extends Controller {
	private $parser = array();
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(){
		$data['data'] =WG::all();
    return view("content.fe",$data)->with('parser', $this->parser);
	}

    public function edit(){
        $id = \Input::get('id');
        foreach($id as $a){
          $rules[$a] = "min:0|max:2";
          $validator = \Validator::make(\Input::get('active'), $rules);

          if($validator->fails()){
              return \Redirect::to($_ENV['ADMIN_FOLDER'].'/fe')->withErrors($validator);
          }

          if((\Input::get('active.'.$a) == 'on') ||  (\Input::get('active.'.$a) == '1')){
            $active = 1;
          }
          else{
            $active = 0;
          }
          $rls[$a] = "required|min:1";
          $validator = \Validator::make(\Input::get('sort'), $rls);

          if($validator->fails()){
              return \Redirect::to($_ENV['ADMIN_FOLDER'].'/fe')->withErrors($validator);
          }
          else{

                $insert = WG::find($a);
                $insert->active = $active;
                $insert->order_show = \Input::get('sort.'.$a);

                $insert->save();

                unset($insert);
          }
        }
        return \Redirect::to($_ENV['ADMIN_FOLDER'].'/fe')->with(["success"=>"Saved"]);
    }

}
