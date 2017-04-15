<script type="text/javascript" src="<?=$assets?>js/admin/jquery-ui.js"></script>
<link rel="stylesheet" href="<?=$assets?>css/admin/jquery-ui-1.8.4.custom.css" class="skin-color">
<!--Content-->
<div id="content">
<ul class="breadcrumb">
	<li><a href="#" class="glyphicons home">Home</a></li>
	<li class="divider"></li>
	<li>Tambah Promo</li>
</ul>
<div class="separator bottom"></div>
<div class="innerLR">

<form class="form-horizontal" id="form_input" method="POST" action="<?=site_url('promo/save/promo')?>" enctype="multipart/form-data">
	<!-- Widget -->
        <div class="widget widget-gray widget-body-gray">
                <!-- Widget heading -->
                <div class="widget-head"><h4 class="heading">Tambah Promo</h4><a href="<?=site_url('promo/dt_promo')?>" style="float:right;margin-right:5px;">Data Promo</a></div>
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
                                                <label class="col-md-4 control-label" for="idx_type_promo">Tipe Promo</label>
                                                <div class="col-md-8">
													<select class="form-control" name='idx_type_promo' onClick="toogle_cat(this.value);" id='idx_type_promo'>
														<?php
															foreach($type_promo->result() as $wtp){
																echo"<option value='".$wtp->idx_type_promo."'>".$wtp->nm_type_promo."</option>";
															}
														?>
													</select>
												</div>
                                        </div>
                                        <!-- // Group END -->
										<div id="no_category">
                                        <!-- Group -->
                                        <div class="form-group">
                                                <label class="col-md-4 control-label" for="nm_promo">Nama Promo</label>
                                                <div class="col-md-8"><input class="form-control" id="nm_promo" name="nm_promo" type="text"></div>
                                        </div>
                                        <!-- // Group END -->
										<!-- Group -->
                                        <div class="form-group">
                                                <label class="col-md-4 control-label" for="tgl_awal">Tgl Awal Promo</label>
                                                <div class="col-md-8"><input class="form-control" id="tgl_awal" name="tgl_awal" type="text"></div>
                                        </div>
                                        <!-- // Group END -->
										<!-- Group -->
                                        <div class="form-group">
                                                <label class="col-md-4 control-label" for="tgl_akhir">Tgl Akhir Promo</label>
                                                <div class="col-md-8"><input class="form-control" id="tgl_akhir" name="tgl_akhir" type="text"></div>
                                        </div>
                                        <!-- // Group END -->
										</div>
										<div id="no_promo">
											<!-- Group -->
											<div class="form-group">
													<label class="col-md-4 control-label" for="nm_promo">Judul Slide</label>
													<div class="col-md-8"><input class="form-control" id="jdl_slide" name="jdl_slide" type="text"></div>
											</div>
											<!-- // Group END -->
										</div>
										<div id="category">
											<div class="form-group">
													<label class="col-md-4 control-label" for="idx_category">Kategori</label>
													<div class="col-md-8">
														<select class="form-control" name='idx_category' id='idx_category'>
															<?php
																foreach($category_product->result() as $wc){
																	echo"<option value='".$wc->idx_category."/".str_replace(">","/",str_replace(" ","-",strtolower($wc->name)))."'>".$wc->name."</option>";
																}
															?>
														</select>
													</div>
											</div>
										</div>
										<!-- Group -->
                                        <div class="form-group">
                                                <label class="col-md-4 control-label" for="path_slide">Upload Banner Promo</label>
                                                <div class="col-md-8"><input class="form-control" id="path_slide" name="path_slide" type="file"></div>
                                        </div>
                                        <!-- // Group END -->
										<!-- Group -->
                                        <div class="form-group">
                                                <label class="col-md-4 control-label" for="tgl_akhir">Position Banner</label>
                                                <div class="col-md-8">
													<select class="form-control" name='position' id='position'>
														<option selected value=1>Slide</option>
														<option value=0>Banner Kecil</option>
													</select>
												</div>
                                        </div>
                                        <!-- // Group END -->
                                </div>
                                <!-- // Column END -->
                           </div>
                        <!-- // Row END -->
                        
                        <!-- Form actions -->
                        <div class="form-actions">
                                <button type="submit" class="btn btn-icon btn-primary glyphicons circle_ok"><i></i>Ok</button>
                                <button type="reset" class="btn btn-icon btn-default glyphicons circle_remove"><i></i>Reset</button>
                        </div>
                        <!-- // Form actions END -->
                        
                </div>
	

</div>
</form>
</div>
		
				<!-- End Wrapper -->
		</div>	

<script>
	function toogle_cat(i){
		if(i==6){
			$("#category").show();
			$("#no_category").hide();
			$("#no_promo").hide();
		}else if(i==7){
			$("#no_promo").show();
			$("#category").hide();
			$("#no_category").hide();
		}else{
			$("#no_category").show();
			$("#category").hide();
			$("#no_promo").hide();
		}
	}
$(document).ready(function() {
	$("#tgl_awal,#tgl_akhir").datepicker({dateFormat: 'yy-mm-dd'});
	$('#ajax-status').hide();
	$('#message').hide();
	$('#form_input').ajaxForm({
		target: '#message',
		success: function() {
			$('#message').show();
		}
	});
	$('#ajax-status').ajaxStart(function(){
		$('#message').hide();
		$(this).fadeIn('fast');
		$(this).html("<div id='shadow'><p>Loading..</p></div>");
	});
	$('#ajax-status').ajaxSuccess(function(){
		$(this).hide();
	});
	toogle_cat($("#idx_type_promo").val());
});
</script>

