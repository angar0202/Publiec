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
            /*$.gritter.add({
                title: 'Error !!!',
                text: 'Geolocation failed: '+error.message,
                close_icon: 'en-cross',
                icon: 'ec-location',
                class_name: 'error-notice'
            });*/ 
        },
        not_supported: function(){
            /*$.gritter.add({
                title: 'Error !!!',
                text: 'Your browser do not support geolocation',
                close_icon: 'en-cross',
                icon: 'ec-location',
                class_name: 'error-notice'
            });*/ 
        },
        always: function(){
            /*$.gritter.add({
                title: 'Done !!!',
                text: 'Your location is detected',
                close_icon: 'en-cross',
                icon: 'ec-location',
                class_name: 'success-notice'
            });*/     
        }
    });
    
    gmap.setContextMenu({
      control: 'map',
      options: [{
        title: 'Add marker',
        name: 'add_marker',
        action: function(e) {
          this.addMarker({
            lat: e.latLng.lat(),
            lng: e.latLng.lng(),
            title: 'New marker'            
          });
          //alert('latitude:'+e.latLng.lat()+', longitude:'+e.latLng.lng());
          console.log('latitude:'+e.latLng.lat()+', longitude:'+e.latLng.lng());
        }
      }, {
        title: 'Center here',
        name: 'center_here',
        action: function(e) {
          this.setCenter(e.latLng.lat(), e.latLng.lng());
        }
      }]
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