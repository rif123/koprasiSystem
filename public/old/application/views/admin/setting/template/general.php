<script type="text/javascript" src="<?=$assets?>js/admin/jquery.blockUI.js"></script>
<script>
$(document).ready(function() {
	$('#ajax-status').hide();
		$('#message').hide();
		$('#frm_input').ajaxForm({
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
<!--Content-->
<div id="content">
<ul class="breadcrumb">
	<li><a href="#" class="glyphicons home">Home</a></li>
	<li class="divider"></li>
	<li>Setting</li>
	<li class="divider"></li>
	<li>Upload Template</li>
</ul>
<div class="separator bottom"></div>
<div class="innerLR">

<form class="form-horizontal" id="frm_input" method="POST" action="<?=site_url('setting/upload_template')?>" enctype="multipart/form-data">
	<!-- Widget -->
        <div class="widget widget-gray widget-body-gray">
                <!-- Widget heading -->
                <div class="widget-head"><h4 class="heading">Upload Template</h4></div>
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
                                                <label class="col-md-4 control-label" for="nm_template">Nama Direktori Template</label>
                                                <div class="col-md-8">
													<input class="form-control"  id="nm_template" name="nm_template" type="text"><p>Nama Direktori Template Harus sama Seperti Nama Direktori Template Di Web Induk</p>
												</div>
                                        </div>
                                        <!-- // Group END -->
										 <!-- Group -->
                                        <div class="form-group">
                                                <label class="col-md-4 control-label" for="out_of_stock">Upload Template</label>
                                                <div class="col-md-8"><input class="form-control" name="template" type="file"></div>
                                        </div>
                                        <!-- // Group END -->
                                </div>
                                <!-- // Column END -->
                           </div>
                        <!-- // Row END -->
                        <!-- Form actions -->
                        <div class="form-actions">
                                <button type="submit" class="btn btn-icon btn-primary glyphicons circle_ok"><i></i>Save</button>
                        </div>
                        <!-- // Form actions END -->
                        
                </div>
	

</div>
</form>
</div>
		
				<!-- End Wrapper -->
		</div>
<style>
.shadow{
width: 100%;
min-height: 500em;
position: fixed;
background: #161616;
top: 0;
left: 0;
opacity: 0.6;
cursor:not-allowed;
}
</style>		
<div class='shadow' style="display:none"></div>


