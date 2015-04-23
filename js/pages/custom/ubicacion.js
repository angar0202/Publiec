$(document).ready(function() {

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

	function MensajeError(value){
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
				MensajeError("Ingrese la dirección de la Ubicación");
				return;
			}
			if($.trim($("#UbicacionDescripcionTextbox").val())==""){
				$("#UbicacionDescripcionTextbox").focus();
				MensajeError("Ingrese una descripción de la Ubicación");
				return;
			}
			if($.trim($("#UbicacionLatitudTextbox").val())==""){
				MensajeError("No se a podido obtener la latitud de la Ubicación");
				$("#UbicacionDireccionTextbox").focus();
				return;	
			}
			if($.trim($("#UbicacionLongitudTextbox").val())==""){
				MensajeError("No se a podido obtener la longitud de la Ubicación");
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
				editMode(false);				
			}
		});

		$("#CancelarUbicacionButton").click(function()
		{
		  	editMode(false);
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
							editMode(false);
							clear();
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
		    editMode(true);
		});

		function editMode(value){
			if(value==true){
				$("#CancelarUbicacionButton").css("visibility","visible");
				$("#AgregarUbicacionButton").html('Guardar Cambios');	
			}else{
				ubicacionEditar=null;
				$("#CancelarUbicacionButton").css("visibility","hidden");
				$("#AgregarUbicacionButton").html('Agregar');
				clear();
			}
		}

		function clear(){
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
        	return row(item(grupoBotones())+item(ubicacion.direccion)+item(ubicacion.descripcion));
        }

        function row(value){
		    return '<tr id="ubicacion_'+ubicaciones.length+'">'+value+'</tr>';
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