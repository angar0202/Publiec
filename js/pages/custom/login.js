$(document).ready(function() {
		    $("#login").click(function()
		    {
		    var base_url = baseURL();//window.location.origin+'/Publiec/';
		    $.ajax({
		         type: "POST",
		         url: base_url + "usuario/login", 
		         data: {
		    		usuarioLogin: $("#usuarioLogin").val(),		    	
					passwordLogin: $("#passwordLogin").val()				
		    	 },
		         dataType: "text",  
		         cache:false,
		         success: 
		              function(data){
		                var info=$.parseJSON(data);
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
						});
						if(info.resultado==true){
							$("#LoginModal").modal('hide');
							clear();					
							window.location.replace(base_url);		
						}
		              }
		          });// you have missed this bracket
		     return false;
		 });

		function clear(){
		    	$("#usuarioLogin").val('');
		    	$("#passwordLogin").val('');
		}
	});
function baseURL(){
		    	return window.location.origin+'/Publiec/';
		    }