<!--Content-->
<div id="content">
<ul class="breadcrumb">
	<li><a href="#" class="glyphicons home">Home</a></li>
	<li class="divider"></li>
	<li>Setting</li>
	<li class="divider"></li>
	<li>Ongkos Kirim</li>
	<li class="divider"></li>
	<li>Tambah Ongkos Kirim</li>
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

<form class="form-horizontal" id="form_input" method="POST" action="<?=site_url('setting/save/shipping')?>">
	<!-- Widget -->
        <div class="widget widget-gray widget-body-gray">
                <!-- Widget heading -->
                <div class="widget-head"><h4 class="heading">Tambah Ongkos Kirim</h4><a href="<?=site_url('setting/shipping')?>" style="float:right;margin-right: 1em;font-weight: bold;">Kembali</a></div>
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
                                                <label class="col-md-4 control-label" for="city_code">Kode Kota</label>
                                                <div class="col-md-8"> 
													<input class="form-control" id="city_code" style="width:50%;" name="city_code" type="text">
												</div>
                                        </div>
                                        <!-- // Group END -->
                                        
                                        <!-- Group -->
                                        <div class="form-group">
                                                <label class="col-md-4 control-label" for="a_reg">Ongkir Zona A Reguler:</label>
                                                <div class="col-md-8"><input class="form-control" id="a_reg" name="a_reg" type="text"></div>
                                        </div>
                                        <!-- // Group END -->
										 <!-- Group -->
                                        <div class="form-group">
                                                <label class="col-md-4 control-label" for="a_oke">Ongkir Zona A OKE:</label>
                                                <div class="col-md-8"><input class="form-control" id="a_oke" name="a_oke" type="text"></div>
                                        </div>
                                        <!-- // Group END -->
										 <!-- Group -->
                                        <div class="form-group">
                                                <label class="col-md-4 control-label" for="a_yes">Ongkir Zona A YES:</label>
                                                <div class="col-md-8"><input class="form-control" id="a_yes" name="a_yes" type="text"></div>
                                        </div>
                                        <!-- // Group END -->
										 <!-- Group -->
                                        <div class="form-group">
                                                <label class="col-md-4 control-label" for="b_reg">Ongkir Zona B Reguler:</label>
                                                <div class="col-md-8"><input class="form-control" id="b_reg" name="b_reg" type="text"></div>
                                        </div>
                                        <!-- // Group END -->
										 <!-- Group -->
                                        <div class="form-group">
                                                <label class="col-md-4 control-label" for="b_oke">Ongkir Zona B OKE:</label>
                                                <div class="col-md-8"><input class="form-control" id="b_oke" name="b_oke" type="text"></div>
                                        </div>
                                        <!-- // Group END -->
										 <!-- Group -->
                                        <div class="form-group">
                                                <label class="col-md-4 control-label" for="b_yes">Ongkir Zona B YES:</label>
                                                <div class="col-md-8"><input class="form-control" id="b_yes" name="b_yes" type="text"></div>
                                        </div>
                                        <!-- // Group END -->
										
                                </div>
                                <!-- // Column END -->
								<div class="col-md-6">
									 <!-- Group -->
                                        <div class="form-group">
                                                <label class="col-md-4 control-label" for="c_reg">Ongkir Zona C Reguler:</label>
                                                <div class="col-md-8"><input class="form-control" id="c_reg" name="c_reg" type="text"></div>
                                        </div>
                                        <!-- // Group END -->
										 <!-- Group -->
                                        <div class="form-group">
                                                <label class="col-md-4 control-label" for="c_oke">Ongkir Zona C OKE:</label>
                                                <div class="col-md-8"><input class="form-control" id="c_oke" name="c_oke" type="text"></div>
                                        </div>
                                        <!-- // Group END -->
										 <!-- Group -->
                                        <div class="form-group">
                                                <label class="col-md-4 control-label" for="c_yes">Ongkir Zona C YES:</label>
                                                <div class="col-md-8"><input class="form-control" id="c_yes" name="c_yes" type="text"></div>
                                        </div>
                                        <!-- // Group END -->
										 <!-- Group -->
                                        <div class="form-group">
                                                <label class="col-md-4 control-label" for="d_reg">Ongkir Zona D Reguler:</label>
                                                <div class="col-md-8"><input class="form-control" id="d_reg" name="d_reg" type="text"></div>
                                        </div>
                                        <!-- // Group END -->
										 <!-- Group -->
                                        <div class="form-group">
                                                <label class="col-md-4 control-label" for="d_oke">Ongkir Zona D OKE:</label>
                                                <div class="col-md-8"><input class="form-control" id="d_oke" name="d_oke" type="text"></div>
                                        </div>
                                        <!-- // Group END -->
										 <!-- Group -->
                                        <div class="form-group">
                                                <label class="col-md-4 control-label" for="d_yes">Ongkir Zona D YES:</label>
                                                <div class="col-md-8"><input class="form-control" id="d_yes" name="d_yes" type="text"></div>
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

