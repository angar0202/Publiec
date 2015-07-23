<!-- Start #right-sidebar -->
            <aside id="right-sidebar" class="right-sidebar hidden-md hidden-sm hidden-xs">
                <!-- Start .sidebar-inner -->
                <div class="sidebar-inner">
                    <!-- Start .sidebar-scrollarea -->
                    <div class="sidebar-scrollarea">
                        <div class="tabs">
                            <!-- Start .rs tabs -->
                            <ul id="rstab" class="nav nav-tabs nav-justified">
                                <li class="active">
                                    <a href="#activity" data-toggle="tab"><i class="glyphicon glyphicon-bullhorn"></i> </a>
                                </li>
                                <li>
                                    <a href="#users" data-toggle="tab"><i class="fa fa-comments"></i> </a>
                                </li>
                            </ul>
                            <div id="rstab-content" class="tab-content">
                                <div class="tab-pane fade active in" id="activity">
                                    <ul class="timeline timeline-icons timeline-sm">
                                        <? foreach ($negocios as $n) {?>
                                            <li>
                                                <p>
                                                    <a href="#" id="<?=$n->NegocioID?>"><?=$n->Nombre?></a>: 
                                                    <?=$n->Descripcion?>
                                                    <span class="timeline-icon"><i class="fa fa-file-text-o"></i></span>
                                                    <span class="timeline-date"><?=$n->UltimaPublicacion?></span>
                                                </p>
                                            </li>
                                        <? } ?>                                        
                                    </ul>
                                </div>
                                <div class="tab-pane fade" id="users">
                                    <div class="chat-user-list">
                                        <form class="form-vertical chat-search" role="form">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input type="text" class="form-control input-sm" placeholder="Buscar ...">
                                                    <span class="input-group-btn">                                        
                                                        <button class="btn btn-default btn-sm" type="submit"><i class="fa fa-search"></i></button>
                                                    </span>
                                                </div>
                                            </div>
                                            <!-- End .form-group  -->
                                        </form>
                                        <ul class="user-list list-group">
                                        <? foreach ($publicaciones as $p) {?>
                                            <li class="list-group-item clearfix">
                                                <a href="#">
                                                    <img src="<?=base_url()?><?=$p->ImagenNegocio?>" alt="avatar" class="avatar">
                                                    <span class="name"><?=$p->Titulo?></span>
                                                    <? if($p->Atendiendo==1){?>
                                                        <span class="status status-online">Atendiendo</span>
                                                    <? } else { ?>
                                                        <span class="status status-offline">Cerrado</span>
                                                    <? } ?>
                                                </a>
                                            </li>
                                        <? } ?>
                                        </ul>                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End .rs tabs -->
                    </div>
                    <!-- End .sidebar-scrollarea -->
                </div>
                <!-- End .sidebar-inner -->
            </aside>
            <!-- End #right-sidebar -->