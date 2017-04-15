<!--Content-->
<div id="content">
<ul class="breadcrumb">
	<li><a href="#" class="glyphicons home">Home</a></li>
	<li class="divider"></li>
	<li>Setting</li>
	<li class="divider"></li>
	<li>Website</li>
</ul>
<div class="separator bottom"></div>
<div class="innerLR">
<div class="widget widget-tabs widget-tabs-double-2">
	<div class="widget-head">
		<ul>
			<li class="active"><a class="glyphicons display" href="#"><i></i><span>Setting Website</span></a></li>
			<li><a class="glyphicons shop" href="<?=site_url('setting/shop')?>"><i></i><span>Toko Online</span></a></li>
			<li><a class="glyphicons truck" href="<?=site_url('setting/shipping')?>"><i></i><span>Ongkos Kirim</span></a></li>
			<li><a class="glyphicons bank" href="<?=site_url('parameter/bank')?>"><i></i><span>Akun Bank</span></a></li>
			<li><a class="glyphicons chat" href="<?=site_url('setting/account')?>"><i></i><span>Akun Chat</span></a></li>
			<li><a class="glyphicons notes" href="<?=site_url('parameter/page')?>"><i></i><span>Page</span></a></li>
			<!--<li><a class="glyphicons link" href="<?=site_url('setting/page')?>"><i></i><span>Link Page</span></a></li>-->
		</ul>
	</div>
</div>
<form class="form-horizontal" id="form_input" method="POST" action="<?=site_url('setting/update/general')?>" enctype="multipart/form-data">
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
                                                <label class="col-md-4 control-label" for="site_title">Nama Website</label>
												<input name="idx_identitas" id="idx_identitas" value="<?=$idx_identitas?>" type="hidden">
                                                <div class="col-md-8"><input class="form-control" value="<?=$site_title_?>" id="site_title" name="site_title" type="text"></div>
                                        </div>
                                        <!-- // Group END -->
										  <!-- Group -->
                                        <div class="form-group">
                                                <label class="col-md-4 control-label" for="site_desc">Keterangan Website</label>
                                                <div class="col-md-8"><input class="form-control" value="<?=$site_desc?>" id="site_desc" name="site_desc" type="text"></div>
                                        </div>
                                        <!-- // Group END -->
										  <!-- Group -->
                                        <div class="form-group">
                                                <label class="col-md-4 control-label" for="email">Email</label>
                                                <div class="col-md-8"><input class="form-control" value="<?=$email?>" id="email" name="email" type="text"></div>
                                        </div>
                                        <!-- // Group END -->
										<!-- Group -->
                                        <div class="form-group">
                                                <label class="col-md-4 control-label" for="email">Logo</label>
                                                <div class="col-md-8">
													<?=$logo?>
													<br>
													<input type='file' name='logo' style="margin-top:5px;" />
													<input name="logo_img" id="logo_img" value="<?=$logo_img?>" type="hidden">
												</div>
                                        </div>
                                        <!-- // Group END -->
										<!-- Group -->
                                        <div class="form-group">
                                                <label class="col-md-4 control-label" for="hapus_logo"></label>
                                                <div class="col-md-8">
													<input name="hapus_logo" id="hapus_logo"  type="checkbox">Hapus Logo
												</div>
                                        </div>
                                        <!-- // Group END -->
										<!-- Group -->
                                        <div class="form-group">
                                                <label class="col-md-4 control-label" for="Favicon">Favicon</label>
                                                <div class="col-md-8">
													<?=$favicon?>
													<br>
													<input type='file' name='favicon' style="margin-top:5px;" />
													<input name="favicon_img" id="favicon_img" value="<?=$favicon_img?>" type="hidden">
												</div>
                                        </div>
                                        <!-- // Group END -->
										<!-- Group -->
                                        <div class="form-group">
                                                <label class="col-md-4 control-label" for="hapus_favicon"></label>
                                                <div class="col-md-8">
													<input name="hapus_favicon" id="hapus_favicon"  type="checkbox">Hapus Favicon
												</div>
                                        </div>
                                        <!-- // Group END -->
										<!-- Group -->
                                        <div class="form-group">
                                                <label class="col-md-4 control-label" for="Banner">Banner</label>
                                                <div class="col-md-8">
													<?=$banner?>
													<br>
													<input type='file' name='banner' style="margin-top:5px;" />
													<input name="banner" id="banner" value="<?=$banner_img?>" type="hidden">
												</div>
                                        </div>
										<!-- Group -->
                                        <div class="form-group">
                                                <label class="col-md-4 control-label" for="hapus_banner"></label>
                                                <div class="col-md-8">
													<input name="hapus_banner" id="hapus_banner"  type="checkbox">Hapus Banner
												</div>
                                        </div>
                                        <!-- // Group END -->
                                        <!-- // Group END -->
										<div class="form-group">
                                                <label class="col-md-4 control-label" for="facebook">Facebook</label>
                                                <div class="col-md-8"><input class="form-control" value="<?=$facebook?>" id="facebook" name="facebook" type="text"><p>Ex: facebook.com/shoplution</p></div>
                                        </div>
										<div class="form-group">
                                                <label class="col-md-4 control-label" for="twitter">Twitter</label>
                                                <div class="col-md-8"><input class="form-control" value="<?=$twitter?>" id="twitter" name="twitter" type="text"><p>Ex: twitter.com/shoplution</p></div>
                                        </div>
										<div class="form-group">
                                                <label class="col-md-4 control-label" for="youtube">Youtube</label>
                                                <div class="col-md-8"><input class="form-control" value="<?=$youtube?>" id="youtube" name="youtube" type="text"><p>Ex: youtube.com/user/shoplution</p></div>
                                        </div>
										<div class="form-group">
                                                <label class="col-md-4 control-label" for="gplus">Google+</label>
                                                <div class="col-md-8"><input class="form-control" value="<?=$gplus?>" id="gplus" name="gplus" type="text"><p>Ex: plus.google.com.com/shoplution</p></div>
                                        </div>
                                        <div class="form-group">
                                                <label class="col-md-4 control-label" for="keyword">SEO Keyword</label>
                                                <div class="col-md-8"><input class="form-control" value="<?=$keyword?>" id="keyword" name="keyword" type="text"><p>Ex: Toko online,Baju,Celana</p></div>
                                        </div>
                                        <div class="form-group">
                                                <label class="col-md-4 control-label" for="description">SEO Description</label>
                                                <div class="col-md-8"><input class="form-control" value="<?=$description?>" id="description" name="description" type="text"></div>
                                        </div>
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



