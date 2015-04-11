<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class TipoNegocioModel extends MasterModel {
	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->table="TipoNegocio";
        $this->primaryKey="TipoNegocioID";
    }
}