<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class ContactoModel extends MasterModel {
	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->table="Contacto";
        $this->primaryKey="ContactoID";
    }
    public function create()
	{
		$negocioID=trim($this->input->post('NegocioID'));
		$nombre=trim($this->input->post('nombre'));
		$apellido=trim($this->input->post('apellido'));
		$telefono=trim($this->input->post('telefono'));		
		$email=trim($this->input->post('email'));		
		$direccion=trim($this->input->post('direccion'));		

		if(trim($negocioID)==""){
			$mensaje="No hay un negocio enlazado";
		}elseif(trim($nombre)==""){
			$mensaje="Es requerido el campo de nombre";
		}elseif(trim($apellido)==""){
			$mensaje="Es requerido el campo de apellido";
		}elseif(trim($email)==""){
			$mensaje="Es requerido el campo de nombre";
		}else{
			$data = array(
					'NegocioID' =>  $negocioID,
					'Nombre' =>  $nombre,
					'Apellido' =>  $apellido,
					'Telefono' => $telefono,
					'Email' => $email,
					'Direccion' => $direccion
					);
				$this->create($data);
				$mensaje="Se creo al Contacto correctamente";			
		}
    	return $mensaje;
	}
	public function update()
	{
		$contactoID=trim($this->input->post('ContactoID'));
		$negocioID=trim($this->input->post('NegocioID'));
		$nombre=trim($this->input->post('nombre'));
		$apellido=trim($this->input->post('apellido'));
		$telefono=trim($this->input->post('telefono'));		
		$email=trim($this->input->post('email'));		
		$direccion=trim($this->input->post('direccion'));		

		if(trim($negocioID)==""){
			$mensaje="No hay un negocio enlazado";
		}elseif(trim($nombre)==""){
			$mensaje="Es requerido el campo de nombre";
		}elseif(trim($apellido)==""){
			$mensaje="Es requerido el campo de apellido";
		}elseif(trim($email)==""){
			$mensaje="Es requerido el campo de nombre";
		}else{
			$contacto=$this->getById($contactoID);
			if($contacto!=null){
				$contacto->NegocioID=$negocioID;
				$contacto->Nombre=$nombre;
				$contacto->Apellido=$apellido;
				$contacto->Telefono=$telefono;
				$contacto->Email=$email;
				$contacto->Direccion=$direccion;
				$this->update($contacto);
			$mensaje="Se actualizo al Contacto correctamente";				
			}else{
				$mensaje="No se encontro al contacto";
			}
		}
    	return $mensaje;		
	}
	public function delete(){
		$contactoID=trim($this->input->post('ContactoID'));
		$this->delete($contactoID);
	}
}