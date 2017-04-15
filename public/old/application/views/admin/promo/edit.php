<script type="text/javascript" src="<?=$assets?>js/admin/jquery-ui.js"></script>
<link rel="stylesheet" href="<?=$assets?>css/admin/jquery-ui-1.8.4.custom.css" class="skin-color">
<!--Content-->
<div id="content">
<ul class="breadcrumb">
	<li><a href="#" class="glyphicons home">Home</a></li>
	<li class="divider"></li>
	<li>Edit Promo</li>
</ul>
<div class="separator bottom"></div>
<div class="innerLR">

<form class="form-horizontal" id="form_input" method="POST" action="<?=site_url('promo/update/promo')?>" enctype="multipart/form-data">
	<!-- Widget -->
        <div class="widget widget-gray widget-body-gray">
                <!-- Widget heading -->
                <div class="widget-head"><h4 class="heading">Edit Promo</h4></div>
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
												<input value="<?=$Result_form->idx_promo?>" id="idx_promo" name="idx_promo" type="hidden">
                                                <div class="col-md-8">
													<select class="form-control" name='idx_type_promo' id='idx_type_promo'>
														<?php
															foreach($type_promo->result() as $wtp){
																$selected="";
																if($wtp->idx_type_promo==$Result_form->idx_type_promo){
																	$selected="selected";
																}
																echo"<option ".$selected." value='".$wtp->idx_type_promo."'>".$wtp->nm_type_promo."</option>";
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
                                                <div class="col-md-8"><input class="form-control" value="<?=$Result_form->nm_promo?>" id="nm_promo" name="nm_promo" type="text"></div>
                                        </div>
                                        <!-- // Group END -->
										<!-- Group -->
                                        <div class="form-group">
                                                <label class="col-md-4 control-label" for="tgl_awal">Tgl Awal Promo</label>
                                                <div class="col-md-8"><input class="form-control" value="<?=$Result_form->tgl_awal?>" id="tgl_awal" name="tgl_awal" type="text"></div>
                                        </div>
                                        <!-- // Group END -->
										<!-- Group -->
                                        <div class="form-group">
                                                <label class="col-md-4 control-label" for="tgl_akhir">Tgl Akhir Promo</label>
                                                <div class="col-md-8"><input class="form-control" value="<?=$Result_form->tgl_akhir?>" id="tgl_akhir" name="tgl_akhir" type="text"></div>
                                        </div>
                                        <!-- // Group END -->
										</div>
										<div id="no_promo">
											<!-- Group -->
											<div class="form-group">
													<label class="col-md-4 control-label" for="nm_promo">Judul Slide</label>
													<div class="col-md-8"><input class="form-control" value="<?=$Result_form->nm_promo?>" id="jdl_slide" name="jdl_slide" type="text"></div>
											</div>
											<!-- // Group END -->
										</div>
										<div id="category">
											<div class="form-group">
													<label class="col-md-4 control-label" for="idx_category">Kategori</label>
													<div class="col-md-8">
														<select class="form-control" name='idx_category' id='idx_category'>
															<?php
																$pc=explode("/",$Result_form->nm_promo);
																foreach($category_product->result() as $wc){
																	$selected="";
																	if($wc->idx_category==$pc[0]){
																		$selected="selected";
																	}
																	echo"<option ".$selected." value='".$wc->idx_category."/".str_replace(">","/",str_replace(" ","-",strtolower($wc->name)))."'>".$wc->name."</option>";
																}
															?>
														</select>
													</div>
											</div>
										</div>
										<!-- Group -->
                                        <div class="form-group">
                                                <label class="col-md-4 control-label" for="nm_promo"></label>
                                                <div class="col-md-8"><img src="<?=base_url()."uploads/promo_slide/".$Result_form->path_slide?>" style="width: 20em;height: 10em;" /><input value="<?=$Result_form->path_slide?>" id="path_slide_text" name="path_slide_text" type="hidden"></div>
                                        </div>
                                        <!-- // Group END -->
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
													<?php
														if($Result_form->position==1){
															echo'<option selected value=1>Slide</option>
															<option value=0>Banner Kecil</option>';
														}else{
															echo'<option value=1>Slide</option>
															<option selected value=0>Banner Kecil</option>';
														}
													?>
													</select>
												</div>
												<input type="hidden" name="position_old" value="<?=$Result_form->position?>"/>
                                        </div>
                                        <!-- // Group END -->
                                </div>
                                <!-- // Column END -->
                           </div>
                        <!-- // Row END -->
                        
                        <!-- Form actions -->
                        <div class="form-actions">
                                <button type="submit" class="btn btn-icon btn-primary glyphicons circle_ok"><i></i>Save</button>
								<?php if(($Result_form->idx_type_promo<>6)&&($Result_form->idx_type_promo<>7)){ ?>
								<button type="button" onClick="window.location='<?=site_url("promo/edit_product/".$Result_form->idx_promo)?>'" class="btn btn-icon btn-primary glyphicons circle_ok"><i></i>Edit Item Promo</button>
								<?php } ?>
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


