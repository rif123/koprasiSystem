<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>    <html class="lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>    <html class="lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class=" js csstransforms3d csstransitions"><!--<![endif]--><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title><?=$site_title?></title>
<?php $this->load->view('admin/header'); ?>
<script type="text/javascript">
    function stopEnterKey(evt) {
        var evt = (evt) ? evt : ((event) ? event : null);
        var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
        if ((evt.keyCode == 13) && (node.type == "text")) { return false; }
    }
    document.onkeypress = stopEnterKey;
</script>
<body>
	<!-- Start Content -->
	<div class="first-container container fluid">
		<div class="navbar main hidden-print">	
			<a href="#" class="appbrand"><span>Admin</span></a>
			<!-- Menu Toggle Button -->
				<button type="button" class="btn btn-navbar">
                	<span class="glyphicons show_lines toggle"></span>
				</button>
			<!-- // Menu Toggle Button END -->	
			<?php
				/*-------Hapus Transaki-----*/
				$Q=$this->db->query("SELECT * FROM `order` where cd_status=0 and CURRENT_DATE-tgl_order>=3");
				if($Q->num_rows()>0){
					foreach($Q->result() as $w){
						$this->db->query("delete from rl_order where idx_order='$w->idx_order'");
						$this->db->query("delete from `order` where idx_order='$w->idx_order'");
					}
				}
				/*-------Hapus Transaki-----*/
				$sql=$this->db->query("SELECT distinct a.idx_product FROM `product` a join attribute_product b on a.idx_product=b.idx_product where b.stock-b.stock_akhir<=a.minimum_stock");
				$TotalRecords=$sql->num_rows();
				
				$fl_refund	=$this->db->get('setting_toko')->row()->fl_refund;
				$sys		=$this->db->get("system")->row();
				$fl_promo	=$sys->fl_promo;
				$fl_wishlist=$sys->fl_wishlist;
			?>			
			<ul class="topnav pull-right">
				<li class="visible-lg">
					<ul class="notif">
						<li><a href="<?=site_url('product/minimum_stock')?>" class="glyphicons cargo" data-toggle="tooltip" data-placement="bottom" data-original-title="Lihat Minimum Stock Produk"><?=$TotalRecords?></a></li>
						<li><a href="<?=site_url('order/order')?>" class="glyphicons shopping_cart" data-toggle="tooltip" data-placement="bottom" data-original-title="Pesanan Baru"><?=$this->db->query("SELECT * FROM  `order` where cd_status=0")->num_rows();?></a></li>
						<?php if($fl_wishlist==1){ ?>
						<li><a href="<?=site_url('pelanggan/wishlist')?>" class="glyphicons heart" data-toggle="tooltip" data-placement="bottom" data-original-title="Wishlist Baru"><?=$this->db->query("SELECT * FROM  `wishlist`")->num_rows();?></a></li>
						<?php }?>
						<li><a href="<?=site_url('order/confirm')?>" class="glyphicons coins" data-toggle="tooltip" data-placement="bottom" data-original-title="Konfirmasi Pembayaran Terbaru"><?=$this->db->query("SELECT * FROM  payment_confirm where cd_status =0")->num_rows();?></a></li>
						<li><a href="<?=site_url('pelanggan/message')?>" class="glyphicons envelope" data-toggle="tooltip" data-placement="bottom" data-original-title="Pesan Masuk"><?=$this->db->query("SELECT * FROM  message where cd_status=0")->num_rows();?></a></li>
						<li><a href="<?=site_url('pelanggan/rate')?>" class="glyphicons star" data-toggle="tooltip" data-placement="bottom" data-original-title="Rating Produk"><?=$this->db->query("SELECT * FROM  rated_product where cd_status=0")->num_rows();?></a></li>
						<li><a href="<?=site_url('pelanggan/testimoni')?>" class="glyphicons comments" data-toggle="tooltip" data-placement="bottom" data-original-title="Testimonial"><?=$this->db->query("SELECT * FROM  testimoni where cd_status=0")->num_rows();?></a></li>
						<?php if($fl_refund==1){ ?>
						<li><a href="<?=site_url('order/refund')?>" class="glyphicons repeat" data-toggle="tooltip" data-placement="bottom" data-original-title="Pengembalian Barang"><?=$this->db->query("SELECT * FROM  refund where cd_status=0")->num_rows();?></a></li>
						<?php } ?>
					</ul>
				</li>
				<li class="account">
					<a data-toggle="dropdown" href="#" class="glyphicons logout lock"><span class="hidden-sm text">My Account</span></a>
					<ul class="dropdown-menu pull-right">
						<li><a href="<?=site_url('admin/change_password')?>" class="glyphicons group">Ganti Profile</a></li>
						<li>
							<span>
								<a class="btn btn-default btn-small pull-right" style="padding: 2px 10px; background: #fff;" href="<?=site_url('admin/logout')?>">Logout</a>
							</span>
						</li>
					</ul>
				</li>
			</ul>		
		</div>
		<div id="wrapper">
		<div id="menu" class="hidden-sm hidden-print">
			<div id="menuInner">
			
				<!-- Scrollable menu wrapper with Maximum height -->
			<div class="slim-scroll" data-scroll-height="420px">

	
				<ul>
					<li class="heading"><span>Main Menu</span></li>
					<li class="glyphicons home"><a href="<?=site_url('admin/home')?>"><span>Home</span></a></li>
					<li class="glyphicons stats"><a href="<?=site_url('dashboard')?>"><span>Dashboard</span></a></li>
					<?php if(($this->session->userdata('user_name')=='sadmin')){ ?>
					<li class="glyphicons settings"><a href="<?=site_url('setting/system')?>"><span>Setting System</span></a></li>
					<?php } ?>
					<li class="glyphicons settings"><a href="<?=site_url('setting/general')?>"><span>Setting Aplikasi</span></a></li>
					<li class="hasSubmenu">
						<a data-toggle="collapse" class="glyphicons cargo collapsed" href="#menu_product"><span>Produk</span></a>
						<ul class="menuCollapse in" id="menu_product">
							<li class=""><a href="<?=site_url('product/add/product')?>"><span>Tambah Produk</span></a></li>
							<li class=""><a href="<?=site_url('product/product')?>"><span>Produk</span></a></li>
							<li class=""><a href="<?=site_url('product/minimum_stock')?>"><span>Produk Minimum Stok (<?=$TotalRecords?>)</span></a></li>
							<li class=""><a href="<?=site_url('product/best_product')?>"><span>Produk Terlaris</span></a></li>
							<li class=""><a href="<?=site_url('product/category')?>"><span>Kategori Produk</span></a></li>
							<li class=""><a href="<?=site_url('parameter/attribute')?>"><span>Atribute Produk</span></a></li>
							<li class=""><a href="<?=site_url('product/brand')?>"><span>Brand Produk</span></a></li>
							<li class=""><a href="<?=site_url('product/ukuran')?>"><span>Tabel Ukuran</span></a></li>
						</ul>
					</li>
					<?php 
					if($fl_promo){
						$url=site_url('promo');
						$alert="";
					}else{
						$url	="#";
						$alert	="onClick='alert(\"Maaf,Feature ini tidak tersedia untuk paket anda.silahkan lakukan Upgrade paket untuk bisa menggunakan feature ini.\");'";
					}
					?>
						<li class="glyphicons spray">
							<a href="<?=$url?>" <?=$alert?>><span>Promo Management</span></a>
						</li>
					<li class="hasSubmenu">
						<a data-toggle="collapse" class="glyphicons shopping_cart  collapsed" href="#menu_order"><span>Informasi Pesanan</span></a>
						<ul class="menuCollapse in" id="menu_order">
							<li class=""><a href="<?=site_url('order/order')?>"><span>Pesanan Terbaru (<?=$this->db->query("SELECT * FROM  `order` where cd_status=0")->num_rows();?>)</span></a></li>
							<li class=""><a href="<?=site_url('order/resi')?>"><span>Resi Pengiriman</span></a></li>
							<li class=""><a href="<?=site_url('order/order/all')?>"><span>History Pesanan</span></a></li>
							<?php if($fl_wishlist==1){ ?>
							<li class=""><a href="<?=site_url('pelanggan/wishlist')?>"><span>Daftar Wishlist (<?=$this->db->query("SELECT * FROM  `wishlist`")->num_rows()?>)</span></a></li>
							<?php } ?>
							<?php if($fl_refund==1){ ?>
							<li class=""><a href="<?=site_url('order/refund')?>"><span>Pengembalian Barang (<?=$this->db->query("SELECT * FROM  `refund` where cd_status=0")->num_rows()?>)</span></a></li>
							<?php } ?>
						</ul>
					</li>
					<li class="glyphicons coins">
						<a href="<?=site_url('order/confirm')?>"><span>Konfirmasi Pembayaran</span></a>
					</li>
					<li class="glyphicons group">
						<a href="<?=site_url('pelanggan/pelanggan')?>"><span>Data Pelanggan</span></a>
					</li>
					<li class="glyphicons envelope">
						<a href="<?=site_url('pelanggan/tulis_newsletter')?>"><span>Newsletter Pelanggan</span></a>
					</li>
					<li class="glyphicons table">
						<a href="<?=site_url('report/order')?>"><span>Laporan</span></a>
					</li>
					<li class="glyphicons settings">
						<a href="<?=site_url('pelanggan/upgrade')?>"><span>Upgrade Paket</span></a>
					</li>
					<li class="glyphicons settings">
						<a href="<?=site_url('pelanggan/change_template')?>"><span>Request Ganti Template</span></a>
					</li>
					<li class="glyphicons settings">
						<a href="<?=site_url('pelanggan/pesan_banner_logo')?>"><span>Pesan Banner atau Logo</span></a>
					</li>
					<li class="hasSubmenu">
						<a data-toggle="collapse" class="glyphicons shop  collapsed" href="#menu_comm"><span>Shoplution Community</span></a>
						<ul class="menuCollapse in" id="menu_comm">
							<li class=""><a href="<?=site_url('pelanggan/newsletter')?>"><span>Newsletter (<?=$this->db->query("SELECT * FROM  newsletter where cd_status=0")->num_rows();?>)</span></a></li>
							<li class=""><a href="<?=site_url('pelanggan/info_tagihan')?>"><span>Info Tagihan</span></a></li>
						</ul>
					</li>
				</ul>
			</div>
		
			</div>
			<!-- // Nice Scroll Wrapper END -->
			
		</div>
		<?php $this->load->view($content_admin);
			$count_newsletter	=$this->db->query("SELECT * FROM  newsletter where cd_status=0")->num_rows();
			if($count_newsletter>0){
				echo'
					<ul id="notyfy_container_bottomLeft" class="notyfy_container">
						<li class="notyfy_wrapper notyfy_primary" style="cursor: pointer; overflow: hidden;">
							<a href="'.site_url('pelanggan/newsletter').'" />
							<div id="notyfy_1238307570990400300" class="notyfy_bar">
							<div class="notyfy_message">
								<span class="notyfy_text"><p>'.$count_newsletter.' Newsletter from Shoplution</p></span>
							</div>
							</div>
							</a>
						</li>
					</ul>
				';
			}
		?>
<?php $this->load->view('admin/footer'); ?>


