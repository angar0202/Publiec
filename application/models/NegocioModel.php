<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class NegocioModel extends MasterModel {
	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->table="Negocio";
        $this->primaryKey="NegocioID";
    }

    public function crearNegocio($negocio){
    	$mensaje="";
        $cantidad=$this->GetCount("lower(Nombre)='$negocio->nombre'");
			if($cantidad==0){
				$this->db->trans_begin();			
			       /*Negocio*/
			       $data = array(
			       'UsuarioID'=> $this->session->userdata("id_usuario"),
				   'Nombre' => $negocio->nombre ,
				   'Descripcion' => $negocio->descripcion ,
				   'Email' => $negocio->email,
				   'Telefono' => $negocio->telefono
					);
				   $this->db->insert('negocio',$data);
				   $negocio_id = $this->db->insert_id();
				   /*Ubicaciones del Negocio*/
				   $ubicaciones=array();
				   foreach ($negocio->ubicaciones as $u) {
					   $ubicacion = array(
					   'NegocioID' => $negocio_id ,
					   'Direccion' => $u->direccion ,
					   'Descripcion' => $u->descripcion ,
					   'Latitud' => $u->latitud,
					   'Longitud' => $u->longitud
						);
					   $ubicaciones[]=$ubicacion;
				   }
				   if(count($ubicaciones)>0){
				   		$this->db->insert_batch('negocioubicacion',$ubicaciones);	
				   }

				   $categorias= array();
				   foreach ($negocio->categorias as $cat) {
				   		$categoria_id=intval(trim($cat->id));
				   		$negocio_id=intval(trim($negocio_id));
				   		$categoria=array('NegocioID' => $negocio_id,'CategoriaID' => $categoria_id);
				   		$categorias[]=$categoria;
				   }
				   
					if(count($categorias)>0){
					   		$this->db->insert_batch('negociocategoria',$categorias);					   		
					}

					$contactos=array();
				   foreach ($negocio->contactos as $co) {
				   		$contacto= array(
				   			'NegocioID' => $negocio_id,
				   			'Nombre'=> $co->nombre,
				   			'Apellido'=> $co->apellido,
				   			'Telefono'=> $co->telefono,
				   			'Email'=> $co->email,
				   			'Direccion'=> $co->direccion
				   		 );
				   		$contactos[]=$contacto;
				   }
				   
				   if(count($contactos)>0){
					   	$this->db->insert_batch('contacto',$contactos);
					}

				   //$this->db->trans_complete();
				   if ($this->db->trans_status() === FALSE)
				   {
				   		$this->db->_error_message();
				   		$this->db->_error_number();
				   		$this->db->trans_rollback();
					    $mensaje="No se pudo crear el Negocio";
				   }else{
				   		$this->db->trans_commit();
				   		$mensaje="Se creo el negocio #$negocio_id correctamente";
				   }
			}
			else
			{
				$mensaje="Este negocio ya se encuentra registrado";
			}
	   return  $mensaje;
    }

    public function create()
    {
		$usuarioID=trim($this->input->post('UsuarioID'));
		$nombre=trim($this->input->post('Nombre'));
		$descripcion=trim($this->input->post('Descripcion'));
		$email=trim($this->input->post('Email'));
		$telefono=trim($this->input->post('Telefono'));
		if($usuarioID=="")
		{
			$mensaje="No hay un enlace con el Usuario";
		}elseif($nombre=="")
		{
			$mensaje="El nombre del Negocio es requerido";
		}elseif($email=="")
		{
			$mensaje="El Email del negocio es requerido";
		}else
		{			
			$cantidad=$this->GetCount("lower(Nombre)='$nombre'");
			if($cantidad==0){
				$data = array(
					'UsuarioID' =>  $usuarioID,
					'Nombre' =>  $nombre,
					'Descripcion' =>  $descripcion,
					'Email' => $email,
					'Telefono' => $telefono
					);
				$this->create($data);
				$mensaje="Se creo al negocio correctamente";
			}
			else
			{
				$mensaje="Este negocio ya se encuentra registrado";
			}
		}
    	return $mensaje;
	}
	public function update()
	{
		$NegocioID=trim($this->input->post('NegocioID'));
		$usuarioID=trim($this->input->post('UsuarioID'));
		$nombre=trim($this->input->post('Nombre'));
		$descripcion=trim($this->input->post('Descripcion'));
		$email=trim($this->input->post('Email'));
		$telefono=trim($this->input->post('Telefono'));
		if($usuarioID=="")
		{
			$mensaje="No hay un enlace con el Usuario";
		}elseif($nombre=="")
		{
			$mensaje="El nombre del Negocio es requerido";
		}elseif($email=="")
		{
			$mensaje="El Email del negocio es requerido";
		}else{			
			$negocio=$this->GetById($NegocioID);
			if($negocio!=null){
				$negocio->UsuarioID=$usuarioID;
				$negocio->Nombre=$nombre;
				$negocio->Descripcion=$descripcion;
				$negocio->Email=$email;
				$negocio->Telefono=$telefono;
				$this->update($negocio);
			}else{
				$mensaje="Negocio no encontrado";
			}
		}		
    	return $mensaje;
	}
	public function eliminarNegocio()
	{
		$negocioID=trim($this->input->post('NegocioID'));
		$this->delete($negocioID);
	}
	public function getByUsuario($usuarioID)
	{		
		$sql="select *, (select count(u.NegocioID) from negocioubicacion u where u.NegocioID=n.NegocioID) as Ubicaciones from Negocio n where n.UsuarioID=$usuarioID";
		$query = $this->db->query($sql);
        return $query->result();
	}

	public function getCountByUsuario($usuarioID)
	{
		return $this->GetCount("UsuarioID=$usuarioID");
	}

	public function CambiarEstado($id,$estado){
		$negocio=$this->GetById($id);
			if($negocio!=null){
				$data = array(
					'Activo' =>  $estado
					);
				$this->db->update('Negocio', $data, array('NegocioID' => $id));
				$mensaje="Negocio Desactivado";
			}else{
				$mensaje="Negocio no encontrado";
			}
			return $mensaje;
	}

}