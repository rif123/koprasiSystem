<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class category extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('additional_model');
		$this->load->model('page_model');
		if($this->page_model->status()==0){
			redirect('suspend');
		}
		$this->load->helper(array('form', 'url'));
		$this->load->library('cart');
	}
	function index()
	{
		
	}

	function view(){
		$idx_category		=$this->uri->segment(2);
		if(is_numeric($idx_category)){
			$data['assets']		=$this->config->item('assets');
			$data['identitas'] 	= $this->additional_model->get_row('identitas');
			$data['fl_promo'] 	= $this->page_model->fl_promo();
			$data['fl_wishlist']= $this->page_model->fl_wishlist();
			$data['fl_secure'] 	= $this->page_model->fl_secure();
			$data['ym'] 			= $this->page_model->get_ym();
			$data['contact']		= $this->page_model->contact();
			$data['acc'] 			= $this->page_model->get_acc();
			$data['menu_bawah']		= $this->page_model->menu_bawah();
			$data['menu'] 			= $this->page_model->create_menu();
			$data['cart']			= $this->page_model->display_cart();
			$data['category']		=$this;
			$data['idx_path']		=$this->db->get_where("category_path",array("idx_category"=>$idx_category,"level"=>0))->row()->idx_path;
			$data['category_product']=$this->db->query("SELECT b.* FROM `category_path` a  join category_product b on a.idx_category=b.idx_category_product where a.idx_path='$data[idx_path]' order by b.parent,b.idx_category_product");
			$data['brand']			=$this->db->get('brand');
			$data['price']			=$this->db->get('search_price');
			$data['sort']			=$this->db->get('tb_sort');
			$brand=$this->input->get('brand');
			$price=$this->input->get('price');
			$data['brand_use']			="";
			$data['price_use']			="";
			$where_brand="";
			if($brand){
				for($i=0;$i<count($brand);$i++){
					if($where_brand==""){
						$where_brand=" and (idx_brand=$brand[$i]";
					}else{
						$where_brand=$where_brand." or idx_brand=$brand[$i]";
					}
				}
				$where_brand=$where_brand.")";
				$data['brand_use']			=$brand;
			}
			$where_price="";
			if($price){
				for($i=0;$i<count($price);$i++){
					if($where_price==""){
						$where_price=" and (harga_discount ".$this->additional_model->get_sql_price($price[$i]);
					}else{
						$where_price=$where_price." or harga_discount ".$this->additional_model->get_sql_price($price[$i]);
					}
				}
				$where_price=$where_price.")";
				$data['price_use']			=$price;
			}
			if($this->input->get('sort')){
				$sort='order by '.$this->get_sort($this->input->get('sort'));
			}else{
				$sort='order by idx_product';
			}
			if($this->input->get('sortby')){
				$sortby=$this->input->get('sortby');
			}else{
				$sortby='desc';
			}
			/*---kategoti produk---*/
			$data['Cquery']			=$this->db->get_where("category_product",array("idx_category_product"=>$idx_category))->row();
			$query_category			=$this->db->get_where("category_path",array("idx_path"=>$idx_category));
			$whr="";
			foreach($query_category->result() as $wcp){
				if($whr==""){
					$whr="(  category_product=$idx_category or  category_product=$wcp->idx_category";
				}else{
					$whr=$whr." or category_product=$wcp->idx_category";
				}
			}
			if($whr!=""){
				$whr=$whr.")";
			}else{
				$whr="(category_product=$idx_category)";
			}
			$data['list_product']=$this->additional_model->list_product($whr,$where_brand,$where_price,$sort,$sortby);
			/*---kategoti produk---*/
			$data['site_title']	=$data['Cquery']->nm_categrory_product." | ".$data['identitas']->site_title;
			$template			='demo';
			$data['template']	=$this->db->get('system')->row()->template;
			$this->load->view('template/'.$template.'/category',$data);
		}else{
			redirect('page');
		}
	}
	function get_nm($idx){
		return $this->db->get_where("category_product",array("idx_category_product"=>$idx))->row()->nm_categrory_product;
	}
	function parent_product($idx){
		$query	=$this->db->get_where("category_product",array("idx_category_product"=>$idx))->row();
		$res	=$this->db->query("SELECT * FROM (`category_path`) WHERE `idx_category` ='$query->parent' order by level asc");
		return $res;
	}
	function cek_parent($parent){
		return $this->db->get_where("category_path",array("idx_path"=>$parent,"level"=>1))->num_rows();
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
	function get_sort($val){
		return $this->db->get_where("tb_sort",array("nm_sort"=>$val))->row()->sql_sort;
	}
	function sold_out($idx_product,$idx_type_product){
		return $this->page_model->sold_out($idx_product,$idx_type_product);
	}
}
