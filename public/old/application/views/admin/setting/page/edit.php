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
<div class="col-md-12">
<div class="box">
	<div class="box-title">
		<h3><i class="icon-table"></i>Edit Page</h3>
			<div class="box-tool">
				<a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
			</div>
</div>
	<div class="box-content">
		<span id="ajax-status"></span>
        <span id="message"  ></span>
		<form id="form_input" action="<?=site_url('setting/update/page')?>" class="form-horizontal"  method="post">
			<div class="form-group">
				<label class="col-sm-3 col-lg-2 control-label" for="no_account">Judul</label>
				<div class="col-sm-6 col-lg-4 controls">
				<input name="idx_content_account" id="idx_content_account" value="<?=$Result_form->idx_content_account?>" class="form-control" type="hidden">
				<input name="judul" id="judul" value="<?=$Result_form->judul?>" class="form-control" type="text">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 col-lg-2 control-label">Content:</label>
				<div class="col-sm-9 col-lg-10 controls">
					<textarea class="form-control" rows="3" name='text_content' style='height:200px;'><?=$Result_form->text_content?></textarea>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 col-lg-2 control-label">Share</label>
				<div class="col-sm-9 col-lg-10 controls">
				<?php
					if($Result_form->fl_share==1){
						echo'<label class="radio-inline"><input type="radio" name="fl_share" value="1" checked> Yes</label>
						<label class="radio-inline"><input type="radio" name="fl_share" value="0">No</label>';
					}else{
						echo'<label class="radio-inline"><input type="radio" name="fl_share" value="1"> Yes</label>
						<label class="radio-inline"><input type="radio" name="fl_share" value="0" checked>No</label>';
					}
				?>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
					<input class="btn btn-primary" value="Submit" type="submit">
					<button type="button" class="btn">Cancel</button>
				</div>
			</div>
		</form>
	</div>
</div>
</div>


