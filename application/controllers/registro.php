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
			//echo json_encode(array('mensaje' => $mensaje));
    		echo $mensaje;
		}
	}
}