<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class halaman extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('additional_model');
		$this->load->helper(array('form', 'url'));
		$this->load->library('session');
		$this->load->library('cart');
	}
	function index()
	{
		
	}
	function look_page(){
		if($this->uri->segment(2)){
			$data['assets']		=$this->config->item('assets');
			$data['identitas'] 	= $this->additional_model->get_row('identitas');
			$data['ym'] 		= $this->additional_model->get_ym();
			$data['sosial'] 	= $this->additional_model->sosial();
			$data['hubungi'] 	= $this->additional_model->hubungi();
			$data['contact']	= $this->additional_model->contact();
			$data['menu_bawah']	= $this->additional_model->menu_bawah();
			$data['menu'] 		= $this->additional_model->create_menu();
			$template='demo';
			if ($this->additional_model->get_fb()->num_rows() > 0){   $data['fb_account'] = $this->additional_model->get_fb()->row()->no_account; }else{$data['fb_account'] = '';}
			$data['cart']		=$this->additional_model->display_cart();
			$data['page']		= $this->additional_model->get_page($this->uri->segment(2));
			if($data['page']->num_rows()>0){
				$page=$data['page']->row();
				$data['site_title']	=$page->nm_page." | ".$data['identitas']->site_title;
				$data['nm_page']	=$page->nm_page;
				$data['content']	=$page->content;
				$this->load->view('template/'.$template.'/page',$data);
			}else{
				redirect('page');
			}
			
		}else{
			redirect('page');
		}
	}
	function get_name_page($idx){
		$r=$this->additional_model->get_where_row("page","idx_page",$idx);
		return strtolower(str_replace(" ","-",$r->nm_page));
	}
}
