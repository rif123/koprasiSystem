<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;

class MediaManager extends Controller {
	private $parser = array();


  private function is_image($filename){
    $dir = public_path().'/images/image-gallery/';
    $mimetype = ['image/jpeg','image/gif','image/png','image/bmp','image/svg+xml','image/jpg'];
    if(\Storage::disk('public')->exists($filename)){
      $contentType = mime_content_type($dir.$filename);
      if(in_array($contentType, $mimetype) ){
        return true;
      }
    }


    return false;
  }

  public function deletegroup(){
    $data = \Input::all()['chk'];
    $msg = array();
    $err = array();
    foreach($data as $id){
      if((\Storage::disk('public')->exists($id)) && ($this->is_image($id))){
        \Storage::disk('public')->delete($id);
        $msg[] = "Filename: ".$id." deleted";
      }
      else{
        $err[] = "Filename: ".$id." failed to delete";
      }
    }
    return \Redirect::to($_ENV['ADMIN_FOLDER'].'/mediamanager')->with(["success"=>implode("   ",$msg),"error"=>implode("   ",$err)]);
  }

  private function image_list(){
    $all_image = \Storage::disk('public')->files('/');
    $newdata = array();
    if(!empty($all_image)){
      foreach($all_image as $a){
        if(\Storage::disk('public')->exists($a)){
          if($this->is_image($a)){
              $newdata[]['id'] = $a;
          }
        }
      }
    }

    return $newdata;
  }

	public function index()
	{
    $all_image = $this->image_list();
		return view("content.manager.admin-show",['data'=>$all_image])->with('parser', $this->parser);
	}

  public function show()
  {
    $all_image = $this->image_list();
    return view("content.manager.admin-show-ajax",['data'=>$all_image])->with('parser', $this->parser);
  }


  public function delete($id){
    $id = urldecode($id);
    if((\Storage::disk('public')->exists($id)) && ($this->is_image($id))){
        \Storage::disk('public')->delete($id);
        return \Redirect::to($_ENV['ADMIN_FOLDER'].'/mediamanager')->with(["success"=>"Data deleted.."]);
    }

    return \Redirect::to($_ENV['ADMIN_FOLDER'].'/mediamanager')->with(["error"=>"Error Happen.."]);


  }


}
