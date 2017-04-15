<!--Content-->
<div id="content">
<ul class="breadcrumb">
	<li><a href="#" class="glyphicons home">Home</a></li>
	<li class="divider"></li>
	<li>Lihat Wishlist</li>
</ul>
<div class="separator bottom"></div>
<div class="innerLR">
	<!-- Widget -->
        <div class="widget widget-gray widget-body-gray">
                <!-- Widget heading -->
                <div class="widget-head"><h4 class="heading">Lihat Wishlist</h4></div>
                <!-- // Widget heading END -->
                <div class="widget-body">
                        <!-- Row -->
                        <div class="row">
						<span id="ajax-status"></span>
						<span id="message"  ></span>
                        <!-- Column -->
                                <div class="col-md-6">
										<!-- Group -->
                                        <div class="form-group">
                                                <label class="col-md-4 control-label" for="Tanggal">Tanggal</label>
                                                <div class="col-md-8">
													<label class="col-md-4 control-label" style="font-weight:normal;width: 180px;text-align: left;" for="Tanggal"><?=$pelanggan->DateToIndo($Result_form->tgl)?></label>
												</div>
                                        </div>
                                        <!-- // Group END -->
										<?php
											$wproduct=$pelanggan->get_elm("product","idx_product",$Result_form->idx_product);
										?>
										
										<!-- Group -->
                                        <div class="form-group">
                                                <label class="col-md-4 control-label" for="Gambar"></label>
                                                <div class="col-md-8">
													<label class="col-md-4 control-label" style="font-weight:normal;width: 180px;text-align: left;" for="Gambar"><img src="<?=base_url()."/uploads/product/".$wproduct->thumb?>"/></label>
												</div>
                                        </div>
                                        <!-- // Group END -->
										<!-- Group -->
                                        <div class="form-group">
                                                <label class="col-md-4 control-label" for="Nama Produk">Nama Produk</label>
                                                <div class="col-md-8">
													<label class="col-md-4 control-label" style="font-weight:normal;width: 180px;text-align: left;" for="Nama Produk"><?=$wproduct->nm_product?></label>
												</div>
                                        </div>
                                        <!-- // Group END -->
										<!-- Group -->
                                        <div class="form-group">
                                                <label class="col-md-4 control-label" for="Gambar">Brand</label>
                                                <div class="col-md-8">
													<label class="col-md-4 control-label" style="font-weight:normal;width: 180px;text-align: left;" for="Brand"><?php if($wproduct->idx_brand<>0){ echo $pelanggan->get_elm("brand","idx_brand",$wproduct->idx_brand)->nm_brand; }?></label>
												</div>
                                        </div>
                                        <!-- // Group END -->
										<!-- Group -->
                                        <div class="form-group">
                                                <label class="col-md-4 control-label" for="Berat">Berat</label>
                                                <div class="col-md-8">
													<label class="col-md-4 control-label" style="font-weight:normal;width: 180px;text-align: left;" for="Berat"><?=($wproduct->berat/1000)?> Kg</label>
												</div>
                                        </div>
                                        <!-- // Group END -->
										<!-- Group -->
                                        <div class="form-group">
                                                <label class="col-md-4 control-label" for="Stock">Keterangan</label>
                                                <div class="col-md-8">
													<label class="col-md-4 control-label" style="font-weight:normal;width: 180px;text-align: left;" for="Stock">
														<?=$pelanggan->stock_available($Result_form->idx_attribute_product,$Result_form->idx_product,$Result_form->qty)?>
													</label>
												</div>
                                        </div>
                                        <!-- // Group END -->
										<?php
											$harga			='Rp. '.number_format($wproduct->harga,0,',','.');
											$discount		=$wproduct->discount." %";
											$harga_discount	='Rp. '.number_format($wproduct->harga_discount,0,',','.');
											if($pelanggan->check_promo($Result_form->idx_product)->num_rows()>0)
											{
												$pr=$pelanggan->check_promo($wproduct->idx_product)->row();
												if($pr->idx_type_promo==1){
													$harga_discount			=$wproduct->harga-($wproduct->harga*$pr->discount/100);
													$harga_discount			='Rp. '.number_format($harga_discount,0,',','.');
													$discount				=$pr->discount.' %';
												}
											}
										?>
										<!-- Group -->
                                        <div class="form-group">
                                                <label class="col-md-4 control-label" for="Stock">Harga</label>
                                                <div class="col-md-8">
													<label class="col-md-4 control-label" style="font-weight:normal;width: 180px;text-align: left;" for="Harga">
														<?=$harga?>
													</label>
												</div>
                                        </div>
                                        <!-- // Group END -->
										<!-- Group -->
                                        <div class="form-group">
                                                <label class="col-md-4 control-label" for="Stock">Diskon</label>
                                                <div class="col-md-8">
													<label class="col-md-4 control-label" style="font-weight:normal;width: 180px;text-align: left;" for="Diskon">
														<?=$discount?>
													</label>
												</div>
                                        </div>
                                        <!-- // Group END -->
										<!-- Group -->
                                        <div class="form-group">
                                                <label class="col-md-4 control-label" for="Stock">Harga Setelah Diskon</label>
                                                <div class="col-md-8">
													<label class="col-md-4 control-label" style="font-weight:normal;width: 180px;text-align: left;" for="Harga Setelah Diskon">
														<?=$harga_discount?>
													</label>
												</div>
                                        </div>
                                        <!-- // Group END -->
										
                                </div>
                                <!-- // Column END -->
								<div class="col-md-6">
										<?php
											$wp=$pelanggan->get_elm("pelanggan","idx_pelanggan",$Result_form->idx_pelanggan);
										?>
									<!-- Group -->
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="Nama Pelanggan">Nama Pelanggan</label>
                                            <div class="col-md-8">
												<label class="col-md-4 control-label" style="font-weight:normal;width: 180px;text-align: left;" for="Nama Pelanggan">
													<?=$wp->full_name?>
												</label>
											</div>
                                    </div>
                                    <!-- // Group END -->
									<!-- Group -->
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="Email">Email</label>
                                            <div class="col-md-8">
												<label class="col-md-4 control-label" style="font-weight:normal;width: 180px;text-align: left;" for="Email">
													<?=$wp->email?>
												</label>
											</div>
                                    </div>
                                    <!-- // Group END -->
									<!-- Group -->
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="No Telepon">No Telepon</label>
                                            <div class="col-md-8">
												<label class="col-md-4 control-label" style="font-weight:normal;width: 180px;text-align: left;" for="No Telepon">
													<?=$wp->no_telepon?>
												</label>
											</div>
                                    </div>
                                    <!-- // Group END -->
								</div>
                           </div>
                        <!-- // Row END -->
                        <!-- Form actions -->
                        <div class="form-actions">
                                <button type="button" class="btn btn-icon btn-primary glyphicons circle_ok" onClick="window.location='<?=site_url('pelanggan/wishlist')?>'"  ><i></i>Kembali</button>
                        </div>
                        <!-- // Form actions END -->
                        
                </div>
	

</div>
</div>
		
				<!-- End Wrapper -->
</div>


