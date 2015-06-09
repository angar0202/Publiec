//------------- maps-google.js -------------//
$(document).ready(function() {
//------------- Google maps -------------//
	//basic map
	var gmap = new GMaps({
        el: '#gmap',
        lat: -2.1900373530480044,
        lng: -79.88227844238281,
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

    Geolocalizar();

    function Geolocalizar(){
         GMaps.geolocate({
            success: function(position){
              gmap.setCenter(position.coords.latitude, position.coords.longitude);
            },
            error: function(error){
                $.gritter.add({
                    title: 'Error Geolocalización',
                    text: 'Fallo Geolocalización: '+error.message,
                    close_icon: 'en-cross',
                    icon: 'ec-location',
                    class_name: 'error-notice'
                });
            },
            not_supported: function(){
                $.gritter.add({
                    title: 'Error Geolocalización',
                    text: 'Su navegador no soporta Geolocalización',
                    close_icon: 'en-cross',
                    icon: 'ec-location',
                    class_name: 'error-notice'
                });
            },
            always: function(){
                $.gritter.add({
                    title: 'Geolocalización',
                    text: 'Su ubicación actual fue encontrada',
                    close_icon: 'en-cross',
                    icon: 'ec-location',
                    class_name: 'success-notice'
                });
            }
        });   
    }
     
    
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
GetNegocios();
    function GetNegocios(){
        var url= baseURL() + "home/mapa"; 
        $.getJSON( url , function( negocio ) {            
            for (var i = negocio.length - 1; i >= 0; i--) {
                var descripcion=negocio[i].DescripcionNegocio;
                var max=50;
                descripcion=descripcion.substring(0, 50);
                if(descripcion.length>=50){
                    descripcion=descripcion+"...";
                }
                var estilo="btn btn-default btn-xs mr5 mb10";
                if(negocio[i].Favoritos>0){
                    estilo="btn btn-success btn-xs mr5 mb10";
                }
                var icon = baseURL()+negocio[i].IconoNegocio;
                var infoWindowContent = [
                '<b>'+negocio[i].Nombre+'</b></br>',
                '<p style="max-width:250px;text-align: justify;text-justify: inter-word;">'+descripcion+'<br/></p>',
                '<div style="margin:0 auto;text-align: center;">',
                '<img src="'+baseURL()+negocio[i].ImagenNegocio+'" style="width:128px; height:128px;"/>',
                '</div><br/>',
                '<input type="button" id="AgregarFavoritos" name="'+negocio[i].NegocioID+'" class="'+estilo+'" value="+'+negocio[i].Favoritos+'"/>',
                '<input type="button" id="VerPerfil" value="Ir al perfil" name="'+negocio[i].NegocioID+'" class="btn btn-default btn-xs mr5 mb10"/>'
                ].join("");
                gmap.addMarker({
                  lat: negocio[i].Latitud,
                  lng: negocio[i].Longitud,
                  title: negocio[i].Nombre,
                  infoWindow: {
                    content:infoWindowContent
                  },
                  icon : {
                    size : new google.maps.Size(32, 32),
                    url : icon
                  }
                  /*click: function(e) {
                    alert('You clicked in this marker');
                  }*/
                });
            };
        });
    }

    $(document).on('click', '#AgregarFavoritos', function(e){
       e.preventDefault();
       var negocioID=$(this).attr('name');        
       var numero="+0";
                $.ajax({
                 type: "POST",
                 url: baseURL() + "home/agregarNegocioFavorito", 
                 data: {
                    negocioID: negocioID
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
                $(this).effect('highlight', {}, 500, function(){
                    $(this).val("+"+String(numero));
                    if(numero>0){
                        $(this).attr('class','btn btn-success btn-xs mr5 mb10');    
                    }else{
                        $(this).attr('class','btn btn-default btn-xs mr5 mb10');
                    }
                });             
            });

            gmap.addControl({
              position: 'top_right',
              content: 'Geolocalizar',
              style: {
                margin: '5px',
                padding: '1px 6px',
                border: 'solid 1px #717B87',
                background: '#fff'
              },
              events: {
                click: function(){
                  Geolocalizar();
                }
              }
            });

            $(document).on('click', '#VerPerfil', function(e){
                var NegocioID=$(this).attr('name');              
                $.redirect(baseURL()+'negocio/perfil', {'NegocioID': NegocioID});
            });

            function baseURL(){
                return window.location.origin+'/Publiec/';
            }
});