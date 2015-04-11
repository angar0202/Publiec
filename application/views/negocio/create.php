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
                            <div class="col-md-6 sortable-layout">
                                <div class="panel panel-default plain toggle">
                                        <!-- Start .panel -->
                                        <div class="panel-heading">
                                            <h4 class="panel-title">Información Negocio</h4>
                                        </div>
                                        <div class="panel-body">
                                            <form class="form-horizontal" role="form">
                                                <div class="form-group">
                                                    <div class="col-lg-12">
                                                        <input type="text" class="form-control" placeholder="Nombre">                                                        
                                                    </div>
                                                </div>
                                                <!-- End .form-group  -->
                                                <div class="form-group">
                                                    <div class="col-lg-12">
                                                        <textarea class="form-control" name="textarea" id="textarea" rows="3" placeholder="Descripcion"></textarea>
                                                    </div>
                                                </div>
                                                <!-- End .form-group  -->
                                                <div class="form-group">
                                                    <div class="col-lg-12">
                                                        <div class="row">
                                                            <!-- Start .row -->
                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-left">
                                                                <button type="submit" class="btn btn-default">Agregar</button>
                                                            </div>
                                                        </div>
                                                        <!-- End .row -->
                                                    </div>
                                                </div>
                                                <!-- End .form-group  -->
                                            </form>
                                        </div>
                                    </div>
                            </div>
                            <!-- col-lg-6 end here -->
                            <div class="col-md-6 sortable-layout">
                                <div class="panel panel-default toggle panelMove panelClose panelRefresh">
                                    <!-- Start .panel -->
                                    <div class="panel-heading">
                                        <h4 class="panel-title">Cargar Imagenes de Negocio</h4>
                                    </div>
                                    <div class="panel-body">
                                        <form id="my-awesome-dropzone" action="<?=site_url()?>uploads" class="dropzone"></form>
                                    </div>
                                </div>
                                <!-- End .panel -->
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-6 sortable-layout">
                                <div class="panel panel-default plain toggle">
                                        <!-- Start .panel -->
                                        <div class="panel-heading">
                                            <h4 class="panel-title">Ubicacion</h4>
                                        </div>
                                        <div class="panel-body">
                                            <form class="form-horizontal" role="form">
                                                <div class="form-group">
                                                    <div class="col-lg-12">
                                                        <div class="row">
                                                            <!-- Start .row -->
                                                            <div class="col-lg-12">
                                                                <input type="text" class="form-control" placeholder="Direccion">
                                                            </div>
                                                        </div>
                                                        <!-- End .row -->
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-lg-12">
                                                        <div class="row" style="margin:0 auto;text-align: center;">
                                                            <!-- Start .row -->
                                                                <div id="gmap" style="width:100%;height:250px;"></div>                                                            
                                                        </div>
                                                        <!-- End .row -->
                                                    </div>
                                                </div>
                                                <!-- End .form-group  -->
                                                <div class="form-group">
                                                    <div class="col-lg-12">
                                                        <input type="text" class="form-control" placeholder="Descripcion">
                                                    </div>
                                                </div>
                                                <!-- End .form-group  -->
                                                <div class="form-group">
                                                    <div class="col-lg-12">
                                                        <div class="row">
                                                            <!-- Start .row -->
                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                <input type="text" class="form-control" placeholder="Latitud">
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                <input type="text" class="form-control" placeholder="Longitud">
                                                            </div>
                                                        </div>
                                                        <!-- End .row -->
                                                    </div>
                                                </div>
                                                <!-- End .form-group  -->
                                                <div class="form-group">
                                                    <div class="col-lg-12">
                                                        <div class="row">
                                                            <!-- Start .row -->
                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-left">
                                                                <button type="submit" class="btn btn-default">Agregar</button>
                                                            </div>
                                                        </div>
                                                        <!-- End .row -->
                                                    </div>
                                                </div>
                                                <!-- End .form-group  -->                                                
                                            </form>
                                        </div>
                                    </div>
                            </div>
                            <!-- col-lg-6 end here -->
                            <div class="col-lg-6 col-md-6">
                                <!-- col-lg-6 start here -->
                                <div class="panel panel-default plain toggle">
                                    <!-- Start .panel -->
                                    <div class="panel-heading white-bg">
                                        <h4 class="panel-title">Ubicaciones del Negocio</h4>
                                    </div>
                                    <div class="panel-body">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="per5">
                                                        #
                                                    </th>
                                                    <th class="per40">Descripcion</th>
                                                    <th class="per40">Direccion</th>                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        1
                                                    </td>
                                                    <td>Jacob Olsen</td>
                                                    <td>Developer</td>                                                    
                                                </tr>
                                                <tr>
                                                    <td>
                                                        2
                                                    </td>
                                                    <td>Lara James</td>
                                                    <td>SEO</td>                                                    
                                                </tr>
                                                <tr>
                                                    <td>
                                                        3
                                                    </td>
                                                    <td>Steve Sidwell</td>
                                                    <td>Photographer</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        4
                                                    </td>
                                                    <td>Elena Dobrev</td>
                                                    <td>Project manger</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- End .panel -->
                            </div>
                            <!-- col-lg-6 end here -->              
                        </div>

                        
                        <div class="row">
                            <div class="col-md-6 sortable-layout">
                                <div class="panel panel-default plain toggle">
                                        <!-- Start .panel -->
                                        <div class="panel-heading">
                                            <h4 class="panel-title">Contacto</h4>
                                        </div>
                                        <div class="panel-body">
                                            <form class="form-horizontal" role="form">
                                                <div class="form-group">
                                                    <div class="col-lg-12">
                                                        <div class="row">
                                                            <!-- Start .row -->
                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                <input type="text" class="form-control" placeholder="Nombres">
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                <input type="text" class="form-control" placeholder="Apellidos">
                                                            </div>
                                                        </div>
                                                        <!-- End .row -->
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-lg-12">
                                                        <div class="row">
                                                            <!-- Start .row -->
                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                <input type="text" class="form-control" placeholder="Telefono">
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                <input type="text" class="form-control" placeholder="Email">
                                                            </div>
                                                        </div>
                                                        <!-- End .row -->
                                                    </div>
                                                </div>
                                                <!-- End .form-group  -->
                                                <div class="form-group">
                                                    <div class="col-lg-12">
                                                        <textarea class="form-control" name="textarea" id="textarea" rows="3" placeholder="Direccion"></textarea>
                                                    </div>
                                                </div>
                                                <!-- End .form-group  -->
                                                <div class="form-group">
                                                    <div class="col-lg-12">
                                                        <div class="row">
                                                            <!-- Start .row -->
                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-left">
                                                                <button type="submit" class="btn btn-default">Agregar</button>
                                                            </div>
                                                        </div>
                                                        <!-- End .row -->
                                                    </div>
                                                </div>
                                                <!-- End .form-group  -->
                                            </form>
                                        </div>
                                    </div>
                            </div>
                            <!-- col-lg-6 end here -->
                            <div class="col-lg-6 col-md-6">
                                <!-- col-lg-6 start here -->
                                <div class="panel panel-default plain toggle">
                                    <!-- Start .panel -->
                                    <div class="panel-heading white-bg">
                                        <h4 class="panel-title">Lista de Contactos</h4>
                                    </div>
                                    <div class="panel-body">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="per5">
                                                        #
                                                    </th>
                                                    <th class="per40">Employe</th>
                                                    <th class="per40">Position</th>
                                                    <th class="per15">Salary</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        1
                                                    </td>
                                                    <td>Jacob Olsen</td>
                                                    <td>Developer</td>
                                                    <td>2530$</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        2
                                                    </td>
                                                    <td>Lara James</td>
                                                    <td>SEO</td>
                                                    <td>3700$</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        3
                                                    </td>
                                                    <td>Steve Sidwell</td>
                                                    <td>Photographer</td>
                                                    <td>1340$</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        4
                                                    </td>
                                                    <td>Elena Dobrev</td>
                                                    <td>Project manger</td>
                                                    <td>5600$</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- End .panel -->
                            </div>
                            <!-- col-lg-6 end here -->              
                        </div>

                    </div>
                    <!-- End .page-content-inner -->
                </div>
                <!-- / page-content1-wrapper -->
            </div>
            <!-- / page-content -->
