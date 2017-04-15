<script type="text/javascript" src="<?=$assets?>js/admin/jquery-ui.js"></script><link rel="stylesheet" href="<?=$assets?>css/admin/jquery-ui-1.8.4.custom.css" class="skin-color"><!--Content-->
<div id="content">
<ul class="breadcrumb">
	<li><a href="#">Home</a></li>
			<li class="divider"></li>
			<li>Konfirmasi Terbaru</li>
			<li class="divider"></li>
			<li>Konfirmasi Pembayaran Manual</li>
</ul>
	<div class="widget widget-tabs widget-tabs-double-2">
		<div class="widget-head">
			<ul>
				<li class="active"><a class="glyphicons coins" href="<?=site_url('order/confirm')?>"><i></i><span>Konfirmasi Terbaru</span></a></li>
				<li><a class="glyphicons coins" href="<?=site_url('order/confirm/valid')?>"><i></i><span>Riwayat Konfirmasi</span></a></li>
			</ul>
		</div>
	</div>
<div class="separator bottom"></div>
<div class="innerLR">
<form class="form-horizontal" id="form_input" method="POST" action="<?=site_url('order/save')?>">
	<!-- Widget -->
        <div class="widget widget-gray widget-body-gray">
                <!-- Widget heading -->
                <div class="widget-head"><h4 class="heading">Konfirmasi Pembayaran Manual</h4></div>
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
                                                <label class="col-md-4 control-label" for="id_pesanan">No Transaksi</label>
                                                <div class="col-md-8"><input class="form-control" id="id_pesanan" name="id_pesanan" type="text"></div>
                                        </div>
                                        <!-- // Group END -->
                                        <!-- Group -->
                                        <div class="form-group">
                                                <label class="col-md-4 control-label" for="total_pembayaran">Total Tagihan</label>
                                                <div class="col-md-8"><input class="form-control" id="total_pembayaran" name="total_pembayaran" type="text"></div>
                                        </div>
                                        <!-- // Group END -->																				  <!-- Group -->                                        <div class="form-group">                                                <label class="col-md-4 control-label" for="total_pembayaran">Tgl Transfer</label>                                                <div class="col-md-8"><input class="form-control" id="tgl_transfer" name="tgl_transfer" type="text"></div>                                        </div>                                        <!-- // Group END -->
                                        <!-- Group -->
                                        <div class="form-group">
                                                <label class="col-md-4 control-label" for="atas_nama">Transfer Ke</label>
                                                <div class="col-md-8">
													<select name="idx_rek" class="form-control">
														<?php
															foreach($rek->result() as $wr){
																echo"<option value='".$wr->idx_account_bank."'>".$wr->nm_bank."</option>";
															}
														?>
													</select>
												</div>
                                        </div>
                                        <!-- // Group END -->
                                        
                                        <!-- Group -->
                                        <div class="form-group">
                                                <label class="col-md-4 control-label" for="user_bank">Bank Pengirim</label>
                                                <div class="col-md-8"><input class="form-control" id="user_bank" name="user_bank" type="text"></div>
                                        </div>
                                        <!-- // Group END -->
										<!-- Group -->
                                        <div class="form-group">
                                                <label class="col-md-4 control-label" for="user_acc">No Rekening Pengirim</label>
                                                <div class="col-md-8"><input class="form-control" id="user_acc" name="user_acc" type="text"></div>
                                        </div>
                                        <!-- // Group END -->
										<!-- Group -->
                                        <div class="form-group">
                                                <label class="col-md-4 control-label" for="nm_acc">Atas Nama</label>
                                                <div class="col-md-8"><input class="form-control" id="nm_acc" name="nm_acc" type="text"></div>
                                        </div>
                                        <!-- // Group END -->
                                        
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
$(document).ready(function() {		$("#tgl_transfer").datepicker({dateFormat: 'yy-mm-dd'});
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
		$("#id_pesanan").blur(function(){
			$.ajax({
				url: '<?=site_url('order/get_total')?>',
				data: $('#form_input').serialize(),
				type: "POST",
				dataType: 'json',
				success: function (data) {
					$("#total_pembayaran").val(data);
				}
			});
		});
});
</script>

