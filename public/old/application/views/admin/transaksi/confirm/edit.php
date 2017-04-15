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
		<h3><i class="icon-table"></i>Verifikasi Pembayaran</h3>
			<div class="box-tool">
				<a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
			</div>
</div>
	<div class="box-content">
		<span id="ajax-status"></span>
        <span id="message"  ></span>
		<form id="form_input" action="<?=site_url('order/update/confirm')?>" class="form-horizontal"  method="post">
			<div class="form-group">
				<label class="col-sm-3 col-lg-2 control-label" for="type_account">TGL Konfirmasi</label>
				<div class="col-sm-6 col-lg-4 controls">
					<input name="id_pesanan" id="id_pesanan" value="<?=$Result_form->id_pesanan?>" class="form-control" type="hidden">
					<input name="idx_pay_confirm" id="idx_pay_confirm" value="<?=$Result_form->idx_pay_confirm?>" class="form-control" type="hidden">
					<label class="col-sm-3 col-lg-2 control-label l" for="no_account"><?=DateToIndo($Result_form->tgl_konfirmasi)?></label>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 col-lg-2 control-label" for="no_account">No Transaksi:</label>
				<div class="col-sm-6 col-lg-4 controls">
					<label class="col-sm-3 col-lg-2 control-label l" for="no_account"><?=$Result_form->id_pesanan?></label>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 col-lg-2 control-label" for="no_account">Bank Tujuan:</label>
				<div class="col-sm-6 col-lg-4 controls">
					<label class="col-sm-3 col-lg-2 control-label l" for="no_account"><?=$Result_form->nm_bank?></label>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 col-lg-2 control-label">Bank Pengirim:</label>
				<div class="col-sm-9 col-lg-10 controls">
					<label class="col-sm-3 col-lg-2 control-label l" for="no_account"><?=$Result_form->user_acc?></label>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 col-lg-2 control-label">No Rekening Pengirim:</label>
				<div class="col-sm-9 col-lg-10 controls">
					<label class="col-sm-3 col-lg-2 control-label l" for="no_account"><?=$Result_form->nm_acc?></label>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 col-lg-2 control-label">Total Pembayaran:</label>
				<div class="col-sm-9 col-lg-10 controls">
					<label class="col-sm-3 col-lg-2 control-label l" for="no_account"><?="Rp. ".number_format($Result_form->total_pembayaran,0,',','.')?></label>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 col-lg-2 control-label">Bukti Pembayaran</label>
				<div class="col-sm-9 col-lg-10 controls">
						<a href="<?=base_url()."uploads/confirm_payment/".$Result_form->bukti_pembayaran?>" target='_blank' ><img src="<?=base_url()."uploads/confirm_payment/".$Result_form->bukti_pembayaran?>" style="width:50%;" /></a>
						<br>
						<br>
						<a href="<?=base_url()."uploads/confirm_payment/".$Result_form->bukti_pembayaran?>" target='_blank'>Download</a>
				</div>
			</div>
			<br>
			<div class="form-group">
				<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
					<input class="btn btn-primary" name='proses' value="Sahkan" type="submit">
					<input class="btn btn-primary" name='proses' value="Tolak" type="submit">
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

