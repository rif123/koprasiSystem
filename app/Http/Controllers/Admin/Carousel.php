<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Carousel as CR;

use Illuminate\Http\Request;

class Carousel extends Controller {
	private $parser = array();
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(){
		$data['data'] = CR::select('id','title')->paginate(7);
        return view("content.carousel",$data)->with('parser', $this->parser);
	}

    public function add(){
        return view("content.carousel-add")->with('parser', $this->parser);
    }

    public function addProcess(){
        $rules = array(
            'title'    => 'required', 
            'toptext' => 'required',
            'middletext' => 'required',
            'buttontext' => 'required',
            'img' => 'image|mimes:jpg,png,jpeg|max:1024|min:1',
        );

        $validator = \Validator::make(\Input::all(), $rules);

        if($validator->fails()){
            return \Redirect::to($_ENV['ADMIN_FOLDER'].'/carousel/add')->withErrors($validator);
        }
        else{

              $insert = new CR;
              $insert->title = \Input::get('title');
              $insert->text_top = \Input::get('toptext');
              $insert->text_middle = \Input::get('middletext');
              $insert->button_text = \Input::get('buttontext');
              $insert->button_link = \Input::get('buttonlink');

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

        return \Redirect::to($_ENV['ADMIN_FOLDER'].'/carousel')->with(["success"=>"New data added.."]);
    }

    public function edit($id){
        $data = CR::where("id",$id)->get()->toArray();
        $b= array();
        foreach($data[0] as $a => $c){
             $b[$a] = $c;
        }

        return view("content.carousel-edit",$b)->with('parser', $this->parser);
    }

    public function editProcess($id){
        $rules = array(
            'title'    => 'required', 
            'toptext' => 'required',
            'middletext' => 'required',
            'buttontext' => 'required',
            'img' => 'image|mimes:jpg,png,jpeg|max:1024|min:1',
        );

        $validator = \Validator::make(\Input::all(), $rules);

        if($validator->fails()){
            return \Redirect::to($_ENV['ADMIN_FOLDER'].'/carousel/edit/'.$id)->withErrors($validator);
        }
        else{

              $insert = CR::find($id);
              $insert->title = \Input::get('title');
              $insert->text_top = \Input::get('toptext');
              $insert->text_middle = \Input::get('middletext');
              $insert->button_text = \Input::get('buttontext');
              $insert->button_link = \Input::get('buttonlink');

              if(\Input::hasFile('img')){
                $image = \Input::file('img');
                $imageName = $id.'.'.$image->getClientOriginalExtension();
                $path = public_path().'/images/image-gallery/';
                $image->move($path,$imageName);
                //$img = \Image::make($image->getRealPath());
                //$height = 600 * $img->height()/$img->width();
                //$img->resize(600, $height);
                //$img->save($path);
                //$insert->image = $imageName;
              }
              else if(\Input::has('image')){
                $insert->image = \Input::get('image');
              }

              $insert->save();
        }

        return \Redirect::to($_ENV['ADMIN_FOLDER'].'/carousel')->with(["success"=>"New data added.."]);
    }

    public function delete($id){
        $delete = CR::find($id);
        $delete->delete();

        return \Redirect::to($_ENV['ADMIN_FOLDER'].'/carousel')->with(["success"=>"Data deleted.."]);

    }

}
