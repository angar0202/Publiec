<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class NegocioPublicacionModel extends MasterModel {
	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->table="NegocioPublicacion";
        $this->primaryKey="NegocioPublicacionID";
    }
}