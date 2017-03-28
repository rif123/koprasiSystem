<?php 
date_default_timezone_set('Asia/Jakarta');
defined('BASEPATH') OR exit('No direct script access allowed');
class additional_model extends CI_model{
		function __construct(){
			parent::__construct();
			$this->load->database();
		}
		function Check_notif($tb,$par,$val){
			$query = $this->db->query("SELECT * FROM $tb where $par='$val'");
			return $query->num_rows();
		}
		function get_where_row($table,$par,$par_val){
			$Q = $this->db->get_where($table, array($par =>$par_val));
			if($Q->num_rows()!=0){
				return $Q->row();
			}else{
				return false;
			}
		}
		function get_row($table){
			$Q = $this->db->get($table);
			if($Q->num_rows()!=0){
				return $Q->row();
			}else{
				return false;
			}
		}
		function get_name($tabel,$field,$par,$val){
			$Q		= $this->db->query("Select ".$field." from ".$tabel." where $par='$val'");
			$Res	= $Q->row();
			return $Res->$field;
		}
		function aunt_login(){
			if(($this->input->post('email'))&&($this->input->post('password'))){
				if (!filter_var($this->input->post('email'), FILTER_VALIDATE_EMAIL)) {
					echo'<div class="error mar_b1"><p style="padding:0;">Email tidak benar.</p></div>';
					die();
				}
				$email		=$this->input->post('email');
				$password	=md5($this->input->post('password'));
				$Q=	$this->db->query("SELECT * from pelanggan where email='$email' and password='$password'");
				$total=$Q->num_rows();
				if($total>0){
					$r=$Q->row();
					$newdata = array(
						'full_name'  =>$r->full_name,
						'email'     =>$r->email,
						'idx_pelanggan'     =>$r->idx_pelanggan,
						'logged_in' => TRUE
					);
					$this->session->set_userdata($newdata);
					echo'<div class="mar_b1" style="padding: 10px 10px;font-size: 13px;color: #fff;background-color: #BBD692;border: 1px solid #FFFFFF;"><p style="padding:0;">Login Berhasil..</p></div>';
					echo"<script>
							setTimeout(function () {
								window.location='".site_url('page')."';
							},1000);
						</script>";
				}else{
					echo'<div class="error mar_b1"><p style="padding:0;">Email atau Password salah.</p></div>';
				}
			}else{
				echo'<div class="error mar_b1"><p style="padding:0;">Lengkapi Data</p></div>';
			}
		}
		function do_upload($menuFieldName,$path){
				$config['file_name'] = time();
				$config['upload_path'] = './uploads/confirm_payment';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size'] = '500';
				$config['max_width'] = '1000';
				$config['max_height'] = '1000';
				$this->load->library('upload', $config);
				unset($config);
				if(!$this->upload->do_upload($menuFieldName)){
					return 0;
				}else{
					return 1;
				}
		}
		function get_testimoni($idx){
			$Q=$this->db->query("select a.*,b.id_pelanggan,b.full_name,b.email 	from testimoni a 
								join pelanggan b on a.idx_pelanggan=b.idx_pelanggan
								where a.idx_testimoni='$idx'");
			return $Q->row();
		}
		function get_confirm($idx){
			$Q=$this->db->query("SELECT a.*,b.* from payment_confirm a join account_bank b on a.idx_rek=b.idx_account_bank where a.idx_pay_confirm='$idx'");
			return $Q->row();
		}
		function get_home_testimoni(){
			$Q=$this->db->query("select a.*,b.id_pelanggan,b.full_name,b.email 	from testimoni a 
								join pelanggan b on a.idx_pelanggan=b.idx_pelanggan
								 where a.cd_status=1");
			return $Q;
		}		
		/*-------Admin--------*/
		function login_auth(){
			$error="";
			if(($this->input->post('user_name')=="")||($this->input->post('password')=="")){
				$error="<p>Lengkapi Username dan Password</p>";
			}
			if($error){
				echo '<div class="alert alert-error"><strong>Error!</strong>'.$error.'</div>';
				die();
			}else{
				$username	=$this->input->post('user_name');
				$password	=md5($this->input->post('password'));
				$Q = $this->db->query("select * from sys_users where user_name='$username' and password='$password'");
				if($Q->num_rows()>0){
					$r=$Q->row();
					$newdata = array(
						'idx_user'  =>$r->idx_user,
						'user_name'     =>$r->user_name,
						'set_login' => TRUE
					);
					$this->session->set_userdata($newdata);
					echo'<div class="alert alert-success"><strong>Success!</strong>Login Berhasil.</div>';
					echo"<script>
							setTimeout(function () {
								window.location='".site_url('admin')."';
							},2000);
						</script>";
				}else{
					$error="<p>Username atau Password tidak cocok.</p>";
					echo '<div class="alert alert-error"><strong>Error!</strong>'.$error.'</div>';
					die();
				}
			}
		}
		
		function get_page($idx){
			$Q=$this->db->query("Select * from page where idx_page='$idx'");
			return $Q;
		}
		function get_category($idx){
			$Q=$this->db->query("Select * from category_product where parent='$idx'");
			return $Q;
		}
		function get_product_category($idx){
			$Q=$this->db->query("Select * from product where idx_category_product='$idx'");
			return $Q;
		}
		function look_element_category($field,$idx){
			$q=$this->db->query("select ".$field." from category_product where idx_category_product='$idx'")->row();
			return $q->$field;
		}
		function list_product($whr,$where_brand,$where_price,$sort,$sortby){
			$q=$this->db->query("select * from product where $whr $where_brand $where_price $sort $sortby");
			return $q;
		}
		function product_datail($idx){
			$Q = $this->db->get_where("product", array("idx_product" =>$idx));
			return $Q->row();
		}
		function get_attribute_group($idx){
			$Q = $this->db->query("select a.*,b.nm_attribute,c.minimum_stock from attribute_product a join attribute b on a.idx_atrribute=b.idx_attribute join product c on a.idx_product=c.idx_product where a.idx_product='$idx'");
			return $Q;
		}
		function get_sql_price($idx){
			$Q=$this->db->query("select par from search_price where idx_price='$idx'")->row();
			return $Q->par;
		}
		function get_attribute_single($idx){
			$q						=$this->db->get_where("product", array("idx_product" =>$idx))->row();
			$stock					=$q->stock -  $q->stock_akhir;
			$html='<div class="size_info">';
			$html=$html.'<div class="stock">';
			$html=$html.'<label>Stok :</label>';
			$html=$html.'<label id="stok">'.$stock.'</label>';
			$html=$html.'</div>';
			$stock	=$stock+1;
            $html=$html.'<div class="quantity">';
			$html=$html.'<label style="width: 47px;">Beli :</label>';
			$html=$html.'<select id="jumlah_beli">';
			for($i=1;$i<$stock;$i++){
				$html=$html.'<option value="'.$i.'">'.$i.'</option>';
			}
			$html=$html.'</select>';
			$html=$html.'</div>';
			$html=$html.'</div>';
			return $html;
		}
		function order($idx_order){
			$sql=$this->db->query("select a.id_pesanan,a.total_tagihan,b.full_name,b.email from `order` a join pelanggan b on a.idx_pelanggan=b.idx_pelanggan where a.idx_order='$idx_order'");
			return $sql->row();
		}
		function status(){
			return $this->db->get('system')->row()->cd_status;
		}
}
