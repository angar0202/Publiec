$(document).ready(function() {	
	$('.select2').select2({placeholder: 'Seleccionar categorias'});

	/*Crear negocio*/

	$('#CrearNegocio').click(function(){
		if(validar()){
			
		}
	});

	/*Validacion informacion negocio*/
	function validar(){
		var nombre=$.trim($('#NegocioNombreTextbox').val());
		var descripcion=$.trim($('#NegocioDescripcionTextbox').val());
		var email=$.trim($('#NegocioEmailTextbox').val());
		var telefono=$.trim($('#NegocioTelefonoTextbox').val());
		var categorias=$.trim($("#categorias").val());
		alert(categorias);
		if(nombre==""){
			error("Nombre del Negocio se encuentra vacio");
			return false;
		}else if(descripcion==""){
			error("Descripción del Negocio se encuentra vacio");
			return false;
		}else if(categorias=="" || categorias==null){
			error("Debe de selecciona al menos una categoria");
			return false;
		}

		$('#ubicacionesTable > tbody  > tr').each(function() {
			alert(ubicaciones.length);
		});

		return true;
	}

	function error(mensaje){
		                $.gritter.add({
							title: 'Validación de información',
							text: mensaje,
							time: '',
							close_icon: 'l-arrows-remove s16',
							icon: 'glyphicon glyphicon-user',
							class_name: 'error-notice'
						});
	}
});