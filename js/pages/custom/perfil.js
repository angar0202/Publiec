$(document).ready(function() {
	var edit=false;

	GetUsuario();


	$("#EditarButton").click(function()
	{
		if(!edit){
			/*Habilitar controles para editar y guardar*/
			editMode(true);
		}else{
			/*Actualizar la informacion*/
			actualizar();			
		}
	});

	$("#CancelarButton").click(function(){
		GetUsuario();
		editMode(false);
	});

	function GetUsuario(){
		var url= baseURL() + "usuario/info"; 
		$.getJSON( url , function( user ) {
			$("#nombreUsuario").val(user.NombreUsuario);
			$("#nombreCompleto").val(user.NombreCompleto);
			$("#correo").val(user.Email);
		});
	}

	function actualizar(){
		var nombreCompleto=$.trim($("#nombreCompleto").val());
		var nombreUsuario=$.trim($("#nombreUsuario").val());
		var correo=$.trim($("#correo").val());
		var passwordActual=$("#passwordActual").val();
		var passwordNuevo=$("#passwordNuevo").val();
		var passwordConfirma=$("#passwordConfirma").val();
		var cambiarPassword=false;
		/*Validacion*/
		if(nombreCompleto==""){
			MensajeError("El nombre completo esta vacio");
			$("#nombreCompleto").focus();
			return;
		}
		if(nombreUsuario==""){
			MensajeError("El nombre del usuario esta vacio");
			$("#nombreUsuario").focus();
			return;
		}
		if(correo==""){
			MensajeError("El correo se encuentra vacio");
			$("#Correo").focus();
			return;
		}
		if(passwordNuevo!="" || passwordActual!=""|| passwordConfirma!=""){
			cambiarPassword=true;
			if(passwordActual==""){
			MensajeError("La contraseña actual se encuentra vacia");
			$("#passwordActual").focus();
			return;
			}
			if(passwordNuevo==""){
				MensajeError("La nueva contraseña se encuentra vacia");
				$("#passwordNuevo").focus();
				return;
			}
			if(passwordConfirma==""){
				MensajeError("La contraseña de confirmacion se encuentra vacia");
				$("#passwordConfirma").focus();
				return;
			}
			if(passwordNuevo!=passwordConfirma){
				MensajeError("La contraseña nueva no coincide con la de comprobacion");
				$("#passwordConfirma").focus();
				return;
			}	
		}
		
		/*Guardar*/
		var base_url = baseURL();//window.location.origin+'/Publiec/';
		    $.ajax({
		         type: "POST",
		         url: base_url + "usuario/actualizar", 
		         data: {
		    		nombreCompleto: nombreCompleto,		    	
					nombreUsuario: nombreUsuario,
					correo: correo,
					passwordActual: passwordActual,
					passwordNuevo: passwordNuevo,
					passwordConfirma: passwordConfirma,
					cambiarPassword:cambiarPassword,
		    	 },
		         dataType: "text",  
		         cache:false,
		         success: 
		              function(d){
		              	var info=$.parseJSON(d);
		                var className='error-notice';
		                if(info.resultado==true){
		                	className='success-notice';
		                }		                
		                $.gritter.add({
							title: 'Iniciar Sesión',
							text: info.mensaje,
							time: '',
							close_icon: 'l-arrows-remove s16',
							icon: 'glyphicon glyphicon-user',
							class_name: className
						});
						if(info.resultado==true){
							$("#passwordActual").val("");
							$("#passwordConfirma").val("");
							$("#passwordNuevo").val("");
							editMode(false);
						}
		              },
					error: function(xhr, ajaxOptions, thrownError){
						alert(xhr.status);
						alert(xhr.responseText);
						alert(thrownError);
					}
		          });// you have missed this bracket
	}

	function editMode(value)
	{
			if(value==true)
			{
				$("#CancelarButton").css("visibility","visible");
				$("#EditarButton").html('Guardar Cambios');	
			}
			else
			{				
				$("#CancelarButton").css("visibility","hidden");
				$("#EditarButton").html('Editar');				
			}
			enable(value);
			edit=value;
	}

	function enable(value){
		$("#nombreCompleto").prop('disabled', !value);
		$("#nombreUsuario").prop('disabled', !value);
		$("#correo").prop('disabled', !value);
		$("#passwordActual").prop('disabled', !value);
		$("#passwordNuevo").prop('disabled', !value);
		$("#passwordConfirma").prop('disabled', !value);
	}

	function MensajeError(value){
						$.gritter.add({
							title: 'Validación de Usuario',
							text: value,
							time: '',
							close_icon: 'l-arrows-remove s16',
							icon: 'glyphicon glyphicon-user',
							class_name: 'error-notice'
						});
	}
			function baseURL(){
		    	return window.location.origin+'/Publiec/';
		    }

});