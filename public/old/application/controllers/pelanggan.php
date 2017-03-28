<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class pelanggan extends CI_Controller {
	private $MAIN_URL;
	function __construct(){
		parent::__construct();
		$this->load->model('pelanggan_model');
		$this->load->model('additional_model');
		if($this->additional_model->status()==0){
			redirect('suspend');
		}
		include"./fsy/url_induk.php";
		$this->MAIN_URL = $MAIN_URL;
	}
	function index()
	{
		$this->auth();
		$this->pelanggan();
		
	}
	function auth(){
		if(($this->session->userdata('set_login')==FALSE)){
			redirect('admin');
		}
	}
	function auth_wishlist(){
		if($this->db->get("system")->row()->fl_wishlist<>1){
			redirect('dashboard');
		}
	}
	function message()
	{
		$this->auth();
		$data['assets']			=$this->config->item('assets');
		$data['site_title']		="Pesan Masuk";
		if($this->uri->segment(3)=="new"){
			$data['source']			=site_url('pelanggan/list_message/new');
		}else{
			$data['source']			=site_url('pelanggan/list_message');
		}
		$data['content_admin']	="admin/pelanggan/message/list";
		$this->load->view('admin/index',$data);
	}
	function wishlist()
	{
		$this->auth_wishlist();
		$this->auth();
		$data['assets']			=$this->config->item('assets');
		$data['site_title']		="Daftar Wishlist";
		$data['content_admin']	="admin/pelanggan/wishlist/list";
		$this->load->view('admin/index',$data);
	}
	function tulis_newsletter()
	{
		$this->auth();
		$data['assets']			=$this->config->item('assets');
		$data['site_title']		="Tulis Newsletter";
		$data['content_admin']	="admin/pelanggan/newsletter_pelanggan/add";
		$this->load->view('admin/index',$data);
	}
	function change_template()
	{
		$this->auth();
		$data['assets']			=$this->config->item('assets');
		$data['site_title']		="Request Ganti Template";
		if($this->db->get('system')->num_rows()>0){
			$Q						=$this->db->get('system')->row();
			$data['id_pesanan']		=$Q->id_pesanan;
			$data['code_paket']		=$Q->paket;
		}else{
			$data['id_pesanan']		='';
			$data['code_paket']		='';
		}
		$data['content_admin']	="admin/pelanggan/template/list";
		$this->load->view('admin/index',$data);
	}
	function send_newsletter(){
		$this->pelanggan_model->send_newsletter();
	}
	function update_newsletter(){
		$this->pelanggan_model->update_newsletter();
	}
	function newsletter()
	{
		$this->auth();
		$data['assets']			=$this->config->item('assets');
		$data['site_title']		="Newsletter";
		$data['content_admin']	="admin/pelanggan/newsletter/list";
		$this->load->view('admin/index',$data);
	}
	function info_tagihan()
	{
		$this->auth();
		$data['assets']			=$this->config->item('assets');
		$data['site_title']		="Info Tagihan";
		$data['id_pesanan']		=$this->db->get('system')->row()->id_pesanan;
		$data['content_admin']	="admin/pelanggan/tagihan/general";
		$this->load->view('admin/index',$data);
	}
	function testimoni()
	{
		$this->auth();
		$data['assets']			=$this->config->item('assets');
		$data['site_title']		="Testimonial";
		$data['content_admin']	="admin/pelanggan/testimoni/list";
		if($this->uri->segment(3)=="new"){
			$data['source']			=site_url('pelanggan/list_testimoni/new');
		}else{
			$data['source']			=site_url('pelanggan/list_testimoni');
		}
		$this->load->view('admin/index',$data);
	}
	function newsletter_save(){
		$this->pelanggan_model->newsletter_save();
	}
	function reset_profile(){
		$this->pelanggan_model->reset_profile();
	}
	function rate()
	{
		if(($this->session->userdata('set_login')==TRUE)){
			$data['assets']			=$this->config->item('assets');
			$data['site_title']		="Rating Product";
			if($this->uri->segment(3)=="new"){
				$data['source']			=site_url('pelanggan/list_rate/new');
			}else{
				$data['source']			=site_url('pelanggan/list_rate');
			}
			$data['content_admin']	="admin/pelanggan/rate/list";
			$this->load->view('admin/index',$data);
		}else{
			redirect('admin');
		}
	}
	function act_upgrade(){
		$error="";
		if((!$this->input->post('paket'))||(!$this->input->post('email'))||(!$this->input->post('telepon'))||(!$this->input->post('idx_template')))
			{
				$error=$error.'<p class="error_point">- Silahkan Lengkapi Data!</p>';
			}
		if (!filter_var($this->input->post('email'), FILTER_VALIDATE_EMAIL)) {
			$error=$error.'<p class="error_point">- Email Harus Sesuai Kriteria</p>';
		}
		if(!is_numeric($this->input->post('telepon'))){
			$error=$error.'<p class="error_point">- No Telepon Tidak Boleh Huruf</p>';
		}

		if($error<>""){
			echo '<div class="message error" style="padding: 5px 20px;margin: 0 20px;color:#D12626;font-size: 11px;">Error! '.$error.'</div>';
			die();
		}
				echo "<script>$.ajax({
						url: '".$this->MAIN_URL."/pelanggan/upgrade_save',
						data: $('#form_input').serialize(),
						type: 'POST',
						dataType: 'json'
						});
					</script>";
					echo'<div class="alert alert-success"><strong>Success!</strong>Terima kasih, Customer service kami akan segera menghubungi anda secepat nya .</div>';
				echo "<script>
					setTimeout(function () {
						window.location='".site_url('dashboard')."';
					},1000);
				</script>";
	}
	function act_template(){
		$error="";
		if((!$this->input->post('telepon'))||(!$this->input->post('idx_template')))
			{
				$error=$error.'<p class="error_point">- Silahkan Lengkapi Data!</p>';
			}
		if(!is_numeric($this->input->post('telepon'))){
			$error=$error.'<p class="error_point">- No Telepon Tidak Boleh Huruf</p>';
		}
		if($error<>""){
			echo '<div class="message error" style="padding: 5px 20px;margin: 0 20px;color:#D12626;font-size: 11px;">Error! '.$error.'</div>';
			die();
		}
				echo "<script>$.ajax({
						url: '".$this->MAIN_URL."/pelanggan/upgrade_template',
						data: $('#form_input').serialize(),
						type: 'POST',
						dataType: 'json'
						});
					</script>";
					echo'<div class="alert alert-success"><strong>Success!</strong>Terima kasih, Customer service kami akan segera menghubungi anda secepat nya .</div>';
				echo "<script>
					setTimeout(function () {
						window.location='".site_url('dashboard')."';
					},1000);
				</script>";
	}
	function upgrade()
	{
		$this->auth();
		$data['assets']			=$this->config->item('assets');
		$data['site_title']		="Upgrade Paket";
		if($this->db->get('system')->num_rows()>0){
			$data['id_pesanan']		=$this->db->get('system')->row()->id_pesanan;
			$data['paket']			=$this->db->get('system')->row()->paket;
		}else{
			$data['id_pesanan']		='';
			$data['paket']			='';
		}
		$data['content_admin']	="admin/pelanggan/upgrade/general";
		$this->load->view('admin/index',$data);
	}
	function pesan_banner_logo()
	{
		$this->auth();
		$data['assets']			=$this->config->item('assets');
		$data['site_title']		="Pesan Banner / Logo";
		if($this->db->get('system')->num_rows()>0){
			$data['id_pesanan']		=$this->db->get('system')->row()->id_pesanan;
		}else{
			$data['id_pesanan']		='';
		}
		$data['content_admin']	="admin/pelanggan/pesan_banner_logo/general";
		$this->load->view('admin/index',$data);
	}
	function pelanggan()
	{
		$this->auth();
		$data['assets']			=$this->config->item('assets');
		$data['site_title']		="Data Pelanggan";
		$data['content_admin']	="admin/pelanggan/info_pelanggan/list";
		$this->load->view('admin/index',$data);
	}
	function newsletter_pelanggan()
	{
		$this->auth();
		$data['assets']			=$this->config->item('assets');
		$data['site_title']		="Newsletter Pelanggan";
		$data['content_admin']	="admin/pelanggan/newsletter_pelanggan/list";
		$this->load->view('admin/index',$data);
	}
	function list_history_pelanggan(){
		$this->pelanggan_model->list_history_pelanggan();
	}
	function publish(){
		$this->pelanggan_model->publish();
	}
	function list_rate(){
		$this->pelanggan_model->list_rate();
	}
	function list_pelanggan(){
		$this->pelanggan_model->list_pelanggan();
	}
	function list_wishlist(){
		$this->pelanggan_model->list_wishlist();
	}
	function list_content_newsletter(){
		$this->pelanggan_model->list_content_newsletter();
	}
	function list_newsletter(){
		$this->pelanggan_model->list_newsletter();
	}
	function list_riwayat_pesanan(){
		$this->pelanggan_model->list_riwayat_pesanan();
	}
	function list_message(){
		$this->pelanggan_model->list_message();
	}
	function list_testimoni(){
		$this->pelanggan_model->list_testimoni();
	}
	function approve_testimoni(){
		$this->pelanggan_model->approve_testimoni();
	}
	function tolak_testimoni(){
		$this->pelanggan_model->tolak_testimoni();
	}
	function delete(){
		$this->auth();
		$target	=$this->uri->segment(3);
		$idx	=$this->uri->segment(4);
		$this->pelanggan_model->delete($target,$idx);
	}
	function edit(){
		$this->auth();
		$target	=$this->uri->segment(3);
		$idx	=$this->uri->segment(4);
		$data['assets']			=$this->config->item('assets');
		if($target=="newsletter"){
			$data['site_title']		="Edit Newsletter";
			$data['content_admin']	="admin/pelanggan/newsletter_pelanggan/edit";
			$data['Result_form'] 	= $this->additional_model->get_where_row('content_newsletter','idx_content_newsletter',$idx);
			$this->load->view('admin/index',$data);
		}
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
	function view(){
		$this->auth();
		$target					=$this->uri->segment(3);
		$idx					=$this->uri->segment(4);
		$data['assets']			=$this->config->item('assets');
		$data['pelanggan']		=$this;
		if($target=="message"){
			$this->pelanggan_model->update_status($idx,1);
			$data['site_title']		="Baca Pesan";
			$data['content_admin']	="admin/pelanggan/message/edit";
			$data['Result_form'] 	= $this->additional_model->get_where_row('message','idx_message',$idx);
			$this->load->view('admin/index',$data);
		}
		if($target=="newsletter"){
			$this->pelanggan_model->update_status_newsletter($idx,1);
			$data['site_title']		="Baca Newsletter";
			$data['content_admin']	="admin/pelanggan/newsletter/edit";
			$data['Result_form'] 	= $this->additional_model->get_where_row('newsletter','idx_newsletter',$idx);
			$data['lampiran']		=$this->db->get_where("lampiran",array("idx_newsletter"=>$idx));
			$this->load->view('admin/index',$data);
		}
		if($target=="pelanggan"){
			$data['site_title']		="Riwayat Pemesanan Pelanggan";
			$data['content_admin']	="admin/pelanggan/info_pelanggan/view";
			$data['idx_pelanggan']	=$idx;
			$data['Result_form'] 	= $this->db->get_where("pelanggan",array("idx_pelanggan"=>$idx))->row();
			$this->load->view('admin/index',$data);
		}
		if($target=="testimoni"){
			$data['site_title']		="Approve Testimonial";
			$data['content_admin']	="admin/pelanggan/testimoni/edit";
			$data['Result_form'] 	= $this->additional_model->get_testimoni($idx);
			$this->load->view('admin/index',$data);
		}
		if($target=="wishlist"){
			$this->auth_wishlist();
			$data['pelanggan']		=$this;
			$data['site_title']		="Lihat Wishlist";
			$data['content_admin']	="admin/pelanggan/wishlist/view";
			$data['Result_form'] 	= $this->db->get_where("wishlist",array("idx_wishlist"=>$idx))->row();
			$this->load->view('admin/index',$data);
		}
	}
	function show_product(){
		$this->auth();
		$this->load->model('transaksi_model');
		$data['assets']			=$this->config->item('assets');
		$data['list_product']	= $this->transaksi_model->get_list($this->uri->segment(3));
		$data['order']			= $this->db->get_where("order",array("idx_order"=>$this->uri->segment(3)))->row();
		/*---Check Promo Pembelian---*/
		$data['discount_pembelian'] = $this->pelanggan_model->discount_pembelian();
		/*---Check Promo Pembelian---*/
		$data['pelanggan']			=$this;
		$this->load->view("admin/pelanggan/info_pelanggan/list_cus_product",$data);
	}
	function cek_bogof($idx){
		return $this->db->query("select a.*,b.idx_type_promo from content_prom a join promo_management b on a.idx_promo=b.idx_promo where a.idx_product='$idx' and b.idx_type_promo=2");
		
	}
	function convert_expedisi($expedisi){
		$this->load->model('order_model');
		return $this->order_model->convert_expedisi($expedisi);
	}
	function balas(){
		$this->pelanggan_model->balas();
	}
	function testimoni_proses(){
		$this->pelanggan_model->testimoni_proses();
	}
	function save(){
		$this->auth();
		$target	=$this->uri->segment(3);
		$this->pelanggan_model->save($target);
	}
	function update(){
		$this->auth();
		$target	=$this->uri->segment(3);
		$this->pelanggan_model->update($target);
	}
	function look_city(){
		$idx_provincy=$this->input->post('idx_provincy');
		$this->pelanggan_model->look_city($idx_provincy);
	
	}
	function get_elm($tb,$idx,$key){
		$q		=$this->db->get_where($tb, array($idx =>$key))->row();
		return $q;
	}
	function stock_available($idx_attribute_product,$idx_product,$qty){
		return $this->pelanggan_model->stock_available($idx_attribute_product,$idx_product,$qty);
	}
	function get_elm_loop($tb,$idx,$key){
		$q		=$this->db->get_where($tb, array($idx =>$key));
		return $q;
	}
	function check_promo($idx_product){
		$q=$this->db->query("select a.idx_type_promo,b.* from promo_management a join content_prom b on a.idx_promo=b.idx_promo where b.idx_product='$idx_product' and a.idx_type_promo='1'");
		return $q;
	}
}
