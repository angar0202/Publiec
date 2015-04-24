<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuario extends CI_Controller {	

	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->model('TipoNegocioModel','TipoNegocio');
        $this->load->model('CategoriaModel','Categoria');   
        $this->load->model('UsuarioModel','Usuario');
        $this->load->model('ValidacionModel','Validacion');
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

	public function recordar(){		
		$isLogin=$this->common->isLogin();
		$value=trim($this->input->post("emailUserRemember"));		
		if(!$isLogin)
		{
			$usuario= $this->Usuario->First("NombreUsuario = '".$value."' or Email='".$value."'");
    		$flag=FALSE;
		    if($usuario!=null)
		    {
			    $codigo=$this->common->GenerarCodigo();
				$this->Validacion->CrearRecordarPassword($usuario->UsuarioID,$codigo);			
				$data["TITULO"]="SOLICITUD PARA RECUPERAR CONTRASEÑA";
				$param["codigo"]=$codigo;
				$data["CONTENIDO"]=$this->load->view("email/Solicitud",$param,true);
				$html=$this->load->view("email/Plantilla",$data,true);
				$resultado=$this->common->EnviarCorreo($usuario->Email,"Cambio de Contraseña",$html);
				if(strpos($resultado,"Your message has been successfully sent")!==false){
					$mensaje="Se envio un correo electronico para continuar con el proceso de cambio de contraseña.";
					$flag=true;
				}else{
					$mensaje="Ocurrio un problema al enviar correo electronico:".$resultado;
					$flag=false;
				}				
			}
			else
			{
				$flag=false;
				$mensaje="El usuario no existe, ingrese correctamente el nombre de usuario.";				
			}
			$mensaje=json_encode(array('mensaje' => $mensaje,'resultado'=>$flag));
    		echo $mensaje;
		}
	}

	public function logout()
	{
		$this->common->logout();
		redirect('home','refresh'); 
	}
}