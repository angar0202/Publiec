<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class ValidacionModel extends CI_Model {
    var $id_validacion;
    var $id_usuario;
    var $fecha_creacion;
    var $codigo_secreto;
    var $tipo;
    var $fecha_modificacion;
    var $estado;
    var $valores;
    var $_table="validacion";

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();        
        $this->load->model('UsuarioModel','Usuario');   
    }
    
    function GetById($id){
        $obj= new ValidacionModel();
        $result = $this->db->query("SELECT * FROM $this->_table WHERE ValidacionID='$id'");
        $r=$result->row();
        
        $obj->id_validacion=$r->ValidacionID;
        $obj->id_usuario=$r->UsuarioID;
        $obj->fecha_creacion=$r->FechaCreacion;
        $obj->fecha_modificacion=$r->FechaModificacion;
        $obj->codigo_secreto=$r->CodigoSecreto;
        $obj->tipo=$r->Tipo;
        $obj->estado=$r->Estado;
        $obj->valores=$r->Valores;
        
        return $obj;
    }

    function GetByCodigo($codigo){
        $obj= new ValidacionModel();
        $result = $this->db->query("SELECT * FROM $this->_table WHERE CodigoSecreto='$codigo'");
        foreach ($result->result() as $r)
        {
        $obj->id_validacion=$r->ValidacionID;
        $obj->id_usuario=$r->UsuarioID;
        $obj->fecha_creacion=$r->FechaCreacion;
        $obj->fecha_modificacion=$r->FechaModificacion;
        $obj->codigo_secreto=$r->CodigoSecreto;
        $obj->tipo=$r->Tipo;
        $obj->estado=$r->Estado;
        $obj->valores=$r->Valores;
        return $obj;
        }
        return null;
    }

    function CrearActivacion($id_usuario,$codigo,$tipo='ACTIVACION_CUENTA'){
        $data = array(
            'UsuarioID' => $id_usuario ,            
            'FechaModificacion' => date('Y-m-d H:i:s'),
            'CodigoSecreto' => $codigo,
            'Tipo' => $tipo,          
        );
        $this->db->insert($this->_table, $data);
    }

    function CrearRecordarPassword($id_usuario,$codigo,$tipo='RECORDAR_PASSWORD'){
        $data = array(
            'UsuarioID' => $id_usuario ,            
            'FechaModificacion' => date('Y-m-d H:i:s'),
            'CodigoSecreto' => $codigo,
            'Tipo' => $tipo,            
        );
        $this->db->insert($this->_table, $data);
    }

    function ActualizarRecordarPassword($codigo,$tipo='RECORDAR_PASSWORD')
    {
       $validacion= $this->GetByCodigo($codigo);
       if($validacion!==null){
            if($validacion->estado==1){
                $data = array(
                    'FechaModificacion' =>  date('Y-m-d H:i:s'),
                    'Estado' => 0,
                );
                $this->db->update($this->_table, $data, array('ValidacionID' => $validacion->id_validacion));
                $u=$this->Usuario->GetById($validacion->id_usuario);
                return $u;
           }
       }
     return "-1";
    }

    function ActualizarActivacion($codigo,$tipo='ACTIVACION_CUENTA')
    {
       $validacion= $this->GetByCodigo($codigo);
       if($validacion->estado==1){
            $data = array(
                'FechaModificacion' =>  date('Y-m-d H:i:s'),
                'Estado' => 0,
            );
            $this->db->update($this->_table, $data, array('ValidacionID' => $validacion->id_validacion));
            $u=$this->Usuario->GetById($validacion->id_usuario);
            return $u;
       }
       return "-1";
    }


}