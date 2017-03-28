<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class dashboard extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->helper(array('form', 'url'));
		$this->load->library('session');
		if($this->db->get('system')->row()->cd_status==0){
			redirect('suspend');
		}
	}
	function index()
	{
		$this->auth();
		$data['assets']					=$this->config->item('assets');
		$data['count_order']			=$this->db->get('order')->num_rows();
		$data['count_order_new']		=$this->db->query("select * from `order` where cd_status=0")->num_rows();
		$data['count_order_pending']	=$this->db->get_where('order',array("cd_status"=>0))->num_rows();
		$data['count_order_get']		=$this->db->get_where('order',array("cd_status"=>1))->num_rows();
		$data['count_order_verf']		=$this->db->get_where('order',array("cd_status"=>8))->num_rows();
		$data['count_order_proses']		=$this->db->get_where('order',array("cd_status"=>2))->num_rows();
		$data['count_order_wait_resi']	=$this->db->get_where('order',array("cd_status"=>3))->num_rows();
		$data['count_order_finish']		=$this->db->get_where('order',array("cd_status"=>4))->num_rows();
		$data['count_confirm']			=$this->db->get('payment_confirm')->num_rows();
		$data['count_confirm_hold']		=$this->db->get_where('payment_confirm',array("cd_status"=>0))->num_rows();
		$data['count_confirm_ok']		=$this->db->get_where('payment_confirm',array("cd_status"=>1))->num_rows();
		
		$data['count_cus']				=$this->db->get('pelanggan')->num_rows();
		$data['count_product']			=$this->db->get('product')->num_rows();
		$sql=$this->db->query("SELECT distinct a.idx_product FROM `product` a join attribute_product b on a.idx_product=b.idx_product where b.stock-b.stock_akhir<=a.minimum_stock");
		$data['count_minim']			=$sql->num_rows();
		$data['count_mess']				=$this->db->get('message')->num_rows();
		$data['count_mess_pending']		=$this->db->get_where('message',array("cd_status"=>0))->num_rows();
		$data['count_testimoni']		=$this->db->get('testimoni')->num_rows();
		$data['count_testimoni_pending']=$this->db->get_where('testimoni',array("cd_status"=>0))->num_rows();
		$data['count_rating']			=$this->db->get('rated_product')->num_rows();
		$data['count_rating_pending']	=$this->db->get_where('rated_product',array("cd_status"=>0))->num_rows();
		$filename = "./countlog_total.txt"; 
		$count= file($filename); 
		$file = fopen ($filename, "a") or die ("Cannot find $filename"); 
		fclose($file); 
		$data['count_trafic']			=$count[0];
		
		$file 					= "./countlog.txt"; 
		$buka					=fopen($file,"a");
		fclose($buka);
		$arr					=file($file);
		$data['count_trafic_day']	=count($arr);
		$data['site_title']		="Dashboard";
		$data['content_admin']	="admin/dashboard/dashboard";
		$this->load->view('admin/index',$data);
		
	}
	function auth(){
		if(($this->session->userdata('set_login')==FALSE)){
			redirect('admin');
		}
	}
}
