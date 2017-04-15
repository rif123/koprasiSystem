<?php 
date_default_timezone_set('Asia/Jakarta');
defined('BASEPATH') OR exit('No direct script access allowed');
class pelanggan_model extends CI_model{
		function __construct(){
			parent::__construct();
			$this->load->database();
			$this->load->helper(array('form', 'url'));
			$this->load->library('session');
		}
		function delete($target,$idx){
			if($target=="newsletter"){
				$this->db->delete('newsletter', array('idx_newsletter' =>$idx));
				redirect('pelanggan/newsletter');
			}
			if($target=="message"){
				$this->db->delete('message', array('idx_message' =>$idx));
				redirect('pelanggan/message');
			}
			if($target=="wishlist"){
				$this->db->delete('wishlist', array('idx_wishlist' =>$idx));
				redirect('pelanggan/wishlist');
			}
			if($target=="content_newsletter"){
				$this->db->delete('content_newsletter', array('idx_content_newsletter' =>$idx));
				redirect('pelanggan/newsletter_pelanggan');
			}
		}
		function reset_profile(){
			$idx_user=$this->session->userdata('idx_user');
			if((!$this->input->post('username'))&&(!$this->input->post('password')))
			{
				echo '<div class="alert alert-error"><strong>Oopss!</strong>Lengkapi Username atau Password!!</div>';
				die();
			}else{
				$data = array('user_name' =>$this->input->post('username'),'password' =>md5($this->input->post('password')));
			}
				if(($this->input->post('username'))&&($this->input->post('password')==""))
				{
					$data = array('user_name' =>$this->input->post('username'));
				}
				if(($this->input->post('username')=="")&&($this->input->post('password')))
				{
					$data = array('password' =>md5($this->input->post('password')));
				}
				$this->db->where('idx_user',$idx_user);
				$update=$this->db->update('sys_users', $data); 
				if($update){
							echo'<div class="alert alert-success"><strong>Success!</strong>Data berhasil diubah.</div>';
							echo"<script>
								setTimeout(function () {
									window.location='".site_url('admin/change_password')."';
								},1000);
							</script>";
						}else{
							echo '<div class="alert alert-error"><strong>Oopss!</strong>Terjadi Kesalahan Sistem, Silahkan ulangi lagi!!</div>';
							die();
						}
			
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
		function newsletter_save(){
			$insert = array('tgl'=>date('Y-m-d'),'judul'=>$this->input->post('judul'),'isi_newsletter' =>$this->input->post('isi_newsletter'));
			$this->db->insert('newsletter',$insert);
			$idx_newsletter=$this->db->query("select idx_newsletter from newsletter order by idx_newsletter desc limit 1")->row()->idx_newsletter;
			if($this->input->get('lampiran')){
				$pc=explode("||",$this->input->get('lampiran'));
				for($i=0;$i<count($pc);$i++){
					$insert_lampiran = array('idx_newsletter'=>$idx_newsletter,'path_file'=>str_replace(" ","-",$pc[$i]));
					$this->db->insert('lampiran',$insert_lampiran);
				}
			}
		}
		function publish(){
			$target			=$this->uri->segment(3);
			$idx_poroduct	=$this->uri->segment(5);
			if($target=="rate"){
				$data = array('cd_status' =>1);
				$this->db->where('idx_rate',$this->uri->segment(4));
				$this->db->update('rated_product', $data);
				/*-----Update rate Product-----*/
				$this->db->query("Update product set rated=rated+1 where idx_product='$idx_poroduct'");
				redirect('pelanggan/rate');
			}
		}
		function testimoni_proses(){
			if($this->input->post('send')=="Tolak"){
				$cd_status=8;
				$mes="Testimonial Ditolak";
			}
			if($this->input->post('send')=="Approve"){
				$cd_status=1;
				$mes="Testimonial Disetujui";
			}
			$data = array('cd_status' =>$cd_status);
			$this->db->where('idx_testimoni',$this->input->post('idx_testimoni'));
			$this->db->update('testimoni', $data);
			echo'<div class="alert alert-success"><button class="close" data-dismiss="alert">×</button><h4>Success!</h4><p>'.$mes.'</p></div>';
			echo"<script>
				setTimeout(function () {
					window.location='".site_url('pelanggan/testimoni')."';
				},2000);
			</script>";
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
		function list_testimoni(){
			$sEcho=$_GET['sEcho'];
			$iDisplayStart=$_GET['iDisplayStart'];
			$iDisplayLenght=$_GET['iDisplayLength'];
			$sort_by=$_GET['iSortCol_0'];
			$nm_kolom=array('idx_testimoni','cd_status','tgl_testimon','idx_pelanggan','idx_pelanggan','testimoni');
			$sTable = "testimoni";
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
					if($this->uri->segment(3)=="new"){
						$sWhere=$sWhere." and cd_status=0";
					}else{
						$sWhere=$sWhere;
					}
				}else{
					if($this->uri->segment(3)=="new"){
						$sWhere="where cd_status=0";
					}else{
						$sWhere=$sWhere;
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
				if($Row['cd_status']==0){
					$status="<p style='color:#c00000;'>Menunggu Persetujuan</p>";
				}
				if($Row['cd_status']==1){
					$status="<p style='color:green;'>Ditampilkan</p>";
				}
				if($Row['cd_status']==8){
					$status="<p style='color:red;'>Tolak</p>";
				}
				$res	=$this->additional_model->get_where_row('pelanggan','idx_pelanggan',$Row['idx_pelanggan']);
					$action="
						<a href='".site_url('pelanggan/approve_testimoni/'.$Row['idx_testimoni'])."' rel='tooltip' title='Setujui'>Setujui</a> | 
						<a href='".site_url('pelanggan/tolak_testimoni/'.$Row['idx_testimoni'])."' rel='tooltip' title='Tolak'>Tolak</a>";
					$data_arr[]=array($action,$status,$this->DateToIndo($Row['tgl_testimon']),$res->full_name,$res->email,$Row['testimoni'],"DT_RowId"=>"td_".$Row['idx_testimoni']);
					$i++;
				}
				$data_json=array('sEcho'=>$sEcho,'iTotalRecords'=>$iTotalRecords,'iTotalDisplayRecords'=>$iTotalRecords,'aaData'=>$data_arr);
				echo json_encode($data_json);
		}
		function list_message(){
			$sEcho=$_GET['sEcho'];
			$iDisplayStart=$_GET['iDisplayStart'];
			$iDisplayLenght=$_GET['iDisplayLength'];
			$sort_by=$_GET['iSortCol_0'];
			$nm_kolom=array('idx_message','cd_status','tgl_pesan','nama','email','judul_pesan','isi_pesan');
			$sTable = "message";
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
					if($this->uri->segment(3)=="new"){
						$sWhere=$sWhere." and cd_status=0";
					}else{
						$sWhere=$sWhere;
					}
				}else{
					if($this->uri->segment(3)=="new"){
						$sWhere="where cd_status=0";
					}else{
						$sWhere=$sWhere;
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
				if($Row['cd_status']==0){
					$status="<b style='color:#c00000;'>Belum Dibaca</b>";
				}
				if($Row['cd_status']==1){
					$status="<b style='color:#1690c3;'>Sudah Dibaca</b>";
				}
				if($Row['cd_status']==2){
					$status="Sudah Dibalas";
				}
					$action="
						<a href='".site_url('pelanggan/view/message/'.$Row['idx_message'])."' rel='tooltip' title='Baca'>Baca</a>
						<a href='#' onClick='if(confirm(\"Anda Yakin akan menghapus data ini?\")) window.location=\"".site_url()."/pelanggan/delete/message/".$Row['idx_message']."\";' rel='tooltip' title='Delete'>Delete</a>
						";
					//$checkbox="<input type='radio' name='cd_artikel' value='".$Row['cd_artikel']."' onClick=view_list('$Row[cd_artikel]') >&nbsp;";
					$data_arr[]=array($action,$status,$this->DateToIndo($Row['tgl_pesan']),$Row['nama'],$Row['email'],$Row['judul_pesan'],substr($Row['isi_pesan'], 0, 40)."...","DT_RowId"=>"td_".$Row['idx_message']);
					$i++;
				}
				$data_json=array('sEcho'=>$sEcho,'iTotalRecords'=>$iTotalRecords,'iTotalDisplayRecords'=>$iTotalRecords,'aaData'=>$data_arr);
				echo json_encode($data_json);
		}
		function list_wishlist(){
			$sEcho=$_GET['sEcho'];
			$iDisplayStart=$_GET['iDisplayStart'];
			$iDisplayLenght=$_GET['iDisplayLength'];
			$sort_by=$_GET['iSortCol_0'];
			$nm_kolom=array('idx_wishlist','tgl','idx_product','idx_product','tgl','idx_attribute_product','idx_pelanggan');
			$sTable = "wishlist";
			$sSortDir_0=$_GET['sSortDir_0'];
			$sWhere = "";
				if ( isset($_GET['sSearch']) && $_GET['sSearch'] != "" )
				{
					$sWhere = "WHERE (";
					for ( $i=0 ; $i<count($nm_kolom) ; $i++ )
					{
						if ( isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" )
						{
							if(($nm_kolom[$i]!="idx_wishlist")&&($nm_kolom[$i]!="idx_product")&&($nm_kolom[$i]!="idx_attribute_product")&&($nm_kolom[$i]!="idx_pelanggan")){
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
				
				$iTotalRecordssql=$this->db->query("SELECT * FROM $sTable");
				$iTotalRecords=$iTotalRecordssql->num_rows();
				$sQuery ="SELECT * FROM  $sTable $sWhere
							order by
							$nm_kolom[$sort_by] $sSortDir_0
							limit $iDisplayStart,$iDisplayLenght";
				$query=$this->db->query($sQuery);
				$data_arr=array();
				$i==0;
				foreach($query->result_array() as $Row){
					$elm_product	=$this->db->get_where("product", array("idx_product" =>$Row['idx_product']))->row();
					$elm_cus		=$this->db->get_where("pelanggan", array("idx_pelanggan" =>$Row['idx_pelanggan']))->row();
					$image			="<img height='35%' src='".base_url()."/uploads/product/".$elm_product->thumb."'>";
					if(date('Y-m-d')-$Row['tgl']>=14){
						$cat="<b style='color:#c00000;'>Lama</b>";
					}else{
						$cat="<b style='color:#1690c3;'>Terbaru</b>";
					}
					$action="
						<a href='".site_url('pelanggan/view/wishlist/'.$Row['idx_wishlist'])."' rel='tooltip' title='Lihat'>Lihat</a> | 
						<a href='#' onClick='if(confirm(\"Anda Yakin akan menghapus data ini?\")) window.location=\"".site_url()."/pelanggan/delete/wishlist/".$Row['idx_wishlist']."\";' rel='tooltip' title='Delete'>Delete</a>
						";
					$data_arr[]=array($action,$cat,$image,$elm_product->nm_product,$this->DateToIndo($Row['tgl']).$Row['idx_attribute_product'],$this->stock_available($Row['idx_attribute_product'],$Row['idx_product'],$Row['qty']),$elm_cus->full_name."<br>".$elm_cus->email."<br>".$elm_cus->no_telepon,"DT_RowId"=>"td_".$Row['idx_wishlist']);
					$i++;
				}
				$data_json=array('sEcho'=>$sEcho,'iTotalRecords'=>$iTotalRecords,'iTotalDisplayRecords'=>$iTotalRecords,'aaData'=>$data_arr);
				echo json_encode($data_json);
		}
		function stock_available($idx_attribute_product,$idx_product,$qty){
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
		function list_newsletter(){
			$sEcho=$_GET['sEcho'];
			$iDisplayStart=$_GET['iDisplayStart'];
			$iDisplayLenght=$_GET['iDisplayLength'];
			$sort_by=$_GET['iSortCol_0'];
			$nm_kolom=array('idx_newsletter','cd_status','tgl','judul','isi_newsletter');
			$sTable = "newsletter";
			$sSortDir_0=$_GET['sSortDir_0'];
			$iTotalRecordssql=$this->db->query("SELECT * FROM $sTable  ORDER BY cd_status desc");
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
				if($Row['cd_status']==0){
					$status="<b style='color:#c00000;'>Belum Dibaca</b>";
				}
				if($Row['cd_status']==1){
					$status="<b style='color:#1690c3;'>Sudah Dibaca</b>";
				}
					$action="
						<a href='".site_url('pelanggan/view/newsletter/'.$Row['idx_newsletter'])."' rel='tooltip' title='Baca'>Baca</a>
						<a href='#' onClick='if(confirm(\"Anda Yakin akan menghapus data ini?\")) window.location=\"".site_url()."/pelanggan/delete/newsletter/".$Row['idx_newsletter']."\";' rel='tooltip' title='Delete'>Delete</a>
						";
					//$checkbox="<input type='radio' name='cd_artikel' value='".$Row['cd_artikel']."' onClick=view_list('$Row[cd_artikel]') >&nbsp;";
					$data_arr[]=array($action,$status,$this->DateToIndo($Row['tgl']),$Row['judul'],substr($Row['isi_newsletter'], 0, 40)."...","DT_RowId"=>"td_".$Row['idx_newsletter']);
					$i++;
				}
				$data_json=array('sEcho'=>$sEcho,'iTotalRecords'=>$iTotalRecords,'iTotalDisplayRecords'=>$iTotalRecords,'aaData'=>$data_arr);
				echo json_encode($data_json);
		}
		function list_history_pelanggan(){
			$sEcho=$_GET['sEcho'];
			$iDisplayStart=$_GET['iDisplayStart'];
			$iDisplayLenght=$_GET['iDisplayLength'];
			$sort_by=$_GET['iSortCol_0'];
			$nm_kolom=array('idx_pelanggan','full_name','jenis_kelamin','tgl_lahir','email','alamat','kota','provinsi','no_telepon','hp');
			$sTable = "pelanggan";
			$sSortDir_0=$_GET['sSortDir_0'];
			$sWhere = "";
				if ( isset($_GET['sSearch']) && $_GET['sSearch'] != "" )
				{
					$sWhere = "WHERE (";
					for ( $i=0 ; $i<count($nm_kolom) ; $i++ )
					{
						if ( isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" )
						{
							if($nm_kolom[$i]!="cd_status_cus"){
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
				if($this->input->get("umur")){
					$range=$this->input->get("umur");
					if($sWhere){
						$sWhere=$sWhere." and YEAR(CURDATE())-YEAR(tgl_lahir) between $range";
					}else{
						$sWhere=" where YEAR(CURDATE())-YEAR(tgl_lahir) between $range";
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
					$action="
						<a href='".site_url('pelanggan/view/pelanggan/'.$Row['idx_pelanggan'])."' rel='tooltip' title='Riwayat Pemesanan'>Riwayat Pemesanan</a>
					<!--	<a href='#' onClick='if(confirm(\"Anda Yakin akan menghapus data ini?\")) window.location=\"".site_url()."/pelanggan/delete/pelanggan/".$Row['idx_pelanggan']."\";' rel='tooltip' title='Delete'>Delete</a>-->
						";
					$data_arr[]=array($action,$Row['full_name'],$Row['jenis_kelamin'],$this->DateToIndo($Row['tgl_lahir']),$Row['email'],$Row['alamat'],$Row['kota'],$Row['provinsi'],$Row['no_telepon'],$Row['hp'],"DT_RowId"=>"td_".$Row['idx_pelanggan']);
					$i++;
				}
				$data_json=array('sEcho'=>$sEcho,'iTotalRecords'=>$iTotalRecords,'iTotalDisplayRecords'=>$iTotalRecords,'aaData'=>$data_arr);
				echo json_encode($data_json);
		}
		function list_rate(){
			$sEcho=$_GET['sEcho'];
			$iDisplayStart=$_GET['iDisplayStart'];
			$iDisplayLenght=$_GET['iDisplayLength'];
			$sort_by=$_GET['iSortCol_0'];
			$nm_kolom=array('idx_rate','cd_status','idx_product','nama','komentar','score_rated');
			$sTable = "rated_product";
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
					if($this->uri->segment(3)=="new"){
						$sWhere=$sWhere." and cd_status=0";
					}else{
						$sWhere=$sWhere;
					}
				}else{
					if($this->uri->segment(3)=="new"){
						$sWhere="where cd_status=0";
					}else{
						$sWhere=$sWhere;
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
					$status	="<p style='color:#1355B9;'>Ditampilkan</p>";
				}
				if($Row['cd_status']==0){
					$status	="<p style='color:#c00000;'>Belum Disetujui</p>";
				}
					$action="<a href='javascript:void()' onClick='if(confirm(\"Yakin akan dipublish?\")) window.location=\"".site_url()."pelanggan/publish/rate/".$Row['idx_rate']."/".$Row['idx_product']."\";' rel='tooltip' title='Ditampilkan'>Ditampilkan</a>";
				
					$data_arr[]=array($action,$status,$this->get_element('product','idx_product',$Row['idx_product'],'nm_product'),$Row['nama'],$Row['komentar'],$Row['score_rated'],"DT_RowId"=>"td_".$Row['idx_rate']);
					$i++;
				}
				$data_json=array('sEcho'=>$sEcho,'iTotalRecords'=>$iTotalRecords,'iTotalDisplayRecords'=>$iTotalRecords,'aaData'=>$data_arr);
				echo json_encode($data_json);
		}
		function list_content_newsletter(){
			$sEcho=$_GET['sEcho'];
			$iDisplayStart=$_GET['iDisplayStart'];
			$iDisplayLenght=$_GET['iDisplayLength'];
			$sort_by=$_GET['iSortCol_0'];
			$nm_kolom=array('idx_content_newsletter','tgl','cd_status','judul');
			$sTable = "content_newsletter";
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
				if($Row['cd_status']==1){
					$status	="<b style='color:#1355B9;'>Send</b>";
				}
				if($Row['cd_status']==0){
					$status	="<b style='color:#c00000;'>Draft</b>";
				}
				$action="
						<a href='".site_url('pelanggan/edit/newsletter/'.$Row['idx_content_newsletter'])."' rel='tooltip' title='Edit'>Edit</a> &nbsp;|&nbsp;
						<a href='#' onClick='if(confirm(\"Anda Yakin akan menghapus data ini?\")) window.location=\"".site_url()."/pelanggan/delete/content_newsletter/".$Row['idx_content_newsletter']."\";' rel='tooltip' title='Delete'>Delete</a>
						";
				$data_arr[]=array($action,$status,$this->DateToIndo($Row['tgl']),$Row['judul'],"DT_RowId"=>"td_".$Row['idx_content_newsletter']);
				$i++;
				}
				$data_json=array('sEcho'=>$sEcho,'iTotalRecords'=>$iTotalRecords,'iTotalDisplayRecords'=>$iTotalRecords,'aaData'=>$data_arr);
				echo json_encode($data_json);
		}
		
		function DateToIndo($date){  
			$BulanIndo = array("Januari", "Februari", "Maret",  
							   "April", "Mei", "Juni",  
							   "Juli", "Agustus", "September",  
							   "Oktober", "November", "Desember");  
            
			$tahun = substr($date, 0, 4);  
			$bulan = substr($date, 5, 2);  
			$tgl   = substr($date, 8, 2);  
			
            if ($tahun == '0000'){
                if ((int)$bulan-1 < 0){
                    $result = $tgl . " " . $bulan . " ". $tahun;                           
                }
            }else{
                $result = $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun;                           
            }
			return($result);  
		}
		function get_element($tb,$idx,$par,$f){
			$res	=$this->db->query("select * from $tb where $idx='$par'");
			$w		=$res->row();
			return $w->$f;
		}
		function update_status($idx,$n){
			$data = array('cd_status' =>$n);
			$this->db->where('idx_message',$idx);
			$this->db->update('message', $data); 
		}
		function update_status_newsletter($idx,$n){
			$data = array('cd_status' =>$n);
			$this->db->where('idx_newsletter',$idx);
			$this->db->update('newsletter', $data); 
		}
		function send_newsletter(){
			if(($this->input->post('judul'))&&($this->input->post('content'))){
				if($this->input->post('ok')=="send"){
					$pelanggan			= $this->db->get('newsletter_cus');
					if($pelanggan->num_rows>0){							
							$data['identitas'] 	= $this->additional_model->get_row('identitas');
							$data['shop'] 		= $this->additional_model->get_row('setting_toko');
							$system 			= $this->db->get('system')->row();
							$template			="demo";							
							$data['template']	=$this->db->get('system')->row()->template;
							$data['pelanggan']	=$this;
							$data['judul']		=$this->input->post('judul');
							$data['content']	=$this->input->post('content');							
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
							foreach($pelanggan->result() as $w){
								$data['email']	=$w->email;
								$this->email->from($system->smtp_user,$data['identitas']->site_title);
								$this->email->to($w->email); 
								$this->email->subject($this->input->post('judul'));
								$this->email->message($this->load->view('template/'.$template.'/newsletter',$data,true));
								$this->email->send();
							}
							$ins = array('tgl'=>date('Y-m-d'),'judul' =>$this->input->post('judul'),'content' =>$this->input->post('content'),'cd_status' =>1);
							$save=$this->db->insert('content_newsletter', $ins); 
							if($save){
								echo'<div class="alert alert-success">Newsletter berhasil dikirim.</div>';
								echo"<script>
									window.location='".site_url('pelanggan/newsletter_pelanggan')."';
								</script>";
							}
					}else{
						echo '<div class="alert alert-error">Tidak ada pelanggan yang berlangganan Newsletter.Mohon simpan sebagai draft!!</div>';
						die();
					}
				}else{
					$ins = array('tgl'=>date('Y-m-d'),'judul' =>$this->input->post('judul'),'content' =>$this->input->post('content'));
					$save=$this->db->insert('content_newsletter', $ins); 
					if($save){
						echo"<script>
							window.location='".site_url('pelanggan/newsletter_pelanggan')."';
						</script>";
					}
				}
			}else{
				echo '<div class="alert alert-error">Lengkapi data yang diminta!!</div>';
				die();
			}
		}		function update_newsletter(){
			if(($this->input->post('judul'))&&($this->input->post('content'))){
				if($this->input->post('ok')=="send"){
					$pelanggan			= $this->db->get('newsletter_cus');
					if($pelanggan->num_rows>0){
						$data['identitas'] 	= $this->additional_model->get_row('identitas');
						$data['shop'] 		= $this->additional_model->get_row('setting_toko');
						$system 			= $this->db->get('system')->row();
						$template			="demo";
						$data['template']	=$this->db->get('system')->row()->template;
						$data['pelanggan']	=$this;
						$data['judul']		=$this->input->post('judul');
						$data['content']	=$this->input->post('content');
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
						foreach($pelanggan->result() as $w){
							$data['email']	=$w->email;
							$this->email->from($system->smtp_user,$data['identitas']->site_title);
							$this->email->to($w->email); 
							$this->email->subject($this->input->post('judul'));
							$this->email->message($this->load->view('template/'.$template.'/newsletter',$data,true));
							$this->email->send();
						}
						$upd = array('tgl'=>date('Y-m-d'),'judul' =>$this->input->post('judul'),'content' =>$this->input->post('content'),'cd_status' =>1);
						$this->db->where('idx_content_newsletter',$this->input->post('idx_content_newsletter'));
						$update=$this->db->update('content_newsletter', $upd); 
						if($update){
							echo'<div class="alert alert-success">Newsletter berhasil dikirim.</div>';
							echo"<script>
								window.location='".site_url('pelanggan/newsletter_pelanggan')."';
							</script>";
						}
					}else{
						echo '<div class="alert alert-error">Tidak ada pelanggan yang berlangganan Newsletter.Mohon simpan sebagai draft!!</div>';
						die();
					}
				}else{
					$upd = array('tgl'=>date('Y-m-d'),'judul' =>$this->input->post('judul'),'content' =>$this->input->post('content'));
					$this->db->where('idx_content_newsletter',$this->input->post('idx_content_newsletter'));
					$update=$this->db->update('content_newsletter', $upd); 
					if($update){
						echo"<script>
							window.location='".site_url('pelanggan/newsletter_pelanggan')."';
						</script>";
					}
				}
			}else{
				echo '<div class="alert alert-error">Lengkapi data yang diminta!!</div>';
				die();
			}
		}
		function balas(){
			$data['identitas'] 	= $this->additional_model->get_row('identitas');
			$template			="demo";
			$data['balas_pesan']=$this->input->post('balas_pesan');
			$data['nama']		=$this->input->post('nama');
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
			$this->email->subject('Reply Pesan '.$data['identitas']->site_title);
			$this->email->message($this->load->view('template/'.$template.'/reply_message',$data,true));
			$this->email->send();
			$this->update_status($this->input->post('idx_message'),2);
			redirect('pelanggan/message');
		}
		function tolak_testimoni(){
			$delete	=$this->db->delete('testimoni', array('idx_testimoni' =>$this->uri->segment(3)));
			if($delete){
				redirect('pelanggan/testimoni');
			}
		}
		function approve_testimoni(){
			$data = array('cd_status' =>1);
					$this->db->where('idx_testimoni',$this->uri->segment(3));
					$update=$this->db->update('testimoni', $data); 
			if($update){
				redirect('pelanggan/testimoni');
			}
		}
		function list_riwayat_pesanan(){
			$sEcho=$_GET['sEcho'];
			$iDisplayStart=$_GET['iDisplayStart'];
			$iDisplayLenght=$_GET['iDisplayLength'];
			$sort_by=$_GET['iSortCol_0'];
			$nm_kolom=array('idx_order','cd_status','id_pesanan','tgl_order','total_tagihan','no_pengiriman');
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
				$idx_pelanggan	=$this->input->get('idx_pelanggan');
				if($sWhere){
					$sWhere=$sWhere." and idx_pelanggan='$idx_pelanggan'";
				}else{
					$sWhere="where idx_pelanggan='$idx_pelanggan'";
				}
				$iTotalRecordssql=$this->db->query("SELECT * FROM $sTable $sWhere ORDER BY idx_order desc");
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
					$resi=$Row['no_pengiriman'];
						$action="<a href='#' onClick=window.open('".site_url('pelanggan/show_product')."/".$Row['idx_order']."','_blank','width=800,height=500,scrollbars=yes,status=yes,resizable=yes,screenx=0,screeny=0'); rel='tooltip' target='_blank' title='Daftar Barang Pesanan'>Daftar Barang Pesanan</a>";
					if($Row['cd_status']==0){
						$status="<b style='color:#c00000;font-size: 9px;'>Menunggu Pembayaran</b>";
					}
					if($Row['cd_status']==1){
						$status='<b style="color: #1355B9;font-size: 9px;">Pesanan diterima</b>';
					}
					if($Row['cd_status']==2){
						$status='<b style="color: #1355B9;font-size: 9px;">Pengemasan</b>';
					}
					if($Row['cd_status']==3){
						$status	='<b style="color: #1355B9;font-size: 9px;">Sedang Dikirim</b>';
						$resi	='Menunggu';
					}
					if($Row['cd_status']==4){
						$status='<b style="color: #1355B9;font-size: 9px;">Selesai</b>';
					}
					$data_arr[]=array($action,$status,$Row['id_pesanan'],$this->DateToIndo($Row['tgl_order']),$full_name."<br>".$alamat.' '.$kec.' '.$kota."<br>".$provinsi."<br>Telp:".$no_telepon,"Rp. ".number_format($Row['total_tagihan'],0,',','.'),$resi,"DT_RowId"=>"td_".$Row['idx_order']);
					$i++;
				}
				$data_json=array('sEcho'=>$sEcho,'iTotalRecords'=>$iTotalRecords,'iTotalDisplayRecords'=>$iTotalRecords,'aaData'=>$data_arr);
				echo json_encode($data_json);
		}
		function discount_pembelian(){
			$Q=$this->db->query("select a.idx_type_promo,b.* from promo_management a join content_prom b on a.idx_promo=b.idx_promo where a.idx_type_promo=4");
			return $Q;
		}
		
}
