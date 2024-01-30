<?php

class Location extends CI_Controller {

	public function __construct(){

		parent::__construct();
		$this->load->helper('url');
		//$this->load->model('Location_model');
		$this->load->library('session');
		
		//check user is active
		if (!$this->session->userdata('logged_in'))
		{ 
			$this->session->sess_destroy();
			redirect(''.base_url().'login');
		}	
		
	}
		
	public function create_location(){

		$this->load->view('frontend/template/header');
		$this->load->view("frontend/location/createLocation.php");
		$this->load->view('frontend/template/footer'); 

	}
	
	public function view_location(){

		$this->load->view('frontend/template/header');
		$this->load->view("frontend/location/viewLocation.php");
		$this->load->view('frontend/template/footer'); 

	}
	
	

}

?>