<?php 
date_default_timezone_set('Asia/Jakarta');
defined('BASEPATH') OR exit('No direct script access allowed');
class promo_model extends CI_model{
		function __construct(){
			parent::__construct();
			$this->load->database();
			$this->load->helper(array('form', 'url'));
			$this->load->model('additional_model');
			$this->load->library('image_lib');
			$this->load->library('upload');
		}
		function delete($target,$idx){
			if($target=="promo"){
				$query 	=$this->db->get_where('promo_management',array('idx_promo'=>$idx))->row();
				if($query->path_slide){
					if(file_exists('./uploads/promo_slide/'.$query->path_slide)){
						unlink('./uploads/promo_slide/'.$query->path_slide); 
					}	
				}
				if($query->idx_type_promo==5){
					$this->db->query('delete from free_shipping_city');
				}
				$this->db->delete('promo_management', array('idx_promo' =>$idx));
				$this->db->delete('content_prom', array('idx_promo' =>$idx));
				redirect('promo/dt_promo');
			}
			if($target=="content_promo"){
				$this->db->delete('content_prom', array('idx_content_promo' =>$idx));
				redirect('promo/edit_product/'.$this->uri->segment(5));
			}
		}
		function save($target){
			if($target=="promo"){
				if($this->input->post('idx_type_promo')){
					if(($this->input->post('idx_type_promo')<>6)&&($this->input->post('idx_type_promo')<>7)){
						if((!$this->input->post('nm_promo'))||(!isset($_FILES['path_slide']['name']))&&($_FILES['path_slide']['name']=="")){
							echo '<div class="alert alert-error">Lengkapi data yang diminta!!</div>';
							die();
						}
					}
					if($this->input->post('idx_type_promo')==6){
						if((!isset($_FILES['path_slide']['name']))||($_FILES['path_slide']['name']=="")){
							echo '<div class="alert alert-error">Lengkapi data yang diminta!!</div>';
							die();
						}
					}
					if($this->input->post('idx_type_promo')==7){
						if((!$this->input->post('jdl_slide'))||(!isset($_FILES['path_slide']['name']))&&($_FILES['path_slide']['name']=="")){
							echo '<div class="alert alert-error">Lengkapi data yang diminta!!</div>';
							die();
						}
					}
				}else{
					echo '<div class="alert alert-error">Lengkapi data yang diminta!!</div>';
					die();
				}
						$path_slide		='';			
						if((isset($_FILES['path_slide']['name']))||(@$_FILES['path_slide']['name']!="")){
							$up			=$this->do_upload('path_slide',time());
							if($up==0){
								echo'<div class="alert alert-danger">Resolusi atau ukuran gambar terlalu besar.!!</div>';
								die();
							}
							if($this->input->post('position')==1){
								$this->resize_image($this->upload->upload_path.$this->upload->file_name,700,400);
							}else{
								$this->resize_image($this->upload->upload_path.$this->upload->file_name,300,180);
							}
							$path_slide	=$this->upload->file_name;
						}
						if(($this->input->post('idx_type_promo')<>6)&&($this->input->post('idx_type_promo')<>7)){
							$data = array(
							   'nm_promo' =>$this->input->post('nm_promo'),
							   'idx_type_promo' =>$this->input->post('idx_type_promo'),
							   'tgl_awal' =>$this->input->post('tgl_awal'),
							   'tgl_akhir' =>$this->input->post('tgl_akhir'),
							   'path_slide' =>$path_slide,
							   'position' =>$this->input->post('position')
							);
						}
						if($this->input->post('idx_type_promo')==6){
							$data = array(
							   'nm_promo' =>$this->input->post('idx_category'),
							   'idx_type_promo' =>$this->input->post('idx_type_promo'),
							   'path_slide' =>$path_slide,
							   'position' =>$this->input->post('position')
							);
						}
						if($this->input->post('idx_type_promo')==7){
							$data = array(
							   'nm_promo' =>$this->input->post('jdl_slide'),
							   'idx_type_promo' =>$this->input->post('idx_type_promo'),
							   'path_slide' =>$path_slide,
							   'position' =>$this->input->post('position')
							);
						}
						$save=$this->db->insert('promo_management', $data); 
						if($save){
							if(($this->input->post('idx_type_promo')==6)||($this->input->post('idx_type_promo')==7)){
								echo'<div class="alert alert-success">Data berhasil disimpan.</div>';
								echo"<script>
										window.location='".site_url('promo/dt_promo')."';
								</script>";
								die();
							}
								$idx_promo	=$this->db->query("select idx_promo from promo_management order by idx_promo desc limit 1")->row()->idx_promo;
								echo'<div class="alert alert-success">Data berhasil disimpan.</div>';
								echo"<script>
										window.location='".site_url('promo/content_promo/'.$idx_promo)."';
								</script>";
						}else{
							echo '<div class="alert alert-error"><strong>Oopss!&nbsp; </strong>Terjadi Kesalahan Sistem, Silahkan ulangi lagi!!</div>';
							die();
						}
			}
			if($target=="content_promo"){
				$idx_product=$this->input->post('idx_product');
					if($this->input->post('idx_type_promo')==1){
						if(is_numeric($this->input->post('discount'))){
							if(is_numeric($this->uri->segment(4))){
								if($idx_product){
									for($i=0;$i<count($idx_product);$i++){
										if($this->db->get_where("content_prom",array('idx_promo'=>$this->uri->segment(4),'idx_product'=>$idx_product[$i]))->num_rows()==0){
											$this->cek_discount($idx_product[$i]);
											$data = array(
												'idx_promo' =>$this->uri->segment(4),
												'idx_product' =>$idx_product[$i],
												'discount' =>$this->input->post('discount')
											);
											$save=$this->db->insert('content_prom', $data);
										}
									}
									if($this->input->post('fl_submit')==1){
										$this->db->where('idx_promo',$this->uri->segment(4));
										$this->db->update('content_prom', array('discount' =>$this->input->post('discount'))); 
									}
								}else{
									echo '<div class="alert alert-error">Pilih Produk yg akan dipromo</div>';
									die();
								}
							}else{
								echo"<script>
										window.location='".site_url('promo')."';
								</script>";
							}
						}else{
							echo '<div class="alert alert-error">Discount salah!!</div>';
							die();
						}
					}
						if($this->input->post('idx_type_promo')==2){
							if(is_numeric($this->uri->segment(4))){
								if($idx_product){
									$error=0;
									$bogof_caption=$this->input->post('bogof_caption');
									for($i=0;$i<count($idx_product);$i++){
										if(!$bogof_caption[$i]){
											$error=1;
										}
									}
									if($error==0){
										for($i=0;$i<count($idx_product);$i++){
											if($this->db->get_where("content_prom",array('idx_promo'=>$this->uri->segment(4),'idx_product'=>$idx_product[$i]))->num_rows()==0){
												$data = array(
												   'idx_promo' =>$this->uri->segment(4),
													'idx_product' =>$idx_product[$i],
													'bogof_caption' =>$bogof_caption[$i]
												);
												$save=$this->db->insert('content_prom', $data);
											}
										}
									}else{
										echo '<div class="alert alert-error">Anda harus mengisi semua pesan bonus pada masing-masing produk yg dipilih.</div>';
										die();
									}
								}else{
									echo '<div class="alert alert-error">Pilih Produk yg akan dipromo</div>';
									die();
								}
							}else{
								echo"<script>
										window.location='".site_url('promo')."';
								</script>";
							}
						}
						if($this->input->post('idx_type_promo')==4){
							$error="";
							if(is_numeric($this->uri->segment(4))){
								if(!is_numeric($this->input->post('minimum_transaksi'))){
									$error=$error."<p> - Minimum transaksi tidak boleh diisi angka.</p>";
								}
								if(!is_numeric($this->input->post('discount'))){
									$error=$error."<p> - Diskon Salah</p>";
								}
								if($error<>""){
									echo '<div class="alert alert-error">'.$error.'</div>';
									die();
								}
									$data = array(
									   'idx_promo' =>$this->uri->segment(4),
									   'discount' =>$this->input->post('discount'),
									   'minimum_transaksi' =>$this->input->post('minimum_transaksi')
									);
									$save=$this->db->insert('content_prom', $data);
							}else{
								echo"<script>
										window.location='".site_url('promo')."';
								</script>";
							}
						}
						if($this->input->post('idx_type_promo')==5){
							if(is_numeric($this->uri->segment(4))){
								if($idx_product){
									for($i=0;$i<count($idx_product);$i++){
										if($this->db->get_where("content_prom",array('idx_promo'=>$this->uri->segment(4),'idx_product'=>$idx_product[$i]))->num_rows()==0){
											$data = array(
											   'idx_promo' =>$this->uri->segment(4),
											   'idx_product' =>$idx_product[$i],
											   'fl_free_ongkir' =>1
											);
											$save=$this->db->insert('content_prom', $data);
										}
									}
									$kota=$this->input->post('kota');
									$this->db->query("Delete from free_shipping_city");
									if($kota){
										for($i=0;$i<count($kota);$i++){
											$data = array(
											   'kota' =>$kota[$i]
											);
											$save=$this->db->insert('free_shipping_city', $data);
										}
									}else{
										$this->db->query("INSERT INTO `free_shipping_city`(`kota`) SELECT kota FROM `shipping_location`");
									}
								}else{
									echo '<div class="alert alert-error">Pilih Produk yg akan dipromo</div>';
									die();
								}
							}else{
								echo"<script>
										window.location='".site_url('promo')."';
								</script>";
							}
						}
						//if($save){
							echo'<div class="alert alert-success">Data berhasil disimpan.</div>';
							if($this->input->post('save')=="finish"){
								echo"<script>
										window.location='".site_url('promo')."';
								</script>";
							}
						/*}else{
							echo '<div class="alert alert-error"><strong>Oopss!&nbsp; </strong>Terjadi Kesalahan Sistem, Silahkan ulangi lagi!!</div>';
							die();
						}*/
			}
			
		}
		function cek_discount($product){
			$Q=$this->db->get_where("product",array("idx_product"=>$product));
			if($Q->row()->discount<>0){
				$this->db->where('idx_product',$product);
				$this->db->update('product', array('discount' =>0,'harga_discount'=>$Q->row()->harga)); 
			}
		}
		function do_upload($htmlFieldName,$file_name){
				$config['file_name'] = $file_name;
				$config['upload_path'] = './uploads/promo_slide';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_width'] = '2000';
				$config['max_height'] = '2000';
				$this->upload->initialize($config);
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
				$config['width'] = $witdh;
				$config['height'] = $height;
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
		}
		function update($target){
			if($target=="promo"){
				if($this->input->post('idx_type_promo')){
					if(($this->input->post('idx_type_promo')<>6)&&($this->input->post('idx_type_promo')<>7)){
						if(!$this->input->post('nm_promo')){
							echo '<div class="alert alert-error">Lengkapi data yang diminta!!</div>';
							die();
						}
					}
				}else{
					echo '<div class="alert alert-error">Lengkapi data yang diminta!!</div>';
					die();
				}
						$path_slide		=$this->input->post('path_slide_text');
						if((isset($_FILES['path_slide']['name']))||($_FILES['path_slide']['name']!="")){
							$up			=$this->do_upload('path_slide',time());
							if($up==0){
								echo'<div class="alert alert-danger">Resolusi atau ukuran gambar terlalu besar.!!</div>';
								die();
							}
							if($this->input->post('position')==1){
								$this->resize_image($this->upload->upload_path.$this->upload->file_name,650,434);
							}else{
								$this->resize_image($this->upload->upload_path.$this->upload->file_name,300,180);
							}
							if($path_slide){
								if(file_exists('./uploads/promo_slide/'.$path_slide)){
									unlink('./uploads/promo_slide/'.$path_slide); 
								}
							}
							$path_slide	=$this->upload->file_name;
						}else{
							if($this->input->post('position')!=$this->input->post('position_old')){
								if($this->input->post('position')==1){
									$this->resize_image('./uploads/promo_slide/'.$path_slide,700,450);
								}else{
									$this->resize_image('./uploads/promo_slide/'.$path_slide,300,180);
								}
							}
						}
						if(($this->input->post('idx_type_promo')<>6)&&($this->input->post('idx_type_promo')<>7)){
							$data = array(
							   'nm_promo' =>$this->input->post('nm_promo'),
							   'idx_type_promo' =>$this->input->post('idx_type_promo'),
							   'tgl_awal' =>$this->input->post('tgl_awal'),
							   'tgl_akhir' =>$this->input->post('tgl_akhir'),
							   'path_slide' =>$path_slide,
							   'position' =>$this->input->post('position')
							);
						}
						if($this->input->post('idx_type_promo')==6){
							$data = array(
							   'nm_promo' =>$this->input->post('idx_category'),
							   'idx_type_promo' =>$this->input->post('idx_type_promo'),
							   'path_slide' =>$path_slide,
							   'position' =>$this->input->post('position')
							);
						}
						if($this->input->post('idx_type_promo')==7){
							$data = array(
							   'nm_promo' =>$this->input->post('jdl_slide'),
							   'idx_type_promo' =>$this->input->post('idx_type_promo'),
							   'path_slide' =>$path_slide,
							   'position' =>$this->input->post('position')
							);
						}
					$this->db->where('idx_promo',$this->input->post('idx_promo'));
					$update=$this->db->update('promo_management', $data); 
					if($update){
							if(($this->input->post('idx_type_promo')==6)||($this->input->post('idx_type_promo')==7)){
								echo'<div class="alert alert-success">Data berhasil disimpan.</div>';
								echo"<script>
										window.location='".site_url('promo/dt_promo')."';
								</script>";
								die();
							}
						echo'<div class="alert alert-success">Data berhasil diubah.</div>';
						echo"<script>
								window.location='".site_url('promo')."';
						</script>";
					}else{
						echo '<div class="alert alert-error"><strong>Oopss!</strong>Terjadi Kesalahan Sistem, Silahkan ulangi lagi!!</div>';
						die();
					}
			}
					if($target=="content_promo"){
						if($this->input->post('idx_type_promo')==1){
							if(is_numeric($this->input->post('discount'))){
								$idx_product=$this->input->post('idx_product');
									if(is_numeric($this->uri->segment(4))){
										if($idx_product){
											for($i=0;$i<count($idx_product);$i++){
												$this->cek_discount($idx_product[$i]);
												$data = array(
													'idx_promo' =>$this->uri->segment(4),
													'idx_product' =>$idx_product[$i],
													'discount' =>$this->input->post('discount')
												);
												$this->db->insert('content_prom', $data);
											}
										}else{
											if($this->db->get_where("content_prom",array("idx_promo"=>$this->uri->segment(4)))->num_rows()==0){
												echo '<div class="alert alert-error">Pilih Produk yg akan dipromo</div>';
												die();
											}
										}
											$this->db->where('idx_promo',$this->uri->segment(4));
											$update=$this->db->update('content_prom', array('discount' =>$this->input->post('discount'))); 
									}else{
										echo"<script>
												window.location='".site_url('promo')."';
										</script>";
									}
							}else{
								echo '<div class="alert alert-error">Discount salah!!</div>';
								die();
							}
						}
						if($this->input->post('idx_type_promo')==5){
								$idx_product=$this->input->post('idx_product');
									if(is_numeric($this->uri->segment(4))){
										if($idx_product){
											for($i=0;$i<count($idx_product);$i++){
												$this->cek_discount($idx_product[$i]);
												$data = array(
													 'idx_promo' =>$this->uri->segment(4),
													   'idx_product' =>$idx_product[$i],
													   'fl_free_ongkir' =>1
												);
												$this->db->insert('content_prom', $data);
											}
										}else{
											if($this->db->get_where("content_prom",array("idx_promo"=>$this->uri->segment(4)))->num_rows()==0){
												echo '<div class="alert alert-error">Pilih Produk yg akan dipromo</div>';
												die();
											}
										}
											$kota=$this->input->post('kota');
											$this->db->query("Delete from free_shipping_city");
											if($kota){
												for($i=0;$i<count($kota);$i++){
													$data = array(
													   'kota' =>$kota[$i]
													);
													$update=$this->db->insert('free_shipping_city', $data);
												}
											}else{
												$update=$this->db->query("INSERT INTO `free_shipping_city`(`kota`) SELECT kota FROM `shipping_location`");
											}
									}else{
										echo"<script>
												window.location='".site_url('promo')."';
										</script>";
									}
						}
						if($this->input->post('idx_type_promo')==2){
								$bogof_caption=$this->input->post('bogof_caption');
								$bogof_caption_use=$this->input->post('bogof_caption_use');
								$idx_content_promo=$this->input->post('idx_content_promo');
								$idx_product=$this->input->post('idx_product');
									if(is_numeric($this->uri->segment(4))){
										if($idx_product){
											$error=0;
											for($i=0;$i<count($idx_product);$i++){
												if(!$bogof_caption[$i]){
													$error=1;
												}
											}
											if($error==0){
												for($i=0;$i<count($idx_product);$i++){
													$data = array(
													   'idx_promo' =>$this->uri->segment(4),
														'idx_product' =>$idx_product[$i],
														'bogof_caption' =>$bogof_caption[$i]
													);
													$this->db->insert('content_prom', $data);
												}
											}else{
												echo '<div class="alert alert-error">Anda harus mengisi semua pesan bonus pada masing-masing produk yg dipilih.</div>';
												die();
											}
										}else{
											if($this->db->get_where("content_prom",array("idx_promo"=>$this->uri->segment(4)))->num_rows()==0){
												echo '<div class="alert alert-error">Pilih Produk yg akan dipromo</div>';
												die();
											}
										}
										if($idx_content_promo){
											for($i=0;$i<count($idx_content_promo);$i++){
												$this->db->where('idx_content_promo',$idx_content_promo[$i]);
												$update=$this->db->update('content_prom', array('bogof_caption' =>$bogof_caption_use[$i])); 
											}
										}
									}else{
										echo"<script>
												window.location='".site_url('promo')."';
										</script>";
									}
						}
						if($this->input->post('idx_type_promo')==4){
							$error="";
							if(is_numeric($this->uri->segment(4))){
								if(!is_numeric($this->input->post('minimum_transaksi'))){
									$error=$error."<p> - Minimum transaksi tidak boleh diisi angka.</p>";
								}
								if(!is_numeric($this->input->post('discount'))){
									$error=$error."<p> - Diskon Salah</p>";
								}
								if($error<>""){
									echo '<div class="alert alert-error">'.$error.'</div>';
									die();
								}
									$data = array('discount' =>$this->input->post('discount'),'minimum_transaksi' =>$this->input->post('minimum_transaksi'));
									$this->db->where('idx_promo',$this->uri->segment(4));
									$update=$this->db->update('content_prom', $data); 
							}else{
								echo"<script>
										window.location='".site_url('promo')."';
								</script>";
							}
						}
						if($update){
							echo'<div class="alert alert-success">Data berhasil diubah.</div>';
							echo"<script>
									window.location='".site_url('promo')."';
							</script>";
						}else{
							echo '<div class="alert alert-error"><strong>Oopss!</strong>Terjadi Kesalahan Sistem, Silahkan ulangi lagi!!</div>';
							die();
						}
					}
		}
		function list_promo(){
			$sEcho=$_GET['sEcho'];
			$iDisplayStart=$_GET['iDisplayStart'];
			$iDisplayLenght=$_GET['iDisplayLength'];
			$sort_by=$_GET['iSortCol_0'];
			$nm_kolom=array('idx_promo','path_slide','idx_type_promo','nm_promo','tgl_awal','tgl_akhir');
			$sTable = "promo_management";
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
					if($Row['path_slide']){
						$thumb='<img src="'.base_url().'uploads/promo_slide/'.$Row['path_slide'].'" style="width: 10em;height: 5em;" />';
					}else{
						$thumb='';
					}
					$action="
						<span class='tbico'><a href='".site_url('promo/edit/promo/'.$Row['idx_promo'])."' rel='tooltip' title='Edit'><img src='".base_url()."assets/images/edit.png'></a></span>
						<span class='tbico'><a href='#' onClick='if(confirm(\"Anda Yakin akan menghapus data ini?\")) window.location=\"".site_url()."/promo/delete/promo/".$Row['idx_promo']."\";' rel='tooltip' title='Delete'><img src='".base_url()."assets/images/delete_icon.png'></a></span>
						";
					$data_arr[]=array($action,$thumb,$this->get_element('type_promo','idx_type_promo',$Row['idx_type_promo'],'nm_type_promo'),$Row['nm_promo'],$Row['tgl_awal'],$Row['tgl_akhir'],"DT_RowId"=>"td_".$Row['idx_promo']);
					$i++;
				}
				$data_json=array('sEcho'=>$sEcho,'iTotalRecords'=>$iTotalRecords,'iTotalDisplayRecords'=>$iTotalRecords,'aaData'=>$data_arr);
				echo json_encode($data_json);
		}
		function list_product_use(){
			$sEcho=$_GET['sEcho'];
			$iDisplayStart=$_GET['iDisplayStart'];
			$iDisplayLenght=$_GET['iDisplayLength'];
			$sort_by=$_GET['iSortCol_0'];
			$nm_kolom=array('a.idx_product','b.thumb','b.category_product','b.nm_product','b.berat');
			$sSortDir_0=$_GET['sSortDir_0'];
			$idx_promo	=$_GET['idx_promo'];
			$whr="a.idx_promo=$idx_promo";
			$sWhere = "";
				if ( isset($_GET['sSearch']) && $_GET['sSearch'] != "" )
				{
					$sWhere = "WHERE (";
					for ( $i=0 ; $i<count($nm_kolom) ; $i++ )
					{
						if ( isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" )
						{
							if(($nm_kolom[$i]<>"a.idx_product")&&($nm_kolom[$i]<>"a.category_product")){
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
					$sWhere=$sWhere." and ".$whr;
				}else{
					$sWhere="where ".$whr;
				}
				$iTotalRecordssql=$this->db->query("select a.idx_content_promo,b.* from content_prom a join product b on a.idx_product=b.idx_product $sWhere");
				$iTotalRecords=$iTotalRecordssql->num_rows();
				$sQuery ="SELECT a.idx_content_promo,a.idx_promo,".str_replace(" , ", " ", implode(", ", $nm_kolom))." from content_prom a join product b on a.idx_product=b.idx_product $sWhere
							order by
							$nm_kolom[$sort_by] $sSortDir_0
							limit $iDisplayStart,$iDisplayLenght";
				$query=$this->db->query($sQuery);
				$data_arr=array();
				$i==0;
				foreach($query->result_array() as $Row){
					if($Row['thumb']){
						$thumb='<img src="'.base_url().'uploads/product/'.$Row['thumb'].'" style="width: 3em;height: 3em;" />';
					}else{
						$thumb='';
					}
					$nm="";
					$cat="";
					$query=$this->db->get_where("category_product",array("idx_category_product"=>$Row['category_product']))->row();
					if($query->parent!=0){
						$res	=$this->db->query("SELECT * FROM (`category_path`) WHERE `idx_category` ='$query->parent' order by level asc");
						foreach($res->result() as $wcp){
							if($nm==""){
								$nm=$this->get_nm($wcp->idx_path);
							}else{
								$nm=$nm." > ".$this->get_nm($wcp->idx_path);
							}
						}
						$cat=$nm." > ";
					}
					$cat=$cat.$this->get_nm($Row['category_product']);
					$action="<a href='#' onClick='if(confirm(\"Anda Yakin akan menghapus data ini?\")) window.location=\"".site_url()."promo/delete/content_promo/".$Row['idx_content_promo']."/".$Row['idx_promo']."\";' rel='tooltip' title='Delete'>Delete</a>";
					$data_arr[]=array($action,$thumb,$cat,$Row['nm_product'],$Row['berat'],"DT_RowId"=>"td_".$Row['idx_product']);
					$i++;
					$nm="";
				}
				$data_json=array('sEcho'=>$sEcho,'iTotalRecords'=>$iTotalRecords,'iTotalDisplayRecords'=>$iTotalRecords,'aaData'=>$data_arr);
				echo json_encode($data_json);
		}
		
		function list_product(){
			$sEcho=$_GET['sEcho'];
			$iDisplayStart=$_GET['iDisplayStart'];
			$iDisplayLenght=$_GET['iDisplayLength'];
			$sort_by=$_GET['iSortCol_0'];
			$nm_kolom=array('idx_product','thumb','category_product','nm_product','berat');
			$sTable = "product";
			$sSortDir_0=$_GET['sSortDir_0'];
			$idx_category	=$_GET['idx_categori'];
			$idx_brand		=$_GET['idx_brand'];
			$whr="";
			if($idx_category!=""){
					$res	=$this->db->query("SELECT * FROM (`category_path`) WHERE `idx_path` ='$idx_category' order by level asc");
					foreach($res->result() as $wcp){
						if($whr==""){
							$whr="(  category_product=$idx_category or  category_product=$wcp->idx_category";
						}else{
							$whr=$whr." or category_product=$wcp->idx_category";
						}
					}
					if($whr!=""){
						$whr=$whr.")";
					}else{
						$whr="(category_product=$idx_category)";
					}
			}
			if(($idx_category=="")&&($idx_brand=="")){$sWhere="where category_product IS NOT NULL and idx_brand IS NOT NULL";}
			if(($idx_category!="")&&($idx_brand!="")){$sWhere="where  $whr and idx_brand='$idx_brand'";}
			if(($idx_category!="")&&($idx_brand=="")){$sWhere="where $whr and idx_brand IS NOT NULL";}
			if(($idx_category=="")&&($idx_brand!="")){$sWhere="where category_product IS NOT NULL and idx_brand='$idx_brand'";}
			$iTotalRecordssql=$this->db->query("SELECT * FROM $sTable $sWhere");
			$iTotalRecords=$iTotalRecordssql->num_rows();
			$sWhere = "";
				if ( isset($_GET['sSearch']) && $_GET['sSearch'] != "" )
				{
					$sWhere = "WHERE (";
					for ( $i=0 ; $i<count($nm_kolom) ; $i++ )
					{
						if ( isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" )
						{
							if(($nm_kolom[$i]<>"idx_product")&&($nm_kolom[$i]<>"category_product")){
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
							if(($idx_category=="")&&($idx_brand=="")){$sWhere=$sWhere." and category_product IS NOT NULL and idx_brand IS NOT NULL";}
							if(($idx_category!="")&&($idx_brand!="")){$sWhere=$sWhere." $whr and idx_brand='$idx_brand'";}
							if(($idx_category!="")&&($idx_brand=="")){$sWhere=$sWhere." $whr and idx_brand IS NOT NULL";}
							if(($idx_category=="")&&($idx_brand!="")){$sWhere=$sWhere." and category_product IS NOT NULL and idx_brand='$idx_brand'";}
				}else{
					if(($idx_category=="")&&($idx_brand=="")){$sWhere="where category_product IS NOT NULL and idx_brand IS NOT NULL";}
					if(($idx_category!="")&&($idx_brand!="")){$sWhere="where $whr and idx_brand='$idx_brand'";}
					if(($idx_category!="")&&($idx_brand=="")){$sWhere="where $whr and idx_brand IS NOT NULL";}
					if(($idx_category=="")&&($idx_brand!="")){$sWhere="where category_product IS NOT NULL and idx_brand='$idx_brand'";}
				
				}
				$sQuery ="SELECT ".str_replace(" , ", " ", implode(", ", $nm_kolom))." FROM  $sTable $sWhere
							order by
							$nm_kolom[$sort_by] $sSortDir_0
							limit $iDisplayStart,$iDisplayLenght";
				$query=$this->db->query($sQuery);
				$data_arr=array();
				$i==0;
				foreach($query->result_array() as $Row){
					if($Row['thumb']){
						$thumb='<img src="'.base_url().'uploads/product/'.$Row['thumb'].'" style="width: 3em;height: 3em;" />';
					}else{
						$thumb='';
					}
					if($this->db->query("SELECT b.idx_product FROM promo_management a join content_prom b on a.idx_promo=b.idx_promo where b.idx_product='$Row[idx_product]'")->num_rows()>0){
						$status="Produk Sudah Dipromo";
						$dis="disabled";
					}else{
						$status="Kosong";
						$dis="";
					}
					$nm="";
					$cat="";
					$query=$this->db->get_where("category_product",array("idx_category_product"=>$Row['category_product']))->row();
					if($query->parent!=0){
						$res	=$this->db->query("SELECT * FROM (`category_path`) WHERE `idx_category` ='$query->parent' order by level asc");
						foreach($res->result() as $wcp){
							if($nm==""){
								$nm=$this->get_nm($wcp->idx_path);
							}else{
								$nm=$nm." > ".$this->get_nm($wcp->idx_path);
							}
						}
						$cat=$nm." > ";
					}
					$cat=$cat.$this->get_nm($Row['category_product']);
					$checkbox="<input type='checkbox' ".$dis." name='idx_product[]' value='".$Row['idx_product']."'/>";
					$data_arr[]=array($checkbox,$status,$thumb,$cat,$Row['nm_product'],$Row['berat'],"DT_RowId"=>"td_".$Row['idx_product']);
					$i++;
					$nm="";
				}
				$data_json=array('sEcho'=>$sEcho,'iTotalRecords'=>$iTotalRecords,'iTotalDisplayRecords'=>$iTotalRecords,'aaData'=>$data_arr);
				echo json_encode($data_json);
		}
		function get_nm($idx){
			return $this->db->get_where("category_product",array("idx_category_product"=>$idx))->row()->nm_categrory_product;
		}
		function list_product_use_bogof(){
			$sEcho=$_GET['sEcho'];
			$iDisplayStart=$_GET['iDisplayStart'];
			$iDisplayLenght=$_GET['iDisplayLength'];
			$sort_by=$_GET['iSortCol_0'];
			$nm_kolom=array('a.idx_product','b.thumb','b.category_product','b.nm_product','b.berat','a.idx_product');
			$sSortDir_0=$_GET['sSortDir_0'];
			$idx_promo	=$_GET['idx_promo'];
			$whr="a.idx_promo=$idx_promo";
			$sWhere = "";
				if ( isset($_GET['sSearch']) && $_GET['sSearch'] != "" )
				{
					$sWhere = "WHERE (";
					for ( $i=0 ; $i<count($nm_kolom) ; $i++ )
					{
						if ( isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" )
						{
							if(($nm_kolom[$i]<>"a.idx_product")&&($nm_kolom[$i]<>"a.category_product")){
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
					$sWhere=$sWhere." and ".$whr;
				}else{
					$sWhere="where ".$whr;
				}
				$iTotalRecordssql=$this->db->query("select a.idx_content_promo,b.* from content_prom a join product b on a.idx_product=b.idx_product $sWhere");
				$iTotalRecords=$iTotalRecordssql->num_rows();
				$sQuery ="SELECT a.idx_content_promo,a.idx_promo,a.bogof_caption,".str_replace(" , ", " ", implode(", ", $nm_kolom))." from content_prom a join product b on a.idx_product=b.idx_product $sWhere
							order by
							$nm_kolom[$sort_by] $sSortDir_0
							limit $iDisplayStart,$iDisplayLenght";
				$query=$this->db->query($sQuery);
				$data_arr=array();
				$i==0;
				foreach($query->result_array() as $Row){
					if($Row['thumb']){
						$thumb='<img src="'.base_url().'uploads/product/'.$Row['thumb'].'" style="width: 3em;height: 3em;" />';
					}else{
						$thumb='';
					}
					$nm="";
					$cat="";
					$query=$this->db->get_where("category_product",array("idx_category_product"=>$Row['category_product']))->row();
					if($query->parent!=0){
						$res	=$this->db->query("SELECT * FROM (`category_path`) WHERE `idx_category` ='$query->parent' order by level asc");
						foreach($res->result() as $wcp){
							if($nm==""){
								$nm=$this->get_nm($wcp->idx_path);
							}else{
								$nm=$nm." > ".$this->get_nm($wcp->idx_path);
							}
						}
						$cat=$nm." > ";
					}
					$cat=$cat.$this->get_nm($Row['category_product']);
					$input="<input type='text' class='form-control' value='".$Row['bogof_caption']."' name='bogof_caption_use[]'/><input type='hidden' class='form-control' value='".$Row['idx_content_promo']."' name='idx_content_promo[]'/>";
					$action="<a href='#' onClick='if(confirm(\"Anda Yakin akan menghapus data ini?\")) window.location=\"".site_url()."promo/delete/content_promo/".$Row['idx_content_promo']."/".$Row['idx_promo']."\";' rel='tooltip' title='Delete'>Delete</a>";
					$data_arr[]=array($action,$thumb,$cat,$Row['nm_product'],$Row['berat'],$input,"DT_RowId"=>"td_".$Row['idx_product']);
					$i++;
					$nm="";
				}
				$data_json=array('sEcho'=>$sEcho,'iTotalRecords'=>$iTotalRecords,'iTotalDisplayRecords'=>$iTotalRecords,'aaData'=>$data_arr);
				echo json_encode($data_json);
		}
		
		function list_product_bogof(){
			$sEcho=$_GET['sEcho'];
			$iDisplayStart=$_GET['iDisplayStart'];
			$iDisplayLenght=$_GET['iDisplayLength'];
			$sort_by=$_GET['iSortCol_0'];
			$nm_kolom=array('idx_product','idx_product','thumb','category_product','nm_product','berat','idx_product');
			$sTable = "product";
			$sSortDir_0=$_GET['sSortDir_0'];
			$idx_category	=$_GET['idx_categori'];
			$idx_brand		=$_GET['idx_brand'];
			$whr="";
			if($idx_category!=""){
					$res	=$this->db->query("SELECT * FROM (`category_path`) WHERE `idx_path` ='$idx_category' order by level asc");
					foreach($res->result() as $wcp){
						if($whr==""){
							$whr="(  category_product=$idx_category or  category_product=$wcp->idx_category";
						}else{
							$whr=$whr." or category_product=$wcp->idx_category";
						}
					}
					if($whr!=""){
						$whr=$whr.")";
					}else{
						$whr="(category_product=$idx_category)";
					}
			}
			if(($idx_category=="")&&($idx_brand=="")){$sWhere="where category_product IS NOT NULL and idx_brand IS NOT NULL";}
			if(($idx_category!="")&&($idx_brand!="")){$sWhere="where  $whr and idx_brand='$idx_brand'";}
			if(($idx_category!="")&&($idx_brand=="")){$sWhere="where $whr and idx_brand IS NOT NULL";}
			if(($idx_category=="")&&($idx_brand!="")){$sWhere="where category_product IS NOT NULL and idx_brand='$idx_brand'";}
			$iTotalRecordssql=$this->db->query("SELECT * FROM $sTable $sWhere");
			$iTotalRecords=$iTotalRecordssql->num_rows();
			$sWhere = "";
				if ( isset($_GET['sSearch']) && $_GET['sSearch'] != "" )
				{
					$sWhere = "WHERE (";
					for ( $i=0 ; $i<count($nm_kolom) ; $i++ )
					{
						if ( isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" )
						{
							if(($nm_kolom[$i]<>"idx_product")&&($nm_kolom[$i]<>"category_product")){
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
							if(($idx_category=="")&&($idx_brand=="")){$sWhere=$sWhere." and category_product IS NOT NULL and idx_brand IS NOT NULL";}
							if(($idx_category!="")&&($idx_brand!="")){$sWhere=$sWhere." $whr and idx_brand='$idx_brand'";}
							if(($idx_category!="")&&($idx_brand=="")){$sWhere=$sWhere." $whr and idx_brand IS NOT NULL";}
							if(($idx_category=="")&&($idx_brand!="")){$sWhere=$sWhere." and category_product IS NOT NULL and idx_brand='$idx_brand'";}
				}else{
					if(($idx_category=="")&&($idx_brand=="")){$sWhere="where category_product IS NOT NULL and idx_brand IS NOT NULL";}
					if(($idx_category!="")&&($idx_brand!="")){$sWhere="where $whr and idx_brand='$idx_brand'";}
					if(($idx_category!="")&&($idx_brand=="")){$sWhere="where $whr and idx_brand IS NOT NULL";}
					if(($idx_category=="")&&($idx_brand!="")){$sWhere="where category_product IS NOT NULL and idx_brand='$idx_brand'";}
				
				}
				$sQuery ="SELECT ".str_replace(" , ", " ", implode(", ", $nm_kolom))." FROM  $sTable $sWhere
							order by
							$nm_kolom[$sort_by] $sSortDir_0
							limit $iDisplayStart,$iDisplayLenght";
				$query=$this->db->query($sQuery);
				$data_arr=array();
				$i==0;
				foreach($query->result_array() as $Row){
					if($Row['thumb']){
						$thumb='<img src="'.base_url().'uploads/product/'.$Row['thumb'].'" style="width: 3em;height: 3em;" />';
					}else{
						$thumb='';
					}
					if($this->db->query("SELECT b.idx_product FROM promo_management a join content_prom b on a.idx_promo=b.idx_promo where b.idx_product='$Row[idx_product]'")->num_rows()>0){
						$status="Produk Sudah Dipromo";
						$dis="disabled";
					}else{
						$status="Kosong";
						$dis="";
					}
					$nm="";
					$cat="";
					$query=$this->db->get_where("category_product",array("idx_category_product"=>$Row['category_product']))->row();
					if($query->parent!=0){
						$res	=$this->db->query("SELECT * FROM (`category_path`) WHERE `idx_category` ='$query->parent' order by level asc");
						foreach($res->result() as $wcp){
							if($nm==""){
								$nm=$this->get_nm($wcp->idx_path);
							}else{
								$nm=$nm." > ".$this->get_nm($wcp->idx_path);
							}
						}
						$cat=$nm." > ";
					}
					$cat=$cat.$this->get_nm($Row['category_product']);
					$checkbox="<input type='checkbox' ".$dis." name='idx_product[]' value='".$Row['idx_product']."'/>";
					$input="<input type='text' ".$dis." class='form-control' name='bogof_caption[]'/>";
					$data_arr[]=array($checkbox,$status,$thumb,$cat,$Row['nm_product'],$Row['berat'],$input,"DT_RowId"=>"td_".$Row['idx_product']);
					$i++;
					$nm="";
				}
				$data_json=array('sEcho'=>$sEcho,'iTotalRecords'=>$iTotalRecords,'iTotalDisplayRecords'=>$iTotalRecords,'aaData'=>$data_arr);
				echo json_encode($data_json);
		}
		
		function list_city(){
			$q=$this->db->query("SELECT distinct kota FROM shipping_location order by kota");
			return $q;
		}
		function get_element($tb,$idx,$par,$f){
			$res	=$this->db->query("select * from $tb where $idx='$par'");
			$w		=$res->row();
			return $w->$f;
		}
		function list_product_promo($idx,$where_brand,$where_price,$sort,$sortby){
			return $this->db->query("select a.*,b.* from content_prom a join product b on a.idx_product=b.idx_product where a.idx_promo='$idx' $where_brand $where_price $sort $sortby ");
		}
		
		
}
