<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {	

	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        /*$this->load->model('TipoNegocioModel','TipoNegocio');
        $this->load->model('CategoriaModel','Categoria');*/
        $this->load->model('NegocioPublicacionModel');
        $this->load->model('PublicacionFavoritaModel');
        $this->load->model('NegocioUbicacionModel');
        $this->load->model('NegocioFavoritoModel');        
    }

	public function index()
	{
		$isLogin=$this->common->isLogin();
		$isAdmin=false;

		if($isLogin){
			if($isAdmin){
				$top["panel_superior"]=$this->load->view($this->views->PANEL_SUPERIOR,null,true);
			}else{
				$top["panel_superior"]="";
			}
		}else{
			$top["panel_superior"]="";
		}
		$sections["header"]=$this->load->view($this->views->HEADER,$top,true);
		
		if($isLogin)
		{
			$usr["nombreUsuario"]=$this->session->userdata('fullname');
			$control["panel_usuario"]=$this->load->view($this->views->PANEL_USUARIO,$usr,true);
			if($isAdmin)
			{
				$menu["menu_administrador"]=$this->load->view($this->views->MENU_ADMINISTRADOR,null,true);	
			}
			else
			{
				$menu["menu_administrador"]="";
			}
			$control["menu_usuario"]=$this->load->view($this->views->MENU_USUARIO,$menu,true);			
		}else{
			$control["panel_usuario"]="";
			$control["menu_usuario"]=$this->load->view($this->views->MENU_INVITADO,null,true);
		}
		$sections["menu"]=$this->load->view($this->views->MENU,$control,true);
		
		$sections["publicaciones"]=$this->load->view($this->views->ACTIVIDAD_NEGOCIOS,null,true);
		
		if($isLogin)
		{
			$info["info_negocio"]="";//$this->load->view($this->views->INFO_NEGOCIO,null,true);	
		}
		else
		{
			$info["info_negocio"]="";
		}

		$info["mapa_publicaciones"]=$this->load->view($this->views->MAPA,null,true);	
		//$info["mapa_publicaciones"]=$this->load->view($this->views->PUBLICACIONES,null,true);
		$sections["container"]=$this->load->view($this->views->HOME_INDEX,$info,true);
		$sections["container"].=$this->load->view($this->views->REGISTRO,null,true); // Se agrega pantalla modal de REgistro de Usuario
		$sections["container"].=$this->load->view($this->views->LOGIN,null,true); // Se agrega pantalla modal de LOGIN de Usuario
		$sections["container"].=$this->load->view($this->views->RECORDAR,null,true); // Se agrega pantalla modal de RECORDAR de Usuario
		$sections["estilo"]='style="height: 100%; min-height: 100% !important;display: block;"';
		$main["body"]=$this->load->view($this->views->CONTAINER,$sections,true);
		if($isLogin==false){
			$main["plugins"]=$this->load->view($this->views->MAPAS,null,true);
			$main["plugins"].=$this->load->view($this->views->VENTANA_MODALES,null,true);
		}else{
			$main["plugins"]=$this->load->view($this->views->MAPAS,null,true);
		}
		$this->load->view($this->views->MAIN,$main);
	}

	public function publicaciones()
	{
		$isLogin=$this->common->isLogin();
		$isAdmin=false;
		if($isLogin){
			if($isAdmin){
				$top["panel_superior"]=$this->load->view($this->views->PANEL_SUPERIOR,null,true);
			}else{
				$top["panel_superior"]="";
			}
		}else{
			$top["panel_superior"]="";
		}
		$sections["header"]=$this->load->view($this->views->HEADER,$top,true);
		
		if($isLogin)
		{
			$usr["nombreUsuario"]=$this->session->userdata('fullname');
			$control["panel_usuario"]=$this->load->view($this->views->PANEL_USUARIO,$usr,true);
			if($isAdmin)
			{
				$menu["menu_administrador"]=$this->load->view($this->views->MENU_ADMINISTRADOR,null,true);	
			}
			else
			{
				$menu["menu_administrador"]="";
			}
			$control["menu_usuario"]=$this->load->view($this->views->MENU_USUARIO,$menu,true);			
		}else{
			$control["panel_usuario"]="";
			$control["menu_usuario"]=$this->load->view($this->views->MENU_INVITADO,null,true);
		}
		$sections["menu"]=$this->load->view($this->views->MENU,$control,true);
		
		$sections["publicaciones"]=$this->load->view($this->views->ACTIVIDAD_NEGOCIOS,null,true);
		
		if($isLogin)
		{
			$info["info_negocio"]="";//$this->load->view($this->views->INFO_NEGOCIO,null,true);	
		}
		else
		{
			$info["info_negocio"]="";
		}
		$data["publicaciones"]=$this->NegocioPublicacionModel->Get();
		$info["mapa_publicaciones"]=$this->load->view("home/publicaciones",$data,true);	
		//$info["mapa_publicaciones"]=$this->load->view($this->views->PUBLICACIONES,null,true);
		$sections["container"]=$this->load->view($this->views->HOME_INDEX,$info,true);
		if($isLogin==false){
			$sections["container"].=$this->load->view($this->views->REGISTRO,null,true); // Se agrega pantalla modal de REgistro de Usuario
			$sections["container"].=$this->load->view($this->views->LOGIN,null,true); // Se agrega pantalla modal de LOGIN de Usuario
			$sections["container"].=$this->load->view($this->views->RECORDAR,null,true); // Se agrega pantalla modal de RECORDAR de Usuario
		}
		$sections["estilo"]='';
		$main["body"]=$this->load->view($this->views->CONTAINER,$sections,true);

		if($isLogin==false){
			$main["plugins"]="<script src='".base_url()."js/pages/custom/publicaciones.js'></script>";
			$main["plugins"].=$this->load->view($this->views->VENTANA_MODALES,null,true);
		}else{
			$main["plugins"]="<script src='".base_url()."js/pages/custom/publicaciones.js'></script>";
		}
		$this->load->view($this->views->MAIN,$main);	
	}

	public function mapa(){
		$ubicaciones=$this->NegocioUbicacionModel->obtenerUbicaciones();
		echo json_encode($ubicaciones);
	}

	public function agregarFavorito(){
		$isLogin=$this->common->isLogin();
		$mensaje="";
		$resultado=0;
		$numero=0;
		$publicacionID=$this->input->post("publicacionID");
		$usuarioID=$this->session->userdata('id_usuario');
		if($isLogin){
			$result=$this->PublicacionFavoritaModel->GetWhere("UsuarioID=$usuarioID and NegocioPublicacionID=$publicacionID")->result();
			if(count($result)==0){
				$publicacion = array('NegocioPublicacionID' => $publicacionID,'UsuarioID'=> $usuarioID);
				$insertado=$this->PublicacionFavoritaModel->Create($publicacion);
				if($insertado>0){
					$mensaje="Agregado a favoritos";
					$resultado=1;
				}else{
					$mensaje="No se pudo agregar a favoritos";
					$resultado=0;
				}
			}else{
				$eliminado=$this->PublicacionFavoritaModel->Delete($result[0]->PublicacionFavoritaID);	
				if($eliminado>0){
					$mensaje="Se elimino de favoritos";
					$resultado=1;
				}else{
					$mensaje="No se pudo quitar de favoritos";
					$resultado=0;
				}
			}
		}else{
			$mensaje="Debe iniciar sesión";
			$resultado=0;
		}
		$numero=$this->PublicacionFavoritaModel->GetCount("NegocioPublicacionID=$publicacionID");
		$arrayName = array('mensaje' => $mensaje,'resultado'=> $resultado,'numero'=>$numero);
		echo json_encode($arrayName);
	}

	public function agregarNegocioFavorito(){
		$isLogin=$this->common->isLogin();
		$mensaje="";
		$resultado=0;
		$numero=0;
		$negocioID=$this->input->post("negocioID");
		$usuarioID=$this->session->userdata('id_usuario');
		if($isLogin){
			$result=$this->NegocioFavoritoModel->GetWhere("UsuarioID=$usuarioID and NegocioID=$negocioID")->result();
			if(count($result)==0){
				$negocioFavorito = array('NegocioID' => $negocioID,'UsuarioID'=> $usuarioID);
				$insertado=$this->NegocioFavoritoModel->Create($negocioFavorito);
				if($insertado>0){
					$mensaje="Agregado a favoritos";
					$resultado=1;
				}else{
					$mensaje="No se pudo agregar a favoritos";
					$resultado=0;
				}
			}else{
				$eliminado=$this->NegocioFavoritoModel->Delete($result[0]->NegocioFavoritoID);	
				if($eliminado>0){
					$mensaje="Se elimino de favoritos";
					$resultado=1;
				}else{
					$mensaje="No se pudo quitar de favoritos";
					$resultado=0;
				}
			}
		}else{
			$mensaje="Debe iniciar sesión";
			$resultado=0;
		}
		$numero=$this->NegocioFavoritoModel->GetCount("NegocioID=$negocioID");
		$arrayName = array('mensaje' => $mensaje,'resultado'=> $resultado,'numero'=>$numero);
		echo json_encode($arrayName);
	}
}