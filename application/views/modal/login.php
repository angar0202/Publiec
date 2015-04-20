
<div class="modal fade" id="LoginModal" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-sm">                                                        
                                  <div class="modal-content login-container">
                                        <div class="login-panel panel panel-default plain animated bounceIn">
                                            <!-- Start .panel -->
                                            <div class="panel-body pt0">
                                                <div class="user-avatar" align="center" style="padding: 20px;" >
                                                    <img src="<?=site_url()?>img/avatars/128.png" alt="user">
                                                </div>
                                                <form class="form-horizontal" action="index.html" id="login-form" role="form">
                                                    <div class="form-group mb0">
                                                        <div class="col-lg-12">
                                                            <div class="input-group input-icon">
                                                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                                <input type="text" id="usuarioLogin" class="form-control required" placeholder="Ingrese su usuario">
                                                            </div>
                                                            <div class="input-group input-icon">
                                                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                                                <input type="password" id="passwordLogin" class="form-control required" placeholder="Ingrese su contraseña">
                                                            </div>
                                                            <span class="help-block text-right"><a href="#">¿Olvidastes tu contraseña?</a></span> 
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="panel-footer gray-lighter-bg bt">
                                                <h4 class="text-center"><strong>¡Bienvenido! Ingresa tus datos</strong>
                                                </h4>
                                                <p class="text-center"><button class="btn btn-primary" type="submit" id="login">Iniciar Sesión</button>
                                                </p>
                                            </div>
                                        </div>
                                </div>
                        </div>
                    </div>