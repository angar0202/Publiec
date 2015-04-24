<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class validacion extends CI_Controller {	

	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->model('ValidacionModel','Validacion');                    
        $this->load->model('UsuarioModel','Usuario');        
    }

	public function Index()
	{
		redirect('/home/','refresh');
	}

	public function registro($codigo){
		if(!$this->common->isLogin()){
			$usuario=$this->Validacion->ActualizarActivacion($codigo);
			if($usuario!=="-1")
			{
				$this->Usuario->updateActivo(1,$usuario->UsuarioID);
				$this->notificacionRegistro();
			}
			else
			{
				$this->notificacionError();
			}

		}else{
			$this->notificacionSesion();
		}
	}

	public function notificacionError(){
		$this->opcion(md5("Error@minegocio"));
	}

	public function notificacionCorrecta(){
		$this->opcion(md5("Correcto@minegocio"));
	}

	public function notificacionRegistro(){
		$this->opcion(md5("registro@minegocio"));
	}
	public function notificacionSesion(){
		$this->opcion(md5("Sesion@minegocio"));
	}

	private function opcion($caso){
		if($caso==md5("Error@minegocio")){
			$data['mensaje']="El código no es valido";
			$data['color']="#FFA490";
			$data['url']=base_url();
		}elseif($caso==md5("Correcto@minegocio")){
			$data['mensaje']="Se envio un correo con una nueva contraseña aleatoria, se recomienda cambiarla déspues de iniciar sesión";
			$data['color']="#A1F385";//#A1F385
			$data['url']=base_url();
		}elseif($caso==md5("Sesion@minegocio")){
			$data['mensaje']="Sesión iniciada";
			$data['color']="#8BDFFF";//#A1F385
			$data['url']=base_url();
		}elseif($caso==md5("registro@minegocio")){
			$data['mensaje']="Su cuenta fue habilitada, puede realizar las publicaciones, recomendaciones y descubrir los pequeños negocios que estan a tu alrededor";
			$data['color']="#A1F385";//#A1F385
			$data['url']=base_url();
		}
		$this->load->view("Validacion/notificacion",$data);	
	}

	public function password($codigo){
		if(!$this->common->isLogin())
		{
			$usuario=$this->Validacion->ActualizarRecordarPassword($codigo);
			if($usuario!=="-1")
			{
				$c=$this->common->GenerarCodigo(6);
				$data["TITULO"]="RECUPERAR CONTRASEÑA";
				$param["password"]=$c;
				$data["CONTENIDO"]=$this->load->view("email/Recordar",$param,true);
				$html=$this->load->view("email/Plantilla",$data,true);	
				$resultado=$this->common->EnviarCorreo($usuario->Email,"Nueva Contraseña Publiec",$html);
				$this->Usuario->updatePassword($c,$usuario->UsuarioID);
				$this->notificacionCorrecta();
			}
			else
			{
				$this->notificacionError();
			}
		}
		else
		{
			$this->notificacionSesion();
		}
	}
}