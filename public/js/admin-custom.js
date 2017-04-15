define([
		'jquery',
		'jquerydatatables',
		'swal',
		'leanmodal'
	], function ($){
	$(document).ready(function(){

		$('#clearupload').on('click',function(e){
			$('#imgupload').val('');
		});
    	$('.table').DataTable({
    		 paging: false,
    		 info: false
    	});

    	$('.alertButton').on('click',function(e){
    		e.preventDefault();
    		var redirect = $(this).attr('href');
    		swal({
		  		title: "Are you sure?",
		  		text: "You will not be able to recover this data!",
		  		type: "warning",
		  		showCancelButton: true,
		  		confirmButtonColor: "#DD6B55",
		  		confirmButtonText: "Yes, delete it!",
		  		closeOnConfirm: false
			},
			function(){
				window.location = redirect;
			});
    	});

    	$("#OpenMediaManager").on('click',function(e){
    		var url = $(this).attr("data-url");
    		var href = $(this).attr("href");
    		$(this).leanModal();
    		$(href).load(url,function(responseTxt, statusTxt, xhr){
		        if(statusTxt == "success")
		            $(href).html(responseTxt);
		        if(statusTxt == "error")
		            $(href).html("Error load image manager");
		    });

    	});
	});
});
