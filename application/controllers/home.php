<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {	

	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        /*$this->load->model('TipoNegocioModel','TipoNegocio');
        $this->load->model('CategoriaModel','Categoria');*/
        
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

		$main["body"]=$this->load->view($this->views->CONTAINER,$sections,true);

		if($isLogin==false){
			$main["plugins"]=$this->load->view($this->views->MAPAS,null,true);
			$main["plugins"].=$this->load->view($this->views->VENTANA_MODALES,null,true);
		}else{
			$main["plugins"]=$this->load->view($this->views->MAPAS,null,true);
		}
		$this->load->view($this->views->MAIN,$main);		
	}

}