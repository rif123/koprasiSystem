<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class suspend extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('page_model');
	}
	function index()
	{
		if($this->page_model->status()==1){
			redirect(site_url());
		}
		echo"<html>";
		echo"<title>";
		echo"Suspend by Shoplution";
		echo"</title>";
		echo"<img src='./uploads/suspend_img.png'>";
		echo"</html>";
	}
}
