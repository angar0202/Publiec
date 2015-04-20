$(document).ready(function() {

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
});