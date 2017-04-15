<!--Content-->
<div id="content">
<ul class="breadcrumb">
	<li><a href="#" class="glyphicons home">Home</a></li>
	<li class="divider"></li>
	<li>Shoplution Community</li>
	<li class="divider"></li>
	<li>Info Tagihan</li>
</ul>
<div class="separator bottom"></div>
<div class="innerLR">
<style>
	.dis{
		border: none!important;
		background: transparent!important;
		cursor: default!important;
	}
</style>
	<!-- Widget -->
        <div class="widget widget-gray widget-body-gray">
                <div class="widget-body">
                        <!-- Row -->
                        <div class="row">
                        <!-- Column -->
                                <div class="col-md-6">
									<?php
										include"./fsy/url_induk.php";
										$ch = curl_init ($MAIN_URL."/pelanggan/json_tagihan/".$id_pesanan);
										curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
										$data = curl_exec ($ch);
										print_r($data);
									?>
                                </div>
                                <!-- // Column END -->
                           </div>
                        <!-- // Row END -->
                </div>
			</div>
		</form>
	</div>
<!-- End Wrapper -->
</div>
<script>



