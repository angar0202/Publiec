<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class UsuarioModel extends MasterModel {
	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->table="Usuario";
        $this->primaryKey="UsuarioID";        
    }
    
    public function createUsuario()
	{
		$mensaje="Ocurrio un problema al registrar el usuario.";
		$nombreUsuario=trim(strtolower($this->input->post('usuario')));
		$email=trim($this->input->post('email'));
		if(trim($nombreUsuario)==""){
			$mensaje="Campo de Usuario esta vacio";
		}elseif(trim($this->input->post('password'))==""){
			$mensaje="Campo de contraseña esta vacio";
		}elseif($email==""){
			$mensaje="Campo de email esta vacio";
		}elseif(trim($this->input->post('nombre'))==""){
			$mensaje="Campo del Nombre Completo esta vacio";
		}else{
			$encontrado=$this->getCount("LOWER(NombreUsuario)=LOWER('$nombreUsuario')");
			if($encontrado==0){
				$encontrado=$this->getCount("LOWER(Email)=LOWER('$email')");
				if($encontrado==0){
					$data = array(
						'NombreUsuario' =>  $nombreUsuario,//$this->input->post('usuario'),
						'Password' =>  md5($this->input->post('password')),
						'Email' => $this->input->post('email'),
						'NombreCompleto' => $this->input->post('nombre')
						);
					$this->create($data);
					$mensaje="Se creo al usuario correctamente";
					$where = array('NombreUsuario' => $nombreUsuario);
					$usuario=$this->first($where);
					$codigo=$this->common->GenerarCodigo();
					$this->ValidacionModel->CrearActivacion($usuario->UsuarioID,$codigo);			
					$data["TITULO"]="ACTIVACION DE CUENTA";
					$param["codigo"]=$codigo;
					$data["CONTENIDO"]=$this->load->view("email/ActivarCuenta",$param,true);
					$html=$this->load->view("email/Plantilla",$data,true);
					$resultado=$this->common->EnviarCorreo($usuario->Email,"Registro de cuenta de usuario",$html);
				}
				else{
				$mensaje="El correo ingresado ya se encuentra registrado";
				}
			}else{
				$mensaje="El usuario ya existe, escriba otro nommbre de usuario";
			}
		}		
    	return $mensaje;
	}

	public function updatePerfil()
	{
		$nombreUsuario=trim($this->input->post('usuarioActualizado',true));
		$password=trim($this->input->post('passwordActualizado',true));
		$nombre=trim($this->input->post('nombre',true));
		$email=trim($this->input->post('email',true));
		if($nombreUsuario==""){
			$mensaje="Campo de Usuario vacio";		
		}elseif($email==""){
			$mensaje="Campo Email vacio";
		}elseif($nombre==""){
			$mensaje="Campo Nombre Completo vacio";
		}else{
			$usuario=$this->login();
			if($usuario!=null){
				$usuario->NombreUsuario=$nombreUsuario;				
				$usuario->NombreCompleto=$nombre;
				$usuario->Email=$email;
				$usuario->Password=$password;
				$this->update($usuario);
				$mensaje="Se actualizo el usuario correctamente";		
			}else{
				$mensaje="No a iniciado sesion, o los parametros enviados no son correctos";
			}
		}
    	return $mensaje;
	}

	public function login(){
		$nombreUsuario=$this->input->post('usuarioLogin');
		$password=trim($this->input->post('passwordLogin'));
		$where= array('NombreUsuario' =>  strtolower($nombreUsuario) ,'Password'=> md5($password), 'Activo'=> 1);
		return $this->first($where);
	}

	function updatePassword($password,$id_usuario='')
    {
        $data = array(
            'Password' => md5($password),            
        );
        if($id_usuario==""){
            $CI =& get_instance();
            $id_usuario = $CI->session->userdata('id_usuario');
        }
        $this->db->update($this->table, $data, array('UsuarioID' => $id_usuario));
    }

    function updateActivo($activo,$id_usuario)
    {
        $data = array(
            'Activo' => $activo,            
        );
        $this->db->update($this->table, $data, array('UsuarioID' => $id_usuario));
    }
}