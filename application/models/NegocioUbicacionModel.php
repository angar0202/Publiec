<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class NegocioUbicacionModel extends MasterModel {
	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->table="NegocioUbicacion";
        $this->primaryKey="NegocioUbicacionID";
    }
    public function create()
	{
		$negocioID=trim($this->input->post('NegocioID'));
		$latitud=trim($this->input->post('Latitud'));
		$longitud=trim($this->input->post('Longitud'));
		$direccion=trim($this->input->post('Direccion'));		
		if(trim($negocioID)==""){
			$mensaje="No hay un negocio enlazado";
		}elseif(trim($direccion)==""){
			$mensaje="Es requerido el campo de direccion";
		}else{
			$data = array(
					'NegocioID' =>  $negocioID,
					'Latitud' =>  $latitud,
					'Longitud' =>  $longitud,
					'Direccion' => $direccion
					);
				$this->create($data);
				$mensaje="Se creo al negocio correctamente";			
		}
    	return $mensaje;
	}
	public function update()
	{
		$negocioUbicacionID=trim($this->input->post('NegocioUbicacionID'));
		$negocioID=trim($this->input->post('NegocioID'));
		$latitud=trim($this->input->post('Latitud'));
		$longitud=trim($this->input->post('Longitud'));
		$direccion=trim($this->input->post('Direccion'));		
		if(trim($negocioID)==""){
			$mensaje="No hay un negocio enlazado";
		}elseif(trim($direccion)==""){
			$mensaje="Es requerido el campo de direccion";
		}else{
			$ubicacion=$this->getById($negocioUbicacionID);
			$ubicacion->NegocioID=$negocioID;
			$ubicacion->Latitud=$latitud;
			$ubicacion->Longitud=$longitud;
			$ubicacion->Direccion=$direccion;
			$this->update($ubicacion);
			$mensaje="Se actualizo la direccion correctamente";			
		}
    	return $mensaje;
	}
	
	public function delete()
	{
		$negocioUbicacionID=trim($this->input->post('NegocioUbicacionID'));
		$this->delete($negocioUbicacionID);
	}

	public function obtenerUbicaciones(){
		$sql="select nu.*,n.Fecha as FechaCreacion,n.Nombre,n.Descripcion as DescripcionNegocio,
			(select ni.Url from negocioimagen ni where ni.NegocioID = n.NegocioID limit 1) as ImagenNegocio,
			(select count(nf.NegocioFavoritoID) from negociofavorito nf where nf.NegocioID = n.NegocioID) as Favoritos,
      ifnull(ifnull((select tn.UrlHabilitado
      from negociocategoria nc
      inner join categoria c on nc.CategoriaID=c.CategoriaID
      inner join tiponegocio tn on tn.TipoNegocioID = c.CategoriaID
      inner join negocioubicacion u on u.NegocioID = nc.NegocioID
      inner join negociohorario nh on nh.NegocioUbicacionID = u.NegocioUbicacionID
      where current_time between maketime(nh.HoraInicio,nh.MinutoInicio,0) and maketime(nh.HoraFin,nh.MinutoFin,0)
      and weekday(current_date)+1=nh.Dia
      and nc.NegocioID = nu.NegocioID and tn.UrlDeshabilitado is not null limit 1),(select tn.UrlDeshabilitado from negocioubicacion nu 
      inner join negociocategoria nc on nc.NegocioID = nu.NegocioID
      inner join categoria c on nc.CategoriaID=c.CategoriaID
      inner join tiponegocio tn on tn.TipoNegocioID = c.CategoriaID 
      where nc.NegocioID = n.NegocioID and tn.UrlDeshabilitado is not null limit 1)),'default.png') as IconoNegocio
			from negocioubicacion nu
			inner join negocio n on nu.NegocioID = n.NegocioID			
      where n.Activo=1 order by FechaCreacion desc";
		return $this->db->query($sql);
	}

}