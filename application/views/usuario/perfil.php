<!-- .page-content -->
            <div class="page-content sidebar-page right-sidebar-page clearfix">
                <!-- .page-content-wrapper -->
                <div class="page-content-wrapper">
                    <div class="page-content-inner">
                        <!-- Start .page-content-inner -->
                        <div id="page-header" class="clearfix">
                            <div class="page-header">
                                <h2>Perfil</h2>
                                <span class="txt">Información de cuenta de Usuario</span>
                            </div>                            
                        </div>
                        <!-- Start .row -->
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <!-- col-lg-4 start here -->
                                <div class="panel panel-default plain">
                                    <!-- Start .panel -->
                                    <div class="panel-heading">
                                        <h4 class="panel-title bb">Detalle del Perfil</h4>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row profile">
                                            <!-- Start .row -->
                                            <div class="col-md-4">
                                                <div class="profile-avatar">
                                                    <img src="<?=site_url()?>img/avatars/128.png" alt="Avatar">
                                                    <p class="mt10">
                                                        Online
                                                        <span class="device">
                                        <i class="fa fa-mobile s16"></i>
                                    </span>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="profile-name">
                                                    <h3><?=$nombreUsuario?></h3>
                                                    <p class="job-title mb0"><i class="fa fa-building"></i> <?=$tipoUsuario?></p>
                                                    <p class="balance">
                                                        Negocios: <span><?=$numeroNegocios?></span>
                                                    </p>                                                    
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="contact-info bt">
                                                    <div class="row">
                                                        <!-- Start .row -->
                                                        <div class="col-md-4">
                                                            <dl class="mt20">
                                                                <dt class="text-muted">Usuario</dt>
                                                                <dd><b>@<?=$usuario?></b></dd>
                                                            </dl>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <dl class="mt20">
                                                                <dt class="text-muted">Email</dt>
                                                                <dd><?=$email?></dd>                                                                
                                                            </dl>
                                                        </div>
                                                    </div>
                                                    <!-- End .row -->
                                                </div>
                                            </div>                                            
                                        </div>
                                        <!-- End .row -->
                                    </div>
                                </div>
                                <!-- End .panel -->                                
                            </div>
                            <!-- col-lg-4 end here -->
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="panel panel-default plain">
                                    <!-- Start .panel -->
                                    <div class="panel-heading">
                                        <h4 class="panel-title bb">Editar datos de usuario</h4>
                                    </div>
                                    <div class="panel-body">
                                        <div class="form-horizontal group-border stripped" id="UsuarioForm">
                                            <div class="form-group">
                                                <label class="col-lg-4 control-label" for="">Nombre Completo</label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" id="nombreCompleto" name="nombreCompleto" disabled="true">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-4 control-label" for="">Nombre Usuario</label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" id="nombreUsuario" name="nombreUsuario" disabled="true">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-4 control-label" for="">Correo</label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" id="correo" name="correo" disabled="true">
                                                </div>
                                            </div>
                                            <div class="form-group form-group-vertical">
                                                <label class="col-lg-4 control-label" for="">Cambiar contraseña</label>
                                                <div class="col-lg-8">
                                                <input type="password" class="form-control" id="passwordActual" name="password1" placeholder="Contraseña actual" disabled="true">
                                                    <input type="password" class="form-control" id="passwordNuevo" name="password" placeholder="Contraseña nueva" disabled="true">
                                                    <input type="password" class="form-control" id="passwordConfirma" name="password1" placeholder="Repita su nueva contraseña" disabled="true">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                    <div class="col-lg-9 col-lg-offset-3">
                                                        <button class="btn btn-default" id="EditarButton">Editar Usuario</button>
                                                        <button class="btn btn-danger" id="CancelarButton" style="visibility: hidden">Cancelar</button>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- col-lg-4 end here -->                            
                        </div>
                        <!-- End .row -->
                    </div>
                    <!-- End .page-content-inner -->
                </div>
                <!-- / page-content-wrapper -->
            </div>
            <!-- / page-content -->