<script>
$(document).ready(function() {
	$("#tgl_awal,#tgl_akhir").datepicker({dateFormat: 'yy-mm-dd'});
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
	<li>Tambah Item Promo</li>
</ul>
<div class="innerLR">

<form class="form-horizontal" id="form_input" method="POST" action="<?=site_url('promo/save/content_promo/'.$promo->idx_promo)?>" enctype="multipart/form-data">
	<!-- Widget -->
        <div class="widget widget-gray widget-body-gray">
                <!-- Widget heading -->
                <div class="widget-head"><h4 class="heading">Tambah Item Promo</h4></div>
                <!-- // Widget heading END -->
                <div class="widget-body">
					<div class="row">
						<span id="ajax-status"></span>
						<span id="message"  ></span>
                        <!-- Column -->
                                <div class="col-md-6" style="border: 1px solid #bbb;padding: 10px 10px;float:none;width:100%;margin-bottom: 4px;">
									<input id="idx_type_promo" name="idx_type_promo" hidden value="<?=$promo->idx_type_promo?>" type="text">
									<?php if(($promo->idx_type_promo<>2)&&($promo->idx_type_promo<>5)){
										echo'
										<!-- Group -->
											<div class="form-group">
													<label class="col-md-4 control-label" for="discount">Diskon (%)</label>
													<div class="col-md-8"><input class="form-control" id="discount" name="discount" style="width:20%" type="text"></div>
											</div>
										<!-- // Group END -->';
									}
									?>
									<?php if($promo->idx_type_promo==4){
										echo'
											<!-- Group -->
											<div class="form-group">
													<label class="col-md-4 control-label" for="minimum_transaksi">Minimum Transaksi (Rp)</label>
													<div class="col-md-8"><input class="form-control" id="minimum_transaksi" style="width:40%" name="minimum_transaksi" type="text"></div>
											</div>
											<!-- // Group END -->';
									}
									?>
									<?php if($promo->idx_type_promo==5){ ?>
									 <p style="padding: 10px 0px;font-weight: bold;border-bottom: 1px solid #bbb;">Pilih kota yang gratis biaya pengiriman</p>
										<script>
											var i=1;
											function put_city(city){
												$("#box_kota").append("<div class='k' id='k"+i+"'><img onClick=Remove('k"+i+"') src='<?=base_url()?>assets/images/remove.png'/><input type='text'  class='form-control' name='kota[]' value='"+city+"'/></div>");
											i=i+1;
											}
											function Remove(n){
												$("#"+n).remove();
											}
										</script>
										<!-- Group -->
											<div class="form-group">
													<label class="col-md-4 control-label" for="kota">Kota</label>
													<div class="col-md-8">
														<select name="list_kota" style="width: 40%;"  onChange="put_city(this.value)"  class="form-control">
															<option value=''>Semua Kota</option>
															<?php
																foreach($list_city->result() as $wlc){
																	echo"<option value='".$wlc->kota."'>".$wlc->kota."</option>";
																}
															?>
														</select>
													</div>
											</div>
											<!-- // Group END -->
											
										<!-- Group -->
											<div class="form-group">
													<label class="col-md-4 control-label" for="discount">Kota Pilih Anda</label>
													<div class="col-md-8" id="box_kota"></div>
											</div>
										<!-- // Group END -->
										
								<? } ?>
								</div>
                                <!-- // Column END -->
								<?php if(($promo->idx_type_promo<>4)&&($promo->idx_type_promo<>2)){ ?>
								 <div class="col-md-6" style="border: 1px solid #bbb;padding: 10px 10px;float:none;width:100%">
								 <p style="padding: 10px 0px;font-weight: bold;border-bottom: 1px solid #bbb;">Pencarian Produk Berdasarkan</p>
											<!-- Group -->
											<div class="form-group">
													<label class="col-md-4 control-label" for="minimum_transaksi">Kategori Produk</label>
													<div class="col-md-8">
														<select name="idx_kategori" id="idx_kategori" style="width: 30%;" onChange="loaddata(this.value,$('#idx_brand').val())"  class="form-control">
															<option value=''>Semua Kategori</option>
															<?php
																foreach($category_product->result() as $wc){
																	echo"<option value='".$wc->idx_category."'>".$wc->name."</option>";
																}
															?>
														</select>
													</div>
											</div>
											<!-- // Group END -->
											<!-- Group -->
											<div class="form-group">
													<label class="col-md-4 control-label" for="minimum_transaksi">Brand Produk</label>
													<div class="col-md-8">
														<select name="idx_brand" id="idx_brand" style="width: 30%;" onChange="loaddata($('#idx_kategori').val(),this.value)"  class="form-control">
															<option value=''>Semua Brand </option>
															<?php
																foreach($brand->result() as $wb){
																	echo"<option value='".$wb->idx_brand."'>".$wb->nm_brand."</option>";
																}
															?>
														</select>
													</div>
											</div>
											<!-- // Group END -->
									<script>
										$(document).ready(function() {
											loaddata("","");
										});
										function loaddata(idx_categori,idx_brand){
											$('#List').dataTable( {
												"bProcessing": true,
												"bDestroy": true,
												"bJQueryUI": true,
												"sPaginationType": "full_numbers",
												"bServerSide": true,
												"iDisplayLength" :500,
												"sAjaxSource": "<?=site_url('promo/list_product')?>?idx_categori="+idx_categori+'&idx_brand='+idx_brand
											} );
										}
									</script>
									 <p style="padding: 10px 0px;font-weight: bold;border-bottom: 1px solid #bbb;">Pilih Produk</p>
									<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-horizontal" style="margin: 0 2em;" role="grid">
										<div class="row">
											<table class="dataTables_wrapper form-horizontal" role="grid" id="List" >
												<thead>
													<tr>
														<th width="2%"></th>
														<th width="20%">Status Promo</th>
														<th width="10%"></th>
														<th width="20%">Kategori Produk</th>
														<th width="20%">Nama Produk</th>
														<th width="10%">Berat (Gram)</th>
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
								<? } ?>
								<?php if($promo->idx_type_promo==2){ ?>
								 <div class="col-md-6" style="border: 1px solid #bbb;padding: 10px 10px;float:none;width:100%">
								 <p style="padding: 10px 0px;font-weight: bold;border-bottom: 1px solid #bbb;">Pencarian Produk Berdasarkan</p>
											<!-- Group -->
											<div class="form-group">
													<label class="col-md-4 control-label" for="minimum_transaksi">Kategori Produk</label>
													<div class="col-md-8">
														<select name="idx_kategori" id="idx_kategori" style="width: 30%;" onChange="loaddata(this.value,$('#idx_brand').val())"  class="form-control">
															<option value=''>Semua Kategori</option>
															<?php
																foreach($category_product->result() as $wc){
																	echo"<option value='".$wc->idx_category."'>".$wc->name."</option>";
																}
															?>
														</select>
													</div>
											</div>
											<!-- // Group END -->
											<!-- Group -->
											<div class="form-group">
													<label class="col-md-4 control-label" for="minimum_transaksi">Brand Produk</label>
													<div class="col-md-8">
														<select name="idx_brand" id="idx_brand" style="width: 30%;" onChange="loaddata($('#idx_kategori').val(),this.value)"  class="form-control">
															<option value=''>Semua Brand </option>
															<?php
																foreach($brand->result() as $wb){
																	echo"<option value='".$wb->idx_brand."'>".$wb->nm_brand."</option>";
																}
															?>
														</select>
													</div>
											</div>
											<!-- // Group END -->
									<script>
										$(document).ready(function() {
											loaddata("","");
										});
										function loaddata(idx_categori,idx_brand){
											$('#List').dataTable( {
												"bProcessing": true,
												"bDestroy": true,
												"bJQueryUI": true,
												"sPaginationType": "full_numbers",
												"bServerSide": true,
												"sAjaxSource": "<?=site_url('promo/list_product_bogof/')?>?idx_categori="+idx_categori+'&idx_brand='+idx_brand
											} );
										}
									</script>
									 <p style="padding: 10px 0px;font-weight: bold;border-bottom: 1px solid #bbb;">Pilih Produk</p>
									<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-horizontal" style="margin: 0 2em;" role="grid">
										<div class="row">
											<table class="dataTables_wrapper form-horizontal" role="grid" id="List" >
												<thead>
													<tr>
														<th width="2%"></th>
														<th width="10%">Status Diskon</th>
														<th width="10%"></th>
														<th width="20%">Kategori Produk</th>
														<th width="20%">Nama Produk</th>
														<th width="5%">Berat</th>
														<th width="20%">Pesan Bonus</th>
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
								<? } ?>
                        <!-- // Row END -->
                        </div>
                        <!-- Form actions -->
                        <div class="form-actions">
						<?php if($promo->idx_type_promo<>4){ ?>
								<input type="hidden" name="fl_submit" id="fl_submit" />
                                <button type="submit" onClick="$('#fl_submit').val(1)" name="save" value="save" class="btn btn-icon btn-primary glyphicons circle_ok"><i></i>Simpan Produk</button>
						<?php } ?>
								<button type="submit" name="save" value="finish" class="btn btn-icon btn-primary glyphicons circle_ok"><i></i>Simpan & Selesai</button>
                                <button type="reset" class="btn btn-icon btn-default glyphicons circle_remove"><i></i>Reset</button>
                        </div>
                        <!-- // Form actions END -->
                        
                </div>
	

</div>
</form>
</div>
		
				<!-- End Wrapper -->
		</div>	



