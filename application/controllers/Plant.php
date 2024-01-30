<?php

class Plant extends CI_Controller {

	public function __construct(){

		parent::__construct();
		$this->load->helper('url');
		//$this->load->model('plant_model');
		$this->load->library('session');
		
		//check user is active
		if (!$this->session->userdata('logged_in'))
		{ 
			$this->session->sess_destroy();
			redirect(''.base_url().'login');
		}	
		
	}
		
	public function create_plant(){

		$this->load->view('frontend/template/header');
		$this->load->view("frontend/plant/createPlant.php");
		$this->load->view('frontend/template/footer'); 

	}
	
	public function view_plant(){

		$this->load->view('frontend/template/header');
		$this->load->view("frontend/plant/viewPlant.php");
		$this->load->view('frontend/template/footer'); 

	}
	
	

}

?>