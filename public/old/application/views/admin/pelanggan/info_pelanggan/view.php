<!--Datatables-->
<link rel="stylesheet" media="screen" href="<?=$assets?>css/admin/jquery.dataTables.css">
<link rel="stylesheet" media="screen" href="<?=$assets?>css/admin/demo_table_jui.css">
<!---Datatables-->
<script type="text/javascript" language="javascript" src="<?=$assets?>js/admin/jquery.dataTables.js"></script>
<!--Content-->
<div id="content">
<ul class="breadcrumb">
	<li><a href="#" class="glyphicons home">Home</a></li>
	<li class="divider"></li>
	<li>Data Pelanggan</li>
	<li class="divider"></li>
	<li>Riwayat Pemesanan Pelanggan</li>
</ul>
<div class="innerLR">
	<!-- Widget -->
        <div class="widget widget-gray widget-body-gray">
                <!-- Widget heading -->
                <div class="widget-head"><h4 class="heading">Riwayat Pemesanan Pelanggan</h4></div>
                <!-- // Widget heading END -->
                <div class="widget-body">
                        <!-- Row -->
                        <div class="row add_style">
								<div class="col-md-12">
									<p class="title_box">Data Pelanggan<p>
									 <div class="col-md-6" style="width: 30%;">
											<!-- Group -->
											<div class="form-group">
													<label class="col-md-4 control-label" for="Nama Lengkap"><b>Nama Lengkap</b></label>
													<label class="col-md-4 control-label" style="font-weight:normal;width: 180px;text-align: left;" for="Nama Lengkap"><?=$Result_form->full_name?></label>
											</div>
											<!-- // Group END --> 
											<!-- Group -->
											<div class="form-group">
													<label class="col-md-4 control-label" for="Jenis Kelamin"><b>Jenis Kelamin</b></label>
													<label class="col-md-4 control-label" style="font-weight:normal;width: 180px;text-align: left;" for="Jenis Kelamin"><?=$Result_form->jenis_kelamin?></label>
											</div>
											<!-- // Group END --> 
											<!-- Group -->
											<div class="form-group">
													<label class="col-md-4 control-label" for="Tanggal Lahir"><b>Tanggal Lahir</b></label>
													<label class="col-md-4 control-label" style="font-weight:normal;width: 180px;text-align: left;" for="Tanggal Lahir"><?=DateToIndo($Result_form->tgl_lahir)?></label>
											</div>
											<!-- // Group END -->
									</div>
									<div class="col-md-6" style="width: 30%;">
											<div class="form-group">
													<label class="col-md-4 control-label" for="Email"><b>Email</b></label>
													<label class="col-md-4 control-label" style="font-weight:normal;width: 180px;text-align: left;" for="Email"><?=$Result_form->email?></label>	
											</div>
											<!-- // Group END --> 
											<!-- Group -->
											<div class="form-group">
													<label class="col-md-4 control-label" for="no_telepon"><b>No Telepon</b></label>
													<label class="col-md-4 control-label" style="font-weight:normal;width: 180px;text-align: left;" for="no_telepon"><?=$Result_form->no_telepon?></label>
											</div>
											<!-- // Group END --> 
											<!-- Group -->
											<div class="form-group">
													<label class="col-md-4 control-label" for="hp"><b>Handphone</b></label>
													<label class="col-md-4 control-label" style="font-weight:normal;width: 180px;text-align: left;" for="hp"><?=$Result_form->hp?></label>
											</div>
									</div>
									<div class="col-md-6" style="width: 30%;">
										<!-- Group -->
										<div class="form-group">
											<label class="col-md-4 control-label" for="Alamat"><b>Alamat</b></label>
											<label class="col-md-4 control-label" style="font-weight:normal;width: 180px;text-align: left;" for="Alamat"><?=$Result_form->alamat?><br><?=$Result_form->kec?></label>
										</div>
										<!-- // Group END -->
										<!-- Group -->
										<div class="form-group">
											<label class="col-md-4 control-label" for="Kota"><b>Kota</b></label>
											<label class="col-md-4 control-label" style="font-weight:normal;width: 180px;text-align: left;" for="Kota"><?=$Result_form->kota?></label>
										</div>
										<!-- // Group END -->
										<!-- Group -->
										<div class="form-group">
											<label class="col-md-4 control-label" for="provinsi"><b>Provinsi</b></label>
											<label class="col-md-4 control-label" style="font-weight:normal;width: 180px;text-align: left;" for="provinsi"><?=$Result_form->provinsi?></label>
										</div>
										<!-- // Group END -->
											<!-- Group -->
										<div class="form-group">
											<label class="col-md-4 control-label" for="Zip Kode"><b>Zip Kode</b></label>
											<label class="col-md-4 control-label" style="font-weight:normal;width: 180px;text-align: left;" for="Zip Kode"><?=$Result_form->zip_code?></label>
										</div>
										<!-- // Group END -->
									</div>
								</div>
						</div>
								<div class="row">
								<p class="title_box">Riwayat Pemesanan<p>
								<!-- Column -->
                                <div class="col-md-12">
									<div class="innerLR">
										<div class="widget widget-4">
											<div class="widget-body">
												<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-horizontal" role="grid">
													<div class="row">
														<table class="dataTables_wrapper form-horizontal" role="grid" id="List" >
															<thead>
																<tr>
																	<th width="8%">Action</th>
																	<th width="8%">Status</th>
																	<th width="8%">No Transaksi</th>
																	<th width="10%">Tanggal Pesanan</th>
																	<th width="35%">Alamat Pengiriman</th>
																	<th width="10%">Total Tagihan</th>
																	<th width="10%">No Pengiriman</th>
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
								</div>
                                <!-- // Column END -->
								</div>
                        <!-- // Row END -->
				</div>
	

</div>
</div>
<!-- End Wrapper -->
</div>
<script>
$(document).ready(function(){
 $('#List').dataTable({
        "bProcessing": true,
		"bDestroy": true,
		"bJQueryUI": true,
		"sPaginationType": "full_numbers",
        "bServerSide": true,
        "sAjaxSource": "<?=site_url('pelanggan/list_riwayat_pesanan?idx_pelanggan='.$idx_pelanggan)?>"
    });
});
</script>
<?php
	function DateToIndo($date){  
			$BulanIndo = array("Januari", "Februari", "Maret",  
							   "April", "Mei", "Juni",  
							   "Juli", "Agustus", "September",  
							   "Oktober", "November", "Desember");  
		  
			$tahun = substr($date, 0, 4);  
			$bulan = substr($date, 5, 2);  
			$tgl   = substr($date, 8, 2);  
			  
			$result = $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun;       
			return($result);  
	}
?>		



