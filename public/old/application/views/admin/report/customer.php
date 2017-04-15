<!--Datatables-->
<link rel="stylesheet" media="screen" href="<?=$assets?>css/admin/jquery.dataTables.css">
<link rel="stylesheet" media="screen" href="<?=$assets?>css/admin/demo_table_jui.css">
<!---Datatables-->
<script type="text/javascript" language="javascript" src="<?=$assets?>js/admin/jquery.dataTables.js"></script>
<script>
$(document).ready(function() {
	$('#List').dataTable({
		"bProcessing": true,
		"bJQueryUI": true,
		"bDestroy": true,
		"sPaginationType": "full_numbers",
		"bServerSide": true,
		"sAjaxSource":"<?=site_url('report/list_history_pelanggan')?>"
	});
});
</script>
<!--Content-->
<div id="content">
<ul class="breadcrumb">
	<li><a href="#" class="glyphicons home">Home</a></li>
	<li class="divider"></li>
	<li>Laporan</li>
	<li class="divider"></li>
	<li>Laporan Pelanggan</li>
</ul>
<div class="widget widget-tabs widget-tabs-double-2">
		<div class="widget-head">
			<ul>
				<li><a class="glyphicons shopping_cart" href="<?=site_url('report/order')?>"><i></i><span>Laporan Penjualan</span></a></li>
				<li class="active"><a class="glyphicons group" href="<?=site_url('report/customer')?>"><i></i><span>Laporan Pelanggan</span></a></li>
				<li><a class="glyphicons cargo" href="<?=site_url('report/product')?>"><i></i><span>Laporan Produk</span></a></li>
				<li><a class="glyphicons cargo" href="<?=site_url('report/best_product')?>"><i></i><span>Laporan Produk Terlaris</span></a></li>
			</ul>
		</div>
	</div>
<div class="innerLR">
<form class="form-horizontal" id="form_input" method="POST" action="<?=site_url('report/generate/customer')?>" enctype="multipart/form-data">
	<!-- Widget -->
        <div class="widget widget-gray widget-body-gray">
                <div class="widget-body">
                        <!-- Row -->
                        <div class="row">
							<div class="col-md-12">
									<div class="innerLR">
										<div class="widget widget-4">
											<div class="widget-body">
												<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-horizontal" role="grid">
													<div class="row">
														<table class="dataTables_wrapper form-horizontal" role="grid" id="List" >
															<thead>
																<tr>
																	<th width="15%">Nama Lengkap</th>
																	<th width="8%">Jenis Kelamin</th>
																	<th width="10%">Tanggal Lahir</th>
																	<th width="15%">Email</th>
																	<th width="20%">Alamat</th>
																	<th width="10%">Kota</th>
																	<th width="10%">Provinsi</th>
																	<th width="10%">Telepon</th>
																	<th width="10%">Handphone</th>
																	<th width="8%">Jumlah Transaksi</th>
																</tr>
															</thead>
															<tbody aria-relevant="all" aria-live="polite" role="alert">
																<tr>
																	<td colspan="5" class="dataTables_empty">Loading data from server</td>
																</tr>
															</tbody>
														</table>
													</div>
												</div>
											</div>
										</div>
									</div>
									</div>
                           </div>
                        <!-- // Row END -->
                        <!-- Form actions -->
                        <div class="form-actions">
                                <button type="submit" class="btn btn-icon btn-primary glyphicons circle_ok"><i></i>Export to Excel</button>
                        </div>
                        <!-- // Form actions END -->
                        
                </div>
	

</div>
</form>
</div>
		
				<!-- End Wrapper -->
		</div>



