<?php namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Team as Team;
use App\Models\Testimonial as Testi;
use App\Models\Process_text as PC;
use App\Models\Skills as Skill;
use App\Models\Project_category as PJC;
use App\Models\Project as PJ;
use App\Models\Post as PS;
use App\Models\Carousel as CR;
use App\Models\Setting as ST;
use App\Models\Menu as MN;
use App\Models\Contact as ContactModel;
use App\Models\guest_book as GB;
use App\Models\Widget as WG;
use ReCaptcha\ReCaptcha;

use Illuminate\Http\Request;
class WelcomeController extends Controller
{

    private $parser = array();
    private $social;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest');
    }


    private function teamData(){
        $data = Team::all();

        for($i=0;$i<$data->count();$i++){
            $data[$i]->social = unserialize($data[$i]->social);
        }

        return $data;
    }

    private function projectData($all=false){
        if($all){
            $data['project'] = PJ::with('project_category')->get();
        }
        else{
            $data['project'] = PJ::with('project_category')->take(8)->get();
        }

        $data['project_category'] = Array();
        foreach($data['project'] as $a){
            if(!in_array($a->project_category->name,$data['project_category']))
                $data['project_category'][] = $a->project_category->name;
        }

        return $data;
    }

    private function postData(){
        $data = PS::where('active','1')->limit(6)->orderBy('id','DESC')->get()->toArray();

        foreach($data as $a => $b){
            $data[$a]['text'] = strip_tags($data[$a]['text']);
            $dt = array();
            $dt['day'] = Date('d',$data[$a]['date']);
            $dt['month'] = Date('M',$data[$a]['date']);
            $data[$a]['date']=$dt;
        }

        return $data;
    }

    private function setting(){
        $data = ST::all()->toArray();
        $b = array();

        foreach ($data as $value) {
            $b[$value['setting_name']] = $value['value'];
        }

        $this->social = unserialize($b['social_link']);

        return $b;
    }

    /**
     * Show the application welcome screen to the user.
     *
     * @return Response
     */
    public function index()
    {
        $data['widget'] = WG::where('active',1)->orderBy('order_show','Asc')->get()->toArray();
        $data['widget_add'] = array();
        foreach($data['widget'] as $a){
            if($a['parent'] != '1'){
                $data['widget_add']['add_'.$a['name']] = $a['blade_name'];
            }

            if($a['name'] == 'team_section'){
                $data['team']= $this->teamData();
            }
            else if($a['name'] == 'testimonial_section'){
                $data['testi']= Testi::where('active',1)->get();
            }
            else if($a['name'] == 'process_section'){
                $data['process_title']= PC::select('title')->get();
                $data['process_textbox']= PC::select('textbox')->get();
            }
            else if($a['name'] == 'process_section'){
                $data['process_title']= PC::select('title')->get();
            }
            else if($a['name'] == 'skill_section'){
                $data['skill'] = Skill::all();
            }
            else if(($a['name'] == 'news_section') || ($a['name'] == 'latest_news_footer') ){
                $data['post'] = $this->postData();
            }
            else if(($a['name'] == 'contact_section') || ($a['name'] == 'contact_us_footer') ){
                $data['contact'] = ContactModel::find(1);
            }
            else if($a['name'] == 'slide'){
                $data['carousel']= CR::select('text_top','text_middle','button_text','button_link','image')->get();
            }

        }



        $data['menu'] = MN::all()->sortBy('order_show');
        $data = array_merge($data,$this->projectData(),$this->setting());
        $data['social'] = $this->social;

        return view("frontend.homepage",$data)->with('parser', $this->parser);
    }

    public function project(){
        $data = $this->projectData(true);
        $data['widget'] = WG::where('active',1)->where('parent',0)->orderBy('order_show','Asc')->get()->toArray();
        $data['widget_add'] = array();
        foreach($data['widget'] as $a){
                $data['widget_add']['add_'.$a['name']] = $a['blade_name'];
        }

        $data['post'] = $this->postData();
        $data['menu'] = MN::all()->sortBy('order_show');
        $data['contact'] = ContactModel::find(1);
        $data = array_merge($data,$this->setting());
        $data['social'] = $this->social;

        return view("frontend.project",$data)->with('parser', $this->parser);
    }

    public function projectShow($id){
        $data = PJ::where('id',$id)->with('project_category')->get()->toArray();
        $b= array();
        foreach($data[0] as $a => $c){
             $b[$a] = $c;
        }

        $b['photo'] = unserialize($b['photo']);

        return view("frontend.project-show",$b)->with('parser', $this->parser);
    }

    public function post(){
        $data['widget'] = WG::where('active',1)->where('parent',0)->orderBy('order_show','Asc')->get()->toArray();
        $data['widget_add'] = array();
        foreach($data['widget'] as $a){
                $data['widget_add']['add_'.$a['name']] = $a['blade_name'];
        }
        $data['post'] = PS::where('active','1')->orderBy('id','DESC')->paginate(5);
        $data['menu'] = MN::all()->sortBy('order_show');
        $data['contact'] = ContactModel::find(1);
        $data = array_merge($data,$this->setting());
        $data['social'] = $this->social;

        return view("frontend.blog",$data)->with('parser', $this->parser);
    }

    public function postShow($id){
        $data['dt'] = PS::where('id',$id)->get()->first();
        $data['menu'] = MN::all();
        $data['contact'] = ContactModel::find(1);
        $data['post'] = PS::select('title')->where('active','1')->orderBy('id','DESC')->paginate(5);
        $data = array_merge($data,$this->setting());
        $data['social'] = $this->social;
        return view("frontend.blog-show",$data)->with('parser', $this->parser);
    }

    public function message(){
        $rules = array(
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'message' => 'required',
            'g-recaptcha-response'    => 'required'
        );

        $validator = \Validator::make(\Input::all(), $rules);

        if($validator->fails()){
            $error = '<ul>';

            foreach($validator->messages()->all() as $a){
                $error .= '<li>'.$a.'</li>';
            }
            $error .= '</ul>';
            return $error;
        }
        else{
            $title = \Input::get('name');
            $update = ST::where('setting_name','section4_title');
            $update->update(['value' => $title]);

            $response = \Input::get('g-recaptcha-response');
            $name = \Input::get('name');
            $email = \Input::get('email');
            $phone = \Input::get('phone');
            $message = \Input::get('message');

            $secret   = env('CAPTCHA_KEY');
            $remoteip = $_SERVER['REMOTE_ADDR'];

            $recaptcha = new ReCaptcha($secret);
            $resp = $recaptcha->verify($response, $remoteip);

            if ($resp->isSuccess()) {

                //TODO: SAVE TO DATABASE
                $insert = new GB;
                $insert->name = strip_tags($name);
                $insert->email = strip_tags($email);
                $insert->phone = strip_tags($phone);
                $insert->message = strip_tags($message);
                $insert->date = time();

                $insert->save();
                return "sent";
            } else {
                return "Captcha Failed!";
            }

        }

    }


}
