define(['jquery'], function (){
	var method = {}
	method.changeHTML = function (arg){
		$('body').html(arg);
	}
	method.showAlert = function (arg){
		alert(arg);
	}
	return method;
});
