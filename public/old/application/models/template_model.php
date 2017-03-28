<?php 
date_default_timezone_set('Asia/Jakarta');
defined('BASEPATH') OR exit('No direct script access allowed');
class template_model extends CI_model{
		function __construct(){
			parent::__construct();
			$this->load->database();
			$this->load->helper(array('form', 'url'));
			$this->load->model('additional_model');
			
		}
		function delete($idx){
				$r_image= $this->additional_model->get_where_row('template','idx_template',$idx);
				if(is_file("./uploads/template/".$r_image->thumb)){
					unlink("./uploads/template/".$r_image->thumb);
				}
				if(is_file("./uploads/template/".$r_image->screenshot)){
					unlink("./uploads/template/".$r_image->screenshot);
				}
				$this->db->delete('template', array('idx_template' =>$idx));
				redirect('template');
		}
		function save(){
				if(($this->input->post('nm_template'))&&($this->input->post('code_paket'))){
					$screenshot='';
					if(isset($_FILES['screenshot']['name'])){
							$up=$this->do_upload('screenshot',time());
							if($up==0){
								echo'<div class="alert alert-danger"><button class="close" data-dismiss="alert">×</button><strong>Error!&nbsp;</strong>Terjadi Kesalahan pada file logo,Pastikan file yang anda upload sesuai kriteria!!</div>';
								die();
							}
							$data = $this->upload->data();
							$thumbnail = $data['raw_name'].'_thumb'.$data['file_ext'];
							$this->resize_image($this->upload->upload_path.$this->upload->file_name,150,100);
							$screenshot=$this->upload->file_name;
					}else{
						echo'<div class="alert alert-danger"><button class="close" data-dismiss="alert">×</button><strong>Error!&nbsp;</strong>Mohon upload screenshot template!!</div>';
						die();
					}
					$data = array(
					   'code_paket' =>$this->input->post('code_paket'),
					   'nm_template' =>$this->input->post('nm_template'),
					   'description' =>$this->input->post('description'),
					   'screenshot' =>$screenshot,
					   'thumb' =>$thumbnail
					);
					$save=$this->db->insert('template ', $data); 
					if($save){
						echo'<div class="alert alert-success"><button class="close" data-dismiss="alert">×</button><h4>Success!</h4><p>Data berhasil disimpan.</p></div>';
						echo"<script>
							setTimeout(function () {
								window.location='".site_url('template')."';
							},2000);
						</script>";
					}else{
						echo'<div class="alert alert-danger"><button class="close" data-dismiss="alert">×</button><strong>Oopss!&nbsp;</strong>Terjadi Kesalahan Sistem, Silahkan ulangi lagi!!</div>';
						die();
					}
				}else{
					echo'<div class="alert alert-danger"><button class="close" data-dismiss="alert">×</button><strong>Error!&nbsp;</strong>Lengkapi data yang diminta!!</div>';
					die();
				}
		}
		function do_upload($htmlFieldName,$file_name){
				$config['file_name'] = $file_name;
				$config['upload_path'] = './uploads/template';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size'] = '1000';
				$config['max_width'] = '2000';
				$config['max_height'] = '2000';
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
				$config['maintain_ratio'] = TRUE;
				$config['create_thumb'] = TRUE;
				$config['width'] = $witdh;
				$config['height'] = $height;
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();
		}
		function update(){
				if(($this->input->post('nm_template'))&&($this->input->post('code_paket'))){
					$screenshot	=$this->input->post('screenshot_old');
					$thumbnail	=$this->input->post('thumb_old');
					$idx		=$this->input->post('idx_template');
					if(isset($_FILES['screenshot']['name'])){
							$r_image= $this->additional_model->get_where_row('template','idx_template',$idx);
							if(is_file("./uploads/template/".$r_image->thumb)){
								unlink("./uploads/template/".$r_image->thumb);
							}
							if(is_file("./uploads/template/".$r_image->screenshot)){
								unlink("./uploads/template/".$r_image->screenshot);
							}
							$up=$this->do_upload('screenshot',time());
							if($up==0){
								echo'<div class="alert alert-danger"><button class="close" data-dismiss="alert">×</button><strong>Error!&nbsp;</strong>Terjadi Kesalahan pada file logo,Pastikan file yang anda upload sesuai kriteria!!</div>';
								die();
							}
							$data = $this->upload->data();
							$thumbnail = $data['raw_name'].'_thumb'.$data['file_ext'];
							$this->resize_image($this->upload->upload_path.$this->upload->file_name,150,100);
							$screenshot=$this->upload->file_name;
					}
					$data = array(
					   'code_paket' =>$this->input->post('code_paket'),
					   'nm_template' =>$this->input->post('nm_template'),
					   'description' =>$this->input->post('description'),
					   'screenshot' =>$screenshot,
					   'thumb' =>$thumbnail
					);
					$this->db->where('idx_template',$this->input->post('idx_template'));
					$update=$this->db->update('template', $data); 
						if($update){
							echo'<div class="alert alert-success"><button class="close" data-dismiss="alert">×</button><h4>Success!</h4><p>Data berhasil diubah.</p></div>';
							echo"<script>
								setTimeout(function () {
									window.location='".site_url('template')."';
								},2000);
							</script>";
						}else{
							echo'<div class="alert alert-danger"><button class="close" data-dismiss="alert">×</button><strong>Oopss!&nbsp;</strong>Terjadi Kesalahan Sistem, Silahkan ulangi lagi!!</div>';
							die();
						}
				}else{
					echo'<div class="alert alert-danger"><button class="close" data-dismiss="alert">×</button><strong>Error!&nbsp;</strong>Lengkapi data yang diminta!!</div>';
					die();
				}
			
		}
		function list_template(){
			$sEcho=$_GET['sEcho'];
			$iDisplayStart=$_GET['iDisplayStart'];
			$iDisplayLenght=$_GET['iDisplayLength'];
			$sort_by=$_GET['iSortCol_0'];
			$nm_kolom=array('a.idx_template','a.thumb','a.nm_template','b.nm_paket','a.description');
			$sSortDir_0=$_GET['sSortDir_0'];
			$iTotalRecordssql=$this->db->query("SELECT a.*,b.nm_paket FROM template a join tb_paket b on a.code_paket=b.code order by a.idx_template desc");
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

				$sQuery ="SELECT ".str_replace(" , ", " ", implode(", ", $nm_kolom))." FROM template a join tb_paket b on a.code_paket=b.code $sWhere
							order by
							$nm_kolom[$sort_by] $sSortDir_0
							limit $iDisplayStart,$iDisplayLenght";
				$query=$this->db->query($sQuery);
				$data_arr=array();
				$i==0;
				foreach($query->result_array() as $Row){
					$image="<img src='".base_url()."uploads/template/".$Row['thumb']."'>";
					$action="
						<a href='".site_url('template/edit/'.$Row['idx_template'])."' rel='tooltip' title='Edit'>Edit</a> &nbsp;|&nbsp;
						<a href='#' onClick='if(confirm(\"Anda Yakin akan menghapus data ini?\")) window.location=\"".site_url()."/template/delete/".$Row['idx_template']."\";' rel='tooltip' title='Delete'>Delete</a>
						";
					$data_arr[]=array($action,$image,$Row['nm_template'],$Row['nm_paket'],$Row['description'],"DT_RowId"=>"td_".$Row['idx_template']);
					$i++;
				}
				$data_json=array('sEcho'=>$sEcho,'iTotalRecords'=>$iTotalRecords,'iTotalDisplayRecords'=>$iTotalRecords,'aaData'=>$data_arr);
				echo json_encode($data_json);
		}
		
	
}
