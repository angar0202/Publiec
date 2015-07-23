<!-- .page-content -->
            <div class="page-content sidebar-page right-sidebar-page clearfix">
                <!-- .page-content-wrapper -->
                <div class="page-content-wrapper">
                    <div class="page-content-inner">
                        <!-- Start .page-content-inner -->
                        <div id="page-header" class="clearfix">
                            <div class="page-header">
                                <h2>Perfil</h2>
                                <span class="txt">Información de cuenta de Negocio</span>
                            </div>                            
                        </div>
                        <!-- Start .row -->
                        <div class="row" >
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <!-- col-lg-4 start here -->
                                <div class="panel panel-default plain">
                                    <!-- Start .panel -->
                                    <div class="panel-heading">
                                        <h4 class="panel-title bb"><?=$nombreNegocio?></h4>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row profile">
                                            <!-- Start .row -->
                                            <div class="col-md-4">
                                                <div class="profile-avatar">
                                                    <?
                                                    if(count($imagenes)>0)
                                                    {
                                                        $rutaImagen=$imagenes[0]->Url;
                                                    }
                                                    ?>
                                                    <img src="<?=site_url()?><?=$rutaImagen?>" style="max-height: 128px; max-width: 128px;" alt="Avatar">
                                                    <p class="mt10">
                                                        <?=$atendiendo?>
                                                        <span class="device">
                                        <i class="fa fa-mobile s16"></i>
                                    </span>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="profile-name">
                                                    <h3></h3>
                                                    <p class="job-title mb0"><i class="fa fa-building"></i> <?=$tiposNegocio?></p>
                                                    <p class="balance">
                                                        Ubicaciones: <span><?=$ubicaciones?></span>
                                                    </p>
                                                    <a href="#" class="btn btn-default btn-large mr10"> <i class="fa fa-star-o"></i> Agregar a Favoritos</a>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="contact-info bt">
                                                    <div class="row">
                                                        <!-- Start .row -->
                                                        <div class="col-md-4">
                                                            <dl class="mt20">
                                                                <dt class="text-muted">Teléfono</dt>
                                                                <dd><?=$telefono?></dd>
                                                            </dl>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <dl class="mt20">
                                                                <dt class="text-muted">Email/Sitio Web</dt>
                                                                <dd><?=$email?></dd>
                                                            </dl>
                                                        </div>
                                                    </div>
                                                    <!-- End .row -->
                                                </div>                                                
                                            </div>
                                            <div class="col-md-12">
                                                <div class="profile-info bt">
                                                    <h5 class="text-muted">Descripción</h5>
                                                    <p><?=$descripcion?></p>
                                                </div>
                                                <div class="profile-tags">
                                                    <h5 class="text-muted">Categorias</h5>
                                                    <form role="form" class="form-horizontal mb15">                                                    
                                                        <input type="text" value="<?=$categorias?>" data-role="tagsinput" disabled>
                                                    </form>
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
                                        <h4 class="panel-title bb">Publicaciones</h4>
                                    </div>
                                    <div class="panel-body">
                                        <div class="scroll" data-height="470">
                                            <ul class="timeline timeline-simple">
                                           <? foreach ($publicaciones as $p) { ?>                                            
                                                <li>
                                                    <p>
                                                        <a href="#"><?=$p->Titulo?></a></br><?=$p->Descripcion?>
                                                        <span class="timeline-date"><?=$p->Fecha?></span>
                                                    </p>
                                                </li>                                            
                                           <? } ?>
                                           </ul>
                                        </div>                                        
                                    </div>
                                </div>
                            </div>
                            <!-- col-lg-4 end here -->                            
                        </div>
                        <!-- End .row -->
                        <div class="row">
                            <div id="checkAll-active" class="col-lg-12">
                                <!-- col-lg-10 start here -->
                                <div class="page-header gallery-category-name">
                                    <h5>Galeria de Imagenes</h5>                                    
                                </div>
                                <div class="row gallery sortable-layout">
                                    <? foreach ($imagenes as $img) { ?>
                                    
                                    <? if($editar){
                                        $style="10";
                                    }else{
                                        $style="12";
                                    }
                                    ?>
                                    <!-- Start .row -->
                                    <div class="col-xs-<?=$style?> col-md-3">
                                        <!-- Start .col-md-3 -->
                                        <div class="panel panel-default plain panelMove">
                                            <!-- Start .panel -->
                                            <div class="panel-heading">
                                            <? if($editar==true){?>
                                                <div class="btn-group" role="group">
                                                    <button class="btn btn-default btn-link btn-sm delete-image" id="eliminarImagen" name="<?=$img->NegocioImagenID?>"><i class="fa fa-trash-o mr5"></i>Delete</button>
                                                </div>
                                                <? }?>
                                            </div>

                                            <div class="panel-body">
                                                <a href="<?=base_url()?><?=$img->Url?>" data-toggle="lightbox" data-gallery="gallerymode" data-title="Yachts" data-parrent>
                                                    <img class="img-responsive" src="<?=base_url()?><?=$img->Url?>" alt="image alt">
                                                </a>
                                            </div>
                                        </div>
                                    </div>   
                                    <? } ?>
                                    <? if($editar==true){?>
                                            <!-- col-lg-10 end here -->
                                    <div class="col-lg-2">
                                        <!-- col-lg-2 start here -->
                                        <div class="page-header">
                                            <h5>Subir Imagen</h5>
                                        </div>
                                        <div class="gallery-upload">
                                            <form id="my-awesome-dropzone" name="<?=$negocioID?>" action="<?php echo site_url('/negocio/upload');?>" class="dropzone"></form>
                                        </div>
                                    </div>
                                    <? } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End .page-content-inner -->
                </div>
                <!-- / page-content-wrapper -->
            </div>
            <!-- / page-content -->