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
		<h3><i class="icon-table"></i>Edit Tipe Perusahaan</h3>
			<div class="box-tool">
				<a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
			</div>
</div>
	<div class="box-content">
		<span id="ajax-status"></span>
        <span id="message"  ></span>
		<form id="form_input" action="<?=site_url('parameter/update/type_perusahaan')?>" class="form-horizontal"  method="post">
			<div class="form-group">
				<label class="col-sm-3 col-lg-2 control-label" for="no_account">Kode Tipe Perusahaan</label>
				<div class="col-sm-6 col-lg-4 controls">
				<input name="idx_type_company" id="idx_type_company" class="form-control" value="<?=$Result_form->idx_type_company?>" type="hidden" readonly>
				<input name="code" id="code" class="form-control" value="<?=$Result_form->code?>" type="text" readonly>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 col-lg-2 control-label">Nama Tipe Perusahaan</label>
				<div class="col-sm-6 col-lg-4 controls">
					<input name="nama" id="nama" class="form-control" value="<?=$Result_form->nama?>" type="text">
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


