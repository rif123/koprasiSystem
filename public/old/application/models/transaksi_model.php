<?php 
date_default_timezone_set('Asia/Jakarta');
defined('BASEPATH') OR exit('No direct script access allowed');
class transaksi_model extends CI_model{
		function __construct(){
			parent::__construct();
			$this->load->database();
			$this->load->helper(array('form', 'url'));
			$this->load->library('cart');
		}
		function get_shipping(){
			$q=$this->db->query("SELECT distinct provinsi FROM shipping_location order by provinsi");
			return $q;
		}
		function look_kecamatan(){
			$kota	=$this->input->post('kota');
			$q		=$this->db->query("SELECT zona,city_code,kec FROM shipping_location where kota='$kota' order by kec");
			$html='<option>--Pilih Kecamatan--</option>';
			foreach($q->result() as $kec){
				$html=$html.'<option value="'.$kec->zona."|".$kec->city_code."|".$kec->kec.'">'.$kec->kec.'</option>';
			}
			echo $html;
		}
		function look_kecamatan_account(){
			$kota	=$this->input->post('kota');
			$q		=$this->db->query("SELECT zona,city_code,kec FROM shipping_location where kota='$kota' order by kec");
			$html='<option>--Pilih Kecamatan--</option>';
			foreach($q->result() as $kec){
				$html=$html.'<option value="'.$kec->kec.'">'.$kec->kec.'</option>';
			}
			echo $html;
		}
		function look_kota(){
			$provinsi	=$this->input->post('provinsi');
			$q		=$this->db->query("SELECT distinct kota FROM shipping_location where provinsi='$provinsi' order by kota");
			$html='<option>--Pilih Kota--</option>';
			foreach($q->result() as $kota){
				$html=$html.'<option value="'.$kota->kota.'">'.$kota->kota.'</option>';
			}
			echo $html;
		}
		function get_list($idx){
			$q		=$this->db->query("SELECT a.*,b.*,b.discount as discount_order FROM rl_order b join product a on b.idx_product=a.idx_product where b.idx_order='$idx'");
			return $q;
		}
		function bonus_product($idx){
			$q		=$this->db->query("SELECT b.idx_bonus_product FROM rl_order b join product a on b.idx_product=a.idx_product where b.idx_order='$idx' and b.idx_bonus_product<>0");
			return $q;
		}
		function fl_free_shipping($idx){
			$q=$this->db->query("SELECT fl_free_shipping from product where idx_product='$idx'")->row();
			return $q->fl_free_shipping;
		}
		function cek_bogof($idx){
			return $this->db->query("select a.*,b.idx_type_promo from content_prom a join promo_management b on a.idx_promo=b.idx_promo where a.idx_product='$idx' and b.idx_type_promo=2");
			
		}
		function do_upload($htmlFieldName,$path){
				$config['file_name'] = time();
				$config['upload_path'] = './uploads/confirm_payment';
				$config['allowed_types'] = 'gif|jpg|png|ico';
				$config['max_size'] = '500';
				$config['max_width'] = '1000';
				$config['max_height'] = '1000';
				$this->load->library('upload', $config);
				unset($config);
				if(!$this->upload->do_upload($htmlFieldName)){
					return 0;
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
		function confirm_proses(){
			if(($this->input->post('id_pesanan'))&&($this->input->post('idx_rek'))&&($this->input->post('tgl_transfer'))&&($this->input->post('user_bank'))&&($this->input->post('user_acc'))&&($this->input->post('nm_acc'))&&($this->input->post('total_pembayaran'))){
				if (!is_numeric($this->input->post('total_pembayaran'))){
					echo '<div class="message error" style="padding: 5px 20px;margin: 0 20px;color:#D12626;font-size: 11px;">Mohon Masukan Nominal Pembayaran dengan Benar, Nominal Pembayaran Harus Berupa Angka.</div>';
					die();
				}
				$cek_pesanan=$this->db->get_where('order', array('id_pesanan'=>$this->input->post('id_pesanan')))->num_rows();
				if($cek_pesanan==0){
					echo '<div class="message error" style="padding: 5px 20px;margin: 0 20px;color:#D12626;font-size: 11px;">No Transaksi tidak ditemukan.</div>';
					die();
				}
				$q=$this->db->get_where('order', array('id_pesanan'=>$this->input->post('id_pesanan')))->row();
				if($q->total_tagihan!=$this->input->post('total_pembayaran')){
					echo '<div class="message error" style="padding: 5px 20px;margin: 0 20px;color:#D12626;font-size: 11px;">Total Transfer tidak Sesuai Total Tagihan, Harap Cek Kembali.</div>';
					die();
				}
						$bukti_pembayaran='';
						if(isset($_FILES['bukti_pembayaran']['name'])){
							$up=$this->do_upload('bukti_pembayaran','');
							if($up==0){
								echo '<div class="message error" style="padding: 5px 20px;margin: 0 20px;color:#D12626;font-size: 11px;">Terjadi Kesalahan Pada File Bukti Pembayaran, Silahkan ulangi lagi!!</div>';
								die();
							}
							$bukti_pembayaran=$this->upload->file_name;
						}
						$id_pesanan=$this->input->post('id_pesanan');						$Qpayment	=$this->db->get_where("payment_confirm",array("id_pesanan"=>$id_pesanan));						if($Qpayment->num_rows()==0){
							$data = array(
								'tgl_konfirmasi' =>date('y-m-d'),
							   'id_pesanan' =>$id_pesanan,
							   'tgl_transfer' =>$this->input->post('tgl_transfer'),
							   'idx_rek' =>$this->input->post('idx_rek'),
							   'user_bank' =>$this->input->post('user_bank'),
							   'user_acc' =>$this->input->post('user_acc'),
							   'nm_acc' =>$this->input->post('nm_acc'),
							   'total_pembayaran' =>$this->input->post('total_pembayaran'),
							   'bukti_pembayaran' =>$bukti_pembayaran
							);
							$save=$this->db->insert('payment_confirm', $data); 
							if($save){
							$this->db->query("update `order` set cd_status=8 where id_pesanan='$id_pesanan'");
								echo '<div class=" success" style="padding: 5px 20px;margin: 0 20px;font-size: 11px;">Terimakasih Pesanan Anda akan segera Kami proses.</div>';
								echo"<script>
								setTimeout(function () {
									window.location='".site_url('page')."';
								},1000);
							</script>";
							}else{
								echo'<div class="error mar_b1"><p style="padding:0;">Terjadi Kesalahan Sistem, Silahkan ulangi lagi!!</p></div>';
								die();
							}						}else{							$data = array(								'tgl_konfirmasi' =>date('y-m-d'),							   'id_pesanan' =>$id_pesanan,							   'tgl_transfer' =>$this->input->post('tgl_transfer'),							   'idx_rek' =>$this->input->post('idx_rek'),							   'user_bank' =>$this->input->post('user_bank'),							   'user_acc' =>$this->input->post('user_acc'),							   'nm_acc' =>$this->input->post('nm_acc'),							   'total_pembayaran' =>$this->input->post('total_pembayaran'),							   'bukti_pembayaran' =>$bukti_pembayaran							);							$this->db->where('id_pesanan',$id_pesanan);							$upd=$this->db->update('payment_confirm', $data);							if($upd){							$this->db->query("update `order` set cd_status=8 where id_pesanan='$id_pesanan'");								echo '<div class=" success" style="padding: 5px 20px;margin: 0 20px;font-size: 11px;">Terimakasih Pesanan Anda akan segera Kami proses.</div>';								echo"<script>								setTimeout(function () {									window.location='".site_url('page')."';								},1000);							</script>";							}else{								echo'<div class="error mar_b1"><p style="padding:0;">Terjadi Kesalahan Sistem, Silahkan ulangi lagi!!</p></div>';								die();							}												}
			}else{
				echo '<div class="message error" style="padding: 5px 20px;margin: 0 20px;color:#D12626;font-size: 11px;">Lengkapi Data yang Diminta.</div>';
					
			}
		}
		function kalkulasi(){
			$q=$this->db->query("Select fl_ongkir from setting_toko")->row()->fl_ongkir;
			$total_harga		=$this->input->post('total_harga');
			$expedisi			=$this->input->post('expedisi');
			$fl_free_shipping	=$this->input->post('fl_free_shipping');
			if($this->input->post('berat')>1000){
				$berat=$this->cek_berat($this->input->post('berat'));
			}else{
				$berat=1;
			}
			if($q==1){
				$kec	=$this->input->post('kec_2');
				if($this->input->post('fl_drop_shipper')=="on"){
					$kec	=$this->input->post('kec');
				}
				$pieces_kec =explode("|",$kec);
				$zona		=$pieces_kec[0];
				$city_code	=$pieces_kec[1];
				$field		=$zona."_".$expedisi;
				if($fl_free_shipping!=0){
					$q				=$this->db->query("SELECT ".$field." FROM shipping_price where city_code='$city_code'")->row();
					if(($q->$field==0)||($q->$field=="")){
						$total_harga	=$total_harga;
						$ongkir			="<b>Tidak Tersedia</b>";
						$ongkir_dasar	="<b>Tidak Tersedia</b>";
						$gratis			=0;
					}else{
						$total_harga	=$total_harga+($q->$field*$berat);
						$ongkir			='Rp. '.number_format(($q->$field*$berat),0,',','.');
						$ongkir_dasar	=$q->$field.' /Kg';
						$gratis			=0;
					}
					echo'{"ongkir":"'.$ongkir.'","total":"Rp.'.number_format($total_harga,0,',','.').'","ongkir_dasar":"'.$ongkir_dasar.'","gratis":"'.$gratis.'"}';
				}else{
					$kota	=$this->input->post('kota_2');
					if($this->input->post('fl_drop_shipper')=="on"){
						$kota	=$this->input->post('kota');
					}
					$city_free=$this->db->query("SELECT * FROM free_shipping_city where kota='$kota'")->num_rows();
					if($city_free>0){
						$gratis			=1;
						echo'{"ongkir":"<b style=color:#50E00D>Gratis</b>","total":"Rp.'.number_format($total_harga,0,',','.').'","ongkir_dasar":"<b style=color:#50E00D>Gratis</b>","gratis":"'.$gratis.'"}';
					}else{
						$q				=$this->db->query("SELECT ".$field." FROM shipping_price where city_code='$city_code'")->row();
						if(($q->$field==0)||($q->$field=="")){
							$total_harga	=$total_harga;
							$ongkir			="<b>Tidak Tersedia</b>";
							$ongkir_dasar	="<b>Tidak Tersedia</b>";
							$gratis			=0;
						}else{
							$total_harga	=$total_harga+($q->$field*$berat);
							$ongkir			='Rp. '.number_format(($q->$field*$berat),0,',','.');
							$ongkir_dasar	=$q->$field.' /Kg';
							$gratis			=0;
						}
						echo'{"ongkir":"'.$ongkir.'","total":"Rp.'.number_format($total_harga,0,',','.').'","ongkir_dasar":"'.$ongkir_dasar.'","gratis":"'.$gratis.'"}';
					}
				}
			}else{
				echo'{"ongkir":"Harga belum termasuk ongkir","total":"Rp.'.number_format($total_harga,0,',','.').'"}';
			}
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
		function bayar(){
		$error="";
		/*-----Validasi-----*/
		if((!$this->input->post('password'))||(!$this->input->post('full_name'))||(!$this->input->post('alamat'))||(!$this->input->post('kec')))
			{
				$error=$error.'<p class="error_point">- Silahkan Lengkapi Data!</p>';
			}
		if($this->input->post('fl_drop_shipper')<>"on"){
			if((!$this->input->post('full_name_2'))||(!$this->input->post('hp_2'))||(!$this->input->post('alamat_2'))||(!$this->input->post('kota_2'))||(!$this->input->post('kec_2'))||(!$this->input->post('provinsi_2')))
			{
				$error=$error.'<p class="error_point">- Silahkan Lengkapi Data!</p>';
			}
		}
		if($this->input->post('fl_approve')<>"on"){
				$error=$error.'<p class="error_point">- Silahkan Centang Setujui Ketentuan dan Syarat!</p>';
		}
		if(!is_numeric($this->input->post('hp'))){
			$error=$error.'<p class="error_point">- Hp Tidak Boleh Huruf</p>';
		}
		if($this->input->post('no_telepon')){
			if(!is_numeric($this->input->post('no_telepon'))){
				$error=$error.'<p class="error_point">- No telepon Tidak Boleh Huruf</p>';
			}
		}
		if (!filter_var($this->input->post('email'), FILTER_VALIDATE_EMAIL)){
			$error=$error.'<p class="error_point">- Email Harus Sesuai Kriteria</p>';
		}
		if($this->input->post('total_harga')==0){
			$error=$error.'<p class="error_point">- Barang Pesanan Anda Sudah Habis</p>';
		}
		if($error<>""){
			echo '<div class="message error" style="padding: 5px 20px;margin: 0 20px;color:#D12626;font-size: 11px;">'.$error.'</div>';
			die();
		}
		$total_harga=$this->input->post('total_harga');
		if($this->input->post('fl_set_shipping')==1){
		/*---Validasi Total Tagihan---*/
			$expedisi	=$this->input->post('expedisi');
			$kec		=$this->input->post('kec_2');
			$kota		=$this->input->post('kota_2');
			if($this->input->post('fl_drop_shipper')=="on"){
				$kec		=$this->input->post('kec');
				$kota		=$this->input->post('kota');
			}
			$pieces_kec =explode("|",$kec);
			$zona		=$pieces_kec[0];
			$city_code	=$pieces_kec[1];
			$field		=$zona."_".$expedisi;
			if($this->input->post('berat')>1000){
				$berat=$this->cek_berat($this->input->post('berat'));
			}else{
				$berat=1;
			}
			$q		=$this->get_shipping_order($city_code,$field);
			if($this->input->post('fl_free_shipping')<>0){
				if(($q->$field==0)||(!$q->$field)){
					echo '<div class="message error" style="padding: 5px 20px;margin: 0 20px;color:#D12626;font-size: 11px;"><p class="error_point">- Expedisi yang anda pilih tidak tersedia di lokasi anda.</p></div>';
					die();
				}else{
					$ongkir_dasar	=$q->$field;
					$ongkir			=$q->$field*$berat;
					$total_harga	=$total_harga+$ongkir;
				}
			}else{
				if($this->cek_kota_free($kota)>0){
					$ongkir			="";
					$ongkir_dasar	="";
				}else{
					if(($q->$field==0)||(!$q->$field)){
						echo '<div class="message error" style="padding: 5px 20px;margin: 0 20px;color:#D12626;font-size: 11px;"><p class="error_point">- Expedisi yang anda pilih tidak tersedia di lokasi anda.</p></div>';
						die();
					}else{
						$ongkir_dasar	=$q->$field;
						$ongkir			=$q->$field*$berat;
						$total_harga	=$total_harga+$ongkir;
					}
				}
			}
		/*---Validasi Total Tagihan---*/
		}else{
			$expedisi		='';
			$ongkir_dasar	=0;
			$ongkir			=0;
		}
		if(!is_numeric($this->input->post('idx_pelanggan'))){
			$email		=$this->input->post('email');
			$Quser		=$this->db->query("select * from pelanggan where email='$email'");
			if($Quser->num_rows()>0){
				echo '<div class="message error" style="padding: 5px 20px;margin: 0 20px;color:#D12626;font-size: 11px;">Email sudah terdaftar, Silakan gunakan Email lain.</div>';
				die();
			}
		}
		/*-----Validasi-----*/
		if(!is_numeric($this->input->post('idx_pelanggan'))){
			/*-----Save Pelanggan-----*/
					$ins_cus = array('full_name' =>$this->input->post('full_name'),
								 'jenis_kelamin' 	=>$this->input->post('jenis_kelamin'),
								  'tgl_lahir' 	=>$this->input->post('tgl_lahir'),
								 'email' 	=>$this->input->post('email'),
								 'password' =>md5($this->input->post('password')),
								 'alamat' 	=>$this->input->post('alamat'),
								 'provinsi' =>$this->input->post('provinsi'),
								 'kota' 	=>$this->input->post('kota'),
								 'kec' 		=>$this->convert_kec($this->input->post('kec')),
								 'zip_code' =>$this->input->post('zip_code'),
								 'no_telepon' =>$this->input->post('no_telepon'),
								 'hp' =>$this->input->post('hp'));
					$proc=$this->db->insert('pelanggan', $ins_cus); 
			/*-----Save Pelanggan-----*/
		}else{
			/*-----Update Pelanggan-----*/
					$upd_cus = array('full_name' =>$this->input->post('full_name'),
										 'alamat' =>$this->input->post('alamat'),
										 'provinsi' =>$this->input->post('provinsi'),
										 'kota' =>$this->input->post('kota'),
										 'kec' =>$this->convert_kec($this->input->post('kec')),
										 'zip_code' =>$this->input->post('zip_code'),
										 'no_telepon' =>$this->input->post('no_telepon'),
										 'hp' =>$this->input->post('hp'));
					$this->db->where('idx_pelanggan',$this->input->post('idx_pelanggan'));
					$proc=$this->db->update('pelanggan', $upd_cus); 					
			/*-----Update Pelanggan-----*/
		}
		/*-----Save newsletter-----*/
			if($this->input->post('fl_newsletter')=="on"){
				$cek=$this->db->get_where("newsletter_cus",array("email"=>$this->input->post('email')))->num_rows();
				if($cek==0){
					$ins_newsletter = array('email' =>$this->input->post('email'));
					$this->db->insert('newsletter_cus', $ins_newsletter);	
				}
			}
		/*-----Save newsletter-----*/
					if($proc){
						if(!is_numeric($this->input->post('idx_pelanggan'))){
							$Qpel					=$this->db->query("select * from pelanggan order by idx_pelanggan desc limit 1")->row();
							$idx_pelanggan			=$Qpel->idx_pelanggan;
						}else{
							$idx_pelanggan	=$this->input->post('idx_pelanggan');
						}
						/*-----Save drop_shipper-----*/
						if($this->input->post('fl_drop_shipper')<>"on"){
							$ins_drop_shipper = array('idx_pelanggan' =>$idx_pelanggan,
											 'full_name' =>$this->input->post('full_name_2'),
											 'alamat' =>$this->input->post('alamat_2'),
											 'provinsi' =>$this->input->post('provinsi_2'),
											 'kota' =>$this->input->post('kota_2'),
											 'kec' =>$this->convert_kec($this->input->post('kec_2')),
											 'zip_code' =>$this->input->post('zip_code_2'),
											 'no_telepon' =>$this->input->post('no_telepon_2'),
											 'hp' =>$this->input->post('hp_2'));
							$this->db->insert('drop_shipper', $ins_drop_shipper); 
							$w					=$this->db->query("select idx_drop_shipper from drop_shipper order by idx_drop_shipper desc limit 1")->row();
							$idx_drop_shipper	=$w->idx_drop_shipper;
							$fl_drop_shipper	=1;
						}else{
							$idx_drop_shipper	="";
							$fl_drop_shipper	=0;
						}
						/*-----Save drop_shipper-----*/
						/*-----Save Order-----*/
						$ins_order 		= array('id_pesanan' =>$idx_pelanggan.date('Ymdhms'),
										 'tgl_order' =>date('Y-m-d'),
										 'idx_pelanggan' =>$idx_pelanggan,
										 'total_tagihan' =>$total_harga,
										 'total_tagihan_produk' =>$this->input->post('total_harga_produk'),
										 'discount_pembelian' =>$this->input->post('discount_max_pembelian'),
										 'fl_drop_shipper' =>$fl_drop_shipper,
										 'idx_drop_shipper' =>$idx_drop_shipper,
										 'jne_expedisi' =>$expedisi,
										 'ongkir_dasar' =>$ongkir_dasar,
										 'ongkir' =>$ongkir, 
										 'berat' =>$this->input->post('berat'),
										 'fl_set_shipping' =>$this->input->post('fl_set_shipping'), 
										 'cd_status' =>0);
						$this->db->insert('order', $ins_order); 
					/*-----Save Order-----*/
					/*-----Save Relasi Order-----*/
					$rl				=$this->db->query("select * from `order` order by idx_order desc limit 1")->row();
					$idx_order		=$rl->idx_order;
						foreach($this->cart->contents() as $item){
							$id=$item['id'];
							$elm_product	=$this->db->query("SELECT a.type_product,b.stock-stock_akhir as total_stock FROM product a join attribute_product b on a.idx_product=b.idx_product where a.idx_product='$id'")->row();
							if($elm_product->total_stock<>0){	
								/*---Check Bogof------------*/
									$bonus='';
									if($this->cek_bogof($item['id'])->num_rows()>0){
										$bonus=$this->cek_bogof($item['id'])->row()->bogof_caption;
									}
								/*---Check Bogof------------*/
								$discount	=0;
								/*---Check Promo Discount---*/
									if($this->promo_persentasi($item['id'])<>false){
										$discount	=$this->promo_persentasi($item['id']);
									}else{
										$discount=$this->db->query("select discount from product where idx_product='$item[id]'")->row()->discount;
									}
								/*---Check Promo Discount---*/
								if($elm_product->type_product==3){
										$ins_rl			=array('idx_order'=>$idx_order,'idx_product'=>$item['id'],'qty'=>$item['qty'],'discount'=>$discount,'bonus_bogof'=>$bonus);
								}else{
									foreach($this->cart->product_options($item['rowid']) as $option_name => $option_value){
											$ins_rl			=array('idx_order'=>$idx_order,'idx_product'=>$item['id'],'idx_attribute_product'=>$option_name,'qty'=>$item['qty'],'discount'=>$discount,'bonus_bogof'=>$bonus);
									}
								}
								$this->db->insert('rl_order', $ins_rl); 
								/*-----Delete wishlist-----*/
							}
							
						}
						if($this->input->post('idx_wishlist')<>0){
								$row_wishlist	=$this->db->get_where("wishlist", array("idx_wishlist" =>$this->input->post('idx_wishlist')))->row();
								$idx_product	=$row_wishlist->idx_product;
								if($row_wishlist->qty>$this->look_stock_ext($row_wishlist->idx_attribute_product,$idx_product)){
									$qty=$this->look_stock_ext($row_wishlist->idx_attribute_product,$idx_product);
								}else{
									$qty=$row_wishlist->qty;
								}
								/*---Check Bogof------------*/
									$bonus='';
									if($this->cek_bogof($idx_product)->num_rows()>0){
										$bonus=$this->cek_bogof($idx_product)->row()->bogof_caption;
									}
								/*---Check Bogof------------*/
								$discount	=0;
								/*---Check Promo Discount---*/
									if($this->promo_persentasi($idx_product)<>false){
										$discount	=$this->promo_persentasi($idx_product);
									}else{
										$discount=$this->db->query("select discount from product where idx_product='$idx_product'")->row()->discount;
									}
								/*---Check Promo Discount---*/
								$type_product	=$this->db->query("select type_product from product where idx_product='$idx_product'")->row();
								if($type_product->type_product==3){
									$ins_rl			=array('idx_order'=>$idx_order,'idx_product'=>$idx_product,'qty'=>$qty,'discount'=>$discount,'bonus_bogof'=>$bonus);
								}else{
									$ins_rl			=array('idx_order'=>$idx_order,'idx_product'=>$idx_product,'idx_attribute_product'=>$row_wishlist->idx_attribute_product,'qty'=>$qty,'discount'=>$discount,'bonus_bogof'=>$bonus);
								}
								$this->db->insert('rl_order', $ins_rl);
								if($row_wishlist->qty-$qty==0){
									$this->db->delete('wishlist', array('idx_wishlist' =>$this->input->post('idx_wishlist')));
								}else{
									$qty=$row_wishlist->qty-$qty;
									$upd_wishlist=array('qty'=>$qty);
									$this->db->where('idx_wishlist',$this->input->post('idx_wishlist'));
									$this->db->update('wishlist', $upd_wishlist); 
								}
						}
					/*-----Save Relasi Order-----*/
							if($this->session->userdata('set_login_cus')!=TRUE){
								$newdata = array(
									'full_name'  => $this->input->post('full_name'),
									'email'     => $this->input->post('email'),
									'idx_pelanggan'  => $idx_pelanggan,
									'set_login_cus' => TRUE
								);
								$this->session->set_userdata($newdata);
							}
					$this->cart->destroy();
					/*---Send Invoice to Email----*/
					$data['identitas'] 	= $this->additional_model->get_row('identitas');
					$data['bank'] 		= $this->db->get('account_bank');
					$data['toko'] 		= $this->additional_model->get_row('setting_toko');
					$data['order']		= $this->db->query("SELECT a.*,b.* FROM `order` a join `pelanggan` b on a.idx_pelanggan=b.idx_pelanggan where a.idx_order='$idx_order'")->row();
					$data['product']	= $this->db->query("SELECT a.*,b.nm_product,b.harga,b.berat FROM `rl_order` a join `product` b on a.idx_product=b.idx_product where a.idx_order='$idx_order'");
					$data['checkout']	= $this;
					$template='demo';
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
					$this->email->to($this->input->post('email')); 
					$this->email->subject('Invoice Order '.$data['identitas']->site_title);
					$this->email->message($this->load->view('template/'.$template.'/invoice',$data,true));
					/*---Send Invoice to Email----*/
						echo '<div class=" success" style="padding: 5px 20px;margin: 0 20px;font-size: 11px;">Pesanan Berhasil Disimpan</div>';
						if($this->email->send()){
							echo"<script>
								window.location='".site_url('page/thanks/'.$rl->idx_order)."';
							</script>";
						}else{
							echo '<div class="message error" style="padding: 5px 20px;margin: 0 20px;color:#D12626;font-size: 11px;"><p class="error_point">- Maaf Invoice gagal dikirim ke email anda,namun anda bisa melihat detail transaksi di menu My account.</p></div>';
							die();
						}
					}else{
						echo '<div class="message error" style="padding: 5px 20px;margin: 0 20px;color:#D12626;font-size: 11px;">Terjadi Kesalahan Sistem, Silahkan ulangi lagi!!</div>';
						die();
					}
		}
		function look_stock_ext($idx_attribute_product,$idx_product){
			if($idx_attribute_product<>0){
				$q						=$this->db->get_where("attribute_product", array("idx_attribute_product" =>$idx_attribute_product))->row();
			}else{
				$q						=$this->db->get_where("attribute_product", array("idx_product" =>$idx_product))->row();
			}
			$stock					=$q->stock -  $q->stock_akhir;
			return $stock;
		}
		function convert_kec($kec){
			$pieces_kec =explode("|",$kec);
			return $pieces_kec[2];
		}
		function cek_kota_free($kota){	
			return $this->db->query("SELECT * FROM free_shipping_city where kota='$kota'")->num_rows();
		}
		function get_shipping_order($city_code,$field){
			$q=$this->db->query("SELECT $field from shipping_price where city_code='$city_code'")->row();
			return $q;
		}
		function discount_pembelian(){
			$Q=$this->db->query("select a.idx_type_promo,b.* from promo_management a join content_prom b on a.idx_promo=b.idx_promo where a.idx_type_promo=4");
			return $Q;
		}
		function cek_promo_bogof($idx_product){
			$Q=$this->db->query("select a.idx_type_promo,b.* from promo_management a join content_prom b on a.idx_promo=b.idx_promo where a.idx_type_promo=2 and b.idx_product='$idx_product'")->num_rows();
			return $Q;
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
		function convert_expedisi($expedisi){
			if($expedisi=="reg"){
				return "JNE Reguler";
			}
			if($expedisi=="oke"){
				return "JNE Oke";
			}
			if($expedisi=="yes"){
				return "JNE YES";
			}
			if($expedisi==""){
				return "-";
			}
		}
		function update($target){
			if($target=="category"){
				if($this->input->post('nm_categrory_product')){
						if($this->input->post('parent')<>0){
								$dq						=$this->db->get_where("category_product", array("idx_category_product"=>$this->input->post('idx_category_product')))->row();
								$parent_old				=$dq->parent;
								$dqp					=$this->db->get_where("category_product", array("idx_category_product"=>$parent_old	))->row();
								$a_array				=$re = array(".".$this->input->post('idx_category_product'),$this->input->post('idx_category_product'));
								$upd_2	=str_replace($a_array,"",$dqp->sub_parent);
								$this->db->where('idx_category_product',$parent_old);
								$this->db->update('category_product',array('sub_parent' =>$upd_2)); 
								$cq						=$this->db->get_where("category_product", array("idx_category_product"=>$this->input->post('parent')))->row();
								if($cq->sub_parent<>""){
									$up					=$cq->sub_parent.'.'.$this->input->post('idx_category_product');
								}else{
									$up					=$this->input->post('idx_category_product');
								}
								$upd= array('sub_parent' =>$up);
								$this->db->where('idx_category_product',$this->input->post('parent'));
								$this->db->update('category_product', $upd); 
							
								
						}
						if($this->input->post('parent')==0){
							$level=0;
							$parent='';
						}else{
							$parent		=$this->look_parent($this->input->post('parent'));
							$level		=$this->look_level($this->input->post('parent'));
							$level		=$level+1;
						}
						$image=$this->input->post('image_text');
						if(isset($_FILES['image']['name'])){
							$up=$this->do_upload('image',time());
							if($up==0){
								echo'<div class="alert alert-danger"><button class="close" data-dismiss="alert">×</button><strong>Error!&nbsp;</strong>Terjadi Kesalahan pada file logo,Pastikan file yang anda upload sesuai kriteria!!</div>';
								die();
							}
							$data = $this->upload->data();
							$this->resize_image_2($this->upload->upload_path.$this->upload->file_name,220,210);
							$image=$this->upload->file_name;
							if($this->input->post('image_text')){
								unlink('./uploads/product/'.$this->input->post('image_text'));
							}
						}
					$data = array(
						   'nm_categrory_product' =>$this->input->post('nm_categrory_product'),
						    'image' =>$image,
							'parent' =>$this->input->post('parent'),
							'parent_sub' =>$parent,
							'level'=>$level
						);
					$this->db->where('idx_category_product',$this->input->post('idx_category_product'));
					$update=$this->db->update('category_product', $data); 
					if($update){
						
						echo'<div class="alert alert-success"><strong>Success!</strong>Data berhasil diubah.</div>';
						echo"<script>
							setTimeout(function () {
								window.location='".site_url('product/category')."';
							},1000);
						</script>";
					}else{
						echo '<div class="alert alert-error"><strong>Oopss!</strong>Terjadi Kesalahan Sistem, Silahkan ulangi lagi!!</div>';
						die();
					}
				}else{
					echo '<div class="alert alert-error"><strong>Error!  </strong>Lengkapi Data yang diperlukan.</div>';
					die();
				}
			}			
		if($target=="product"){
			$error='';
				if((!$this->input->post('nm_product'))||(!$this->input->post('idx_category_product'))||(!$this->input->post('harga'))||($this->input->post('type_product')==0)){
					$error='<p>- Lengkapi Data yang diminta</p>';
				}
				if($this->input->post('type_product')==1){
					if(!$this->input->post('stock')){
						$error=$error.'<p>- Stock Harus Diisi.</p>';
					}
					$stock=$this->input->post('stock');
				}
				if($this->input->post('type_product')==2){
					$r=0;
					for($y=0;$y<count($this->input->post('stock_attribute'));$y++){
						$s=$this->input->post('stock_attribute');
						$e=$this->input->post('element');
						if((!is_numeric($s[$y]))||(!$e[$y])){
							$r=$r+1;
						}
					}
					if($r>0){
						$error=$error.'<p>- Element Attribut Harus Diisi,Stock Harus Angka.</p>';
					}
					$stock=0;
				}
				if($this->input->post('harga')){
					if(!is_numeric($this->input->post('harga'))){
						$error=$error.'<p>- Harga tidak boleh diisi Huruf.</p>';
					}
				}
				if($this->input->post('stock')){
					if(!is_numeric($this->input->post('stock'))){
						$error=$error.'<p>- Stock tidak boleh diisi Huruf.</p>';
					}
				}
				if($this->input->post('discount')){
					if(!is_numeric($this->input->post('discount'))){
						$error=$error.'<p>- Discount tidak boleh diisi Huruf.</p>';
					}
				}
				if($this->input->post('harga_discount')){
					if(!is_numeric($this->input->post('harga_discount'))){
						$error=$error.'<p>- Harga Dsicount tidak boleh diisi Huruf.</p>';
					}
				}
				if($error){
					echo '<div class="alert alert-error"><strong>Error! </strong>'.$error.'</div>';
					die();
				}
						$image=$this->input->post('image_text');
						$thumb=$this->input->post('thumb_text');
						if(isset($_FILES['image']['name'])){
							$up=$this->do_upload('image',time());
							if($up==0){
								echo'<div class="alert alert-danger"><button class="close" data-dismiss="alert">×</button><strong>Error!&nbsp;</strong>Terjadi Kesalahan pada file logo,Pastikan file yang anda upload sesuai kriteria!!</div>';
								die();
							}
							$data = $this->upload->data();
							$thumb = $data['raw_name'].'_thumb'.$data['file_ext'];
							$this->resize_image($this->upload->upload_path.$this->upload->file_name,220,210);
							$image=$this->upload->file_name;
							if($this->input->post('image_text')){
								unlink('./uploads/product/'.$this->input->post('image_text'));
							}
							if($this->input->post('thumb_text')){
								unlink('./uploads/product/'.$this->input->post('thumb_text'));
							}
						}
						$this->db->delete('attribute_product', array('idx_product' =>$this->input->post('idx_product')));
						$data = array(
						   'idx_category_product' =>$this->input->post('idx_category_product'),
						   'type_product' =>$this->input->post('type_product'),
						    'nm_product' =>$this->input->post('nm_product'),
							'ket' =>$this->input->post('ket'),
							'spesifikasi' =>$this->input->post('spesifikasi'),
							'stock' =>$stock,
							'harga' =>$this->input->post('harga'),
							'discount' =>$this->input->post('discount'),
							'harga_discount' =>$this->input->post('harga_discount'),
							'image' =>$image,
							'thumb' =>$thumb,
							'fl_free_shipping' =>$this->input->post('fl_free_shipping')
						);
						$this->db->where('idx_product',$this->input->post('idx_product'));
						$update=$this->db->update('product', $data); 
						if($update){
							if($this->input->post('type_product')==2){
								$idx_attribute		=$this->input->post('idx_attribute');
								$element			=$this->input->post('element');
								$stock_attribute	=$this->input->post('stock_attribute');
								$count_stock		=count($stock_attribute);
								$count_attribute	=count($idx_attribute);
								for($x=0;$x<$count_attribute;$x++){
									if($idx_attribute[$x]){
										for($i=0;$i<$count_stock;$i++){
											if(($element[$i])&&(is_numeric($stock_attribute[$i]))){
												$ins = array(
												   'idx_product' =>$this->input->post('idx_product'),
													'idx_atrribute' =>$idx_attribute[$x],
													'desc_attribute' =>$element[$i],
													'stock' =>$stock_attribute[$i]
												);
												$this->db->insert('attribute_product',$ins);
											}
										}
									}
								}
							}
							echo'<div class="alert alert-success"><strong>Success!</strong>Data berhasil diubah.</div>';
							echo"<script>
								setTimeout(function () {
									window.location='".site_url('product/product')."';
								},1000);
							</script>";
						}else{
							echo '<div class="alert alert-error"><strong>Oopss!</strong>Terjadi Kesalahan Sistem, Silahkan ulangi lagi!!</div>';
							die();
						}
			}
		}
		function free_ongkir($idx){
			return $this->db->query("SELECT * FROM content_prom	where fl_free_ongkir=1 and idx_product='$idx'")->num_rows();
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
