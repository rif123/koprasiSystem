<!--Content-->
<div id="content">
<ul class="breadcrumb">
	<li><a href="#" class="glyphicons home">Home</a></li>
	<li class="divider"></li>
	<li>Baca Pesan</li>
</ul>
<div class="separator bottom"></div>
<div class="innerLR">

<form class="form-horizontal" id="form_input" method="POST" action="<?=site_url('pelanggan/balas/'.$Result_form->idx_message)?>" enctype="multipart/form-data">
	<!-- Widget -->
        <div class="widget widget-gray widget-body-gray">
                <!-- Widget heading -->
                <div class="widget-head"><h4 class="heading">Pesan Dari <?=$Result_form->nama?>(<?=$Result_form->email?>)</h4></div>
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
                                                <label class="col-md-4 control-label" for="Nama">Nama</label>
                                                <div class="col-md-8">
													<label class="col-md-4 control-label" style="font-weight:normal;width: 180px;text-align: left;" for="Nama"><?=$Result_form->nama?></label>
												</div>
                                        </div>
                                        <!-- // Group END -->
										<!-- Group -->
                                        <div class="form-group">
                                                <label class="col-md-4 control-label" for="Email">Email</label>
                                                <div class="col-md-8">
													<label class="col-md-4 control-label" style="font-weight:normal;width: 180px;text-align: left;" for="Email"><?=$Result_form->email?></label>
												</div>
                                        </div>
                                        <!-- // Group END -->
										<!-- Group -->
                                        <div class="form-group">
                                                <label class="col-md-4 control-label" for="Judul Pesan">Judul Pesan</label>
                                                <div class="col-md-8">
													<label class="col-md-4 control-label" style="font-weight:normal;width: 180px;text-align: left;" for="Judul Pesan"><?=$Result_form->judul_pesan?></label>
												</div>
                                        </div>
                                        <!-- // Group END -->
										<!-- Group -->
                                        <div class="form-group">
                                                <label class="col-md-4 control-label" for="Isi Pesan">Isi Pesan</label>
                                                <div class="col-md-8">
													<label class="col-md-4 control-label" style="font-weight:normal;width: 180px;text-align: left;" for="Isi Pesan"><?=$Result_form->isi_pesan?></label>
												</div>
												<input type='hidden' name='email' value="<?=$Result_form->email?>"/>
												<input type='hidden' name='idx_message' value="<?=$Result_form->idx_message?>"/>
												<input type='hidden' name='nama' value="<?=$Result_form->nama?>"/>
												<input type='hidden' name='judul_pesan' value="<?=$Result_form->judul_pesan?>"/>
                                        </div>
                                        <!-- // Group END -->
										<!-- Group -->
                                        <div class="form-group">
                                                <label class="col-md-4 control-label" for="Judul Pesan"></label>
                                                <div class="col-md-8" id="box-feature">
													
												</div>
                                        </div>
                                        <!-- // Group END -->
                                </div>
                                <!-- // Column END -->
                           </div>
                        <!-- // Row END -->
                        <!-- Form actions -->
                        <div class="form-actions">
                                <button type="button" class="btn btn-icon btn-primary glyphicons circle_ok" id='balas' onClick="add_element()" ><i></i>Balas</button>
								<button class="btn btn-icon btn-primary glyphicons circle_ok" id='kirim' type="submit" style='display:none;'><i></i>Kirim</button>
                        </div>
                        <!-- // Form actions END -->
                        
                </div>
	

</div>
</form>
</div>
		
				<!-- End Wrapper -->
</div>
<script>
	function add_element(){
		$("#balas").hide();
		$("#kirim").show();
		$("#box-feature").append('<div class="col-md-8"><textarea class="form-control" rows="3" name="balas_pesan" style="width: 30em;height: 10em;" ></textarea></div>');	
	}
</script>


