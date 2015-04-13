$(document).ready(function() {
		    $("#registrar").click(function()
		    {
		    var base_url = window.location.origin+'/Publiec/';
		    $.ajax({
		         type: "POST",
		         url: base_url + "registro/create", 
		         data: {
		    	usuario: $("#usuario").val(),
		    	nombre: $("#nombre").val(),
				password: $("#password").val(),
				email: $("#email").val()
		    	},
		         dataType: "text",  
		         cache:false,
		         success: 
		              function(data){
		                //var info=$.parseJSON(data);
						$.gritter.add({
							title: 'Validación de Registro',
							//text: info.mensaje,
							text: data,
							time: '',
							close_icon: 'l-arrows-remove s16',
							icon: 'glyphicon glyphicon-user',
							class_name: 'error-notice'
						});
		              }
		          });// you have missed this bracket
		     return false;
		 });
	});