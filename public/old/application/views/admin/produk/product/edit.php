<!--Content-->
<div id="content">
<ul class="breadcrumb">
	<li><a href="#" class="glyphicons home">Home</a></li>
	<li class="divider"></li>
	<li>Produk</li>
	<li class="divider"></li>
	<li>Edit Produk</li>
</ul>
<div class="separator bottom"></div>
<div class="innerLR">

<form class="form-horizontal" id="form_input" method="POST" onSubmit="tinyMCE.triggerSave();" action="<?=site_url('product/update/product')?>" enctype="multipart/form-data">
	<!-- Widget -->
        <div class="widget widget-gray widget-body-gray">
                <!-- Widget heading -->
                <div class="widget-head"><h4 class="heading">Edit Produk</h4></div>
                <!-- // Widget heading END -->
                <div class="widget-body">
                        <!-- Row -->
                        <div class="row">
						<span id="ajax-status" style="display:none;"></span>
						<span id="message" style="display:none;"></span>
                        <!-- Column -->
						<div class="tabsbar tabsbar-2">
							<ul class="row row-merge">
								<li class="active"><a href="#Umum" data-toggle="tab"><i></i>General</a></li>
								<li><a href="#data" data-toggle="tab"><i></i>Data Produk</a></li>
								<li><a href="#ket" data-toggle="tab"><i></i>Keterangan Produk</a></li>
							</ul>
						</div>
						<div class="tab-content">
								<div class="tab-pane active" id="Umum">
									<div class="col-md-6">
										<!-- Group -->
											<div class="form-group">
													<label class="col-md-4 control-label" for="category_product">* Group Kategori</label>
													 <div class="col-md-8">
														<select class="col-md-12 form-control" name='category_product'>
														<option value='0' selected>--Pilih Group Kategori--</option>
														<?php
														foreach($category_product->result() as $r){
															$selected="";
															if($Result_form->category_product==$r->idx_category){
																$selected="selected";
															}
															echo'<option '.$selected.' value="'.$r->idx_category.'">'.$r->name.'</option>';
														}
														?>
														</select>
													</div>
											</div>
										<!-- // Group END -->
										<!-- Group -->
										<div class="form-group">
											<label class="col-md-4 control-label" for="nm_product">* Nama Produk</label>
											<div class="col-md-8"><input class="form-control" value="<?=$Result_form->nm_product?>" id="nm_product" name="nm_product" type="text"></div>
											<input type='hidden' name='idx_product' value="<?=$Result_form->idx_product?>" />
										</div>
										<!-- // Group END -->
										<!-- Group -->
										<div class="form-group">
											<label class="col-md-4 control-label" for="tag_desc">SEO Description</label>
											<div class="col-md-8"><input class="form-control" value="<?=$Result_form->tag_desc?>" id="tag_desc" name="tag_desc" type="text"></div>
										</div>
										<!-- // Group END -->
										<!-- Group -->
										<div class="form-group">
											<label class="col-md-4 control-label" for="tag_key">SEO Keywords</label>
											<div class="col-md-8"><input class="form-control" value="<?=$Result_form->tag_key?>" id="tag_key" name="tag_key" type="text"></div>
										</div>
										<!-- // Group END -->
										<!-- Group -->
										<div class="form-group">
											<label class="col-md-4 control-label" for="tag">Taging Produk</label>
											<div class="col-md-8"><input class="form-control" value="<?=$Result_form->tag?>" id="tag" name="tag" type="text"><p>Pisahkan dengan tanda koma</p></div>
										</div>
										<!-- // Group END -->										<div class="form-actions">											<a href="#data" data-toggle="tab" class="btn btn-icon btn-primary glyphicons circle_ok"><i></i>Lanjut</a>										</div>
									</div>
								</div>
								<div class="tab-pane" id="data">
									<div class="col-md-6">
											<div class="form-group">
													<label class="col-md-4 control-label" for="type_product">* Tipe Produk</label>
													 <div class="col-md-8">
														<input type="hidden" name="type_product_old" value="<?=$Result_form->type_product?>"/>
														<select class="col-md-12 form-control" onChange='toogle_attr("<?=$Result_form->idx_product?>");' name='type_product' id='type_product'>
														<?php if($Result_form->type_product==1){
															echo"
															<option value='0'>--Pilih Tipe Produk--</option>
															<option value='1' selected>Produk Single</option>
															<option value='2'>Produk Group</option>
															<option value='3'>Produk Seri</option>";
														}
														if($Result_form->type_product==2){
															echo"
															<option value='0'>--Pilih Tipe Produk--</option>
															<option value='1'>Produk Single</option>
															<option value='2' selected>Produk Group</option>
															<option value='3'>Produk Seri</option>";
														}
														if($Result_form->type_product==3){
															echo"
															<option value='0'>--Pilih Tipe Produk--</option>
															<option value='1'>Produk Single</option>
															<option value='2'>Produk Group</option>
															<option value='3' selected>Produk Seri</option>";
														}
														?>
														</select>
													</div>
											</div>
											<!-- Group -->
											<div class="form-group">
													<label class="col-md-4 control-label" for="idx_category_product">Brand</label>
													 <div class="col-md-8">
														<select class="col-md-12 form-control" name='idx_brand'>
														<option value="">--Pilih Brand--</option>
														<?php
														foreach($brand->result() as $b){
															$selected="";
															if($Result_form->idx_brand==$b->idx_brand){
																$selected="selected";
															}
															echo'<option '.$selected.' value="'.$b->idx_brand.'">'.$b->nm_brand.'</option>';
														}
														?>
														</select>
													</div>
											</div>
											<!-- // Group END -->
											<?php
												$checked="";
												$style='style="display:none;"';
												if($Result_form->idx_ukuran<>0){
													$checked="checked";
													$style='';
												}
											
											?>
											<!-- Group -->
											<div class="form-group">
													<label class="col-md-4 control-label" for="idx_ukuran">Sisipkan Tabel Ukuran</label>
													 <div class="col-md-8">
														<input type="checkbox" <?=$checked?> style="margin: 10px 0;" id="fl_size" name="fl_size" />
													</div>
											</div>
											<script>
												$("#fl_size").click(function(){
													if($('#fl_size').is(':checked')==true){
														$("#t_ukuran").show();
													}else{
														$("#t_ukuran").hide();
													}
												});
											</script>
												<div class="form-group" id="t_ukuran" <?=$style?>>
													<label class="col-md-4 control-label" for="idx_ukuran"></label>
													 <div class="col-md-8">
														<select class="col-md-12 form-control" name='idx_ukuran'>
														<option value="">--Pilih Tabel Ukuran--</option>
														<?php
														foreach($ukuran->result() as $u){
															$selected="";
															if($Result_form->idx_ukuran==$u->idx_ukuran){
																$selected="selected";
															}
															echo'<option '.$selected.' value="'.$u->idx_ukuran.'">'.$u->nm_ukuran.'</option>';
														}
														?>
														</select>
													</div>
												</div>
												<!-- Group -->
												<div class="form-group">
														<label class="col-md-4 control-label" for="harga">* Harga</label>
														<div class="col-md-8"><input class="form-control" value="<?=$Result_form->harga?>" id="harga" style='width: 20em;' name="harga" type="text"></div>
												</div>
												<!-- // Group END -->
												 <!-- Group -->
												<div class="form-group">
														<label class="col-md-4 control-label" for="discount">Discount (%)</label>
														<div class="col-md-8"><input class="form-control" value="<?=$Result_form->discount?>" id="discount" style='width: 5em;' name="discount" type="text"></div>
												</div>
												<!-- // Group END -->
												 <!-- Group -->
												<div class="form-group">
														<label class="col-md-4 control-label" for="harga_discount">Harga Discount</label>
														<div class="col-md-8"><input class="form-control" value="<?=$Result_form->harga_discount?>" onBlur='procese_discount();' id="harga_discount" style='width: 20em;' name="harga_discount" type="text"></div>
												</div>
												 <!-- // Group END -->
												  <!-- Group -->
												<div class="form-group">
														<label class="col-md-4 control-label" for="harga">SKU</label>
														<div class="col-md-8"><input class="form-control" value="<?=$Result_form->sku?>" id="sku" style='width: 20em;' name="sku" type="text"></div>
												</div>
												<!-- // Group END -->
												  <!-- Group -->
												<div class="form-group">
														<label class="col-md-4 control-label" for="Berat">Berat (Gram)</label>
														<div class="col-md-8"><input class="form-control" value="<?=$Result_form->berat?>"  id="berat" style='width: 20em;' name="berat" type="text"></div>
												</div>
												 <!-- // Group END -->
												 <!-- Group -->
												<div class="form-group">
														<label class="col-md-4 control-label" for="harga">* Minimum Stok</label>
														<div class="col-md-8"><input class="form-control" value="<?=$Result_form->minimum_stock?>" id="minimum_stock" style='width: 20em;' name="minimum_stock" type="text"></div>
												</div>
												<!-- // Group END -->
												<!-- Group -->
											<div class="form-group">
													<label class="col-md-4 control-label" for="image">Gambar Produk</label>
													
												   <div class="col-md-8">
												   <?php if($Result_form->thumb){
													echo'<img src="'.base_url().'uploads/product/'.$Result_form->thumb.'"/>';
												   }
												   ?>
												   <input type='hidden' name='image_text' value="<?=$Result_form->path_image?>" />
												   <input type='hidden' name='thumb_text' value="<?=$Result_form->thumb?>" />
												   <input type='file' style='margin: 1em 0;'name='image'><p style='color:#F1050E;margin-top:5px;'>Max 100Kb Ext: JPG,PNG,GIF </p>
												   </div>
											</div>
											<!-- // Group END -->
											<!-- Group -->
											<?php if($fl_gallery==1){ ?>
											<div class="form-group">
													<label class="col-md-4 control-label"></label>
													<div class="col-md-8"><a href="<?=site_url('product/gallery/'.$Result_form->idx_product)?>">Tambah Galleri Gambar</a></p></div>
											</div>
											<?php }?>
											<!-- // Group END -->										<div class="form-actions">											<a href="#ket" data-toggle="tab" class="btn btn-icon btn-primary glyphicons circle_ok"><i></i>Lanjut</a>										</div>
									</div>
									<!-- // Column END -->
								<!-- Column -->
                                <div class="col-md-6" id='product_group' style='display:none;'>
										<div id='box-attribute'>
											<div class='atr' id='atr'>
												<div class="form-group">
														<label class="col-md-4 control-label" for="stock">Atribut</label>
														<div class="col-md-8">
															<select class="col-md-12 form-control" name='idx_attribute[]'>
															<?php
																foreach($attribute->result() as $r){
																	$selected='';
																	if($Result_form->type_product==2){
																		if($this->product_model->idx_atrribute($Result_form->idx_product)==$r->idx_attribute){
																			$selected='selected';
																		}
																	}
																	echo'<option '.$selected.' value="'.$r->idx_attribute.'">'.$r->nm_attribute.'</option>';
																}
															?>
															</select>
														</div>
												</div>
												
														<div id="element_atribut">
															<?php
															if($Result_form->type_product==2){
																$q=$this->product_model->attr_product($Result_form->idx_product);
																$n=0;
																foreach($q->result() as $r){
																	if($n>0){
																		$button='<input type="button" value="Hapus" onClick=del_elm("atr_elm'.$n.'","'.$r->idx_attribute_product.'") class="btn-primary" style="padding: 7px 5px;border: none;"/>';
																		$id="atr_elm".$n;
																	}else{
																		$button='';
																		$id="";
																	}
																	echo'
																		<div class="form-group" id="'.$id.'">
																				<label class="col-md-4 control-label" for="element">Elemen Atribut</label>
																				<div class="col-md-8"><input type="hidden" name="idx_attribute_product[]" value="'.$r->idx_attribute_product.'"/><input class="form-control" name="element[]" value="'.$r->desc_attribute.'" placeholder="Elemen Atribut" type="text" style="width: 12em;float: left;margin-right: 5px;"><input class="form-control" name="stock_attribute[]" style="width: 5em;float: left;margin-right: 5px;" value="'.($r->stock - $r->stock_akhir).'" placeholder="Stok" type="text">'.$button.'</div>
																		</div>';
																	$n++;
																}
															}else{
																echo'
																	<div class="form-group">
																			<label class="col-md-4 control-label" for="element">Elemen Atribut</label>
																			<div class="col-md-8"><input class="form-control" name="element[]"  placeholder="Elemen Atribut" type="text" style="width: 12em;float: left;margin-right: 5px;"><input class="form-control" name="stock_attribute[]" style="width: 5em;float: left;margin-right: 5px;"  placeholder="Stok" type="text"></div>
																	</div>
																';
															}
															
															?>
															
														</div>
												<div class="form-group">
													<label class="col-md-4 control-label" for="	"></label>
													<div class="col-md-8"><button type="button" id='add_element_atribut' class="btn-primary"><i></i>Tambah Elemen Atribut</button></div>
												</div>
											</div>
											
										</div>
										 <!-- Group -->
                                </div>
                                <!-- // Column END -->
								<!-- Column -->
                                <div class="col-md-6" id='product_seri' style='display:none;'>
										<div id='box-attribute'>
											<div class='atr' id='atr'>
												<div class="form-group">
													<label class="col-md-4 control-label" for="element">Stok</label>
													<?php
													if($Result_form->type_product==3){
																$stock=$this->product_model->attr_product($Result_form->idx_product)->row();
																$stock=$stock->stock - $stock->stock_akhir; 
													}else{
														$stock=''; 
													}
													?>
													<div class="col-md-8"><input class="form-control" name="stock_seri" value="<?=$stock?>" placeholder='Stok' type="text"></div>
												</div>
												<div class="form-group">
														<label class="col-md-4 control-label" for="stock">Atribut</label>
														<div class="col-md-8">
															<select class="col-md-12 form-control" name='idx_attribute_seri[]'>
															<?php
																foreach($attribute->result() as $r){
																	$selected='';
																	if($Result_form->type_product==3){
																		if($this->product_model->idx_atrribute($Result_form->idx_product)==$r->idx_attribute){
																			$selected='selected';
																		}
																	}
																	echo'<option '.$selected.' value="'.$r->idx_attribute.'">'.$r->nm_attribute.'</option>';
																}
															?>
															</select>
														</div>
												</div>
												
														<div id="element_atribut_seri">
															<?php
															if($Result_form->type_product==3){
																$q=$this->product_model->attr_product($Result_form->idx_product);
																$n=0;
																foreach($q->result() as $r){
																	if($n>0){
																		$button='<input type="button" value="Hapus" onClick=del_elm("atr_elm_seri'.$n.'","") class="btn-primary" style="padding: 7px 5px;border: none;"/>';
																		$id="atr_elm_seri".$n;
																	}else{
																		$button='';
																		$id="";
																	}
																	echo'
																		<div class="form-group" id="'.$id.'">
																				<label class="col-md-4 control-label" for="element_seri">Elemen Atribut</label>
																				<div class="col-md-8"><input class="form-control" name="element_seri[]" value="'.$r->desc_attribute.'" placeholder="Elemen Atribut" type="text" style="width: 12em;float: left;margin-right: 5px;">'.$button.'</div>
																		</div>';
																	$n++;
																}
															}else{
																echo'
																	<div class="form-group">
																			<label class="col-md-4 control-label" for="element_seri">Elemen Atribut</label>
																			<div class="col-md-8"><input class="form-control" name="element_seri[]"  placeholder="Elemen Atribut" type="text" style="width: 12em;float: left;margin-right: 5px;"></div>
																	</div>
																';
															}
															
															?>
															
														</div>
												<div class="form-group">
													<label class="col-md-4 control-label" for="	"></label>
													<div class="col-md-8"><button type="button" id='add_element_atribut_seri' class="btn-primary"><i></i>Tambah Elemen Atribut</button></div>
												</div>
											</div>
											
										</div>
										 <!-- Group -->
                                </div>
                                <!-- // Column END -->
								<div class="col-md-6" id='produk_single'  style='display:none;'>
									<!-- Group -->
									<div class="form-group">
										<label class="col-md-4 control-label" for="stock">Atribut</label>
										<div class="col-md-8">
											<select class="col-md-12 form-control" name='idx_attribute_single'>
												<?php
													foreach($attribute->result() as $rs){
														if($Result_form->type_product==1){
															if($this->product_model->idx_atrribute($Result_form->idx_product)==$rs->idx_attribute){
																$selected='selected';
															}
														}
														echo'<option value="'.$rs->idx_attribute.'">'.$rs->nm_attribute.'</option>';
													}
												?>
											</select>
										</div>
										<!-- // Group END -->
									</div>
									<?php
									if($Result_form->type_product==1){
										$qs	=$this->product_model->attr_product($Result_form->idx_product)->row();
										$d	=$qs->desc_attribute;
										$s	=$qs->stock - $qs->stock_akhir;
									}else{
										$d	='';
										$s	='';
									}
									?>
									<div class="form-group">
										<label class="col-md-4 control-label" for="element">Elemen Atribut</label>
										<div class="col-md-8"><input class="form-control" value="<?=$d?>" name="element_single" placeholder='Elemen Atribut' type="text" style="width: 12em;float: left;margin-right: 5px;"><input class="form-control" name="stock_attribute_single" value="<?=$s?>" style='width: 5em;float: left;margin-right: 5px;' placeholder='Stok' type="text"></div>
									</div>	
								</div>						
								</div>
								<div class="tab-pane" id="ket">
									<div class="col-md-12">
										<!-- Group -->
										 <div class="form-group">
											<label class="col-md-4 control-label" for="ket">* Keterangan</label>
											<div class="col-md-8"><textarea class="form-control" name='ket'><?=$Result_form->ket?></textarea></div>
										</div>
										<!-- // Group END -->
										<!-- Group -->
										<div class="form-group">
											<label class="col-md-4 control-label" for="spesifikasi">* Spesifikasi Product</label>
											<div class="col-md-8"><textarea class="form-control" name='spesifikasi'><?=$Result_form->spesifikasi?></textarea></div>
										</div>
										<!-- // Group END -->
									</div>																											<div class="form-actions">											<button type="submit" class="btn btn-icon btn-primary glyphicons circle_ok"><i></i>Save</button>											<button type="reset" class="btn btn-icon btn-default glyphicons circle_remove"><i></i>Reset</button>									</div>
								</div>
							</div>
                           </div>
                        <!-- // Row END -->
                        
                        <!-- Form actions -->
                        <!-- // Form actions END -->
                        
                </div>
	

</div>
</form>
</div>
		
				<!-- End Wrapper -->
		</div>	
<script>
$(document).ready(function() {
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
	var n=1;
	$("#add_element").click(function(){
		var html='<div class="atr" id="atr'+n+'"><div class="form-group"><label class="col-md-4 control-label" for="Atribut">Atribut</label><div class="col-md-8"><select class="col-md-12 form-control" name="idx_attribute[]"><?php foreach($attribute->result() as $r){ echo'<option value="'.$r->idx_attribute.'">'.$r->nm_attribute.'</option>';} ?> </select></div></div><div class="form-group"><label class="col-md-4 control-label" for="element">Elemen Atribut</label><div class="col-md-8"><input class="form-control"  name="element[]" type="text"><p style="color:#F1050E;margin-top:5px;">Contoh Elemen Atribut: S|M|L|XL </p></div></div><div class="form-group"><label class="col-md-4 control-label" for="element"></label><div class="col-md-8"><button type="button" onClick=del("atr'+n+'") class="btn-primary del_element"><i></i>Hapus Atribut</button></div></div></div>';
		$("#box-attribute").append(html);
		n++;
	});
	<?php if($Result_form->type_product==2){ ?>
	var i=<?=$n+1?>;
	<?php }else{ ?>
	var i=1;
	<?php }?>
	$("#add_element_atribut").click(function(){
		var html='<div class="form-group" id="atr_elm'+i+'"><label class="col-md-4 control-label" for="element">Elemen Atribut</label><div class="col-md-8"><input type="hidden" name="idx_attribute_product[]"/><input class="form-control" name="element[]" placeholder="Elemen Atribut" type="text" style="width: 12em;float: left;margin-right: 5px;"><input class="form-control" name="stock_attribute[]" style="width: 5em;float: left;margin-right: 5px;" placeholder="Stok" type="text"><input type="button" value="Hapus" onClick=del_elm("atr_elm'+i+'","") class="btn-primary" style="padding: 7px 5px;border: none;"/></div></div>';
		$("#element_atribut").append(html);
		i++;
	});
	<?php if($Result_form->type_product==3){ ?>
	var x=<?=$n+1?>;
	<?php }else{ ?>
	var x=1;
	<?php }?>
	$("#add_element_atribut_seri").click(function(){
		var html='<div class="form-group" id="atr_elm_seri'+x+'"><label class="col-md-4 control-label" for="element">Elemen Atribut</label><div class="col-md-8"><input class="form-control" name="element_seri[]" placeholder="Elemen Atribut" type="text" style="width: 12em;float: left;margin-right: 5px;"><input type="button" value="Hapus" onClick=del_elm("atr_elm_seri'+x+'","") class="btn-primary" style="padding: 7px 5px;border: none;"/></div></div>';
		$("#element_atribut_seri").append(html);
		x++;
	});
	$("#discount").blur(function(){
		if(($("#harga").val())&&($("#discount").val())){
			if(parseInt($("#discount").val())<=100){
				var n = parseInt($("#harga").val())-((parseInt($("#discount").val())/100)*parseInt($("#harga").val()));
				$("#harga_discount").val(n);
			}else{
				$("#harga_discount").val('');
				$("#discount").val('');
			}
		}else{
			$("#harga_discount").val('');
		}
	});
	$("#harga").change(function(){
			$("#harga_discount").val('');
			$("#discount").val('');
	});
	$("#harga_discount").blur(function(){
		if(($("#harga").val())&&($("#harga_discount").val())){
			if(parseInt($("#harga").val())>=parseInt($("#harga_discount").val())){
				var n =	((parseInt($("#harga").val())-parseInt($("#harga_discount").val()))/parseInt($("#harga").val()))*100;
				$("#discount").val(n);
			}else{
				$("#harga_discount").val('');
				$("#discount").val('');
			}
		}else{
			$("#discount").val('');
		}
	});
	tinymce.init({
		selector: "textarea",
		plugins: "table",
		style_formats: [
			{title: 'Bold text', inline: 'b'},
			{title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
			{title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
			{title: 'Example 1', inline: 'span', classes: 'example1'},
			{title: 'Example 2', inline: 'span', classes: 'example2'},
			{title: 'Table styles'},
			{title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
		],
		formats: {
			alignleft: {selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes: 'left'},
			aligncenter: {selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes: 'center'},
			alignright: {selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes: 'right'},
			alignfull: {selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes: 'full'},
			bold: {inline: 'span', 'classes': 'bold'},
			italic: {inline: 'span', 'classes': 'italic'},
			underline: {inline: 'span', 'classes': 'underline', exact: true},
			strikethrough: {inline: 'del'},
			customformat: {inline: 'span', styles: {color: '#00ff00', fontSize: '20px'}, attributes: {title: 'My custom format'}}
		},
		width :600,
		height:400
	});

});
	function toogle_attr(id){
		if(id){
		$.ajax({
			url: '<?=site_url('product/tb_use_select')?>',
			data:'ID='+id,
			dataType: 'json',
			type: 'POST',
			success: function (data) {
				if(data.use==0){
					add_toogle_attr();
				}else{
					$('#message').html('<div class="alert alert-error"><p>'+data.mes+'</p></div>');
					$('#message').show();
					$("#form_input")[0].reset();
				}
			}
		});
		}else{
			add_toogle_attr();
		}
	}
	function del(n){
		$("#"+n).remove()
	}
	function del_elm(elm,id){
		if(id){
			$.ajax({
				url: '<?=site_url('product/tb_use')?>',
				data:'ID='+id,
				dataType: 'json',
				type: 'POST',
				success: function (data) {
					if(data.use==0){
						$("#"+elm).remove();
					}else{
						$('#message').html('<div class="alert alert-error"><p>'+data.mes+'</p></div>');
						$('#message').show();
					}
				}
			});
		}else{
			$("#"+elm).remove();
		}
	}
	function add_toogle_attr(){
		if($("#type_product").val()!=0){
						if($("#type_product").val()==1){
							$("#produk_single").show();
							$("#product_group").hide();
							$("#product_seri").hide();
						}
						if($("#type_product").val()==2){
							$("#produk_single").hide();
							$("#product_seri").hide();
							$("#product_group").show();
						}
						if($("#type_product").val()==3){
							$("#product_seri").show();
							$("#produk_single").hide();
							$("#product_group").hide();
						}
					}else{
						$("#product_seri").hide();
							$("#produk_single").hide();
							$("#product_group").hide();
					}
	}
	window.onload = toogle_attr('');
</script>



