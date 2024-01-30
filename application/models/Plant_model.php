<?php
class Company_model extends CI_model{ 
  
	public function select_all(){
		$this->db->select('company.comp_id, company.comp_name, company.comp_code, company.is_active');
		$this->db->from('company');
	 
		if($query=$this->db->get())
		{
			return $query->result_array();
		}
		else{
			return false;
		}
	 
	}
	
	public function select_all_active(){
		$this->db->select('company.comp_id, company.comp_name, company.comp_code, company.is_active');
		$this->db->from('company');
		$this->db->where('user_permission.is_active',1);
	 
		if($query=$this->db->get())
		{
			return $query->result_array();
		}
		else{
			return false;
		}
	 
	}
	
	/* public function insert($emp_sub_group){
		$data = array(
				'comp_id' => 'My title',
				'comp_name' => 'My Name',
				'comp_code' => 'My date',
				'is_active' => 1
		);

		$this->db->insert('mytable', $data);
	} */
 
}
 
 
