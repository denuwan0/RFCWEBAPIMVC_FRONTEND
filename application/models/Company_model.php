<?php
class Company_model extends CI_model{ 
  
	public function select_all(){
		$this->db->select('*');
		$this->db->from('company');
		return $this->db->get();
	 
	}
	
	public function select_all_active(){		
		$this->db->select('*');
		$this->db->from('company');
		$this->db->where('is_active', 1);
		return $this->db->get();	 
	}
	
	public function select_by_id($id){
		$this->db->select('*');
		$this->db->from('company');
		$this->db->where('comp_id', $id);
		return $this->db->get();
	 
	}
	
	public function insert($details){
		$this->db->insert('company', $details);
	}
 
}
 
 
