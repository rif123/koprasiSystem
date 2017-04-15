<?php
date_default_timezone_set('Asia/Jakarta'); 
defined('BASEPATH') OR exit('No direct script access allowed');
class order_model extends CI_model{
		function __construct(){
			parent::__construct();
			$this->load->database();
			$this->load->helper(array('form', 'url'));
			$this->load->library('session');
		}
		function delete($target,$idx){
			if($target=="order"){
				$this->db->delete('rl_order', array('idx_order' =>$idx));
				$this->db->delete('order', array('idx_order' =>$idx));
				redirect('order/order');
			}
			if($target=="refund"){
				$this->db->delete('refund', array('idx_refund' =>$idx));
				redirect('order/refund');
			}
			if($target=="confirm"){
				$query 	=$this->db->get_where('payment_confirm',array('idx_pay_confirm'=>$idx))->row();
				if($query->bukti_pembayaran){
					if(file_exists('./uploads/confirm_payment/'.$query->bukti_pembayaran)){
						unlink('./uploads/confirm_payment/'.$query->bukti_pembayaran); 
					}	
				}
				$this->db->delete('payment_confirm', array('idx_pay_confirm' =>$idx));
				redirect('order/confirm');
			}
			
		}
		function get_refund($idx){
			return $this->db->query("select a.*,b.* from refund a join `order` c on a.id_pesanan=c.id_pesanan join pelanggan b on c.idx_pelanggan=b.idx_pelanggan where a.idx_refund='$idx'")->row();
		}
		function save_confirm(){
			$error="";
			if(($this->input->post('id_pesanan'))&&($this->input->post('idx_rek'))&&($this->input->post('user_bank'))&&($this->input->post('user_acc'))&&($this->input->post('nm_acc'))&&($this->input->post('total_pembayaran'))){
				$cek_pesanan=$this->db->get_where('order', array('id_pesanan'=>$this->input->post('id_pesanan')))->num_rows();
				if($cek_pesanan==0){
					echo '<div class="alert alert-error"><p>- No Transaksi tidak ditemukan.</p></div>';
					die();
				}
				if (!is_numeric($this->input->post('total_pembayaran'))){
					$error=$error.'<p>Mohon Masukan Nominal Pembayaran dengan Benar, Nominal Pembayaran Harus Berupa Angka.</p>';
				}
				$q=$this->db->get_where('order', array('id_pesanan'=>$this->input->post('id_pesanan')))->row();
				if($q->total_tagihan!=$this->input->post('total_pembayaran')){
					$error=$error.'<p>- Total Transfer tidak Sesuai Total Tagihan, Harap Cek Kembali.</p>';
				}
				if($error<>""){
					echo '<div class="alert alert-error">'.$error.'</div>';
					die();
				}
				$Qpayment	=$this->db->get_where("payment_confirm",array("id_pesanan"=>$this->input->post('id_pesanan')));
				if($Qpayment->num_rows()==0){
						$data = array(
							'tgl_konfirmasi' =>date('y-m-d'),
						   'id_pesanan' =>$this->input->post('id_pesanan'),
						   'tgl_transfer' =>$this->input->post('tgl_transfer'),
						   'idx_rek' =>$this->input->post('idx_rek'),
						   'user_bank' =>$this->input->post('user_bank'),
						   'user_acc' =>$this->input->post('user_acc'),
						   'nm_acc' =>$this->input->post('nm_acc'),
						   'total_pembayaran' =>$this->input->post('total_pembayaran'),
						   'cd_status' =>1
						);
						$save=$this->db->insert('payment_confirm', $data); 
						if($save){
								$data = array('cd_status' =>1);
								$this->db->where('id_pesanan',$this->input->post('id_pesanan'));
								$this->db->update('order', $data);
							echo '<div class="alert alert-success">Konfimasi Berhasil Disimpan</div>';
							echo"<script>
							setTimeout(function () {
								window.location='".site_url('order/confirm/valid')."';
							},500);
						</script>";
						}else{
							echo'<div class="alert alert-error"><p style="padding:0;">Terjadi Kesalahan Sistem, Silahkan ulangi lagi!!</p></div>';
							die();
						}
				}else{
						$data = array(
							'tgl_konfirmasi' =>date('y-m-d'),
						   'id_pesanan' =>$this->input->post('id_pesanan'),
						   'tgl_transfer' =>$this->input->post('tgl_transfer'),
						   'idx_rek' =>$this->input->post('idx_rek'),
						   'user_bank' =>$this->input->post('user_bank'),
						   'user_acc' =>$this->input->post('user_acc'),
						   'nm_acc' =>$this->input->post('nm_acc'),
						   'total_pembayaran' =>$this->input->post('total_pembayaran'),
						   'cd_status' =>1
						);
						$this->db->where('id_pesanan',$this->input->post('id_pesanan'));
						$upd=$this->db->update('payment_confirm', $data);
						if($upd){
								$data = array('cd_status' =>1);
								$this->db->where('id_pesanan',$this->input->post('id_pesanan'));
								$this->db->update('order', $data);
								echo '<div class="alert alert-success">Konfimasi Berhasil Disimpan</div>';
								echo"<script>
									setTimeout(function () {
										window.location='".site_url('order/histoy_confirm')."';
									},500);
								</script>";
						}else{
							echo'<div class="alert alert-error"><p style="padding:0;">Terjadi Kesalahan Sistem, Silahkan ulangi lagi!!</p></div>';
							die();
						}
				}
			}else{
				echo '<div class="alert alert-error">- Lengkapi Data yang Diminta.</div>';
					
			}
		}
		function free_ongkir($idx){
			return $this->db->query("SELECT * FROM content_prom	where fl_free_ongkir=1 and idx_product='$idx'")->num_rows();
		}
		function cek_kota_free($kota){
			return $this->db->query("SELECT * FROM free_shipping_city where kota='$kota'")->num_rows();
		}
		function check_promo($idx_product){
			$q=$this->db->query("select a.idx_type_promo,b.* from promo_management a join content_prom b on a.idx_promo=b.idx_promo where b.idx_product='$idx_product' and a.idx_type_promo='1'");
			return $q;
		}
		function verifikasi(){
			if($this->input->post('idx_pay_confirm')){
					$this->db->where('idx_pay_confirm',$this->input->post('idx_pay_confirm'));
					$update		=$this->db->update('payment_confirm',array("cd_status"=>1));
					if($update){
						$id_pesanan	=$this->db->get_where("payment_confirm", array("idx_pay_confirm"=>$this->input->post('idx_pay_confirm')))->row();
						$this->db->where('id_pesanan',$id_pesanan->id_pesanan);
						$this->db->update('order',array("cd_status"=>1));
						/*----Update Product----------*/
						$p			=$this->db->query("select a.*,c.idx_pelanggan from rl_order a join `order` b on a.idx_order=b.idx_order join pelanggan c on b.idx_pelanggan=c.idx_pelanggan where b.id_pesanan='$id_pesanan->id_pesanan'");
						foreach($p->result() as $w){
							$Query="UPDATE product set buy=buy + 1 WHERE idx_product='$w->idx_product'";
							$this->db->query($Query);
							$this->db->query("UPDATE pelanggan set jmlh_transaksi=jmlh_transaksi + 1 WHERE idx_pelanggan='$w->idx_pelanggan'");
							if($w->idx_attribute_product==0){
								$cstok		=$this->db->get_where("attribute_product",array("idx_product"=>$w->idx_product))->row();
								if($cstok->stock_akhir-$cstok->stock<>0){
									$Query_stock="UPDATE attribute_product set stock_akhir=stock_akhir+$w->qty WHERE idx_product='$w->idx_product'";
									$this->db->query($Query_stock);
								}
							}else{
								$cstok		=$this->db->get_where("attribute_product",array("idx_attribute_product"=>$w->idx_attribute_product))->row();
								if($cstok->stock_akhir-$cstok->stock<>0){
									$Query_stock="UPDATE attribute_product set stock_akhir=stock_akhir+$w->qty WHERE idx_attribute_product='$w->idx_attribute_product'";
									$this->db->query($Query_stock);
								}
							}
						}
						redirect("order/confirm");
					}
			}
		}
		function update(){
			if($this->input->post('status_order')==2){
				$data = array('cd_status' =>$this->input->post('status_order'));
			}
			if($this->input->post('status_order')==3){
				if($this->input->post('no_pengiriman')){
					$data = array('cd_status' =>4,"no_pengiriman"=>$this->input->post('no_pengiriman'));
				}else{
					$data = array('cd_status' =>3);
				}
			}
			if($this->input->post('status_order')==""){
				if($this->input->post('no_pengiriman')){
					$data = array('cd_status' =>4,"no_pengiriman"=>$this->input->post('no_pengiriman'));
				}else{
					redirect('order/order');
				}
			}
				$this->db->where('idx_order',$this->input->post('idx_order'));
				$update=$this->db->update('order', $data);
				if($update){
                    redirect('order/order');
                }
        }
		function update_refund($idx){
			$data = array('cd_status' =>1);
			$this->db->where('idx_refund',$idx);
			$update=$this->db->update('refund', $data);
			if($update){
                    redirect('order/refund');
               }
		}	
		function update_resi(){
			//$error=0;
			$no_resi		=$this->input->post('no_pengiriman');
			/*for($i=0;$i<count($no_resi);$i++){
				if(!$no_resi[$i]){
					$error=1;
				}
			}*/
			$idx_order		=$this->input->post('idx_order');
			/*if($error==0){*/
				for($i=0;$i<count($idx_order);$i++){
					if($no_resi[$i]){
						$data = array('cd_status' =>4,"no_pengiriman"=>$no_resi[$i]);
						$this->db->where('idx_order',$idx_order[$i]);
						$update=$this->db->update('order', $data);
					}
				}
				//if($update){
					echo"<script>
							setTimeout(function () {
								window.location='".site_url('order/resi')."';
							},1000);
						</script>";
				//}
			/*}else{
				echo '<div class="alert alert-error">Masukan No Resi Pengiriman</div>';
				die();
			}*/
		}
		function cek_email($email){
			$Row=$this->db->query("Select * from pelanggan where email='$email'")->num_rows();
			return $Row;
		}
		function save(){
					$data = array(
					   'full_name' =>$this->input->post('full_name'),
					   'email' =>$this->input->post('email'),
					   'password' =>md5($this->input->post('password')),
					   'alamat' =>$this->input->post('alamat'),
					   'idx_city' =>$this->input->post('idx_city'),
					   'idx_provincy' =>$this->input->post('idx_provincy'),
					   'no_telepon' =>$this->input->post('telepon'),
					   'nm_perusahaan' =>$this->input->post('nm_perusahaan'),
					   'code_type_company' =>$this->input->post('code_type_company'),
					   'upload_identitas' =>$this->input->post('upload_identitas'),
					   'cd_status_cus' =>1
					);
					$save=$this->db->insert('pelanggan', $data);
					if($save){
						$Qw=$this->db->query("select idx_pelanggan from pelanggan order by idx_pelanggan desc limit 1")->row();
							$insert = array(
							   'id_pesanan' =>$Qw->idx_pelanggan.date('Ymd'),
							   'tgl_order' =>date('Y-m-d'),
							   'idx_pelanggan' =>$Qw->idx_pelanggan,
							   'nm_domain' =>$this->input->post('nm_domain'),
							   'code_paket' =>$this->input->post('code_paket'),
							   'idx_template' =>$this->input->post('idx_template'),
							   'total_tagihan' =>$this->input->post('total_tagihan'),
							   'cd_status' =>1
							);
							$this->db->insert('order',$insert);
							if($this->session->userdata('logged_in')!=TRUE){
								$newdata = array(
									'full_name'  => $this->input->post('full_name'),
									'email'     => $this->input->post('email'),
									'idx_pelanggan'  => $Qw->idx_pelanggan,
									'logged_in' => TRUE
								);
								$this->session->set_userdata($newdata);
							}
					}
		}
		function discount_pembelian(){
			$Q=$this->db->query("select a.*,b.* from promo_management a join content_prom b on a.idx_promo=b.idx_promo where a.idx_type_promo=4");
			return $Q;
		}
		function do_upload($htmlFieldName,$path){
				$config['file_name'] = time();
				$config['upload_path'] = './uploads/';
				$config['allowed_types'] = 'gif|jpg|png';
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
		function list_resi(){
			$sEcho=$_GET['sEcho'];
			$iDisplayStart=$_GET['iDisplayStart'];
			$iDisplayLenght=$_GET['iDisplayLength'];
			$sort_by=$_GET['iSortCol_0'];
			$nm_kolom=array('idx_order','cd_status','id_pesanan','tgl_order','idx_pelanggan','idx_pelanggan','idx_pelanggan','jne_expedisi','no_pengiriman');
			$sTable = "`order`";
			$sSortDir_0=$_GET['sSortDir_0'];
			$sWh="where cd_status=3";
			$sWhere = "";
				if ( isset($_GET['sSearch']) && $_GET['sSearch'] != "" )
				{
					$sWhere = "WHERE (";
					for ( $i=0 ; $i<count($nm_kolom) ; $i++ )
					{
						if ( isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" )
						{
							if($nm_kolom[$i]!="cd_status"){
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
				if($sWhere){
						$sWhere=$sWhere." and cd_status=3";
				}else{
						$sWhere="where cd_status=3";
				}
				$iTotalRecordssql=$this->db->query("SELECT * FROM $sTable $sWh  ORDER BY idx_order desc");
				$iTotalRecords=$iTotalRecordssql->num_rows();
				$sQuery ="SELECT * FROM  $sTable $sWhere
							order by
							$nm_kolom[$sort_by] $sSortDir_0
							limit $iDisplayStart,$iDisplayLenght";
				$query=$this->db->query($sQuery);
				$data_arr=array();
				$i==0;
				foreach($query->result_array() as $Row){
				if($Row['fl_drop_shipper']==1){
					$res		=$this->additional_model->get_where_row('drop_shipper','idx_drop_shipper',$Row['idx_drop_shipper']);
					$full_name	=$res->full_name;
					$alamat		=$res->alamat;
					$kec		=$res->kec;
					$kota		=$res->kota;
					$provinsi	=$res->provinsi;
					$no_telepon	=$res->no_telepon;
				}else{
					$res		=$this->additional_model->get_where_row('pelanggan','idx_pelanggan',$Row['idx_pelanggan']);
					$full_name	=$res->full_name;
					$alamat		=$res->alamat;
					$kec		=$res->kec;
					$kota		=$res->kota;
					$provinsi	=$res->provinsi;
					$no_telepon	=$res->no_telepon;
				}
					$res_penagih				=$this->additional_model->get_where_row('pelanggan','idx_pelanggan',$Row['idx_pelanggan']);
					$full_name_penagih			=$res_penagih->full_name;
					$alamat_penagih				=$res_penagih->alamat;
					$kec_penagih				=$res_penagih->kec;
					$kota_penagih				=$res_penagih->kota;
					$provinsi_penagih			=$res_penagih->provinsi;
					$no_telepon_penagih			=$res_penagih->no_telepon;
					$email						=$res_penagih->email;
						$action="<input type='text' name='no_pengiriman[]'/><input type='hidden' value='".$Row['idx_order']."' name='idx_order[]'/>";
						$status	='<b style="color: #1355B9;font-size: 9px;">Dikirim</b>';
						$resi	='Menunggu';
					$data_arr[]=array($action,$status,$Row['id_pesanan'],$this->DateToIndo($Row['tgl_order']),$full_name_penagih."<br>".$email."<br>Telp:".$no_telepon_penagih,$full_name_penagih."<br>".$alamat_penagih.' '.$kec_penagih.' '.$kota_penagih."<br>".$provinsi_penagih."<br>Telp:".$no_telepon_penagih,$full_name."<br>".$alamat.' '.$kec.' '.$kota."<br>".$provinsi."<br>Telp:".$no_telepon,$this->convert_expedisi($Row['jne_expedisi']),$resi,"DT_RowId"=>"td_".$Row['idx_order']);
					$i++;
				}
				$data_json=array('sEcho'=>$sEcho,'iTotalRecords'=>$iTotalRecords,'iTotalDisplayRecords'=>$iTotalRecords,'aaData'=>$data_arr);
				echo json_encode($data_json);
		}
		
		function list_order(){
			$sEcho=$_GET['sEcho'];
			$iDisplayStart=$_GET['iDisplayStart'];
			$iDisplayLenght=$_GET['iDisplayLength'];
			$sort_by=$_GET['iSortCol_0'];
			$nm_kolom=array('idx_order','cd_status','id_pesanan','tgl_order','idx_pelanggan','idx_pelanggan','idx_pelanggan','total_tagihan','no_pengiriman');
			$sTable = "`order`";
			$sSortDir_0=$_GET['sSortDir_0'];
			$sWhere = "";
				if ( isset($_GET['sSearch']) && $_GET['sSearch'] != "" )
				{
					$sWhere = "WHERE (";
					for ( $i=0 ; $i<count($nm_kolom) ; $i++ )
					{
						if ( isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" )
						{
							if($nm_kolom[$i]!="cd_status"){
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
				if($sWhere){
					if($this->uri->segment(3)=="all"){
						$sWhere=$sWhere;
					}else if($this->uri->segment(3)=="unpaid"){
						$sWhere=$sWhere." and cd_status=0";
					}else if($this->uri->segment(3)=="unverify"){
						$sWhere=$sWhere." and cd_status=8";
					}else if($this->uri->segment(3)=="valid"){
						$sWhere=$sWhere." and cd_status=1";
					}else if($this->uri->segment(3)=="process"){
						$sWhere=$sWhere." and cd_status=2";
					}else if($this->uri->segment(3)=="no_resi"){
						$sWhere=$sWhere." and cd_status=3";
					}else if($this->uri->segment(3)=="finish"){
						$sWhere=$sWhere." and cd_status=4";
					}else{
						$sWhere=$sWhere." and cd_status=0";
					}
				}else{
					if($this->uri->segment(3)=="all"){
						$sWhere="";
					}else if($this->uri->segment(3)=="unpaid"){
						$sWhere="where cd_status=0";
					}else if($this->uri->segment(3)=="unverify"){
						$sWhere="where cd_status=8";
					}else if($this->uri->segment(3)=="valid"){
						$sWhere="where cd_status=1";
					}else if($this->uri->segment(3)=="process"){
						$sWhere="where cd_status=2";
					}else if($this->uri->segment(3)=="no_resi"){
						$sWhere="where cd_status=3";
					}else if($this->uri->segment(3)=="finish"){
						$sWhere="where cd_status=4";
					}else{
						$sWhere="where cd_status=0";
					}
				
				}
				$iTotalRecordssql=$this->db->query("SELECT * FROM $sTable $sWhere");
				$iTotalRecords=$iTotalRecordssql->num_rows();
				$sQuery ="SELECT * FROM  $sTable $sWhere
							order by
							$nm_kolom[$sort_by] $sSortDir_0
							limit $iDisplayStart,$iDisplayLenght";
				$query=$this->db->query($sQuery);
				$data_arr=array();
				$i==0;
				foreach($query->result_array() as $Row){
				if($Row['fl_drop_shipper']==1){
					$res		=$this->additional_model->get_where_row('drop_shipper','idx_drop_shipper',$Row['idx_drop_shipper']);
					$full_name	=$res->full_name;
					$alamat		=$res->alamat;
					$kec		=$res->kec;
					$kota		=$res->kota;
					$provinsi	=$res->provinsi;
					$hp			=$res->hp;
				}else{
					$res		=$this->additional_model->get_where_row('pelanggan','idx_pelanggan',$Row['idx_pelanggan']);
					$full_name	=$res->full_name;
					$alamat		=$res->alamat;
					$kec		=$res->kec;
					$kota		=$res->kota;
					$provinsi	=$res->provinsi;
					$hp			=$res->hp;
				}
					$res_penagih				=$this->additional_model->get_where_row('pelanggan','idx_pelanggan',$Row['idx_pelanggan']);
					$full_name_penagih			=$res_penagih->full_name;
					$alamat_penagih				=$res_penagih->alamat;
					$kec_penagih				=$res_penagih->kec;
					$kota_penagih				=$res_penagih->kota;
					$provinsi_penagih			=$res_penagih->provinsi;
					$hp_penagih					=$res_penagih->hp;
					$email						=$res_penagih->email;
					$action="
						<a href='".site_url('order/view/order/'.$Row['idx_order'].'/'.$this->uri->segment(3))."' rel='tooltip' title='Lihat Pesanan'>Lihat</a>";
					$resi=$Row['no_pengiriman'];
					if(($Row['cd_status']<>0)&&($Row['cd_status']<>4)&&($Row['cd_status']<>8)){
						$action=$action." | <a href='".site_url('order/edit/order/'.$Row['idx_order'])."' rel='tooltip' title='Ubah Status Pesanan'>Ubah Status</a>";
						$action=$action." | <a href='".site_url('order/print_faktur_penjualan/'.$Row['idx_order'])."' rel='tooltip' target='_blank' title='Print'>Print</a>";
					}
					if(($Row['cd_status']==0)||($Row['cd_status']==8)){
						$status="<b style='color:#c00000;font-size: 9px;'>Menunggu Pembayaran</b>";
						$action=$action." | <a href='#' onClick='if(confirm(\"Anda Yakin akan menghapus data ini?\")) window.location=\"".site_url()."/order/delete/order/".$Row['idx_order']."\";' rel='tooltip' title='Delete'>Delete</a>";
						
					}
					if($Row['cd_status']==8){
						$status='<b style="color: orange;font-size: 9px;">Menunggu Verifikasi Pembayaran</b>';
					}
					if($Row['cd_status']==1){
						$status='<b style="color: #1355B9;font-size: 9px;">Pesanan diterima</b>';
					}
					if($Row['cd_status']==2){
						$status='<b style="color: #1355B9;font-size: 9px;">Pengemasan</b>';
					}
					if($Row['cd_status']==3){
						$status	='<b style="color: #1355B9;font-size: 9px;">Dikirim</b>';
						$resi	='Menunggu';
					}
					if($Row['cd_status']==4){
						$status='<b style="color: #1355B9;font-size: 9px;">Selesai</b>';
					}
					$data_arr[]=array($action,$status,$Row['id_pesanan'],$this->DateToIndo($Row['tgl_order']),$full_name_penagih."<br>".$email."<br>Telp:".$hp_penagih,$full_name_penagih."<br>".$alamat_penagih.' '.$kec_penagih.' '.$kota_penagih."<br>".$provinsi_penagih."<br>HP:".$hp_penagih,$full_name."<br>".$alamat.' '.$kec.' '.$kota."<br>".$provinsi."<br>HP:".$hp,"Rp. ".number_format($Row['total_tagihan'],0,',','.'),$resi,"DT_RowId"=>"td_".$Row['idx_order']);
					$i++;
				}
				$data_json=array('sEcho'=>$sEcho,'iTotalRecords'=>$iTotalRecords,'iTotalDisplayRecords'=>$iTotalRecords,'aaData'=>$data_arr);
				echo json_encode($data_json);
		}
		function get_order($id){
			$q	=$this->db->query("SELECT a.*,b.* FROM `order` a 
									join pelanggan b on a.idx_pelanggan=b.idx_pelanggan 
									where a.idx_order='$id'")->row();
			return $q;
		}
		function get_order_product($id){
			$q=$this->db->query("SELECT a.*,a.discount as discount_order,b.* FROM `rl_order` a join product b on a.idx_product=b.idx_product where a.idx_order='$id'");
			return $q;
		}
		function get_atribute_order($id){
			$q=$this->db->query("SELECT a.*,b.* FROM `attribute_product` a join attribute b on a.idx_atrribute=b.idx_attribute where a.idx_attribute_product='$id'");
			return $q;
		}
		function get_shipping_order($kota,$kec){
			$q=$this->db->query("SELECT * from shipping_location where kota='$kota' and kec='$kec'")->row();
			return $q;
		}
		function get_confirm($idx){
			$Q=$this->db->query("select a.*,b.* from payment_confirm a join account_bank b on a.idx_rek=b.idx_account_bank where a.idx_pay_confirm='$idx'");
			return $Q->row();
		}
		function list_refund(){
			$sEcho=$_GET['sEcho'];
			$iDisplayStart=$_GET['iDisplayStart'];
			$iDisplayLenght=$_GET['iDisplayLength'];
			$sort_by=$_GET['iSortCol_0'];
			$nm_kolom=array('idx_refund','cd_status','id_pesanan','tgl_refund','id_pesanan','nm_product','ket_product','total_refund');
			$sTable = "refund";
			$sSortDir_0=$_GET['sSortDir_0'];
			$sWhere = "";
				if ( isset($_GET['sSearch']) && $_GET['sSearch'] != "" )
				{
					$sWhere = "WHERE (";
					for ( $i=0 ; $i<count($nm_kolom) ; $i++ )
					{
						if ( isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" )
						{
							if($nm_kolom[$i]!="cd_status"){
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
			
				$iTotalRecordssql=$this->db->query("SELECT * FROM $sTable $sWhere");
				$iTotalRecords=$iTotalRecordssql->num_rows();
				$sQuery ="SELECT ".str_replace(" , ", " ", implode(", ", $nm_kolom))." FROM  $sTable $sWhere
							order by
							$nm_kolom[$sort_by] $sSortDir_0
							limit $iDisplayStart,$iDisplayLenght";
				$query=$this->db->query($sQuery);
				$data_arr=array();
				$i==0;
				foreach($query->result_array() as $Row){
				$idx_order=$this->get_idx($Row['id_pesanan']);
				$action="<a href='".site_url('order/view/refund/'.$idx_order.'/'.$Row['idx_refund'])."' rel='tooltip' title='Lihat'>Lihat</a>";
				if($Row['cd_status']==1){
					$status	="<b style='color:#1355B9;'>Selesai</b>";
				}
				if($Row['cd_status']==0){
					$status	="<b style='color:#c00000;'>Menunggu Proses</b>";
					$action=$action." | <a href='".site_url('order/edit/refund/'.$Row['idx_refund'])."' rel='tooltip' title='Proses'>Proses</a>";
				}
					$action=$action." | <a href='#' onClick='if(confirm(\"Anda Yakin akan menghapus data ini?\")) window.location=\"".site_url()."/order/delete/refund/".$Row['idx_refund']."\";' rel='tooltip' title='Delete'>Delete</a>";
					$data_arr[]=array($action,$status,$Row['id_pesanan'],$this->DateToIndo($Row['tgl_refund']),$Row['nm_product'],$Row['ket_product'],$Row['total_refund'],"DT_RowId"=>"td_".$Row['idx_refund']);
					$i++;
				}
				$data_json=array('sEcho'=>$sEcho,'iTotalRecords'=>$iTotalRecords,'iTotalDisplayRecords'=>$iTotalRecords,'aaData'=>$data_arr);
				echo json_encode($data_json);
		}
		function list_confirm(){
			$sEcho=$_GET['sEcho'];
			$iDisplayStart=$_GET['iDisplayStart'];
			$iDisplayLenght=$_GET['iDisplayLength'];
			$sort_by=$_GET['iSortCol_0'];
			$nm_kolom=array('idx_pay_confirm','cd_status','bukti_pembayaran','tgl_konfirmasi','id_pesanan','tgl_transfer','idx_rek','user_bank','user_acc','nm_acc','total_pembayaran');
			$sTable = "payment_confirm";
			$sSortDir_0=$_GET['sSortDir_0'];
			$sWhere = "";
				if ( isset($_GET['sSearch']) && $_GET['sSearch'] != "" )
				{
					$sWhere = "WHERE (";
					for ( $i=0 ; $i<count($nm_kolom) ; $i++ )
					{
						if ( isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" )
						{
							if($nm_kolom[$i]!="cd_status"){
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
				if($sWhere){
					if($this->uri->segment(3)=="valid"){
						$sWhere=$sWhere." and cd_status=1";
					}else if($this->uri->segment(3)=="all"){
						$sWhere=$sWhere." and cd_status in(0,1)";
					}else{
						$sWhere=$sWhere." and cd_status=0";
					}
				}else{
					if($this->uri->segment(3)=="valid"){
						$sWhere="where cd_status=1";
					}else if($this->uri->segment(3)=="all"){
						$sWhere="where cd_status in(0,1)";
					}else{
						$sWhere="where cd_status=0";
					}
				
				}
				
				$iTotalRecordssql=$this->db->query("SELECT * FROM $sTable $sWhere");
				$iTotalRecords=$iTotalRecordssql->num_rows();
				$sQuery ="SELECT ".str_replace(" , ", " ", implode(", ", $nm_kolom))." FROM  $sTable $sWhere
							order by
							$nm_kolom[$sort_by] $sSortDir_0
							limit $iDisplayStart,$iDisplayLenght";
				$query=$this->db->query($sQuery);
				$data_arr=array();
				$i==0;
				foreach($query->result_array() as $Row){
				if($Row['cd_status']==1){
					$status	="<b style='color:#1355B9;'>Sah</b>";
				}
				if($Row['cd_status']==0){
					$status	="<b style='color:#c00000;'>Menunggu Verifikasi</b>";
				}
				$img="-";
				if($Row['bukti_pembayaran']){
					$img	="<a href='".base_url()."uploads/confirm_payment/".$Row['bukti_pembayaran']."' target='_blank'><img src='".base_url()."uploads/confirm_payment/".$Row['bukti_pembayaran']."' style='width: 50%;height: 25%;'/></a>";
				}
					if($this->uri->segment(3)=="valid"){
						$action="<a href='".site_url('order/view/confirm_valid/'.$this->get_idx($Row['id_pesanan']).'/'.$Row['idx_pay_confirm'])."' rel='tooltip' title='Lihat'>Lihat</a>";
					}else if($this->uri->segment(3)=="all"){
						$action="<a href='".site_url('order/view/confirm_all/'.$this->get_idx($Row['id_pesanan']).'/'.$Row['idx_pay_confirm'])."' rel='tooltip' title='Lihat'>Lihat</a>";
					}else{
						$action="<a href='".site_url('order/view/confirm/'.$this->get_idx($Row['id_pesanan']).'/'.$Row['idx_pay_confirm'])."' rel='tooltip' title='Lihat'>Lihat</a>";
					}
					$action=$action." | <a href='#' onClick='if(confirm(\"Anda Yakin akan menghapus data ini?\")) window.location=\"".site_url()."/order/delete/confirm/".$Row['idx_pay_confirm']."\";' rel='tooltip' title='Delete'>Delete</a>";
					$data_arr[]=array($action,$status,$img,$this->DateToIndo($Row['tgl_konfirmasi']),$Row['id_pesanan'],$this->DateToIndo($Row['tgl_transfer']),$this->get_element('account_bank','idx_account_bank',$Row['idx_rek'],'nm_bank'),$Row['user_bank'],$Row['user_acc'],$Row['nm_acc'],"Rp. ".number_format($Row['total_pembayaran'],0,',','.'),"DT_RowId"=>"td_".$Row['idx_pay_confirm']);
					$i++;
				}
				$data_json=array('sEcho'=>$sEcho,'iTotalRecords'=>$iTotalRecords,'iTotalDisplayRecords'=>$iTotalRecords,'aaData'=>$data_arr);
				echo json_encode($data_json);
		}
		function get_idx($id){
			$Q=$this->db->get_where("order",array("id_pesanan"=>$id));
			if($Q->num_rows()>0){
				return $Q->row()->idx_order;
			}else{
				return 0;
			}
		}
		function list_confirm_history(){
			$sEcho=$_GET['sEcho'];
			$iDisplayStart=$_GET['iDisplayStart'];
			$iDisplayLenght=$_GET['iDisplayLength'];
			$sort_by=$_GET['iSortCol_0'];
			$nm_kolom=array('idx_pay_confirm','cd_status','tgl_konfirmasi','id_pesanan','idx_rek','user_bank','user_acc','nm_acc','total_pembayaran');
			$sTable = "payment_confirm";
			$sSortDir_0=$_GET['sSortDir_0'];
			$iTotalRecordssql=$this->db->query("SELECT * FROM $sTable where cd_status=0 ORDER BY idx_pay_confirm desc");
			$iTotalRecords=$iTotalRecordssql->num_rows();
			$sWhere = "";
				if ( isset($_GET['sSearch']) && $_GET['sSearch'] != "" )
				{
					$sWhere = "WHERE (";
					for ( $i=0 ; $i<count($nm_kolom) ; $i++ )
					{
						if ( isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" )
						{
							if($nm_kolom[$i]!="cd_status"){
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
				if($Row['cd_status']==1){
					$status="<b style='color:#11E23B;'>Valid</b>";
				}
				if($Row['cd_status']==8){
					$status="<b style='color:#c00000;'>Unvalid</b>";
				}
				if($Row['cd_status']==0){
					$status="<b style='color:#c00000;'>Menunggu Verifikasi</b>";
				}
					$action="
						<a href='".site_url('order/edit/confirm_history/'.$Row['idx_pay_confirm'])."' rel='tooltip' title='Lihat'>Lihat</a>
					<!--	<a href='#' onClick='if(confirm(\"Anda Yakin akan menghapus data ini?\")) window.location=\"".site_url()."/setting/delete/page/".$Row['idx_pay_confirm']."\";' rel='tooltip' title='Delete'>Delete</a>-->
						";
					$data_arr[]=array($action,$status,$this->DateToIndo($Row['tgl_konfirmasi']),$Row['id_pesanan'],$this->get_element('account_bank','idx_account_bank',$Row['idx_rek'],'nm_bank'),$Row['user_bank'],$Row['user_acc'],$Row['nm_acc'],"Rp. ".number_format($Row['total_pembayaran'],0,',','.'),"DT_RowId"=>"td_".$Row['idx_pay_confirm']);
					$i++;
				}
				$data_json=array('sEcho'=>$sEcho,'iTotalRecords'=>$iTotalRecords,'iTotalDisplayRecords'=>$iTotalRecords,'aaData'=>$data_arr);
				echo json_encode($data_json);
		}
		function DateToIndo($date){  			if($date<>"0000-00-00"){			
				$BulanIndo = array("Januari", "Februari", "Maret",  
								   "April", "Mei", "Juni",  
								   "Juli", "Agustus", "September",  
								   "Oktober", "November", "Desember");  
			  
				$tahun = substr($date, 0, 4);  
				$bulan = substr($date, 5, 2);  
				$tgl   = substr($date, 8, 2);  
				  
				$result = $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun;   							}else{								$result="-";							}			
			return($result);  
		}
		function get_element($tb,$idx,$par,$f){
			$res	=$this->db->query("select * from $tb where $idx='$par'");
			$w		=$res->row();
			return $w->$f;
		}

}
