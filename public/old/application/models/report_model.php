<?php 
date_default_timezone_set('Asia/Jakarta');
defined('BASEPATH') OR exit('No direct script access allowed');
class report_model extends CI_model{
		function __construct(){
			parent::__construct();
			$this->load->database();
			$this->load->helper(array('form', 'url'));
			$this->load->library('Spreadsheet_Excel_Reader');
			$this->load->model('additional_model');
		}
		function status(){
			return $this->additional_model->status();
		}
		function generate_order(){
			if($this->input->post('parameter')=="all"){
				$data['nm_file']="Laporan semua data penjualan";
				$data['SQl']	=$this->db->query("SELECT a.id_pesanan,a.tgl_order,c.qty,c.discount,b.nm_product,b.category_product,b.harga FROM `order` a join rl_order c on a.idx_order=c.idx_order join product b on c.idx_product=b.idx_product where a.cd_status in(2,3,4,5) order by a.tgl_order desc");
			}else{
				if(($this->input->post('tgl_awal'))&&($this->input->post('tgl_akhir'))){
					$tgl_awal		=$this->input->post('tgl_awal');
					$tgl_akhir		=$this->input->post('tgl_akhir');
					$data['nm_file']="Laporan data penjualan ".$tgl_awal."-".$tgl_akhir;
					$data['SQl']	=$this->db->query("SELECT a.id_pesanan,a.tgl_order,c.qty,c.discount,b.nm_product,b.category_product,b.harga FROM `order` a join rl_order c on a.idx_order=c.idx_order join product b on c.idx_product=b.idx_product where a.cd_status in(2,3,4,5) and a.tgl_order between '$tgl_awal' and '$tgl_akhir' order by a.tgl_order desc");
				}else{
					echo '<div class="alert alert-error"><strong>Error!</strong>Lengkapi Tanggal awal dan akhir!!</div>';
					die();
				}
			}
			$data['report']=$this;
			$this->load->view('admin/report/report_order',$data);
		}
		function attr_product($idx){
			$Q=$this->db->query("SELECT a.*,b.* from attribute_product a join attribute b on a.idx_atrribute=b.idx_attribute where a.idx_product='$idx'");
			return $Q;
		}
		function generate_product(){
		
			if($this->input->post('parameter')=="all"){
				$data['nm_file']="Laporan semua data produk";
				$data['SQl']	=$this->db->query("SELECT idx_product,idx_brand,nm_product,category_product,harga,discount,minimum_stock FROM product order by idx_product desc");
			}else{
				if($this->input->post('brand')){
					$brand	=$this->input->post('brand');
					$data['nm_file']="Laporan data produk by brand";
					$data['SQl']	=$this->db->query("SELECT idx_product,idx_brand,nm_product,category_product,harga,discount,minimum_stock FROM product where idx_brand='$brand' order by idx_product desc");
				}else{
					echo '<div class="alert alert-error"><strong>Error!</strong>Lengkapi Tanggal awal dan akhir!!</div>';
					die();
				}
			}
			$data['report']=$this;
			$this->load->view('admin/report/report_product',$data);
		}
		function generate_best_product(){
			$data['SQl']	=$this->db->query("SELECT * FROM product where buy<>0 order by buy desc");
			$data['report']=$this;
			$this->load->view('admin/report/report_best_product',$data);
		}
		function count_transaksi($idx){
			return $this->db->get_where("order",array("idx_pelanggan"=>$idx))->num_rows();
		}
		function generate_customer(){
			$data['SQl']	=$this->db->query("Select * from `pelanggan` order by idx_pelanggan");
			$data['report']=$this;
			$this->load->view('admin/report/report_pelanggan',$data);
		}
		function get_element($tb,$idx,$par,$f){
			$res	=$this->db->query("select * from $tb where $idx='$par'");
			$w		=$res->row();
			return $w->$f;
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
		function get_where_row($table,$par,$par_val){
			$Q = $this->db->get_where($table, array($par =>$par_val));
			if($Q->num_rows()!=0){
				return $Q->row();
			}else{
				return false;
			}
		}
		function list_order(){
			$sEcho=$_GET['sEcho'];
			$iDisplayStart=$_GET['iDisplayStart'];
			$iDisplayLenght=$_GET['iDisplayLength'];
			$sort_by=$_GET['iSortCol_0'];
			$nm_kolom=array('a.id_pesanan','a.tgl_order','b.nm_product','b.category_product','b.harga','c.discount','b.harga','c.qty','b.harga');
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
					$sWhere=$sWhere." and a.cd_status in(2,3,4,5)";
				}else{
					$sWhere="where a.cd_status in(2,3,4,5)";
				}
				if((isset($_GET['tgl_awal']))&&(isset($_GET['tgl_akhir']))){
					if($sWhere){
						$sWhere=$sWhere." and a.tgl_order between '$_GET[tgl_awal]' and '$_GET[tgl_akhir]'";
					}else{
						$sWhere="where a.tgl_order between '$_GET[tgl_awal]' and '$_GET[tgl_akhir]'";
					}
				}
				$iTotalRecordssql=$this->db->query("SELECT a.id_pesanan,a.tgl_order,c.qty,c.discount,b.nm_product,b.category_product,b.harga FROM `order` a join rl_order c on a.idx_order=c.idx_order join product b on c.idx_product=b.idx_product $sWhere");
				$iTotalRecords=$iTotalRecordssql->num_rows();
				$sQuery ="SELECT ".str_replace(" , ", " ", implode(", ", $nm_kolom))." FROM `order` a join rl_order c on a.idx_order=c.idx_order join product b on c.idx_product=b.idx_product $sWhere
							order by
							$nm_kolom[$sort_by] $sSortDir_0
							limit $iDisplayStart,$iDisplayLenght";
				$query=$this->db->query($sQuery);
				$data_arr=array();
				$i==0;
				foreach($query->result_array() as $Row){
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
					$harga_jual		=$Row['harga']-($Row['discount']/100*$Row['harga']);
					$total_harga	=$harga_jual*$Row['qty'];
					$data_arr[]		=array($Row['id_pesanan'],$this->DateToIndo($Row['tgl_order']),$Row['nm_product'],$cat,"Rp. ".number_format($Row['harga'],0,',','.'),$Row['discount'],"Rp. ".number_format($harga_jual,0,',','.'),$Row['qty'],"Rp. ".number_format($total_harga,0,',','.'),"DT_RowId"=>"td_".$Row['id_pesanan']);
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
			$nm_kolom=array('nm_product','category_product','harga','discount','harga','buy','harga');
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
				if($sWhere){					$sWhere=$sWhere." and buy<>0";				}else{					$sWhere="where buy<>0";				}
				$iTotalRecordssql=$this->db->query("SELECT nm_product,category_product,harga,discount,buy FROM product $sWhere");
				$iTotalRecords=$iTotalRecordssql->num_rows();
				$sQuery ="SELECT idx_product,".str_replace(" , ", " ", implode(", ", $nm_kolom))." FROM product $sWhere
							order by
							$nm_kolom[$sort_by] $sSortDir_0
							limit $iDisplayStart,$iDisplayLenght";
				$query=$this->db->query($sQuery);
				$data_arr=array();
				$i==0;
				foreach($query->result_array() as $Row){
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
					$discount		=$Row['discount'];
					$get_discount	=$this->db->query("SELECT a.discount from content_prom a join promo_management b on a.idx_promo=b.idx_promo where b.idx_type_promo=1 and a.idx_product='$Row[idx_product]'");
					if($get_discount->num_rows()>0){
						$discount	=$get_discount->row()->discount;
					}
					$harga_jual		=$Row['harga']-($discount/100*$Row['harga']);
					$total_harga	=$harga_jual*$Row['buy'];
					$data_arr[]		=array($Row['nm_product'],$cat,"Rp. ".number_format($Row['harga'],0,',','.'),$Row['discount'],"Rp. ".number_format($harga_jual,0,',','.'),$Row['buy'],"Rp. ".number_format($total_harga,0,',','.'),"DT_RowId"=>"td_".$Row['idx_product']);
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
			$nm_kolom=array('idx_pelanggan','full_name','jenis_kelamin','tgl_lahir','email','alamat','kota','provinsi','no_telepon','hp','jmlh_transaksi');
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
					$data_arr[]=array($Row['full_name'],$Row['jenis_kelamin'],$this->DateToIndo($Row['tgl_lahir']),$Row['email'],$Row['alamat'],$Row['kota'],$Row['provinsi'],$Row['no_telepon'],$Row['hp'],$Row['jmlh_transaksi'],"DT_RowId"=>"td_".$Row['idx_pelanggan']);
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
			$nm_kolom=array('idx_brand','nm_product','category_product','harga','discount','harga','minimum_stock','harga');
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
				if(isset($_GET['brand'])){
					if($sWhere){
						$sWhere=$sWhere." and idx_brand='$_GET[brand]'";
					}else{
						$sWhere="where idx_brand='$_GET[brand]'";
					}
				}
				$iTotalRecordssql=$this->db->query("SELECT idx_product,".str_replace(" , ", " ", implode(", ", $nm_kolom))." FROM product");
				$iTotalRecords=$iTotalRecordssql->num_rows();
				$sQuery ="SELECT idx_product,".str_replace(" , ", " ", implode(", ", $nm_kolom))." FROM product $sWhere
							order by
							$nm_kolom[$sort_by] $sSortDir_0
							limit $iDisplayStart,$iDisplayLenght";
				$query=$this->db->query($sQuery);
				$data_arr=array();
				$i==0;
				foreach($query->result_array() as $Row){
					$attr		=$this->attr_product($Row['idx_product']);
					$attr_label	='';
					$st			=0;
					foreach($attr->result() as $attr_el){
						if($attr_el->stock-$attr_el->stock_akhir>$Row['minimum_stock']){
							$color="Green";
						}else{
							$color="Red";
						}
						$s=$attr_el->stock - $attr_el->stock_akhir;
						$attr_label=$attr_label."<p style='color:".$color.";font-weight: bold;'>".$attr_el->desc_attribute." ".$s."</p>";
						$st=$st+$s;
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
					$discount		=$Row['discount'];
					$get_discount	=$this->db->query("SELECT a.discount from content_prom a join promo_management b on a.idx_promo=b.idx_promo where b.idx_type_promo=1 and a.idx_product='$Row[idx_product]'");
					if($get_discount->num_rows()>0){
						$discount	=$get_discount->row()->discount;
					}
					$harga_jual		=$Row['harga']-($discount/100*$Row['harga']);
					$nilai_total	=$st*$harga_jual;
					$data_arr[]=array($this->get_nm_brand($Row['idx_brand']),$Row['nm_product'],$cat,"Rp. ".number_format($Row['harga'],0,',','.'),$discount,"Rp. ".number_format($harga_jual,0,',','.'),$attr_label,"Rp. ".number_format($nilai_total,0,',','.'),"DT_RowId"=>"td_".$Row['idx_product']);
					$i++;
				}
				$data_json=array('sEcho'=>$sEcho,'iTotalRecords'=>$iTotalRecords,'iTotalDisplayRecords'=>$iTotalRecords,'aaData'=>$data_arr);
				echo json_encode($data_json);
		}
		function get_nm($idx){
			return $this->db->get_where("category_product",array("idx_category_product"=>$idx))->row()->nm_categrory_product;
		}
		function get_nm_brand($idx){			if($idx<>0){				return $this->db->get_where("brand",array("idx_brand"=>$idx))->row()->nm_brand;			}else{				return "-";			}		}
}
