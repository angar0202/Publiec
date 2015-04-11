<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class NegocioImagenModel extends MasterModel {
	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->table="NegocioImagen";
        $this->primaryKey="NegocioImagenID";
    }
}