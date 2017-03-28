<?php 
date_default_timezone_set('Asia/Jakarta');
defined('BASEPATH') OR exit('No direct script access allowed');
class parameter_model extends CI_model{
		function __construct(){
			parent::__construct();
			$this->load->database();
			$this->load->helper(array('form', 'url'));
			$this->load->model('additional_model');
		}
		function delete($target,$idx){
			if($target=="bank"){
				$logo_bank=$this->db->get_where("account_bank",array("idx_account_bank"=>$idx))->row()->logo_bank;
				if($logo_bank){
					unlink("./uploads/".$logo_bank);
				}
				$this->db->delete('account_bank', array('idx_account_bank' =>$idx));
				redirect('parameter/bank');
			}
			if($target=="attribute"){
				$this->db->delete('attribute', array('idx_attribute' =>$idx));
				redirect('parameter/attribute');
			}
			if($target=="page"){
				$this->db->delete('page', array('idx_page' =>$idx));
				redirect('parameter/page');
			}
		}
		function save($target){
			if($target=="bank"){
				if(($this->input->post('nm_bank'))&&($this->input->post('atas_nama'))&&($this->input->post('no_rek'))){
						$logo_bank='';
						if((isset($_FILES['logo_bank']['name']))&&($_FILES['logo_bank']['name']!="")){
							$up=$this->do_upload('logo_bank','');
							if($up==0){
								echo'<div class="alert alert-danger"><button class="close" data-dismiss="alert">×</button><strong>Error!&nbsp;</strong>Terjadi Kesalahan pada file logo,Pastikan file yang anda upload sesuai kriteria!!</div>';
								die();
							}
							$this->resize_image($this->upload->upload_path.$this->upload->file_name,200,100);
							$logo_bank=$this->upload->file_name;
						}
						$data = array(
						   'nm_bank' =>$this->input->post('nm_bank'),
						    'atas_nama' =>$this->input->post('atas_nama'),
							 'no_rek' =>$this->input->post('no_rek'),
							 'logo_bank' =>$logo_bank
						);
						$save=$this->db->insert('account_bank', $data); 
						if($save){
							echo'<div class="alert alert-success"><strong>Success!</strong>Data berhasil disimpan.</div>';
							echo"<script>
								setTimeout(function () {
									window.location='".site_url('parameter/bank')."';
								},1000);
							</script>";
						}else{
							echo '<div class="alert alert-error"><strong>Oopss!&nbsp;</strong>Terjadi Kesalahan Sistem, Silahkan ulangi lagi!!</div>';
							die();
						}
				}else{
					echo '<div class="alert alert-error"><strong>Error!</strong>Lengkapi data yang diminta!!</div>';
					die();
				}
			}
			if($target=="page"){
				if($this->input->post('nm_page')){
						$re = array(" ", "/", "-", "_", ".", "%", "#", "@", "!", "?", ";", ")", "(", '"\"', "|", "{", "}", "*", "&", "^", "!", "+","=");
						$link=strtolower(str_replace($re,"",$this->input->post('nm_page')));
						$data = array(
						   'nm_page' =>$this->input->post('nm_page'),
						    'content' =>$this->input->post('content'),
							 'link' =>$link
						);
						$save=$this->db->insert('page', $data); 
						if($save){
							echo'<div class="alert alert-success"><strong>Success!</strong>Data berhasil disimpan.</div>';
							echo"<script>
								setTimeout(function () {
									window.location='".site_url('parameter/page')."';
								},1000);
							</script>";
						}else{
							echo '<div class="alert alert-error"><strong>Oopss!&nbsp;</strong>Terjadi Kesalahan Sistem, Silahkan ulangi lagi!!</div>';
							die();
						}
				}else{
					echo '<div class="alert alert-error"><strong>Error!</strong>Lengkapi data yang diminta!!</div>';
					die();
				}
			}
			if($target=="attribute"){
				if($this->input->post('nm_attribute')){
						$data = array('nm_attribute' =>$this->input->post('nm_attribute'));
						$save=$this->db->insert('attribute', $data); 
						if($save){
							echo'<div class="alert alert-success"><strong>Success!</strong>Data berhasil disimpan.</div>';
							echo"<script>
								setTimeout(function () {
									window.location='".site_url('parameter/attribute')."';
								},1000);
							</script>";
						}else{
							echo '<div class="alert alert-error"><strong>Oopss!&nbsp;</strong>Terjadi Kesalahan Sistem, Silahkan ulangi lagi!!</div>';
							die();
						}
				}else{
					echo '<div class="alert alert-error"><strong>Error!</strong>Lengkapi data yang diminta!!</div>';
					die();
				}
			}
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
		function update($target){
			if($target=="bank"){
				if(($this->input->post('nm_bank'))&&($this->input->post('atas_nama'))&&($this->input->post('no_rek'))){
					$logo_bank=$this->input->post('logo_bank_old');
						if((isset($_FILES['logo_bank']['name']))&&($_FILES['logo_bank']['name']!="")){
							$up=$this->do_upload('logo_bank','');
							if($up==0){
								echo'<div class="alert alert-danger"><button class="close" data-dismiss="alert">×</button><strong>Error!&nbsp;</strong>Terjadi Kesalahan pada file logo,Pastikan file yang anda upload sesuai kriteria!!</div>';
								die();
							}
							$this->resize_image($this->upload->upload_path.$this->upload->file_name,200,100);
							if($logo_bank){
								unlink('./uploads/'.$logo_bank);
							}
							$logo_bank=$this->upload->file_name;
						}
					$data = array(
						   'nm_bank' =>$this->input->post('nm_bank'),
						    'atas_nama' =>$this->input->post('atas_nama'),
							 'no_rek' =>$this->input->post('no_rek'),
							  'logo_bank' =>$logo_bank
						);
					$this->db->where('idx_account_bank',$this->input->post('idx_account_bank'));
					$update=$this->db->update('account_bank', $data); 
					if($update){
						echo'<div class="alert alert-success"><strong>Success!</strong>Data berhasil diubah.</div>';
						echo"<script>
							setTimeout(function () {
								window.location='".site_url('parameter/bank')."';
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
			if($target=="page"){
				if($this->input->post('nm_page')){
						$content=$this->input->post('content');
						$re 	= array(" ", "/", "-", "_", ".", "%", "#", "@", "!", "?", ";", ")", "(", '"\"', "|", "{", "}", "*", "&", "^", "!", "+","=");
						$link	=strtolower(str_replace($re,"",$this->input->post('nm_page')));
					$data = array(
						   'nm_page' =>$this->input->post('nm_page'),
						   'content' =>$content,
						    'link' =>$link
						);
					$this->db->where('idx_page',$this->input->post('idx_page'));
					$update=$this->db->update('page', $data); 
					if($update){
						echo'<div class="alert alert-success"><strong>Success!</strong>Data berhasil diubah.</div>';
						echo"<script>
							setTimeout(function () {
								window.location='".site_url('parameter/page')."';
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
			if($target=="attribute"){
				if($this->input->post('nm_attribute')){
					$data = array(
						   'nm_attribute' =>$this->input->post('nm_attribute')
						);
					$this->db->where('idx_attribute',$this->input->post('idx_attribute'));
					$update=$this->db->update('attribute', $data); 
					if($update){
						echo'<div class="alert alert-success"><strong>Success!</strong>Data berhasil diubah.</div>';
						echo"<script>
							setTimeout(function () {
								window.location='".site_url('parameter/attribute')."';
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
			
		}
		function list_type_perusahaan(){
			$sEcho=$_GET['sEcho'];
			$iDisplayStart=$_GET['iDisplayStart'];
			$iDisplayLenght=$_GET['iDisplayLength'];
			$sort_by=$_GET['iSortCol_0'];
			$nm_kolom=array('idx_type_company','code','nama');
			$sTable = "type_company";
			$sSortDir_0=$_GET['sSortDir_0'];
			$iTotalRecordssql=$this->db->query("SELECT * FROM $sTable  ORDER BY idx_type_company desc");
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
					$action="
						<a href='".site_url('parameter/edit/type_perusahaan/'.$Row['idx_type_company'])."' rel='tooltip' title='Edit'>Edit</a> &nbsp;|&nbsp;
						<a href='#' onClick='if(confirm(\"Anda Yakin akan menghapus data ini?\")) window.location=\"".site_url()."/parameter/delete/type_perusahaan/".$Row['idx_type_company']."\";' rel='tooltip' title='Delete'>Delete</a>
						";
					//$checkbox="<input type='radio' name='cd_artikel' value='".$Row['cd_artikel']."' onClick=view_list('$Row[cd_artikel]') >&nbsp;";
					$data_arr[]=array($action,$Row['code'],$Row['nama'],"DT_RowId"=>"td_".$Row['idx_type_company']);
					$i++;
				}
				$data_json=array('sEcho'=>$sEcho,'iTotalRecords'=>$iTotalRecords,'iTotalDisplayRecords'=>$iTotalRecords,'aaData'=>$data_arr);
				echo json_encode($data_json);
		}
		function list_attribute(){
			$sEcho=$_GET['sEcho'];
			$iDisplayStart=$_GET['iDisplayStart'];
			$iDisplayLenght=$_GET['iDisplayLength'];
			$sort_by=$_GET['iSortCol_0'];
			$nm_kolom=array('idx_attribute','nm_attribute');
			$sTable = "attribute";
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
							
								$sWhere .= "".$nm_kolom[$i]." LIKE '%".mysql_real_escape_string( $_GET['sSearch'] )."%' OR ";
							
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
				foreach($query->result_array() as $Row){									$val_del=$this->db->get_where("attribute_product",array("idx_atrribute"=>$Row['idx_attribute']))->num_rows();
					$action="
						<a href='".site_url('parameter/edit/attribute/'.$Row['idx_attribute'])."' rel='tooltip' title='Edit'>Edit</a> &nbsp;|&nbsp;						";						if($val_del==0){						$action=$action."
						<a href='#' onClick='if(confirm(\"Anda Yakin akan menghapus data ini?\")) window.location=\"".site_url()."/parameter/delete/attribute/".$Row['idx_attribute']."\";' rel='tooltip' title='Delete'>Delete</a>
						";						}
					//$checkbox="<input type='radio' name='cd_artikel' value='".$Row['cd_artikel']."' onClick=view_list('$Row[cd_artikel]') >&nbsp;";
					$data_arr[]=array($action,$Row['nm_attribute'],"DT_RowId"=>"td_".$Row['idx_attribute']);
					$i++;
				}
				$data_json=array('sEcho'=>$sEcho,'iTotalRecords'=>$iTotalRecords,'iTotalDisplayRecords'=>$iTotalRecords,'aaData'=>$data_arr);
				echo json_encode($data_json);
		}
		function list_bank(){
			$sEcho=$_GET['sEcho'];
			$iDisplayStart=$_GET['iDisplayStart'];
			$iDisplayLenght=$_GET['iDisplayLength'];
			$sort_by=$_GET['iSortCol_0'];
			$nm_kolom=array('idx_account_bank','nm_bank','atas_nama','no_rek');
			$sTable = "account_bank";
			$sSortDir_0=$_GET['sSortDir_0'];
			$iTotalRecordssql=$this->db->query("SELECT * FROM $sTable  ORDER BY idx_account_bank desc");
			$iTotalRecords=$iTotalRecordssql->num_rows();
			$sWhere = "";
				if ( isset($_GET['sSearch']) && $_GET['sSearch'] != "" )
				{
					$sWhere = "WHERE (";
					for ( $i=0 ; $i<count($nm_kolom) ; $i++ )
					{
						if ( isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" )
						{
							
								$sWhere .= "".$nm_kolom[$i]." LIKE '%".mysql_real_escape_string( $_GET['sSearch'] )."%' OR ";
							
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
					$action="
						<a href='".site_url('parameter/edit/bank/'.$Row['idx_account_bank'])."' rel='tooltip' title='Edit'>Edit</a> &nbsp;|&nbsp;
						<a href='#' onClick='if(confirm(\"Anda Yakin akan menghapus data ini?\")) window.location=\"".site_url()."/parameter/delete/bank/".$Row['idx_account_bank']."\";' rel='tooltip' title='Delete'>Delete</a>
						";
					//$checkbox="<input type='radio' name='cd_artikel' value='".$Row['cd_artikel']."' onClick=view_list('$Row[cd_artikel]') >&nbsp;";
					$data_arr[]=array($action,$Row['nm_bank'],$Row['atas_nama'],$Row['no_rek'],"DT_RowId"=>"td_".$Row['idx_account_bank']);
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
			$nm_kolom=array('idx_page','nm_page');
			$sTable = "page";
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
							
								$sWhere .= "".$nm_kolom[$i]." LIKE '%".mysql_real_escape_string( $_GET['sSearch'] )."%' OR ";
							
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
					$action="
						<a href='".site_url('parameter/edit/page/'.$Row['idx_page'])."' rel='tooltip' title='Edit'>Edit</a>
						<!--<a href='#' onClick='if(confirm(\"Anda Yakin akan menghapus data ini?\")) window.location=\"".site_url()."/parameter/delete/page/".$Row['idx_page']."\";' rel='tooltip' title='Delete'>Delete</a>-->
						";
					//$checkbox="<input type='radio' name='cd_artikel' value='".$Row['cd_artikel']."' onClick=view_list('$Row[cd_artikel]') >&nbsp;";
					$data_arr[]=array($action,$Row['nm_page'],"DT_RowId"=>"td_".$Row['idx_page']);
					$i++;
				}
				$data_json=array('sEcho'=>$sEcho,'iTotalRecords'=>$iTotalRecords,'iTotalDisplayRecords'=>$iTotalRecords,'aaData'=>$data_arr);
				echo json_encode($data_json);
		}	
}
