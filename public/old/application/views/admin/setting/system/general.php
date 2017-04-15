<?php
	include"./fsy/url_induk.php";
?>
<!--Datatables-->
<link rel="stylesheet" media="screen" href="<?=$assets?>css/admin/jquery.dataTables.css">
<link rel="stylesheet" media="screen" href="<?=$assets?>css/admin/demo_table_jui.css">
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
			"sAjaxSource": '<?=$MAIN_URL?>/template/list_json_template_complete?paket='+paket
		});
	}
</script>
<!--Content-->
<div id="content">
<ul class="breadcrumb">
	<li><a href="#" class="glyphicons home">Home</a></li>
	<li class="divider"></li>
	<li>Setting</li>
	<li class="divider"></li>
	<li>Sistem</li>
</ul>
<div class="innerLR">

<form class="form-horizontal" id="form_input" method="POST" action="<?=site_url('setting/'.$action.'/system')?>" enctype="multipart/form-data">
	<!-- Widget -->
        <div class="widget widget-gray widget-body-gray">
                <!-- Widget heading -->
                <div class="widget-head"><h4 class="heading">Sistem</h4></div>
                <!-- // Widget heading END -->
                <div class="widget-body">
                        <!-- Row -->
                        <div class="row">
						<span id="ajax-status"></span>
						<span id="message"  ></span>
                        <!-- Column -->
                                <div class="col-md-6">
                                       <!-- // Group END -->
										<?php if(($this->session->userdata('user_name')=='sadmin')){ ?>
										 <!-- Group -->
                                        <div class="form-group">
                                                <label class="col-md-4 control-label" for="idx_pelanggan">ID Pelanggan</label>
                                                <div class="col-md-8">
													<select class="form-control" id="id_pesanan" name="id_pesanan">
														
													</select>
												</div>
                                        </div>
                                        <!-- // Group END -->
										<!-- Group -->
                                        <div class="form-group">
                                                <label class="col-md-4 control-label" for="paket">Jenis Paket</label>
                                                <div class="col-md-8">
													<select class="form-control" id="paket" onChange="load(this.value);" name="paket">
														
													</select>
												</div>
                                        </div>
                                        <!-- // Group END -->
										 <!-- Group -->
                                        <div class="form-group">
                                                <label class="col-md-4 control-label" for="smtp_host">Smtp Host</label>
                                                <div class="col-md-8">
													<input class="form-control" value="<?=$smtp_host?>"  id="smtp_host" name="smtp_host" type="text">
													<input class="form-control" value="<?=$idx_system?>"  id="idx_system" name="idx_system" type="hidden">
												</div>
                                        </div>
                                        <!-- // Group END -->
										<!-- Group -->
                                        <div class="form-group">
                                                <label class="col-md-4 control-label" for="smtp_user">Smtp User</label>
                                                <div class="col-md-8">
													<input class="form-control" id="smtp_user" value="<?=$smtp_user?>" name="smtp_user" type="text">
												</div>
                                        </div>
                                        <!-- // Group END -->
										<!-- Group -->
                                        <div class="form-group">
                                                <label class="col-md-4 control-label" for="smtp_password">Smtp Password</label>
                                                <div class="col-md-8">
													<input class="form-control" id="smtp_password" value="<?=$smtp_password?>" name="smtp_password" type="password">
												</div>
                                        </div>
                                        <!-- // Group END -->
										<!-- Group -->
                                        <div class="form-group">
                                                <label class="col-md-4 control-label" for="smtp_password">Smtp Port</label>
                                                <div class="col-md-8">
													<input class="form-control" id="smtp_port" value="<?=$smtp_port?>" name="smtp_port" type="text">
												</div>
                                        </div>
                                        <!-- // Group END -->
										<!-- Group -->
                                        <div class="form-group">
                                                <label class="col-md-4 control-label" for="directory_old">Direktori Template Pilihan</label>
                                                <div class="col-md-8">
													<input class="form-control" id="directory_old" value="<?=$directory?>" name="directory_old" type="text">
												</div>
                                        </div>
                                        <!-- // Group END -->
										<?php } ?>
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
														<th>Direktori</th>
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
                                <button type="submit" class="btn btn-icon btn-primary glyphicons circle_ok"><i></i>Save</button>
                                 <button type="button" onClick="window.location='<?=site_url('setting/template')?>';" class="btn btn-icon btn-primary glyphicons circle_ok"><i></i>Upload Template</button>
                        </div>
                        <!-- // Form actions END -->
                        
                </div>
	

</div>
</form>
</div>

				<!-- End Wrapper -->
		</div>	
<script>
	function isi_data(pesanan,paket){
		$.ajax({
			url: '<?=$MAIN_URL?>/parameter/link_to_paket_system?get_server=1&paket='+paket,
			success: function (html) {
				$("#paket").html(html);
			}
		});
		$.ajax({
			url: '<?=$MAIN_URL?>/parameter/link_to_pesanan?get_server=1&pesanan='+pesanan,
			success: function (html) {
				$("#id_pesanan").html(html);
			}
		});
		load('<?=$paket?>');
	}

	window.onload = isi_data('<?=$pesanan?>','<?=$paket?>');
</script>



