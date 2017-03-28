define([
		'jquery',
		'bootstrap',
		'bootstrapSelect',
		'jquerySlimscroll',
		'waves',
		'jqueryCountTo',
		'raphael',
		'morris',
		'bundle',
		'jquerySparkiLines',
		'customAdmin',
		'customIndex',
		'jquerydatatables',
		'swal',
	], function ($){
		$(document).ready(function(){
		var mediaObj;

		$('#addNewSocial').on('click',function(){
			var myvar = '<div class="panel panel-default">'+
			'<div class="panel-body">'+
			'<div class="form-group">'+
			'<h3 class="card-inside-title">Social name</h3>'+
			'<div class="input-group">'+
			'<span class="input-group-addon">'+
			'<i class="material-icons">title</i>'+
			'</span>'+
			'<div class="form-line">'+
			'<input type="text" class="form-control" name="name[]" placeholder="name" />'+
			'</div>'+
			'</div>'+
			'</div>'+
			'<div class="form-group">'+
			'<h3 class="card-inside-title">Fontawesome icon name</h3>'+
			'<div class="input-group">'+
			'<span class="input-group-addon">'+
			'<i class="material-icons">insert_emoticon</i>'+
			'</span>'+
			'<div class="form-line">'+
			'<input type="text" class="form-control" name="icon[]" placeholder="fa-facebook" />'+
			'</div>'+
			'</div>'+
			'</div>'+
			'<div class="form-group">'+
			'<h3 class="card-inside-title">Social link</h3>'+
			'<div class="input-group">'+
			'<span class="input-group-addon">'+
			'<i class="material-icons">link</i>'+
			'</span>'+
			'<div class="form-line">'+
			'<input type="text" class="form-control" name="link[]" placeholder="link" />'+
			'</div>'+
			'</div>'+
			'</div>'+
			'</div>'+
			'</div>';
			console.log("Ads");
			$(myvar).insertBefore('#addNewSocial');
	
		});

		$('.clearupload').on('click',function(){
			var id = $(this).attr("data-target");
			$(id).val('');
			console.log(id);
		});

		if($('#table').length < 1){
	    	$('.table').DataTable({
	    		 paging: false,
	    		 info: false
	    	});
    	}

    	$(this).on('click','.img-media',function(e){
    		e.preventDefault();
    		var id = $(this).attr("data-name");
    		var to = mediaObj.attr("data-to");
    		var to2 = mediaObj.attr("data-to-origin");
    		var multiple = mediaObj.attr("data-multiple");
    		var ckeditor = mediaObj.attr("data-to-ck");
    		var imgFolder = mediaObj.attr("data-img-folder");
    		var img = "<img src='"+imgFolder+"/"+id+"' style='height:346px; width:554px'/>'";
    		if(multiple=='1'){
    			if(ckeditor != null){
    				CKEDITOR.instances.ckeditor.insertHtml(img);
    			}
	    		else if($(to2).val().length === 0) {
       				if(to != null) $(to).val(id);
	    			$(to2).val(id);
	    		}
	    		else{
	    			if(to != null) $(to).val($(to).val()+";"+id);
	    			$(to2).val($(to2).val()+";"+id);
	    		}
    		}
    		else{
    			if(ckeditor != null){
    				CKEDITOR.instances.ckeditor.insertHtml(img);
    			}
    			else{
	    			if(to != null) $(to).val(id);
		    		$(to2).val(id);
    			}
	    		$('#modal').modal('toggle');
    		}
	    		
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

    	$(".OpenMediaManager").on('click',function(e){
    		var url = $(this).attr("data-url");
    		var href = $(this).attr("href");
    		var asli = $(this);
    		$("#information").html("Loading...");

    		if($(href).val().length < 14){
	    		$(href).load(url,function(responseTxt, statusTxt, xhr){
			        if(statusTxt == "success")
			            $(href).html(responseTxt);
			        if(statusTxt == "error")
			            $(href).html("Error load image manager");

			        $("#information").html("");
			        $("#modal").modal();
			    });
    		}
    		else{
    			$("#information").html("");
			    $("#modal").modal();
    		}

    		mediaObj = $(this);
    	});
	});
});
