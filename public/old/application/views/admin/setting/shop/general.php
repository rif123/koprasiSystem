<!--Content-->
<div id="content">
<ul class="breadcrumb">
	<li><a href="#" class="glyphicons home">Home</a></li>
	<li class="divider"></li>
	<li>Setting</li>
	<li class="divider"></li>
	<li>Toko Online</li>
</ul>
<div class="separator bottom"></div>
<div class="innerLR">
<div class="widget widget-tabs widget-tabs-double-2">
	<div class="widget-head">
		<ul>
			<li><a class="glyphicons display" href="<?=site_url('setting/general')?>"><i></i><span>Setting Website</span></a></li>
			<li class="active"><a class="glyphicons shop" href="#"><i></i><span>Toko Online</span></a></li>
			<li><a class="glyphicons truck" href="<?=site_url('setting/shipping')?>"><i></i><span>Ongkos Kirim</span></a></li>
			<li><a class="glyphicons bank" href="<?=site_url('parameter/bank')?>"><i></i><span>Akun Bank</span></a></li>
			<li><a class="glyphicons chat" href="<?=site_url('setting/account')?>"><i></i><span>Akun Chat</span></a></li>
			<li><a class="glyphicons notes" href="<?=site_url('parameter/page')?>"><i></i><span>Page</span></a></li>
			<!--<li><a class="glyphicons link" href="<?=site_url('setting/page')?>"><i></i><span>Link Page</span></a></li>-->
		</ul>
	</div>
</div>
<form class="form-horizontal" id="form_input" method="POST" action="<?=site_url('setting/'.$action.'/shop')?>" enctype="multipart/form-data">
	<!-- Widget -->
        <div class="widget widget-gray widget-body-gray">
                <div class="widget-body">
                        <!-- Row -->
                        <div class="row">
						<span id="ajax-status"></span>
						<span id="message"  ></span>
                        <!-- Column -->
                                <div class="col-md-6">
                                        <!-- Group -->
                                        <div class="form-group">
                                                <label class="col-md-4 control-label" for="nm_toko">Nama Toko</label>
												<input name="idx_setting_toko" id="idx_setting_toko" value="<?=$idx_setting_toko?>" type="hidden">
                                                <div class="col-md-8"><input class="form-control" value="<?=$nm_toko?>" id="nm_toko" name="nm_toko" type="text"></div>
                                        </div>
                                        <!-- // Group END -->
										  <!-- Group -->
                                        <div class="form-group">
                                                <label class="col-md-4 control-label" for="alamat">Alamat</label>
                                                <div class="col-md-8">
													<input type id="alamat" name="alamat" class="form-control" value="<?=$alamat?>">
												</div>
                                        </div>
                                        <!-- // Group END -->
										  <!-- Group -->
                                        <div class="form-group">
                                                <label class="col-md-4 control-label" for="kota">Kota</label>
                                                <div class="col-md-8"><input class="form-control" value="<?=$kota?>" id="kota" name="kota" type="text"></div>
                                        </div>
                                        <!-- // Group END -->
										 <!-- Group -->
                                        <div class="form-group">
                                                <label class="col-md-4 control-label" for="telp">Telepon</label>
                                                <div class="col-md-8"><input class="form-control" value="<?=$telp?>" id="telp" name="telp" type="text"></div>
                                        </div>
                                        <!-- // Group END -->
										<?php if(($this->session->userdata('user_name')=='sadmin')){ ?>
                                        <div class="form-group">
                                                <label class="col-md-4 control-label" for="out_of_stock">Menggunakan Ongkos Kirim</label>
                                                <div class="col-md-8">
													<?php if($fl_ongkir==1){
														echo'
														<input type="radio" value="1" checked name="fl_ongkir" /> Ya &nbsp;&nbsp;&nbsp;
														<input type="radio" value="0" name="fl_ongkir" />Tidak';
													}else{
														echo'
														<input type="radio" value="1" name="fl_ongkir" /> Ya &nbsp;&nbsp;&nbsp;
														<input type="radio" value="0" checked name="fl_ongkir" />Tidak';
													}
												?>
												</div>
                                        </div>
										<?php } ?>
										<div class="form-group">
                                                <label class="col-md-4 control-label" for="out_of_stock">Pengembalian Barang</label>
                                                <div class="col-md-8">
													<?php if($fl_refund==1){
														echo'
														<input type="radio" value="1" checked name="fl_refund" /> Ya &nbsp;&nbsp;&nbsp;
														<input type="radio" value="0" name="fl_refund" />Tidak';
													}else{
														echo'
														<input type="radio" value="1" name="fl_refund" /> Ya &nbsp;&nbsp;&nbsp;
														<input type="radio" value="0" checked name="fl_refund" />Tidak';
													}
												?>
												</div>
                                        </div>
										<?php if(($this->session->userdata('user_name')=='sadmin')){ ?>
                                        <div class="form-group">
                                                <label class="col-md-4 control-label" for="out_of_stock">Tampilkan Logo Rekomendasi</label>
                                                <div class="col-md-8">
													<?php if($fl_secure==1){
														echo'
														<input type="radio" value="1" checked name="fl_secure" /> Ya &nbsp;&nbsp;&nbsp;
														<input type="radio" value="0" name="fl_secure" />Tidak';
													}else{
														echo'
														<input type="radio" value="1" name="fl_secure" /> Ya &nbsp;&nbsp;&nbsp;
														<input type="radio" value="0" checked name="fl_secure" />Tidak';
													}
												?>
												</div>
                                        </div>
										<?php } ?>
										
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


