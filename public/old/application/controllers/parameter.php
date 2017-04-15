<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class parameter extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('parameter_model');
		$this->load->model('additional_model');
		$this->load->library('session');
		if($this->additional_model->status()==0){
			redirect('suspend');
		}
	}
	function index()
	{
		redirect('admin');
		
	}
	function bank()
	{
		if(($this->session->userdata('set_login')==TRUE)){
			$data['assets']			=$this->config->item('assets');
			$data['site_title']		="Account Bank";
			$data['content_admin']	="admin/parameter/bank/list";
			$this->load->view('admin/index',$data);
		}else{
			redirect('admin');
		}
	}
	function page()
	{
		if(($this->session->userdata('set_login')==TRUE)){
			$data['assets']			=$this->config->item('assets');
			$data['site_title']		="Data Page";
			$data['content_admin']	="admin/parameter/page/list";
			$this->load->view('admin/index',$data);
		}else{
			redirect('admin');
		}
	}
	function attribute()
	{
		if(($this->session->userdata('set_login')==TRUE)){
			$data['assets']			=$this->config->item('assets');
			$data['site_title']		="Atribut Produk";
			$data['content_admin']	="admin/parameter/attribute/list";
			$this->load->view('admin/index',$data);
		}else{
			redirect('admin');
		}
	}
	function list_attribute(){
	if(($this->session->userdata('set_login')==TRUE)){
		$this->parameter_model->list_attribute();
		}else{
			redirect('admin');
		}
	}
	function list_bank(){
	if(($this->session->userdata('set_login')==TRUE)){
		$this->parameter_model->list_bank();
		}else{
			redirect('admin');
		}
	}
	function list_page(){
	if(($this->session->userdata('set_login')==TRUE)){
		$this->parameter_model->list_page();
		}else{
			redirect('admin');
		}
	}
	function delete(){
		if(($this->session->userdata('set_login')==TRUE)){
			$target	=$this->uri->segment(3);
			$idx	=$this->uri->segment(4);
			$this->parameter_model->delete($target,$idx);
		}else{
			redirect('admin');
		}
	}
	function add(){
		if(($this->session->userdata('set_login')==TRUE)){
			$target	=$this->uri->segment(3);
			$data['assets']			=$this->config->item('assets');
			if($target=="bank"){
				$data['site_title']		="Tambah Account Bank";
				$data['content_admin']	="admin/parameter/bank/add";
				$this->load->view('admin/index',$data);
			}
			if($target=="attribute"){
				$data['site_title']		="Tambah Atribut";
				$data['content_admin']	="admin/parameter/attribute/add";
				$this->load->view('admin/index',$data);
			}
			if($target=="page"){
				$data['site_title']		="Tambah Page";
				$data['content_admin']	="admin/parameter/page/add";
				$this->load->view('admin/index',$data);
			}
		}else{
			redirect('admin');
		}
	}
	function edit(){
		if(($this->session->userdata('set_login')==TRUE)){
			$target	=$this->uri->segment(3);
			$idx	=$this->uri->segment(4);
			$data['assets']			=$this->config->item('assets');
			if($target=="bank"){
				$data['site_title']		="Edit Account Bank";
				$data['content_admin']	="admin/parameter/bank/edit";
				$data['Result_form'] 	= $this->additional_model->get_where_row('account_bank','idx_account_bank',$idx);
				$this->load->view('admin/index',$data);
			}
			if($target=="page"){
				$data['site_title']		="Edit Page";
				$data['content_admin']	="admin/parameter/page/edit";
				$data['Result_form'] 	= $this->additional_model->get_where_row('page','idx_page',$idx);
				$this->load->view('admin/index',$data);
			}
			if($target=="attribute"){
				$data['site_title']		="Edit Atribut Produk";
				$data['content_admin']	="admin/parameter/attribute/edit";
				$data['Result_form'] 	= $this->additional_model->get_where_row('attribute','idx_attribute',$idx);
				$this->load->view('admin/index',$data);
			}
		}else{
			redirect('admin');
		}
	}
	function save(){
		if(($this->session->userdata('set_login')==TRUE)){
			$target	=$this->uri->segment(3);
			$this->parameter_model->save($target);
		}else{
			redirect('admin');
		}
	}
	function update(){
		if(($this->session->userdata('set_login')==TRUE)){
			$target	=$this->uri->segment(3);
			$this->parameter_model->update($target);
		}else{
			redirect('admin');
		}
	}
}
