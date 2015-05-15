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
		if(nombre==""){
			error("Nombre del Negocio se encuentra vacio");
			return false;
		}else if(descripcion==""){
			error("Descripción del Negocio se encuentra vacio");
			return false;
		}else if(categorias=="" || categorias==null){
			error("Debe de selecciona al menos una categoria");
			return false;
		}else if(ubicaciones.length==0){
			error("Debe ingresar una ubicacion para que su negocio se muestre en el mapa");
		}
		$('#ubicacionesTable > tbody  > tr').each(function() {
			
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
	
	/*CONTACTOS*/
	
	var contactos = []; 
	var contactoEditar=null;

	function Contacto()
	{
		this.id=-1;
		this.nombre="";
		this.apellido="";
		this.telefono="";
		this.email="";
		this.direccion="";
		this.nombreCompleto=function() {
        	return this.nombre + ' ' + this.apellido;
    	};
	}

	function MensajeError(value){
						$.gritter.add({
							title: 'Validación de Contacto',
							text: value,
							time: '',
							close_icon: 'l-arrows-remove s16',
							icon: 'glyphicon glyphicon-user',
							class_name: 'error-notice'
						});
	}

		$("#AgregarContactoButton").click(function()
		{
			if($.trim($("#ContactoNombresTextbox").val())==""){
				$("#ContactoNombresTextbox").focus();
				MensajeError("Ingrese el nombre del Contacto");
				return;
			}
			if($.trim($("#ContactoApellidoTextbox").val())==""){
				$("#ContactoApellidoTextbox").focus();
				MensajeError("Ingrese el apellido del Contacto");
				return;
			}
			if($.trim($("#ContactoEmailTextbox").val())==""){
				MensajeError("Ingrese el correo del Contacto");
				$("#ContactoEmailTextbox").focus();
				return;	
			}
			if(contactoEditar==null){
				AgregarContacto();	
			}
			else
			{
				contactoEditar.nombre=$("#ContactoNombresTextbox").val();
				contactoEditar.apellido=$("#ContactoApellidoTextbox").val();
				contactoEditar.telefono=$("#ContactoTelefonoTextbox").val();
				contactoEditar.email=$("#ContactoEmailTextbox").val();
				contactoEditar.direccion=$("#ContactoDireccionTextbox").val();
				contactos[contactoEditar.id]=contactoEditar;
				var $row = $("#contacto_"+contactoEditar.id);			
			    $nombre = $row.find("td:nth-child(2)");			
			    $.each($nombre, function() {
			        $(this).text(contactoEditar.nombreCompleto());
				});
				$email = $row.find("td:nth-child(3)");			
			    $.each($email, function() {
			        $(this).text(contactoEditar.email);
				});
				editMode(false);				
			}
		});

		$("#CancelarContactoButton").click(function()
		{
		  	editMode(false);
		});

		$('#contactosTable').on('click', '#eliminar', function() {
			var $row = $(this).closest("tr");			
		    $tds = $row.find("td:nth-child(2)");			
		    $.each($tds, function() {
		        var nombre=$(this).text();
		        bootbox.confirm("¿Desea eliminar el contacto "+nombre+"?", function(result) {
		        	if(result==true){
		        		$('#'+$row.attr('id')).remove();
		        		//Va a eliminar al contacto que esta editando en ese momento
		        		if(contactoEditar!=null)
						{
							editMode(false);
							clear();
						}
		        	}
		    	});
			});
		});

		$('#contactosTable').on('click', '#editar', function() {
			var $row = $(this).closest("tr");			
		    var id=$row.attr('id');
		    id=id.replace('contacto_','');
		    contactoEditar=contactos[id];
		    SetContacto(contactoEditar);
		    editMode(true);
		});

		function editMode(value){
			if(value==true){
				$("#CancelarContactoButton").css("visibility","visible");
				$("#AgregarContactoButton").html('Guardar Cambios');	
			}else{
				contactoEditar=null;
				$("#CancelarContactoButton").css("visibility","hidden");
				$("#AgregarContactoButton").html('Agregar');
				clear();
			}
		}

		function clear(){
			$("#ContactoNombresTextbox").val("");
			$("#ContactoApellidoTextbox").val("");
			$("#ContactoTelefonoTextbox").val("");
			$("#ContactoEmailTextbox").val("");
			$("#ContactoDireccionTextbox").val("");
			$("#ContactoNombresTextbox").focus();
		}

		function SetContacto(contacto){
			$("#ContactoNombresTextbox").val(contacto.nombre);
			$("#ContactoApellidoTextbox").val(contacto.apellido);
			$("#ContactoTelefonoTextbox").val(contacto.telefono);
			$("#ContactoEmailTextbox").val(contacto.email);
			$("#ContactoDireccionTextbox").val(contacto.direccion);
		}

		function AgregarContacto() 
		{
			var contacto=new Contacto();
			contacto.nombre=$("#ContactoNombresTextbox").val();
			contacto.apellido=$("#ContactoApellidoTextbox").val();
			contacto.telefono=$("#ContactoTelefonoTextbox").val();
			contacto.email=$("#ContactoEmailTextbox").val();
			contacto.direccion=$("#ContactoDireccionTextbox").val();
			contacto.id=contactos.length;
			var datos=$.trim($('#contactosTable tbody').html());
			var fila = rowContacto(contacto);
            if(datos!='')
		    {
		        $("#contactosTable tr:last").after(fila);
		    }
		    else
		    {
		    	$('#contactosTable tbody').append(fila);        
		    }
		    contactos[contactos.length]=contacto;
		    clear();
        }

        function rowContacto(contacto){
        	return row(item(grupoBotones())+item(contacto.nombreCompleto())+item(contacto.email));
        }

        function row(value){
		    return '<tr id="contacto_'+contactos.length+'">'+value+'</tr>';
		}
		function item(value){
		    return '<td>'+value+'</td>';
		}
		function grupoBotones(){
			return '<div class="btn-group btn-group-xs">'+crearEliminar()+crearEditar()+'</div>';
		}
		function crearEliminar(){
		    return '<button id="eliminar" class="btn btn-default">eliminar</button>';
		}
		function crearEditar(){
		    return '<button id="editar" class="btn btn-default">editar</button>';
		}
	/*UBICACIONES*/
	var ubicaciones = []; 
	var ubicacionEditar=null;

	function Ubicacion()
	{
		this.id=-1;
		this.direccion="";
		this.descripcion="";
		this.latitud="";
		this.longitud="";
	}

	function MensajeErrorUbicacion(value){
						$.gritter.add({
							title: 'Validación de Ubicación',
							text: value,
							time: '',
							close_icon: 'l-arrows-remove s16',
							icon: 'glyphicon glyphicon-map-marker',
							class_name: 'error-notice'
						});
	}

		$("#AgregarUbicacionButton").click(function()
		{
			if($.trim($("#UbicacionDireccionTextbox").val())==""){
				$("#UbicacionDireccionTextbox").focus();
				MensajeErrorUbicacion("Ingrese la dirección de la Ubicación");
				return;
			}
			if($.trim($("#UbicacionDescripcionTextbox").val())==""){
				$("#UbicacionDescripcionTextbox").focus();
				MensajeErrorUbicacion("Ingrese una descripción de la Ubicación");
				return;
			}
			if($.trim($("#UbicacionLatitudTextbox").val())==""){
				MensajeErrorUbicacion("No se a podido obtener la latitud de la Ubicación");
				$("#UbicacionDireccionTextbox").focus();
				return;	
			}
			if($.trim($("#UbicacionLongitudTextbox").val())==""){
				MensajeErrorUbicacion("No se a podido obtener la longitud de la Ubicación");
				$("#UbicacionDireccionTextbox").focus();
				return;	
			}
			if(ubicacionEditar==null){
				AgregarUbicacion();	
			}
			else
			{
				ubicacionEditar.direccion=$("#UbicacionDireccionTextbox").val();
				ubicacionEditar.descripcion=$("#UbicacionDescripcionTextbox").val();
				ubicacionEditar.longitud=$("#UbicacionLongitudTextbox").val();
				ubicacionEditar.latitud=$("#UbicacionLatitudTextbox").val();
				ubicaciones[ubicacionEditar.id]=ubicacionEditar;
				var $row = $("#ubicacion_"+ubicacionEditar.id);
			    $descripcion = $row.find("td:nth-child(2)");			
			    $.each($descripcion, function() {
			        $(this).text(ubicacionEditar.descripcion);
				});
				$direccion = $row.find("td:nth-child(3)");			
			    $.each($direccion, function() {
			        $(this).text(ubicacionEditar.direccion);
				});
				editModeUbicacion(false);				
			}
		});

		$("#CancelarUbicacionButton").click(function()
		{
		  	editModeUbicacion(false);
		});

		$('#ubicacionesTable').on('click', '#eliminar', function() {
			var $row = $(this).closest("tr");			
		    $tds = $row.find("td:nth-child(2)");			
		    $.each($tds, function() {
		        var descripcion=$(this).text();
		        bootbox.confirm("¿Desea eliminar la Ubicación '"+descripcion+"'?", function(result) {
		        	if(result==true){
		        		$('#'+$row.attr('id')).remove();
		        		//Va a eliminar a la ubicacion que esta editando en ese momento
		        		if(ubicacionEditar!=null)
						{
							editModeUbicacion(false);
							clearUbicacion();
						}
		        	}
		    	});
			});
		});

		$('#ubicacionesTable').on('click', '#editar', function() {
			var $row = $(this).closest("tr");			
		    var id=$row.attr('id');
		    id=id.replace('ubicacion_','');
		    ubicacionEditar=ubicaciones[id];
		    SetUbicacion(ubicacionEditar);
		    editModeUbicacion(true);
		});

		function editModeUbicacion(value){
			if(value==true){
				$("#CancelarUbicacionButton").css("visibility","visible");
				$("#AgregarUbicacionButton").html('Guardar Cambios');	
			}else{
				ubicacionEditar=null;
				$("#CancelarUbicacionButton").css("visibility","hidden");
				$("#AgregarUbicacionButton").html('Agregar');
				clearUbicacion();
			}
		}

		function clearUbicacion(){
			$("#UbicacionDireccionTextbox").val("");
			$("#UbicacionDescripcionTextbox").val("");
			$("#UbicacionLatitudTextbox").val("");
			$("#UbicacionLongitudTextbox").val("");
			gmap.removeMarkers();
			$("#UbicacionDireccionTextbox").focus();
		}

		function SetUbicacion(Ubicacion){
			$("#UbicacionDireccionTextbox").val(Ubicacion.direccion);
			$("#UbicacionDescripcionTextbox").val(Ubicacion.descripcion);
			$("#UbicacionLatitudTextbox").val(Ubicacion.latitud);
			$("#UbicacionLongitudTextbox").val(Ubicacion.longitud);
			gmap.removeMarkers();
			gmap.addMarker({
		        lat: Ubicacion.latitud,
		        lng: Ubicacion.longitud,
		        title: Ubicacion.descripcion
		    });
		    gmap.setCenter(Ubicacion.latitud, Ubicacion.longitud);
		}

		function AgregarUbicacion() 
		{
			var ubicacion=new Ubicacion();
			ubicacion.direccion=$("#UbicacionDireccionTextbox").val();
			ubicacion.descripcion=$("#UbicacionDescripcionTextbox").val();
			ubicacion.latitud=$("#UbicacionLatitudTextbox").val();
			ubicacion.longitud=$("#UbicacionLongitudTextbox").val();
			ubicacion.id=ubicaciones.length;
			var datos=$.trim($('#ubicacionesTable tbody').html());
			var fila = rowUbicacion(ubicacion);
            if(datos!='')
		    {
		        $("#ubicacionesTable tr:last").after(fila);
		    }
		    else
		    {
		    	$('#ubicacionesTable tbody').append(fila);        
		    }
		    ubicaciones[ubicaciones.length]=ubicacion;
		    clear();
        }

        function rowUbicacion(ubicacion){
        	return rowU(item(grupoBotones())+item(ubicacion.direccion)+item(ubicacion.descripcion));
        }

        function rowU(value){
		    return '<tr id="ubicacion_'+ubicaciones.length+'">'+value+'</tr>';
		}


		/*===========================================================================
		FUNCIONES DE MAPA
		=============================================================================*/
		var gmap = new GMaps({
        el: '#UbicacionMapa',
        lat: -12.043333,
        lng: -77.028333,
        zoomControl : true,
        zoomControlOpt: {
            style : 'SMALL',
            position: 'TOP_LEFT'
        },
        panControl : false,
        streetViewControl : false,
        mapTypeControl: false,
        overviewMapControl: false
    	});

    	GMaps.geolocate({
        success: function(position){
          gmap.setCenter(position.coords.latitude, position.coords.longitude);
        },
        error: function(error){
            $.gritter.add({
                title: 'Error !!!',
                text: 'Geolocation failed: '+error.message,
                close_icon: 'en-cross',
                icon: 'ec-location',
                class_name: 'error-notice'
            });
        },
        not_supported: function(){
            $.gritter.add({
                title: 'Error !!!',
                text: 'Your browser do not support geolocation',
                close_icon: 'en-cross',
                icon: 'ec-location',
                class_name: 'error-notice'
            });
        },
        always: function(){
            $.gritter.add({
                title: 'Listo !!!',
                text: 'Su localización fue encontrada',
                close_icon: 'en-cross',
                icon: 'ec-location',
                class_name: 'success-notice'
            });
        }
    	});
		
		$( "#UbicacionDireccionTextbox" ).keydown(function( event ) {
			if ( event.which == 13 ) {
				$("#UbicacionLatitudTextbox").val("");
				$("#UbicacionLongitudTextbox").val("");
				GMaps.geocode({
				  address: "Guayaquil, "+$('#UbicacionDireccionTextbox').val(),
				  callback: function(results, status) {
				    if (status == 'OK') {
				      var latlng = results[0].geometry.location;
				      gmap.removeMarkers();
				      gmap.setCenter(latlng.lat(), latlng.lng());
				      gmap.addMarker({
				        lat: latlng.lat(),
				        lng: latlng.lng()
				      });
				      $("#UbicacionLatitudTextbox").val(latlng.lat());
					  $("#UbicacionLongitudTextbox").val(latlng.lng());
				    }
				  }
				});
		   	event.preventDefault();
		  }
		});

		gmap.setContextMenu({
		  control: 'map',
		  options: [{
		    title: 'Aqui esta mi negocio',
		    name: 'add_marker',
		    action: function(e) {
		    var descripcion=$("#UbicacionDescripcionTextbox").val();
		    if($.trim(descripcion)==""){
		    	MensajeError("Ingrese una descripción de la Ubicación");
		    	return;
		    }
			  gmap.removeMarkers();
		      this.addMarker({
		        lat: e.latLng.lat(),
		        lng: e.latLng.lng(),
		        title: descripcion
		      });
		      this.setCenter(e.latLng.lat(), e.latLng.lng());
		      $("#UbicacionLatitudTextbox").val(e.latLng.lat());
			  $("#UbicacionLongitudTextbox").val(e.latLng.lng());
		    }
		  }]
		});
});