$(document).ready(function() {

   $( "#emailUserRemember" ).keydown(function( event ) {
      if ( event.which == 13 ) {
      	$( "#recordar" ).click();
      	event.preventDefault();
      }
  });

		    $("#recordar").click(function()
		    {
		    var base_url = baseURL();//window.location.origin+'/Publiec/';
		    var usuario=$("#emailUserRemember").val();
		    $.ajax({
		         type: "POST",
		         url: base_url + "usuario/recordar", 
		         data: {
		    		emailUserRemember: usuario
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
							title: 'Recordar Contraseña',
							text: info.mensaje,
							time: '',
							close_icon: 'l-arrows-remove s16',
							icon: 'glyphicon glyphicon-user',
							class_name: className
						});
						if(info.resultado==true){
							swal("Recordar Contraseña", info.mensaje, "success");
							$("#RememberModal").modal('hide');
							clear();								
						}
		              }
		          });// you have missed this bracket
		     return false;
		 });

		function clear(){
		    	$("#emailUserRemember").val('');		    	
		}
	});
function baseURL(){
		    	return window.location.origin+'/Publiec/';
		    }