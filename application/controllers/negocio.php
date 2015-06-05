<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Negocio extends CI_Controller {	

	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->model('TipoNegocioModel');
        $this->load->model('CategoriaModel');    
        $this->load->model('NegocioModel');
        $this->load->model('NegocioImagenModel');
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
			$data["negocios"]=$this->NegocioModel->getByUsuario($this->session->userdata('id_usuario'));
			$sections["container"]=$this->load->view($this->views->NEGOCIO_INDEX,$data,true);
			$main["body"]=$this->load->view($this->views->CONTAINER,$sections,true);
			if($isLogin==false)
			{
				$main["plugins"]=$this->load->view($this->views->VENTANA_MODALES,null,true);
			}
			else
			{
				$main["plugins"]=$this->load->view("plugins/tablaNegocio",null,true);
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

	public function edit(){
		$isLogin=$this->common->isLogin();
		if($isLogin)
		{
			$id=$this->input->post("NegocioID");
			if($id!=""){
				$top["panel_superior"]="";//$this->load->view($this->views->PANEL_SUPERIOR,null,true);
				$sections["header"]=$this->load->view($this->views->HEADER,$top,true);
				$usr["nombreUsuario"]=$this->session->userdata('fullname');
				$control["panel_usuario"]=$this->load->view($this->views->PANEL_USUARIO,$usr,true);
				$menu["menu_administrador"]="";
				$control["menu_usuario"]=$this->load->view($this->views->MENU_USUARIO,$menu,true);
				$sections["menu"]=$this->load->view($this->views->MENU,$control,true);
				$sections["publicaciones"]=$this->load->view($this->views->ACTIVIDAD_NEGOCIOS,null,true);		
				$info["info_negocio"]="";//$this->load->view($this->views->INFO_NEGOCIO,null,true);
				/**
				Informacion a llenar para modificar Negocio
				*/
				$data["id"]=$id;
				$sections["container"]=$this->load->view("negocio/edit",$data,true);
				$main["body"]=$this->load->view($this->views->CONTAINER,$sections,true);
				if($isLogin==false)
				{
					$main["plugins"]=$this->load->view($this->views->VENTANA_MODALES,null,true);
				}
				else
				{
					$main["plugins"]=$this->load->view("plugins/tablaNegocio",null,true);
				}	
				$this->load->view($this->views->MAIN,$main);
			}
			else
			{
				redirect('negocio/index','refresh'); 		
			}
		}
		else
		{
			redirect('home','refresh'); 
		}
	}

	public function nuevo(){
		$isLogin=$this->common->isLogin();
		$negocio_id=-1;
		$mensaje="";
		if($isLogin)
		{
			$flag=false;
			$negocio=$this->input->post("negocio");
			if($negocio!=null)
			{
				$negocio=json_decode($this->input->post("negocio"));
				$mensaje=$this->NegocioModel->crearNegocio($negocio);
				if (strpos($mensaje,'correctamente') !== false) {
					preg_match_all('!\d+!', $mensaje, $negocio_id);					
				    $flag=true;
				}				
			}else{
				$mensaje="No se han ingresado los valores para el nuevo negocio";
			}
			$mensaje=json_encode(array('mensaje' => $mensaje,'resultado'=>$flag,'negocio_id'=>$negocio_id));
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

		if (!file_exists('uploads/'.md5($this->session->userdata('id_usuario')))) {
		    mkdir('uploads/'.md5($this->session->userdata('id_usuario')), 0777, true);
		}
		$targetPath = getcwd() . '/uploads/'.md5($this->session->userdata('id_usuario')).'/';
		//$targetFile = $targetPath . $fileName ;
		$date = new DateTime();
	    $newFileName = $date->getTimestamp().$_FILES['file']['name'];
	    $targetFile =  $targetPath.$newFileName;
		move_uploaded_file($tempFile, $targetFile);		
		// if you want to save in db,where here
		// with out model just for example
		// $this->load->database(); // load database
		// $this->db->insert('file_table',array('file_name' => $fileName));
		}
    }

    public function agregarImagen(){
    	$isLogin=$this->common->isLogin();
		if($isLogin)
		{
			if($this->input->post("negocio_id")!=""){
				$url='/uploads/'.md5($this->session->userdata('id_usuario')).'/'.$this->input->post("archivo");
				$negocioID=htmlspecialchars($this->input->post("negocio_id"));
				$data= array('NegocioID' =>  $negocioID, 'Url' => $url);
				$this->NegocioImagenModel->create($data);		
				echo "NegocioID:".$negocioID." archivo:".$url;	
			}else{
				echo "No se a ingresado un ID de negocio valido";
			}			
		}else{
			redirect('home','refresh'); 
		}
    }

	public function eliminarImagen()
	{
		$isLogin=$this->common->isLogin();
		if($isLogin){
			$fileName=$this->input->post("archivo");
			if($fileName!="")
			{
				$targetPath = getcwd().'/uploads/'.md5($this->session->userdata('id_usuario')).'/';
				$targetFile = $targetPath . $fileName;
				if(file_exists($targetFile))
				{
					$flag=unlink($targetFile);	
				}
				else
				{
					$flag=true;
				}
				echo json_encode(array('resultado'=>$flag));	
			}
			else
			{
				echo "nombre de archivo no es valido";
			}
		}
		else
		{
			redirect('home','refresh'); 
		}
	}

	public function eliminarNegocio(){
		$isLogin=$this->common->isLogin();
		if($isLogin)
		{
			$negocio_id=$this->input->post("negocio_id");			
			$flag=false;
			if($negocio_id==""){
				$mensaje="Negocio no encontrado";
			}else{
				$where= array('NegocioID' =>  $negocio_id);
				$negocio=$this->NegocioModel->first($where);
				if($negocio!=null){
						if($this->NegocioModel->Delete($negocio->NegocioID)>0){
							$mensaje="Negocio eliminado correctamente";
							$flag=true;
						}else{
							$mensaje="No se pudo eliminar el negocio";
						}
				}
				else{
					$mensaje="Negocio no encontrado";
				}
			}
			echo json_encode(array('mensaje'=>$mensaje, 'resultado'=>$flag));
		}
		else
		{
			redirect('home','refresh'); 
		}
	}

	public function cambiarEstado(){
		$isLogin=$this->common->isLogin();
		if($isLogin)
		{
			$negocio_id=$this->input->post("negocio_id");
			$estado=$this->input->post("estado");
			$flag=false;
			if($negocio_id==""){
				$mensaje="Negocio no encontrado";
			}else{
				$where= array('NegocioID' =>  $negocio_id);
				$negocio=$this->NegocioModel->first($where);
				if($negocio!=null){
					if($estado==""){
						$mensaje="No se puede realizar actualizacion del Negocio";
					}else{
						$this->NegocioModel->CambiarEstado($negocio->NegocioID,$estado);
						$mensaje="Se actualizo el estado del Negocio#".$negocio->NegocioID;
					}
				}
				else{
					$mensaje="Negocio no encontrado";
				}
			}
			echo json_encode(array('mensaje'=>$mensaje, 'resultado'=>$flag));
		}
		else
		{
			redirect('home','refresh'); 
		}
	}
	
}