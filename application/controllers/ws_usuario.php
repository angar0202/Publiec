<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ws_usuario extends CI_Controller {	

	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->model('UsuarioModel','Usuario');
        $this->load->model('NegocioModel','Negocio');
    }

	public function create()
	{
		$mensaje=$this->Usuario->create();
		echo json_encode(array('result' => $mensaje));
    	return $mensaje;
	}

	public function update()
	{
		$mensaje=$this->Usuario->updatePerfil();
		echo json_encode(array('result' => $mensaje));
    	return $mensaje;
	}

	public function login(){
		$nombreUsuario=trim($this->input->post('usuario',TRUE));
		$password=trim($this->input->post('password',TRUE));
		if($nombreUsuario==""){
			$mensaje="Campo de usuario vacio";
		}elseif($password==""){
			$mensaje="Campo de contrase&ntilde;a esta vacio";
		}else{
			$usuario= $this->Usuario->login();		
			if($usuario!=null){
				$mensaje = get_object_vars($usuario);			
			}
			else{
			$mensaje= "Usuario o contrase&ntilde;a incorrectos";			
			}	
		}
		echo json_encode(array('result' => $mensaje));
		return $mensaje;
	}

	public function negocios(){
		$usuario=$this->Usuario->login();
		if($usuario!=null){
			$this->Negocio->getByUsuario($usuario->UsuarioID);
		}else{
			echo "No a iniciado sesion";
		}
	}
}