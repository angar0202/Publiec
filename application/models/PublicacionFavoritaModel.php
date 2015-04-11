<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class PublicacionFavoritaModel extends MasterModel {
	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->table="PublicacionFavorita";
        $this->primaryKey="PublicacionFavoritaID";
    }
}