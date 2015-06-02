<style type="text/css">
    .desactivado {
        color: red;
    }
    .activo {
        color: black;
    }
</style>

<!-- .page-content -->
            <div class="page-content sidebar-page right-sidebar-page clearfix">
                <!-- .page-content-wrapper -->
                <div class="page-conte<nt-wrapper">
                    <div class="page-content-inner">
                        <!-- Start .page-content-inner -->
                        <div id="page-header" class="clearfix">
                            <div class="page-header">
                                <h2>Mis Negocios</h2>
                                <span class="txt">Administración de mis negocios, servicios, etc. registrados</span>
                            </div>
                            <div class="header-stats">
                                <div class="spark clearfix">
                                    <div class="spark-info"><span class="number">2345</span>Visitors</div>
                                    <div id="spark-visitors" class="sparkline"></div>
                                </div>
                                <div class="spark clearfix">
                                    <div class="spark-info"><span class="number">17345</span>Views</div>
                                    <div id="spark-templateviews" class="sparkline"></div>
                                </div>
                                <div class="spark clearfix">
                                    <div class="spark-info"><span class="number">3700$</span>Sales</div>
                                    <div id="spark-sales" class="sparkline"></div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <!-- Start .row -->
                            <div class="col-lg-12">
                                <!-- col-lg-12 start here -->
                                <div class="panel panel-default plain toggle panelClose panelRefresh">
                                    <!-- Start .panel -->
                                    <div class="panel-heading white-bg">
                                        <h4 class="panel-title">Lista</h4><a href="<?=site_url()?>Negocio/create">Crear nuevo negocio</a>
                                    </div>
                                    <div class="panel-body">
                                        <table class="table table-bordered" id="listaNegocios">
                                            <thead>
                                                <tr>
                                                <th class="per10">Atendiendo</th>
                                                    <th class="per25">Nombre</th>
                                                    <th class="per40">Descripcion</th>
                                                    <th class="per10"># Ubicaciones</th>
                                                    <th class="per5"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($negocios as $item){?>
                                                    <? if($item->Activo==1){$estilo="activo";}else{$estilo="desactivado";} ?>
                                                    <tr id="<?=$item->NegocioID?>" class="<?=$estilo?>" target="<?=$item->Activo?>">
                                                        <td>
                                                            <div class="toggle-custom">
                                                            <label class="toggle" data-on="ON" data-off="OFF">
                                                                <input type="checkbox" id="checkbox-toggle" name="checkbox-toggle" checked>
                                                                <span class="button-checkbox"></span>
                                                            </label>                                                            
                                                            </div>
                                                        </td>
                                                        <td><?=$item->Nombre?></td>
                                                        <td><?=$item->Descripcion?></td>
                                                        <td><?=$item->Ubicaciones?></td>
                                                        <td>
                                                        <!-- /btn-group -->
                                                        <div class="btn-group dropdown mb10 mr10">
                                                            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                                                Operaciones
                                                                <span class="caret"></span>
                                                            </button>
                                                            <ul class="dropdown-menu right" role="menu">
                                                                <li>
                                                                    <a href="#" id="editarNegocio">Editar</a>
                                                                </li>
                                                                <li>
                                                                    <a href="#" id="eliminarNegocio">
                                                                    <? if($item->Activo){?>
                                                                        Desactivar
                                                                    <?
                                                                     }else{
                                                                    ?>
                                                                        Activar
                                                                    <? } ?>
                                                                    </a>
                                                                </li>
                                                                <li class="divider"></li>
                                                                <li>
                                                                    <a href="#">Ver Información</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                            
                                                            
                                                        </td>
                                                    </tr>
                                                <?php } ?>                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- End .panel -->
                            </div>
                            <!-- col-lg-12 end here -->
                        </div>
                        <!-- End .row -->
                    </div>
                    <!-- End .page-content-inner -->
                </div>
                <!-- / page-content-wrapper -->
            </div>
            <!-- / page-content -->