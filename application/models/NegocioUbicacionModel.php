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
	public function delete(){
		$negocioUbicacionID=trim($this->input->post('NegocioUbicacionID'));
		$this->delete($negocioUbicacionID);
	}

}