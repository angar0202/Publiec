$(document).ready(function() {	
	var negocio_id=0;
	Dropzone.autoDiscover = false;
	var imagenes=0;
	/*Imagenes de Negocio*/
	// Now that the DOM is fully loaded, create the dropzone, and setup the
              // event listeners
              var myDropzone = new Dropzone("#my-awesome-dropzone",{
              		autoProcessQueue: false,
                    maxFiles: 5,
                    maxFilesize: 1,
                    acceptedFiles: "image/*", /*is this correct?*/
                    init: function(){
                    	var submitButton = document.querySelector("#CrearNegocio")
					        myDropzone = this; // closure

					    submitButton.addEventListener("click", function() {
					    	var negocio=validar();
								if(negocio!=null){
									$('#ubicacionesTable > tbody  > tr').each(function() {			
										var ubicacion=getUbicacion($(this).attr('id'));
										negocio.ubicaciones[negocio.ubicaciones.length]=ubicacion;
									});
									$('#contactosTable > tbody > tr').each(function(){
										var contacto=getContacto($(this).attr('id'));
										negocio.contactos[negocio.contactos.length]=contacto;
									});
									var negocioJson=JSON.stringify(negocio);
									alert(negocioJson);
									/*Guardar Informacion*/
									var base_url = baseURL();
									$.ajax({
								         type: "POST",
								         url: base_url + "negocio/nuevo", 
								         data: {
								    		negocio: negocioJson
								    	 },
								         dataType: "text",  
								         cache:false,
								         success: 
								              function(data){
								              	alert(data);
								                /*var info=$.parseJSON(data);
								                if(info.resultado==true){
								                	negocio.id=info.negocio_id;
								                	negocio_id=info.negocio_id;
								                	correcto(info.mensaje);
								                	myDropzone.processQueue(); // Tell Dropzone to process all queued files.								                	
								                }else{
								                	error(info.mensaje);
								                }*/
								              }
								          });
								}
					    });

                        this.on("success", function(file, data) {
                        	/*correcto("Se cargo correctamente la imagen:"+file.name);
                        	AgregarImagen(file.name,negocio_id);*/
                            });
                        this.on("maxfilesexceeded", function(file){
                        	imagenes--;
                            alert("No more files please!");
                            myDropzone.removeFile(file);
                        });
                        this.on("uploadprogress", function(file, progress) {
                            console.log("File progress", progress);
                        });    
                        },
                    accept: function(file, done) {
                    	imagenes++;
                    	done();
                    }
                });
			  myDropzone.on("complete", function(file) {
				  alert("Se completo con exito el registro");
				  AgregarImagen(parseInt(negocio_id),file.name);
			  });
              myDropzone.on("addedfile", function(file) {
              	file.previewElement.addEventListener("click", function() {
                    bootbox.confirm("¿Desea remover este archivo "+file.name+"?", function(result) {
                        if(result==true){
                          imagenes--;
                          myDropzone.removeFile(file);
                          RemoverImagen(file.name);
                        }
                    });
                  });
                });

    function RemoverImagen(filename){
    	var base_url = baseURL();
			$.ajax({
		         type: "POST",
		         url: base_url + "negocio/eliminarImagen", 
		         data: {
		    		archivo: filename
		    	 },
		         dataType: "text",  
		         cache:false,
		         success: 
		              function(data){
		                console.log(data);
		                //var info=$.parseJSON(data);
		                //alert(info.resultado);
		              }
		          });
    }

    function AgregarImagen(negocio_id,filename){
    	var base_url = baseURL();
    	var id=parseInt(negocio_id);
			$.ajax({
		         type: "POST",
		         url: base_url + "negocio/agregarImagen", 
		         data: {
		         	negocio_id: id,
		    		archivo: filename
		    	 },
		         dataType: "text",  
		         cache:false,
		         success: 
		              function(data){
		                alert(data);
		              }
		          });
    }

    function GetCategorias(value){
    	var categorias=[];
    	var temp=value.split(",");
    	temp.forEach(function(item) {
		    var data=item.split("_");
		    var categoria=new Categoria();
		    categoria.TipoNegocioId=parseInt(data[0]);
		    categoria.id=parseInt(data[1]);
		    categorias[categorias.length]=categoria;
		});
		return categorias;
    }

    function Categoria(){
    	this.id=-1;
    	this.TipoNegocioId=-1;
    }

	function Negocio()
	{
		this.id=-1;
		this.nombre="";
		this.descripcion="";
		this.email="";
		this.telefono="";
		this.ubicaciones=[];
		this.contactos=[];
		this.imagenes=[];
		this.categorias=[];
	}

	$('.select2').select2({placeholder: 'Seleccionar categorias'});

	/*Crear negocio*/

	/*$('#CrearNegocio').click(function(){
		
	});*/

	function getUbicacion(codigo){		
		var id = codigo.replace("ubicacion_", "");
		return ubicaciones[id];
	}

	function getContacto(codigo){
		var id = codigo.replace("contacto_", "");
		return contactos[id];	
	}

	/*Validacion informacion negocio*/
	function validar(){
	
		var nombre=$.trim($('#NegocioNombreTextbox').val());
		var descripcion=$.trim($('#NegocioDescripcionTextbox').val());
		var email=$.trim($('#NegocioEmailTextbox').val());
		var telefono=$.trim($('#NegocioTelefonoTextbox').val());
		var categorias=$.trim($("#categorias").val());
		if(nombre==""){
			error("Nombre del Negocio se encuentra vacio");
			$('#NegocioNombreTextbox').focus();
			return null;
		}else if(descripcion==""){
			error("Descripción del Negocio se encuentra vacio");
			$('#NegocioDescripcionTextbox').focus();
			return null;
		}else if(categorias=="" || categorias==null){
			error("Debe de selecciona al menos una categoria");
			$('#categorias').focus();
			return null;
		}else if(ubicaciones.length==0){
			error("Debe ingresar una ubicacion para que su negocio se muestre en el mapa");
			$('#UbicacionDireccionTextbox').focus();
			return null;
		}else if(imagenes==0){
			error("El negocio debe tener al menos una imagen de identificación");
			return null;
		}
		var negocio= new Negocio();
		negocio.nombre=nombre;
		negocio.descripcion=descripcion;
		negocio.email=email;
		negocio.telefono=telefono;
		negocio.categorias=GetCategorias(categorias);
		return negocio;
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
	
	function correcto(mensaje){
		                $.gritter.add({
							title: 'Negocio',
							text: mensaje,
							time: '',
							close_icon: 'l-arrows-remove s16',
							icon: 'glyphicon glyphicon-user',
							class_name: 'success-notice'
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
		    clearUbicacion();
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
                title: 'Geolocalización',
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
		function baseURL(){
		  	return window.location.origin+'/Publiec/';
		}
});