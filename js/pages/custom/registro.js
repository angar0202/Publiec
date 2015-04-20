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
		                var info=$.parseJSON(data);		                
		                $.gritter.add({
							title: 'Validación de Registro',
							text: info.mensaje,
							time: '',
							close_icon: 'l-arrows-remove s16',
							icon: 'glyphicon glyphicon-user',
							class_name: 'error-notice'
						});
						if(info.resultado==true){
							$("#RegistroModal").modal('hide');
							clear();
							swal("Registro Completo!", "El registro se realizo correctamente, se a enviado un correo para la confirmación.", "success");
						}
		              }
		          });// you have missed this bracket
		     return false;
		 });

		$("#goToLogin").click(function(){
			$("#RegistroModal").modal('hide');
			clear();
			$("#LoginModal").modal('show');
		});

		function clear(){
		    	$("#usuario").val('');
		    	$("#nombre").val('');
		    	$("#password").val('');
		    	$("#password1").val('');
		    	$("#email").val('');
		}
	});