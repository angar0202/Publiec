<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class PublicacionImagenModel extends MasterModel {
	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->table="PublicacionImagen";
        $this->primaryKey="PublicacionImagenID";
    }
}