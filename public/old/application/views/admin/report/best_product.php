<!--Datatables-->
<link rel="stylesheet" media="screen" href="<?=$assets?>css/admin/jquery.dataTables.css">
<link rel="stylesheet" media="screen" href="<?=$assets?>css/admin/demo_table_jui.css">
<!---Datatables-->
<script type="text/javascript" language="javascript" src="<?=$assets?>js/admin/jquery.dataTables.js"></script>
<link rel="stylesheet" href="<?=$assets?>css/admin/jquery-ui-1.8.4.custom.css" class="skin-color">
<script>
$(document).ready(function() {
	var URL="<?=site_url('report/list_best_product')?>";
	$('#List').dataTable({
		"bProcessing": true,
		"bJQueryUI": true,
		"bDestroy": true,
		"sPaginationType": "full_numbers",
		"aaSorting": [[ 5, "desc" ]],
		"bServerSide": true,
		"sAjaxSource":URL
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
	<li>Laporan Produk Terlaris</li>
</ul>
<div class="widget widget-tabs widget-tabs-double-2">
		<div class="widget-head">
			<ul>
				<li><a class="glyphicons shopping_cart" href="<?=site_url('report/order')?>"><i></i><span>Laporan Penjualan</span></a></li>
				<li><a class="glyphicons group" href="<?=site_url('report/customer')?>"><i></i><span>Laporan Pelanggan</span></a></li>
				<li><a class="glyphicons cargo" href="<?=site_url('report/product')?>"><i></i><span>Laporan Produk</span></a></li>
				<li class="active"><a class="glyphicons cargo" href="<?=site_url('report/best_product')?>"><i></i><span>Laporan Produk Terlaris</span></a></li>
			</ul>
		</div>
	</div>
<div class="innerLR">
<form class="form-horizontal" id="form_input" method="POST" action="<?=site_url('report/generate/best_product')?>" enctype="multipart/form-data">
	<!-- Widget -->
        <div class="widget widget-gray widget-body-gray">
                <div class="widget-body">
                        <!-- Row -->
                        <div class="row">
						<span id="ajax-status"></span>
						<span id="message"  ></span>
							<div class="col-md-12">
									<div class="innerLR">
										<div class="widget widget-4">
											<div class="widget-body">
												<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-horizontal" role="grid">
													<div class="row">
														<table class="dataTables_wrapper form-horizontal" role="grid" id="List" >
															<thead>
																<tr>
																	<th width="15%">Nama Produk</th>
																	<th width="15%">Kategori</th>
																	<th width="15%">Harga Satuan</th>
																	<th width="10%">Discount (%)</th>
																	<th width="10%">Harga Jual</th>
																	<th width="8%">Jumlah Terjual</th>
																	<th width="12%">Total</th>
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



