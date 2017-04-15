<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class transaksi extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('additional_model');
		if($this->additional_model->status()==0){
			redirect('suspend');
		}
		$this->load->model('transaksi_model');
		$this->load->helper(array('form', 'url'));
		$this->load->library('session');
	}
	function index()
	{
		redirect('page');
	}
	function test(){
		$data['assets']		=$this->config->item('assets');
		$data['identitas'] 	= $this->additional_model->get_row('identitas');
		$data['toko'] 		= $this->additional_model->get_row('setting_toko');
		$template='demo'; 
		$data['template']	=$this->db->get('system')->row()->template;
		$this->load->view('template/'.$template.'/invoice',$data);
	}
	function template(){
		$error="";
		if((!$this->input->post('nm_domain'))||(!$this->input->post('full_name'))||
			(!$this->input->post('email'))||(!$this->input->post('password'))||
			(!$this->input->post('telepon'))||(!$this->input->post('alamat'))||
			(!$this->input->post('idx_provincy'))||(!$this->input->post('idx_city'))||
			(!$this->input->post('nm_perusahaan'))||(!$this->input->post('code_type_company'))||(!isset($_FILES['upload_identitas']['name']))){
				$error=$error.'<li>Data Belum Lengkap.</li>';
		}
		if($this->input->post('email')){
			if (!filter_var($this->input->post('email'), FILTER_VALIDATE_EMAIL)) {
						$error=$error.'<li>Email Tidak Benar</li>';
			}
		}
		if($this->input->post('telepon')){
			if (!is_numeric($this->input->post('telepon'))) {
						$error=$error.'<li>No Telepon tidak boleh ada angka.</li>';
			}
		}
		if(isset($_FILES['upload_identitas']['name'])){
			$up=$this->transaksi_model->do_upload('upload_identitas',"ID".time());
				if($up==0){
					$error=$error.'<div class="alert alert-danger"><button class="close" data-dismiss="alert">×</button><strong>Error!&nbsp;</strong>Terjadi Kesalahan pada File Identitas,Pastikan file yang anda upload sesuai kriteria!!</div>';
				}
				$upload_identitas=$this->upload->file_name;
		}
		$arrHost = @gethostbynamel($this->input->post('nm_domain').".".$this->input->post('suffix')); 
		if(!empty($arrHost)){ 
				$error=$error.'<li>Domain tidak tersedia.</li>';
		}
		if($this->transaksi_model->cek_email($this->input->post('email'))>0){
			$error=$error.'<li>Email sudah terpakai,silahkan gunakan email lain.</li>';
		}
		if($error){
			echo'<div class="error mar_b1"><p>Data error</p><ol>'.$error.'</ol></div>';
			die();		
		}
					/*$newdata['nm_domain']	= $this->input->post('nm_domain').".".$this->input->post('suffix');
					$newdata['code_paket']	= $this->uri->segment(3);
					$newdata['full_name']	= $this->input->post('full_name');
					$newdata['email']		= $this->input->post('email');
					$newdata['password']	= $this->input->post('password');
					$newdata['telepon']	= $this->input->post('telepon');
					$newdata['alamat']		= $this->input->post('alamat');
					$newdata['idx_provincy']= $this->input->post('idx_provincy');
					$newdata['idx_city']	= $this->input->post('idx_city');
					$newdata['nm_perusahaan']= $this->input->post('nm_perusahaan');
					$newdata['code_type_company']= $this->input->post('code_type_company');
					$newdata['upload_identitas']= $upload_identitas;*/
					$newdata = array(
							'nm_domain' =>$this->input->post('nm_domain').".".$this->input->post('suffix'),
						   'code_paket' =>$this->uri->segment(3),
						   'full_name' =>$this->input->post('full_name'),
						   'email' =>$this->input->post('email'),
						   'password' =>$this->input->post('password'),
						   'telepon' =>$this->input->post('telepon'),
						   'alamat' =>$this->input->post('alamat'),
						   'idx_provincy' =>$this->input->post('idx_provincy'),
						   'idx_city' =>$this->input->post('idx_city'),
						   'nm_perusahaan' =>$this->input->post('nm_perusahaan'),
						    'code_type_company' =>$this->input->post('code_type_company'),
						   'upload_identitas' =>$upload_identitas
						);
					$this->session->set_userdata($newdata);
						echo"<script>
								setTimeout(function () {
									window.location='".site_url('transaksi/template_proc')."';
								},2000);
							</script>";
					
			
	}
	function template_proc(){
		$data['assets']		=$this->config->item('assets');
		$data['identitas'] 	= $this->additional_model->get_row('identitas');
					$data['ym'] 		= $this->additional_model->get_ym();
					$data['sosial'] 	= $this->additional_model->sosial();
					$data['hubungi'] 	= $this->additional_model->hubungi();
					$data['about']	 	= $this->additional_model->about();
					$data['contact']	= $this->additional_model->contact();
					$data['template']	=$this->additional_model->template();
					if ($this->additional_model->get_fb()->num_rows() > 0){   $data['fb_account'] = $this->additional_model->get_fb()->row()->no_account; }else{$data['fb_account'] = '';}
					$data['site_title']	="Pilih Template | ".$data['identitas']->site_title;
					$this->load->view('trans_template',$data);
	}
	function checkout(){
		$data['assets']		=$this->config->item('assets');
		$data['identitas'] 	= $this->additional_model->get_row('identitas');
		$data['ym'] 		= $this->additional_model->get_ym();
		$data['sosial'] 	= $this->additional_model->sosial();
		$data['hubungi'] 	= $this->additional_model->hubungi();
		$data['about']	 	= $this->additional_model->about();
		$data['contact']	= $this->additional_model->contact();
		$data['site_title']	="Konfirmasi Pesanan | ".$data['identitas']->site_title;
		if ($this->additional_model->get_fb()->num_rows() > 0){   $data['fb_account'] = $this->additional_model->get_fb()->row()->no_account; }else{$data['fb_account'] = '';}	
		$data['nm_domain']	= $this->input->post('nm_domain');
		$data['paket']		=$this->additional_model->get_where_row('tb_paket','code',$this->input->post('code_paket'));
		$idx_template		= $this->input->post('idx_template');
		$data['template']	=$this->db->query("SELECT a.*,b.* FROM template a join tb_paket b on a.code_paket=b.code where idx_template='$idx_template'")->row();
		$data['full_name']	= $this->input->post('full_name');
		$data['email']		= $this->input->post('email');
		$data['password']	= $this->input->post('password');
		$data['telepon']	= $this->input->post('telepon');
		$data['alamat']		= $this->input->post('alamat');
		$data['provincy']	=$this->additional_model->get_where_row('provincy','idx_provincy',$this->input->post('idx_provincy'));
		$data['city']		=$this->additional_model->get_where_row('city','idx_city',$this->input->post('idx_city'));
		$data['nm_perusahaan']= $this->input->post('nm_perusahaan');
		$data['upload_identitas']=$this->input->post('upload_identitas');
		$data['type_company']=$this->additional_model->get_where_row('type_company','code',$this->input->post('code_type_company'));
		$this->load->view('checkout',$data);
	}
	function finish(){
		$this->transaksi_model->save();
		redirect('transaksi/thanks');
	}
	function thanks(){
		if($this->session->userdata('logged_in')==TRUE){
			$data['assets']		=$this->config->item('assets');
			$data['identitas'] 	= $this->additional_model->get_row('identitas');
			$data['ym'] 		= $this->additional_model->get_ym();
			$data['sosial'] 	= $this->additional_model->sosial();
			$data['hubungi'] 	= $this->additional_model->hubungi();
			$data['about']	 	= $this->additional_model->about();
			$data['contact']	= $this->additional_model->contact();
			$data['template']	=$this->additional_model->template();
			if ($this->additional_model->get_fb()->num_rows() > 0){   $data['fb_account'] = $this->additional_model->get_fb()->row()->no_account; }else{$data['fb_account'] = '';}
			$data['site_title']	="Terimakasih | ".$data['identitas']->site_title;
			$idx_pelanggan=$this->session->userdata('idx_pelanggan');
			$Qw=$this->db->query("SELECT a.*,b.* FROM `order` a join tb_paket b on a.code_paket=b.code where a.idx_pelanggan='$idx_pelanggan' order by a.idx_order desc limit 1")->row();
			$data['id_pesanan']	=$Qw->id_pesanan;
			$data['minimal_durasi']		=$Qw->minimal_durasi;
			$data['harga']	=$Qw->harga;
			$data['nm_paket']	=$Qw->nm_paket;
			$data['total']	=$data['minimal_durasi'] * $data['harga'];
			$this->load->view('thanks',$data);
		}else{
			redirect('page');
		}
	}
	
}
