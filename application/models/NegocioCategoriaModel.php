<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class NegocioCategoriaModel extends MasterModel {
	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->table="NegocioCategoria";
        $this->primaryKey="NegocioCategoriaID";
    }
}