    $(document).ready(function() {

        $('#listaNegocios').on('click', '.dropdown-toggle', function() {
			var $row = $(this).closest("tr");
			dropDownFixPosition($('#opciones_'+$row.attr('id')),$('#opciones_menu_'+$row.attr('id')));
		});

    	$('#listaNegocios').on('click', '#editarNegocio', function() {
			var $row = $(this).closest("tr");
			$.redirect(baseURL()+'negocio/edit', {'NegocioID': $row.attr('id')});
		});
		$('#listaNegocios').on('click', '#desactivarNegocio', function() {
			var $row = $(this).closest("tr");			
			var activo=$row.attr('target');
			if(activo==0){
				$(this).text('Desactivar');
				$row.attr('target',1);
				//$(this).closest("tr").css({"color": "black"});
				$(this).closest("tr").effect('highlight', {}, 500, function(){										    
										        $(this).css({"color": "black"});
										});
				cambiarEstado($row.attr('id'),1);
			}else{
				$(this).text('Activar');
				$row.attr('target',0);
				//$(this).closest("tr").css({"color": "red"});
				$(this).closest("tr").effect('highlight', {}, 500, function(){										    
										        $(this).css({"color": "red"});
										});
				cambiarEstado($row.attr('id'),0);
			}			
		});
		$('#listaNegocios').on('click', '#eliminarNegocio', function() {
			var $row = $(this).closest("tr");
			$tds = $row.find("td:nth-child(2)");
			$.each($tds, function() {
		        var descripcion=$(this).text();
		        bootbox.confirm("¿Esta seguro que desea eliminar al Negocio '"+descripcion+"', este proceso es irreversible?", function(result) {
		        	if(result==true){
		        		var id=$row.attr('id');
		        		var eliminado=false;
		        		$.ajax({
					         type: "POST",
					         url: baseURL() + "negocio/eliminarNegocio", 
					         data: {
					    		negocio_id: id
					    	},
					         dataType: "text",  
					         cache:false,
					         success: 
					              function(data){
					              var info=$.parseJSON(data);
					              var clase='error-notice';					              
					                if(true==info.resultado){
					                	eliminado=true;
					                	clase='success-notice';					                	
					                }
					                $.gritter.add({
										title: 'Eliminar Negocio',
										text: info.mensaje,
										time: '',
										close_icon: 'l-arrows-remove s16',
										icon: 'glyphicon glyphicon-user',
										class_name: clase
										});
					        		if(eliminado==true){
					        			//$('#'+$row.attr('id')).remove();
					        			$('#'+$row.attr('id')).effect('highlight', {}, 2500, function(){
										    $(this).fadeOut('fast', function(){
										        $(this).remove();
										    });
										});
					        		}
					              },
					          error: function(xhr, ajaxOptions, thrownError){
									alert(xhr.status);
									alert(xhr.responseText);
									alert(thrownError);
								}
					          });
		        	}
		    	});
		    });		
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

		function dropDownFixPosition(button,dropdown){
		      var dropDownTop = button.offset().top + button.outerHeight();
		        dropdown.css('top', dropDownTop + "px");
		        dropdown.css('left', button.offset().left + "px");
		}
    });