<link rel="stylesheet" href="<?=$assets?>css/admin/jquery-ui-1.8.4.custom.css" class="skin-color">
<script>
$(document).ready(function() {
	$("#tgl_awal,#tgl_akhir").datepicker({dateFormat: 'yy-mm-dd'});
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
<div class="separator bottom"></div>
<div class="innerLR">

<form class="form-horizontal" id="form_input" method="POST" action="<?=site_url('report/generate/product')?>" enctype="multipart/form-data">
	<!-- Widget -->
        <div class="widget widget-gray widget-body-gray">
                <!-- Widget heading -->
                <div class="widget-head"><h4 class="heading">Laporan Produk</h4></div>
                <!-- // Widget heading END -->
                <div class="widget-body">
                        <!-- Row -->
                        <div class="row">
						<span id="ajax-status"></span>
						<span id="message"  ></span>
                        <!-- Column -->
                                <div class="col-md-6">
										 <!-- Group -->
                                        <div class="form-group">
                                                <label class="col-md-4 control-label" for="idx_pelanggan">Laporan Berdasarkan</label>
                                                <div class="col-md-8">
													<select class="form-control" id="parameter" name="parameter">
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
													<select class="form-control" id="brand" name="brand">
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
                           </div>
                        <!-- // Row END -->
                        <!-- Form actions -->
                        <div class="form-actions">
                                <button type="submit" class="btn btn-icon btn-primary glyphicons circle_ok"><i></i>OK</button>
                                <button type="reset" class="btn btn-icon btn-default glyphicons circle_remove"><i></i>Reset</button>
                        </div>
                        <!-- // Form actions END -->
                        
                </div>
	

</div>
</form>
</div>
		
				<!-- End Wrapper -->
		</div>



