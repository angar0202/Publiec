<div class="page-content-inner">
<div class="row" id="listaPublicaciones">                            
 
<? foreach ($publicaciones as $p) { ?>
<div class="col-lg-4">
    <div class="card" id="<?=$p['PublicacionID']?>">
      <div class="card-heading image">
        <img id="VerPerfil" src="<?=base_url()?><?=$p['ImagenNegocio']?>" alt="<?=$p['NegocioID']?>"/>
        <div class="card-heading-header">
          <h3><?=$p["Negocio"]?></h3>
          <span>Publicado <?=$p["Fecha"]?></span>
        </div>
      </div>
      <div class="card-body">
        <p><b><?=$p["Titulo"]?></b></br><?=$p["Descripcion"]?></p>
      </div>
      <? if(count($p["Imagenes"])>0){?> 
      <div class="card-media">
          <a class="card-media-container" href="#">
             <img src="<?=base_url()?><?=$p['Imagenes'][0]?>" alt="media" align="middle"/>
          </a>
       </div>   
      <? } ?>
      <div class="card-actions">
        <? if($p["Favoritos"]>0){?>
          <button class="btn btn-success" id="Favoritos">+<?=$p["Favoritos"]?></button>
        <? } else { ?>
        <button class="btn" id="Favoritos">+<?=$p["Favoritos"]?></button>
        <? } ?>
        <b></b>        
          <!--<button class="btn">Ver Perfil</button>-->
      </div>
    </div>
    </div>
<? } ?>
</div>
</div>

