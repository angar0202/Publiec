<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class NegocioPublicacionModel extends MasterModel {
	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->table="NegocioPublicacion";
        $this->primaryKey="NegocioPublicacionID";
    }

    public function GetByNegocioId($id){
    	$sql="select * from NegocioPublicacion where NegocioID=$id order by Fecha desc";
    	return $this->db->query($sql)->result();
    }

    public function Get(){
        $sql="select np.*, pi.Url as UrlImagen
,(select count(pf.UsuarioID) from publicacionfavorita pf where pf.NegocioPublicacionID = np.NegocioPublicacionID) as Favoritos
,(select IFNULL(avg(pp.Puntuacion),0) from publicacionpuntuacion pp where pp.NegocioPublicacionID = np.NegocioPublicacionID ) as Puntuacion
,n.Nombre as Negocio
,(select ni.Url from negocioimagen ni where ni.NegocioID = n.NegocioID limit 1) as ImagenNegocio
from NegocioPublicacion np
inner join negocio n on np.NegocioID = n.NegocioID
left outer join publicacionimagen pi on np.NegocioPublicacionID = pi.NegocioPublicacionID
order by Fecha desc";
        $result=$this->db->query($sql)->result_array();
        $publicaciones=array();
        $id=0;
        $imagenes=array();
        $diferente=true;
        $AnteriorPublicacionID=-1;
        foreach ($result as $p) {
                if(count($publicaciones)==0){
                    $diferente=true;
                }else{
                    if($AnteriorPublicacionID==$p["NegocioPublicacionID"])
                    {
                      $diferente=false;  
                    }
                    else
                    {
                        $diferente=true;
                    }
                }
                if($diferente){
                    $imagenes=array();
                    if($p["UrlImagen"] != null || $p["UrlImagen"] != ""){
                        $imagenes[]=$p["UrlImagen"];
                    }
                    $data = array(
                        'PublicacionID'=> $p["NegocioPublicacionID"],
                        'NegocioID'=> $p["NegocioID"],
                        'Titulo' => $p["Titulo"], 
                        'Descripcion' => $p["Descripcion"], 
                        'Fecha' => $p["Fecha"], 
                        'Titulo' => $p["Titulo"], 
                        'Favoritos' => $p["Favoritos"], 
                        'Puntuacion' => $p["Puntuacion"], 
                        'Negocio' => $p["Negocio"],
                        'ImagenNegocio' => $p["ImagenNegocio"],
                        'Imagenes' => $imagenes
                    );
                    $AnteriorPublicacionID=$p["NegocioPublicacionID"];
                    $publicaciones[]=$data;
                }else{
                    $publicaciones[$id]["Imagenes"]=$imagenes;
                }
            $id++;
        }
        return $publicaciones;
    }

    public function listaUltimasPublicaciones(){
        $sql="select np.Titulo,np.Descripcion,np.Fecha,n.Nombre as NombreNegocio,
        (select ni.Url from negocioimagen ni where ni.NegocioID = n.NegocioID and ni.Url is not null limit 1) as ImagenNegocio,
        (select count(u.NegocioUbicacionID) from negocioubicacion u 
      inner join negociohorario nh on nh.NegocioUbicacionID = u.NegocioUbicacionID
      where current_time between maketime(nh.HoraInicio,nh.MinutoInicio,0) and maketime(nh.HoraFin,nh.MinutoFin,0)
      and weekday(current_date)+1=nh.Dia and u.NegocioID = n.NegocioID) as Atendiendo
        from negociopublicacion np 
        inner join negocio n on n.NegocioID = np.NegocioID
        order by Fecha desc";
        return $this->db->query($sql)->result();
    }    
}