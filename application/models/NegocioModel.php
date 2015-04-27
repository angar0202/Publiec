<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class NegocioModel extends MasterModel {
	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->table="Negocio";
        $this->primaryKey="NegocioID";
    }
    public function create()
    {
		$usuarioID=trim($this->input->post('UsuarioID'));
		$nombre=trim($this->input->post('Nombre'));
		$descripcion=trim($this->input->post('Descripcion'));
		$email=trim($this->input->post('Email'));
		$telefono=trim($this->input->post('Telefono'));
		if($usuarioID=="")
		{
			$mensaje="No hay un enlace con el Usuario";
		}elseif($nombre=="")
		{
			$mensaje="El nombre del Negocio es requerido";
		}elseif($email=="")
		{
			$mensaje="El Email del negocio es requerido";
		}else
		{			
			$cantidad=$this->GetCount("lower(Nombre)='$nombre'");
			if($cantidad==0){
				$data = array(
					'UsuarioID' =>  $usuarioID,
					'Nombre' =>  $nombre,
					'Descripcion' =>  $descripcion,
					'Email' => $email,
					'Telefono' => $telefono
					);
				$this->create($data);
				$mensaje="Se creo al negocio correctamente";
			}
			else
			{
				$mensaje="Este negocio ya se encuentra registrado";
			}
		}
    	return $mensaje;
	}
	public function update()
	{
		$NegocioID=trim($this->input->post('NegocioID'));
		$usuarioID=trim($this->input->post('UsuarioID'));
		$nombre=trim($this->input->post('Nombre'));
		$descripcion=trim($this->input->post('Descripcion'));
		$email=trim($this->input->post('Email'));
		$telefono=trim($this->input->post('Telefono'));
		if($usuarioID=="")
		{
			$mensaje="No hay un enlace con el Usuario";
		}elseif($nombre=="")
		{
			$mensaje="El nombre del Negocio es requerido";
		}elseif($email=="")
		{
			$mensaje="El Email del negocio es requerido";
		}else{			
			$negocio=$this->GetById($NegocioID);
			if($negocio!=null){
				$negocio->UsuarioID=$usuarioID;
				$negocio->Nombre=$nombre;
				$negocio->Descripcion=$descripcion;
				$negocio->Email=$email;
				$negocio->Telefono=$telefono;
				$this->update($negocio);
			}else{
				$mensaje="Negocio no encontrado";
			}
		}		
    	return $mensaje;
	}
	public function delete()
	{
		$negocioID=trim($this->input->post('NegocioID'));
		$this->delete($negocioID);
	}
	public function getByUsuario($usuarioID)
	{		
		return $this->GetWhere("UsuarioID=$usuarioID");
	}
	public function getCountByUsuario($usuarioID)
	{
		return $this->GetCount("UsuarioID=$usuarioID");
	}
}