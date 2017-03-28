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
        "sAjaxSource": "<?=$source?>"
    } );
} );
</script>
<!--Content-->
<div id="content">
	<ul class="breadcrumb">
			<li><a href="#">Home</a></li>
			<li class="divider"></li>
			<li><?=$site_title?></li>
	</ul>
	<?php if($target<>"all"){ ?>
	<div class="widget widget-tabs widget-tabs-double-2">
		<div class="widget-head">
			<ul>
				<?php if(!$target){ ?>
					<li class="active"><a class="glyphicons coins" href="<?=site_url('order/confirm')?>"><i></i><span>Konfirmasi Terbaru</span></a></li>
					<li><a class="glyphicons coins" href="<?=site_url('order/confirm/valid')?>"><i></i><span>Riwayat Konfirmasi</span></a></li>
				<?php } 
				if($target=="valid"){ ?>
					<li><a class="glyphicons coins" href="<?=site_url('order/confirm')?>"><i></i><span>Konfirmasi Terbaru</span></a></li>
					<li class="active"><a class="glyphicons coins" href="<?=site_url('order/confirm/valid')?>"><i></i><span>Riwayat Konfirmasi</span></a></li>
				<?php } ?>
			</ul>
		</div>
	</div>
	<?php } ?>
		<div class="col-md-12">
				<div class="innerLR">
					<div class="widget widget-4">
						<div class="widget-head">
							<h4 style='margin-left: -15px;' class="heading"><?=$site_title?></h4>
						</div>
						<div class="widget-body">
						<?php if(!$target){
						echo'
						<div><a href="'.site_url('order/add/confirm').'" class="btn btn-block btn-primary" style="margin: 8px -1em;width:18em;">Konfirmasi Pembayaran Manual</a></div>';
						}
						?>
							<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-horizontal" role="grid">
								<div class="row">
									<table class="dataTables_wrapper form-horizontal" role="grid" id="List" >
										<thead>
											<tr>
												<th style="width:13%;">Action</th>
												<th>Status</th>
												<th>Bukti Pembayaran</th>
												<th style="width:13%">Tanggal</th>
												<th style="width:10%">No Transaksi</th>
												<th style="width:10%">Tanggal Transfer</th>
												<th>Tujuan Transfer</th>
												<th>Bank Pengirim</th>
												<th>Rekening</th>
												<th>Atas Nama</th>
												<th>Total Transfer</th>
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
