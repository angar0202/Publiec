<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Registro extends CI_Controller {	

	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->model('UsuarioModel','Usuario');   
    }

	public function create()
	{
		$isLogin=false;
		if(!$isLogin){
			$mensaje=$this->Usuario->createUsuario();
			$flag=false;
			if (strpos($mensaje,'correctamente') !== false) {
			    $flag=true;
			}
			$mensaje=json_encode(array('mensaje' => $mensaje,'resultado'=>$flag));
    		echo $mensaje;
		}
	}
}