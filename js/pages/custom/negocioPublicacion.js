$(document).ready(function() {   
		$("#Publicar").click(function()
		{
		    var base_url = baseURL();
		    $.ajax({
		         type: "POST",
		         url: base_url + "negocio/insertarPublicacion", 
		         data: {
		    		titulo: $("#titulo").val(),		    	
					descripcion: $("#descripcion").val()				
		    	 },
		         dataType: "text",  
		         cache:false,
		         success: 
		              function(data){
		              	alert(data);
		                /*var info=$.parseJSON(data);
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
						});*/						
		              }
		          });// you have missed this bracket		     
		});
});