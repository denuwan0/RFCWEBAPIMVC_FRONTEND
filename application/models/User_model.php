<?php
class User_model extends CI_model{ 
 
	public function register_user($user){
	 
		$this->db->insert('user', $user);
	 
	}
 
	public function login_user($emp_epf, $emp_password){
		//$email,$pass
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('emp_epf',$emp_epf);
		$this->db->where('emp_password',$emp_password);
	 
		if($query=$this->db->get())
		{
			return $query->result_array();
		}
		else{
			return false;
		}
	 
	}
	
	public function login_user_permission($emp_sub_group){
		//$email,$pass
		$this->db->select('user.emp_user_grp, user.emp_user_sub_grp,user_permission.user_path');
		$this->db->from('user');
		$this->db->join('user_permission', 'user.emp_user_sub_grp = user_permission.user_sub_grp_id');
		$this->db->where('user_permission.user_sub_grp_id',$emp_sub_group);
		$this->db->where('user_permission.is_active',1);
	 
		if($query=$this->db->get())
		{
			return $query->result_array();
		}
		else{
			return false;
		}
	 
	}

	public function email_check($epf){
	 
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('emp_epf',$epf);
		$query=$this->db->get();
	 
		if($query->num_rows()>0){
			return false;
		}else{
			return true;
		}
	 
	}
 
}
 
 
