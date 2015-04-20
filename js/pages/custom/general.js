$(document).ready(function() {
		    $("#logout").click(function()
		    {
		    	window.location.replace(baseURL()+'usuario/logout');	
		    });

		    function baseURL(){
		    	return window.location.origin+'/Publiec/';
		    }
		});