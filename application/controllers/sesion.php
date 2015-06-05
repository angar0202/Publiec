<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class sesion extends CI_Controller {	

	function __construct()
    {
        // Call the Model constructor
        parent::__construct();        
    }

    public function isLogin(){
    	$isLogin=$this->common->isLogin();
		if($isLogin)
		{
			echo 1;
		}else{
            echo 0;    
        }
    }

    public function logout(){
		$this->common->logout();
		redirect('home','refresh'); 
    }
}