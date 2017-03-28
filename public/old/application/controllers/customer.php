<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class customer extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('customer_model');
		if($this->customer_model->status()==0){
			redirect('suspend');
		}
	}
	function index()
	{
		redirect('page');
		
	}
	function auth(){
		if(($this->session->userdata('set_login_cus')==FALSE)){
			redirect('page/login_user');
		}
	}
	function auth_refund(){
		$fl_refund	=$this->db->get('setting_toko')->row()->fl_refund;
		if($fl_refund==0){
			redirect('page');
		}
	}
	function testimoni(){
		$this->auth();
		$this->customer_model->testimoni_proses();
	}
	function contact_proses(){
		$this->customer_model->contact_send();
	}
	function comment(){
		$this->customer_model->comment();
	}
	function refund(){
		$this->auth_refund();
		$this->auth();
		$this->customer_model->refund();
	}
	function unsubscribe(){
		$this->customer_model->unsubscribe();
	}
	function update_account(){
		$this->auth();
		$this->customer_model->update_account();
	}
	function update_password(){
		$this->auth();
		$this->customer_model->update_password();
	}
	function update_address(){
		$this->auth();
		$this->customer_model->update_address();
	}
	function auth_wishlist(){
		$fl_wishlist	=$this->db->get('system')->row()->fl_wishlist;
		if($fl_wishlist==0){
			redirect('page');
		}
	}
	function add_wishlist(){
		$this->auth_wishlist();
		$this->auth();
		$this->customer_model->add_wishlist();
	}
	/*--delete wishlist---*/
	function delete(){
		$this->load->library('session');
		if(($this->session->userdata('set_login_cus')==TRUE)){
			$this->customer_model->delete_wishlist();
		}
	}
}
