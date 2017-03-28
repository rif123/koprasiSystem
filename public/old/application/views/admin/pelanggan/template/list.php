<?php
	include"./fsy/url_induk.php";
?>
<!--Datatables-->
<link rel="stylesheet" media="screen" href="<?=$assets?>css/admin/jquery.dataTables.css">
<link rel="stylesheet" media="screen" href="<?=$assets?>css/admin/demo_table_jui.css">
<!---Datatables-->
<script type="text/javascript" language="javascript" src="<?=$assets?>js/admin/jquery.dataTables.js"></script>
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
	function load(paket){
		$('#List').dataTable({
			"bProcessing": true,
			"bServerSide": true,
			"bDestroy": true,
			"sAjaxSource": '<?=$MAIN_URL?>/template/list_json_template?paket='+paket
		});
	}
</script>
<!--Content-->
<div id="content">
<ul class="breadcrumb">
	<li><a href="#" class="glyphicons home">Home</a></li>
	<li class="divider"></li>
	<li>Request Ganti Template</li>
</ul>
<div class="separator bottom"></div>
<div class="innerLR">

<form class="form-horizontal" id="form_input" method="POST" action="<?=site_url('pelanggan/act_template')?>" enctype="multipart/form-data">
	<!-- Widget -->
        <div class="widget widget-gray widget-body-gray">
                <!-- Widget heading -->
                <div class="widget-head"><h4 class="heading">Request Ganti Template</h4></div>
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
                                                <label class="col-md-4 control-label" for="telepon">Nomor Telepon/Handphone</label>
                                                <div class="col-md-8">
													<input type="text" name="telepon" class="form-control"/>
													<input type="hidden" name="id_pesanan" value="<?=$id_pesanan?>"/>
												</div>
                                        </div>
                                        <!-- // Group END -->
                                </div>
                                <!-- // Column END -->
                           </div>
						   <p>Pilih Templete sesuai dengan paket</p>
						 <div class="innerLR">
							<div class="widget widget-4">
								<div class="widget-body">
									<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-horizontal" role="grid">
										<div class="row">
											<table class="dataTables_wrapper form-horizontal" role="grid" id="List" >
												<thead>
													<tr>
														<th style='width:4%;'></th>
														<th style='width:20%;'></th>
														<th style='width:20%;'>Nama Template</th>
														<th>Harga</th>
														<th>Jenis Template</th>
														<th>Description</th>
													</tr>
												</thead>
												<tbody aria-relevant="all" aria-live="polite" role="alert">
													<tr>
														<td colspan="5" class="dataTables_empty">Loading data from server</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
                        <!-- // Row END -->
                        <!-- Form actions -->
                        <div class="form-actions">
                                <button type="submit" class="btn btn-icon btn-primary glyphicons circle_ok"><i></i>OK</button>
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
	window.onload = load('<?=$code_paket?>');
</script>



