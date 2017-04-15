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
		tinymce.init({
		selector: "textarea",
		plugins: "table",
		style_formats: [
			{title: 'Bold text', inline: 'b'},
			{title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
			{title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
			{title: 'Example 1', inline: 'span', classes: 'example1'},
			{title: 'Example 2', inline: 'span', classes: 'example2'},
			{title: 'Table styles'},
			{title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
		],
		formats: {
			alignleft: {selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes: 'left'},
			aligncenter: {selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes: 'center'},
			alignright: {selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes: 'right'},
			alignfull: {selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes: 'full'},
			bold: {inline: 'span', 'classes': 'bold'},
			italic: {inline: 'span', 'classes': 'italic'},
			underline: {inline: 'span', 'classes': 'underline', exact: true},
			strikethrough: {inline: 'del'},
			customformat: {inline: 'span', styles: {color: '#00ff00', fontSize: '20px'}, attributes: {title: 'My custom format'}}
		},
		width :600,
		height:300
	});

});
</script>
<div id="content">
<ul class="breadcrumb">
	<li><a href="#" class="glyphicons home">Home</a></li>
	<li class="divider"></li>
	<li>Edit Newsletter</li>
</ul>
<div class="separator bottom"></div>
<div class="innerLR">

<form class="form-horizontal" id="form_input" method="POST" onSubmit="tinyMCE.triggerSave();" action="<?=site_url('pelanggan/update_newsletter')?>" enctype="multipart/form-data">
	<!-- Widget -->
        <div class="widget widget-gray widget-body-gray">
                <!-- Widget heading -->
                <div class="widget-head"><h4 class="heading">Edit Newsletter</h4></div>
                <!-- // Widget heading END -->
                <div class="widget-body">
                        <!-- Row -->
                        <div class="row">
						<span id="ajax-status"></span>
						<span id="message"  ></span>
                        <!-- Column -->
                                <div class="col-md-12">
										<!-- Group -->
                                        <div class="form-group">
                                                <label class="col-md-4 control-label" for="email">Judul</label>
                                                <div class="col-md-8">
													<input type="text" name="judul" value="<?=$Result_form->judul?>" class="form-control"/>
													<input type="hidden" name="idx_content_newsletter" value="<?=$Result_form->idx_content_newsletter?>"/>
												</div>
                                        </div>
                                        <!-- // Group END -->
										<!-- Group -->
                                        <div class="form-group">
                                                <label class="col-md-4 control-label" for="telepon">Content</label>
                                                <div class="col-md-8">
													<textarea  name='content' class="form-control"><?=$Result_form->content?></textarea>
												</div>
                                        </div>
                                        <!-- // Group END -->
										
                                </div>
                                <!-- // Column END -->
                           </div>
						 <!-- // Row END -->
                        <!-- Form actions -->
                        <div class="form-actions">
						<?php if($Result_form->cd_status==0){
								echo'
                                <button type="submit" name="ok" value="send" class="btn btn-icon btn-primary glyphicons circle_ok"><i></i>Send</button>
                                <button type="submit" name="ok" value="draft" class="btn btn-icon btn-primary glyphicons circle_ok"><i></i>Draft</button>';
						}else{
							echo'
                                <button type="button" onClick=window.location="'.site_url('pelanggan/newsletter_pelanggan').'"; class="btn btn-icon btn-primary glyphicons circle_ok"><i></i>Kembali</button>';
						}
						?>
                        </div>
                        <!-- // Form actions END -->
                        
                </div>
	

</div>
</form>
</div>
		
				<!-- End Wrapper -->
		</div>	
