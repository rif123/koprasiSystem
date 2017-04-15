<?php
date_default_timezone_set('Asia/Jakarta');
defined('BASEPATH') OR exit('No direct script access allowed');
class customer_model extends CI_model{
		function __construct(){
			parent::__construct();
			$this->load->database();
			$this->load->helper(array('form', 'url'));
			$this->load->library('session');
		}
		function add_wishlist(){
			$this->load->library('session');
			$data['elm_product']=$this->db->get_where("product", array("idx_product" =>$this->input->post('idx_product')))->row();
			$data['elm_cus']	=$this->db->get_where("pelanggan", array("idx_pelanggan" =>$this->session->userdata('idx_pelanggan')))->row();
			$data['qty']		=$this->input->post('jumlah_beli');
			$data['idx_attribute_product']	=$this->input->post('attribute');
			if($data['elm_product']->type_product==3){
				$n				=$this->db->get_where("wishlist",array("idx_pelanggan"=>$this->session->userdata('idx_pelanggan'),"idx_product"=>$this->input->post('idx_product')))->num_rows();
				if($n==0){
					$ins_wishlist 	= array('idx_pelanggan' =>$this->session->userdata('idx_pelanggan'),'tgl'=>date('Y-m-d'),'idx_product' =>$this->input->post('idx_product'),'qty'=>$data['qty']);
					$this->db->insert('wishlist', $ins_wishlist);
				}
			}else{
				$elm_attribute_product	=$this->db->get_where("attribute_product", array("idx_attribute_product" =>$data['idx_attribute_product']))->row();
				$n				=$this->db->get_where("wishlist",array("idx_pelanggan"=>$this->session->userdata('idx_pelanggan'),"idx_product"=>$this->input->post('idx_product'),"idx_attribute_product"=>$data['idx_attribute_product']))->num_rows();
				if($n==0){
					$ins_wishlist 	= array('idx_pelanggan' =>$this->session->userdata('idx_pelanggan'),'tgl'=>date('Y-m-d'),'idx_product' =>$this->input->post('idx_product'),'idx_attribute_product'=>$data['idx_attribute_product'],'qty'=>$data['qty']);
					$this->db->insert('wishlist', $ins_wishlist);
				}
			}
			$data['identitas'] 	= $this->db->get('identitas')->row();
			$data['cus']		=$this;
			$template			='demo';
			$system 			= $this->db->get('system')->row();
			$config['protocol']	='smtp';  
			$config['smtp_host']=$system->smtp_host;  
			$config['smtp_port']=$system->smtp_port;  
			$config['smtp_timeout']='30';  
			$config['smtp_user']=$system->smtp_user;  
			$config['smtp_pass']=$system->smtp_password;
			$config['charset']	='utf-8';  
			$config['newline']	="\r\n";
			$config['charset'] 	= 'utf-8';
			$config['wordwrap'] = TRUE;
			$config['mailtype'] = 'html';
			$this->load->library('email', $config);
			$this->email->from($system->smtp_user,$data['identitas']->site_title);
			$this->email->to($data['elm_cus']->email); 
			$this->email->subject('Wishlist '.$data['identitas']->site_title);
			$this->email->message($this->load->view('template/'.$template.'/email_wishlist',$data,true));
			$this->email->send();
				
		}
		function stock_available($idx_attribute_product,$idx_product){
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
		}
		function promo_bogof($idx){
			return $this->db->query("SELECT bogof_caption FROM `content_prom` where idx_promo=2 and idx_product='$idx'");
		}
		function free_ongkir($idx){
			return $this->db->query("SELECT * FROM content_prom	where fl_free_ongkir=1 and idx_product='$idx'")->num_rows();
		}
		function promo_persentasi($idx_product){
			if($this->check_promo($idx_product)->num_rows()>0)
			{
				$pr=$this->check_promo($idx_product)->row();
				if($pr->idx_type_promo==1){
					return $pr->discount;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}
		function check_promo($idx_product){
			$q=$this->db->query("select a.idx_type_promo,b.* from promo_management a join content_prom b on a.idx_promo=b.idx_promo where b.idx_product='$idx_product' and a.idx_type_promo='1'");
			return $q;
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
		function contact_send(){
			if(($this->input->post('nama'))&&($this->input->post('email'))&&($this->input->post('judul_pesan'))&&($this->input->post('isi_pesan'))){
				if (!filter_var($this->input->post('email'), FILTER_VALIDATE_EMAIL)) {
					echo'<div class="message error" style="padding: 5px 20px;margin: 0 20px;color:#D12626;font-size: 11px;">Email tidak benar.</div>';
					die();
				}
						$data = array(
						   'nama' =>$this->input->post('nama'),
						   'tgl_pesan' =>date('Y-m-d'),
						   'email' =>$this->input->post('email'),
						   'judul_pesan' =>$this->input->post('judul_pesan'),
						   'isi_pesan' =>$this->input->post('isi_pesan')
						);
						$save=$this->db->insert('message', $data); 
						if($save){
							echo'<div class="mar_b1" style="padding: 10px 10px;font-size: 13px;color: #fff;background-color: #BBD692;border: 1px solid #FFFFFF;"><p style="padding:0;">Terimakasih, Pesan akan segera kami respon.</p></div>';
							echo"<script>
							setTimeout(function () {
								window.location='".site_url('page/contact')."';
							},2000);
						</script>";
						}else{
							echo'<div class="error mar_b1"><p style="padding:0;">Terjadi Kesalahan Sistem, Silahkan ulangi lagi!!</p></div>';
							die();
						}
			}else{
				echo'<div class="message error" style="padding: 5px 20px;margin: 0 20px;color:#D12626;font-size: 11px;"><p>Lengkapi Data</p></div>';
			}
		}
		function refund(){
			$error="";
			if(($this->input->post('id_pesanan'))&&($this->input->post('nm_product'))&&($this->input->post('ket_product'))&&($this->input->post('total_refund'))){				$id_pesanan	=$this->input->post('id_pesanan');
				$Q=$this->db->query("select * from `order` where id_pesanan='$id_pesanan' and cd_status<>0")->num_rows();
				if($Q==0){
					$error=$error.'<p>- NO Transaksi tidak ditemukan</p>';
				}
				if(!is_numeric($this->input->post('total_refund'))){
					$error=$error.'<p>- Jumlah pengembalian tidak boleh huruf</p>';
				}
			}else{
				$error=$error.'<p>- Silahkan lengkapi Data</p>';
			}
			if($error<>""){
				echo'<div class="message error" style="padding: 5px 20px;margin: 0 20px;color:#D12626;font-size: 11px;">'.$error.'</div>';
				die();
			}
						$data = array(
						   'id_pesanan' =>$this->input->post('id_pesanan'),
						   'tgl_refund' =>date('Y-m-d'),
						   'nm_product' =>$this->input->post('nm_product'),
						   'ket_product' =>$this->input->post('ket_product'),
						   'total_refund' =>$this->input->post('total_refund'),
						   'alasan_refund' =>$this->input->post('alasan_refund')
						);
						$save=$this->db->insert('refund', $data); 
						if($save){
							echo'<div class="mar_b1" style="padding: 10px 10px;font-size: 13px;color: #fff;background-color: #BBD692;border: 1px solid #FFFFFF;"><p style="padding:0;">Terimakasih, Permintaan anda akan segera kami respon.</p></div>';
							echo"<script>
								$('#frm_register')[0].reset();
							</script>";
						}else{
							echo'<div class="error mar_b1"><p style="padding:0;">Terjadi Kesalahan Sistem, Silahkan ulangi lagi!!</p></div>';
							die();
						}
		}
		function delete_wishlist(){
			$delete	=$this->db->delete('wishlist', array('idx_wishlist' =>$this->uri->segment(3)));
			if($delete){
				redirect('page/my_account/wishlist');
			}else{
				echo"Kesalahan Sistem,silahkan ulangi lagi.";
			}
		}
		function comment(){
			$error="";
			if((!$this->input->post('nama'))||(!$this->input->post('komentar')))
			{
				$error=$error.'<p class="error_point">- Silahkan Lengkapi Data!</p>';
			}
			if($error<>""){
				echo '<div class="message error" style="padding: 5px 20px;margin: 0 20px;color:#D12626;font-size: 11px;">'.$error.'</div>';
				die();
			}
			/*-----Save rate-----*/
					$ins_rate = array('idx_product' =>$this->input->post('idx_product'),
										'nama' =>$this->input->post('nama'),
										 'komentar' =>$this->input->post('komentar'),
										 'score_rated' =>$this->input->post('score_rated'));
					$save=$this->db->insert('rated_product', $ins_rate);
			/*-----Save rate-----*/
			if($save){
                echo '<div class="success" style="padding: 5px 20px;font-size: 11px;height: 20px;margin-bottom: 10px;"><p>Terimakasih telah memberikan opini.</p></div>';
            }
		}
		function testimoni_proses(){
			if(($this->input->post('testimoni'))&&($this->session->userdata('idx_pelanggan'))){
						$data = array(
							'tgl_testimon' =>date('Y-m-d'),
							'idx_pelanggan' =>$this->session->userdata('idx_pelanggan'),
						   'testimoni' =>$this->input->post('testimoni'),
						);
						$save=$this->db->insert('testimoni', $data); 
						if($save){
							echo '<div class=" success" style="padding: 5px 20px;margin: 0 20px;font-size: 11px;"><p>Terimakasih, Testimoni anda akan segera kami proses.</p></div>';
							echo"<script>
								setTimeout(function () {
									window.location='".site_url('page/my_account/testimoni')."';
								},200);
							</script>";
						}else{
							echo'<div class="error mar_b1"><p style="padding:0;">Terjadi Kesalahan Sistem, Silahkan ulangi lagi!!</p></div>';
							die();
						}
			}else{
				echo'<div class="error mar_b1"><p style="padding:0;">Lengkapi Data yang Diminta</p></div>';
			}
		}
		function get_wishlist($idx_pelanggan){
			$q=$this->db->query("SELECT a.*,b.* FROM wishlist a join product b on a.idx_product=b.idx_product where a.idx_pelanggan='$idx_pelanggan'");
			return $q;
		}
                function register_newsletter(){
                    	$error="";
						if (!filter_var($this->input->post('email'), FILTER_VALIDATE_EMAIL)) {
							$error=$error.'<p class="error_point">- Email Wajib Disi.</p>';
						}
									$email		=$this->input->post('email');
						$Quser		=$this->db->query("select * from newsletter_cus where email='$email'");
						if($Quser->num_rows()>0){
							echo '<div class="message error" style="padding: 5px 20px;margin: 0 20px;color:#D12626;font-size: 11px;"><p>Email sudah terdaftar.</p></div>';
							die();
						}
									/*-----Save Newsletter-----*/
								$ins_newsletter = array('email' =>$this->input->post('email'));
								$save		=$this->db->insert('newsletter_cus', $ins_newsletter);
						/*-----Save Newsletter-----*/
									if($save){
											echo '<div class=" success" style="padding: 5px 20px;margin: 0 20px;font-size: 11px;"><p>Anda Berhasil Berlangganan Newsletter Kami.</p></div>';
									}
                }
		function register_proses(){
			$error="";
			if((!$this->input->post('password'))||(!$this->input->post('full_name'))||(!$this->input->post('email'))||(!$this->input->post('jenis_kelamin'))||(!$this->input->post('tgl_lahir')))
			{
				$error=$error.'<p class="error_point">- Silahkan Lengkapi Data!</p>';
			}
			if (!filter_var($this->input->post('email'), FILTER_VALIDATE_EMAIL)) {
				$error=$error.'<p class="error_point">- Email Harus Sesuai Kriteria</p>';
			}
			if($error<>""){
				echo '<div class="message error" style="padding: 5px 20px;margin: 0 20px;color:#D12626;font-size: 11px;">Error! '.$error.'</div>';
				die();
			}
			$email		=$this->input->post('email');
			$Quser		=$this->db->query("select * from pelanggan where email='$email'");
			if($Quser->num_rows()>0){
				echo '<div class="message error" style="padding: 5px 20px;margin: 0 20px;color:#D12626;font-size: 11px;">Error.<p>Email sudah terdaftar.</p></div>';
				die();
			} 
			/*-----Save Pelanggan-----*/
					$ins_cus = array('full_name' =>$this->input->post('full_name'),
										'jenis_kelamin' =>$this->input->post('jenis_kelamin'),
										'tgl_lahir' =>$this->input->post('tgl_lahir'),
										'email' =>$this->input->post('email'),
										 'password' =>md5($this->input->post('password')));
					$save=$this->db->insert('pelanggan', $ins_cus);
			/*-----Save Pelanggan-----*/
			$q				=$this->db->query("select idx_pelanggan from pelanggan order by idx_pelanggan desc limit 1")->row();
			$idx_pelanggan	=$q->idx_pelanggan;
			/*-----Save newsletter-----*/
			if($this->input->post('fl_newsletter')=="on"){
				$ins_newsletter = array('email' =>$this->input->post('email'));
				$this->db->insert('newsletter_cus', $ins_newsletter);		
				
			}
			/*-----Save newsletter-----*/
			if($this->session->userdata('set_login_cus')!=TRUE){
				$newdata = array(
					'full_name'  => $this->input->post('full_name'),
					'email'     => $this->input->post('email'),
					'idx_pelanggan'  => $idx_pelanggan,
					'set_login_cus' => TRUE
				);
				$this->session->set_userdata($newdata);
			}       
					$data['identitas'] 	= $this->additional_model->get_row('identitas');
                    $data['full_name']	= $this->input->post('full_name');
                    $template='demo';
					$system 			= $this->db->get('system')->row();
					$config['protocol']	='smtp';  
					$config['smtp_host']=$system->smtp_host;  
					$config['smtp_port']=$system->smtp_port;   
					$config['smtp_timeout']='30';  
					$config['smtp_user']=$system->smtp_user;  
					$config['smtp_pass']=$system->smtp_password;
					$config['charset']='utf-8';  
					$config['newline']="\r\n";
					$config['charset'] = 'utf-8';
					$config['wordwrap'] = TRUE;
					$config['mailtype'] = 'html';
					$this->load->library('email', $config);
					$this->email->from($system->smtp_user,$data['identitas']->site_title);
					$this->email->to($this->input->post('email'));
					$this->email->subject('Akun Anda Di '.$data['identitas']->site_title);
					$this->email->message($this->load->view('template/'.$template.'/email_user',$data,true));
					$this->email->send();
				echo '<div class=" success" style="padding: 5px 20px;margin: 0 20px;font-size: 11px;"><p>Data Berhasil Disimpan.</p></div>';
				echo"<script>
					setTimeout(function () {
						window.location='".site_url('page')."';
					},200);
				</script>";
		}
		function forgot_proses(){
			$error="";
			if(!$this->input->post('email'))
			{
				$error=$error.'<p class="error_point">- Silahkan Masukan Email Anda!</p>';
			}
			if (!filter_var($this->input->post('email'), FILTER_VALIDATE_EMAIL)) {
				$error=$error.'<p class="error_point">- Email Harus Sesuai Kriteria</p>';
			}
			if(filter_var($this->input->post('email'), FILTER_VALIDATE_EMAIL))
			{
				$val_email=$this->db->get_where("pelanggan",array("email"=>$this->input->post('email')));
				if($val_email->num_rows()==0){
					$error=$error.'<p class="error_point">- Email Tidak Ditemukan</p>';
				}else{

					$data['pelanggan']=$val_email;
				}
			}
			if($error<>""){
				echo '<div class="message error" style="padding: 5px 20px;margin: 0 20px;color:#D12626;font-size: 11px;">Error! '.$error.'</div>';
				die();
			}
			$data['fsystem']	=base64_encode("fsystem");
			$data['identitas'] 	= $this->additional_model->get_row('identitas');
			$template='demo';
			$system 			= $this->db->get('system')->row();
			$config['protocol']	='smtp';  
			$config['smtp_host']=$system->smtp_host;  
			$config['smtp_port']=$system->smtp_port;   
			$config['smtp_timeout']='30';  
			$config['smtp_user']=$system->smtp_user;  
			$config['smtp_pass']=$system->smtp_password;
					$config['charset']='utf-8';  
					$config['newline']="\r\n";
					$config['charset'] = 'utf-8';
					$config['wordwrap'] = TRUE;
					$config['mailtype'] = 'html';
					$this->load->library('email', $config);
					$this->email->from($system->smtp_user,$data['identitas']->site_title);
			$this->email->to($this->input->post('email'));
			$this->email->subject('Verifikasi Password Akun '.$data['identitas']->site_title);
			$this->email->message($this->load->view('template/'.$template.'/email_forgot',$data,true));
			$this->email->send();
				echo '<div class=" success" style="padding: 5px 20px;margin: 0 20px;font-size: 11px;"><p>Email Verifikasi Telah Dikirim .</p></div>';
				echo"<script>
					setTimeout(function () {
						window.location='".site_url('page')."';
					},200);
				</script>";

		}
		function login_proses(){
			$error="";
			if((!$this->input->post('password'))||(!$this->input->post('email')))
			{
				$error=$error.'<p class="error_point">- Silahkan Lengkapi Data!</p>';
			}
			if (!filter_var($this->input->post('email'), FILTER_VALIDATE_EMAIL)) {
				$error=$error.'<p class="error_point">- Email Harus Sesuai Kriteria</p>';
			}
			if($error<>""){
				echo '<div class="message error" style="padding: 5px 20px;margin: 0 20px;color:#D12626;font-size: 11px;">Error! '.$error.'</div>';
				die();
			}
			$email		=$this->input->post('email');
			$password	=md5($this->input->post('password'));
			$Quser		=$this->db->query("select * from pelanggan where email='$email'  and password='$password'");
			if($Quser->num_rows()>0){
			$w			=$Quser->row();
				$newdata = array(
					'full_name'  => $w->full_name,
					'email'     => $w->email,
					'idx_pelanggan'  => $w->idx_pelanggan,
					'set_login_cus' => TRUE
				);
				$this->session->set_userdata($newdata);
				echo '<div class=" success" style="padding: 5px 20px;margin: 0 20px;font-size: 11px;">Login Berhasil.</div>';
				if($this->uri->segment(3)=="order"){
					echo"<script>
						window.location='".site_url('checkout')."';
					</script>";
				}else{
					echo"<script>
						
							window.location='".site_url('page')."';
						
					</script>";
				}
			}else{
				echo '<div class="message error" style="padding: 5px 20px;margin: 0 20px;color:#D12626;font-size: 11px;"><p>Email atau password Salah</p></div>';
				die();
			}
		}
		function login_forgot(){
			$w=$this->db->get_where("pelanggan",array("idx_pelanggan"=>$this->uri->segment(3)))->row();
			$newdata = array(
					'full_name'  => $w->full_name,
					'email'     => $w->email,
					'idx_pelanggan'  => $w->idx_pelanggan,
					'set_login_cus' => TRUE
				);
				$this->session->set_userdata($newdata);
				echo"<script>
						window.location='".site_url('page/my_account/change_password')."';
					</script>";
		}
		function update_address(){
			$error="";
			if((!$this->input->post('alamat'))||(!$this->input->post('kota'))||(!$this->input->post('kec')))
				{
					$error=$error.'<p class="error_point">- Silahkan Lengkapi Data!</p>';
				}
			if($error<>""){
				echo '<div class="message error" style="padding: 5px 20px;margin: 0 20px;color:#D12626;font-size: 11px;">Error! '.$error.'</div>';
				die();
			}
			/*-----Update Account-----*/
					$upd_cus = array('alamat' =>$this->input->post('alamat'),'provinsi' =>$this->input->post('provinsi'),'kota' =>$this->input->post('kota'),'kec' =>$this->input->post('kec'));
					$this->db->where('idx_pelanggan',$this->input->post('idx_pelanggan'));
					$proc=$this->db->update('pelanggan', $upd_cus); 					
			/*-----Update Account-----*/
						echo '<div class=" success" style="padding: 5px 20px;margin: 0 20px;font-size: 11px;">Data Berhasil Disimpan</div>';
						echo"<script>
							setTimeout(function () {
								window.location='".site_url('page/my_account/address')."';
							},500);
						</script>";
		}
		function update_password(){
			$error="";
			/*-----Validasi-----*/
			if(!$this->input->post('password'))
			{
					$error=$error.'<p class="error_point">- Silahkan Lengkapi Data!</p>';
			}
			$idx_pelanggan	=$this->input->post('idx_pelanggan');
			$validasi		=$this->db->query("select password from pelanggan where idx_pelanggan='$idx_pelanggan'")->row();	
			if($error<>""){
				echo '<div class="message error" style="padding: 5px 20px;margin: 0 20px;color:#D12626;font-size: 11px;">Error! '.$error.'</div>';
				die();
			}
			/*-----Update Account-----*/
					$upd_cus = array('password' =>md5($this->input->post('password')));
					$this->db->where('idx_pelanggan',$this->input->post('idx_pelanggan'));
					$proc=$this->db->update('pelanggan', $upd_cus); 					
			/*-----Update Account-----*/
				echo '<div class=" success" style="padding: 5px 20px;margin: 0 20px;font-size: 11px;">Password Berhasil Disimpan</div>';
				echo"<script>
					setTimeout(function () {
						window.location='".site_url('page/my_account/change_password')."';
					},500);
				</script>";
			
		}
		function update_account(){
			$error="";
			/*-----Validasi-----*/
			if(!$this->input->post('full_name'))
				{
					$error=$error.'<p class="error_point">- Silahkan Isi Nama Lengkap!</p>';
				}
			if($this->input->post('hp')){
				if(!is_numeric($this->input->post('hp'))){
					$error=$error.'<p class="error_point">- Handphone Tidak Boleh Angka</p>';
				}
			}else{
				$error=$error.'<p class="error_point">- Handphone Tidak Boleh Kosong</p>';
			}
			if (!filter_var($this->input->post('email'), FILTER_VALIDATE_EMAIL)) {
				$error=$error.'<p class="error_point">- Email Harus Sesuai Kriteria</p>';
			}
			if($error<>""){
				echo '<div class="message error" style="padding: 5px 20px;margin: 0 20px;color:#D12626;font-size: 11px;">Error! '.$error.'</div>';
				die();
			}
			/*-----Update Account-----*/
					$upd_cus = array('full_name' =>$this->input->post('full_name'),'no_telepon' =>$this->input->post('no_telepon'),'hp' =>$this->input->post('hp'));
					$this->db->where('idx_pelanggan',$this->input->post('idx_pelanggan'));
					$proc=$this->db->update('pelanggan', $upd_cus); 					
			/*-----Update Account-----*/
			/*----Newsletter-----*/
			if($this->input->post('newsletter')==0){
				$this->db->delete('newsletter_cus', array('email' =>$this->input->post('email')));
			}else{
				$cek=$this->db->get_where("newsletter_cus",array("email"=>$this->input->post('email')))->num_rows();
				if($cek==0){
					$ins_newsletter = array('email' =>$this->input->post('email'));
					$this->db->insert('newsletter_cus', $ins_newsletter);
				}
			}
						echo '<div class=" success" style="padding: 5px 20px;margin: 0 20px;font-size: 11px;">Data Berhasil Disimpan</div>';
						echo"<script>
							setTimeout(function () {
								window.location='".site_url('page/my_account/account')."';
							},500);
						</script>";
		}
		function unsubscribe(){
			if($this->input->post('email')){
				$this->db->delete('newsletter_cus', array('email' =>$this->input->post('email')));
			}
			redirect('page');
		}
		function status(){
			return $this->db->get('system')->row()->cd_status;
		}
}
