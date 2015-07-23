 <!-- .page-sidebar -->
            <aside id="sidebar" class="page-sidebar hidden-md hidden-sm hidden-xs">
                <!-- Start .sidebar-inner -->
                <div class="sidebar-inner">
                    <!-- Start .sidebar-scrollarea -->
                    <div class="sidebar-scrollarea">
                    <?=$panel_usuario?>
                        <!--  .sidebar-panel -->
                        <div class="sidebar-panel">
                            <h5 class="sidebar-panel-title">Navegación</h5>
                        </div>
                        <!-- / .sidebar-panel -->
                        <!-- .side-nav -->
                        <div class="side-nav">
                            <ul class="nav">
                                <li><a href="<?=site_url()?>Home/index"><i class="l-basic-geolocalize-01"></i><span class="txt">Ver Mapa</span></a></li>
                                <li><a href="<?=site_url()?>Home/negocios"><i class="l-ecommerce-bag-upload"></i><span class="txt">Ver Negocios</span></a></li>
                                <li><a href="<?=site_url()?>Home/publicaciones"><i class="l-basic-elaboration-message-check"></i><span class="txt">Ver Publicaciones</span></a></li>
                                <?=$menu_usuario?>
                            </ul>
                        </div>
                        <!-- / side-nav -->                    
                    </div>
                    <!-- End .sidebar-scrollarea -->
                </div>
                <!-- End .sidebar-inner -->
            </aside>
            <!-- / page-sidebar -->