<?php
	$date_now	=date('Y-m-d');
	$cek		=$this->db->query("SELECT * FROM `promo_management` where tgl_akhir<'$date_now' and idx_type_promo<>6 and idx_type_promo<>7 and (tgl_akhir<>'0000-00-00' or tgl_awal<>'0000-00-00')");
	if($cek->num_rows()>0){
		$idx_promo	=$cek->row()->idx_promo;
		$path_slide	=$cek->row()->path_slide;
		if($path_slide){
				unlink('./uploads/promo_slide/'.$path_slide); 
		}
		$this->db->query("delete from promo_management where idx_promo='$idx_promo'");
		$this->db->query("delete from content_prom where idx_promo='$idx_promo'");
	}
?>