</section>
</body>
</html>
<!-- requirejs -->
<script src="{{ URL::asset('') }}plugins/node-waves/waves.js"></script>
<script>
	var baseAsset = "{{ URL::asset('') }}";
</script>
@yield("js")
<script data-main="{{ URL::asset('') }}js/config" src="{{ URL::asset('js/requirejs.js') }}"></script>
<script>
	require(['config'], function (){
	     require([baseAsset+"js/custom.js"]);
	});
</script>
