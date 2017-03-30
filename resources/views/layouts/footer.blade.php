</section>
</body>
</html>
<!-- requirejs -->
<script src="{{ URL::asset('') }}plugins/node-waves/waves.js"></script>
<script>
	var baseAsset = "{{ URL::asset('') }}";
</script>
@yield("js")
<div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
			   <div class="modal-dialog" role="document">
				   <div class="modal-content">
					   <div class="modal-header">
						   <h4 class="modal-title" id="defaultModalLabel">Modal title</h4>
					   </div>
					   <div class="modal-body">
						   Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin sodales orci ante, sed ornare eros vestibulum ut. Ut accumsan
						   vitae eros sit amet tristique. Nullam scelerisque nunc enim, non dignissim nibh faucibus ullamcorper.
						   Fusce pulvinar libero vel ligula iaculis ullamcorper. Integer dapibus, mi ac tempor varius, purus
						   nibh mattis erat, vitae porta nunc nisi non tellus. Vivamus mollis ante non massa egestas fringilla.
						   Vestibulum egestas consectetur nunc at ultricies. Morbi quis consectetur nunc.
					   </div>
					   <div class="modal-footer">
						   <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
					   </div>
				   </div>
			   </div>
		   </div>
<script data-main="{{ URL::asset('') }}js/config" src="{{ URL::asset('js/requirejs.js') }}"></script>
<script>
	require(['config'], function (){
	     require([baseAsset+"js/custom.js"]);
	});
</script>
