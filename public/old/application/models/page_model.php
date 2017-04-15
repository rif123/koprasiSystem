<?php
date_default_timezone_set('Asia/Jakarta');
defined('BASEPATH') OR exit('No direct script access allowed');
class page_model extends CI_model{
		function __construct(){
			parent::__construct();
			$this->load->database();
			$this->load->helper(array('form', 'url'));
		}
		/*--------------Promo Management------------*/
		function discount_pembelian(){
			$Q=$this->db->query("select a.idx_type_promo,b.* from promo_management a join content_prom b on a.idx_promo=b.idx_promo where a.idx_type_promo=4");
			return $Q;
		}
		function discount_bogof(){
			$Q=$this->db->query("select a.idx_type_promo,b.* from promo_management a join content_prom b on a.idx_promo=b.idx_promo where a.idx_type_promo=2");
			return $Q;
		}
		function promo_slide(){
			$Q=$this->db->query("SELECT * FROM promo_management WHERE (position =1 and (tgl_awal<=CURDATE() and tgl_akhir>=CURDATE())) or (idx_type_promo=6 and position =1) or ((tgl_awal is null or tgl_akhir is null) and position =1) ORDER BY idx_promo DESC LIMIT 3");
			return $Q;
		}
		function promo_banner(){
			$Q=$this->db->query("SELECT * FROM promo_management WHERE (position =0 and (tgl_awal<=CURDATE() and tgl_akhir>=CURDATE())) or (idx_type_promo=6 and position =0) or ((tgl_awal is null or tgl_akhir is null) and position =0) ORDER BY idx_promo DESC LIMIT 3");
			return $Q;
		}
		function cek_promo_bogof($idx_product){
			$Q=$this->db->query("select a.idx_type_promo,b.* from promo_management a join content_prom b on a.idx_promo=b.idx_promo where a.idx_type_promo=2 and b.idx_product='$idx_product'")->num_rows();
			return $Q;
		}
		function free_ongkir($idx){
			return $this->db->query("SELECT * FROM content_prom	where fl_free_ongkir=1 and idx_product='$idx'")->num_rows();
		}
		function cek_brand($idx_product){
			$Q=$this->db->query("select * brand from product where idx_product='$idx_product'")->row()->brand;
			return $Q;
		}
		function check_promo($idx_product){
			$q=$this->db->query("select a.idx_type_promo,b.* from promo_management a join content_prom b on a.idx_promo=b.idx_promo where b.idx_product='$idx_product' and a.idx_type_promo='1'");
			return $q;
		}
		function list_product_bonus($idx_brand){
			$Q=$this->db->query("Select * from product where idx_brand='$idx_brand' order by idx_product desc");
			return $Q;
		}
		
		/*--------------Promo Management------------*/
		function fl_promo(){
			return $this->db->get('system')->row()->fl_promo;
		}
		function fl_wishlist(){
			return $this->db->get('system')->row()->fl_wishlist;
		}
		function status(){
			return $this->db->get('system')->row()->cd_status;
		}
		function fl_secure(){
			return $this->db->get('setting_toko')->row()->fl_secure;
		}
		function fl_shipping(){
			return $this->db->get('setting_toko')->row()->fl_ongkir;
		}
		function sold_out($idx_product,$type_product){
			$Q=$this->db->get_where("attribute_product",array("idx_product"=>$idx_product));
			if($type_product==3){
				if($Q->row()->stock-$Q->row()->stock_akhir==0){
					return true;
				}
			}else{
				$sl		=0;
					foreach($Q->result() as $w){
						if($w->stock-$w->stock_akhir==0){
							$sl=$sl+1;
						}
					}
				if($Q->num_rows()==$sl){
					return true;
				}
			}
			
		}
		function list_product_search($sc){
			$Q=$this->db->query("Select * from product where nm_product like '%$sc%' order by idx_product desc");
			return $Q;
		}
		function list_product_shop($where,$sort){
			$q=$this->db->query("select * from product $where $sort ");
			return $q;
		}
		function contact(){
			$Q = $this->db->query("select * from setting_toko ");
				return $Q;
		}
		function get_ym(){
			$Q = $this->db->query("select * from account_web ");
				return $Q;
		}
		function get_acc(){
			$Q = $this->db->query("select * from account_bank ");
				return $Q;
		}
		function get_attribute($idx){
			$Q	=$this->db->query("select * from attribute_product where idx_product='$idx'");
			return $Q;
		}
		function get_gallery($idx_product){
			$Q=$this->db->get_where('gallery',array('idx_product'=>$idx_product));
			return $Q;
		}
		function get_rate($idx){
			$Q=$this->db->get_where('rated_product',array('idx_product'=>$idx,'cd_status'=>1));
			return $Q;
		}
		function create_menu(){
			$category	=$this->db->get('category_product');
			return $category;
		}
		function list_product_home(){
			$Q=$this->db->query("Select * from product order by idx_product desc limit 10");
			return $Q;
		}
		function best_seller(){
			$Q=$this->db->query("Select * from product order by buy desc limit 10");
			return $Q;
		}
		function display_cart(){
			$total_items	=$this->cart->total_items();
			$cart='<a href="#" class="minicart_link"> <span class="item"><b>'.$total_items.'</b> ITEM / <span class="price" id="total_price"></span> </a>';
				if($total_items>0){
				 $cart=$cart.'<div class="cart_drop"> <span class="darw"></span>';
                   $cart=$cart.' <ul>';
				   $total_price=0;
					foreach($this->cart->contents() as $item){
						$elm_product	=$this->db->get_where("product", array("idx_product" =>$item['id']))->row();
						/*---Check Promo Discount---*/
						if($this->promo_persentasi($item['id'],$item['price'])<>false){
							$price=$this->promo_persentasi($item['id'],$item['price']);
						}else{
							$price		=$item['price'];
						}
						 $total_price= $total_price+$price;
						/*---Check Promo Discount---*/
						$cart=$cart.'<li><img style="width: 45px;height: 40px;" src="'.base_url().'uploads/product/'.$elm_product->thumb.'"><a href="#">'.$item['name'].'</a> <span class="price">Rp. '.number_format($price,0,',','.').'</span></li>';
					}
						 $cart=$cart.'<div class="cart_bottom">';
							 $cart=$cart.'<a href="'.site_url('cart').'" title="Lihat Pesanan" style="float: left;">Lihat Pesanan</a>';
                       $cart=$cart.'<a href="javascript:void()" onClick=window.location="'.site_url('page/login').'" title="Bayar">Bayar</a></div>';
                    $cart=$cart.'</ul>';
					$cart=$cart.'</div>';
				}
			return $cart;
		}
		function promo_persentasi($idx_product,$harga_awal){
			if($this->check_promo($idx_product)->num_rows()>0)
				{
					$pr=$this->check_promo($idx_product)->row();
					if($pr->idx_type_promo==1){
						return $harga_awal-($harga_awal*$pr->discount/100);
					}else{
						return false;
					}
				}else{
					return false;
				}
		}
		function menu_bawah(){
			$link	= $this->db->get('link_halaman');
			return $link;
		}
		function nm_pg($idx){
			$Q=$this->db->get_where("page",array("idx_page"=>$idx));
			if($Q->num_rows()>0){
				return str_replace(" ","-",strtolower($Q->row()->nm_page));
			}else{
				return false;
			}
		}
		function list_other_product($idx_product){
			$Q			=$this->db->get_where("product",array("idx_product"=>$idx_product))->row();
			$brand		=$Q->idx_brand;
			$whr="";
			if($Q->tag){
				$pcs_tag=explode(",",$Q->tag);
				$whr="";
				for($i=0;$i<count($pcs_tag);$i++){
					if($whr==""){
						$whr="or (nm_product like'%$pcs_tag[$i]%'";
					}else{
						$whr=$whr." or nm_product like'%$pcs_tag[$i]%'";
					}
				}
				if($whr!=""){
					$whr=$whr.")";
				}
			}
			return $this->db->query("select * from product where idx_brand='$brand' $whr");
		}
		function DateToIndo($date){  
			$BulanIndo = array("Januari", "Februari", "Maret",  
							   "April", "Mei", "Juni",  
							   "Juli", "Agustus", "September",  
							   "Oktober", "November", "Desember");  
		  
			$tahun = substr($date, 0, 4);  
			$bulan = substr($date, 5, 2);  
			$tgl   = substr($date, 8, 2);  
			  
			$result = $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun;       
			return($result);  
		}
}
