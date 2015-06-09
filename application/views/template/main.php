<?php
        $url=site_url();        
?>
<!doctype html>
<!--[if lt IE 8]><html class="no-js lt-ie8"> <![endif]-->
<html class="no-js">
    <head>
        <meta charset="utf-8">
        <title>PUBLIEC | Publicación y Búsqueda de Negocio</title>
        <!-- Mobile specific metas -->
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1 user-scalable=no">
        <!-- Force IE9 to render in normal mode -->
        <!--[if IE]><meta http-equiv="x-ua-compatible" content="IE=9" /><![endif]-->
        <meta name="author" content="" />
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <meta name="application-name" content="" />
        
        <!-- Import google fonts - Heading first/ text second -->
        <link href='http://fonts.googleapis.com/css?family=Quattrocento+Sans:400,700' rel='stylesheet' type='text/css'>
        <!-- Css files -->
        <!-- Icons -->
        <link href="<?=$url?>css/icons.css" rel="stylesheet" />
        <!-- Bootstrap stylesheets (included template modifications) -->
        <link href="<?=$url?>css/bootstrap.css" rel="stylesheet" />
        <!-- Plugins stylesheets (all plugin custom css) -->
        <link href="<?=$url?>css/plugins.css" rel="stylesheet" />
        <!-- Main stylesheets (template main css file) -->
        <link href="<?=$url?>css/main.css" rel="stylesheet" />
        <!-- Custom stylesheets ( Put your own changes here ) -->
        <link href="<?=$url?>css/custom.css" rel="stylesheet" />
        <link href="<?=$url?>css/card.css" rel="stylesheet" />
        <!-- Fav and touch icons -->
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?=$url?>img/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?=$url?>img/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?=$url?>img/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="<?=$url?>img/ico/apple-touch-icon-57-precomposed.png">
        <link rel="icon" href="<?=$url?>img/ico/favicon.ico" type="image/png">
        <!-- Windows8 touch icon ( http://www.buildmypinnedsite.com/ )-->
        <meta name="msapplication-TileColor" content="#3399cc" />

        
    </head>
	<body>
	<?=$body?>
	<!-- Javascripts -->
        <!-- Load pace first -->
        <script src="<?=$url?>plugins/core/pace/pace.min.js"></script>
        <!-- Important javascript libs(put in all pages) -->
        <script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script>
        window.jQuery || document.write('<script src="<?=$url?>js/libs/jquery-2.1.1.min.js">\x3C/script>')
        </script>
        <script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
        <script>
        window.jQuery || document.write('<script src="<?=$url?>js/libs/jquery-ui-1.10.4.min.js">\x3C/script>')
        </script>
        <!--[if lt IE 9]>
  <script type="text/javascript" src="js/libs/excanvas.min.js"></script>
  <script type="text/javascript" src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
  <script type="text/javascript" src="js/libs/respond.min.js"></script>
<![endif]-->
        <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
        <!-- Bootstrap plugins -->
        <script src="<?=$url?>js/bootstrap/bootstrap.js"></script>
        <!-- Core plugins ( not remove ) -->
        <script src="<?=$url?>js/libs/modernizr.custom.js"></script>
        <!-- Handle responsive view functions -->
        <script src="<?=$url?>js/jRespond.min.js"></script>
        <!-- Custom scroll for sidebars,tables and etc. -->
        <script src="<?=$url?>plugins/core/slimscroll/jquery.slimscroll.min.js"></script>
        <script src="<?=$url?>plugins/core/slimscroll/jquery.slimscroll.horizontal.min.js"></script>
        <!-- Remove click delay in touch -->
        <script src="<?=$url?>plugins/core/fastclick/fastclick.js"></script>
        <!-- Increase jquery animation speed -->
        <script src="<?=$url?>plugins/core/velocity/jquery.velocity.min.js"></script>
        <!-- Quick search plugin (fast search for many widgets) -->
        <script src="<?=$url?>plugins/core/quicksearch/jquery.quicksearch.js"></script>
        <!-- Bootbox fast bootstrap modals -->
        <script src="<?=$url?>plugins/ui/bootbox/bootbox.js"></script>
         <!-- Other plugins ( load only nessesary plugins for every page) -->
        <script src="<?=$url?>plugins/forms/fancyselect/fancySelect.js"></script>
        <script src="<?=$url?>plugins/forms/select2/select2.js"></script>
        <script src="<?=$url?>plugins/forms/maskedinput/jquery.maskedinput.js"></script>
        <script src="<?=$url?>plugins/forms/dual-list-box/jquery.bootstrap-duallistbox.js"></script>
        <script src="<?=$url?>plugins/forms/dropzone/dropzone.js"></script>        
        <script src="<?=$url?>plugins/charts/sparklines/jquery.sparkline.js"></script>
        <script src="<?=$url?>plugins/forms/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
        <script src="<?=$url?>js/libs/typeahead.bundle.js"></script>
        <script src="<?=$url?>plugins/forms/summernote/summernote.js"></script>
        <script src="<?=$url?>plugins/forms/bootstrap-markdown/bootstrap-markdown.js"></script>
        <!--Aqui va el js de mapas-->
        <script src="<?=$url?>js/jquery.dynamic.js"></script>
        <script src="<?=$url?>js/main.js"></script>                
        <script src="<?=site_url()?>plugins/ui/title-notifier/title_notifier.js"></script>
        <script src="<?=site_url()?>plugins/ui/notify/jquery.gritter.js"></script>
        <script src="<?=site_url()?>plugins/ui/bootstrap-sweetalert/sweet-alert.js"></script>
        <script src="<?=site_url()?>plugins/misc/gmaps/gmaps.js"></script>
        <script src="<?=base_url()?>plugins/forms/fancyselect/fancySelect.js"></script>
        <script src="<?=base_url()?>plugins/forms/bootstrap-timepicker/bootstrap-timepicker.js"></script>
        <script src="<?=$url?>js/pages/custom/general.js"></script>
        <script src="<?=base_url()?>js/jquery.redirect.js"></script>
        <?=$plugins?>
        <script src="<?=$url?>js/pages/custom/perfil.js"></script>
        <script src="<?=$url?>js/pages/custom/registro.js"></script>
        <script src="<?=$url?>js/pages/custom/recordar.js"></script>
        <script src="<?=$url?>js/pages/custom/login.js"></script>

        <script type="text/javascript">
            var sesion=false;
            setInterval(function () {
                    session=getCookie("session");
                    if(session==""){session=false;}
                    var base_url= "<?=base_url()?>/sesion";
                    $.ajax({
                    type : 'POST',
                    url  : base_url+"/islogin",
                    dataType:"html",
                    success : function(data){
                        if(data==1){
                           //session available
                           sesion=true; 
                           setCookie("session", true, 365);
                           console.log("sesion iniciada");                 
                        }else{
                           // expired
                           console.log("sesion expirada");                 
                           if(sesion){
                                $.gritter.add({
                                title: 'Sesión de Usuario',
                                text: 'Su sesión a estado sin uso demasiado tiempo.',
                                time: '',
                                close_icon: 'l-arrows-remove s16',
                                icon: 'glyphicon glyphicon-user',
                                class_name: 'error-notice'
                                });
                               setInterval(function () {
                                    window.location.replace(base_url+'/logout');
                                },10000);
                            }             
                           sesion=false;
                           setCookie("session", false, 365);
                        }
                      } 
                    });
                },5000);

            function setCookie(cname, cvalue, exdays) {
                var d = new Date();
                d.setTime(d.getTime() + (exdays*24*60*60*1000));
                var expires = "expires="+d.toUTCString();
                document.cookie = cname + "=" + cvalue + "; " + expires;
            }

            function getCookie(cname) {
                var name = cname + "=";
                var ca = document.cookie.split(';');
                for(var i=0; i<ca.length; i++) {
                    var c = ca[i];
                    while (c.charAt(0)==' ') c = c.substring(1);
                    if (c.indexOf(name) == 0) return c.substring(name.length, c.length);
                }
                return "";
            }
        </script>
    </body>
</html>