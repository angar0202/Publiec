<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class NegocioPuntuacionModel extends MasterModel {
	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->table="NegocioPuntuacion";
        $this->primaryKey="NegocioPuntuacionID";
    }
}