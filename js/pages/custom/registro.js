$(document).ready(function() {
		    $("#registrar").click(function()
		    {
		    if(validar()){
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
		     }
		 });

		$("#goToLogin").click(function(){
			$("#RegistroModal").modal('hide');
			clear();
			$("#LoginModal").modal('show');
		});

		function validar(){
			var usuario=$.trim($("#usuario").val());
			var nombre=$.trim($("#nombre").val());
			var password=$.trim($("#password").val());
			var password1=$.trim($("#password1").val());
			var email=$.trim($("#email").val());
			if(usuario=="")
			{
				error("El nombre de usuario se encuentra vacio");
				$("#usuario").focus();
				return false;
			}
			if(nombre=="")
			{
				error("El nombre completo para el usuario se encuentra vacio");
				$("#nombre").focus();
				return false;
			}
			if(password=="")
			{
				error("El campo de contraseña se encuentra vacio");
				$("#password").focus();
				return false;
			}
			if(email=="")
			{
				error("El correo se encuentra vacio");
				$("#email").focus();
				return false;
			}
			if(password1=="")
			{
				error("El campo para confirmar la contraseña se encuentra vacio");
				$("#password1").focus();
				return false;
			}
			if(password!=password1){
				error("El campo para confirmar la contraseña y el de contraseña no coinciden");
				$("#password1").focus();
				return false;	
			}
			return true;
		}

		function error(mensaje){
			$.gritter.add({
							title: 'Validación de Registro',
							text: mensaje,
							time: '',
							close_icon: 'l-arrows-remove s16',
							icon: 'glyphicon glyphicon-user',
							class_name: 'error-notice'
						});
		}
		function clear(){
		    	$("#usuario").val('');
		    	$("#nombre").val('');
		    	$("#password").val('');
		    	$("#password1").val('');
		    	$("#email").val('');
		}
	});