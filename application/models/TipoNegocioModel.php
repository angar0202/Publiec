<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class TipoNegocioModel extends MasterModel {
	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->table="TipoNegocio";
        $this->primaryKey="TipoNegocioID";
    }

    public function TiposNegociosCategorias(){
    	$sql="select distinct t.* from TipoNegocio t
		inner join categoria c on t.TipoNegocioID = c.TipoNegocioID";
		$query = $this->db->query($sql);
        return $query->result();
    }
}