
<!-- .page-content -->
            <div class="page-content sidebar-page right-sidebar-page clearfix">
                <!-- .page-content-wrapper -->
                <div class="page-conte<nt-wrapper">
                    <div class="page-content-inner">
                        <!-- Start .page-content-inner -->
                        <div id="page-header" class="clearfix">
                            <div class="page-header">
                                <h2>Mis Negocios</h2>
                                <span class="txt">Creación de nuevo negocio o servicio</span>
                            </div>
                            <div class="header-stats">
                                <div class="spark clearfix">
                                    <button class="btn btn-success btn-lg mr5 mb10" id="CrearNegocio">Crear Negocio</button>
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
                                                        <input type="text" class="form-control" id="NegocioNombreTextbox" placeholder="Nombre">                                                        
                                                    </div>
                                                </div>
                                                <!-- End .form-group  -->
                                                <div class="form-group">
                                                    <div class="col-lg-12">
                                                        <textarea class="form-control" id="NegocioDescripcionTextbox" rows="3" placeholder="Descripcion"></textarea>
                                                    </div>
                                                </div>
                                                <!-- End .form-group  -->
                                                <div class="form-group">
                                                    <div class="col-lg-12">
                                                        <div class="row">
                                                            <!-- Start .row -->
                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-left">
                                                                <input type="text" class="form-control" id="NegocioEmailTextbox" placeholder="Email/Sitio Web">                                                                
                                                            </div>
                                                            <!-- Start .row -->
                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-left">
                                                                <input type="text" class="form-control" id="NegocioTelefonoTextbox" placeholder="Telefono">
                                                            </div>
                                                        </div>
                                                        <!-- End .row -->
                                                    </div>
                                                </div>
                                                <!-- End .form-group  -->
                                                <div class="form-group">
                                                    <label class="col-lg-2 col-md-3 control-label" for="">Categorias</label>
                                                    <div class="col-lg-10 col-md-9">
                                                        <select class="form-control select2" id="categorias" multiple>
                                                        <?
                                                        foreach ($tiposNegocios as $tipo) {
                                                        ?>
                                                        <optgroup label="<?=$tipo->Nombre?>">
                                                            <?
                                                            foreach ($categorias as $item) {
                                                                if($item->TipoNegocioID==$tipo->TipoNegocioID){
                                                            ?>
                                                                <option value="<?=$item->TipoNegocioID?>_<?=$item->CategoriaID?>"><?=$item->Nombre?></option>
                                                            <?
                                                                }
                                                            }
                                                            ?>
                                                        </optgroup>
                                                        <?
                                                        }
                                                        ?>
                                                        </select>
                                                    </div>
                                            </div>
                                            <!-- End .form-group  -->
                                            </form>
                                        </div>
                                    </div>
                            </div>
                            <!-- col-lg-6 end here -->
                            <div class="col-md-6 sortable-layout">
                                <div class="panel panel-default plain toggle">
                                    <!-- Start .panel -->
                                    <div class="panel-heading">
                                        <h4 class="panel-title">Cargar Imagenes de Negocio</h4>
                                    </div>
                                    <div class="panel-body">
                                        <div class="negocio-upload">
                                            <form id="my-awesome-dropzone" action="<?php echo site_url('/negocio/upload');?>" class="dropzone">                                            
                                            </form>
                                        </div>
                                        <div id="">
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
                                            <form class="form-horizontal" role="form" id="UbicacionForm">
                                                <div class="page-header">
                                                    <h5>Información de Ubicacion</h5>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-lg-12">
                                                        <div class="row">
                                                            <!-- Start .row -->
                                                            <div class="col-lg-12">
                                                                <input id="UbicacionDireccionTextbox" type="text" class="form-control" placeholder="Direccion">
                                                            </div>
                                                        </div>
                                                        <!-- End .row -->
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-lg-12">
                                                        <input id="UbicacionDescripcionTextbox" type="text" class="form-control" placeholder="Descripcion">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-lg-2 col-md-3 control-label" for="">Sectores</label>
                                                    <div class="col-lg-10 col-md-9">
                                                        <select class="fancy-select form-control" id="sector">
                                                            <option value="Norte" selected>Norte</option>
                                                            <option value="Sur">Sur</option>
                                                            <option value="Este">Este</option>
                                                            <option value="Oeste">Oeste</option>
                                                            <option value="Sureste">Sureste</option>
                                                            <option value="Suroeste">Suroeste</option>
                                                            <option value="Noreste">Noreste</option>
                                                            <option value="Noroeste">Noroeste</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <!-- End .form-group  -->
                                                <div class="form-group">
                                                    <div class="col-lg-12">
                                                        <div class="row" style="margin:0 auto;text-align: center;">
                                                            <!-- Start .row -->
                                                                <div id="UbicacionMapa" style="width:100%;height:250px;"></div>                                                            
                                                        </div>
                                                        <!-- End .row -->
                                                    </div>
                                                </div>
                                                <!-- End .form-group  -->                                                
                                                <div class="form-group">
                                                    <div class="col-lg-12">
                                                        <div class="row">
                                                            <!-- Start .row -->
                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                <input id="UbicacionLatitudTextbox" type="text" class="form-control" placeholder="Latitud">
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                <input id="UbicacionLongitudTextbox" type="text" class="form-control" placeholder="Longitud">
                                                            </div>
                                                        </div>
                                                        <!-- End .row -->
                                                    </div>
                                                </div>
                                                <div class="page-header">
                                                    <h5>Horarios de Atención</h5>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-lg-2 col-md-4 control-label" for="">Lunes</label>
                                                    <div class="col-lg-5 col-md-4">
                                                        <div class="input-group bootstrap-timepicker">
                                                            <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                                            <input id="lunes_inicio" type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-5 col-md-4">
                                                        <div class="input-group bootstrap-timepicker">
                                                            <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                                            <input id="lunes_fin" type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                    <label class="col-lg-2 col-md-4 control-label" for="">Martes</label>
                                                    <div class="col-lg-5 col-md-4">
                                                        <div class="input-group bootstrap-timepicker">
                                                            <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                                            <input id="martes_inicio" type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-5 col-md-4">
                                                        <div class="input-group bootstrap-timepicker">
                                                            <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                                            <input id="martes_fin" type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                    <label class="col-lg-2 col-md-4 control-label" for="">Miercoles</label>
                                                    <div class="col-lg-5 col-md-4">
                                                        <div class="input-group bootstrap-timepicker">
                                                            <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                                            <input id="miercoles_inicio" type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-5 col-md-4">
                                                        <div class="input-group bootstrap-timepicker">
                                                            <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                                            <input id="miercoles_fin" type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                    <label class="col-lg-2 col-md-4 control-label" for="">Jueves</label>
                                                    <div class="col-lg-5 col-md-4">
                                                        <div class="input-group bootstrap-timepicker">
                                                            <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                                            <input id="jueves_inicio" type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-5 col-md-4">
                                                        <div class="input-group bootstrap-timepicker">
                                                            <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                                            <input id="jueves_fin" type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                    <label class="col-lg-2 col-md-4 control-label" for="">Viernes</label>
                                                    <div class="col-lg-5 col-md-4">
                                                        <div class="input-group bootstrap-timepicker">
                                                            <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                                            <input id="viernes_inicio" type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-5 col-md-4">
                                                        <div class="input-group bootstrap-timepicker">
                                                            <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                                            <input id="viernes_fin" type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                    <label class="col-lg-2 col-md-4 control-label" for="">Sábado</label>
                                                    <div class="col-lg-5 col-md-4">
                                                        <div class="input-group bootstrap-timepicker">
                                                            <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                                            <input id="sabado_inicio" type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-5 col-md-4">
                                                        <div class="input-group bootstrap-timepicker">
                                                            <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                                            <input id="sabado_fin" type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                    <label class="col-lg-2 col-md-4 control-label" for="">Domingo</label>
                                                    <div class="col-lg-5 col-md-4">
                                                        <div class="input-group bootstrap-timepicker">
                                                            <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                                            <input id="domingo_inicio" type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-5 col-md-4">
                                                        <div class="input-group bootstrap-timepicker">
                                                            <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                                            <input id="domingo_fin" type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End .form-group  -->
                                                <div class="form-group">
                                                    <div class="col-lg-12">
                                                        <div class="row">
                                                            <!-- Start .row -->
                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-left">
                                                                <a href="#" class="btn btn-default" id="AgregarUbicacionButton">Agregar</a>
                                                                <a href="#" style="visibility: hidden" class="btn btn-danger" id="CancelarUbicacionButton">Cancelar</a>
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
                                        <table class="table table-hover" id="ubicacionesTable">
                                            <thead>
                                                <tr>
                                                    <th class="per30">
                                                        
                                                    </th>
                                                    <th class="per40">Descripcion</th>
                                                    <th class="per40">Direccion</th>                                                    
                                                </tr>
                                            </thead>
                                            <tbody>                                                
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
                                            <form class="form-horizontal" role="form" id="ContactoForm">
                                                <div class="form-group">
                                                    <div class="col-lg-12">
                                                        <div class="row">
                                                            <!-- Start .row -->
                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                <input type="text" id="ContactoNombresTextbox" class="form-control" placeholder="Nombres">
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                <input type="text" id="ContactoApellidoTextbox" class="form-control" placeholder="Apellidos">
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
                                                                <input type="text" id="ContactoTelefonoTextbox" class="form-control" placeholder="Telefono">
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                <input type="text" id="ContactoEmailTextbox" class="form-control" placeholder="Email">
                                                            </div>
                                                        </div>
                                                        <!-- End .row -->
                                                    </div>
                                                </div>
                                                <!-- End .form-group  -->
                                                <div class="form-group">
                                                    <div class="col-lg-12">
                                                        <textarea class="form-control" name="textarea" id="ContactoDireccionTextbox" rows="3" placeholder="Direccion"></textarea>
                                                    </div>
                                                </div>
                                                <!-- End .form-group  -->
                                                <div class="form-group">
                                                    <div class="col-lg-12">
                                                        <div class="row">
                                                            <!-- Start .row -->
                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-left">
                                                                <a href="#" class="btn btn-default" id="AgregarContactoButton">Agregar</a>
                                                                <a href="#" style="visibility: hidden" class="btn btn-danger" id="CancelarContactoButton">Cancelar</a>
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
                                        <table class="table table-hover" id="contactosTable">
                                            <thead>
                                                <tr>
                                                    <th class="per30">
                                                        
                                                    </th>                                                    
                                                    <th class="per40">Nombre Contacto</th>
                                                    <th class="per40">Correo</th>                                                    
                                                </tr>
                                            </thead>
                                            <tbody>                                                
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
