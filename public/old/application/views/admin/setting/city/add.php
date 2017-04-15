<!--Content-->
<div id="content">
<ul class="breadcrumb">
	<li><a href="#" class="glyphicons home">Home</a></li>
	<li class="divider"></li>
	<li>Setting</li>
	<li class="divider"></li>
	<li>Ongkos Kirim</li>
	<li class="divider"></li>
	<li>Tambah Daftar Kota</li>
</ul>
					<div class="widget widget-tabs widget-tabs-double-2">
						<div class="widget-head">
							<ul>
								<li><a class="glyphicons display" href="<?=site_url('setting/general')?>"><i></i><span>Setting Website</span></a></li>
								<li><a class="glyphicons shop" href="<?=site_url('setting/shop')?>"><i></i><span>Toko Online</span></a></li>
								<li class="active"><a class="glyphicons truck" href="#"><i></i><span>Ongkos Kirim</span></a></li>
								<li><a class="glyphicons bank" href="<?=site_url('parameter/bank')?>"><i></i><span>Akun Bank</span></a></li>
								<li><a class="glyphicons chat" href="<?=site_url('setting/account')?>"><i></i><span>Akun Chat</span></a></li>
								<li><a class="glyphicons notes" href="<?=site_url('parameter/page')?>"><i></i><span>Page</span></a></li>
								<!--<li><a class="glyphicons link" href="<?=site_url('setting/page')?>"><i></i><span>Link Page</span></a></li>-->
							</ul>
						</div>
					</div>
<div class="separator bottom"></div>
<div class="innerLR">

<form class="form-horizontal" id="form_input" method="POST" action="<?=site_url('setting/save/city')?>">
	<!-- Widget -->
        <div class="widget widget-gray widget-body-gray">
                <!-- Widget heading -->
                <div class="widget-head"><h4 class="heading">Tambah Daftar Kota</h4><a href="<?=site_url('setting/city')?>" style="float:right;margin-right: 1em;font-weight: bold;">Kembali</a></div>
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
                                                <label class="col-md-4 control-label" for="provinsi">Provinsi:</label>
                                                <div class="col-md-8"><input class="form-control" id="provinsi" name="provinsi" type="text"></div>
                                        </div>
                                        <!-- // Group END -->
                                       <!-- Group -->
                                        <div class="form-group">
                                                <label class="col-md-4 control-label" for="kota">Kota/Kabupaten:</label>
                                                <div class="col-md-8"><input class="form-control" id="kota" name="kota" type="text"></div>
                                        </div>
                                        <!-- // Group END -->
										 <!-- Group -->
                                        <div class="form-group">
                                                <label class="col-md-4 control-label" for="kec">Kecamatan:</label>
                                                <div class="col-md-8"><input class="form-control" id="kec" name="kec" type="text"></div>
                                        </div>
                                        <!-- // Group END -->
										 <!-- Group -->
                                        <div class="form-group">
                                                <label class="col-md-4 control-label" for="city_code">Kode Kota:</label>
                                                <div class="col-md-8"><input class="form-control" id="city_code" name="city_code" type="text"></div>
                                        </div>
                                        <!-- // Group END -->
										 <!-- Group -->
                                        <div class="form-group">
                                                <label class="col-md-4 control-label" for="zona">Zona:</label>
                                                <div class="col-md-8"><input class="form-control" id="zona" name="zona" type="text"></div>
                                        </div>
                                        <!-- // Group END -->
										
                                </div>
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

