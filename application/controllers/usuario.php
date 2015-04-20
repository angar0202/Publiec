<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuario extends CI_Controller {	

	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->model('TipoNegocioModel','TipoNegocio');
        $this->load->model('CategoriaModel','Categoria');   
        $this->load->model('UsuarioModel','Usuario');     
    }
	
	public function login()
	{
			$flag=false;
			if(!$this->common->isLogin()){
				$usuario=$this->Usuario->login();				
				if($usuario!=null) {
				    $newdata = array(
					   'id_usuario' => $usuario->UsuarioID,
	                   'username'  => $usuario->NombreUsuario,
	                   'password'  => $usuario->Password,
	                   'fullname'  => $usuario->NombreCompleto,
	                   'email'  => $usuario->Email,
	                   'logged_in' => TRUE
	               );
				   $this->session->set_userdata($newdata);
				   $mensaje="Iniciando sesión...";				   
				   $flag=true;
				}else{
					$mensaje="Usuario o contraseña incorrectos";
				}
			}else{
				$mensaje="Ya a iniciado sesión";
			}
			$mensaje=json_encode(array('mensaje' => $mensaje,'resultado'=>$flag));
    		echo $mensaje;
	}

	public function logout()
	{
		$this->common->logout();
		redirect('home','refresh'); 
	}
}