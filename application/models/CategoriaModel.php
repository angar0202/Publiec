<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class CategoriaModel extends MasterModel {
	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->table="Categoria";
        $this->primaryKey="CategoriaID";
    }
    function create(){
    	$tiponegocio=$this->input->post('TipoNegocioID');
        $descripcion=$this->input->post('Descripcion');
        $url=$this->input->post('Url');
        $nombre=$this->input->post('Nombre');
        if($tiponegocio==""){
            $mensaje="no tiene enlazado un tipo de negocio";
        }elseif($nombre==""){
            $mensaje="El campo nombre es requerido";
        }else{
            $data = array(
                'TipoNegocioID' => $TipoNegocioID, 
                'Descripcion'=> $descripcion,
                'Url'=> $url,
                'nombre'=> $nombre,);
            $this->create($data);    
        }
    }

    function update(){
        $categoriaID=$this->input->post('CategoriaID');
        $tiponegocio=$this->input->post('TipoNegocioID');
        $descripcion=$this->input->post('Descripcion');
        $url=$this->input->post('Url');
        $nombre=$this->input->post('Nombre');
        if($tiponegocio==""){
            $mensaje="no tiene enlazado un tipo de negocio";
        }elseif($nombre==""){
            $mensaje="El campo nombre es requerido";
        }else{
            $categoria=$this->getByID($categoriaID);
            $this->create($data);    
        }
    }

}