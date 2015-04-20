<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Negocio extends CI_Controller {	

	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->model('TipoNegocioModel','TipoNegocio');
        $this->load->model('CategoriaModel','Categoria');        
    }

	public function index()
	{
		$isLogin=$this->common->isLogin();
		if($isLogin)
		{
			$top["panel_superior"]="";//$this->load->view($this->views->PANEL_SUPERIOR,null,true);
			$sections["header"]=$this->load->view($this->views->HEADER,$top,true);
			$control["panel_usuario"]="";//$this->load->view($this->views->PANEL_USUARIO,null,true);
			$menu["menu_administrador"]="";
			$control["menu_usuario"]=$this->load->view($this->views->MENU_USUARIO,$menu,true);
			$sections["menu"]=$this->load->view($this->views->MENU,$control,true);
			$sections["publicaciones"]=$this->load->view($this->views->ACTIVIDAD_NEGOCIOS,null,true);		
			$info["info_negocio"]="";//$this->load->view($this->views->INFO_NEGOCIO,null,true);
			$sections["container"]=$this->load->view($this->views->NEGOCIO_INDEX,null,true);
			$main["body"]=$this->load->view($this->views->CONTAINER,$sections,true);
			if($isLogin==false)
			{
				$main["plugins"]=$this->load->view($this->views->VENTANA_MODALES,null,true);
			}
			else
			{
				$main["plugins"]=$this->load->view($this->views->MAPAS,null,true);
			}	
			$this->load->view($this->views->MAIN,$main);
		}
		else
		{
			redirect('home','refresh'); 
		}
	}
	public function create()
	{
		$isLogin=$this->common->isLogin();
		if($isLogin)
		{
			$top["panel_superior"]=$this->load->view($this->views->PANEL_SUPERIOR,null,true);
			$sections["header"]=$this->load->view($this->views->HEADER,$top,true);
			$control["panel_usuario"]=$this->load->view($this->views->PANEL_USUARIO,null,true);
			$menu["menu_administrador"]="";
			$control["menu_usuario"]=$this->load->view($this->views->MENU_USUARIO,$menu,true);
			$sections["menu"]=$this->load->view($this->views->MENU,$control,true);
			$sections["publicaciones"]=$this->load->view($this->views->ACTIVIDAD_NEGOCIOS,null,true);		
			$info["info_negocio"]=$this->load->view($this->views->INFO_NEGOCIO,null,true);
			$sections["container"]=$this->load->view($this->views->NEGOCIO_CREATE,null,true);
			$main["body"]=$this->load->view($this->views->CONTAINER,$sections,true);
			if($isLogin==false)
			{
				$main["plugins"]=$this->load->view($this->views->VENTANA_MODALES,null,true);
			}
			else
			{
				$main["plugins"]=$this->load->view($this->views->MAPAS,null,true);
			}
			$this->load->view($this->views->MAIN,$main);
		}
		else
		{
			redirect('home','refresh'); 
		}
	}
}