<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuario extends CI_Controller {	

	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->model('TipoNegocioModel','TipoNegocio');
        $this->load->model('CategoriaModel','Categoria');   
        $this->load->model('NegocioModel','Negocio');   
        $this->load->model('UsuarioModel','Usuario');
        $this->load->model('ValidacionModel','Validacion');
    }

    public function actualizar(){
    	$isLogin=$this->common->isLogin();
		if($isLogin)
		{
			$resultado=false;
			/*$_POST["nombreUsuario"]="agarcia";
			$_POST["nombreCompleto"]="Andres Garcia";
			$_POST["correo"]="angar_0202@gmail.com";
			$_POST["cambiarPassword"]="false";*/
			$nombreCompleto=$this->input->post("nombreCompleto");
			$nombreUsuario=$this->input->post("nombreUsuario");
			$correo=$this->input->post("correo");
			$passwordActual=$this->input->post("passwordActual");
			$passwordNuevo=$this->input->post("passwordNuevo");
			$cambiarPassword=$this->input->post("cambiarPassword");

			if($this->input->post("nombreUsuario")!=""){
				$usuarioID=$this->session->userdata("id_usuario");
				$usuario=$this->Usuario->getById($usuarioID);
				if($usuario->Password!=md5($passwordActual) && $cambiarPassword=="true"){
					$mensaje="La contraseña actual no coincide";
					$resultado=false;
				}
				else
				{
					$usuario->NombreUsuario=$nombreUsuario;
					$usuario->NombreCompleto=$nombreCompleto;
					$usuario->Email=$correo;
					if($cambiarPassword=="true")
					{
						$usuario->Password=md5($passwordNuevo);	
					}
					$this->Usuario->Update($usuario);
					$mensaje="Se actualizaron los datos correctamente";
					$resultado=true;
					$this->session->userdata("password",md5($passwordNuevo));
				}
			}else{
				$mensaje="Datos de usuario no validos para actualizar";
			}
			
			$mensaje=json_encode(array('mensaje' => $mensaje,'resultado'=>$resultado));
    		echo $mensaje;
		}
    }
    public function perfil(){
    	$isLogin=$this->common->isLogin();
		if($isLogin)
		{
			$top["panel_superior"]="";//$this->load->view($this->views->PANEL_SUPERIOR,null,true);
			$sections["header"]=$this->load->view($this->views->HEADER,$top,true);
			$usr["nombreUsuario"]=$this->session->userdata('fullname');
			$control["panel_usuario"]=$this->load->view($this->views->PANEL_USUARIO,$usr,true);
			$menu["menu_administrador"]="";
			$control["menu_usuario"]=$this->load->view($this->views->MENU_USUARIO,$menu,true);
			$sections["menu"]=$this->load->view($this->views->MENU,$control,true);
			$sections["publicaciones"]=$this->load->view($this->views->ACTIVIDAD_NEGOCIOS,null,true);		
			$info["info_negocio"]="";//$this->load->view($this->views->INFO_NEGOCIO,null,true);			
			
			$usuario=$this->Usuario->getById($this->session->userdata('id_usuario'));
			$data["nombreUsuario"]=$usuario->NombreCompleto;
			$cantidad=$this->Negocio->getCountByUsuario($usuario->UsuarioID);
			$data["numeroNegocios"]=$cantidad;
			if($cantidad==0){
				$data["tipoUsuario"]="Usuario";
			}elseif($cantidad>0){
				$data["tipoUsuario"]="Emprendedor";
			}
			$data["usuario"]=$usuario->NombreUsuario;
			$data["email"]=$usuario->Email;
			$sections["container"]=$this->load->view("usuario/perfil",$data,true);
			$sections["estilo"]='';
			$main["body"]=$this->load->view($this->views->CONTAINER,$sections,true);
			if($isLogin==false)
			{
				$main["plugins"]=$this->load->view($this->views->VENTANA_MODALES,null,true);
			}
			else
			{
				$main["plugins"]="";//$this->load->view($this->views->MAPAS,null,true);
			}	
			$this->load->view($this->views->MAIN,$main);
		}
		else
		{
			redirect('home','refresh'); 
		}
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

	public function recordar()
	{
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
	public function info(){
		$isLogin=$this->common->isLogin();
		if($isLogin)
		{
			$usuario=$this->Usuario->getById($this->session->userdata('id_usuario'));
			echo json_encode(array('NombreUsuario' =>$usuario->NombreUsuario ,'NombreCompleto'=>$usuario->NombreCompleto,'Email'=>$usuario->Email,'Fecha'=>$usuario->Fecha));
		}
	}
}