                    <div class="modal fade" id="PublicarModal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">
                                        <span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span>
                                    </button>
                                    <h4 class="modal-title" id="myModalLabel2">Crear publicación</h4>
                                </div>                                
                                <div class="modal-body">
                                <form class="form-horizontal mt0" action="" id="register-form" role="form">
                                    <div class="form-group">
                                        <div class="col-lg-10 col-md-9">
                                            <select class="fancy-select form-control" id="sector">
                                            <? foreach ($negocios as $n) { ?>
                                                <option value="<?=$n->NegocioID?>" selected><?=$n->Nombre?></option>
                                            <?}?>                                                                
                                            </select>
                                        </div>
                                    </div>
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
                                </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                    <button type="button" class="btn btn-primary" id="Publicar">Publicar</button>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>