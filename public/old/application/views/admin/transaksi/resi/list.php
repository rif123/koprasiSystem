<!--Datatables-->
<link rel="stylesheet" media="screen" href="<?=$assets?>css/admin/jquery.dataTables.css">
<link rel="stylesheet" media="screen" href="<?=$assets?>css/admin/demo_table_jui.css">
<!---Datatables-->
<script type="text/javascript" language="javascript" src="<?=$assets?>js/admin/jquery.dataTables.js"></script>
<script>
$(document).ready(function(){
    $('#List').dataTable( {
        "bProcessing": true,
		"bJQueryUI": true,
		"sPaginationType": "full_numbers",
        "bServerSide": true,
        "sAjaxSource": "<?=site_url('order/list_resi')?>"
    });
});
</script>
<!--Content-->
<div id="content">
	<ul class="breadcrumb">
			<li><a href="#">Home</a></li>
			<li class="divider"></li>
			<li>Resi Pengiriman</li>
	</ul>
	<form class="form-horizontal" id="form_input" method="POST" action="<?=site_url('order/update_resi')?>" enctype="multipart/form-data">
		<div class="col-md-12">
				<div class="innerLR">
					<div class="widget widget-4">
						<div class="widget-head">
							<h4 style='margin-left: -15px;' class="heading">Resi Pengiriman</h4>
						</div>
						<div class="widget-body">
						<span id="ajax-status"></span>
						<span id="message"  ></span>
							<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-horizontal" role="grid">
								<div class="row">
									<table class="dataTables_wrapper form-horizontal" role="grid" id="List" >
										<thead>
											<tr>
												<th style="width:12%">Masukan No Resi</th>
												<th>Status</th>
												<th style="width:10%">No Transaksi</th>
												<th style="width:10%">Tanggal</th>
												<th>Pemesan</th>
												<th style="width:20%">Penagihan</th>
												<th>Alamat Pengiriman</th>
												<th style="width:10%">Expedisi Pengiriman</th>
												<th style="width:10%">No Resi</th>
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
				<!-- End Content -->
		</div>
		<!-- End Wrapper -->
		<!-- Form actions -->
        <div class="form-actions">
            <button type="submit" class="btn btn-icon btn-primary glyphicons circle_ok"><i></i>Save</button>
        </div>
        <!-- // Form actions END -->
		</form>
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
