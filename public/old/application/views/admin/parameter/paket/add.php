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
		<h3>Tambah Paket</h3>
			<div class="box-tool">
				<a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
			</div>
</div>
	<div class="box-content">
		<span id="ajax-status"></span>
        <span id="message"  ></span>
		<form id="form_input" action="<?=site_url('parameter/save/paket')?>" class="form-horizontal" enctype="multipart/form-data"  method="post">
			<div class="form-group">
				<label class="col-sm-3 col-lg-2 control-label" for="no_account">Kode Jenis Paket</label>
				<div class="col-sm-6 col-lg-4 controls">
				<input name="code" id="code" class="form-control" type="text">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 col-lg-2 control-label">Nama Jenis Paket</label>
				<div class="col-sm-6 col-lg-4 controls">
					<input name="nm_paket" id="nm_paket" class="form-control" type="text">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 col-lg-2 control-label">Durasi Berlangganan(/Bulan)</label>
				<div class="col-sm-6 col-lg-4 controls">
					<input name="minimal_durasi" id="minimal_durasi" class="form-control" type="text">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 col-lg-2 control-label">Harga/Bulan</label>
				<div class="col-sm-6 col-lg-4 controls">
					<input name="harga" id="harga" class="form-control" type="text">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 col-lg-2 control-label">Feature</label>
				<div class="col-sm-6 col-lg-4 controls" id="box-feature">
					<input name="feature[]" id="feature" class="form-control" type="text">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 col-lg-2 control-label"></label>
				<div class="col-sm-6 col-lg-4 controls">
					<input type="button" onClick="add_element()"  value="Tambah Feature"/>
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
<script>
	function add_element(){
		$("#box-feature").append('<br><input name="feature[]" id="feature" class="form-control" type="text">');	
	}
</script>

