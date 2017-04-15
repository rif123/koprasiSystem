<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class checkout extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('additional_model');
		$this->load->model('transaksi_model');
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
		if($this->cart->total_items()>0){
			if($this->session->userdata('set_login_cus')==TRUE){
				$pelanggan			=$this->additional_model->get_where_row('pelanggan','idx_pelanggan',$this->session->userdata('idx_pelanggan'));
				$data['idx_pelanggan']=$pelanggan->idx_pelanggan;
				$data['full_name']	=$pelanggan->full_name;
				$data['password']	=$pelanggan->password;
				$data['email']		=$pelanggan->email;
				$data['hp']			=$pelanggan->hp;
				$data['no_telepon']	=$pelanggan->no_telepon;
				$data['alamat']		=$pelanggan->alamat;
				$data['zip_code']	=$pelanggan->zip_code;
				$data['provinsi']	=$pelanggan->provinsi;
				$data['kota']		=$pelanggan->kota;
				$data['kec']		=$pelanggan->kec;
				$Q					=$this->db->get_where("shipping_location",array("provinsi"=>$data['provinsi'],"kota"=>$data['kota'],"kec"=>$data['kec']));
				if($Q->num_rows>0){
					$data['zona']		=$Q->row()->zona;
					$data['city_code']	=$Q->row()->city_code;
				}else{
					$data['zona']		='';
					$data['city_code']	='';
				}
				$data['readonly']	='readonly';
			}else{
				$data['idx_pelanggan']='';
				$data['password']	='';
				$data['full_name']	='';
				$data['email']		='';
				$data['hp']			='';
				$data['no_telepon']	='';
				$data['alamat']		='';
				$data['zip_code']	='';
				$data['provinsi']	='';
				$data['kota']		='';
				$data['kec']		='';
				$data['zona']		='';
				$data['city_code']	='';
				$data['readonly']	='';
			}
			$data['from']			="cart";
			$data['idx_wishlist']	=0;
			$data['assets']			=$this->config->item('assets');
			$data['fl_promo'] 		= $this->page_model->fl_promo();
			$data['fl_wishlist']	= $this->page_model->fl_wishlist();
			$data['fl_secure'] 		= $this->page_model->fl_secure();
			$data['fl_shipping'] 	= $this->page_model->fl_shipping();
			$data['identitas'] 		= $this->additional_model->get_row('identitas');
			$data['ym'] 			= $this->page_model->get_ym();
			$data['contact']		= $this->page_model->contact();
			$data['acc'] 			= $this->page_model->get_acc();
			$data['menu_bawah']		= $this->page_model->menu_bawah();
			$data['menu'] 			= $this->page_model->create_menu();
			$data['shipping'] 		= $this->transaksi_model->get_shipping();
			/*---Check Promo Pembelian---*/
			$data['discount_pembelian'] = $this->page_model->discount_pembelian();
			/*---Check Promo Pembelian---*/
			$data['checkout']		=$this;
			$template				='demo';
			$data['template']		=$this->db->get('system')->row()->template;
			$data['site_title']="Pembayaran | ".$data['identitas']->site_title;
			$this->load->view('template/'.$template.'/checkout',$data);
		}else{
			redirect('page/shop');
		}
	}
	function wishlist(){
		if($this->session->userdata('set_login_cus')==TRUE){
				$pelanggan			=$this->additional_model->get_where_row('pelanggan','idx_pelanggan',$this->session->userdata('idx_pelanggan'));
				$data['idx_pelanggan']=$pelanggan->idx_pelanggan;
				$data['full_name']	=$pelanggan->full_name;
				$data['password']	=$pelanggan->password;
				$data['email']		=$pelanggan->email;
				$data['hp']			=$pelanggan->hp;
				$data['no_telepon']	=$pelanggan->no_telepon;
				$data['alamat']		=$pelanggan->alamat;
				$data['zip_code']	=$pelanggan->zip_code;
				$data['provinsi']	=$pelanggan->provinsi;
				$data['kota']		=$pelanggan->kota;
				$data['kec']		=$pelanggan->kec;
				$Q					=$this->db->get_where("shipping_location",array("provinsi"=>$data['provinsi'],"kota"=>$data['kota'],"kec"=>$data['kec']));
				if($Q->num_rows>0){
					$data['zona']		=$Q->row()->zona;
					$data['city_code']	=$Q->row()->city_code;
				}else{
					$data['zona']		='';
					$data['city_code']	='';
				}
				$data['readonly']	='readonly';
			}else{
				$data['idx_pelanggan']='';
				$data['password']	='';
				$data['full_name']	='';
				$data['email']		='';
				$data['hp']			='';
				$data['no_telepon']	='';
				$data['alamat']		='';
				$data['zip_code']	='';
				$data['provinsi']	='';
				$data['kota']		='';
				$data['kec']		='';
				$data['zona']		='';
				$data['city_code']	='';
				$data['readonly']	='';
			}
			$data['from']		="wishlist";
			$data['row_wishlist']	=$this->db->get_where("wishlist", array("idx_wishlist" =>$this->uri->segment(3)))->row();
			$data['idx_product']	=$data['row_wishlist']->idx_product;
			$data['idx_wishlist']	=$data['row_wishlist']->idx_wishlist;						$data['product_wishlist']=$this->db->query("SELECT a.*,b.stock-stock_akhir as total_stock FROM product a join attribute_product b on a.idx_product=b.idx_product where a.idx_product='$data[idx_product]'")->row();
			if($data['product_wishlist']->total_stock==0){				redirect('page');			}
			if($data['row_wishlist']->qty>$this->look_stock_ext($data['row_wishlist']->idx_attribute_product,$data['idx_product'])){
				$data['qty']=$this->look_stock_ext($data['row_wishlist']->idx_attribute_product,$data['idx_product']);
			}else{
				$data['qty']=$data['row_wishlist']->qty;
			}
			$data['assets']			=$this->config->item('assets');
			$data['fl_promo'] 		= $this->page_model->fl_promo();
			$data['fl_wishlist']	= $this->page_model->fl_wishlist();
			$data['fl_secure'] 		= $this->page_model->fl_secure();
			$data['fl_shipping'] 	= $this->page_model->fl_shipping();
			$data['identitas'] 		= $this->additional_model->get_row('identitas');
			$data['ym'] 			= $this->page_model->get_ym();
			$data['contact']		= $this->page_model->contact();
			$data['acc'] 			= $this->page_model->get_acc();
			$data['menu_bawah']		= $this->page_model->menu_bawah();
			$data['menu'] 			= $this->page_model->create_menu();
			$data['shipping'] 		= $this->transaksi_model->get_shipping();
			/*---Check Promo Pembelian---*/
			$data['discount_pembelian'] = $this->page_model->discount_pembelian();
			/*---Check Promo Pembelian---*/
			$data['checkout']		=$this;
			$template				='demo';
			$data['template']		=$this->db->get('system')->row()->template;
			$data['site_title']="Pembayaran | ".$data['identitas']->site_title;
			$this->load->view('template/'.$template.'/checkout',$data);
	}
	function look_stock_ext($idx_attribute_product,$idx_product){
		return $this->transaksi_model->look_stock_ext($idx_attribute_product,$idx_product);
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
	function promo_bogof($idx){
		return $this->db->query("SELECT bogof_caption FROM `content_prom` where idx_promo=2 and idx_product='$idx'");
	}
	function free_ongkir($idx){
		return $this->page_model->free_ongkir($idx);
	}
	function show_product(){
		$this->load->model('page_model');
		$data['assets']			=$this->config->item('assets');
		$data['identitas'] 		= $this->additional_model->get_row('identitas');
		$data['id'] 			= $this->uri->segment(4);
		$data['list_product']	= $this->page_model->list_product_bonus($this->uri->segment(3));
		$template='demo';
		$data['template']		=$this->db->get('system')->row()->template;
		$data['site_title']		="Pilih Produk| ".$data['identitas']->site_title;
		$this->load->view('template/'.$template.'/list_bonus_produk',$data);
	}
	function update(){
		$rowid		=$this->input->post('rowid');
		$qty		=$this->input->post('qty');
		for($i=0;$i<count($rowid);$i++){
			$data = array(
                       'rowid'   => $rowid[$i],
                       'qty'     => $qty[$i]
            );
			$this->cart->update($data);
		}
		redirect('cart');
	}
	function proses(){
		$this->transaksi_model->bayar();
	}
	function look_kecamatan(){
		$this->transaksi_model->look_kecamatan();
	}
	function look_kecamatan_account(){
		$this->transaksi_model->look_kecamatan_account();
	}
	function look_kota(){
		$this->transaksi_model->look_kota();
	}
	function kalkulasi(){
		$this->transaksi_model->kalkulasi();
	}
}
