<!--Content-->
<div id="content">
<ul class="breadcrumb">
	<li><a href="#" class="glyphicons home">Home</a></li>
	<li class="divider"></li>
	<li>Kategori</li>
	<li class="divider"></li>
	<li>Edit Kategori</li>
</ul>
<div class="separator bottom"></div>
<div class="innerLR">

<form class="form-horizontal" id="form_input" method="POST" action="<?=site_url('product/update/category')?>" enctype="multipart/form-data">
	<!-- Widget -->
        <div class="widget widget-gray widget-body-gray">
                <!-- Widget heading -->
                <div class="widget-head"><h4 class="heading">Edit Kategori</h4></div>
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
                                                <label class="col-md-4 control-label" for="nm_categrory_product">Nama Kategori</label>
                                                <div class="col-md-8"><input class="form-control" id="nm_categrory_product" value='<?=$Result_form->nm_categrory_product?>' name="nm_categrory_product" type="text"></div>
												<input class="form-control" id="idx_category_product" value='<?=$Result_form->idx_category_product?>' name="idx_category_product" type="hidden">
										</div>
                                        <!-- // Group END -->
                                        
                                        <!-- Group -->
                                        <div class="form-group">
                                                <label class="col-md-4 control-label" for="parent">Parent Kategori</label>
                                                 <div class="col-md-8">
                                                    <select class="col-md-12 form-control" name='parent'>
													<?php
													echo $product->get_category_path($Result_form->parent);
													foreach($category_product->result() as $r){
														echo'<option value="'.$r->idx_category.'">'.$r->name.'</option>';
														
													}
													?>
                                                    </select>
												</div>
                                                
                                        </div>
                                        <!-- // Group END -->
										<!-- Group -->
                                        <div class="form-group">
                                                <label class="col-md-4 control-label" for="tag_desc">SEO Description </label>
                                                <div class="col-md-8"><textarea class="form-control"  id="tag_desc" name="tag_desc"><?=$Result_form->tag_desc?></textarea></div>
                                        </div>
                                        <!-- // Group END -->
										<!-- Group -->
                                        <div class="form-group">
                                                <label class="col-md-4 control-label" for="tag_key">SEO Keyword </label>
                                                <div class="col-md-8"><textarea class="form-control"  id="tag_key" name="tag_key"><?=$Result_form->tag_key?></textarea></div>
                                        </div>
                                        <!-- // Group END -->
										<div class="form-group">
                                                <label class="col-md-4 control-label" for="stock">Gambar Kategori</label>
												
											   <div class="col-md-8">
											   <?php if($Result_form->image){
												echo'<img src="'.base_url().'uploads/product/'.$Result_form->image.'"/>';
											   }
											   ?>
											   <input type='hidden' name='image_text' value="<?=$Result_form->image?>" />
											   <input type='file' style='margin: 1em 0;'  name='image'><p style='color:#F1050E;margin-top:5px;'>Max 100Kb Ext: JPG,PNG,GIF </p>
											   </div>
                                        </div>
                                        
                                </div>
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

