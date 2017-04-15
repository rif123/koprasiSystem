<?php 
date_default_timezone_set('Asia/Jakarta');
defined('BASEPATH') OR exit('No direct script access allowed');
class product_model extends CI_model{
		function __construct(){
			parent::__construct();
			$this->load->database();
			$this->load->helper(array('form', 'url'));
			$this->load->model('additional_model');
			$this->load->library('image_lib');
			$this->load->library('upload');
		}
		function delete_gallery(){
			$this->db->delete('gallery', array('idx_gallery' =>$this->uri->segment(3)));
			unlink('./uploads/product/'.$this->uri->segment(5));
			redirect('product/gallery/'.$this->uri->segment(4));
		}
		function delete($target,$idx){
			if($target=="category"){
				$Query=$this->db->query("select image from category_product where idx_category_product='$idx'")->row();
				if($Query->image){
					if(file_exists('./uploads/category/'.$Query->image)){
						unlink('./uploads/category/'.$Query->image);
					}
				}
				$this->db->delete('category_product', array('idx_category_product' =>$idx));
				$this->db->delete('category_path', array('idx_category' =>$idx));
				redirect('product/category');
			}
			if($target=="brand"){
				$this->db->delete('brand', array('idx_brand' =>$idx));
				redirect('product/brand');
			}
			if($target=="ukuran"){
				$path_ukuran	=$this->get_element("ukuran","idx_ukuran",$idx,"path_ukuran");
				if($path_ukuran){
					unlink('./uploads/ukuran/'.$path_ukuran);
				}
				$this->db->delete('ukuran', array('idx_ukuran' =>$idx));
				redirect('product/ukuran');
			}
			if($target=="product"){
				$q	=$this->db->query("select path_image,thumb from product where idx_product='$idx'")->row();
				if($q->path_image){
					unlink('./uploads/product/'.$q->path_image);
				}
				if($q->thumb){
					unlink('./uploads/product/'.$q->thumb);
				}
				$this->db->delete('product', array('idx_product' =>$idx));
				$this->db->delete('attribute_product', array('idx_product' =>$idx));
				redirect('product/product');
			}
		}
		function get_gallery($idx_product){
			$Q=$this->db->get_where('gallery',array('idx_product'=>$idx_product));
			return $Q;
		}
		function look_level($idx){
			$q=$this->db->query("select level from category_product where idx_category_product='$idx'")->row();
			return $q->level;
		}
	
		function save($target){
			if($target=="category"){
				if($this->input->post('nm_categrory_product')){
						$parent=$this->input->post('parent');
						$image='';
						if((isset($_FILES['image']['name']))&&($_FILES['image']['name']!="")){
							$up=$this->do_upload('image',time());
							if($up==0){
								echo'<div class="alert alert-danger"><button class="close" data-dismiss="alert">×</button><strong>Error!&nbsp;</strong>Terjadi Kesalahan pada file logo,Pastikan file yang anda upload sesuai kriteria!!</div>';
								die();
							}
							$data = $this->upload->data();
							$this->resize_image_2($this->upload->upload_path.$this->upload->file_name,220,210);
							$image=$this->upload->file_name;
						}
						$data = array(
						   'nm_categrory_product' =>$this->input->post('nm_categrory_product'),
						   'image' =>$image,
						   'parent' =>$this->input->post('parent'),
						   'tag_desc' =>$this->input->post('tag_desc'),
						   'tag_key' =>$this->input->post('tag_key')
						);
						$this->db->insert('category_product', $data); 
						$idx_category	=$this->db->insert_id();
							$query=$this->db->query("select * from category_path where idx_category='$parent'");
							$level = 0;
							foreach($query->result() as $wcp){
								$this->db->query("INSERT INTO category_path (idx_category,idx_path,level) VALUES('$idx_category','$wcp->idx_path','$level')");
								$level++;
							}
							$this->db->query("INSERT INTO category_path (idx_category,idx_path,level) VALUES('$idx_category','$idx_category','$level')");
							echo'<div class="alert alert-success"><strong>Success! </strong>Data berhasil disimpan.</div>';
							echo"<script>
								setTimeout(function () {
									window.location='".site_url('product/category')."';
								},1000);
							</script>";
				}else{
					echo '<div class="alert alert-error"><strong>Error! </strong>Lengkapi data yang diminta!!</div>';
					die();
				}
			}
			if($target=="brand"){
				if($this->input->post('nm_brand')){
						$data = array(
						   'nm_brand' =>$this->input->post('nm_brand')
						);
						$save=$this->db->insert('brand', $data); 
						if($save){
							echo'<div class="alert alert-success"><strong>Success! </strong>Data berhasil disimpan.</div>';
							echo"<script>
									window.location='".site_url('product/brand')."';
							</script>";
						}else{
							echo '<div class="alert alert-error"><strong>Oopss!&nbsp; </strong>Terjadi Kesalahan Sistem, Silahkan ulangi lagi!!</div>';
							die();
						}
				}else{
					echo '<div class="alert alert-error"><strong>Error! </strong>Lengkapi data yang diminta!!</div>';
					die();
				}
			}if($target=="ukuran"){
				if($this->input->post('nm_ukuran')){
						if((isset($_FILES['path_ukuran']['name']))&&($_FILES['path_ukuran']['name']!="")){
							$up=$this->upload_ukuran('path_ukuran',time());
							if($up==0){
								echo'<div class="alert alert-danger"><button class="close" data-dismiss="alert">×</button><strong>Error!&nbsp;</strong>Terjadi Kesalahan pada file logo,Pastikan file yang anda upload sesuai kriteria!!</div>';
								die();
							}
							$data 		= $this->upload->data();
							$this->resize_image_2($this->upload->upload_path.$this->upload->file_name,900,900);
							$path_ukuran	=$this->upload->file_name;
						}else{
							echo '<div class="alert alert-error"><strong>Error! </strong>Lengkapi data yang diminta!!</div>';
							die();
						}
						$data = array(
						   'nm_ukuran' =>$this->input->post('nm_ukuran'),
						   'path_ukuran' =>$path_ukuran
						);
						$save=$this->db->insert('ukuran', $data); 
						if($save){
							echo'<div class="alert alert-success"><strong>Success! </strong>Data berhasil disimpan.</div>';
							echo"<script>
									window.location='".site_url('product/ukuran')."';
							</script>";
						}else{
							echo '<div class="alert alert-error"><strong>Oopss!&nbsp; </strong>Terjadi Kesalahan Sistem, Silahkan ulangi lagi!!</div>';
							die();
						}
				}else{
					echo '<div class="alert alert-error"><strong>Error! </strong>Lengkapi data yang diminta!!</div>';
					die();
				}
			}
			if($target=="gallery"){
					$validated=0;
							if((isset($_FILES['path_image1']['name']))&&($_FILES['path_image1']['name']<>"")){
								$validated=1;
								$up=$this->upload_gallery(time().'1','path_image1');
								if($up){
									echo'<div class="alert alert-danger"><strong>Error!&nbsp;</strong>'.$up.'</div>';
									die();
								}else{
									$image	=$this->upload->file_name;
									$ins 	= array('idx_product' =>$this->uri->segment(4),'path_image' =>$image);
									$this->db->insert('gallery', $ins); 
								}
							}
							if((isset($_FILES['path_image2']['name']))&&($_FILES['path_image2']['name']<>"")){
								$validated=1;
								$up=$this->upload_gallery(time().'2','path_image2');
								if($up){
									echo'<div class="alert alert-danger"><strong>Error!&nbsp;</strong>'.$up.'</div>';
									die();
								}else{
									$image	=$this->upload->file_name;
									$ins 	= array('idx_product' =>$this->uri->segment(4),'path_image' =>$image);
									$this->db->insert('gallery', $ins); 
								}
							}
							if((isset($_FILES['path_image3']['name']))&&($_FILES['path_image3']['name']<>"")){
								$validated=1;
								$up=$this->upload_gallery(time().'3','path_image3');
								if($up){
									echo'<div class="alert alert-danger"><strong>Error!&nbsp;</strong>'.$up.'</div>';
									die();
								}else{
									$image	=$this->upload->file_name;
									$ins 	= array('idx_product' =>$this->uri->segment(4),'path_image' =>$image);
									$this->db->insert('gallery', $ins); 
								}
							}
							if((isset($_FILES['path_image4']['name']))&&($_FILES['path_image4']['name']<>"")){
								$validated=1;
								$up=$this->upload_gallery(time().'4','path_image4');
								if($up){
									echo'<div class="alert alert-danger"><strong>Error!&nbsp;</strong>'.$up.'</div>';
									die();
								}else{
									$image	=$this->upload->file_name;
									$ins 	= array('idx_product' =>$this->uri->segment(4),'path_image' =>$image);
									$this->db->insert('gallery', $ins); 
								}
							}						
							if($validated==1){
								echo'<div class="alert alert-success"><strong>Success! </strong>Data berhasil disimpan.</div>';
											echo"<script>
													window.location='".site_url('product/gallery/'.$this->uri->segment(4))."';
											</script>";
							}else{
								echo '<div class="alert alert-error"><strong>Error! </strong>Lengkapi data yang diminta!!</div>';
								die();
							}
			}
			if($target=="product"){
				$error='';
				if((!$this->input->post('nm_product'))||(!$this->input->post('category_product'))||(!$this->input->post('harga'))||(!$this->input->post('ket'))||(!$this->input->post('spesifikasi'))||(!$this->input->post('minimum_stock'))||($this->input->post('type_product')==0)){
					$error='<p>- Lengkapi Data yang diminta</p>';
				}
				if($this->input->post('type_product')==1){
					if((!$this->input->post('idx_attribute_single'))||(!$this->input->post('element_single'))||(!$this->input->post('stock_attribute_single'))){
						$error=$error.'<p>- Atribute Harus Diisi.</p>';
					}
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
				if($this->input->post('type_product')==3){
					$r=0;
					for($y=0;$y<count($this->input->post('element_seri'));$y++){
						$e=$this->input->post('element_seri');
						$s=$this->input->post('stock_seri');
						if((!is_numeric($s))||(!$e[$y])){
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
						$error=$error.'<p>- Harga tidak boleh diisi angka.</p>';
					}
				}
				if($this->input->post('stock')){
					if(!is_numeric($this->input->post('stock'))){
						$error=$error.'<p>- Stock tidak boleh diisi angka.</p>';
					}
				}
				if($this->input->post('minimum_stock')){
					if(!is_numeric($this->input->post('minimum_stock'))){
						$error=$error.'<p>- Minimum Stock tidak boleh diisi angka.</p>';
					}
				}
				if((!isset($_FILES['image']['name']))||($_FILES['image']['name']=="")){
					$error=$error.'<p>- Gambar tidak boleh kosong.</p>';
				}
				if($this->input->post('discount')){
					if(!is_numeric($this->input->post('discount'))){
						$error=$error.'<p>- Discount tidak boleh diisi angka.</p>';
					}
				}
				if($this->input->post('harga_discount')){
					if(!is_numeric($this->input->post('harga_discount'))){
						$error=$error.'<p>- Harga Dsicount tidak boleh diisi angka.</p>';
					}
				}
				if($error){
					echo '<div class="alert alert-error">'.$error.'</div>';
					die();
				}
						$image='';
						$thumb='';
						if((isset($_FILES['image']['name']))&&($_FILES['image']['name']!="")){
							$up=$this->do_upload('image',time());
							if($up==0){
								echo'<div class="alert alert-error">Terjadi Kesalahan pada file logo,Pastikan file yang anda upload sesuai kriteria!!</div>';
								die();
							}
							$data = $this->upload->data();
							$thumb = $data['raw_name'].'_thumb'.$data['file_ext'];
							$this->resize_image($this->upload->upload_path.$this->upload->file_name,300,250);
							$image=$this->upload->file_name;
						}
						$data = array(
						   'category_product' =>$this->input->post('category_product'),
						   'type_product' =>$this->input->post('type_product'),
						    'nm_product' =>$this->input->post('nm_product'),
							'ket' =>$this->input->post('ket'),
							'spesifikasi' =>$this->input->post('spesifikasi'),
							'idx_brand' =>$this->input->post('idx_brand'),
							'idx_ukuran' =>$this->input->post('idx_ukuran'),
							'harga' =>$this->input->post('harga'),
							'discount' =>$this->input->post('discount'),
							'harga_discount' =>$this->input->post('harga_discount'),
							'berat' =>$this->input->post('berat'),
							'sku' =>$this->input->post('sku'),
							'path_image' =>$image,
							'minimum_stock' =>$this->input->post('minimum_stock'),
							'thumb' =>$thumb,
							'tag' =>$this->input->post('tag'),
							'tag_key' =>$this->input->post('tag_key'),
							'tag_desc' =>$this->input->post('tag_desc')
						);
						$save=$this->db->insert('product', $data); 
						if($save){
							$idx_product		=$this->db->query("Select idx_product from product order by idx_product desc limit 1")->row();
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
												   'idx_product' =>$idx_product->idx_product,
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
							if($this->input->post('type_product')==3){
								$idx_attribute_seri	=$this->input->post('idx_attribute_seri');
								$element_seri		=$this->input->post('element_seri');
								$stock_seri			=$this->input->post('stock_seri');
								$count_attribute	=count($idx_attribute_seri);
								for($x=0;$x<$count_attribute;$x++){
									if($idx_attribute_seri[$x]){
										for($i=0;$i<count($element_seri);$i++){
											if(($element_seri[$i])&&(is_numeric($stock_seri))){
												$ins = array(
												   'idx_product' =>$idx_product->idx_product,
													'idx_atrribute' =>$idx_attribute_seri[$x],
													'desc_attribute' =>$element_seri[$i],
													'stock' =>$stock_seri
												);
												$this->db->insert('attribute_product',$ins);
											}
										}
									}
								}
							}
							if($this->input->post('type_product')==1){
												$ins = array(
												   'idx_product' =>$idx_product->idx_product,
													'idx_atrribute' =>$this->input->post('idx_attribute_single'),
													'desc_attribute' =>$this->input->post('element_single'),
													'stock' =>$this->input->post('stock_attribute_single')
												);
												$this->db->insert('attribute_product',$ins);
							}
							echo'<div class="alert alert-success">Data berhasil disimpan.</div>';
							echo"<script>
								setTimeout(function () {
									window.location='".site_url('product/product')."';
								},1000);
							</script>";
						}else{
							echo '<div class="alert alert-error"><strong>Oopss!&nbsp; </strong>Terjadi Kesalahan Sistem, Silahkan ulangi lagi!!</div>';
							die();
						}
			}
		}
		function do_upload($htmlFieldName,$file_name){
				$config['file_name'] = $file_name;
				$config['upload_path'] = './uploads/product';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size'] = '50000';
				$this->upload->initialize($config);
				unset($config);
				if(!$this->upload->do_upload($htmlFieldName)){
					return 0;
				}else{
					return 1;
				}
		}
		function upload_ukuran($htmlFieldName,$file_name){
				$config['file_name'] = $file_name;
				$config['upload_path'] = './uploads/ukuran';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size'] = '50000';
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
				$config['create_thumb'] = TRUE;
				$config['width'] = $witdh;
				$config['height'] = $height;
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
		}
		function resize_image_2($sourcePath,$witdh,$height)
		{
				$config['source_image'] =$sourcePath;
				$config['maintain_ratio'] = TRUE;
				$config['width'] = $witdh;
				$config['height'] = $height;
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
		}
		function upload_gallery($file_name,$htmlFieldName){
				$config['file_name'] = $file_name;
				$config['upload_path'] = './uploads/product';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size'] = '300000';
				$this->upload->initialize($config);
				if(!$this->upload->do_upload($htmlFieldName)){
					return $this->upload->display_errors();
				}else{
					$config2['source_image'] ='./uploads/product/'.$this->upload->file_name;
					$config2['maintain_ratio'] = TRUE;
					$config2['create_thumb'] = TRUE;
					$config2['width'] = 250;
					$config2['height'] = 250;
					$this->image_lib->initialize($config2);
					$this->image_lib->resize();
				}
				
		}
		function update($target){
			if($target=="category"){
				if($this->input->post('nm_categrory_product')){
						$parent	=$this->input->post('parent');
						$image	=$this->input->post('image_text');
						if((isset($_FILES['image']['name']))&&($_FILES['image']['name']!="")){
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
						    'tag_desc' =>$this->input->post('tag_desc'),
						    'tag_key' =>$this->input->post('tag_key')
						);
					$this->db->where('idx_category_product',$this->input->post('idx_category_product'));
					$this->db->update('category_product', $data); 
					$idx_category	=$this->input->post('idx_category_product');
					$Query			=$this->db->query("SELECT * FROM category_path WHERE idx_path='$idx_category' ORDER BY level ASC");
					if($Query->num_rows()>0){
						foreach($Query->result() as $ws){
							$this->db->query("DELETE FROM category_path WHERE idx_category ='$ws->idx_category' AND level < '$ws->level'");
							$path = array();
							$query = $this->db->query("SELECT * FROM category_path WHERE idx_category = '$parent' ORDER BY level ASC");
				
							foreach ($query->result_array() as $result) {
								$path[] = $result['idx_path'];
							}
							$query = $this->db->query("SELECT * FROM category_path WHERE idx_category = '$idx_category' ORDER BY level ASC");
							foreach ($query->result_array as $result) {
								$path[] = $result['idx_path'];
							}
							$level = 0;
							foreach ($path as $path_id) {
								$this->db->query("INSERT INTO category_path (idx_category,idx_path,level) VALUES('$ws->idx_category','$path_id','$level')");
								
								$level++;
							}
						}
					}else{
						$this->db->query("DELETE FROM category_path WHERE idx_category = '$idx_category'");
						$level = 0;
						$query=$this->db->query("select * from category_path where idx_category='$parent' ORDER BY level ASC");
							foreach($query->result() as $wcp){
								$this->db->query("INSERT INTO category_path (idx_category,idx_path,level) VALUES('$idx_category','$wcp->idx_path','$level')");
								$level++;
							}
							$this->db->query("INSERT INTO category_path (idx_category,idx_path,level) VALUES('$idx_category','$idx_category','$level')");
					}
						echo'<div class="alert alert-success"><strong>Success!</strong>Data berhasil diubah.</div>';
						echo"<script>
							setTimeout(function () {
								window.location='".site_url('product/category')."';
							},1000);
						</script>";
				}else{
					echo '<div class="alert alert-error"><strong>Error!  </strong>Lengkapi Data yang diperlukan.</div>';
					die();
				}
			}
			if($target=="brand"){
				if($this->input->post('nm_brand')){
						$data = array(
						   'nm_brand' =>$this->input->post('nm_brand')
						);
					$this->db->where('idx_brand',$this->input->post('idx_brand'));
					$update=$this->db->update('brand', $data); 
					if($update){
						
						echo'<div class="alert alert-success"><strong>Success!</strong>Data berhasil diubah.</div>';
						echo"<script>
							setTimeout(function () {
								window.location='".site_url('product/brand')."';
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
			if($target=="ukuran"){
				if($this->input->post('nm_ukuran')){
						$path_ukuran	=$this->input->post('path_ukuran_old');
						if((isset($_FILES['path_ukuran']['name']))&&($_FILES['path_ukuran']['name']!="")){
							$up=$this->upload_ukuran('path_ukuran',time());
							if($up==0){
								echo'<div class="alert alert-danger"><button class="close" data-dismiss="alert">×</button><strong>Error!&nbsp;</strong>Terjadi Kesalahan pada file logo,Pastikan file yang anda upload sesuai kriteria!!</div>';
								die();
							}
							$data 		= $this->upload->data();
							$this->resize_image_2($this->upload->upload_path.$this->upload->file_name,900,900);
							if($path_ukuran){
								unlink('./uploads/ukuran/'.$path_ukuran);
							}
							$path_ukuran	=$this->upload->file_name;
						}
						$data = array(
						   'nm_ukuran' =>$this->input->post('nm_ukuran'),
						   'path_ukuran' =>$path_ukuran
						);
						$this->db->where('idx_ukuran',$this->input->post('idx_ukuran'));
						$update=$this->db->update('ukuran', $data); 
					if($update){
						
						echo'<div class="alert alert-success"><strong>Success!</strong>Data berhasil diubah.</div>';
						echo"<script>
								window.location='".site_url('product/ukuran')."';
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
				if((!$this->input->post('nm_product'))||(!$this->input->post('category_product'))||(!$this->input->post('harga'))||(!$this->input->post('ket'))||(!$this->input->post('spesifikasi'))||(!$this->input->post('minimum_stock'))||($this->input->post('type_product')==0)){
					$error='<p>- Lengkapi Data yang diminta</p>';
				}
				if($this->input->post('type_product')==1){
					if((!$this->input->post('idx_attribute_single'))||(!$this->input->post('element_single'))||(!$this->input->post('stock_attribute_single'))){
						$error=$error.'<p>- Atribute Harus Diisi.</p>';
					}
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
				if($this->input->post('type_product')==3){
					$r=0;
					for($y=0;$y<count($this->input->post('element_seri'));$y++){
						$e=$this->input->post('element_seri');
						$s=$this->input->post('stock_seri');
						if((!is_numeric($s))||(!$e[$y])){
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
						$error=$error.'<p>- Harga tidak boleh diisi huruf.</p>';
					}
				}
				if($this->input->post('stock')){
					if(!is_numeric($this->input->post('stock'))){
						$error=$error.'<p>- Stock tidak boleh diisi huruf.</p>';
					}
				}
				if($this->input->post('minimum_stock')){
					if(!is_numeric($this->input->post('minimum_stock'))){
						$error=$error.'<p>- Minimum Stock tidak boleh diisi huruf.</p>';
					}
				}
				if($this->input->post('discount')){
					if(!is_numeric($this->input->post('discount'))){
						$error=$error.'<p>- Discount tidak boleh diisi huruf.</p>';
					}
				}
				if($this->input->post('harga_discount')){
					if(!is_numeric($this->input->post('harga_discount'))){
						$error=$error.'<p>- Harga Discount tidak boleh diisi huruf.</p>';
					}
				}
				if($error){
					echo '<div class="alert alert-error">'.$error.'</div>';
					die();
				}
						$image=$this->input->post('image_text');
						$thumb=$this->input->post('thumb_text');
						if((isset($_FILES['image']['name']))&&($_FILES['image']['name']!="")){
							$up=$this->do_upload('image',time());
							if($up==0){
								echo'<div class="alert alert-danger">Terjadi Kesalahan pada file logo,Pastikan file yang anda upload sesuai kriteria!!</div>';
								die();
							}
							$data = $this->upload->data();
							$thumb = $data['raw_name'].'_thumb'.$data['file_ext'];
							$this->resize_image($this->upload->upload_path.$this->upload->file_name,300,250);
							$image=$this->upload->file_name;
							if($this->input->post('image_text')){
								unlink('./uploads/product/'.$this->input->post('image_text'));
							}
							if($this->input->post('thumb_text')){
								unlink('./uploads/product/'.$this->input->post('thumb_text'));
							}
						}
						$data = array(
						   'category_product' =>$this->input->post('category_product'),
						   'type_product' =>$this->input->post('type_product'),
						    'nm_product' =>$this->input->post('nm_product'),
							'ket' =>$this->input->post('ket'),
							'spesifikasi' =>$this->input->post('spesifikasi'),
							'idx_brand' =>$this->input->post('idx_brand'),
							'idx_ukuran' =>$this->input->post('idx_ukuran'),
							'harga' =>$this->input->post('harga'),
							'discount' =>$this->input->post('discount'),
							'harga_discount' =>$this->input->post('harga_discount'),
							'berat' =>$this->input->post('berat'),
							'sku' =>$this->input->post('sku'),
							'path_image' =>$image,
							'minimum_stock' =>$this->input->post('minimum_stock'),
							'thumb' =>$thumb,
							'tag' =>$this->input->post('tag'),
							'tag_key' =>$this->input->post('tag_key'),
							'tag_desc' =>$this->input->post('tag_desc')
						);
						$this->db->where('idx_product',$this->input->post('idx_product'));
						$update=$this->db->update('product', $data); 
						if($update){
							if($this->input->post('type_product')==2){
								$idx_attribute		=$this->input->post('idx_attribute');
								$element			=$this->input->post('element');
								$stock_attribute	=$this->input->post('stock_attribute');
								$idx_attribute_product	=$this->input->post('idx_attribute_product');
								$count_stock		=count($stock_attribute);
								$count_attribute	=count($idx_attribute);
								for($x=0;$x<$count_attribute;$x++){
									if($idx_attribute[$x]){
										if($this->input->post('type_product_old')<>$this->input->post('type_product')){
											$this->db->delete('attribute_product', array('idx_product' =>$this->input->post('idx_product')));
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
										}else{
											for($i=0;$i<$count_stock;$i++){
												if(($element[$i])&&(is_numeric($stock_attribute[$i]))){
													if($this->db->get_where('attribute_product',array('idx_attribute_product'=>$idx_attribute_product[$i]))->num_rows()>0){
														$upd = array('idx_product' =>$this->input->post('idx_product'),
																	'idx_atrribute' =>$idx_attribute[$x],
																	'desc_attribute' =>$element[$i],
																	'stock' =>$stock_attribute[$i]
																);
														$this->db->where('idx_attribute_product',$idx_attribute_product[$i]);
														$this->db->update('attribute_product', $upd);
													}else{
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
								}
							}
							if($this->input->post('type_product')==3){
								$this->db->delete('attribute_product', array('idx_product' =>$this->input->post('idx_product')));
								$idx_attribute_seri	=$this->input->post('idx_attribute_seri');
								$element_seri		=$this->input->post('element_seri');
								$stock_seri			=$this->input->post('stock_seri');
								$count_attribute	=count($idx_attribute_seri);
								for($x=0;$x<$count_attribute;$x++){
									if($idx_attribute_seri[$x]){
										for($i=0;$i<count($element_seri);$i++){
											if(($element_seri[$i])&&(is_numeric($stock_seri))){
												$ins = array(
												   'idx_product' =>$this->input->post('idx_product'),
													'idx_atrribute' =>$idx_attribute_seri[$x],
													'desc_attribute' =>$element_seri[$i],
													'stock' =>$stock_seri
												);
												$this->db->insert('attribute_product',$ins);
											}
										}
									}
								}
							}
							if($this->input->post('type_product')==1){
								if($this->input->post('type_product_old')<>$this->input->post('type_product')){
									$this->db->delete('attribute_product', array('idx_product' =>$this->input->post('idx_product')));
									$ins = array('idx_product' =>$this->input->post('idx_product'),
													'idx_atrribute' =>$this->input->post('idx_attribute_single'),
													'desc_attribute' =>$this->input->post('element_single'),
													'stock' =>$this->input->post('stock_attribute_single')
												);
									$this->db->insert('attribute_product',$ins);
								}else{
									$upd = array('idx_product' =>$this->input->post('idx_product'),
													'idx_atrribute' =>$this->input->post('idx_attribute_single'),
													'desc_attribute' =>$this->input->post('element_single'),
													'stock' =>$this->input->post('stock_attribute_single')
												);
									$this->db->where('idx_product',$this->input->post('idx_product'));
									$this->db->update('attribute_product', $upd);
								}
							}
							echo'<div class="alert alert-success">Data berhasil diubah.</div>';
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
		
		function list_category(){
			$sEcho=$_GET['sEcho'];
			$iDisplayStart=$_GET['iDisplayStart'];
			$iDisplayLenght=$_GET['iDisplayLength'];
			$sort_by=$_GET['iSortCol_0'];
			$nm_kolom=array('idx_category_product','nm_categrory_product','parent');
			$sTable = "category_product";
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
					$val_del=$this->db->get_where("product",array("category_product"=>$Row['idx_category_product']))->num_rows();
					$action="
						<a href='".site_url('product/edit/category/'.$Row['idx_category_product'])."' rel='tooltip' title='Edit'>Edit</a> &nbsp;|&nbsp;";						
						if($val_del==0){						
							$action=$action."
							<a href='#' onClick='if(confirm(\"Anda Yakin akan menghapus data ini?\")) window.location=\"".site_url()."/product/delete/category/".$Row['idx_category_product']."\";' rel='tooltip' title='Delete'>Delete</a>
							";						
						}
					if($Row['parent']==0){
						$parent='-';
					}else{
						$res	=$this->db->query("SELECT * FROM (`category_path`) WHERE `idx_category` ='$Row[parent]' order by level asc");
						$nm="";
						foreach($res->result() as $wcp){
							if($nm==""){;
								$nm=$this->get_nm($wcp->idx_path);
							}else{;
								$nm=$nm." > ".$this->get_nm($wcp->idx_path);
							}
						}
						$parent=$nm;
					}
					$data_arr[]=array($action,$Row['nm_categrory_product'],$parent,"DT_RowId"=>"td_".$Row['idx_category_product']);
					$i++;
					$nm="";
				}
				$data_json=array('sEcho'=>$sEcho,'iTotalRecords'=>$iTotalRecords,'iTotalDisplayRecords'=>$iTotalRecords,'aaData'=>$data_arr);
				echo json_encode($data_json);
		}
		function get_nm($idx){
            if (!empty($list)){
                $list = $this->db->get_where("category_product",array("idx_category_product"=>$idx))->row()->nm_categrory_product;
            }else{
                $list = "";
            }
            return $list;
		}
		function list_ukuran(){
			$sEcho=$_GET['sEcho'];
			$iDisplayStart=$_GET['iDisplayStart'];
			$iDisplayLenght=$_GET['iDisplayLength'];
			$sort_by=$_GET['iSortCol_0'];
			$nm_kolom=array('idx_ukuran','nm_ukuran','path_ukuran');
			$sTable = "ukuran";
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
					$val_del=$this->db->get_where("ukuran",array("idx_ukuran"=>$Row['idx_ukuran']))->num_rows();
					if($Row['path_ukuran']){
						$path_ukuran='<img src="'.base_url().'uploads/ukuran/'.$Row['path_ukuran'].'" style="width: 3em;height: 3em;" />';
					}else{
						$path_ukuran='';
					}
					$action="
						<a href='".site_url('product/edit/ukuran/'.$Row['idx_ukuran'])."' rel='tooltip' title='Edit'>Edit</a> &nbsp;|&nbsp;
						";
						if($val_del==0){						
							$action=$action."
							<a href='#' onClick='if(confirm(\"Anda Yakin akan menghapus data ini?\")) window.location=\"".site_url()."/product/delete/ukuran/".$Row['idx_ukuran']."\";' rel='tooltip' title='Delete'>Delete</a>
							";
						}
					$data_arr[]=array($action,$Row['nm_ukuran'],$path_ukuran,"DT_RowId"=>"td_".$Row['idx_ukuran']);
					$i++;
				}
				$data_json=array('sEcho'=>$sEcho,'iTotalRecords'=>$iTotalRecords,'iTotalDisplayRecords'=>$iTotalRecords,'aaData'=>$data_arr);
				echo json_encode($data_json);
		}
		function list_brand(){
			$sEcho=$_GET['sEcho'];
			$iDisplayStart=$_GET['iDisplayStart'];
			$iDisplayLenght=$_GET['iDisplayLength'];
			$sort_by=$_GET['iSortCol_0'];
			$nm_kolom=array('idx_brand','nm_brand');
			$sTable = "brand";
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
				foreach($query->result_array() as $Row){										$val_del=$this->db->get_where("product",array("idx_brand"=>$Row['idx_brand']))->num_rows();
					$action="
						<a href='".site_url('product/edit/brand/'.$Row['idx_brand'])."' rel='tooltip' title='Edit'>Edit</a> &nbsp;|&nbsp;						";						if($val_del==0){						$action=$action."
						<a href='#' onClick='if(confirm(\"Anda Yakin akan menghapus data ini?\")) window.location=\"".site_url()."/product/delete/brand/".$Row['idx_brand']."\";' rel='tooltip' title='Delete'>Delete</a>
						";						}
					$data_arr[]=array($action,$Row['nm_brand'],"DT_RowId"=>"td_".$Row['idx_brand']);
					$i++;
				}
				$data_json=array('sEcho'=>$sEcho,'iTotalRecords'=>$iTotalRecords,'iTotalDisplayRecords'=>$iTotalRecords,'aaData'=>$data_arr);
				echo json_encode($data_json);
		}
		function list_gallery(){
			$idx_product=$this->uri->segment(3);
			$sEcho=$_GET['sEcho'];
			$iDisplayStart=$_GET['iDisplayStart'];
			$iDisplayLenght=$_GET['iDisplayLength'];
			$sort_by=$_GET['iSortCol_0'];
			$nm_kolom=array('idx_gallery','path_image');
			$sTable = "gallery";
			$sSortDir_0=$_GET['sSortDir_0'];
			$iTotalRecordssql=$this->db->query("SELECT * FROM $sTable where idx_product='$idx_product'");
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
				if($sWhere){
					$sWhere=$sWhere."and idx_product='$idx_product'";
				}else{
					$sWhere="where idx_product='$idx_product'";
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
						<a href='".site_url('product/edit/gallery/'.$Row['idx_gallery'])."' rel='tooltip' title='Edit'>Edit</a> &nbsp;|&nbsp;
						<a href='#' onClick='if(confirm(\"Anda Yakin akan menghapus data ini?\")) window.location=\"".site_url()."/product/delete/gallery/".$Row['idx_gallery']."\";' rel='tooltip' title='Delete'>Delete</a>
						";
					$data_arr[]=array($action,$Row['path_image'],"DT_RowId"=>"td_".$Row['idx_gallery']);
					$i++;
				}
				$data_json=array('sEcho'=>$sEcho,'iTotalRecords'=>$iTotalRecords,'iTotalDisplayRecords'=>$iTotalRecords,'aaData'=>$data_arr);
				echo json_encode($data_json);
		}
		function list_product(){
			$sEcho=$_GET['sEcho'];
			$iDisplayStart=$_GET['iDisplayStart'];
			$iDisplayLenght=$_GET['iDisplayLength'];
			$sort_by=$_GET['iSortCol_0'];
			$nm_kolom=array('idx_product','thumb','category_product','nm_product','minimum_stock','harga','discount','harga_discount');
			$sTable = "product";
			$sSortDir_0=$_GET['sSortDir_0'];
			$sWhere = "";
				if ( isset($_GET['sSearch']) && $_GET['sSearch'] != "" )
				{
					$sWhere = "WHERE (";
					for ( $i=0 ; $i<count($nm_kolom) ; $i++ )
					{
						if ( isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" )
						{
							if($nm_kolom[$i]!="*"){
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
					if($Row['thumb']){
						$thumb='<img src="'.base_url().'uploads/product/'.$Row['thumb'].'" style="width: 4em;height: 4em;" />';
					}else{
						$thumb='';
					}
					$attr		=$this->attr_product($Row['idx_product']);
					$attr_label	='';
					foreach($attr->result() as $attr_el){
						if($attr_el->stock-$attr_el->stock_akhir>$Row['minimum_stock']){
							$color="Green";
						}else{
							$color="Red";
						}
						$s=$attr_el->stock - $attr_el->stock_akhir;
						$attr_label=$attr_label."<p style='color:".$color.";font-weight: bold;'>".$attr_el->desc_attribute." | ".$s."</p>";
					}
					$nm="";
					$cat="";
					$query=$this->db->get_where("category_product",array("idx_category_product"=>$Row['category_product']))->row();
                    if($query->parent!=0){
						$res	=$this->db->query("SELECT * FROM (`category_path`) WHERE `idx_category` ='$query->parent' order by level asc")->result();
                        if (!empty($res))
                        {
                            foreach($res as $wcp){
                                if($nm==""){
                                    $nm=$this->get_nm($wcp->idx_path);
                                }else{
                                    $nm=$nm." > ".$this->get_nm($wcp->idx_path);
                                }
                            }
                            $cat=$nm." > ";
                        }
					}
					$cat=$cat.$this->get_nm($Row['category_product']);
					$rl_order		=$this->db->get_where("rl_order",array("idx_product"=>$Row['idx_product']))->num_rows();
					$wishlist		=$this->db->get_where("wishlist",array("idx_product"=>$Row['idx_product']))->num_rows();
					$rated_product	=$this->db->get_where("rated_product",array("idx_product"=>$Row['idx_product']))->num_rows();
					$content_prom	=$this->db->get_where("content_prom",array("idx_product"=>$Row['idx_product']))->num_rows();					
					$action="
						<span class='tbico'><a href='".site_url('product/edit/product/'.$Row['idx_product'])."' rel='tooltip' title='Edit'><img src='".base_url()."assets/images/edit.png'></a></span>";
						// print_R ("rl_order = ".$rl_order);
                        // echo "<pre>";
						// print_R ("wishlist = ".$wishlist);
                        // echo "<pre>";
						// print_R ("rated_product = ".$rated_product);
                        // echo "<pre>";
						// print_R ("content_prom = ".$content_prom);
                        // die;
                        
                      //   if(($rl_order==0)&&($wishlist==0)&&($rated_product==0)&&($content_prom==0)){						
                            $action=$action."
                            <span class='tbico'><a href='#' onClick='if(confirm(\"Anda Yakin akan menghapus data ini?\")) window.location=\"".site_url()."/product/delete/product/".$Row['idx_product']."\";' rel='tooltip' title='Delete'>
                                <img src='".base_url()."assets/images/delete_icon.png'></a>
                            </span>
                            ";						
                        // }
					$data_arr[]=array($action,$thumb,$cat,$Row['nm_product'],$attr_label,"Rp. ".number_format($Row['harga'],0,',','.'),$Row['discount'],"Rp. ".number_format($Row['harga_discount'],0,',','.'),"DT_RowId"=>"td_".$Row['idx_product']);
					$i++;
				}
				$data_json=array('sEcho'=>$sEcho,'iTotalRecords'=>$iTotalRecords,'iTotalDisplayRecords'=>$iTotalRecords,'aaData'=>$data_arr);
				echo json_encode($data_json);
		}
		function list_best_product(){
			$sEcho=$_GET['sEcho'];
			$iDisplayStart=$_GET['iDisplayStart'];
			$iDisplayLenght=$_GET['iDisplayLength'];
			$sort_by=$_GET['iSortCol_0'];
			$nm_kolom=array('thumb','category_product','nm_product','minimum_stock','harga','discount','harga_discount','buy');
			$sTable = "product";
			$sSortDir_0=$_GET['sSortDir_0'];
			$sWhere = "";
				if ( isset($_GET['sSearch']) && $_GET['sSearch'] != "" )
				{
					$sWhere = "WHERE (";
					for ( $i=0 ; $i<count($nm_kolom) ; $i++ )
					{
						if ( isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" )
						{
							if($nm_kolom[$i]!="*"){
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
				}				if($sWhere){					$sWhere=$sWhere." and buy<>0";				}else{					$sWhere="where buy<>0";				}
				
				$iTotalRecordssql=$this->db->query("SELECT * FROM $sTable $sWhere");
				$iTotalRecords=$iTotalRecordssql->num_rows();
				$sQuery ="SELECT idx_product,".str_replace(" , ", " ", implode(", ", $nm_kolom))." FROM  $sTable $sWhere
							order by
							$nm_kolom[$sort_by] $sSortDir_0
							limit $iDisplayStart,$iDisplayLenght";
				$query=$this->db->query($sQuery);
				$data_arr=array();
				$i==0;
				foreach($query->result_array() as $Row){
					if($Row['thumb']){
						$thumb='<img src="'.base_url().'uploads/product/'.$Row['thumb'].'" style="width: 4em;height: 4em;" />';
					}else{
						$thumb='';
					}
					$attr		=$this->attr_product($Row['idx_product']);
					$attr_label	='';
					foreach($attr->result() as $attr_el){
						if($attr_el->stock-$attr_el->stock_akhir>$Row['minimum_stock']){
							$color="Green";
						}else{
							$color="Red";
						}
						$s=$attr_el->stock - $attr_el->stock_akhir;
						$attr_label=$attr_label."<p style='color:".$color.";font-weight: bold;'>".$attr_el->desc_attribute." | ".$s."</p>";
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
					$data_arr[]=array($thumb,$cat,$Row['nm_product'],$attr_label,"Rp. ".number_format($Row['harga'],0,',','.'),$Row['discount'],"Rp. ".number_format($Row['harga_discount'],0,',','.'),$Row['buy'],"DT_RowId"=>"td_".$Row['idx_product']);
					$i++;
					$nm="";
				}
				$data_json=array('sEcho'=>$sEcho,'iTotalRecords'=>$iTotalRecords,'iTotalDisplayRecords'=>$iTotalRecords,'aaData'=>$data_arr);
				echo json_encode($data_json);
		}
		function list_product_minimum(){
			$sEcho=$_GET['sEcho'];
			$iDisplayStart=$_GET['iDisplayStart'];
			$iDisplayLenght=$_GET['iDisplayLength'];
			$sort_by=$_GET['iSortCol_0'];
			$nm_kolom=array('a.idx_product','a.thumb','a.category_product','a.nm_product','a.minimum_stock');
			$sSortDir_0=$_GET['sSortDir_0'];
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
				if($sWhere){
					$sWhere=$sWhere." and b.stock-b.stock_akhir<=a.minimum_stock";
				}else{
					$sWhere="where b.stock-b.stock_akhir<=a.minimum_stock";
				}
				$iTotalRecordssql=$this->db->query("SELECT distinct a.idx_product FROM `product` a join attribute_product b on a.idx_product=b.idx_product where b.stock-b.stock_akhir<=a.minimum_stock");
				$iTotalRecords=$iTotalRecordssql->num_rows();
				$sQuery ="SELECT distinct ".str_replace(" , ", " ", implode(", ", $nm_kolom))." FROM product a join attribute_product b on a.idx_product=b.idx_product $sWhere
							order by
							$nm_kolom[$sort_by] $sSortDir_0
							limit $iDisplayStart,$iDisplayLenght";
				$query=$this->db->query($sQuery);
				$data_arr=array();
				$i==0;
				foreach($query->result_array() as $Row){
					if($Row['thumb']){
						$thumb='<img src="'.base_url().'uploads/product/'.$Row['thumb'].'" style="width: 4em;height: 4em;" />';
					}else{
						$thumb='';
					}
					$attr		=$this->attr_product($Row['idx_product']);
					$attr_label	='';
					foreach($attr->result() as $attr_el){
						$s=$attr_el->stock - $attr_el->stock_akhir;
						$attr_label=$attr_label."<p style='color:red;font-weight:bold;'>".$attr_el->desc_attribute." : ".$s."</p>";
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
					$action="
						<span class='tbico'>
                                    <a href='".site_url('product/edit/product/'.$Row['idx_product'])."' rel='tooltip' title='Edit'>
                                    <img src='".base_url()."assets/images/edit.png'></a></span>
                                    <span class='tbico'>
                                    <a href='#' onClick='if(confirm(\"Anda Yakin akan menghapus data ini?\")) window.location=\"".site_url()."/product/delete/product/".$Row['idx_product']."\";' rel='tooltip' title='Delete'>
                                        <img src='".base_url()."assets/images/delete_icon.png'></a>
                                     </span>
						";
					$data_arr[]=array($action,$thumb,$cat,$Row['nm_product'],$attr_label,"DT_RowId"=>"td_".$Row['idx_product']);
					$i++;
					$nm="";
				}
				$data_json=array('sEcho'=>$sEcho,'iTotalRecords'=>$iTotalRecords,'iTotalDisplayRecords'=>$iTotalRecords,'aaData'=>$data_arr);
				echo json_encode($data_json);
		}
		
		function stock_minimun(){
			$q=$this->db->query("SELECT minimum_stock FROM setting_toko")->row();
			return $q->minimum_stock;
		}
		function get_element($tb,$idx,$par,$f){
			$res	=$this->db->query("select * from $tb where $idx='$par'");
			$w		=$res->row();
			return $w->$f;
		}
		function get_product($idx){
			$Q=$this->db->query("SELECT * FROM product where idx_product='$idx'")->row();
			return $Q;
		}
		function attr_product($idx){
			$Q=$this->db->query("SELECT a.*,b.* from attribute_product a join attribute b on a.idx_atrribute=b.idx_attribute where a.idx_product='$idx'");
			return $Q;
		}
		function idx_atrribute($idx){
			$Q=$this->db->query("SELECT idx_atrribute from attribute_product  where idx_product='$idx' limit 1")->row();
			return $Q->idx_atrribute;
		}
		
}
