<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class detail extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('additional_model');
		$this->load->model('page_model');
		if($this->page_model->status()==0){
			redirect('suspend');
		}
		$this->load->helper(array('form', 'url'));
		$this->load->library('session');
		$this->load->library('cart');
	}
	function index()
	{
		
	}
	function view(){
		if(is_numeric($this->uri->segment(2))){
			$data['assets']		=$this->config->item('assets');
			$data['fl_promo'] 	= $this->page_model->fl_promo();
			$data['fl_wishlist']= $this->page_model->fl_wishlist();
			$data['fl_secure'] 	= $this->page_model->fl_secure();
			$data['identitas'] 	= $this->additional_model->get_row('identitas');
			$data['ym'] 			= $this->page_model->get_ym();
			$data['contact']		= $this->page_model->contact();
			$data['acc'] 			= $this->page_model->get_acc();
			$data['menu_bawah']		= $this->page_model->menu_bawah();
			$data['menu'] 			= $this->page_model->create_menu();
			$data['promo_banner']	= $this->page_model->promo_banner();
			$data['cart']			= $this->page_model->display_cart();
			$data['product']		= $this->additional_model->product_datail($this->uri->segment(2));
			$data['gallery']		= $this->page_model->get_gallery($this->uri->segment(2));
			$data['rate']			= $this->page_model->get_rate($this->uri->segment(2));
			$data['list_other_product']=$this->page_model->list_other_product($this->uri->segment(2));
			$data['attribute']		=$this->additional_model->get_attribute_group($data['product']->idx_product);
			$data['tag']			=$this->db->get_where("product",array("idx_product"=>$this->uri->segment(2)))->row()->tag;
			$data['detail']			=$this;
			$template				='demo';
			$data['template']		=$this->db->get('system')->row()->template;
			$data['site_title']	=$data['product']->nm_product." | ".$data['identitas']->site_title;
			$this->load->view('template/'.$template.'/detail',$data);
		}else{
			redirect('page');
		}
	}
	function nm_category($key){
		$pc				=explode("/",$key);
		$idx_category	=$pc[0];
		return $this->db->get_where("category_product",array("idx_category_product"=>$pc[0]))->row()->nm_categrory_product;
	}
	function sold_out($idx_product,$idx_type_product){
		return $this->page_model->sold_out($idx_product,$idx_type_product);
	}
	function check_promo($idx){
		return $this->page_model->check_promo($idx);
	}
	function free_ongkir($idx){
		return $this->page_model->free_ongkir($idx);
	}
	function get_attribute_group($idx){
		return $this->additional_model->get_attribute_group($idx);
	}
	function get_panduan($idx){
		$q=$this->db->get_where("ukuran",array("idx_ukuran"=>$idx))->row();
		return $q->path_ukuran;
	}
	function get_nm($idx){
		return $this->db->get_where("category_product",array("idx_category_product"=>$idx))->row()->nm_categrory_product;
	}
	function parent_product($idx){
		$query	=$this->db->get_where("category_product",array("idx_category_product"=>$idx))->row();
		$res	=$this->db->query("SELECT * FROM (`category_path`) WHERE `idx_category` ='$query->parent' order by level asc");
		return $res;
	}
}
