<!--Content-->
<div id="content">
<ul class="breadcrumb">
	<li><a href="#" class="glyphicons home">Home</a></li>
	<li class="divider"></li>
	<li>Baca Newsletter</li>
</ul>
<div class="separator bottom"></div>
<div class="innerLR">
	<!-- Widget -->
        <div class="widget widget-gray widget-body-gray">
                <div class="widget-body">
                        <!-- Row -->
                        <div class="row">
								<p class='date_news'><?=$pelanggan->DateToIndo($Result_form->tgl)?></p>
								<div class='area-isi'>
									<p class='judul'><?=$Result_form->judul?></p>
									<?=$Result_form->isi_newsletter?>
									<?php
									if($lampiran->num_rows>0){
									echo"<br></br><p><b>Lampiran</b></p>";
										foreach($lampiran->result() as $wl){
											echo"<div>
												<a target='_blank' href='http://shoplution.firecode-it.com/uploads/lampiran/".$wl->path_file."'>".$wl->path_file."</a>
											</div>";
										}
									}	
									?>
								</div>
                        </div>
                        <!-- // Row END -->
                        <!-- Form actions -->
                        <div class="form-actions">
                                <button type="button" onClick='window.location="<?=site_url('pelanggan/newsletter')?>";' class="btn btn-icon btn-primary glyphicons circle_ok"  ><i></i>OK</button>
                        </div>
                        <!-- // Form actions END -->
                        
                </div>
</div>
</div>
		<!-- End Wrapper -->
</div>
<style>
.date_news{
font-size: 16px;
padding: 6px 15px;
color: #1F84F1;
font-family: calibri;
border: 1px solid #D6D6D6;
background: #EEE;
}
.area-isi{
padding: 10px 35px;
border: 1px solid #E7E3E3;
margin: 5px 0;
}
.judul{
font-size: 15px;
font-family: calibri;
font-weight: bold;
}
</style>

