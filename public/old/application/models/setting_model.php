<?php 
date_default_timezone_set('Asia/Jakarta');
defined('BASEPATH') OR exit('No direct script access allowed');
class setting_model extends CI_model{
		private $MAIN_URL;
		function __construct(){
			parent::__construct();
			$this->load->database();
			$this->load->helper(array('form', 'url'));
			$this->load->model('additional_model');
			include"./fsy/url_induk.php";
			$this->MAIN_URL = $MAIN_URL;
		}
		function delete($target,$idx){
			if($target=="account"){
				$this->db->delete('account_web', array('idx_account' =>$idx));
				redirect('setting/account');
			}
			if($target=="page"){
				$this->db->delete('content_account', array('idx_content_account' =>$idx));
				redirect('setting/page');
			}
		}
		function set_aktif(){
			$this->db->query('update system set cd_status=1');
		}
		function save($target){
			if($target=="account"){
				if($this->input->post('no_account')){
					$data = array(
					   'type_account' =>$this->input->post('type_account'),
					   'no_account' =>$this->input->post('no_account')
					);
					$save=$this->db->insert('account_web', $data); 
					if($save){
						echo'<div class="alert alert-success"><strong>Success!</strong>Data berhasil disimpan.</div>';
						echo"<script>
							setTimeout(function () {
								window.location='".site_url('setting/account')."';
							},2000);
						</script>";
					}else{
						echo'<div class="alert alert-danger"><button class="close" data-dismiss="alert">×</button><strong>Oopss!&nbsp;</strong>Terjadi Kesalahan Sistem, Silahkan ulangi lagi!!</div>';
						die();
					}
				}else{
					echo '<div class="alert alert-error"><strong>Error!  </strong>Lengkapi Data yang diperlukan.</div>';
					die();
				}
			}
			if($target=="general"){
				if($this->input->post('site_title')){
						$logo='';
						if((isset($_FILES['logo']['tmp_name']))&&($_FILES['logo']['tmp_name']!="")){
							$up=$this->do_upload('logo','');
							if($up==0){
								echo'<div class="alert alert-danger"><button class="close" data-dismiss="alert">×</button><strong>Error!&nbsp;</strong>Terjadi Kesalahan pada file logo,Pastikan file yang anda upload sesuai kriteria!!</div>';
								die();
							}
							$this->resize_image($this->upload->upload_path.$this->upload->file_name,150,100);
							$logo=$this->upload->file_name;
						}
						$data = array(
						   'site_title' =>$this->input->post('site_title'),
						   'site_desc' =>$this->input->post('site_desc'),
						   'logo' =>$logo,
						   'email' =>$this->input->post('email'),
						   'facebook' =>$this->input->post('facebook'),
							'twitter' =>$this->input->post('twitter'),
							'youtube' =>$this->input->post('youtube'),
							'gplus' =>$this->input->post('gplus'),
							'keyword' =>$this->input->post('keyword'),
							'description' =>$this->input->post('description')
						);
					$save=$this->db->insert('identitas', $data); 
					if($save){
						echo'<div class="alert alert-success"><strong>Success!</strong>Data berhasil disimpan.</div>';
						echo"<script>
							setTimeout(function () {
								window.location='".site_url('setting/identitas')."';
							},2000);
						</script>";
					}else{
						echo'<div class="alert alert-danger"><button class="close" data-dismiss="alert">×</button><strong>Oopss!&nbsp;</strong>Terjadi Kesalahan Sistem, Silahkan ulangi lagi!!</div>';
						die();
					}
				}else{
					echo '<div class="alert alert-error"><strong>Error!  </strong>Lengkapi Data yang diperlukan.</div>';
					die();
				}
			}
			if($target=="shop"){
				$error='';
				if((!$this->input->post('nm_toko'))||(!$this->input->post('alamat'))||(!$this->input->post('kota'))||(!$this->input->post('telp'))){
					$error='<p>Lengkapi Data yang Diminta.</p>';
				}
				if($this->input->post('telp')){
					if(!is_numeric($this->input->post('telp'))){
						$error=$error.'<p>No Telp Tidak Benar.</p>';
					}
				}
				if($error){
					echo '<div class="alert alert-error"><strong>Error! </strong>'.$error.'</div>';
					die();
				}
				$data = array(
						   'nm_toko' =>$this->input->post('nm_toko'),
						   'alamat' =>$this->input->post('alamat'),
						   'kota' =>$this->input->post('kota'),
						   'telp' =>$this->input->post('telp'),
						   'fl_ongkir' =>$this->input->post('fl_ongkir'),
						   'fl_refund' =>$this->input->post('fl_refund'),
						   'fl_secure' =>$this->input->post('fl_secure')
						);
					$save=$this->db->insert('setting_toko', $data); 
					if($save){
						echo'<div class="alert alert-success"><strong>Success!</strong>Data berhasil disimpan.</div>';
						echo"<script>
							setTimeout(function () {
								window.location='".site_url('setting/shop')."';
							},2000);
						</script>";
					}else{
						echo'<div class="alert alert-danger"><button class="close" data-dismiss="alert">×</button><strong>Oopss!&nbsp;</strong>Terjadi Kesalahan Sistem, Silahkan ulangi lagi!!</div>';
						die();
					}
			}
			if($target=="shipping"){
				if($this->session->userdata('user_name')=='sadmin'){
					$error='';
						if(!$this->input->post('city_code')){
							$error='<p>- Masukan Kode Kota.</p>';
						}
						if((!is_numeric($this->input->post('a_reg')))||(!is_numeric($this->input->post('b_reg')))||(!is_numeric($this->input->post('c_reg')))) {
							$error=$error.'<p class="error_point">- Ongkos Kirim Zona A,B,C,D Reguler Tidak Boleh Kosong</p>';
						}
						if($this->input->post('d_reg')){
							if(!is_numeric($this->input->post('d_reg'))){
								$error=$error.'<p class="error_point">- Ongkos Kirim Zona D Reguler Tidak Boleh Angka</p>';
							}
						}
						if($this->input->post('a_oke')){
							if(!is_numeric($this->input->post('a_oke'))){
								$error=$error.'<p class="error_point">- Ongkos Kirim Zona A OKE Tidak Boleh Angka</p>';
							}
						}
						if($this->input->post('a_yes')){
							if(!is_numeric($this->input->post('a_yes'))){
								$error=$error.'<p class="error_point">- Ongkos Kirim Zona A YES Tidak Boleh Angka</p>';
							}
						}
						if($this->input->post('b_oke')){
							if(!is_numeric($this->input->post('b_oke'))){
								$error=$error.'<p class="error_point">- Ongkos Kirim Zona B OKE Tidak Boleh Angka</p>';
							}
						}
						if($this->input->post('b_yes')){
							if(!is_numeric($this->input->post('b_yes'))){
								$error=$error.'<p class="error_point">- Ongkos Kirim Zona B YES Tidak Boleh Angka</p>';
							}
						}
						if($this->input->post('c_oke')){
							if(!is_numeric($this->input->post('c_oke'))){
								$error=$error.'<p class="error_point">- Ongkos Kirim Zona C OKE Tidak Boleh Angka</p>';
							}
						}
						if($this->input->post('c_yes')){
							if(!is_numeric($this->input->post('c_yes'))){
								$error=$error.'<p class="error_point">- Ongkos Kirim Zona C YES Tidak Boleh Angka</p>';
							}
						}
						if($this->input->post('d_oke')){
							if(!is_numeric($this->input->post('d_oke'))){
								$error=$error.'<p class="error_point">- Ongkos Kirim Zona D OKE Tidak Boleh Angka</p>';
							}
						}
						if($this->input->post('d_yes')){
							if(!is_numeric($this->input->post('d_yes'))){
								$error=$error.'<p class="error_point">- Ongkos Kirim Zona D YES Tidak Boleh Angka</p>';
							}
						}
						if($error){
							echo '<div class="alert alert-error">'.$error.'</div>';
							die();
						}
						$data = array(
							   'city_code' =>$this->input->post('city_code'),
							   'a_reg'=>$this->input->post('a_reg'),
							   'a_oke'=>$this->input->post('a_oke'),
							   'a_yes'=>$this->input->post('a_yes'),
							   'b_reg'=>$this->input->post('b_reg'),
							   'b_oke'=>$this->input->post('b_oke'),
							   'b_yes'=>$this->input->post('b_yes'),
							   'c_reg'=>$this->input->post('c_reg'),
							   'c_oke'=>$this->input->post('c_oke'),
							   'c_yes'=>$this->input->post('c_yes'),
							   'd_reg'=>$this->input->post('d_reg'),
							   'd_oke'=>$this->input->post('d_oke'),
							   'd_yes'=>$this->input->post('d_yes')
							);
						$save=$this->db->insert('shipping_price', $data); 
						if($save){
							echo'<div class="alert alert-success">Data berhasil disimpan.</div>';
							echo"<script>
								setTimeout(function () {
									window.location='".site_url('setting/shipping')."';
								},2000);
							</script>";
						}else{
							echo'<div class="alert alert-danger"><button class="close" data-dismiss="alert">×</button><strong>Oopss!&nbsp;</strong>Terjadi Kesalahan Sistem, Silahkan ulangi lagi!!</div>';
							die();
						}
				}
			}
			if($target=="system"){
					$error='';
					if((!$this->input->post('paket'))||(!$this->input->post('smtp_host'))||(!$this->input->post('smtp_user'))||(!$this->input->post('smtp_password'))||(!$this->input->post('directory'))){
						$error='<p>Lengkapi Data yang Diminta.</p>';
					}
					if($error){
						echo '<div class="alert alert-error"><strong>Error! </strong>'.$error.'</div>';
						die();
					}
						$feature=explode("||",$this->get_feature($this->input->post('paket')));
					$data = array(
							   'paket' =>$this->input->post('paket'),
							   'smtp_host' =>$this->input->post('smtp_host'),
							   'smtp_user' =>$this->input->post('smtp_user'),
							   'smtp_password' =>$this->input->post('smtp_password'),
							   'smtp_port' =>$this->input->post('smtp_port'),
							   'fl_promo' =>$feature[0],
							   'fl_gallery' =>$feature[1],
							   'fl_wishlist' =>$feature[2],
							   'id_pesanan'=>$this->input->post('id_pesanan'),
							   'template'=>$this->input->post('directory')
							);
						$save=$this->db->insert('system', $data); 
						if($save){
							echo'<div class="alert alert-success"><strong>Success!</strong>Data berhasil disimpan.</div>';
							echo"<script>
									window.location='".site_url('setting/system')."';
							</script>";
						}else{
							echo'<div class="alert alert-danger"><button class="close" data-dismiss="alert">×</button><strong>Oopss!&nbsp;</strong>Terjadi Kesalahan Sistem, Silahkan ulangi lagi!!</div>';
							die();
						}
				
			}
			if($target=="page"){
				$data = array(
						   'about_us' =>$this->input->post('about_us'),
						   'contact_us' =>$this->input->post('contact_us'),
						   'panduan_ukuran' =>$this->input->post('panduan_ukuran'),
						   'tata_cara_belanja' =>$this->input->post('tata_cara_belanja'),
						   'faq' =>$this->input->post('faq'),
						   'aturan_pengiriman' =>$this->input->post('aturan_pengiriman'),
						   'persyaratan_ketentuan' =>$this->input->post('persyaratan_ketentuan'),
						   'kebijakan_privasi' =>$this->input->post('kebijakan_privasi')
						);
					$save=$this->db->insert('link_halaman', $data); 
					if($save){
						echo'<div class="alert alert-success"><strong>Success!</strong>Data berhasil disimpan.</div>';
						echo"<script>
							setTimeout(function () {
								window.location='".site_url('setting/page')."';
							},2000);
						</script>";
					}else{
						echo'<div class="alert alert-danger"><button class="close" data-dismiss="alert">×</button><strong>Oopss!&nbsp;</strong>Terjadi Kesalahan Sistem, Silahkan ulangi lagi!!</div>';
						die();
					}
			}
			if($target=="city"){
				if($this->session->userdata('user_name')=='sadmin'){
					$error='';
					if((!$this->input->post('provinsi'))||(!$this->input->post('kota'))||(!$this->input->post('kec'))||(!$this->input->post('city_code'))||(!$this->input->post('zona'))){
						$error='<p>Lengkapi Data yang Diminta.</p>';
					}
					if($error){
						echo '<div class="alert alert-error">'.$error.'</div>';
						die();
					}
						$data = array(
							   'city_code' =>$this->input->post('city_code'),
							   'provinsi' =>$this->input->post('provinsi'),
							   'kota' =>$this->input->post('kota'),
							   'kec' =>$this->input->post('kec'),
							   'zona' =>strtolower($this->input->post('zona'))
							);
						$save=$this->db->insert('shipping_location', $data); 
						if($save){
							echo'<div class="alert alert-success">Data berhasil disimpan.</div>';
							echo"<script>
								setTimeout(function () {
									window.location='".site_url('setting/city')."';
								},2000);
							</script>";
						}else{
							echo'<div class="alert alert-danger"><button class="close" data-dismiss="alert">×</button><strong>Oopss!&nbsp;</strong>Terjadi Kesalahan Sistem, Silahkan ulangi lagi!!</div>';
							die();
						}
				}
			}
		}
		function get_feature($paket){
			$ch = curl_init ($this->MAIN_URL."/parameter/feature_paket/".$paket);
			curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
			$data = curl_exec ($ch);
			return $data;
		}
		function do_upload($htmlFieldName,$path){
				$config['file_name'] = time();
				$config['upload_path'] = './uploads/';
				$config['allowed_types'] = 'gif|jpg|png|ico';
				$config['max_size'] = '50000';
				$this->load->library('upload', $config);
				unset($config);
				if(!$this->upload->do_upload($htmlFieldName)){
					return 0;
				}else{
					return 1;
				}
		}
			function do_upload_template($htmlFieldName,$filename){
				$config['file_name'] = $filename;
				$config['upload_path'] = './assets';
				$config['allowed_types'] = 'zip';
				$this->load->library('upload', $config);
				unset($config);
				if(!$this->upload->do_upload($htmlFieldName)){
					return $this->upload->display_errors();
				}else{
					return 1;
				}
		}
		function resize_image($sourcePath,$witdh,$height)
		{
				$config['source_image'] =$sourcePath;
				$config['maintain_ratio'] = FALSE;
				$config['width'] = $witdh;
				$config['height'] = $height;
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();
		}
		function update($target){
			if($target=="account"){
				if($this->input->post('no_account')){
					$data = array(
					   'type_account' =>$this->input->post('type_account'),
					   'no_account' =>$this->input->post('no_account')
					);
					$this->db->where('idx_account',$this->input->post('idx_account'));
					$update=$this->db->update('account_web', $data); 
						if($update){
							echo'<div class="alert alert-success"><strong>Success!</strong>Data berhasil diubah.</div>';
							echo"<script>
								setTimeout(function () {
									window.location='".site_url('setting/account')."';
								},2000);
							</script>";
						}else{
							echo'<div class="alert alert-danger"><button class="close" data-dismiss="alert">×</button><strong>Oopss!&nbsp;</strong>Terjadi Kesalahan Sistem, Silahkan ulangi lagi!!</div>';
							die();
						}
				}else{
					echo '<div class="alert alert-error"><strong>Error!  </strong>Lengkapi Data yang diperlukan.</div>';
					die();
				}
			}
			if($target=="system"){
					$error='';
					if((!$this->input->post('paket'))||(!$this->input->post('smtp_host'))||(!$this->input->post('smtp_user'))||(!$this->input->post('smtp_password'))){
						$error='<p>Lengkapi Data yang Diminta.</p>';
					}
					if($error){
						echo '<div class="alert alert-error"><strong>Error! </strong>'.$error.'</div>';
						die();
					}
					$feature=explode("||",$this->get_feature($this->input->post('paket')));
					if (!file_exists('./assets/'.$this->input->post('directory'))) {
				   		echo '<div class="alert alert-error"><strong>Error! </strong>Template Belum Tersedia,silahkan upload.</div>';
						die();
					}
					if(!$this->input->post('directory')){
						$directory	= $this->input->post('directory_old');
					}else{
						$directory	= $this->input->post('directory');
					}
						$data = array(
							   'paket' =>$this->input->post('paket'),
							   'smtp_host' =>$this->input->post('smtp_host'),
							   'smtp_user' =>$this->input->post('smtp_user'),
							   'smtp_password' =>$this->input->post('smtp_password'),
							   'smtp_port' =>$this->input->post('smtp_port'),
							   'fl_promo' =>$feature[0],
							   'fl_gallery' =>$feature[1],
							   'fl_wishlist' =>$feature[2],
							   'id_pesanan'=>$this->input->post('id_pesanan'),
								'template'=>$directory
							);
							
						$this->db->where('idx_system',$this->input->post('idx_system'));
						$update=$this->db->update('system', $data); 
						if($update){
							echo'<div class="alert alert-success"><strong>Success!</strong>Data berhasil diubah.</div>';
							echo"<script>
									window.location='".site_url('setting/system')."';
								
							</script>";
						}else{
							echo'<div class="alert alert-danger"><button class="close" data-dismiss="alert">×</button><strong>Oopss!&nbsp;</strong>Terjadi Kesalahan Sistem, Silahkan ulangi lagi!!</div>';
							die();
						}
			}
			if($target=="page"){
				
					$data = array(
						   'about_us' =>$this->input->post('about_us'),
						   'contact_us' =>$this->input->post('contact_us'),
						   'panduan_ukuran' =>$this->input->post('panduan_ukuran'),
						   'tata_cara_belanja' =>$this->input->post('tata_cara_belanja'),
						   'faq' =>$this->input->post('faq'),
						   'aturan_pengiriman' =>$this->input->post('aturan_pengiriman'),
						   'persyaratan_ketentuan' =>$this->input->post('persyaratan_ketentuan'),
						   'kebijakan_privasi' =>$this->input->post('kebijakan_privasi')
						);
					$this->db->where('idx_link',$this->input->post('idx_link'));
					$update=$this->db->update('link_halaman', $data); 
					if($update){
						echo'<div class="alert alert-success"><strong>Success!</strong>Data berhasil diubah.</div>';
						echo"<script>
							setTimeout(function () {
								window.location='".site_url('setting/page')."';
							},2000);
						</script>";
					}else{
						echo'<div class="alert alert-danger"><button class="close" data-dismiss="alert">×</button><strong>Oopss!&nbsp;</strong>Terjadi Kesalahan Sistem, Silahkan ulangi lagi!!</div>';
						die();
					}
				
			}
			if($target=="shipping"){
				$error='';
					if(!$this->input->post('city_code')){
						$error='<p>- Masukan Kode Kota.</p>';
					}
					if((!is_numeric($this->input->post('a_reg')))||(!is_numeric($this->input->post('b_reg')))||(!is_numeric($this->input->post('c_reg')))) {
						$error=$error.'<p class="error_point">- Ongkos Kirim Zona A,B,C,D Reguler Tidak Boleh Kosong</p>';
					}
					if($this->input->post('d_reg')){
						if(!is_numeric($this->input->post('d_reg'))){
							$error=$error.'<p class="error_point">- Ongkos Kirim Zona D Reguler Tidak Boleh Angka</p>';
						}
					}
					if($this->input->post('a_oke')){
						if(!is_numeric($this->input->post('a_oke'))){
							$error=$error.'<p class="error_point">- Ongkos Kirim Zona A OKE Tidak Boleh Angka</p>';
						}
					}
					if($this->input->post('a_yes')){
						if(!is_numeric($this->input->post('a_yes'))){
							$error=$error.'<p class="error_point">- Ongkos Kirim Zona A YES Tidak Boleh Angka</p>';
						}
					}
					if($this->input->post('b_oke')){
						if(!is_numeric($this->input->post('b_oke'))){
							$error=$error.'<p class="error_point">- Ongkos Kirim Zona B OKE Tidak Boleh Angka</p>';
						}
					}
					if($this->input->post('b_yes')){
						if(!is_numeric($this->input->post('b_yes'))){
							$error=$error.'<p class="error_point">- Ongkos Kirim Zona B YES Tidak Boleh Angka</p>';
						}
					}
					if($this->input->post('c_oke')){
						if(!is_numeric($this->input->post('c_oke'))){
							$error=$error.'<p class="error_point">- Ongkos Kirim Zona C OKE Tidak Boleh Angka</p>';
						}
					}
					if($this->input->post('c_yes')){
						if(!is_numeric($this->input->post('c_yes'))){
							$error=$error.'<p class="error_point">- Ongkos Kirim Zona C YES Tidak Boleh Angka</p>';
						}
					}
					if($this->input->post('d_oke')){
						if(!is_numeric($this->input->post('d_oke'))){
							$error=$error.'<p class="error_point">- Ongkos Kirim Zona D OKE Tidak Boleh Angka</p>';
						}
					}
					if($this->input->post('d_yes')){
						if(!is_numeric($this->input->post('d_yes'))){
							$error=$error.'<p class="error_point">- Ongkos Kirim Zona D YES Tidak Boleh Angka</p>';
						}
					}
					if($error){
						echo '<div class="alert alert-error">'.$error.'</div>';
						die();
					}
					$data = array(
						   'city_code'=>$this->input->post('city_code'),
						   'a_reg'=>$this->input->post('a_reg'),
						   'a_oke'=>$this->input->post('a_oke'),
						   'a_yes'=>$this->input->post('a_yes'),
						   'b_reg'=>$this->input->post('b_reg'),
						   'b_oke'=>$this->input->post('b_oke'),
						   'b_yes'=>$this->input->post('b_yes'),
						   'c_reg'=>$this->input->post('c_reg'),
						   'c_oke'=>$this->input->post('c_oke'),
						   'c_yes'=>$this->input->post('c_yes'),
						   'd_reg'=>$this->input->post('d_reg'),
						   'd_oke'=>$this->input->post('d_oke'),
						   'd_yes'=>$this->input->post('d_yes')
						);
					$this->db->where('idx_shipping_price',$this->input->post('idx_shipping_price'));
					$update=$this->db->update('shipping_price',$data); 
					if($update){
						echo'<div class="alert alert-success">Data berhasil diubah.</div>';
						echo"<script>
							setTimeout(function () {
								window.location='".site_url('setting/shipping')."';
							},2000);
						</script>";
					}else{
						echo'<div class="alert alert-danger"><button class="close" data-dismiss="alert">×</button><strong>Oopss!&nbsp;</strong>Terjadi Kesalahan Sistem, Silahkan ulangi lagi!!</div>';
						die();
					}
				
			}
			if($target=="general"){
				if($this->input->post('site_title')){
						$logo=$this->input->post('logo_img');
						if($this->input->post('hapus_logo')<>"on"){
							if((isset($_FILES['logo']['tmp_name']))&&($_FILES['logo']['tmp_name']!="")){
								$up=$this->do_upload('logo','');
								if($up==0){
									echo'<div class="alert alert-error"><strong>Error!  </strong>Terjadi Kesalahan pada file logo,Pastikan file yang anda upload sesuai kriteria!!</div>';
									die();
								}
								$this->resize_image($this->upload->upload_path.$this->upload->file_name,150,100);
								if($logo){
									if(file_exists("./uploads/".$logo)){
										unlink("./uploads/".$logo);
									}
								}
								$logo=$this->upload->file_name;
							}
						}else{
							if($logo){
								if(file_exists("./uploads/".$logo)){
									unlink("./uploads/".$logo);
								}
							}
							$logo='';
						}
						$favicon=$this->input->post('favicon_img');
						if($this->input->post('hapus_favicon')<>"on"){
							if((isset($_FILES['favicon']['tmp_name']))&&($_FILES['favicon']['tmp_name']!="")){
								$up=$this->do_upload('favicon','');
								if($up==0){
									echo'<div class="alert alert-error"><strong>Error!  </strong>Terjadi Kesalahan pada file favicon,Pastikan file yang anda upload sesuai kriteria!!</div>';
									die();
								}
								$this->resize_image($this->upload->upload_path.$this->upload->file_name,60,60);
								if($favicon){
								if(file_exists("./uploads/".$favicon)){
									unlink("./uploads/".$favicon);
								}
								}
								$favicon=$this->upload->file_name;
							}
						}else{
							if($favicon){
								if(file_exists("./uploads/".$favicon)){
									unlink("./uploads/".$favicon);
								}
							}
							$favicon='';
						}
						$banner=$this->input->post('banner_img');
						if($this->input->post('hapus_banner')<>"on"){
							if((isset($_FILES['banner']['tmp_name']))&&($_FILES['banner']['tmp_name']!="")){
								$up=$this->do_upload('banner','');
								if($up==0){
									echo'<div class="alert alert-error"><strong>Error!  </strong>Terjadi Kesalahan pada file banner,Pastikan file yang anda upload sesuai kriteria!!</div>';
									die();
								}
								$this->resize_image($this->upload->upload_path.$this->upload->file_name,700,400);
								if($banner){
								if(file_exists("./uploads/".$banner)){
									unlink("./uploads/".$banner);
								}
								}
								$banner=$this->upload->file_name;
							}
						}else{
							if($banner){
								if(file_exists("./uploads/".$banner)){
									unlink("./uploads/".$banner);
								}
							}
							$banner='';
						}
						$data = array(
							'site_title' =>$this->input->post('site_title'),
							'site_desc' =>$this->input->post('site_desc'),
							'logo' =>$logo,
							'banner' =>$banner,
							'email' =>$this->input->post('email'),
							'favicon' =>$favicon,
							'facebook' =>$this->input->post('facebook'),
							 'twitter' =>$this->input->post('twitter'),
							  'youtube' =>$this->input->post('youtube'),
							   'gplus' =>$this->input->post('gplus'),
							    'keyword' =>$this->input->post('keyword'),
							   'description' =>$this->input->post('description')
							);
						$this->db->where('idx_identitas',$this->input->post('idx_identitas'));
						$update=$this->db->update('identitas', $data);  
					if($update){
						echo'<div class="alert alert-success"><strong>Success!</strong>Data berhasil disimpan.</div>';
						echo"<script>
							setTimeout(function () {
								window.location='".site_url('setting/general')."';
							},2000);
						</script>";
					}else{
						echo'<div class="alert alert-danger"><button class="close" data-dismiss="alert">×</button><strong>Oopss!&nbsp;</strong>Terjadi Kesalahan Sistem, Silahkan ulangi lagi!!</div>';
						die();
					}
				}else{
					echo '<div class="alert alert-error"><strong>Error!  </strong>Lengkapi Data yang diperlukan.</div>';
					die();
				}
			}
			if($target=="shop"){
				$error='';
				if((!$this->input->post('nm_toko'))||(!$this->input->post('alamat'))||(!$this->input->post('kota'))||(!$this->input->post('telp'))){
					$error='<p>Lengkapi Data yang Diminta.</p>';
				}
				if($this->input->post('telp')){
					if(!is_numeric($this->input->post('telp'))){
						$error=$error.'<p>No Telp Tidak Benar.</p>';
					}
				}
				if($error){
					echo '<div class="alert alert-error"><strong>Error! </strong>'.$error.'</div>';
					die();
				}
						$data = array(
						   'nm_toko' =>$this->input->post('nm_toko'),
						   'alamat' =>$this->input->post('alamat'),
						   'kota' =>$this->input->post('kota'),
						   'telp' =>$this->input->post('telp'),
						   'fl_ongkir' =>$this->input->post('fl_ongkir'),
						   'fl_refund' =>$this->input->post('fl_refund'),
						   'fl_secure' =>$this->input->post('fl_secure')
						   
						);
						$this->db->where('idx_setting_toko',$this->input->post('idx_setting_toko'));
						$update=$this->db->update('setting_toko', $data);  
					if($update){
						echo'<div class="alert alert-success"><strong>Success!</strong>Data berhasil disimpan.</div>';
						echo"<script>
							setTimeout(function () {
								window.location='".site_url('setting/shop')."';
							},2000);
						</script>";
					}else{
						echo'<div class="alert alert-danger"><button class="close" data-dismiss="alert">×</button><strong>Oopss!&nbsp;</strong>Terjadi Kesalahan Sistem, Silahkan ulangi lagi!!</div>';
						die();
					}
			}
			if($target=="city"){
				$error='';
				if((!$this->input->post('provinsi'))||(!$this->input->post('kota'))||(!$this->input->post('kec'))||(!$this->input->post('city_code'))||(!$this->input->post('zona'))){
					$error='<p>Lengkapi Data yang Diminta.</p>';
				}
				if($error){
					echo '<div class="alert alert-error">'.$error.'</div>';
					die();
				}
						$data = array(
						   'city_code' =>$this->input->post('city_code'),
						   'provinsi' =>$this->input->post('provinsi'),
						   'kota' =>$this->input->post('kota'),
						   'kec' =>$this->input->post('kec'),
						   'zona' =>strtolower($this->input->post('zona'))
						);
						$this->db->where('idx_shipping_location',$this->input->post('idx_shipping_location'));
						$update=$this->db->update('shipping_location', $data);  
					if($update){
						echo'<div class="alert alert-success">Data berhasil disimpan.</div>';
						echo"<script>
							setTimeout(function () {
								window.location='".site_url('setting/city')."';
							},2000);
						</script>";
					}else{
						echo'<div class="alert alert-danger"><button class="close" data-dismiss="alert">×</button><strong>Oopss!&nbsp;</strong>Terjadi Kesalahan Sistem, Silahkan ulangi lagi!!</div>';
						die();
					}
			}
			
		}
		function upload_ongkir(){
			$this->load->library('Spreadsheet_Excel_Reader');
			if((isset($_FILES['path_ongkir']['tmp_name']))&&($_FILES['path_ongkir']['tmp_name']!="")){
				$this->db->query("delete from shipping_price");
				if($_FILES['path_ongkir']['type']=="application/vnd.ms-excel"){
					$data 	= new Spreadsheet_Excel_Reader($_FILES['path_ongkir']['tmp_name']);
					$baris 	= $data->rowcount($sheet_index=0);
					$p		=array("'",",","-","*");
					for ($i=1; $i<=$baris; $i++)
						{
							$city_code 		= trim(str_replace($p,"",$data->val($i, 1)));
							$a_reg 			= trim(str_replace($p,"",$data->val($i, 2)));
							$a_oke			= trim(str_replace($p,"",$data->val($i, 3)));
							$a_yes			= trim(str_replace($p,"",$data->val($i, 4)));
							$b_reg		 	= trim(str_replace($p,"",$data->val($i, 5)));
							$b_oke		 	= trim(str_replace($p,"",$data->val($i, 6)));
							$b_yes		 	= trim(str_replace($p,"",$data->val($i, 7)));
							$c_reg		 	= trim(str_replace($p,"",$data->val($i, 8)));
							$c_oke		 	= trim(str_replace($p,"",$data->val($i, 9)));
							$c_yes		 	= trim(str_replace($p,"",$data->val($i, 10)));
							$d_reg		 	= trim(str_replace($p,"",$data->val($i, 11)));
							$d_oke		 	= trim(str_replace($p,"",$data->val($i, 12)));
							$d_yes		 	= trim(str_replace($p,"",$data->val($i, 13)));
							$sql = "INSERT INTO shipping_price (city_code,a_reg,a_oke,a_yes
																,b_reg,b_oke,b_yes
																,c_reg,c_oke,c_yes
																,d_reg,d_oke,d_yes) 
									VALUES ('$city_code','$a_reg','$a_oke','$a_yes'
											,'$b_reg','$b_oke','$b_yes'
											,'$c_reg','$c_oke','$c_yes'
											,'$d_reg','$d_oke','$d_yes')";
							$this->db->query($sql);
						}
					echo"<script>
								window.location='".site_url('setting/shipping')."';
						</script>";
					
				}else{
					echo'<div class="alert alert-error"><strong>Error!  </strong>File Excel harus bertipe .xls!</div>';
					die();
				}
			}else{
				echo'<div class="alert alert-error"><strong>Error!  </strong>Pilih File Excel bertipe .xls untuk di upload!</div>';
				die();
			}
			
		}
		function upload_city(){
			$this->load->library('Spreadsheet_Excel_Reader');
			if((isset($_FILES['path_city']['tmp_name']))&&($_FILES['path_city']['tmp_name']!="")){
				$this->db->query("delete from shipping_location");
				if($_FILES['path_city']['type']=="application/vnd.ms-excel"){
					$data 	= new Spreadsheet_Excel_Reader($_FILES['path_city']['tmp_name']);
					$baris 	= $data->rowcount($sheet_index=0);
					$p		=array("'",",","-","*");
					for ($i=1; $i<=$baris; $i++)
						{
							$city_code 		= trim(str_replace($p,"",$data->val($i, 1)));
							$provinsi 		= trim(str_replace($p,"",$data->val($i, 2)));
							$kota 			= trim(str_replace($p,"",$data->val($i, 3)));
							$kec			= trim(str_replace($p,"",$data->val($i, 4)));
							if(trim(str_replace($p,"",$data->val($i, 5)))=="v"){
								$zona="a";
							}else if(trim(str_replace($p,"",$data->val($i, 6)))=="v"){
								$zona="b";
							}else if(trim(str_replace($p,"",$data->val($i, 7)))=="v"){
								$zona="c";
							}else{
								$zona="d";
							}
							$sql = "INSERT INTO shipping_location (city_code,provinsi,kota,kec,zona) 
									VALUES ('$city_code','$provinsi','$kota','$kec','$zona')";
							$this->db->query($sql);
						}
					echo"<script>
								window.location='".site_url('setting/city')."';
						</script>";
					
				}else{
					echo'<div class="alert alert-error"><strong>Error!  </strong>File Excel harus bertipe .xls!</div>';
					die();
				}
			}else{
				echo'<div class="alert alert-error"><strong>Error!  </strong>Pilih File Excel bertipe .xls untuk di upload!</div>';
				die();
			}
			
		}
		function upload_template(){
			if((isset($_FILES['template']['tmp_name']))&&($_FILES['template']['tmp_name']!=""))
			{
				if(!$this->input->post('nm_template')){
					echo'<div class="alert alert-error"><strong>Error!</strong>Ketik Nama Template!</div>';
					die();
				}
				$nm_template=strtolower($this->input->post('nm_template'));
				$nm_template=str_replace(' ','-',$nm_template);
				if (!file_exists('./assets/'.$nm_template)) {
				    mkdir('./assets/'.$nm_template, 0777, true);
				}else{
					echo'<div class="alert alert-error"><strong>Error!  </strong>Nama Direktori sudah ada!</div>';
					die();
				}
				$up=$this->do_upload_template('template',$nm_template);
				if($up<>1){
				echo'<div class="alert alert-danger"><button class="close" data-dismiss="alert">×</button><strong>Error!&nbsp;</strong>'.$up.'</div>';
						die();
				}
				$filename = $nm_template.".zip";
				$filepath = "./assets/";
				$zip = new ZipArchive;
				chmod($filepath.$filename,0777);
				$zip->open($filepath.$filename);
	    		$zip->extractTo('./assets/'.$nm_template);
	    		$zip->close();
	    		unlink($filepath.$filename);
				echo"<script>
						window.location='".site_url('setting/template')."';
				</script>";
			}else{
				echo'<div class="alert alert-error"><strong>Error!  </strong>Anda Belum Memilih Template!</div>';
				die();
			}
			
		}
		function list_account(){
			$sEcho=$_GET['sEcho'];
			$iDisplayStart=$_GET['iDisplayStart'];
			$iDisplayLenght=$_GET['iDisplayLength'];
			$sort_by=$_GET['iSortCol_0'];
			$nm_kolom=array('idx_account','type_account','no_account');
			$sTable = "account_web";
			$sSortDir_0=$_GET['sSortDir_0'];
			$iTotalRecordssql=$this->db->query("SELECT * FROM $sTable");
			$iTotalRecords=$iTotalRecordssql->num_rows();
			$sWhere = "";
				if ( isset($_GET['sSearch']) && $_GET['sSearch'] != "" )
				{
					$sWhere = "WHERE (";
					for ( $i=0 ; $i<count($nm_kolom) ; $i++ )
					{
						if ( isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" )
						{
							if($nm_kolom[$i]!="fl_active"){
								$sWhere .= "".$nm_kolom[$i]." LIKE '%".mysql_real_escape_string( $_GET['sSearch'] )."%' OR ";
							}
						}
					}
					$sWhere = substr_replace( $sWhere, "", -3 );
					$sWhere .= ')';
				}
		
				/* Individual column filtering */
				for ( $i=0 ; $i<count($nm_kolom) ; $i++ )
				{
					if ( isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' )
					{
						if ( $sWhere == "" )
						{
							$sWhere = "WHERE ";
						}
						else
						{
							$sWhere .= " AND ";
						}
						$sWhere .= "".$nm_kolom." LIKE '%".mysql_real_escape_string($_GET['sSearch_'.$i])."%' ";
					}
				}

				$sQuery ="SELECT ".str_replace(" , ", " ", implode(", ", $nm_kolom))." FROM  $sTable $sWhere
							order by
							$nm_kolom[$sort_by] $sSortDir_0
							limit $iDisplayStart,$iDisplayLenght";
				$query=$this->db->query($sQuery);
				$data_arr=array();
				$i==0;
				foreach($query->result_array() as $Row){
					$res	=$this->additional_model->get_where_row('type_account','code',$Row['type_account']);
					$action="
						<a href='".site_url('setting/edit/account/'.$Row['idx_account'])."' rel='tooltip' title='Edit'>Edit</a> &nbsp;|&nbsp;
						<a href='#' onClick='if(confirm(\"Anda Yakin akan menghapus data ini?\")) window.location=\"".site_url()."/setting/delete/account/".$Row['idx_account']."\";' rel='tooltip' title='Delete'>Delete</a>
						";
					//$checkbox="<input type='radio' name='cd_artikel' value='".$Row['cd_artikel']."' onClick=view_list('$Row[cd_artikel]') >&nbsp;";
					$data_arr[]=array($action,$res->nama,$Row['no_account'],"DT_RowId"=>"td_".$Row['idx_account']);
					$i++;
				}
				$data_json=array('sEcho'=>$sEcho,'iTotalRecords'=>$iTotalRecords,'iTotalDisplayRecords'=>$iTotalRecords,'aaData'=>$data_arr);
				echo json_encode($data_json);
		}
		function list_page(){
			$sEcho=$_GET['sEcho'];
			$iDisplayStart=$_GET['iDisplayStart'];
			$iDisplayLenght=$_GET['iDisplayLength'];
			$sort_by=$_GET['iSortCol_0'];
			$nm_kolom=array('idx_content_account','judul','fl_share');
			$sTable = "content_account";
			$sSortDir_0=$_GET['sSortDir_0'];
			$iTotalRecordssql=$this->db->query("SELECT * FROM $sTable  ORDER BY idx_content_account desc");
			$iTotalRecords=$iTotalRecordssql->num_rows();
			$sWhere = "";
				if ( isset($_GET['sSearch']) && $_GET['sSearch'] != "" )
				{
					$sWhere = "WHERE (";
					for ( $i=0 ; $i<count($nm_kolom) ; $i++ )
					{
						if ( isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" )
						{
							if($nm_kolom[$i]!="fl_active"){
								$sWhere .= "".$nm_kolom[$i]." LIKE '%".mysql_real_escape_string( $_GET['sSearch'] )."%' OR ";
							}
						}
					}
					$sWhere = substr_replace( $sWhere, "", -3 );
					$sWhere .= ')';
				}
		
				/* Individual column filtering */
				for ( $i=0 ; $i<count($nm_kolom) ; $i++ )
				{
					if ( isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' )
					{
						if ( $sWhere == "" )
						{
							$sWhere = "WHERE ";
						}
						else
						{
							$sWhere .= " AND ";
						}
						$sWhere .= "".$nm_kolom." LIKE '%".mysql_real_escape_string($_GET['sSearch_'.$i])."%' ";
					}
				}

				$sQuery ="SELECT ".str_replace(" , ", " ", implode(", ", $nm_kolom))." FROM  $sTable $sWhere
							order by
							$nm_kolom[$sort_by] $sSortDir_0
							limit $iDisplayStart,$iDisplayLenght";
				$query=$this->db->query($sQuery);
				$data_arr=array();
				$i==0;
				foreach($query->result_array() as $Row){
				if($Row['fl_share']==1){
					$share="Yes";
				}else{
					$share="No";
				}
					$action="
						<a href='".site_url('setting/edit/page/'.$Row['idx_content_account'])."' rel='tooltip' title='Edit'>Edit</a> &nbsp;|&nbsp;
					<!--	<a href='#' onClick='if(confirm(\"Anda Yakin akan menghapus data ini?\")) window.location=\"".site_url()."/setting/delete/page/".$Row['idx_content_account']."\";' rel='tooltip' title='Delete'>Delete</a>-->
						";
					//$checkbox="<input type='radio' name='cd_artikel' value='".$Row['cd_artikel']."' onClick=view_list('$Row[cd_artikel]') >&nbsp;";
					$data_arr[]=array($action,$Row['judul'],$share,"DT_RowId"=>"td_".$Row['idx_content_account']);
					$i++;
				}
				$data_json=array('sEcho'=>$sEcho,'iTotalRecords'=>$iTotalRecords,'iTotalDisplayRecords'=>$iTotalRecords,'aaData'=>$data_arr);
				echo json_encode($data_json);
		}
		function list_shipping(){
			$sEcho=$_GET['sEcho'];
			$iDisplayStart=$_GET['iDisplayStart'];
			$iDisplayLenght=$_GET['iDisplayLength'];
			$sort_by=$_GET['iSortCol_0'];
			$nm_kolom=array('idx_shipping_price','city_code','a_reg','a_oke','a_yes','b_reg','b_oke','b_yes','c_reg','c_oke','c_yes','d_reg','d_oke','d_yes');
			$sTable = "shipping_price";
			$sSortDir_0=$_GET['sSortDir_0'];
			$sWhere = "";
				if ( isset($_GET['sSearch']) && $_GET['sSearch'] != "" )
				{
					$sWhere = "WHERE (";
					for ( $i=0 ; $i<count($nm_kolom) ; $i++ )
					{
						if ( isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" )
						{
							if($nm_kolom[$i]!="idx_shipping_location"){
								$sWhere .= "".$nm_kolom[$i]." LIKE '%".mysql_real_escape_string( $_GET['sSearch'] )."%' OR ";
							}
						}
					}
					$sWhere = substr_replace( $sWhere, "", -3 );
					$sWhere .= ')';
				}
		
				/* Individual column filtering */
				for ( $i=0 ; $i<count($nm_kolom) ; $i++ )
				{
					if ( isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' )
					{
						if ( $sWhere == "" )
						{
							$sWhere = "WHERE ";
						}
						else
						{
							$sWhere .= " AND ";
						}
						$sWhere .= "".$nm_kolom." LIKE '%".mysql_real_escape_string($_GET['sSearch_'.$i])."%' ";
					}
				}
				$iTotalRecordssql	=$this->db->query("SELECT * FROM $sTable $sWhere");
				$iTotalRecords		=$iTotalRecordssql->num_rows();
				$sQuery 			="SELECT ".str_replace(" , ", " ", implode(", ", $nm_kolom))." FROM  $sTable $sWhere
									order by
									$nm_kolom[$sort_by] $sSortDir_0
									limit $iDisplayStart,$iDisplayLenght";
				$query				=$this->db->query($sQuery);
				$data_arr=array();
				$i==0;
				foreach($query->result_array() as $Row){
					$action="<a href='".site_url('setting/edit/shipping/'.$Row['idx_shipping_price'])."' rel='tooltip' title='Edit'>Edit</a>";
					$data_arr[]=array($action,$Row['city_code'],$this->currency($Row['a_reg']),$this->currency($Row['a_oke']),$this->currency($Row['a_yes']),$this->currency($Row['b_reg']),$this->currency($Row['b_oke']),$this->currency($Row['b_yes']),$this->currency($Row['c_reg']),$this->currency($Row['c_oke']),$this->currency($Row['c_yes']),$this->currency($Row['d_reg']),$this->currency($Row['d_oke']),$this->currency($Row['d_yes']),"DT_RowId"=>"td_".$Row['idx_shipping_price']);
					$i++;
				}
				$data_json=array('sEcho'=>$sEcho,'iTotalRecords'=>$iTotalRecords,'iTotalDisplayRecords'=>$iTotalRecords,'aaData'=>$data_arr);
				echo json_encode($data_json);
		}
		function list_city(){
			$sEcho=$_GET['sEcho'];
			$iDisplayStart=$_GET['iDisplayStart'];
			$iDisplayLenght=$_GET['iDisplayLength'];
			$sort_by=$_GET['iSortCol_0'];
			$nm_kolom=array('idx_shipping_location','city_code','provinsi','kota','kec','zona');
			$sTable = "shipping_location";
			$sSortDir_0=$_GET['sSortDir_0'];
			$sWhere = "";
				if ( isset($_GET['sSearch']) && $_GET['sSearch'] != "" )
				{
					$sWhere = "WHERE (";
					for ( $i=0 ; $i<count($nm_kolom) ; $i++ )
					{
						if ( isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" )
						{
							if($nm_kolom[$i]!="idx_shipping_location"){
								$sWhere .= "".$nm_kolom[$i]." LIKE '%".mysql_real_escape_string( $_GET['sSearch'] )."%' OR ";
							}
						}
					}
					$sWhere = substr_replace( $sWhere, "", -3 );
					$sWhere .= ')';
				}
		
				/* Individual column filtering */
				for ( $i=0 ; $i<count($nm_kolom) ; $i++ )
				{
					if ( isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' )
					{
						if ( $sWhere == "" )
						{
							$sWhere = "WHERE ";
						}
						else
						{
							$sWhere .= " AND ";
						}
						$sWhere .= "".$nm_kolom." LIKE '%".mysql_real_escape_string($_GET['sSearch_'.$i])."%' ";
					}
				}
				$iTotalRecordssql	=$this->db->query("SELECT * FROM $sTable $sWhere");
				$iTotalRecords		=$iTotalRecordssql->num_rows();
				$sQuery 			="SELECT ".str_replace(" , ", " ", implode(", ", $nm_kolom))." FROM  $sTable $sWhere
									order by
									$nm_kolom[$sort_by] $sSortDir_0
									limit $iDisplayStart,$iDisplayLenght";
				$query				=$this->db->query($sQuery);
				$data_arr=array();
				$i==0;
				foreach($query->result_array() as $Row){
					$action="<a href='".site_url('setting/edit/city/'.$Row['idx_shipping_location'])."' rel='tooltip' title='Edit'>Edit</a>";
					$data_arr[]=array($action,$Row['provinsi'],$Row['kota'],$Row['kec'],$Row['city_code'],strtoupper($Row['zona']),"DT_RowId"=>"td_".$Row['idx_shipping_location']);
					$i++;
				}
				$data_json=array('sEcho'=>$sEcho,'iTotalRecords'=>$iTotalRecords,'iTotalDisplayRecords'=>$iTotalRecords,'aaData'=>$data_arr);
				echo json_encode($data_json);
		}
		function currency($number){
			if(($number<>"")&&($number<>0)){
				return "Rp. ".number_format($number,0,',','.');
			}else{
				return "-";
			}
		}
		
}
