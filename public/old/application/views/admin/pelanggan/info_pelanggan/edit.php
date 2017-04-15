<style>
.l{
width: 100%!important;
text-align: left!important;
}
</style>
<div class="col-md-12">
<div class="box">
	<div class="box-title">
		<h3>Lihat Pelanggan</h3>
			<div class="box-tool">
				<a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
			</div>
</div>
	<div class="box-content">
		<span id="ajax-status"></span>
        <span id="message"  ></span>
		<form id="form_input" action="<?=site_url('pelanggan/pelanggan_history')?>" class="form-horizontal"  method="post">
			<div class="form-group">
				<label class="col-sm-3 col-lg-2 control-label" for="type_account">Foto Identitas</label>
				<div class="col-sm-6 col-lg-4 controls">
				<div class="fileupload fileupload-new" data-provides="fileupload">
					<div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;">
						<img src="<?=base_url()."uploads/".$Result_form->upload_identitas?>" style="width:200px;height:150px;" />
					</div>
				</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 col-lg-2 control-label" for="no_account">ID Pelanggan:</label>
				<div class="col-sm-6 col-lg-4 controls">
					<label class="col-sm-3 col-lg-2 control-label l" for="no_account"><?=$Result_form->Id_pelanggan?></label>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 col-lg-2 control-label" for="no_account">Nama:</label>
				<div class="col-sm-6 col-lg-4 controls">
					<label class="col-sm-3 col-lg-2 control-label l" for="no_account"><?=$Result_form->full_name?></label>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 col-lg-2 control-label">Email:</label>
				<div class="col-sm-9 col-lg-10 controls">
					<label class="col-sm-3 col-lg-2 control-label l" for="no_account"><?=$Result_form->email?></label>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 col-lg-2 control-label">Alamat:</label>
				<div class="col-sm-9 col-lg-10 controls">
					<label class="col-sm-3 col-lg-2 control-label l" for="no_account"><?=$Result_form->alamat?></label>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 col-lg-2 control-label">Kota:</label>
				<div class="col-sm-9 col-lg-10 controls">
					<label class="col-sm-3 col-lg-2 control-label l" for="no_account"><?=$Result_form->nm_city?></label>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 col-lg-2 control-label">Provinsi:</label>
				<div class="col-sm-9 col-lg-10 controls">
					<label class="col-sm-3 col-lg-2 control-label l" for="no_account"><?=$Result_form->nm_provincy?></label>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 col-lg-2 control-label">Telepon:</label>
				<div class="col-sm-9 col-lg-10 controls">
					<label class="col-sm-3 col-lg-2 control-label l" for="no_account"><?=$Result_form->no_telepon?></label>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 col-lg-2 control-label">Nama Perusahaan:</label>
				<div class="col-sm-9 col-lg-10 controls">
					<label class="col-sm-3 col-lg-2 control-label l" for="no_account"><?=$Result_form->nm_perusahaan?></label>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 col-lg-2 control-label">Jenis Perusahaan:</label>
				<div class="col-sm-9 col-lg-10 controls">
					<label class="col-sm-3 col-lg-2 control-label l" for="no_account"><?=$Result_form->nm_type_company?></label>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
					<input class="btn btn-primary" value="OK" type="submit"/>
				</div>
			</div>
		</form>
	</div>
</div>
</div>

