<!--Content-->
<div id="content">
<ul class="breadcrumb">
	<li><a href="#" class="glyphicons home">Home</a></li>
	<li class="divider"></li>
	<li>Dashboard</li>
</ul>
<br>
<div class="innerLR">
<div class="row">
	<div class="col-md-12">
		<div class="row">
			<div class="col-md-6">
			<h4 class="glyphicons clock">Aktivitas</h4>
				<div class="btn-group btn-group-vertical block">
					<a href="<?=site_url('pelanggan/pelanggan')?>" class="btn btn-icon btn-default btn-block glyphicons group count"> <span><?=$count_cus?></span>Total Pelanggan</a>
					<a href="<?=site_url('product/product')?>" class="btn btn-icon btn-default btn-block glyphicons shopping_cart count"> <span><?=$count_product?></span>Total Produk</a>
					<a href="<?=site_url('product/minimum_stock')?>" class="btn btn-icon btn-default btn-block glyphicons shopping_cart count"> <span><?=$count_minim?></span>Total Produk dengan Jumlah Terbatas</a>
				</div>
			</div>
			<div class="col-md-6">
				<h4 class="glyphicons clock">Pesan</h4>
				<div class="btn-group btn-group-vertical block">
					<a href="<?=site_url('pelanggan/message/new')?>" class="btn btn-icon btn-default btn-block glyphicons envelope count"> <span><?=$count_mess_pending?></span>Pesan Masuk Terbaru</a>
					<a href="<?=site_url('pelanggan/message')?>" class="btn btn-icon btn-default btn-block glyphicons envelope count"> <span><?=$count_mess?></span>Total Pesan Masuk</a>
					<a href="<?=site_url('pelanggan/testimoni/new')?>" class="btn btn-icon btn-default btn-block glyphicons comments count"> <span><?=$count_testimoni_pending?></span>Testimoni Terbaru</a>
					<a href="<?=site_url('pelanggan/testimoni')?>" class="btn btn-icon btn-default btn-block glyphicons comments count"> <span><?=$count_testimoni?></span>Total Testimoni</a>
					<a href="<?=site_url('pelanggan/rate/new')?>" class="btn btn-icon btn-default btn-block glyphicons star count"> <span><?=$count_rating_pending?></span>Rating Produk Terbaru</a>
					<a href="<?=site_url('pelanggan/rate')?>" class="btn btn-icon btn-default btn-block glyphicons star count"> <span><?=$count_rating?></span>Total Rating Produk</a>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="separator bottom"></div>
<div class="row">
	<div class="col-md-12">
		<div class="row">
			<div class="col-md-6">
				<h4 class="glyphicons clock">Pesanan</h4>
				<div class="btn-group btn-group-vertical block">
					<a href="<?=site_url('order/order')?>" class="btn btn-icon btn-default btn-block glyphicons cargo count"> <span><?=$count_order_new?></span>Pesanan Terbaru</a>
					<a href="<?=site_url('order/order/unpaid')?>" class="btn btn-icon btn-default btn-block glyphicons download count"> <span><?=$count_order_pending?></span>Pesanan Menunggu Pembayaran</a>
					<a href="<?=site_url('order/order/unverify')?>" class="btn btn-icon btn-default btn-block glyphicons download count"> <span><?=$count_order_verf?></span>Pesanan Menunggu Verifikasi Pembayaran</a>
					<a href="<?=site_url('order/order/valid')?>" class="btn btn-icon btn-default btn-block glyphicons download count"> <span><?=$count_order_get?></span>Pesanan Sudah Berbayar</a>
					<a href="<?=site_url('order/order/process')?>" class="btn btn-icon btn-default btn-block glyphicons download count"> <span><?=$count_order_proses?></span>Pesanan Dikemas</a>
					<a href="<?=site_url('order/resi')?>" class="btn btn-icon btn-default btn-block glyphicons download count"> <span><?=$count_order_wait_resi?></span>Pesanan Dikirim dan Menunggu Resi</a>
					<a href="<?=site_url('order/order/finish')?>" class="btn btn-icon btn-default btn-block glyphicons download count"> <span><?=$count_order_finish?></span>Pesanan Selesai</a>
					<a href="<?=site_url('order/order/all')?>" class="btn btn-icon btn-default btn-block glyphicons cargo count"> <span><?=$count_order?></span>Total Pesanan</a>
				</div>
			</div>
			<div class="col-md-6">
				<h4 class="glyphicons clock">Konfirmasi Pembayaran</h4>
				<div class="btn-group btn-group-vertical block">
					<a href="<?=site_url('order/confirm')?>" class="btn btn-icon btn-default btn-block glyphicons coins count"> <span><?=$count_confirm_hold?></span>Konfirmasi Pembayaran Belum Terverifikasi</a>
					<a href="<?=site_url('order/confirm/valid')?>" class="btn btn-icon btn-default btn-block glyphicons coins count"> <span><?=$count_confirm_ok?></span>Konfirmasi Pembayaran Terverifikasi</a>
					<a href="<?=site_url('order/confirm/all')?>" class="btn btn-icon btn-default btn-block glyphicons coins count"> <span><?=$count_confirm?></span>Total Konfirmasi Pembayaran</a>
				</div>
			</div>
		</div>
	</div>
</div>			
<div class="separator bottom"></div>
<div class="row">
	<div class="col-md-12">
		<div class="row">
			<div class="col-md-6">
				<h4 class="glyphicons clock">Web Trafik</h4>
				<div class="btn-group btn-group-vertical block">
					<a class="btn btn-icon btn-default btn-block glyphicons envelope count"> <span><?=$count_trafic_day?></span>Pengunjung Website Hari ini</a>
					<a class="btn btn-icon btn-default btn-block glyphicons envelope count"> <span><?=$count_trafic?></span>Total Pengunjung Website</a>
				</div>
			</div>
		</div>
	</div>
</div>			
				<!-- End Content -->
		</div>		
<!-- End Wrapper -->
</div>	



