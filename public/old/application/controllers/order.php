<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class order extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('order_model');
		$this->load->model('additional_model');
		if($this->additional_model->status()==0){
			redirect('suspend');
		}
	}
	function index()
	{
		$this->order();
		
	}
	function auth(){
		if(($this->session->userdata('set_login')==FALSE)){
			redirect('admin');
		}
	}
	function order()
	{
		$this->auth();
		$data['assets']			=$this->config->item('assets');
		if($this->uri->segment(3)=="unpaid"){
			$data['site_title']		="Pesanan Menunggu Pembayaran";
			$data['source']			=site_url('order/list_order/unpaid');
		}else if($this->uri->segment(3)=="unverify"){
			$data['site_title']		="Pesanan Menunggu Verifikasi";
			$data['source']			=site_url('order/list_order/unverify');
		}else if($this->uri->segment(3)=="valid"){
			$data['site_title']		="Pesanan Sudah Berbayar";
			$data['source']			=site_url('order/list_order/valid');
		}else if($this->uri->segment(3)=="process"){
			$data['site_title']		="Pesanan Dikemas";
			$data['source']			=site_url('order/list_order/process');
		}else if($this->uri->segment(3)=="no_resi"){
			$data['site_title']		="Pesanan Dikirim";
			$data['source']			=site_url('order/list_order/no_resi');
		}else if($this->uri->segment(3)=="finish"){
			$data['site_title']		="Pesanan Selesai";
			$data['source']			=site_url('order/list_order/finish');
		}else if($this->uri->segment(3)=="all"){
			$data['site_title']		="Data Semua Pesanan";
			$data['source']			=site_url('order/list_order/all');
		}else{
			$data['site_title']		="Pesanan Terbaru";
			$data['source']			=site_url('order/list_order');
		}
		$data['target']			=$this->uri->segment(3);
		$data['content_admin']	="admin/transaksi/order/list";
		$this->load->view('admin/index',$data);
	}
	function refund()
	{
		$this->auth_refund();
		$this->auth();
		$data['assets']			=$this->config->item('assets');
		$data['site_title']		="Pengembalian Barang";
		$data['content_admin']	="admin/transaksi/refund/list";
		$this->load->view('admin/index',$data);
	}
	function auth_refund(){
		$fl_refund	=$this->db->get('setting_toko')->row()->fl_refund;
		if($fl_refund==0){
			redirect('dashboard');
		}
	}
	function resi()
	{
		$this->auth();
			$data['assets']			=$this->config->item('assets');
			$data['site_title']		="Resi Pesanan";
			$data['content_admin']	="admin/transaksi/resi/list";
			$this->load->view('admin/index',$data);
	}
	function check_promo($idx){
		return $this->order_model->check_promo($idx);
	}
	function cek_berat($berat){
			$berat=$berat/1000;
			$b=explode(".",$berat);
			if(count($b)>1){
				$q=$b[count($b)-1];
				$q=substr($q,0,1);
				if($q<=3){
					$kal_berat=round($berat);
				}else{
					$kal_berat=round($berat)+1;
				}
			}else{
				$kal_berat=$berat;
			}
				return $kal_berat;
	}
	function confirm()
	{
		$this->auth();
		$data['assets']			=$this->config->item('assets');
		if($this->uri->segment(3)=="valid"){
			$data['site_title']		="Riwayat Konfirmasi";
			$data['source']			=site_url('order/list_confirm/valid');
		}else if($this->uri->segment(3)=="all"){
			$data['site_title']		="Data Semua Konfirmasi Pembayaran";
			$data['source']			=site_url('order/list_confirm/all');
		}else{
			$data['site_title']		="Konfirmasi Terbaru";
			$data['source']			=site_url('order/list_confirm');
		}
		$data['target']			=$this->uri->segment(3);
		$data['content_admin']	="admin/transaksi/confirm/list";
		$this->load->view('admin/index',$data);
	}
	function convert_expedisi($expedisi){
		return $this->order_model->convert_expedisi($expedisi);
	}
	function DateToIndo($date){
		return $this->order_model->DateToIndo($date);
	}
	function list_order(){
		$this->order_model->list_order();
	}
	function list_refund(){
		$this->auth_refund();
		$this->order_model->list_refund();
	}
	function cek_bogof($idx){
		return $this->db->query("select a.*,b.idx_type_promo from content_prom a join promo_management b on a.idx_promo=b.idx_promo where a.idx_product='$idx' and b.idx_type_promo=2");
		
	}
	function list_confirm(){
		$this->order_model->list_confirm();
	}
	function list_resi(){
		$this->order_model->list_resi();
	}
	function cek_kota_free($kota){	
		$this->order_model->cek_kota_free($kota);
	}
	function get_shipping_order($kota,$kec){
		return $this->order_model->get_shipping_order($kota,$kec);
	}
	function edit(){
		$this->auth();
		$target	=$this->uri->segment(3);
		$idx	=$this->uri->segment(4);
		$data['assets']			=$this->config->item('assets');
		$data['order']			=$this;
		if($target=="order"){
			$data['site_title']	="Ubah Status Pesanan";
			$data['fl_refund']	=	$this->db->get('setting_toko')->row()->fl_refund;
			$data['content_admin']	="admin/transaksi/order/edit";
			$data['Result_form'] 	=$this->order_model->get_order($idx);
			$data['discount_pembelian'] = $this->order_model->discount_pembelian();
			$data['product']	=$this->order_model->get_order_product($idx);
			$this->load->view('admin/index',$data);
		}
		if($target=="refund"){
			$this->auth_refund();
			$this->order_model->update_refund($idx);
		}
	}
	function print_faktur_penjualan(){
		$this->auth();
		$idx_order			=$this->uri->segment(3);
		$data['Qorder']		=$this->db->get_where("order",array("idx_order"=>$idx_order))->row();
		$data['toko']		=$this->db->get('setting_toko')->row();
		$data['pengirim']	=$this->db->get_where("pelanggan",array("idx_pelanggan"=>$data['Qorder']->idx_pelanggan))->row();
		if($data['Qorder']->fl_drop_shipper==0){
			$data['pelanggan']	=$this->db->get_where("pelanggan",array("idx_pelanggan"=>$data['Qorder']->idx_pelanggan))->row();
		}else{
			$data['pelanggan']	=$this->db->get_where("drop_shipper",array("idx_drop_shipper"=>$data['Qorder']->idx_drop_shipper))->row();
		}
		$data['product']	=$this->db->query("select a.qty,a.discount as discount_order,b.* from rl_order a join product b on a.idx_product=b.idx_product where a.idx_order='$idx_order'");
		$data['order']		=$this;
		$html=$this->load->view('admin/transaksi/order/cetakan',$data,true);
		$this->generate_pdf($html,"Faktur_penjualan".$idx_order);
	}
	function print_form_pengembalian(){
		$this->auth();
		$idx_order			=$this->uri->segment(3);
		$data['Qorder']		=$this->db->get_where("order",array("idx_order"=>$idx_order))->row();
		$data['toko']		=$this->db->get('setting_toko')->row();
		$data['pengirim']	=$this->db->get_where("pelanggan",array("idx_pelanggan"=>$data['Qorder']->idx_pelanggan))->row();
		if($data['Qorder']->fl_drop_shipper==0){
			$data['pelanggan']	=$this->db->get_where("pelanggan",array("idx_pelanggan"=>$data['Qorder']->idx_pelanggan))->row();
		}else{
			$data['pelanggan']	=$this->db->get_where("drop_shipper",array("idx_drop_shipper"=>$data['Qorder']->idx_drop_shipper))->row();
		}
		$data['product']	=$this->db->query("select a.qty,a.discount as discount_order,b.* from rl_order a join product b on a.idx_product=b.idx_product where a.idx_order='$idx_order'");
		$data['order']		=$this;
		$html=$this->load->view('admin/transaksi/order/refund',$data);
		//$this->generate_pdf($html,"Form Pengembalian");
	}
	function generate_pdf($html,$name){
		require("./inc/dompdf_config.inc.php");
		$dompdf = new DOMPDF();
		$dompdf->load_html($html);
		$dompdf->set_paper('a5','potrait');
		$font = Font_Metrics::get_font("Arial", "normal");
		$dompdf->render();
		$dompdf->stream($name.".pdf");
		exit(0);
	}
	function verifikasi(){
		$this->order_model->verifikasi();
	}
	function view(){
		$this->auth();
		$target					=$this->uri->segment(3);
		$idx					=$this->uri->segment(4);
		$data['assets']			=$this->config->item('assets');
		$data['order']			=$this;
		if($target=="order"){
			$data['content_admin']	="admin/transaksi/order/view";
			$data['fl_refund']	=	$this->db->get('setting_toko')->row()->fl_refund;
			$data['Result_form'] 	=$this->order_model->get_order($idx);
			$data['product']	=$this->order_model->get_order_product($idx);
			$data['discount_pembelian'] = $this->order_model->discount_pembelian();
			if($this->uri->segment(5)=="unpaid"){
				$data['site_title']		="Pesanan Menunggu Pembayaran";
				$data['back']			=site_url('order/order/unpaid');
			}else if($this->uri->segment(5)=="unverify"){
				$data['site_title']		="Pesanan Menunggu Verifikasi";
				$data['back']			=site_url('order/order/unverify');
			}else if($this->uri->segment(5)=="valid"){
				$data['site_title']		="Pesanan Sudah Berbayar";
				$data['back']			=site_url('order/order/valid');
			}else if($this->uri->segment(5)=="process"){
				$data['site_title']		="Pesanan Dikemas";
				$data['back']			=site_url('order/order/process');
			}else if($this->uri->segment(5)=="no_resi"){
				$data['site_title']		="Pesanan Dikirim";
				$data['back']			=site_url('order/order/no_resi');
			}else if($this->uri->segment(5)=="finish"){
				$data['site_title']		="Pesanan Selesai";
				$data['back']			=site_url('order/order/finish');
			}else if($this->uri->segment(5)=="all"){
				$data['site_title']		="Data Semua Pesanan";
				$data['back']			=site_url('order/order/all');
			}else{
				$data['site_title']		="Pesanan Terbaru";
				$data['back']			=site_url('order/order');
			}
			$this->load->view('admin/index',$data);
		}
		if($target=="confirm"){
			$data['site_title']			="Lihat Konfirmasi Terbaru";
			$data['content_admin']		="admin/transaksi/confirm/view";
			$data['Result_form'] 		=$this->order_model->get_order($idx);
			$data['product']			=$this->order_model->get_order_product($idx);
			$data['discount_pembelian'] = $this->order_model->discount_pembelian();
			$data['confirm'] 			= $this->order_model->get_confirm($this->uri->segment(5));
			$data['target']				=$target;
			$this->load->view('admin/index',$data);
		}
		if($target=="confirm_valid"){
			$data['site_title']			="Lihat Riwayat Konfirmasi";
			$data['content_admin']		="admin/transaksi/confirm/view";
			$data['Result_form'] 		=$this->order_model->get_order($idx);
			$data['product']			=$this->order_model->get_order_product($idx);
			$data['discount_pembelian'] = $this->order_model->discount_pembelian();
			$data['confirm'] 			= $this->order_model->get_confirm($this->uri->segment(5));
			$data['target']				=$target;
			$this->load->view('admin/index',$data);
		}
		if($target=="confirm_all"){
			$data['site_title']			="Lihat Semua Konfirmasi Pembayaran";
			$data['content_admin']		="admin/transaksi/confirm/view";
			$data['Result_form'] 		=$this->order_model->get_order($idx);
			$data['product']			=$this->order_model->get_order_product($idx);
			$data['discount_pembelian'] = $this->order_model->discount_pembelian();
			$data['confirm'] 			= $this->order_model->get_confirm($this->uri->segment(5));
			$data['target']				=$target;
			$this->load->view('admin/index',$data);
		}
		if($target=="refund"){
			$this->auth_refund();
			$data['site_title']			="Lihat Pengembalian Barang";
			$data['content_admin']		="admin/transaksi/refund/view";
			$data['Result_form'] 		=$this->order_model->get_order($idx);
			$data['product']			=$this->order_model->get_order_product($idx);
			$data['discount_pembelian'] = $this->order_model->discount_pembelian();
			$data['refund'] 			= $this->order_model->get_refund($this->uri->segment(5));
			$this->load->view('admin/index',$data);
		}
	}
	function add(){
		if(($this->session->userdata('set_login')==TRUE)){
			$data['assets']			=$this->config->item('assets');
			$data['site_title']		="Tambah Konfirmasi Pembayaran";
			$data['content_admin']	="admin/transaksi/confirm/add";
			$data['rek']			=$this->db->get('account_bank');
			$this->load->view('admin/index',$data);
		}else{
			redirect('admin');
		}
	}
	function free_ongkir($idx){
		return $this->order_model->free_ongkir($idx);
	}
	function convert_status($status){
		if($status==0){
			$status="Menunggu Pembayaran";
		}
		if($status==1){
			$status="Pesanan Diterima";
		}
		if($status==2){
			$status="Pengemasan";
		}
		if($status==3){
			$status="Dikirim";
		}
		if($status==4){
			$status="Selesai";
		}
		if($status==8){
			$status="Menunggu Verifikasi Pembayaran";
		}
		return $status;
	}
	function convert_status_refund($status){
		if($status==0){
			$status="Menunggu Proses";
		}
		if($status==1){
			$status="Selesai";
		}
		return $status;
	}	
	function update(){ 
		$this->auth();
		$this->order_model->update();
	}
	function update_resi(){ 
		$this->auth();
		$this->order_model->update_resi();
	}
	function delete(){
		$this->auth();
		$target	=$this->uri->segment(3);
		$idx	=$this->uri->segment(4);
		$this->order_model->delete($target,$idx);
	}
	function save(){
		$this->auth();
		$this->order_model->save_confirm();
	}
	function get_total(){
		$id_pesanan	=$this->input->post("id_pesanan");
		$Q=$this->db->query("select total_tagihan from `order` where id_pesanan='$id_pesanan'");
		if($Q->num_rows()>0){
			echo $Q->row()->total_tagihan;
		}else{
			echo "";
		}
	}
}
