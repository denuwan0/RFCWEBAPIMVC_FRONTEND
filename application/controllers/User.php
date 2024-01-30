<?php

class User extends CI_Controller {

	public function __construct(){

		parent::__construct();
		$this->load->helper('url');
		$this->load->model('login_model');
		$this->load->library('session');
		
		//check user is active
		if (!$this->session->userdata('logged_in'))
		{ 
			$this->session->sess_destroy();
			redirect(''.base_url().'login');
		}	
		
	}
		
	public function create_user(){

		$this->load->view('frontend/template/header');
		$this->load->view("frontend/user/createUser.php");
		$this->load->view('frontend/template/footer'); 

	}
	
	function view_user(){
		
		$this->load->view('frontend/template/header');
		$this->load->view('frontend/user/viewUser.php');
		$this->load->view('frontend/template/footer'); 
		
	}
	
	public function view_user_group(){

		$this->load->view('frontend/template/header');
		$this->load->view("frontend/user/viewUserGroup.php");
		$this->load->view('frontend/template/footer'); 

	}
	
	public function create_user_group(){

		$this->load->view('frontend/template/header');
		$this->load->view("frontend/user/createUserGroup.php");
		$this->load->view('frontend/template/footer'); 

	}
	
	public function view_user_sub_group(){

		$this->load->view('frontend/template/header');
		$this->load->view("frontend/user/viewUserSubGroup.php");
		$this->load->view('frontend/template/footer'); 

	}
	
	public function create_user_sub_group(){

		$this->load->view('frontend/template/header');
		$this->load->view("frontend/user/createUserSubGroup.php");
		$this->load->view('frontend/template/footer'); 

	}
	
	public function view_user_permission(){

		$this->load->view('frontend/template/header');
		$this->load->view("frontend/user/viewUserPermission.php");
		$this->load->view('frontend/template/footer'); 

	}
	
	public function update_user_permission(){

		$this->load->view('frontend/template/header');
		$this->load->view("frontend/user/updateUserPermission.php");
		$this->load->view('frontend/template/footer'); 

	}
		
	public function user_bulk_upload(){

		$this->load->view('frontend/template/header');
		$this->load->view("frontend/user/userBulkUpload.php");
		$this->load->view('frontend/template/footer'); 

	}
	
	function user_profile(){
		
		$this->load->view('frontend/template/header');
		$this->load->view('frontend/user/userProfile.php');
		$this->load->view('frontend/template/footer'); 
		
	}
	
	function access_denied(){
		
		$this->load->view('frontend/template/header');
		$this->load->view('frontend/template/accessDenied.php');
		$this->load->view('frontend/template/footer'); 
		
	}
	
	

}

?>