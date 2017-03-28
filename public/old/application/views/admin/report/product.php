<!--Datatables-->
<link rel="stylesheet" media="screen" href="<?=$assets?>css/admin/jquery.dataTables.css">
<link rel="stylesheet" media="screen" href="<?=$assets?>css/admin/demo_table_jui.css">
<!---Datatables-->
<script type="text/javascript" language="javascript" src="<?=$assets?>js/admin/jquery.dataTables.js"></script>
<script>
function load(par){
	if(par=="brand"){
		if($("#brand").val()){
			var URL="<?=site_url('report/list_product')?>?brand="+$("#brand").val();
		}else{
			var URL="<?=site_url('report/list_product')?>";
		}
	}else{
		var URL="<?=site_url('report/list_product')?>";
	}
	$('#List').dataTable({
		"bProcessing": true,
		"bJQueryUI": true,
		"bDestroy": true,
		"sPaginationType": "full_numbers",
		"bServerSide": true,
		"sAjaxSource":URL
	});
}
window.onload=load;
</script>
<link rel="stylesheet" href="<?=$assets?>css/admin/jquery-ui-1.8.4.custom.css" class="skin-color">
<script>
$(document).ready(function() {
	$("#parameter").change(function(){
		if($("#parameter").val()=="brand"){
			$("#par_brand").show();
		}else{
			$("#par_brand").hide();
		}
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
	<li>Laporan Produk</li>
</ul>
<div class="widget widget-tabs widget-tabs-double-2">
		<div class="widget-head">
			<ul>
				<li><a class="glyphicons shopping_cart" href="<?=site_url('report/order')?>"><i></i><span>Laporan Penjualan</span></a></li>
				<li><a class="glyphicons group" href="<?=site_url('report/customer')?>"><i></i><span>Laporan Pelanggan</span></a></li>
				<li class="active"><a class="glyphicons cargo" href="<?=site_url('report/product')?>"><i></i><span>Laporan Produk</span></a></li>
				<li><a class="glyphicons cargo" href="<?=site_url('report/best_product')?>"><i></i><span>Laporan Produk Terlaris</span></a></li>
			</ul>
		</div>
	</div>
<div class="innerLR">
<form class="form-horizontal" id="form_input" method="POST" action="<?=site_url('report/generate/product')?>" enctype="multipart/form-data">
	<!-- Widget -->
        <div class="widget widget-gray widget-body-gray">
                <div class="widget-body">
                        <!-- Row -->
                        <div class="row">
						<span id="ajax-status"></span>
						<span id="message"  ></span>
                        <!-- Column -->
                                <div class="col-md-12">
										 <!-- Group -->
                                        <div class="form-group">
                                                <label class="col-md-4 control-label" for="idx_pelanggan">Laporan Berdasarkan</label>
                                                <div class="col-md-8">
													<select style="width: 35%;" onChange="load(this.value)" class="form-control" id="parameter" name="parameter">
														<option value="all">Semua Data Produk</option>
														<option value="brand">Brand</option>
													</select>
												</div>
                                        </div>
                                        <!-- // Group END -->
										<div id="par_brand" style="display:none;">
										<!-- Group -->
                                        <div class="form-group">
                                                <label class="col-md-4 control-label" for="Brand">Brand</label>
                                                <div class="col-md-8">
													<select onChange="load('brand')" style="width: 35%;" class="form-control" id="brand" name="brand">
														<?php
															foreach($brand->result() as $wb){
																echo"<option value='".$wb->idx_brand."'>".$wb->nm_brand."</option>";
															}
														?>
													</select>
												</div>
                                        </div>
                                        <!-- // Group END -->
										</div>
                                </div>
                                <!-- // Column END -->
								<div class="col-md-12">
									<div class="innerLR">
										<div class="widget widget-4">
											<div class="widget-body">
												<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-horizontal" role="grid">
													<div class="row">
														<table class="dataTables_wrapper form-horizontal" role="grid" id="List" >
															<thead>
																<tr>
																	<th width="10%">Brand</th>
																	<th width="15%">Nama Produk</th>
																	<th width="15%">Kategori</th>
																	<th>Harga Satuan</th>
																	<th>Discount (%)</th>
																	<th>Harga Jual</th>
																	<th width="15%">Stok</th>
																	<th>Nilai Total Produk</th>
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



