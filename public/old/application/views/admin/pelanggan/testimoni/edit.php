<style>
.l{
width: 100%!important;
text-align: left!important;
}
</style>
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
		<h3><i class="icon-table"></i>Approve Testimonial</h3>
			<div class="box-tool">
				<a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
			</div>
</div>
	<div class="box-content">
		<span id="ajax-status"></span>
        <span id="message"  ></span>
		<form id="form_input" action="<?=site_url('pelanggan/testimoni_proses/')?>" class="form-horizontal"  method="post">
			<div class="form-group">
				<label class="col-sm-3 col-lg-2 control-label" for="type_account">Tgl Testimoni:</label>
				<div class="col-sm-6 col-lg-4 controls">
					<label class="col-sm-3 col-lg-2 control-label l" for="no_account"><?=DateToIndo($Result_form->tgl_testimon)?></label>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 col-lg-2 control-label" for="no_account">ID Pelanggan:</label>
				<div class="col-sm-6 col-lg-4 controls">
					<label class="col-sm-3 col-lg-2 control-label l" for="no_account"><?=$Result_form->id_pelanggan?></label>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 col-lg-2 control-label" for="no_account">Nama:</label>
				<div class="col-sm-6 col-lg-4 controls">
					<label class="col-sm-3 col-lg-2 control-label l" for="no_account"><?=$Result_form->full_name?></label>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 col-lg-2 control-label" for="no_account">Email:</label>
				<div class="col-sm-6 col-lg-4 controls">
					<label class="col-sm-3 col-lg-2 control-label l" for="no_account"><?=$Result_form->email?></label>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 col-lg-2 control-label">Isi Testimoni:</label>
				<div class="col-sm-9 col-lg-10 controls">
					<label class="col-sm-3 col-lg-2 control-label l" for="no_account"><?=$Result_form->testimoni?></label>
				</div>
			</div>
			<div class="form-group" id='box-feature'>
				
			</div>
			<input type='hidden' name='idx_testimoni' value="<?=$Result_form->idx_testimoni?>"/>
			<div class="form-group">
				<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
					<input class="btn btn-primary" value="Approve" name='send' type="submit"/>
					<input class="btn btn-primary" value="Tolak" name='send' type="submit"/>
				</div>
			</div>
		</form>
	</div>
</div>
</div>
<?php
function DateToIndo($date){  
			$BulanIndo = array("Januari", "Februari", "Maret",  
							   "April", "Mei", "Juni",  
							   "Juli", "Agustus", "September",  
							   "Oktober", "November", "Desember");  
		  
			$tahun = substr($date, 0, 4);  
			$bulan = substr($date, 5, 2);  
			$tgl   = substr($date, 8, 2);  
			  
			$result = $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun;       
			return($result);  
		}
?>

