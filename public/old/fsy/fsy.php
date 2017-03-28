<?php
if(md5('shoplution.co.id')==$_GET['q']){
	if(md5($_POST['nm_domain'])==$_GET['s']){
		include"action.php";
			$cn=new fsy();
			if(md5('suspend_akun')==$_GET['r']){
				$cn->suspend();
			}
			if(md5('aktifkan_akun')==$_GET['r']){
				$cn->set_aktif();
			}
	}
}
?>