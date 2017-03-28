<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class product extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('product_model');
		$this->load->model('additional_model');
		if($this->additional_model->status()==0){
			redirect('suspend');
		}
		$this->load->library('session');
	}
	function index()
	{
		$this->auth();
		$this->product();
		
	}
	function auth(){
		if(($this->session->userdata('set_login')==FALSE)){
			redirect('admin');
		}
	}
	
	function category()
	{
		$this->auth();
		$data['assets']			=$this->config->item('assets');
		$data['site_title']		="Kategori Produk";
		$data['content_admin']	="admin/produk/category/list";
		$this->load->view('admin/index',$data);
	}
	function brand()
	{
		$this->auth();
		$data['assets']			=$this->config->item('assets');
		$data['site_title']		="Brand Produk";
		$data['content_admin']	="admin/produk/brand/list";
		$this->load->view('admin/index',$data);
	}
	function ukuran()
	{
		$this->auth();
		$data['assets']			=$this->config->item('assets');
		$data['site_title']		="Ukuran Produk";
		$data['content_admin']	="admin/produk/ukuran/list";
		$this->load->view('admin/index',$data);
	}
	function gallery()
	{
		$this->auth();
		if($this->db->get("system")->row()->fl_gallery==1){
			$data['assets']			=$this->config->item('assets');
			$data['site_title']		="Galleri Produk";
			$data['idx_product']	=$this->uri->segment(3);
			$data['gallery']		=$this->product_model->get_gallery($this->uri->segment(3));
				if($this->product_model->get_gallery($this->uri->segment(3))->num_rows()>0){
					$data['fill']	=1;
				}else{
					$data['fill']	=0;
				}
			$data['content_admin']	="admin/produk/gallery/gallery";
			$this->load->view('admin/index',$data);
		}else{
			redirect("product");
		}
	}
	function tb_use(){
		$ID=$this->input->post('ID');
		$use=false;
		foreach($this->db->get_where("tb_use",array("tabel"=>"attribute_product"))->result() as $w){
			if($this->db->get_where($w->use,array("idx_attribute_product"=>$ID))->num_rows()>0){
				$use=true;
			}
		}
		if($use==false){
			$this->db->delete('attribute_product', array('idx_attribute_product' =>$ID));
			echo'{"use":0,"mes":""}';
		}else{
			echo'{"use":1,"mes":"- Attribute produk tidak dapat dihapus karena sedang digunakan dalam transaksi pelanggan."}';
		}
	}
	function tb_use_select(){
		$ID=$this->input->post('ID');
		$use=false;
		foreach($this->db->get_where("attribute_product",array("idx_product"=>$ID))->result() as $p){
			foreach($this->db->get_where("tb_use",array("tabel"=>"attribute_product"))->result() as $w){
				if($this->db->get_where($w->use,array("idx_attribute_product"=>$p->idx_attribute_product))->num_rows()>0){
					$use=true;
				}
			}
		}
		if($use==false){
			echo'{"use":0,"mes":""}';
		}else{
			echo'{"use":1,"mes":"- Type produk tidak dapat diganti karena sedang digunakan dalam transaksi pelanggan."}';
		}
	}
	function product()
	{
		$this->auth();
		$data['assets']			=$this->config->item('assets');
		$data['site_title']		="Data Produk";
		$data['trg']			="";
		$data['content_admin']	="admin/produk/product/list";
		$this->load->view('admin/index',$data);
	}
	function minimum_stock()
	{
		$this->auth();
		$data['assets']			=$this->config->item('assets');
		$data['site_title']		="Data Produk Minimum Stok";
		$data['content_admin']	="admin/produk/product/list_minimum";
		$this->load->view('admin/index',$data);
	}
	function best_product()
	{
		$this->auth();
		$data['assets']			=$this->config->item('assets');
		$data['site_title']		="Data Produk Terlaris";
		$data['content_admin']	="admin/produk/product/list_best";
		$this->load->view('admin/index',$data);
	}
	function list_category(){ 
		$this->auth();
		$this->product_model->list_category();
	}
	function list_ukuran(){
		$this->auth();
		$this->product_model->list_ukuran();
	}
	function list_product(){
		$this->auth();
		$this->product_model->list_product();
	}
	function list_best_product(){
		$this->auth();
		$this->product_model->list_best_product();
	}
	function list_product_minimum(){
		$this->auth();
		$this->product_model->list_product_minimum();
	}
	function list_brand(){
		$this->auth();
		$this->product_model->list_brand();
	}
	function list_gallery(){
		$this->auth();
		$this->product_model->list_gallery();
	}
	function delete(){
	$this->auth();
		$target	=$this->uri->segment(3);
		$idx	=$this->uri->segment(4);
		$this->product_model->delete($target,$idx);
	}
	function add(){
	$this->auth();
		$target	=$this->uri->segment(3);
		$data['assets']			=$this->config->item('assets');
		if($target=="category"){
			$data['site_title']		="Tambah Kategori";
			$data['content_admin']	="admin/produk/category/add";
			$data['category_product']= $this->db->query("SELECT cp.idx_category AS idx_category , GROUP_CONCAT(c.nm_categrory_product ORDER BY cp.level SEPARATOR ' > ') AS name, c.parent FROM category_path cp LEFT JOIN category_product c ON (cp.idx_path= c.idx_category_product) GROUP BY cp.idx_category order by cp.idx_category");
			$this->load->view('admin/index',$data);
		}
		if($target=="product"){
			$data['site_title']			="Tambah Produk";
			$data['content_admin']		="admin/produk/product/add";
			$data['category_product']	= $this->db->query("SELECT cp.idx_category AS idx_category , GROUP_CONCAT(c.nm_categrory_product ORDER BY cp.level SEPARATOR ' > ') AS name, c.parent FROM category_path cp LEFT JOIN category_product c ON (cp.idx_path= c.idx_category_product) GROUP BY cp.idx_category order by cp.idx_category");
			$data['attribute']			= $this->db->get('attribute');
			$data['brand']				= $this->db->get('brand');
			$data['ukuran']				= $this->db->get('ukuran');
			$this->load->view('admin/index',$data);
		}
		if($target=="brand"){
			$data['site_title']			="Tambah Brand Produk";
			$data['content_admin']		="admin/produk/brand/add";
			$this->load->view('admin/index',$data);
		}
		if($target=="ukuran"){
			$data['site_title']			="Tambah Ukuran Produk";
			$data['content_admin']		="admin/produk/ukuran/add";
			$this->load->view('admin/index',$data);
		}
		if($target=="gallery"){
			$data['site_title']			="Tambah Galery Produk";
			$data['content_admin']		="admin/produk/gallery/add";
			$data['idx_product']		=$this->uri->segment(4);
			$this->load->view('admin/index',$data);
		}
	}
	function get_category_path($parent){
		if($parent==0){
			$parent="<option selected value=0>Pilih--</option>";
		}else{
			$res	=$this->db->query("SELECT * FROM (`category_path`) WHERE `idx_category` =  '$parent' order by level asc");
			$nm="";
			foreach($res->result() as $wcp){
				if($nm==""){
					$nm=$this->product_model->get_nm($wcp->idx_path);
				}else{
					$nm=$nm." > ".$this->product_model->get_nm($wcp->idx_path);
				}
			}
			$parent="<option selected value=0>".$nm."</option>";
		}
		return $parent;
	}
	function edit(){
	$this->auth();
		$target	=$this->uri->segment(3);
		$idx	=$this->uri->segment(4);
		$data['assets']			=$this->config->item('assets');
		
		if($target=="category"){
			$data['site_title']			="Edit Kategori";
			$data['content_admin']		="admin/produk/category/edit";
			$data['product']			= $this;
			$data['Result_form'] 		= $this->additional_model->get_where_row('category_product','idx_category_product',$idx);
			$data['category_product'] 	= $this->db->query("SELECT cp.idx_category AS idx_category , GROUP_CONCAT(c.nm_categrory_product ORDER BY cp.level SEPARATOR ' > ') AS name, c.parent FROM category_path cp LEFT JOIN category_product c ON (cp.idx_path= c.idx_category_product) GROUP BY cp.idx_category order by cp.idx_category");
			$this->load->view('admin/index',$data);
		}
		if($target=="brand"){
			$data['site_title']			="Edit Brand Produk";
			$data['content_admin']		="admin/produk/brand/edit";
			$data['Result_form'] 		= $this->additional_model->get_where_row('brand','idx_brand',$idx);
			$this->load->view('admin/index',$data);
		}
		if($target=="ukuran"){
			$data['site_title']			="Edit Ukuran Produk";
			$data['content_admin']		="admin/produk/ukuran/edit";
			$data['Result_form'] 		= $this->additional_model->get_where_row('ukuran','idx_ukuran',$idx);
			$this->load->view('admin/index',$data);
		}
		if($target=="product"){
			$data['site_title']			="Edit Produk";
			$data['content_admin']		="admin/produk/product/edit";
			$data['fl_gallery']			= $this->db->get("system")->row()->fl_gallery;
			$data['Result_form'] 		= $this->product_model->get_product($idx);
			$data['category_product']	= $this->db->query("SELECT cp.idx_category AS idx_category , GROUP_CONCAT(c.nm_categrory_product ORDER BY cp.level SEPARATOR ' > ') AS name, c.parent FROM category_path cp LEFT JOIN category_product c ON (cp.idx_path= c.idx_category_product) GROUP BY cp.idx_category order by cp.idx_category");
			$data['attribute']			= $this->db->get('attribute');
			$data['brand']				= $this->db->get('brand');
			$data['ukuran']				= $this->db->get('ukuran');
			$this->load->view('admin/index',$data);
		}
	}
	function save(){
	$this->auth();
		$target	=$this->uri->segment(3);
		$this->product_model->save($target);
	}
	function delete_gallery(){
		$this->product_model->delete_gallery();
	}
	function update(){
	$this->auth();
		$target	=$this->uri->segment(3);
		$this->product_model->update($target);
	}
}
