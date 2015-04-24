//------------- maps-google.js -------------//
$(document).ready(function() {
//------------- Google maps -------------//
	//basic map
	var gmap = new GMaps({
        el: '#gmap',
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
                title: 'Done !!!',
                text: 'Your location is detected',
                close_icon: 'en-cross',
                icon: 'ec-location',
                class_name: 'success-notice'
            });
        }
    });
    
    $( "#direccion" ).keydown(function( event ) {
      if ( event.which == 13 ) {
        GMaps.geocode({
          address: "Guayaquil, "+$('#direccion').val(),
          callback: function(results, status) {
            if (status == 'OK') {
              var latlng = results[0].geometry.location;
              gmap.removeMarkers();
              gmap.setCenter(latlng.lat(), latlng.lng());
              gmap.addMarker({
                lat: latlng.lat(),
                lng: latlng.lng()
              });
            }
          }
        });
        event.preventDefault();
      }
    });

    gmap.addMarker({
      lat: -2.189533465988526,
      lng: -79.94374394416809,
      title: 'Mi primer Negocio en Publi-Com',
      infoWindow: {
          content: '<b>Negocio de Prueba</b></br><p>mi primera empresa registrada.<br/></p><div style="margin:0 auto;text-align: center;"><img src="http://50.23.173.8/upload/media/pics/AUGUST2013/8102750Tienda.jpg" style="width:128px; height:128px;"/></div><br/><input type="button" class="btn btn-primary btn-xs mr5 mb10" value="Agregar a Favorito"/><input type="button" value="Recomendar" class="btn btn-warning btn-xs mr5 mb10"/>'
      },
      /*click: function(e) {
        alert('You clicked in this marker');
      }*/
    });



});