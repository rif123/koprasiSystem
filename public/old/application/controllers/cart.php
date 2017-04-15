<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class cart extends CI_Controller {
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
		$data['assets']			=$this->config->item('assets');
		$data['identitas'] 		= $this->additional_model->get_row('identitas');
		$data['fl_promo'] 		= $this->page_model->fl_promo();
		$data['fl_wishlist']	= $this->page_model->fl_wishlist();
		$data['fl_secure'] 		= $this->page_model->fl_secure();
		$data['promo_banner']	= $this->page_model->promo_banner();
		$data['ym'] 			= $this->page_model->get_ym();
		$data['contact']		= $this->page_model->contact();
		$data['acc'] 			= $this->page_model->get_acc();
		$data['menu_bawah']		= $this->page_model->menu_bawah();
		$data['menu'] 			= $this->page_model->create_menu();
		/*---Check Promo Pembelian---*/
		$data['discount_pembelian'] = $this->page_model->discount_pembelian();
		/*---Check Promo Pembelian---*/
		$data['cart']			=$this;
		$template				='demo';
		$data['template']		=$this->db->get('system')->row()->template;
		$data['site_title']		="Daftar Pesanan | ".$data['identitas']->site_title;
		$this->load->view('template/'.$template.'/cart',$data);
	}
	function nm_category($key){
		$pc				=explode("/",$key);
		$idx_category	=$pc[0];
		return $this->db->get_where("category_product",array("idx_category_product"=>$pc[0]))->row()->nm_categrory_product;
	}
	function get_wh($idx){
		return $this->db->get_where("product", array("idx_product" =>$idx))->row();
	}
	function update(){
		$qty			=$this->input->post('qty');
		$add_val		=$this->input->post('add_val');
		$error_loop		=0;
		$error			=0;
		for($i=0;$i<count($add_val);$i++){
			$pc	=explode("||",$add_val[$i]);
			$elm_product	=$this->db->get_where("product", array("idx_product" =>$pc[1]))->row();
			if($elm_product->type_product==3){
				$q		=$this->db->get_where("attribute_product", array("idx_product" =>$elm_product->idx_product))->row();
				$stock	=$q->stock -  $q->stock_akhir;
				if($qty[$i]>$stock){
					$error_loop	=1;
					$error		=1;
				}
			}else{
				$q		=$this->db->get_where("attribute_product", array("idx_attribute_product" =>$pc[2]))->row();
				$stock	=$q->stock -  $q->stock_akhir;
				if($qty[$i]>$stock){
					$error_loop	=1;
					$error		=1;
				}
			}
			$data = array('rowid'=> $pc[0],'qty' =>$qty[$i]);
			if($error_loop==0){
				$this->cart->update($data);
			}
			$error_loop=0;
		}
		if($error==0){
			echo'{"message":"Pesanan berhasil diperbaharui","error":0}';
		}else{
			echo'{"message":"Jumlah beli melebihi stok","error":1}';
		}
	}
	function promo_bogof($idx){
		return $this->db->query("SELECT bogof_caption FROM `content_prom` where idx_promo=2 and idx_product='$idx'");
	}
	function promo_ongkir($idx){
		return $this->db->query("SELECT * FROM `content_prom` where idx_promo=5 and idx_product='$idx'")->num_rows();
	}
	function promo_persentasi($idx_product){
		if($this->page_model->check_promo($idx_product)->num_rows()>0)
		{
			$pr=$this->page_model->check_promo($idx_product)->row();
			if($pr->idx_type_promo==1){
				return $pr->discount;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	function delete(){
		$data = array(
            'rowid'   => $this->uri->segment(3),
            'qty'     => 0
        );
		$this->cart->update($data);
		redirect('cart');
	}

}
