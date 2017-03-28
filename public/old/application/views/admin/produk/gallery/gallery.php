<script>
$(document).ready(function() {
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
});
</script>
<!--Content-->
<div id="content">
<ul class="breadcrumb">
	<li><a href="#" class="glyphicons home">Home</a></li>
	<li class="divider"></li>
	<li>Galleri Produk</li>
	<li class="divider"></li>
	<li>Tambah Galleri Produk</li>
</ul>
<div class="separator bottom"></div>
<div class="innerLR">

<form class="form-horizontal" id="form_input" method="POST" action="<?=site_url('product/save/gallery/'.$idx_product)?>" enctype="multipart/form-data">
	<!-- Widget -->
        <div class="widget widget-gray widget-body-gray">
                <!-- Widget heading -->
                <div class="widget-head"><h4 class="heading">Tambah Galleri Produk</h4><a href="<?=site_url('product/edit/product/'.$idx_product)?>" style="float:right;padding: 0 10px;">Kembali</a></div>
                <!-- // Widget heading END -->
                <div class="widget-body">
                        <!-- Row -->
                        <div class="row">
						<span id="ajax-status"></span>
						<span id="message"  ></span>
                        <!-- Column -->
						<?php if($fill==0){ ?>
                                <div class="col-md-6">
                                        <!-- Group -->
                                        <div class="form-group">
                                                <label class="col-md-4 control-label" for="path_image1">Upload Gambar</label>
                                                <div class="col-md-8"><input class="form-control" id="path_image1" name="path_image1" type="file"></div>
                                        </div>
										 <div class="form-group">
                                                <label class="col-md-4 control-label" for="path_image2"></label>
                                                <div class="col-md-8"><input class="form-control" id="path_image2" name="path_image2" type="file"></div>
                                        </div>
										 <div class="form-group">
                                                <label class="col-md-4 control-label" for="path_image3"></label>
                                                <div class="col-md-8"><input class="form-control" id="path_image3" name="path_image3" type="file"></div>
                                        </div>
										 <div class="form-group">
                                                <label class="col-md-4 control-label" for="path_image4"></label>
                                                <div class="col-md-8"><input class="form-control" id="path_image4" name="path_image4" type="file"></div>
                                        </div>
                                        <!-- // Group END -->
                                </div>
						<?php } ?>
                        <!-- // Column END -->
						<!-- Column -->
						<?php if($fill==1){ ?>
                                <div class="col-md-6">
                                        <!-- Group -->
										<?php
											$n=0;
											foreach($gallery->result() as $wg){
												$title="";
												if($n==0){$title="Gambar Gallery";}
												echo'
													<div class="form-group">
															<label class="col-md-4 control-label" for="path_image'.$n.'">'.$title.'</label>
															<div class="col-md-8">
																<img src="'.base_url().'uploads/product/'.$wg->path_image.'" width="25%" height="25%"/><br>
																<a href="'.site_url('product/delete_gallery/'.$wg->idx_gallery.'/'.$wg->idx_product.'/'.$wg->path_image).'">Hapus</a>
															</div>
													</div>
												';
												$n++;
											}
											for($i=1;$i<4-$n+1;$i++){
												echo'
													 <div class="form-group">
															<label class="col-md-4 control-label" for="path_image'.$i.'"></label>
															<div class="col-md-8"><input class="form-control" id="path_image'.$i.'" name="path_image'.$i.'" type="file"></div>
													</div>
												';
											}
										?>
                                        <!-- // Group END -->
                                </div>
						<?php } ?>
                        <!-- // Column END -->
                        </div>
                        <!-- // Row END -->
                        
                        <!-- Form actions -->
                        <div class="form-actions">
                                <button type="submit" class="btn btn-icon btn-primary glyphicons circle_ok"><i></i>Save</button>
                                <button type="reset" class="btn btn-icon btn-default glyphicons circle_remove"><i></i>Reset</button>
                        </div>
                        <!-- // Form actions END -->
                        
                </div>
	

</div>
</form>
</div>
		
				<!-- End Wrapper -->
		</div>	



