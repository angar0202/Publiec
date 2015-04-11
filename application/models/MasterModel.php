<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MasterModel extends CI_Model {
	var $table="";
	var $primaryKey="";
	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function GetById($id){
        $result = $this->db->query("SELECT * FROM $this->table WHERE $this->primaryKey=$id");
        return $result->row();
    }

    function GetAll(){
        $result = $this->db->query("SELECT * FROM $this->table");$result = $this->db->query("SELECT * FROM $this->table");
        return $result->row();
    }

    function First($where){        
        return $this->db->select('*')->from($this->table)->where($where)->order_by($this->primaryKey,'ASC')->get()->row();
    }

    function GetWhere($where){
    	$sql="SELECT * FROM $this->table WHERE 1=1";
        if($where==""){
        	$sql.=" AND $where";
        }
        $result = $this->db->query($sql);
        return $result->row();
    }

    function GetCount($where=""){
        $sql="SELECT count($this->primaryKey) as cantidad FROM $this->table WHERE 1=1";
        if($where==""){
            $sql.=" AND $where";
        }
        $result = $this->db->query($sql);
        return $result->cantidad;
    }

    function Create($data){
        $this->db->insert($this->table, $data);
    }

    function Update($data){
        $vars = get_object_vars($data);
        $id=$vars[$this->primaryKey];
        unset($vars[$this->primaryKey]);
        $this->db->update($this->table, $vars, array($this->primaryKey => $id));
    }

    function Delete($id){
    	$this->db->delete($this->table, array($this->primaryKey => $id));         
    }
}