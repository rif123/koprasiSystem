<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class admin extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library('session');
		$this->load->model('additional_model');
		if($this->additional_model->status()==0){
			redirect('suspend');
		}
	}
	function index()
	{
		if(($this->session->userdata('set_login')==FALSE)){
			redirect('admin/login');
		}else{
			if(($this->session->userdata('user_name')<>'sadmin')){ 
				redirect('dashboard');
			}else{
				redirect('setting/system');
			}
		}
	}
	function login(){
		if(($this->session->userdata('set_login')==FALSE)){
			$data['assets']			=$this->config->item('assets');
			$data['site_title']		="Login Admin";
			$this->load->view('admin/login',$data);
		}else{
			redirect('setting');
		}
	}
	function login_auth(){
		$this->additional_model->login_auth();
	}
	
	function logout(){
		$this->session->unset_userdata('idx_user');
		$this->session->unset_userdata('user_name');
		$this->session->unset_userdata('set_login');
		redirect('admin');
	}	
	function change_password()
	{
		if(($this->session->userdata('set_login')==TRUE)){
			$data['assets']			=$this->config->item('assets');
			$data['site_title']		="Ganti Profile";
			$data['content_admin']	="admin/user/profile";
			$this->load->view('admin/index',$data);
		}else{
			redirect('admin/login');
		}
	}
	function home()
	{
		if(($this->session->userdata('set_login')==TRUE)){
			$data['assets']			=$this->config->item('assets');
			$data['site_title']		="Home Admin";
			$data['content_admin']	="admin/user/home";
			$this->load->view('admin/index',$data);
		}else{
			redirect('admin/login');
		}
	}
}
