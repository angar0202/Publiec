<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class UsuarioModel extends MasterModel {
	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->table="Usuario";
        $this->primaryKey="UsuarioID";
    }
    
    public function create()
	{
		$nombreUsuario=$this->input->post('usuario');
		if(trim($nombreUsuario)==""){
			$mensaje="Campo de Usuario vacio";
		}elseif(trim($this->input->post('password'))==""){
			$mensaje="Campo Password vacio";
		}elseif(trim($this->input->post('email'))==""){
			$mensaje="Campo Email vacio";
		}elseif(trim($this->input->post('nombre'))==""){
			$mensaje="Campo Nombre Completo vacio";
		}else{
			$encontrado=$this->getCount("LOWER(NombreUsuario)=LOWER('$nombreUsuario')");
			if($encontrado==0){
				$data = array(
					'NombreUsuario' =>  $this->input->post('usuario'),
					'Password' =>  $this->input->post('password'),
					'Email' => $this->input->post('email'),
					'NombreCompleto' => $this->input->post('nombre')
					);
				$this->create($data);
				$mensaje="Se creo al usuario correctamente";		
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
		$nombreUsuario=$this->input->post('usuario');
		$password=trim($this->input->post('password'));
		$where= array('NombreUsuario' =>  strtolower($nombreUsuario) ,'Password'=> md5($password));		
		return $this->first($where);
	}

}