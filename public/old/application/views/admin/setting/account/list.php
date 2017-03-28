<!--Datatables-->
<link rel="stylesheet" media="screen" href="<?=$assets?>css/admin/jquery.dataTables.css">
<link rel="stylesheet" media="screen" href="<?=$assets?>css/admin/demo_table_jui.css">
<!---Datatables-->
<script type="text/javascript" language="javascript" src="<?=$assets?>js/admin/jquery.dataTables.js"></script>
<script>
$(document).ready(function() {
    $('#List').dataTable( {
        "bProcessing": true,
		"bJQueryUI": true,
		"sPaginationType": "full_numbers",
        "bServerSide": true,
        "sAjaxSource": "<?=site_url('setting/list_account')?>"
    } );
} );
</script>
<!--Content-->
<div id="content">
	<ul class="breadcrumb">
			<li><a href="#">Home</a></li>
			<li class="divider"></li>
			<li>Setting</li>
			<li class="divider"></li>
			<li>Akun Chat</li>
	</ul>
					<div class="widget widget-tabs widget-tabs-double-2">
						<div class="widget-head">
							<ul>
								<li><a class="glyphicons display" href="<?=site_url('setting/general')?>"><i></i><span>Setting Website</span></a></li>
								<li><a class="glyphicons shop" href="<?=site_url('setting/shop')?>"><i></i><span>Toko Online</span></a></li>
								<li><a class="glyphicons truck" href="<?=site_url('setting/shipping')?>"><i></i><span>Ongkos Kirim</span></a></li>
								<li><a class="glyphicons bank" href="<?=site_url('parameter/bank')?>"><i></i><span>Akun Bank</span></a></li>
								<li class="active"><a class="glyphicons chat" href="#"><i></i><span>Akun Chat</span></a></li>
								<li><a class="glyphicons notes" href="<?=site_url('parameter/page')?>"><i></i><span>Page</span></a></li>
								<!--<li><a class="glyphicons link" href="<?=site_url('setting/page')?>"><i></i><span>Link Page</span></a></li>-->
							</ul>
						</div>
					</div>
		<div class="col-md-12">
				<div class="innerLR">
					<div class="widget widget-4">
						<div class="widget-body">
						<div>
						<a href="<?=site_url('setting/add/account')?>" class="btn btn-block btn-primary" style='margin: 8px -1em;width:6em;'>Tambah</a>
						</div>
							<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-horizontal" role="grid">
								<div class="row">
									<table class="dataTables_wrapper form-horizontal" role="grid" id="List" >
										<thead>
											<tr>
												<th>Action</th>
												<th>Type Account</th>
												<th>Nama/No Account</th>
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
		</div>
