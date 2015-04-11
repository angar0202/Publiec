<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuario extends CI_Controller {	

	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->model('TipoNegocioModel','TipoNegocio');
        $this->load->model('CategoriaModel','Categoria');        
    }

	public function index()
	{
		$isLogin=false;
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
		
		if($isLogin){
			$control["panel_usuario"]=$this->load->view($this->views->PANEL_USUARIO,null,true);
			if($isAdmin){
				$menu["menu_administrador"]=$this->load->view($this->views->MENU_ADMINISTRADOR,null,true);	
			}else{
				$menu["menu_administrador"]="";
			}
			$control["menu_usuario"]=$this->load->view($this->views->MENU_USUARIO,$menu,true);			
		}else{
			$control["panel_usuario"]="";
			$control["menu_usuario"]=$this->load->view($this->views->MENU_INVITADO,null,true);
		}
		$sections["menu"]=$this->load->view($this->views->MENU,$control,true);
		
		$sections["publicaciones"]=$this->load->view($this->views->ACTIVIDAD_NEGOCIOS,null,true);
		
		if($isLogin){
			$info["info_negocio"]=$this->load->view($this->views->INFO_NEGOCIO,null,true);	
		}else{
			$info["info_negocio"]="";
		}

		//$info["mapa_publicaciones"]=$this->load->view($this->views->MAPA,null,true);	
		$info["mapa_publicaciones"]=$this->load->view($this->views->PUBLICACIONES,null,true);	

		$sections["container"]=$this->load->view($this->views->HOME_INDEX,$info,true);

		$main["body"]=$this->load->view($this->views->CONTAINER,$sections,true);
		$modalResgitro=	$this->load->view($this->views->MODAL_REGISTRO,null,true);
		$modalLogin=$this->load->view($this->views->MODAL_LOGIN,null,true);
		$main["plugins"]=$modalResgitro." ".$modalLogin;
		
		$this->load->view($this->views->MAIN,$main);				
	}
}