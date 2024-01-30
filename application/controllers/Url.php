<?php

class Url extends CI_Controller {

	public function __construct(){

		parent::__construct();
		$this->load->helper('url');
		//$this->load->model('Company_model');
		$this->load->library('session');
		
		//check user is active
		if (!$this->session->userdata('logged_in'))
		{ 
			$this->session->sess_destroy();
			redirect(''.base_url().'login');
		}	
		
	}
		
	public function create_url(){

		$this->load->view('frontend/template/header');
		$this->load->view("frontend/url/createUrl.php");
		$this->load->view('frontend/template/footer'); 

	}
	
	function view_url(){
		
		$this->load->view('frontend/template/header');
		$this->load->view('frontend/url/viewUrl.php');
		$this->load->view('frontend/template/footer'); 
		
	}
	
	
	
	

}

?>