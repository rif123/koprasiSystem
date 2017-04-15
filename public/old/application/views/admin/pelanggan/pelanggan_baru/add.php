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
		<h3><i class="icon-table"></i>Tambah Account</h3>
			<div class="box-tool">
				<a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
			</div>
</div>
	<div class="box-content">
		<span id="ajax-status"></span>
        <span id="message"  ></span>
		<form id="form_input" action="<?=site_url('setting/save/account')?>" class="form-horizontal"  method="post">
			<div class="form-group">
				<label class="col-sm-3 col-lg-2 control-label" for="type_account">Type Account:</label>
				<div class="col-sm-6 col-lg-4 controls">
					<select class="form-control" name="type_account" id="select">
					<?php
						foreach($type_account->result_array() as $res){
							echo'<option value="'.$res['code'].'">'.$res['nama'].'</option>';
						}
					?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 col-lg-2 control-label" for="no_account">Nama/No Account:</label>
				<div class="col-sm-6 col-lg-4 controls">
				<input name="no_account" id="no_account" class="form-control" type="text">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 col-lg-2 control-label">Keterangan:</label>
				<div class="col-sm-9 col-lg-10 controls">
					<textarea class="form-control" rows="3" name='keterangan'></textarea>
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


