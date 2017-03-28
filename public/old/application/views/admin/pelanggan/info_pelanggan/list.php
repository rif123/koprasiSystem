<!--Datatables-->
<link rel="stylesheet" media="screen" href="<?=$assets?>css/admin/jquery.dataTables.css">
<link rel="stylesheet" media="screen" href="<?=$assets?>css/admin/demo_table_jui.css">
<!---Datatables-->
<script type="text/javascript" language="javascript" src="<?=$assets?>js/admin/jquery.dataTables.js"></script>
<script>
$(document).ready(function() {
loaddata("");
});
function loaddata(umur){
   $('#List').dataTable({
        "bProcessing": true,
		"bDestroy": true,
		"bJQueryUI": true,
		"sPaginationType": "full_numbers",
        "bServerSide": true,
        "sAjaxSource": "<?=site_url('pelanggan/list_history_pelanggan')?>?umur="+umur
    });
}
</script>
<!--Content-->
<div id="content">
	<ul class="breadcrumb">
			<li><a href="#">Home</a></li>
			<li class="divider"></li>
			<li>Data Pelanggan</li>
	</ul>
	<div class="col-md-12">
		<div class="innerLR">
			<div class="widget widget-4">
			<!-- Widget heading -->
			<div class="widget-head"><h4 style='margin-left: -15px;' class="heading">Data Pelanggan </h4></div>
            <!-- // Widget heading END -->
				<div class="widget-body">
					<div class="row">
						<div class="form-group">
							<label class="col-md-2 control-label" for="range_umur">Pencarian Berdasarkan Umur</label>
							<div class="col-md-8">
								<select name="range_umur" id="range_umur" style="width: 30%;" onChange="loaddata(this.value)"  class="form-control">
									<option value=''>Semua Umur</option>
									<option value='5 and 10'>15 - 17 Tahun</option>
									<option value='17 and 24'>17 - 24 Tahun</option>
									<option value='25 and 32'>25 - 32 Tahun</option>
									<option value='33 and 41'>33 - 41 Tahun</option>
									<option value='42 and 50'>42 - 50 Tahun</option>
									<option value='51 and 61'>51 - 61 Tahun</option>
									<option value='62 and 67'>62 - 67 Tahun</option>
								</select>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
		<div class="col-md-12">
				<div class="innerLR">
					<div class="widget widget-4">
						<div class="widget-body">
							<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-horizontal" role="grid">
								<div class="row">
									<table class="dataTables_wrapper form-horizontal" role="grid" id="List" >
										<thead>
											<tr>
												<th>Action</th>
												<th width="15%">Nama Lengkap</th>
												<th width="8%">Jenis Kelamin</th>
												<th width="10%">Tanggal Lahir</th>
												<th width="15%">Email</th>
												<th width="20%">Alamat</th>
												<th width="10%">Kota</th>
												<th width="10%">Provinsi</th>
												<th width="10%">Telepon</th>
												<th width="10%">Handphone</th>
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
