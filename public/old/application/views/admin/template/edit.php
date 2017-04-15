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
		$(this).html('processing...');
	});
	$('#ajax-status').ajaxSuccess(function(){
		$(this).hide();
	});
});
</script>
<div class="col-md-12">
<div class="box">
	<div class="box-title">
		<h3><i class="icon-table"></i>Edit Template</h3>
			<div class="box-tool">
				<a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
			</div>
</div>
	<div class="box-content">
		<span id="ajax-status"></span>
        <span id="message"  ></span>
		<form id="form_input" action="<?=site_url('template/update')?>" class="form-horizontal"  method="post">
			<div class="form-group">
				<label class="col-sm-3 col-lg-2 control-label" for="no_account">Nama Template:</label>
				<div class="col-sm-6 col-lg-4 controls">
				<input name="idx_template" id="idx_template" value="<?=$Result_form->idx_template?>" class="form-control" type="hidden">
				<input name="nm_template" id="nm_template" value="<?=$Result_form->nm_template?>" class="form-control" type="text">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 col-lg-2 control-label" for="no_account">Paket Template</label>
				<div class="col-sm-6 col-lg-4 controls">
					<select class="form-control" name="code_paket" id="code_paket">
						<?php
							foreach($tb_paket->result() as $w){
								$selected="";
								if($Result_form->code_paket==$w->code){
									$selected="selected";
								}
								echo"<option ".$selected." value='".$w->code."'>".$w->nm_paket."</option>";
							}
						?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 col-lg-2 control-label">Screenshot(jpg,png, max 1Mb)</label>
				<div class="col-sm-9 col-lg-10 controls">
					<div class="fileupload fileupload-new" data-provides="fileupload">
						<div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;">
							<img src="<?=base_url()?>uploads/template/<?=$Result_form->thumb?>" style='width:100%;height:100%;'/>
						</div>
						<input name="screenshot_old" id="screenshot_old" value="<?=$Result_form->screenshot?>" class="form-control" type="hidden">
						<input name="thumb_old" id="thumb_old" value="<?=$Result_form->thumb?>" class="form-control" type="hidden">
					</div>
					<br>
					<input type="file" name='screenshot' class="form-control">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 col-lg-2 control-label">Keterangan</label>
				<div class="col-sm-9 col-lg-10 controls">
					<textarea class="form-control" rows="3" name='description' style='height:200px;'><?=$Result_form->description?></textarea>
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


