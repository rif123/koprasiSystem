<script>
$(document).ready(function() {
    $('#list').dataTable( {
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": "<?=site_url('setting/list_page')?>"
    } );
} );
</script>
<div class="col-md-12">
<div class="box">
	<div class="box-title">
		<h3><i class="icon-table"></i>Setting Account</h3>
			<div class="box-tool">
				<a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
			</div>
	</div>
<div class="box-content">
		<div class="btn-toolbar pull-right clearfix">
			<div class="btn-group">
				<a data-original-title="Add new record" class="btn btn-primary button-next show-tooltip" title="" href="<?=site_url('setting/add/page')?>">Add</a>
				
			</div>
			
		</div>
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
						<th>Judul</th>
						<th>Share</th>
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
