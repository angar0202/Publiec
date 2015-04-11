<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class TipoNegocio extends CI_Controller {	

	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->model('TipoNegocioModel','TipoNegocio');
        $this->load->model('CategoriaModel','Categoria');        
    }

	public function index()
	{
		$sections["header"]=$this->load->view($this->views->HEADER,null,true);
		$sections["menu"]=$this->load->view($this->views->MENU,null,true);
		$sections["publicaciones"]=$this->load->view($this->views->PUBLICACIONES,null,true);
		$sections["container"]=$this->load->view($this->views->TIPO_NEGOCIO_INDEX,null,true);
		$main["body"]=$this->load->view($this->views->CONTAINER,$sections,true);		
		$this->load->view($this->views->MAIN,$main);		
	}
}