$(document).ready(function() {
	$(document).on('click', '#eliminarImagen', function(e){
		var id=$(this).attr('name');
		var negocio_id=$("#my-awesome-dropzone").attr('name');
		$.ajax({
		         type: "POST",
		         url: baseURL() + "negocio/eliminarImagen", 
		         data: {
		    		NegocioImagenID: id,
		    		NegocioID: negocio_id
		    	},
		         dataType: "text",  
		         cache:false,
		         success: 
		              function(data){		              
		                var info=$.parseJSON(data);
		                if(info.resultado==false){		                	
			                $.gritter.add({
								title: 'Perfil negocio',
								text: info.mensaje,
								time: '',
								close_icon: 'l-arrows-remove s16',
								icon: 'glyphicon glyphicon-user',
								class_name: 'error-notice'
							});	
		                }else{
		                	location.reload();
		                }
		              },
		         error: function(xhr, ajaxOptions, thrownError){
								              alert(xhr.status);
									          alert(xhr.responseText);
									          alert(thrownError);
								          }

		          });
	});

	var myDropzone = new Dropzone("#my-awesome-dropzone",{
              		maxFiles: 1,
     				uploadMultiple: false,
     				parallelUploads: 1,
                    maxFilesize: 10,
                    acceptedFiles: "image/*",                    
                    dictMaxFilesExceeded: "Usted no puede subir mas archivos"
                });
			  myDropzone.on("complete", function(file) {
				  if (this.getUploadingFiles().length === 0 && this.getQueuedFiles().length === 0) {
			        location.reload();
			      }
			  });
			  myDropzone.on("sending", function(file, xhr, formData) {
			  	  var negocio_id=$("#my-awesome-dropzone").attr('name');
				  formData.append("negocio_id",negocio_id);
			  });



});