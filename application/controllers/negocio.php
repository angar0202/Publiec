<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Negocio extends CI_Controller {	

	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->model('TipoNegocioModel');
        $this->load->model('CategoriaModel');    
        $this->load->model('NegocioModel');
        $this->load->helper(array('html','form'));
    }

	public function index()
	{
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
			$sections["container"]=$this->load->view($this->views->NEGOCIO_INDEX,null,true);
			$main["body"]=$this->load->view($this->views->CONTAINER,$sections,true);
			if($isLogin==false)
			{
				$main["plugins"]=$this->load->view($this->views->VENTANA_MODALES,null,true);
			}
			else
			{
				$main["plugins"]=$this->load->view("plugins/negocio",null,true);
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
			$usr["nombreUsuario"]=$this->session->userdata('fullname');
			$control["panel_usuario"]=$this->load->view($this->views->PANEL_USUARIO,$usr,true);
			$menu["menu_administrador"]="";
			$control["menu_usuario"]=$this->load->view($this->views->MENU_USUARIO,$menu,true);
			$sections["menu"]=$this->load->view($this->views->MENU,$control,true);
			$sections["publicaciones"]=$this->load->view($this->views->ACTIVIDAD_NEGOCIOS,null,true);		
			$info["info_negocio"]=$this->load->view($this->views->INFO_NEGOCIO,null,true);
			$data["tiposNegocios"]=$this->TipoNegocioModel->TiposNegociosCategorias();
			$data["categorias"]=$this->CategoriaModel->GetAll();
			$sections["container"]=$this->load->view($this->views->NEGOCIO_CREATE,$data,true);
			$main["body"]=$this->load->view($this->views->CONTAINER,$sections,true);
			if($isLogin==false)
			{
				$main["plugins"]=$this->load->view($this->views->VENTANA_MODALES,null,true);
			}
			else
			{
				$main["plugins"]=$this->load->view("plugins/negocio",null,true);
			}
			$this->load->view($this->views->MAIN,$main);
		}
		else
		{
			redirect('home','refresh'); 
		}
	}

	public function nuevo(){
		$isLogin=$this->common->isLogin();
		if($isLogin)
		{
			$flag=false;
			$negocio=$this->input->post("negocio");
			if($negocio!=null)
			{
				$negocio=json_decode($this->input->post("negocio"));
				$mensaje=$this->NegocioModel->crearNegocio($negocio);
				if (strpos($mensaje,'correctamente') !== false) {				
				    $flag=true;
				}
			}else{
				$mensaje="No se han ingresado los valores para el nuevo negocio";
			}
			$mensaje=json_encode(array('mensaje' => $mensaje,'resultado'=>$flag));
    		echo $mensaje;
		}
		else
		{
			redirect('home','refresh'); 
		}
	}
	public function upload(){
    if (!empty($_FILES)) {
		$tempFile = $_FILES['file']['tmp_name'];
		$fileName = $_FILES['file']['name'];
		$targetPath = getcwd() . '/uploads/temp/';
		$targetFile = $targetPath . $fileName ;
		move_uploaded_file($tempFile, $targetFile);
		// if you want to save in db,where here
		// with out model just for example
		// $this->load->database(); // load database
		// $this->db->insert('file_table',array('file_name' => $fileName));
		}
    }

public function eliminarImagen(){
	$fileName=$this->input->post("archivo");
	$targetPath = getcwd() . '/uploads/temp/';
	$targetFile = $targetPath . $fileName;
	if(file_exists($targetFile)){
		$flag=unlink($targetFile);	
	}else{
		$flag=true;
	}
	echo json_encode(array('resultado'=>$flag));
}
	
}