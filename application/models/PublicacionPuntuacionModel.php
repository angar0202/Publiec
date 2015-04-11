<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class PublicacionPuntuacionModel extends MasterModel {
	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->table="PublicacionPuntuacion";
        $this->primaryKey="PublicacionPuntuacionID";
    }
}