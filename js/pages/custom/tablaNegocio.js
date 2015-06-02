    $(document).ready(function() {
    	$('#listaNegocios').on('click', '#editarNegocio', function() {
			var $row = $(this).closest("tr");
			$.redirect(baseURL()+'negocio/edit', {'NegocioID': $row.attr('id')});
		});
		$('#listaNegocios').on('click', '#eliminarNegocio', function() {
			var $row = $(this).closest("tr");			
			var activo=$row.attr('target');
			if(activo==0){
				$(this).text('Desactivar');
				$row.attr('target',1);
				$(this).closest("tr").css({"color": "black"});
				cambiarEstado($row.attr('id'),1);
			}else{
				$(this).text('Activar');
				$row.attr('target',0);
				$(this).closest("tr").css({"color": "red"});
				cambiarEstado($row.attr('id'),0);
			}
			//
			//$.redirect(baseURL()+'negocio/edit', {'NegocioID': $row.attr('id')});
		});

		function cambiarEstado(negocioID,estado){
			$.ajax({
		         type: "POST",
		         url: baseURL() + "negocio/cambiarEstado", 
		         data: {
		    		negocio_id: negocioID,
		    		estado: estado
		    	},
		         dataType: "text",  
		         cache:false,
		         success: 
		              function(data){		              	
		                var info=$.parseJSON(data);		                
		                $.gritter.add({
							title: 'Estados de Negocio',
							text: info.mensaje,
							time: '',
							close_icon: 'l-arrows-remove s16',
							icon: 'glyphicon glyphicon-user',
							class_name: 'success-notice'
						});
		              }
		          });
		}

		function baseURL(){
		    	return window.location.origin+'/Publiec/';
		}
    });