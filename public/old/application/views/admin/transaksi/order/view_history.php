<div class="col-md-12">
<div class="box">
	<div class="box-title">
		<h3>Lihat Pesanan</h3>
			<div class="box-tool">
				<a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
			</div>
</div>
	<div class="box-content">
		<span id="ajax-status"></span>
        <span id="message"  ></span>
		<form id="form_input" action="<?=site_url('order/order_history')?>" class="form-horizontal"  method="post">
			<div class="form-group">
				<label class="col-sm-3 col-lg-2 control-label" for="type_account">No Transaksi:</label>
				<div class="col-sm-6 col-lg-4 controls">
					<label class="col-sm-3 col-lg-2 control-label" style="width:100%;text-align:left;" for="type_account"><?=$Result_form->id_pesanan?></label>
				</div>
				<label class="col-sm-3 col-lg-2 control-label" for="type_account">Nama:</label>
				<div class="col-sm-6 col-lg-4 controls">
					<label class="col-sm-3 col-lg-2 control-label" style="width:100%;text-align:left;" for="type_account"><?=$Result_form->full_name?></label>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 col-lg-2 control-label" for="no_account">Tanggal Pesan:</label>
				<div class="col-sm-6 col-lg-4 controls">
					<label class="col-sm-3 col-lg-2 control-label" style="width:100%;text-align:left;" for="type_account"><?=DateToIndo($Result_form->tgl_order)?></label>
				</div>
				<label class="col-sm-3 col-lg-2 control-label" for="no_account">Email:</label>
				<div class="col-sm-6 col-lg-4 controls">
					<label class="col-sm-3 col-lg-2 control-label" style="width:100%;text-align:left;" for="type_account"><?=$Result_form->email?></label>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 col-lg-2 control-label" for="no_account">Paket:</label>
				<div class="col-sm-6 col-lg-4 controls">
					<label class="col-sm-3 col-lg-2 control-label" style="width:100%;text-align:left;" for="type_account"><?=$Result_form->nm_paket?></label>
				</div>
				<label class="col-sm-3 col-lg-2 control-label" for="no_account">Alamat:</label>
				<div class="col-sm-6 col-lg-4 controls">
					<label class="col-sm-3 col-lg-2 control-label" style="width:100%;text-align:left;" for="type_account"><?=$Result_form->alamat." ".$Result_form->nm_city."<br>".$Result_form->nm_provincy?></label>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 col-lg-2 control-label" for="no_account">Nama Domain:</label>
				<div class="col-sm-6 col-lg-4 controls">
					<label class="col-sm-3 col-lg-2 control-label" style="width:100%;text-align:left;" for="type_account"><?=$Result_form->nm_domain?></label>
				</div>
				<label class="col-sm-3 col-lg-2 control-label" for="no_account">Telepon:</label>
				<div class="col-sm-6 col-lg-4 controls">
					<label class="col-sm-3 col-lg-2 control-label" style="width:100%;text-align:left;" for="type_account"><?=$Result_form->no_telepon?></label>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 col-lg-2 control-label" for="no_account">Total Tagihan:</label>
				<div class="col-sm-6 col-lg-4 controls">
					<label class="col-sm-3 col-lg-2 control-label" style="width:100%;text-align:left;" for="type_account"><?="Rp. ".number_format($Result_form->total_tagihan,0,',','.')?></label>
				</div>
				<label class="col-sm-3 col-lg-2 control-label" for="no_account">Nama Perusahaan:</label>
				<div class="col-sm-6 col-lg-4 controls">
					<label class="col-sm-3 col-lg-2 control-label" style="width:100%;text-align:left;" for="type_account"><?=$Result_form->nm_perusahaan." (".$Result_form->nm_type_company.")"?></label>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 col-lg-2 control-label" for="no_account">Template:</label>
				<div class="col-sm-6 col-lg-4 controls">
				<div class="fileupload fileupload-new" data-provides="fileupload">
					<div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;">
						<img src="<?=base_url()."uploads/template/".$Result_form->thumb?>" style="width:200px;height:150px;" />
					</div>
				</div>
				<br>
				<label class="col-sm-3 col-lg-2 control-label" style="width:100%;text-align:left;" for="type_account"><?=$Result_form->nm_template?></label>
				</div>
				<label class="col-sm-3 col-lg-2 control-label" for="no_account">Foto Identitas:</label>
				<div class="col-sm-6 col-lg-4 controls">
				<div class="fileupload fileupload-new" data-provides="fileupload">
					<div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;">
						<img src="<?=base_url()."uploads/".$Result_form->upload_identitas?>" style="width:200px;height:150px;" />
					</div>
				</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 col-lg-2 control-label" for="no_account">URL Hosting:</label>
				<div class="col-sm-6 col-lg-4 controls">
					<label class="col-sm-3 col-lg-2 control-label" style="width:100%;text-align:left;" for="type_account"><?=$Result_form->url_hosting?></label>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 col-lg-2 control-label" for="no_account">User Cpanel:</label>
				<div class="col-sm-6 col-lg-4 controls">
					<label class="col-sm-3 col-lg-2 control-label" style="width:100%;text-align:left;" for="type_account"><?=$Result_form->user_cpanel?></label>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 col-lg-2 control-label" for="no_account">Password Cpanel:</label>
				<div class="col-sm-6 col-lg-4 controls">
					<label class="col-sm-3 col-lg-2 control-label" style="width:100%;text-align:left;" for="type_account"><?=$Result_form->pass_cpanel?></label>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
					<input class="btn btn-primary" value="OK" type="submit">
				</div>
			</div>
		</form>
	</div>
</div>
</div>
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


