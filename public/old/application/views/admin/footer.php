<!-- Sticky Footer -->
		<!--<div id="footer" class="visible-desktop hidden-print">
	      	<div class="wrap">
	      		<ul>
	      			<li class="dropdown dropup">
	      				<span data-toggle="dropdown" class="dropdown-toggle glyphicons cogwheel text" title=""><i></i><span class="hidden-phone">Layout Options</span></span>
	      				<ul class="dropdown-menu pull-left">
	      					<li class=""><a href="#" data-toggle="layout" data-layout="fixed" title="">Fixed layout</a></li>
	      					<li class="active"><a href="#" data-toggle="layout" data-layout="fluid" title="">Fluid layout</a></li>
	      				</ul>
	      			</li>
	      			<li class="dropdown dropup">
	      				<span data-toggle="dropdown" class="dropdown-toggle glyphicons settings text" title=""><i></i><span class="hidden-phone">Menu Options</span></span>
	      				<ul class="dropdown-menu pull-left">
	      					<li class="active"><a href="#" data-toggle="menuPosition" data-menuposition="left-menu" title="">Left menu</a></li>
	      					<li class=""><a href="#" data-toggle="menuPosition" data-menuposition="right-menu" title="">Right menu</a></li>
	      				</ul>
	      			</li>
	      			<li><a href="http://demo.mosaicpro.biz/adminplus/php/documentation.html?lang=en" class="glyphicons circle_question_mark text" title=""><i></i><span class="hidden-phone">Documentation</span></a></li>
	      		</ul>
	      	</div>
	    </div>-->
	    				
	</div>
	
	<div id="themer" class="collapse">
		<div class="wrapper">
			<span class="close2">× close</span>
			<h4>Themer <span>color options</span></h4>
			<ul>
				<li>Theme: <select id="themer-theme" class="pull-right"><option selected="selected" value="0">Default</option><option value="1">Brown</option><option value="2">Purple-Gray</option><option value="3">Purple-Wine</option><option value="4">Blue-Gray</option><option value="5">Green Army</option><option value="6">Black &amp; White</option></select><div class="clearfix"></div></li>
				<li>Primary Color: <span class="minicolors minicolors-position-left"><input value="#37a6cd" class="minicolors-hidden" maxlength="7" size="7" data-type="minicolors" data-default="#DA4C4C" data-slider="hue" data-textfield="false" data-position="left" id="themer-primary-cp" type="text"><span class="minicolors-swatch"><span style="background-color: rgb(55, 166, 205);"></span></span><span class="minicolors-panel minicolors-slider-hue"><span class="minicolors-slider"><span style="top: 68.5px;" class="minicolors-picker"></span></span><span class="minicolors-opacity-slider"><span class="minicolors-picker"></span></span><span style="background-color: rgb(0, 187, 255);" class="minicolors-grid"><span class="minicolors-grid-inner"></span><span style="top: 29px; left: 110px;" class="minicolors-picker"><span></span></span></span></span></span><div class="clearfix"></div></li>
				<li>
					<span class="link" id="themer-custom-reset">reset theme</span>
					<span class="pull-right"><label>advanced <input value="1" id="themer-advanced-toggle" type="checkbox"></label></span>
				</li>
			</ul>
			<div id="themer-getcode" class="hide">
				<hr class="separator">
				<button class="btn btn-primary btn-small pull-right btn-icon glyphicons download" id="themer-getcode-less"><i></i>Get LESS</button>
				<button class="btn btn-inverse btn-small pull-right btn-icon glyphicons download" id="themer-getcode-css"><i></i>Get CSS</button>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
	
	<!-- JQueryUI v1.9.2 -->
	<script src="<?=$assets?>js/admin/jquery-ui-1.js"></script>
	
	<!-- JQueryUI Touch Punch -->
	<!-- small hack that enables the use of touch events on sites using the jQuery UI user interface library -->
	<script src="<?=$assets?>js/admin/jquery_002.js"></script>
	
	<!-- MiniColors -->
	<script src="<?=$assets?>js/admin/jquery_005.js"></script>
	
	<!-- Select2 -->
	<script src="<?=$assets?>js/admin/select2.js"></script>
	
	<!-- jQuery Slim Scroll Plugin -->
	<script src="<?=$assets?>js/admin/jquery_007.js"></script>
	
	<!-- Common Demo Script -->
	<script src="<?=$assets?>js/admin/common.js"></script>
	
	<!-- Holder Plugin -->
	<script src="<?=$assets?>js/admin/holder.js"></script>
	<script>Holder.add_theme("dark", {background:"#000", foreground:"#aaa", size:9})</script>
	
	<!-- Twitter Feed -->
	<script src="<?=$assets?>js/admin/twitter.js"></script>
	
	<!-- Colors -->
	<script>
	var primaryColor = '#4a8bc2',
		dangerColor = '#b55151',
		successColor = '#609450',
		warningColor = '#ab7a4b',
		inverseColor = '#45484d';
	</script>
	
	<!-- Themer -->
	<script>
	var themerPrimaryColor = '#DA4C4C';
	</script>
	<script src="<?=$assets?>js/admin/jquery_004.js"></script>
	<script src="<?=$assets?>js/admin/themer.js"></script>
	
	
	
	
	<!-- Resize Script -->
	<script src="<?=$assets?>js/admin/jquery_003.js"></script>
	
	<!-- Uniform -->
	<script src="<?=$assets?>js/admin/jquery.js"></script>
	<script src="<?=$assets?>js/admin/jquery.form.js"></script>
	<!-- Bootstrap Script -->
	<script src="<?=$assets?>js/admin/bootstrap.js"></script>
	
	<!-- Bootstrap Extended -->
	<script src="<?=$assets?>js/admin/bootstrap-select.js"></script>
	<!-- <script src="../common/bootstrap/extend/bootstrap-toggle-buttons/static/js/jquery.toggle.buttons.js"></script> -->
	<script src="<?=$assets?>js/admin/bootstrap-switch.js"></script>
	<script src="<?=$assets?>js/admin/twitter-bootstrap-hover-dropdown.js"></script>
	<script src="<?=$assets?>js/admin/jasny-bootstrap.js" type="text/javascript"></script>
	<script src="<?=$assets?>js/admin/bootstrap-fileupload.js" type="text/javascript"></script>
	<script src="<?=$assets?>js/admin/bootbox.js" type="text/javascript"></script>
	<script src="<?=$assets?>js/admin/wysihtml5-0.js" type="text/javascript"></script>
	<script src="<?=$assets?>js/admin/bootstrap-wysihtml5-0.js" type="text/javascript"></script>
	
	<!-- Layout Options DEMO Script -->
	<script src="<?=$assets?>js/admin/layout.js"></script>
	
	<!-- google-code-prettify -->
	<script src="<?=$assets?>js/admin/prettify.js"></script>
	
	<!-- Gritter Notifications Plugin -->
	<script src="<?=$assets?>js/admin/jquery_008.js"></script>
	
	<!-- Notyfy -->
	<script type="text/javascript" src="<?=$assets?>js/admin/jquery_006.js"></script>
	<script type="text/javascript" src="<?=$assets?>js/admin/tiny_mce/tiny_mce.js"></script>

</div></body></html>