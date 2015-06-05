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
        $query = $this->db->query("SELECT * FROM $this->table");
        return $query->result();
    }

    function First($where){        
        return $this->db->select('*')->from($this->table)->where($where)->order_by($this->primaryKey,'ASC')->get()->row();
    }

    function GetWhere($where){
    	$sql="SELECT * FROM $this->table WHERE 1=1";
        if($where !=""){
        	$sql.=" AND $where";
        }
        return $this->db->query($sql);
    }

    function GetCount($where=""){
        $sql="SELECT count($this->primaryKey) as cantidad FROM $this->table WHERE 1=1";
        if($where != ""){
            $sql.=" AND $where";
        }
        $query = $this->db->query($sql);
        foreach ($query->result() as $row)
        {
            return $row->cantidad;
        }
        return 0;
    }

    function Create($data){
        $this->db->insert($this->table, $data);
    }

    function Update($data){
        $vars = get_object_vars($data);
        print_r($vars);
        $id=$vars[$this->primaryKey];
        unset($vars[$this->primaryKey]);
        $this->db->update($this->table, $vars, array($this->primaryKey => $id));
        return $this->db->affected_rows();
    }

    function Delete($id){
    	$this->db->delete($this->table, array($this->primaryKey => $id));
        return $this->db->affected_rows();      
    }
}