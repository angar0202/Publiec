<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class NegocioFavoritoModel extends MasterModel {
	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->table="NegocioFavorito";
        $this->primaryKey="NegocioFavoritoID";
    }
}