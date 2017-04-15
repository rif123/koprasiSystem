<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class page extends CI_Controller {
	private $MAIN_URL;
	function __construct(){
		parent::__construct();
		$this->load->model('additional_model');
		$this->load->model('page_model');
		$this->load->helper(array('form', 'url'));
		$this->load->library('session');
		$this->load->library('cart');
		if($this->page_model->status()==0){
			redirect('suspend');
		}
		$fay		=array('fl_promo'=>$this->page_model->fl_promo(),
							'fl_wishlist'=>$this->page_model->fl_wishlist(),
							'fl_secure'=>$this->page_model->fl_secure(),
							'assets'=>$this->config->item('assets'),
							'identitas'=>$this->additional_model->get_row('identitas'),
							'ym'=>$this->page_model->get_ym(),
							'contact'=>$this->page_model->contact(),
							'acc'=>$this->page_model->get_acc(),
							'menu_bawah'=>$this->page_model->menu_bawah(),
							'menu'=>$this->page_model->create_menu(),
							'template'=>$this->db->get('system')->row()->template
						   );
		$this->load->vars($fay);
		include"./fsy/url_induk.php";
		$this->MAIN_URL = $MAIN_URL;
	}
	function index()
	{
		$identitas				= $this->additional_model->get_row('identitas');
		$data['list_product']	= $this->page_model->list_product_home();
		$data['best_seller']	= $this->page_model->best_seller();
		$data['promo_slide']	= $this->page_model->promo_slide();
		$data['promo_banner']	= $this->page_model->promo_banner();
		$data['cart']			= $this->page_model->display_cart();
		$data['site_title']		= "Home | ".$identitas->site_title;
		$data['page'] 			= $this;
		$template				='demo';
		$this->load->view('template/'.$template.'/index',$data);
	}
	function nm_category($key){
		$pc				=explode("/",$key);
		$idx_category	=$pc[0];
		return $this->db->get_where("category_product",array("idx_category_product"=>$pc[0]))->row()->nm_categrory_product;
	}
	function forgot(){
		if(($this->session->userdata('set_login_cus')==FALSE)){
			$identitas 		= $this->additional_model->get_row('identitas');
			$data['cart']			= $this->page_model->display_cart();
			$template='demo';
			$data['site_title']="Lupa Password | ".$identitas->site_title;
			$this->load->view('template/'.$template.'/forgot',$data);
		}else{
			redirect('page');
		}
		
	}
	function syarat_dan_ketentuan(){
			$identitas 		= $this->additional_model->get_row('identitas');
			$data['cart']			= $this->page_model->display_cart();
			$template='demo';
			$data['site_title']="Ketentuan dan Syarat | ".$identitas->site_title;
			$this->load->view('template/'.$template.'/syarat',$data);
		
	}
	function shop(){
			$identitas 	= $this->additional_model->get_row('identitas');
			$data['cart']			= $this->page_model->display_cart();
			/*-------CATEGORY DATA--------*/
			$data['category_product']		=$this->db->get('category_product');
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
			$whr="idx_product IS NOT NULL";
			$data['list_product']=$this->additional_model->list_product($whr,$where_brand,$where_price,$sort,$sortby);
			/*---kategoti produk---*/
			$data['site_title']	="Katalog | ".$identitas->site_title;
			$template='demo';
			$this->load->view('template/'.$template.'/shop',$data);
	}
	function get_nm($idx){
		return $this->db->get_where("category_product",array("idx_category_product"=>$idx))->row()->nm_categrory_product;
	}
	function get_sort($val){
		return $this->db->get_where("tb_sort",array("nm_sort"=>$val))->row()->sql_sort;
	}
	function search(){
		$data['key']			=$this->input->get('key');
		if($data['key']){
			$identitas 	= $this->additional_model->get_row('identitas');
			$data['cart']			= $this->page_model->display_cart();
			/*-------PRODUCT DATA--------*/
			$data['list_product_search']=$this->page_model->list_product_search($data['key']);
			/*-------END PRODUCT DATA--------*/
			$data['page']	=$this;
			$data['site_title']	="Katalog | ".$identitas->site_title;
			$template='demo';
			$this->load->view('template/'.$template.'/search',$data);
		}else{
			redirect('page');
		}
	}
	function json_product(){
		$Q=$this->db->query("select * from product order by idx_product desc limit 8");
		$html="";
		foreach($Q->result() as $wp){
			$harga_discount='';
			$harga='Rp. '.number_format($wp->harga,0,',','.');
			$discount		='';
			if($this->check_promo($wp->idx_product)->num_rows()>0)
			{
				$pr=$this->check_promo($wp->idx_product)->row();
					if($pr->idx_type_promo==1){
						$harga_discount	='<span class="old_price">Rp. '.number_format($wp->harga,0,',','.').'</span>';
						$harga			=$wp->harga-($wp->harga*$pr->discount/100);
						$harga			='Rp. '.number_format($harga,0,',','.');
						$discount		='<span class="reduction"><span>-'.number_format($pr->discount,0,',','').'%</span></span>';
					}
			}else{
				if($wp->discount>0){
					$harga_discount	='<span class="old_price">Rp. '.number_format($wp->harga,0,',','.').'</span>';;
					$harga			='Rp. '.number_format($wp->harga_discount,0,',','.');
					$discount		='<span class="reduction"><span>-'.number_format($wp->discount,0,',','').'%</span></span>';
				}
			}
		$html=$html.'<li class="ajax_block_product first_item">
					<div class="itemlist_left">
						<a href="'.site_url().'"target="_blank" title="'.$wp->nm_product.'" class="product_image"><img src="'.base_url().'uploads/product/'.$wp->thumb.'" alt="'.$wp->nm_product.'" height="138" width="120"></a>
					</div>
					<div class="itemlist_right">
						<p class="s_title_block"><a href="'.site_url().'" target="_blank" title="'.$wp->nm_product.'">'.$wp->nm_product.'</a></p>
						<div class="price_container mar_b10">
							<span class="price">'.$harga.'</span>
							'.$harga_discount.'
						</div>
					</div>
				</li>';
		}
		echo $html;
	}
	function json_best_product(){
		$Q=$this->db->query("select * from product where buy<>0 order by buy desc limit 8");
		$html="";
		foreach($Q->result() as $wp){
			$harga_discount='';
			$harga='Rp. '.number_format($wp->harga,0,',','.');
			$discount		='';
			if($this->check_promo($wp->idx_product)->num_rows()>0)
			{
				$pr=$this->check_promo($wp->idx_product)->row();
					if($pr->idx_type_promo==1){
						$harga_discount	='<span class="old_price">Rp. '.number_format($wp->harga,0,',','.').'</span>';
						$harga			=$wp->harga-($wp->harga*$pr->discount/100);
						$harga			='Rp. '.number_format($harga,0,',','.');
						$discount		='<span class="reduction"><span>-'.number_format($pr->discount,0,',','').'%</span></span>';
					}
			}else{
				if($wp->discount>0){
					$harga_discount	='<span class="old_price">Rp. '.number_format($wp->harga,0,',','.').'</span>';;
					$harga			='Rp. '.number_format($wp->harga_discount,0,',','.');
					$discount		='<span class="reduction"><span>-'.number_format($wp->discount,0,',','').'%</span></span>';
				}
			}
		$html=$html.'<li class="ajax_block_product first_item">
					<div class="itemlist_left">
						<a href="'.site_url().'"target="_blank" title="'.$wp->nm_product.'" class="product_image"><img src="'.base_url().'uploads/product/'.$wp->thumb.'" alt="'.$wp->nm_product.'" height="138" width="120"></a>
					</div>
					<div class="itemlist_right">
						<p class="s_title_block"><a href="'.site_url().'" target="_blank" title="'.$wp->nm_product.'">'.$wp->nm_product.'</a></p>
						<div class="price_container mar_b10">
							<span class="price">'.$harga.'</span>
							'.$harga_discount.'
						</div>
					</div>
				</li>';
		}
		echo $html;
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
	function sold_out($idx_product,$idx_type_product){
		return $this->page_model->sold_out($idx_product,$idx_type_product);
	}
	function login(){
		if($this->cart->total_items()>0){
			$identitas 		= $this->additional_model->get_row('identitas');
			$template='demo';
				if(($this->session->userdata('set_login_cus')==TRUE)){
					redirect("checkout");
				}else{
					$data['site_title']="Login - Register | ".$identitas->site_title;
					$this->load->view('template/'.$template.'/login_or_register',$data);
				}
		}else{
			redirect('shop');
		}
	}
	function daftar(){
		if(($this->session->userdata('set_login_cus')==FALSE)){
			$identitas = $this->additional_model->get_row('identitas');
			$data['cart']			= $this->page_model->display_cart();
			$template='demo';
			$data['site_title']="Register | ".$identitas->site_title;
			$this->load->view('template/'.$template.'/register',$data);
		}else{
			redirect('page');
		}
	}
	function contact(){
			$identitas = $this->additional_model->get_row('identitas');
			$data['cart']			= $this->page_model->display_cart();
			$data['promo_banner']	= $this->page_model->promo_banner();
			$template='demo';
			$data['site_title']="Tinggalkan Pesan | ".$identitas->site_title;
			$this->load->view('template/'.$template.'/contact_us',$data);
	}
	function register_newsletter(){
		$this->load->model('customer_model');
		$this->customer_model->register_newsletter();
	}
	function payment_confirm(){
			$identitas 	= $this->additional_model->get_row('identitas');
			$data['cart']			= $this->page_model->display_cart();
			$data['rek']			=$this->db->get('account_bank');
			$data['id_pesanan']		='';
			$data['total_tagihan']	='';
			if($this->input->get('q')){
				if(($this->session->userdata('set_login_cus')==TRUE)){
					$data['id_pesanan']		=$this->input->get('q');
				}
			}
			$template='demo';
			$data['site_title']="Konfirmasi Pembayaran | ".$identitas->site_title;
			$this->load->view('template/'.$template.'/confirm',$data);
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
	function auth_refund(){
		$fl_refund	=$this->db->get('setting_toko')->row()->fl_refund;
		if($fl_refund==0){
			redirect('page');
		}
	}
	function auth_wishlist(){
		$fl_wishlist	=$this->page_model->fl_wishlist();
		if($fl_wishlist==0){
			redirect('page');
		}
	}
	function my_account(){
		if(($this->session->userdata('set_login_cus')==TRUE)){
			$identitas 	= $this->additional_model->get_row('identitas');
			$data['cart']			= $this->page_model->display_cart();
			$data['akun']			= $this->additional_model->get_where_row("pelanggan","idx_pelanggan",$this->session->userdata('idx_pelanggan'));
			$data['newsletter']		= $this->db->get_where("newsletter_cus",array("email"=>$data['akun']->email))->num_rows();
			if($data['newsletter']>0){
				$data['newsletter_status']="Berlangganan Newsletter";
			}else{
				$data['newsletter_status']="Tidak Berlangganan Newsletter";
			}
			$data['Target']			=$this->uri->segment(3);
			$data['fl_refund']		=$this->db->get('setting_toko')->row()->fl_refund;
			if($this->uri->segment(3)=="address"){
				$this->load->model('transaksi_model');
				$data['shipping'] 	= $this->transaksi_model->get_shipping();
			}
			if($this->uri->segment(3)=="order_history"){
				$this->db->order_by("idx_order", "desc");
				$data['order_his']= $this->db->get_where("order",array("idx_pelanggan"=>$this->session->userdata('idx_pelanggan')));
			}
			if($this->uri->segment(3)=="laporkan"){
				$data['main_url']			=$this->MAIN_URL;
				$data['id_pelanggan']		=$this->db->get('system')->row()->id_pesanan;
			}
			if($this->uri->segment(3)=="pengembalian"){
				$this->auth_refund();
			}
			if($this->uri->segment(3)=="wishlist"){
				$this->auth_wishlist();
				$this->load->model('customer_model');
				$data['page']		=$this;
				$data['wishlist']	=$this->customer_model->get_wishlist($this->session->userdata('idx_pelanggan'));
			}
			$template='demo';
			$data['site_title']="My Account | ".$identitas->site_title;
			$this->load->view('template/'.$template.'/myaccount',$data);
		}else{
			if((base64_decode($this->input->get('q'))=="fsystem")&&(is_numeric($this->uri->segment(3))))
			{
				$this->load->model('customer_model');
				$this->customer_model->login_forgot();
			}else{
				redirect('page/login_user');
			}
			
		}
	}
	function ket_order($idx_attribute_product,$idx_product,$qty){
		if($idx_attribute_product<>0){
			$Q=$this->db->get_where("attribute_product",array("idx_attribute_product"=>$idx_attribute_product))->row();
			return $qty." ( ".$Q->desc_attribute." )";
		}else{
			$Q=$this->db->get_where("attribute_product",array("idx_product"=>$idx_product));
			$n=1;
			foreach($Q->result() as $w){
				if($n==1){
					$att=$w->desc_attribute;
				}else{
					$att=$att." | ".$w->desc_attribute;
				}
			$n++;
			}
			return $qty." ( ".$att." )";
		}
	}
	/*function stock_available($idx_attribute_product,$idx_product){
		if($idx_attribute_product<>0){
			$Q=$this->db->get_where("attribute_product",array("idx_attribute_product"=>$idx_attribute_product))->row();
			return ($Q->stock-$Q->stock_akhir)." ( ".$Q->desc_attribute." )";
		}else{
			$Q=$this->db->get_where("attribute_product",array("idx_product"=>$idx_product));
			$n=1;
			foreach($Q->result() as $w){
				if($n==1){
					$att=$w->desc_attribute;
				}else{
					$att=$att." | ".$w->desc_attribute;
				}
			$stock=$w->stock-$w->stock_akhir;
			$n++;
			}
			return $stock." ( ".$att." )";
		}
	}*/
	function convert_expedisi($expedisi){
		$this->load->model('order_model');
		return $this->order_model->convert_expedisi($expedisi);
	}
	function show_product(){
		if(($this->session->userdata('set_login_cus')==TRUE)||(!is_numeric($this->uri->segment(3)))){
			$this->load->model('transaksi_model');
			$data['list_product']	= $this->transaksi_model->get_list($this->uri->segment(3));
			$data['order']			= $this->db->get_where("order",array("idx_order"=>$this->uri->segment(3)))->row();
			/*---Check Promo Pembelian---*/
			$data['discount_pembelian'] = $this->page_model->discount_pembelian();
			/*---Check Promo Pembelian---*/
			$template				='demo';
			$data['page']			=$this;
			$this->load->view('template/'.$template.'/list_cus_product',$data);
		}else{
			redirect('page');
		}
	}
	function cek_bogof($idx){
		return $this->db->query("select a.*,b.idx_type_promo from content_prom a join promo_management b on a.idx_promo=b.idx_promo where a.idx_product='$idx' and b.idx_type_promo=2");
		
	}
	function confirm_proses(){
		$this->load->model('transaksi_model');
		$this->transaksi_model->confirm_proses();
	}
	function login_user(){
		if(($this->session->userdata('set_login_cus')==FALSE)){
			$identitas 		= $this->additional_model->get_row('identitas');
			$data['cart']			= $this->page_model->display_cart();
			$template='demo';
			$data['site_title']="Login | ".$identitas->site_title;
			$this->load->view('template/'.$template.'/login',$data);
		}else{
			redirect('page');
		}
	}
	function logout(){
		$ses = array(
						'full_name'=>'',
						'email'=>'',
						'idx_pelanggan'=> '',
						'set_login_cus'=> FALSE
					);
		$this->session->unset_userdata($ses);
		redirect('page');
	}
	function register_proses(){
		$this->load->model('customer_model');
		$this->customer_model->register_proses();
	}
	function forgot_proses(){
		$this->load->model('customer_model');
		$this->customer_model->forgot_proses();
	}
	function login_proses(){
		$this->load->model('customer_model');
		$this->customer_model->login_proses();
	}
	/*----Detail Controller------*/
	function look_stock(){
		$idx_attribute_product	=$this->input->post('idx_attribute_product');
		$q						=$this->db->get_where("attribute_product", array("idx_attribute_product" =>$idx_attribute_product))->row();
		$stock					=$q->stock -  $q->stock_akhir;
		$minimum_stock			=$this->db->query("SELECT b.minimum_stock FROM `attribute_product` a join product b on a.idx_product=b.idx_product where a.idx_attribute_product='$idx_attribute_product'")->row()->minimum_stock;
		if($stock>$minimum_stock){
			$mes="<b style='color:green;'>Tersedia</b>";
		}elseif(($stock<=$minimum_stock)&&($stock<>0)){
			$mes="<b style='color:red;'>Terbatas (".$stock." Lagi)</b>";
		}else{
			$mes="<b style='color:red;'>Sold out</b>";
		}
		echo'{"mes":"'.$mes.'","stock":"'.$stock.'"}';
	}
	function look_stock_ext($idx_attribute_product,$idx_product){
		if($idx_attribute_product<>0){
			$q						=$this->db->get_where("attribute_product", array("idx_attribute_product" =>$idx_attribute_product))->row();
		}else{
			$q						=$this->db->get_where("attribute_product", array("idx_product" =>$idx_product))->row();
		}
		$stock					=$q->stock -  $q->stock_akhir;
		$minimum_stock			=$this->db->query("SELECT minimum_stock FROM  product where idx_product='$idx_product'")->row()->minimum_stock;
		if($stock>$minimum_stock){
			$mes="<b style='color:green;'>Tersedia</b>||".$stock;
		}elseif(($stock<=$minimum_stock)&&($stock<>0)){
			$mes="<b style='color:red;'>Terbatas (".$stock." Lagi)</b>||".$stock;
		}else{
			$mes="<b style='color:red;'>Sold out</b>||".$stock;
		}
		return $mes;
	}
	function date_valid($date){
		if($date=='0000-00-00'){
			return false;
		}else{
			return true;
		}
	}
	function DateToIndo($date){
		return $this->page_model->DateToIndo($date);
	}
	function fill_jumlah(){
		$stock	=$this->input->post('stock')+1;
		$html="";
		for($i=1;$i<$stock;$i++){
			$html=$html.'<option value="'.$i.'">'.$i.'</option>';
		}
		echo $html;
	}	
	function add_cart(){
		$elm_product	=$this->db->get_where("product", array("idx_product" =>$this->input->post('idx_product')))->row();
			if($elm_product->type_product==3){
				$q		=$this->db->get_where("attribute_product", array("idx_product" =>$elm_product->idx_product))->row();
				$stock	=$q->stock -  $q->stock_akhir;
				if($stock<>0){
					if($this->input->post('jumlah_beli')<=$stock){
						$harga=$elm_product->harga_discount;
						$data = array(
							   'id'      => $this->input->post('idx_product'),
							   'qty'     => $this->input->post('jumlah_beli'),
							   'price'   => $harga,
							   'name'    => $elm_product->nm_product
							);
					}else{
						echo'{"message":"Jumlah Beli Melebihi Stok","error":1}';
						die();
					}
				}else{
					echo'{"message":"Silahkan tambahkan ke wishlist untuk pre order","error":1}';
					die();
				}
			}else{
				$q		=$this->db->get_where("attribute_product", array("idx_attribute_product" =>$this->input->post('attribute')))->row();
				$stock	=$q->stock -  $q->stock_akhir;
				if($stock<>0){
					if($this->input->post('jumlah_beli')<=$stock){
						$elm_attribute_product	=$this->db->get_where("attribute_product", array("idx_attribute_product" =>$this->input->post('attribute')))->row();
						$harga=$elm_product->harga_discount;
						$data = array(
							   'id'      => $this->input->post('idx_product'),
							   'qty'     => $this->input->post('jumlah_beli'),
							   'price'   => $harga,
							   'name'    => $elm_product->nm_product,
							   'options' => array($elm_attribute_product->idx_attribute_product => $elm_attribute_product->desc_attribute)
							);
					}else{
						echo'{"message":"Jumlah Beli Melebihi Stok","error":1}';
						die();
					}
				}else{
					echo'{"message":"Silahkan tambahkan ke wishlist untuk pre order","error":1}';
					die();
				}
			}
			if($this->cart->insert($data)){
				echo'{"message":"Berhasil ditambah ke cart","error":0}';
			}
	}
	/*----Detail Controller------*/
	function thanks(){
		if($this->session->userdata('set_login_cus')==TRUE){
			$identitas 		= $this->additional_model->get_row('identitas');
			$data['order'] 			= $this->additional_model->order($this->uri->segment(3));
			$data['site_title']		="Terimakasih | ".$identitas->site_title;
			$template				='demo';
			$this->load->view('template/'.$template.'/thanks',$data);
		}else{
			redirect('page');
		}
	}
	function view(){
		if($this->uri->segment(3)){
			$identitas 		= $this->additional_model->get_row('identitas');
			$data['cart']			= $this->page_model->display_cart();
			$template				='demo';
			$data['page']			= $this->additional_model->get_page($this->uri->segment(3));
			if($data['page']->num_rows()>0){
				$page=$data['page']->row();
				$data['site_title']	=$page->nm_page." | ".$identitas->site_title;
				$data['nm_page']	=$page->nm_page;
				$data['content']	=$page->content;
				$this->load->view('template/'.$template.'/page',$data);
			}else{
				redirect('page');
			}
			
		}else{
			redirect('page');
		}
	}
	function get_name_page($idx){
		$r=$this->additional_model->get_where_row("page","idx_page",$idx);
		return strtolower(str_replace(" ","-",$r->nm_page));
	}
	function unsubscribe(){
		if($this->input->get('p')){
			$identitas 				= $this->additional_model->get_row('identitas');
			$data['email']			=base64_decode($this->input->get('p'));
			$data['site_title']		="Berhenti Berlangganan Newsletter | ".$identitas->site_title;
			$template				='demo';
			$this->load->view('template/'.$template.'/unsubscribe',$data);
		}else{
			redirect('page');
		}
	}
}
