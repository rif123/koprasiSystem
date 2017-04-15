<script>
$(document).ready(function() {
    $('#list').dataTable( {
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": "<?=site_url('pelanggan/list_pelanggan')?>"
    } );
} );
</script>
<div class="col-md-12">
<div class="box">
	<div class="box-title">
		<h3><i class="icon-table"></i>Data Pelanggan</h3>
			<div class="box-tool">
				<a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
			</div>
	</div>
<div class="box-content">

<br><br>
<div class="clearfix"></div>
<div class="table-responsive">
<div id="table1_wrapper" class="dataTables_wrapper form-inline" role="grid">
	<div class="row">
		<div class="col-xs-6">
			<div class="dataTables_length" id="table1_length">
				<table aria-describedby="table1_info" class="table table-advance dataTable" id="list">
				<thead>
					<tr>
						<th>Action</th>
						<th>Status</th>
						<th>ID Pelanggan</th>
						<th>Nama</th>
						<th>Alamat</th>
						<th>Telepon</th>
						<th>Email</th>
						<th>Template</th>
						<th>Tagihan</th>
					</tr>
				</thead>
				<tbody aria-relevant="all" aria-live="polite" role="alert"><tr class="table-flag-blue odd">
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
</div>
</div>
</div>
