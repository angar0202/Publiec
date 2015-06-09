$(document).ready(function() {
		    $("#listaPublicaciones").on('click','#Favoritos',function()
		    {
		    	var $row = $(this).closest(".card");
		    	var PublicacionID=$row.attr('id');
		    	var numero="+0";
		    	$.ajax({
		         type: "POST",
		         url: baseURL() + "home/agregarFavorito", 
		         data: {
		    		publicacionID: PublicacionID
		    	},
		         dataType: "text",  
		         cache:false,
		         success: 
		              function(data){		              
		                var info=$.parseJSON(data);
		                if(info.resultado==0){		                	
			                $.gritter.add({
								title: 'Usuario',
								text: info.mensaje,
								time: '',
								close_icon: 'l-arrows-remove s16',
								icon: 'glyphicon glyphicon-user',
								class_name: 'error-notice'
							});	
		                }
		                numero=info.numero;
		              },
		         error: function(xhr, ajaxOptions, thrownError){
								              alert(xhr.status);
									          alert(xhr.responseText);
									          alert(thrownError);
								          }

		          });
				$(this).effect('highlight', {}, 1000, function(){
					$(this).text("+"+numero);
					if(numero>0){
						$(this).attr('class','btn btn-success');	
					}else{
						$(this).attr('class','btn');
					}
				});				
		    });
			$("#listaPublicaciones").on('click','#VerPerfil',function()
		    {
		    	var NegocioID=$(this).attr('alt');		    	
		    	$.redirect(baseURL()+'negocio/perfil', {'NegocioID': NegocioID});
		    });
		    function baseURL(){
		    	return window.location.origin+'/Publiec/';
		    }
});