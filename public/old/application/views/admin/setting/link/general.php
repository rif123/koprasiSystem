<!--Content-->
<div id="content">
<ul class="breadcrumb">
	<li><a href="#" class="glyphicons home">Home</a></li>
	<li class="divider"></li>
	<li>Setting</li>
	<li class="divider"></li>
	<li>Link Page</li>
</ul>
<div class="separator bottom"></div>
<div class="innerLR">
<div class="widget widget-tabs widget-tabs-double-2">
	<div class="widget-head">
		<ul>
			<li><a class="glyphicons display" href="<?=site_url('setting/general')?>"><i></i><span>Setting Website</span></a></li>
			<li><a class="glyphicons shop" href="<?=site_url('setting/shop')?>"><i></i><span>Toko Online</span></a></li>
			<li><a class="glyphicons truck" href="<?=site_url('setting/shipping')?>"><i></i><span>Ongkos Kirim</span></a></li>
			<li><a class="glyphicons bank" href="<?=site_url('parameter/bank')?>"><i></i><span>Akun Bank</span></a></li>
			<li><a class="glyphicons chat" href="<?=site_url('setting/account')?>"><i></i><span>Akun Chat</span></a></li>
			<li><a class="glyphicons notes" href="<?=site_url('parameter/page')?>"><i></i><span>Page</span></a></li>
			<li class="active"><a class="glyphicons link" href="#"><i></i><span>Link Page</span></a></li>
		</ul>
	</div>
</div>
<form class="form-horizontal" id="form_input" method="POST" action="<?=site_url('setting/'.$action.'/page')?>" enctype="multipart/form-data">
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
                                                <label class="col-md-4 control-label" for="nm_toko">Tentang Kami</label>
												<input name="idx_link" id="idx_link" value="<?=$idx_link?>" type="hidden">
                                                <div class="col-md-8">
													<select class="col-md-12 form-control" name='about_us'>
													<option selected value=0>--Pilih--</option>
													<?php
													foreach($page->result() as $r){
														$selected='';
														if(($about_us!=0)||($about_us)){
															if($r->idx_page==$about_us){
																$selected='selected';
															}
														}
															echo'<option '.$selected.' value="'.$r->idx_page.'">'.$r->nm_page.'</option>';
													}
													?>
                                                    </select>
												</div>
                                        </div>
                                        <!-- // Group END -->	
										<!-- Group -->
                                        <div class="form-group">
                                                <label class="col-md-4 control-label" for="nm_toko">Hubungi Kami</label>
                                                <div class="col-md-8">
													<select class="col-md-12 form-control" name='contact_us'>
													<option selected value=0>--Pilih--</option>
													<?php
													foreach($page->result() as $r){
														$selected='';
														if(($contact_us!=0)||($contact_us)){
															if($r->idx_page==$contact_us){
																$selected='selected';
															}
														}
															echo'<option '.$selected.' value="'.$r->idx_page.'">'.$r->nm_page.'</option>';
													}
													?>
                                                    </select>
												</div>
                                        </div>
                                        <!-- // Group END -->	
<!-- Group -->
                                        <div class="form-group">
                                                <label class="col-md-4 control-label" for="nm_toko">Panduan Ukuran</label>
                                                <div class="col-md-8">
													<select class="col-md-12 form-control" name='panduan_ukuran'>
													<option selected value=0>--Pilih--</option>
													<?php
													foreach($page->result() as $r){
														$selected='';
														if(($panduan_ukuran!=0)||($panduan_ukuran)){
															if($r->idx_page==$panduan_ukuran){
																$selected='selected';
															}
														}
															echo'<option '.$selected.' value="'.$r->idx_page.'">'.$r->nm_page.'</option>';
													}
													?>
                                                    </select>
												</div>
                                        </div>
                                        <!-- // Group END -->	
<!-- Group -->
                                        <div class="form-group">
                                                <label class="col-md-4 control-label" for="nm_toko">Tata Cara Belanja</label>
                                                <div class="col-md-8">
													<select class="col-md-12 form-control" name='tata_cara_belanja'>
													<option selected value=0>--Pilih--</option>
													<?php
													foreach($page->result() as $r){
														$selected='';
														if(($tata_cara_belanja!=0)||($tata_cara_belanja)){
															if($r->idx_page==$tata_cara_belanja){
																$selected='selected';
															}
														}
															echo'<option '.$selected.' value="'.$r->idx_page.'">'.$r->nm_page.'</option>';
													}
													?>
                                                    </select>
												</div>
                                        </div>
                                        <!-- // Group END -->		
<!-- Group -->
                                        <div class="form-group">
                                                <label class="col-md-4 control-label" for="nm_toko">FAQ</label>
                                                <div class="col-md-8">
													<select class="col-md-12 form-control" name='faq'>
													<option selected value=0>--Pilih--</option>
													<?php
													foreach($page->result() as $r){
														$selected='';
														if(($faq!=0)||($faq)){
															if($r->idx_page==$faq){
																$selected='selected';
															}
														}
															echo'<option '.$selected.' value="'.$r->idx_page.'">'.$r->nm_page.'</option>';
													}
													?>
                                                    </select>
												</div>
                                        </div>
                                        <!-- // Group END -->	
<!-- Group -->
                                        <div class="form-group">
                                                <label class="col-md-4 control-label" for="nm_toko">Aturan Pengiriman dan Pengembalian</label>
                                                <div class="col-md-8">
													<select class="col-md-12 form-control" name='aturan_pengiriman'>
													<option selected value=0>--Pilih--</option>
													<?php
													foreach($page->result() as $r){
														$selected='';
														if(($aturan_pengiriman!=0)||($aturan_pengiriman)){
															if($r->idx_page==$aturan_pengiriman){
																$selected='selected';
															}
														}
															echo'<option '.$selected.' value="'.$r->idx_page.'">'.$r->nm_page.'</option>';
													}
													?>
                                                    </select>
												</div>
                                        </div>
                                        <!-- // Group END -->	
<!-- Group -->
                                        <div class="form-group">
                                                <label class="col-md-4 control-label" for="nm_toko">Persyaratan Ketentuan</label>
                                                <div class="col-md-8">
													<select class="col-md-12 form-control" name='persyaratan_ketentuan'>
													<option selected value=0>--Pilih--</option>
													<?php
													foreach($page->result() as $r){
														$selected='';
														if(($persyaratan_ketentuan!=0)||($persyaratan_ketentuan)){
															if($r->idx_page==$persyaratan_ketentuan){
																$selected='selected';
															}
														}
															echo'<option '.$selected.' value="'.$r->idx_page.'">'.$r->nm_page.'</option>';
													}
													?>
                                                    </select>
												</div>
                                        </div>
                                        <!-- // Group END -->
<!-- Group -->
                                        <div class="form-group">
                                                <label class="col-md-4 control-label" for="nm_toko">Kebijakan Privasi</label>
                                                <div class="col-md-8">
													<select class="col-md-12 form-control" name='kebijakan_privasi'>
													<option selected value=0>--Pilih--</option>
													<?php
													foreach($page->result() as $r){
														$selected='';
														if(($kebijakan_privasi!=0)||($kebijakan_privasi)){
															if($r->idx_page==$kebijakan_privasi){
																$selected='selected';
															}
														}
															echo'<option '.$selected.' value="'.$r->idx_page.'">'.$r->nm_page.'</option>';
													}
													?>
                                                    </select>
												</div>
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

