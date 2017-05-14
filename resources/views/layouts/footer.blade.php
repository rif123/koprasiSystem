</section>
</body>
</html>
<!-- requirejs -->
<script src="{{ URL::asset('') }}plugins/node-waves/waves.js"></script>
<script>
	var baseAsset = "{{ URL::asset('') }}";
</script>

<script data-main="{{ URL::asset('') }}js/config.js?v={{rand(10, 123344)}}" src="{{ URL::asset('js/requirejs.js') }}?v={{rand(10, 123344)}}"></script>
<script>
	require(['config'], function (){
	     require([baseAsset+"js/custom.js?v={{rand(10, 123344)}}"]);
	});
</script>
@yield("js")
