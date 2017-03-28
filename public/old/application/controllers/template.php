<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class template extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('template_model');
		$this->load->model('additional_model');
	}
	function index()
	{
		$this->management();
		
	}
	function management()
	{
		$data['assets']			=$this->config->item('assets');$data['notif_order']	=$this->db->query("SELECT * FROM  `order` where cd_status !=3")->num_rows();
		$data['site_title']		="Management Template | Shoplution";
		$data['content_admin']	="admin/template/list";
		$this->load->view('admin/index',$data);
	}
	function list_template(){
		$this->template_model->list_template();
	}
	function delete(){
		$idx	=$this->uri->segment(3);
		$this->template_model->delete($idx);
	}
	function add(){
		$data['assets']			=$this->config->item('assets');$data['notif_order']	=$this->db->query("SELECT * FROM  `order` where cd_status !=3")->num_rows();
			$data['site_title']		="Add Template | Shoplution";
			$data['tb_paket'] 	= $this->db->get('tb_paket');
			$data['content_admin']	="admin/template/add";
			$this->load->view('admin/index',$data);
	}
	function edit(){
			$idx					=$this->uri->segment(3);
			$data['assets']			=$this->config->item('assets');$data['notif_order']	=$this->db->query("SELECT * FROM  `order` where cd_status !=3")->num_rows();
			$data['site_title']		="Edit Template | Shoplution";
			$data['content_admin']	="admin/template/edit";
			$data['Result_form'] 	= $this->additional_model->get_where_row('template','idx_template',$idx);
			$data['tb_paket'] 		= $this->db->get('tb_paket');
			$this->load->view('admin/index',$data);
	}
	function save(){
		$this->template_model->save();
	}
	function update(){
		$this->template_model->update();
	}
}
