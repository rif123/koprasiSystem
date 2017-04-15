<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\User_level as UL;
use App\Models\User as US;
use App\Models\Mgroup as MG;

use App\Models\Rules as RL;

use Illuminate\Http\Request;

class User extends Controller
{
    private $parser = array();


    public function indexLevel()
    {
        $data['data'] = UL::paginate(7);
        return view("content.user_level", $data)->with('parser', $this->parser);
    }

    public function index()
    {
        // $data['data'] = US::with('user_level')->paginate(7);
        $data['data'] = US::mGroup();
        return view("content.user", $data)->with('parser', $this->parser);
    }

    public function add()
    {
        // $data['data'] = UL::all();
        $data['data'] = MG::all();
        return view("content.user-add", $data)->with('parser', $this->parser);
    }

    public function addProcess()
    {
        $rules = array(
            'uname'    => 'required|alpha|min:4',
            'password'    => 'required|min:4',
            'ugroup'    => 'required',
            'email'    => 'required|email',
        );

        $validator = \Validator::make(\Input::all(), $rules);

        if ($validator->fails()) {
            return \Redirect::to($_ENV['ADMIN_FOLDER'].'/user/add')->withErrors($validator);
        } else {
            // try {
                $insert = new US;
                $insert->uname = \Input::get('uname');
                $insert->password = \Hash::make(\Input::get('password'));
                $insert->email = \Input::get('email');
                $insert->id_level = 1;
                $insert->user_grp = \Input::get('ugroup');
                $insert->save();
            // } catch (\Exception $e) {
            //     return \Redirect::to($_ENV['ADMIN_FOLDER'].'/user/add')->withErrors(array('message' => 'Username/email already exist.'));
            // }
        }
        return \Redirect::to($_ENV['ADMIN_FOLDER'].'/user')->with(["success"=>"New data added.."]);
    }

    public function edit($id)
    {
        // $data = US::where("id", $id)->with('user_level')->get()->toArray();
        // $b= array();
		//
        // foreach ($data[0] as $a => $c) {
        //     $b[$a] = $c;
        // }
		// print_R($b);die;
        // if ((($b['id_level'] == '1') && (\Auth::User()->id_level != '1')) || ($b['id'] == '1')) {
        //     return \Redirect::to($_ENV['ADMIN_FOLDER'].'/error');
        // }

        // $b['data'] =  UL::all();
        $bUserGroup =  US::find(['user_grp' => $id])->toArray();

		$b['uname'] = $bUserGroup[0]['uname'];
		$b['user_grp'] = $bUserGroup[0]['user_grp'];
		$b['email'] = $bUserGroup[0]['email'];
		$b['data'] = MG::all();
        return view("content.user-edit", $b)->with('parser', $this->parser);
    }

    public function editProcess($id)
    {
        $rules = array(
            'uname'    => 'required|alpha|min:4',
            'password'    => 'min:4',
            'ugroup'    => 'required|min:1',
            'email'    => 'required|email',
        );

        $validator = \Validator::make(\Input::all(), $rules);

        if ($validator->fails()) {
            return \Redirect::to($_ENV['ADMIN_FOLDER'].'/user/edit/'.$id)->withErrors($validator);
        } else {
            try {
                $insert = US::find($id);
                if ((($insert->id_level == '1') && (\Auth::User()->id_level != '1')) || ($id == '1')) {
                    return \Redirect::to($_ENV['ADMIN_FOLDER'].'/error');
                }
                $insert->uname = \Input::get('uname');
                if (\Input::has('password')) {
                    $insert->password = \Hash::make(\Input::get('password'));
                }
                $insert->email = \Input::get('email');
                $insert->id_level = \Input::get('ugroup');
                $insert->user_grp = \Input::get('ugroup');

                $insert->save();
            } catch (\Exception $e) {
                return \Redirect::to($_ENV['ADMIN_FOLDER'].'/user/edit/'.$id)->withErrors(array('message' => 'Username/email already exist.'));
            }
        }
        return \Redirect::to($_ENV['ADMIN_FOLDER'].'/user')->with(["success"=>"New data added.."]);
    }

    public function delete($id)
    {
        $delete = US::find($id);

        if ((($delete->id_level == '1') && (\Auth::User()->id_level != '1')) || ($delete->id == '1')) {
            return \Redirect::to($_ENV['ADMIN_FOLDER'].'/error');
        }
        $delete->delete();

        return \Redirect::to($_ENV['ADMIN_FOLDER'].'/user')->with(["success"=>"Data deleted.."]);
    }


    public function addLevel()
    {
        $data['data'] = RL::all();
        return view("content.user_level-add", $data)->with('parser', $this->parser);
    }

    public function addProcessLevel()
    {
        $rules = array(
            'name'    => 'required',
            'rules' => 'required|array'
        );

        $validator = \Validator::make(\Input::all(), $rules);

        if ($validator->fails()) {
            return \Redirect::to($_ENV['ADMIN_FOLDER'].'/user_level/add')->withErrors($validator);
        } else {
            $rules = \Input::get('rules');
            if ((in_array("admin/guest_book_read", $rules)) || (in_array("admin/guest_book/delete", $rules))) {
                $rules[] = "admin/guest_book";
            }

            if ((in_array("admin/mediamanager/delete", $rules))) {
                $rules[] = "admin/mediamanager";
            }

            if ((in_array("admin/user/add", $rules)) || (in_array("admin/user/add", $rules) || (in_array("admin/user/edit", $rules)))) {
                $rules[] = "admin/user";
            }

            if ((in_array("admin/user_level/add", $rules)) || (in_array("admin/user_level/delete", $rules) || (in_array("admin/user_level/edit", $rules)))) {
                $rules[] = "admin/user_level";
            }

            if ((in_array("admin/menu/add", $rules)) || (in_array("admin/menu/delete", $rules) || (in_array("admin/menu/edit", $rules)))) {
                $rules[] = "admin/menu";
            }

            if ((in_array("admin/carousel/add", $rules)) || (in_array("admin/carousel/delete", $rules) || (in_array("admin/carousel/edit", $rules)))) {
                $rules[] = "admin/carousel";
            }

            if ((in_array("admin/post/setting", $rules)) ||  (in_array("admin/post/add", $rules)) || (in_array("admin/post/delete", $rules) || (in_array("admin/post/edit", $rules)))) {
                $rules[] = "admin/post";
            }

            if ((in_array("admin/process_text/setting", $rules)) || (in_array("admin/process_text/add", $rules)) || (in_array("admin/process_text/delete", $rules) || (in_array("admin/process_text/edit", $rules)))) {
                $rules[] = "admin/process_text";
            }

            if ((in_array("admin/project/setting", $rules)) || (in_array("admin/project/add", $rules)) || (in_array("admin/project/delete", $rules) || (in_array("admin/project/edit", $rules)))) {
                $rules[] = "admin/project";
            }

            if ((in_array("admin/project/category/add", $rules)) || (in_array("admin/project/category/delete", $rules) || (in_array("admin/project/category/edit", $rules)))) {
                $rules[] = "admin/project/category";
            }

            if ((in_array("admin/skill/setting", $rules)) || (in_array("admin/skill/add", $rules)) || (in_array("admin/skill/delete", $rules) || (in_array("admin/skill/edit", $rules)))) {
                $rules[] = "admin/skill";
            }

            if ((in_array("admin/team/setting", $rules)) ||(in_array("admin/team/add", $rules)) || (in_array("admin/team/delete", $rules) || (in_array("admin/team/edit", $rules)))) {
                $rules[] = "admin/team";
            }

            if ((in_array("admin/testimonial/add", $rules)) || (in_array("admin/testimonial/delete", $rules) || (in_array("admin/testimonial/edit", $rules)) || (in_array("admin/testimonial/setting", $rules)))) {
                $rules[] = "admin/testimonial";
            }


            try {
                $insert = new UL;
                $insert->level_name = \Input::get('name');
                $insert->rules = serialize($rules);
                $insert->save();
            } catch (\Exception $e) {
                return \Redirect::to($_ENV['ADMIN_FOLDER'].'/user_level/add')->withErrors(array('message' => \Input::get('name').' already exist.'));
            }
        }
        return \Redirect::to($_ENV['ADMIN_FOLDER'].'/user_level')->with(["success"=>"New data added.."]);
    }

    public function editLevel($id)
    {
        $data = UL::where("id_level", $id)->get()->toArray();
        $b= array();
        foreach ($data[0] as $a => $c) {
            if ($a == 'rules') {
                try {
                    if ($c != "") {
                        $b[$a] = unserialize($c);
                    } else {
                        $b[$a] = array();
                    }
                } catch (Exception $e) {
                    $b[$a] = array();
                }
            } else {
                $b[$a] = $c;
            }
        }
        $b['data'] = RL::all();

        return view("content.user_level-edit", $b)->with('parser', $this->parser);
    }

    public function editProcessLevel($id)
    {
        $rules = array(
            'name'    => 'required',
            'rules' => 'required|array'
        );

        $validator = \Validator::make(\Input::all(), $rules);

        if ($validator->fails()) {
            return \Redirect::to($_ENV['ADMIN_FOLDER'].'/user_level/edit/'.$id)->withErrors($validator);
        } else {
            $rules = \Input::get('rules');
            if ((in_array("admin/guest_book_read", $rules)) || (in_array("admin/guest_book/delete", $rules))) {
                $rules[] = "admin/guest_book";
            }

            if ((in_array("admin/mediamanager/delete", $rules))) {
                $rules[] = "admin/mediamanager";
            }

            if ((in_array("admin/user/add", $rules)) || (in_array("admin/user/add", $rules) || (in_array("admin/user/edit", $rules)))) {
                $rules[] = "admin/user";
            }

            if ((in_array("admin/user_level/add", $rules)) || (in_array("admin/user_level/delete", $rules) || (in_array("admin/user_level/edit", $rules)))) {
                $rules[] = "admin/user_level";
            }

            if ((in_array("admin/menu/add", $rules)) || (in_array("admin/menu/delete", $rules) || (in_array("admin/menu/edit", $rules)))) {
                $rules[] = "admin/menu";
            }

            if ((in_array("admin/carousel/add", $rules)) || (in_array("admin/carousel/delete", $rules) || (in_array("admin/carousel/edit", $rules)))) {
                $rules[] = "admin/carousel";
            }

            if ((in_array("admin/post/setting", $rules)) ||  (in_array("admin/post/add", $rules)) || (in_array("admin/post/delete", $rules) || (in_array("admin/post/edit", $rules)))) {
                $rules[] = "admin/post";
            }

            if ((in_array("admin/process_text/setting", $rules)) || (in_array("admin/process_text/add", $rules)) || (in_array("admin/process_text/delete", $rules) || (in_array("admin/process_text/edit", $rules)))) {
                $rules[] = "admin/process_text";
            }

            if ((in_array("admin/project/setting", $rules)) || (in_array("admin/project/add", $rules)) || (in_array("admin/project/delete", $rules) || (in_array("admin/project/edit", $rules)))) {
                $rules[] = "admin/project";
            }

            if ((in_array("admin/project/category/add", $rules)) || (in_array("admin/project/category/delete", $rules) || (in_array("admin/project/category/edit", $rules)))) {
                $rules[] = "admin/project/category";
            }

            if ((in_array("admin/skill/setting", $rules)) || (in_array("admin/skill/add", $rules)) || (in_array("admin/skill/delete", $rules) || (in_array("admin/skill/edit", $rules)))) {
                $rules[] = "admin/skill";
            }

            if ((in_array("admin/team/setting", $rules)) ||(in_array("admin/team/add", $rules)) || (in_array("admin/team/delete", $rules) || (in_array("admin/team/edit", $rules)))) {
                $rules[] = "admin/team";
            }

            if ((in_array("admin/testimonial/add", $rules)) || (in_array("admin/testimonial/delete", $rules) || (in_array("admin/testimonial/edit", $rules)) || (in_array("admin/testimonial/setting", $rules)))) {
                $rules[] = "admin/testimonial";
            }
            try {
                $update = UL::find($id);
                $update->level_name = \Input::get('name');
                $update->rules = serialize($rules);
                $update->save();
            } catch (\Exception $e) {
                return \Redirect::to($_ENV['ADMIN_FOLDER'].'/user_level/add')->withErrors(array('message' => \Input::get('name').' already exist.'));
            }
        }

        return \Redirect::to($_ENV['ADMIN_FOLDER'].'/user_level')->with(["success"=>"Data edited."]);
    }

    public function deleteLevel($id)
    {
        $delete = UL::find($id);
        $delete->delete();

        // return \Redirect::to($_ENV['ADMIN_FOLDER'].'/user_level')->with(["success"=>"Data deleted.."]);
    }
}
