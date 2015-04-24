 <!--[if lt IE 9]>
      <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
        <!-- .page-navbar -->
        <div id="header" class="page-navbar">
            <!-- .navbar-brand -->
            <a href="<?=site_url()?>" class="navbar-brand hidden-xs hidden-sm">
                <!--<img src="<?=site_url()?>img/logo.png" class="logo hidden-xs" alt="Dynamic logo">
                <img src="<?=site_url()?>img/logosm.png" class="logo-sm hidden-lg hidden-md" alt="Dynamic logo">-->
                <span class="reset-layout tipB"></span><h3 style="color:white;">publiec</h3>
            </a>
            <!-- / navbar-brand -->
            <!-- .no-collapse -->
            <div id="navbar-no-collapse" class="navbar-no-collapse">
                <!-- top left nav -->
                <ul class="nav navbar-nav">
                    <li class="toggle-sidebar">
                        <a href="#">
                            <i class="fa fa-reorder"></i>
                            <span class="sr-only">Ocultar panel</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="reset-layout tipB" title="Actualizar"><i class="fa fa-history"></i></a>
                    </li>                    
                </ul>
                
                <!-- / top left nav -->
                <!-- top right nav -->
                <ul class="nav navbar-nav navbar-right">
                    <?=$panel_superior?>
                    <li>
                        <a id="toggle-right-sidebar" href="#" class="tipB" title="Informacion Adicional">
                            <i class="l-software-layout-sidebar-right"></i>
                            <span class="sr-only">Informacion adicional</span>
                        </a>
                    </li>
                </ul>
                <!-- / top right nav -->
            </div>
            <!-- / collapse -->
        </div>
        <!-- / page-navbar -->