<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class report extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('report_model');
		$this->load->helper(array('form', 'url'));
		$this->load->library('session');
		if($this->report_model->status()==0){
			redirect('suspend');
		}
	}
	function index()
	{
		$this->auth();
		
	}
	function auth(){
		if(($this->session->userdata('set_login')==FALSE)){
			redirect('admin');
		}
	}
	function list_order(){
		$this->auth();
		$this->report_model->list_order();
	}
	function list_best_product(){
		$this->auth();
		$this->report_model->list_best_product();
	}
	function list_history_pelanggan(){
		$this->auth();
		$this->report_model->list_history_pelanggan();
	}
	function list_product(){
		$this->auth();
		$this->report_model->list_product();
	}
	function order(){
		$this->auth();
		$data['assets']			=$this->config->item('assets');
		$data['site_title']		="Laporan Data Penjualan";
		$data['content_admin']	="admin/report/order";
		$this->load->view('admin/index',$data);
	}
	function customer(){
		$this->auth();
		$data['assets']			=$this->config->item('assets');
		$data['site_title']		="Laporan Data Pelanggan";
		$data['content_admin']	="admin/report/customer";
		$this->load->view('admin/index',$data);
	}
	function product(){
		$this->auth();
		$data['assets']			=$this->config->item('assets');
		$data['brand']			=$this->db->get("brand");
		$data['site_title']		="Laporan Data Produk";
		$data['content_admin']	="admin/report/product";
		$this->load->view('admin/index',$data);
	}
	function best_product(){
		$this->auth();
		$data['assets']			=$this->config->item('assets');
		$data['site_title']		="Laporan Data Produk Terlaris";
		$data['content_admin']	="admin/report/best_product";
		$this->load->view('admin/index',$data);
	}
	function generate(){
		$trg	=$this->uri->segment(3);
		if($trg=="order"){
			$this->report_model->generate_order();
		}
		if($trg=="product"){
			$this->report_model->generate_product();
		}
		if($trg=="best_product"){
			$this->report_model->generate_best_product();
		}
		if($trg=="customer"){
			$this->report_model->generate_customer();
		}
	}
}
