<div class="page-content-inner">
<div class="row" id="listaNegocios">                            
 
<? 
$i=1;
$cerro=false;
$divisor=ceil(count($negocios)/3);
foreach ($negocios as $p) { ?>
  <? if($i % $divisor==0){ $cerro=false;?>
    </div><div class="col-lg-4">    
  <? } elseif($i==1){ $cerro=false;?>  
    <div class="col-lg-4">
    <? }?>
    <div class="card" id="<?=$p['NegocioUbicacionID']?>">
      <div class="card-heading image">
        <img id="VerPerfil" src="<?=base_url()?><?=$p['IconoNegocio']?>" alt="<?=$p['NegocioID']?>"/>
        <div class="card-heading-header">
          <h3><?=$p["Nombre"]?></h3>
          <span>Publicado <?=$p["FechaCreacion"]?></span>
        </div>
      </div>
      <div class="card-body">
        <p><?=$p["Descripcion"]?></p>
      </div>
      
      <div class="card-media">
          <a class="card-media-container" href="#">
             <img src="<?=base_url()?><?=$p['ImagenNegocio']?>" alt="media" align="middle"/>
          </a>
      </div>      
      <div class="card-actions">
        <? if($p["Favoritos"]>0){?>
          <button class="btn btn-success" id="Favoritos">+<?=$p["Favoritos"]?></button>
        <? } else { ?>
          <button class="btn" id="Favoritos">+<?=$p["Favoritos"]?></button>
        <? } ?>        
      </div>
    </div>      
<? $i++; } ?>
<? if($cerro==false && count($negocios)>0){?>
  </div>
<? } ?>
</div>
</div>