<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class setting extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('setting_model');
		$this->load->model('additional_model');
		if($this->additional_model->status()==0){
			redirect('suspend');
		}
		$this->load->library('session');
	}
	function index()
	{
		$this->auth();
		$this->general();
		
	}
	function auth(){
		if(($this->session->userdata('set_login')==FALSE)){
			redirect('admin');
		}
	}
	function account()
	{
		$data['assets']			=$this->config->item('assets');
		$data['site_title']		="Setting Account";
		$data['content_admin']	="admin/setting/account/list";
		$this->load->view('admin/index',$data);
	}
	function general()
	{
		$this->auth();
			$data['assets']			=$this->config->item('assets');
			$data['site_title']		="Setting Website";
			$data['content_admin']	="admin/setting/identitas/general";
			$data['general'] 		= $this->db->get('identitas');
			
			if($data['general']->num_rows()!=0){
				$data['action']			='update';
				$res					=$data['general']->row();
				$data['idx_identitas']	=$res->idx_identitas;
				$data['site_title_']	=$res->site_title;
				$data['site_desc']		=$res->site_desc;
				$data['email']			=$res->email;
				if($res->logo){
					$data['logo']			='<img src="'.base_url().'/uploads/'.$res->logo.'" alt="" style="width: 100%;height: 50%;">';
					$data['logo_img']		=$res->logo;
				}else{
					$data['logo']			='';
					$data['logo_img']		='';
				}
				if($res->favicon){
					$data['favicon']		='<img src="'.base_url().'/uploads/'.$res->favicon.'" alt="" >';
					$data['favicon_img']	=$res->favicon;
				}else{
					$data['favicon']		='';
					$data['favicon_img']	='';
				}
				if($res->banner){
					$data['banner']		='<img src="'.base_url().'/uploads/'.$res->banner.'" alt="" >';
					$data['banner_img']	=$res->banner;
				}else{
					$data['banner']		='';
					$data['banner_img']	='';
				}
				$data['facebook']			=$res->facebook;
				$data['twitter']			=$res->twitter;
				$data['youtube']			=$res->youtube;
				$data['gplus']				=$res->gplus;
				$data['keyword']			=$res->keyword;
				$data['description']		=$res->description;
			}else{
				$data['action']			='save';
				$data['idx_identitas']	='';
				$data['site_title_']		='';
				$data['site_desc']		='';
				$data['email']			='';
				$data['logo']			='';
				$data['logo_img']		='';
				$data['favicon']		='';
				$data['favicon_img']	='';
				$data['facebook']		='';
				$data['twitter']			='';
				$data['youtube']			='';
				$data['gplus']				='';
				$data['keyword']				='';
				$data['description']				='';
			}
			$this->load->view('admin/index',$data);
	}
	function set_aktif(){
		$this->setting_model->set_aktif();
	}
	function shop()
	{
		$this->auth();
			$data['assets']			=$this->config->item('assets');
			$data['site_title']		="Setting Toko";
			$data['content_admin']	="admin/setting/shop/general";
			$data['setting_toko'] 	= $this->db->get('setting_toko');
			if($data['setting_toko']->num_rows()!=0){
				$data['action']			='update';
				$res					=$data['setting_toko']->row();
				$data['idx_setting_toko']=$res->idx_setting_toko;
				$data['nm_toko']		=$res->nm_toko;
				$data['alamat']			=$res->alamat;
				$data['kota']			=$res->kota;
				$data['telp']			=$res->telp;
				$data['fl_ongkir']		=$res->fl_ongkir;
				$data['fl_refund']		=$res->fl_refund;
				$data['fl_secure']		=$res->fl_secure;
			}else{
				$data['action']			='save';
				$data['idx_setting_toko']='';
				$data['nm_toko']		='';
				$data['alamat']			='';
				$data['kota']			='';
				$data['telp']			='';
				$data['fl_ongkir']		='';
				$data['fl_refund']		='';
				$data['fl_secure']		='';
			}
			$this->load->view('admin/index',$data);
	}
	function system()
	{
		$this->auth();
		if(($this->session->userdata('user_name')=='sadmin')){
			$data['assets']			=$this->config->item('assets');
			$data['site_title']		="Setting System";
			$data['content_admin']	="admin/setting/system/general";
			$data['system'] 		= $this->db->get('system');
			if($data['system']->num_rows()!=0){
				$data['action']			='update';
				$res					=$data['system']->row();
				$data['idx_system']		=$res->idx_system;
				$data['pesanan']		=$res->id_pesanan;
				$data['paket']			=$res->paket;
				$data['smtp_host']		=$res->smtp_host;
				$data['smtp_user']		=$res->smtp_user;
				$data['smtp_password']	=$res->smtp_password;
				$data['smtp_port']		=$res->smtp_port;
				$data['directory']		=$res->template;
			}else{
				$data['action']			='save';
				$data['idx_system']		='';
				$data['pesanan']		='';
				$data['paket']			='';
				$data['smtp_host']		='';
				$data['smtp_user']		='';
				$data['smtp_password']	='';
				$data['smtp_port']	='';
				$data['directory']		='';
			}
			$this->load->view('admin/index',$data);
		}
	}
	function page()
	{
		$this->auth();
			$data['assets']			=$this->config->item('assets');
			$data['site_title']		="Setting Link Halaman";
			$data['content_admin']	="admin/setting/link/general";
			$data['link_halaman'] 	= $this->db->get('link_halaman');
			$data['page'] 			= $this->db->get('page');
			if($data['link_halaman']->num_rows()!=0){
				$data['action']			='update';
				$res					=$data['link_halaman']->row();
				$data['idx_link']		=$res->idx_link;
				$data['about_us']		=$res->about_us;
				$data['contact_us']		=$res->contact_us;
				$data['panduan_ukuran']	=$res->panduan_ukuran;
				$data['tata_cara_belanja']=$res->tata_cara_belanja;
				$data['faq']			=$res->faq;
				$data['aturan_pengiriman']=$res->aturan_pengiriman;
				$data['persyaratan_ketentuan']=$res->persyaratan_ketentuan;
				$data['kebijakan_privasi']=$res->kebijakan_privasi;
			}else{
				$data['action']			='save';
				$data['idx_link']		='';
				$data['about_us']		='';
				$data['contact_us']		='';
				$data['panduan_ukuran']	='';
				$data['tata_cara_belanja']='';
				$data['faq']			='';
				$data['aturan_pengiriman']='';
				$data['persyaratan_ketentuan']='';
				$data['kebijakan_privasi']='';
			}
			$this->load->view('admin/index',$data);
	}
	function upload_data_shipping()
	{
		$this->auth();
		$data['assets']			=$this->config->item('assets');
		$data['site_title']		="Upload Ongkos Kirim";
		$data['content_admin']	="admin/setting/shipping/general";
		$this->load->view('admin/index',$data);
	}
	function upload_data_city(){
		$this->auth();
		$data['assets']			=$this->config->item('assets');
		$data['site_title']		="Upload Data Kota";
		$data['content_admin']	="admin/setting/city/general";
		$this->load->view('admin/index',$data);
	}
	function shipping()
	{
		$this->auth();
		$data['assets']			=$this->config->item('assets');
		$data['site_title']		="Ongkos Kirim";
		$data['content_admin']	="admin/setting/shipping/list";
		$this->load->view('admin/index',$data);
	}
	function city()
	{
		$this->auth();
		$data['assets']			=$this->config->item('assets');
		$data['site_title']		="Daftar Kota";
		$data['content_admin']	="admin/setting/city/list";
		$this->load->view('admin/index',$data);
	}
	function template()
	{
		$this->auth();
			$data['assets']			=$this->config->item('assets');
			$data['site_title']		="Upload Template";
			$data['content_admin']	="admin/setting/template/general";
			$this->load->view('admin/index',$data);
	}
	function list_account(){ 
		$this->auth();
		$this->setting_model->list_account();
	}
	function list_shipping(){ 
		$this->auth();
		$this->setting_model->list_shipping();
	}
	function list_city(){ 
		$this->auth();
		$this->setting_model->list_city();
	}
	function list_page(){
		$this->auth();
		$this->setting_model->list_page();
	}
	function delete(){
	$this->auth();
		$target	=$this->uri->segment(3);
		$idx	=$this->uri->segment(4);
		$this->setting_model->delete($target,$idx);
	}
	function upload_ongkir(){
		$this->setting_model->upload_ongkir();
	}
	function upload_city(){
		$this->setting_model->upload_city();
	}
	function upload_template(){
		$this->setting_model->upload_template();
	}
	function add(){
	$this->auth();
		$target	=$this->uri->segment(3);
		$data['assets']			=$this->config->item('assets');
		if($target=="account"){
			$data['site_title']		="Live Chat";
			$data['type_account'] 	= $this->db->get('type_account');
			$data['content_admin']	="admin/setting/account/add";
			$this->load->view('admin/index',$data);
		}
		if($target=="page"){
			$data['site_title']		="Add Page";
			$data['content_admin']	="admin/setting/page/add";
			$this->load->view('admin/index',$data);
		}
		if($target=="shipping"){
			if($this->session->userdata('user_name')=='sadmin'){
				$data['site_title']		="Tambah Ongkos Kirim";
				$data['content_admin']	="admin/setting/shipping/add";
				$this->load->view('admin/index',$data);
			}
		}
		if($target=="city"){
			if($this->session->userdata('user_name')=='sadmin'){
				$data['site_title']		="Tambah Daftar Kota";
				$data['content_admin']	="admin/setting/city/add";
				$this->load->view('admin/index',$data);
			}
		}
	}
	function edit(){
	$this->auth();
		$target	=$this->uri->segment(3);
		$idx	=$this->uri->segment(4);
		$data['assets']			=$this->config->item('assets');
		
		if($target=="account"){
			$data['site_title']		="Live Chat";
			$data['content_admin']	="admin/setting/account/edit";
			$data['Result_form'] 	= $this->additional_model->get_where_row('account_web','idx_account',$idx);
			$data['type_account'] 	= $this->db->get('type_account');
			$this->load->view('admin/index',$data);
		}
		if($target=="page"){
			$data['site_title']		="Edit Page";
			$data['content_admin']	="admin/setting/page/edit";
			$data['Result_form'] 	= $this->additional_model->get_where_row('content_account','idx_content_account',$idx);
			$this->load->view('admin/index',$data);
		}
		if($target=="shipping"){
			$data['site_title']		="Edit Ongkos Kirim";
			$data['content_admin']	="admin/setting/shipping/edit";
			$data['Result_form'] 	= $this->additional_model->get_where_row('shipping_price','idx_shipping_price',$idx);
			$this->load->view('admin/index',$data);
		}
		if($target=="city"){
			$data['site_title']		="Edit Data Kota";
			$data['content_admin']	="admin/setting/city/edit";
			$data['Result_form'] 	= $this->additional_model->get_where_row('shipping_location','idx_shipping_location',$idx);
			$this->load->view('admin/index',$data);
		}
	}
	function save(){
		$this->auth();
		$target	=$this->uri->segment(3);
		$this->setting_model->save($target);
	}
	function update(){
		$this->auth();
		$target	=$this->uri->segment(3);
		$this->setting_model->update($target);
	}
}
