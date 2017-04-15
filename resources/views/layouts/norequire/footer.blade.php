</section>
</body>
</html>
<!-- requirejs -->
<script src="{{ URL::asset('') }}plugins/jquery/jquery.js"></script>
<script src="{{ URL::asset('') }}plugins/bootstrap/js/bootstrap.js"></script>
<script src="{{ URL::asset('') }}plugins/bootstrap-select/js/bootstrap-select.js"></script>
<script src="{{ URL::asset('') }}plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
<script src="{{ URL::asset('') }}plugins/node-waves/waves.js"></script>
<script src="{{ URL::asset('') }}plugins/jquery-countto/jquery.countTo.js"></script>
<script src="{{ URL::asset('') }}plugins/morrisjs/morris.js"></script>
<script src="{{ URL::asset('') }}plugins/raphael/raphael.min.js"></script>
<script src="{{ URL::asset('') }}plugins/chartjs/Chart.bundle.js"></script>
<script src="{{ URL::asset('') }}plugins/jquery-sparkline/jquery.sparkline.js"></script>
<script src="{{ URL::asset('') }}plugins/sweetalert/sweetalert.min.js"></script>
<script src="{{ URL::asset('') }}js/admin.js"></script>
<script src="{{ URL::asset('') }}js/pages/index.js"></script>
<script src="{{ URL::asset('') }}js/demo.js"></script>
<script src="{{ URL::asset('') }}plugins/jquery-datatable/jquery.dataTables.js"></script>
<script src="{{ URL::asset('') }}plugins/jquery-leanmodal/jquery.leanModal.min.js"></script>
<script src="{{ URL::asset('') }}plugins/form/jqueryForm.js"></script>
<script>
	var baseAsset = "{{ URL::asset('') }}";
</script>
@yield("js")
