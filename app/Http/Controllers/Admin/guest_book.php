<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\guest_book as GuestModel;
use Illuminate\Http\Request;

class guest_book extends Controller {
	private $parser = array();
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
		$data['data'] = GuestModel::all();
		return view("content.guest_book",$data)->with('parser', $this->parser);
	}

	public function delete($id){
		$delete = GuestModel::find($id);
		$delete->delete();

		return \Redirect::to('/'.$_ENV['ADMIN_FOLDER'].'/guest_book')->with(["success"=>"Data deleted.."]);
	}
	public function read($id){
		$data['data'] = GuestModel::find($id);
		if($data['data']->has_read == '0'){
			$data['data']->has_read = 1;
			$data['data']->save();
		}
		return view("content.guest_book_read",$data)->with('parser', $this->parser);	

	}
	// /**
	//  * Show the form for creating a new resource.
	//  *
	//  * @return Response
	//  */
	// public function create()
	// {
	// 	//
	// }

	// /**
	//  * Store a newly created resource in storage.
	//  *
	//  * @return Response
	//  */
	// public function store()
	// {
	// 	//
	// }

	// /**
	//  * Display the specified resource.
	//  *
	//  * @param  int  $id
	//  * @return Response
	//  */
	// public function show($id)
	// {
	// 	//
	// }

	// *
	//  * Show the form for editing the specified resource.
	//  *
	//  * @param  int  $id
	//  * @return Response
	 
	 /*public function edit()
	 {
		$rules = array(
            'location'    => 'required', 
            'phone' => 'required',
            'fax' => 'required',
            'email' => 'required | email',
            'web' => 'required',		
        );

        $validator = \Validator::make(\Input::all(), $rules);

        if($validator->fails()){
            return \Redirect::to($_ENV['ADMIN_FOLDER'].'/contact')->withErrors($validator);
        }
        else{
            
        	  $update =ContactModel::find(1);
        	  $update->location = \Input::get('location');
        	  $update->phone = \Input::get('phone');
        	  $update->fax = \Input::get('fax');
        	  $update->email = \Input::get('email');
        	  $update->web = \Input::get('web');
              

        	  $update->save();
        }

		return \Redirect::to($_ENV['ADMIN_FOLDER'].'/contact')->with(["success"=>"data edited."]);
	}
	 */

	// /**
	//  * Update the specified resource in storage.
	//  *
	//  * @param  int  $id
	//  * @return Response
	//  */
	// public function update($id)
	// {
	// 	//
	// }

	// /**
	//  * Remove the specified resource from storage.
	//  *
	//  * @param  int  $id
	//  * @return Response
	//  */
	// public function destroy($id)
	// {
	// 	//
	// }

}
