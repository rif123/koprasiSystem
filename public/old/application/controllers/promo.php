<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class promo extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('promo_model');
		$this->load->model('page_model');
		if($this->page_model->status()==0){
			redirect('suspend');
		}
		$this->load->library('cart');
		$this->load->library('session');
	}
	function index()
	{
		$this->auth();
		$this->dt_promo();
		
	}
	function auth(){
		if(($this->session->userdata('set_login')==FALSE)){
			redirect('admin');
		}
	}
	function dt_promo()
	{
		if($this->db->query("select fl_promo from system")->row()->fl_promo==1){
			$this->auth();
			$data['assets']			=$this->config->item('assets');
			$data['site_title']		="Promo Produk";
			$data['content_admin']	="admin/promo/list";
			$this->load->view('admin/index',$data);
		}else{
			redirect('setting');
		}
	}
	function sold_out($idx_product,$idx_type_product){
		return $this->page_model->sold_out($idx_product,$idx_type_product);
	}
	function list_product_use(){
		$this->auth();
		$this->promo_model->list_product_use();
	}
	function list_product_use_bogof(){
		$this->auth();
		$this->promo_model->list_product_use_bogof();
	}
	function list_product(){
		$this->auth();
		$this->promo_model->list_product();
	}
	function list_promo(){
		$this->auth();
		$this->promo_model->list_promo();
	}
	function list_product_bogof(){
		$this->auth();
		$this->promo_model->list_product_bogof();
	}
	function delete(){
		$this->auth();
		$target	=$this->uri->segment(3);
		$idx	=$this->uri->segment(4);
		$this->promo_model->delete($target,$idx);
	}
	function add(){
		if($this->db->query("select fl_promo from system")->row()->fl_promo==1){
			$this->auth();
			$data['assets']			=$this->config->item('assets');
			$data['site_title']		="Tambah Promo";
			$data['category_product']= $this->db->query("SELECT cp.idx_category AS idx_category , GROUP_CONCAT(c.nm_categrory_product ORDER BY cp.level SEPARATOR '>') AS name, c.parent FROM category_path cp LEFT JOIN category_product c ON (cp.idx_path= c.idx_category_product) GROUP BY cp.idx_category order by cp.idx_category");
			$type_promo_recent		=$this->db->query("SELECT * FROM promo_management where idx_type_promo=4");
			$wh="";
			if($type_promo_recent->num_rows()>0){
				$n=1;
				foreach ($type_promo_recent->result() as $v) {
						if($n==1){
							$wh="idx_type_promo!='$v->idx_type_promo'";
						}else{
							$wh=$wh." and idx_type_promo!='$v->idx_type_promo'";
						}
					
				$n++;
				}
				$data['type_promo']		=$this->db->query("select * from type_promo where $wh");
			}else{
				$data['type_promo']		=$this->db->get('type_promo');
			}
			$data['content_admin']	="admin/promo/add";
			$this->load->view('admin/index',$data);
		}else{
			redirect('dashboard');
		}
	}
	function content_promo(){
		if($this->db->query("select fl_promo from system")->row()->fl_promo==1){
			$this->auth();
			$data['assets']			=$this->config->item('assets');
			$data['site_title']		="Tambah Item Promo";
			$data['category_product']= $this->db->query("SELECT cp.idx_category AS idx_category , GROUP_CONCAT(c.nm_categrory_product ORDER BY cp.level SEPARATOR ' > ') AS name, c.parent FROM category_path cp LEFT JOIN category_product c ON (cp.idx_path= c.idx_category_product) GROUP BY cp.idx_category order by cp.idx_category");
			$data['list_city']		= $this->promo_model->list_city('list_city');
			$data['brand']= $this->db->get('brand');
			$data['promo']			=$this->db->get_where("promo_management",array('idx_promo'=>$this->uri->segment(3)))->row();
			$data['content_admin']	="admin/promo/produk";
			$this->load->view('admin/index',$data);
		}else{
			redirect('setting');
		}
	}
	function edit_product(){
		if($this->db->query("select fl_promo from system")->row()->fl_promo==1){
			$this->auth();
			$data['assets']			=$this->config->item('assets');
			$data['site_title']		="Edit Item Promo";
			$data['category_product']= $this->db->query("SELECT cp.idx_category AS idx_category , GROUP_CONCAT(c.nm_categrory_product ORDER BY cp.level SEPARATOR ' > ') AS name, c.parent FROM category_path cp LEFT JOIN category_product c ON (cp.idx_path= c.idx_category_product) GROUP BY cp.idx_category order by cp.idx_category");
			$data['list_city']		= $this->promo_model->list_city('list_city');
			$data['brand']			= $this->db->get('brand');
			$data['promo']			=$this->db->get_where("promo_management",array('idx_promo'=>$this->uri->segment(3)))->row();
			$data['content_promo']	=$this->db->get_where("content_prom",array('idx_promo'=>$this->uri->segment(3)));
			if($data['promo']->idx_type_promo==5)
			{
				$data['free_shipping_city']	= $this->db->get('free_shipping_city');
			}
			$data['content_admin']	="admin/promo/produk_edit";
			$this->load->view('admin/index',$data);
		}else{
			redirect('setting');
		}
	}
	function edit(){
		$this->auth();
		$target	=$this->uri->segment(3);
		$idx	=$this->uri->segment(4);
		$data['assets']			=$this->config->item('assets');
		$data['category_product']= $this->db->query("SELECT cp.idx_category AS idx_category , GROUP_CONCAT(c.nm_categrory_product ORDER BY cp.level SEPARATOR '>') AS name, c.parent FROM category_path cp LEFT JOIN category_product c ON (cp.idx_path= c.idx_category_product) GROUP BY cp.idx_category order by cp.idx_category");
		if($this->db->query("select fl_promo from system")->row()->fl_promo==1){
			if($target=="promo"){
				$data['site_title']			="Edit Promo";
				$data['content_admin']		="admin/promo/edit";
				$data['Result_form'] 		= $this->db->get_where('promo_management',array('idx_promo'=>$idx))->row();
				$type_promo_recent		=$this->db->query("SELECT * FROM promo_management where idx_type_promo=4");
				$wh="";
				if($type_promo_recent->num_rows()>0){
					$n=1;
					foreach ($type_promo_recent->result() as $v) {
							if($n==1){
								$wh="idx_type_promo!='$v->idx_type_promo'";
							}else{
								$wh=$wh." and idx_type_promo!='$v->idx_type_promo'";
							}
						
					$n++;
					}
					$data['type_promo']		=$this->db->query("select * from type_promo where $wh");
				}else{
					$data['type_promo']		=$this->db->get('type_promo');
				}
				$this->load->view('admin/index',$data);
			}
		}else{
			redirect('setting');
		}
	}
	function date_convert($date){
		$date	=str_replace('-',',',$date);
		$pc		=explode(',',$date);
		$bln	=$pc[1]-1;
		return $pc[0].','.$bln.','.$pc[2];
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
	function save(){
		if($this->db->query("select fl_promo from system")->row()->fl_promo==1){
			$this->auth();
			$target	=$this->uri->segment(3);
			$this->promo_model->save($target);
		}else{
			redirect('setting');
		}
	}
	function update(){
		if($this->db->query("select fl_promo from system")->row()->fl_promo==1){
			$this->auth();
			$target	=$this->uri->segment(3);
			$this->promo_model->update($target);
		}else{
			redirect('setting');
		}
	}
	function get_sort($val){
		return $this->db->get_where("tb_sort",array("nm_sort"=>$val))->row()->sql_sort;
	}
	function view(){
			$idx_promo		=$this->uri->segment(3);
			if(is_numeric($idx_promo)){
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
				$data['promo']			= $this->db->get_where("promo_management",array("idx_promo"=>$idx_promo))->row();
				/*-------CATEGORY DATA--------*/
				$data['page'] 			= $this;
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
							$where_brand=" and (b.idx_brand=$brand[$i]";
						}else{
							$where_brand=$where_brand." or b.idx_brand=$brand[$i]";
						}
					}
					$where_brand=$where_brand.")";
					$data['brand_use']			=$brand;
				}
				$where_price="";
				if($price){
					for($i=0;$i<count($price);$i++){
						if($where_price==""){
							$where_price=" and (b.harga_discount ".$this->additional_model->get_sql_price($price[$i]);
						}else{
							$where_price=$where_price." or b.harga_discount ".$this->additional_model->get_sql_price($price[$i]);
						}
					}
					$where_price=$where_price.")";
					$data['price_use']			=$price;
				}
				if($this->input->get('sort')){
					$sort='order by b.'.$this->get_sort($this->input->get('sort'));
				}else{
					$sort='order by b.idx_product';
				}
				if($this->input->get('sortby')){
					$sortby=$this->input->get('sortby');
				}else{
					$sortby='desc';
				}
				/*---kategoti produk---*/
				$whr="b.idx_product IS NOT NULL";
				$data['list_product']=$this->promo_model->list_product_promo($idx_promo,$where_brand,$where_price,$sort,$sortby);
				/*---kategoti produk---*/
				$data['site_title']	=$data['promo']->nm_promo." | ".$data['identitas']->site_title;
				$template			='demo';
				$data['template']	=$this->db->get('system')->row()->template;
				$this->load->view('template/'.$template.'/promo',$data);
			}else{
				redirect('page');
			}
	}
	function syarat(){
		$data['assets']		=$this->config->item('assets');
		$template			='demo';
		$data['city']		=$this->db->get('free_shipping_city');
		$data['template']	=$this->db->get('system')->row()->template;
		$this->load->view('template/'.$template.'/aturan',$data);
	}
	function breadcrumb($sub_parent){
		if($sub_parent<>""){
			$explode 		=explode(".", $sub_parent);
			$breadcrumb='<ul class="breadcrumb">';
			$x = 0;
			for ($i = 0; $i < count($explode); $i++) {
				$class="";
				if ($i == count($explode)-1) {
					$class="class='active'";
				}
				$nm_category	=$this->additional_model->look_element_category("nm_categrory_product",$explode[$i]);
				$breadcrumb=$breadcrumb.'<li '.$class.'><a href="#" style="cursor: default;">'.$nm_category.'</a></li>';
			}
			$breadcrumb=$breadcrumb.'</ul>';
		}
		return $breadcrumb;
	}
}
