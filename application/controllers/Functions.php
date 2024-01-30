<?php

class Functions extends CI_Controller {

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
		
	public function create_functions(){

		$this->load->view('frontend/template/header');
		$this->load->view("frontend/function/createFunction.php");
		$this->load->view('frontend/template/footer'); 

	}
		
	public function view_functions(){

		$this->load->view('frontend/template/header');
		$this->load->view("frontend/function/viewFunction.php");
		$this->load->view('frontend/template/footer'); 

	}	
	
	public function company_ajax() {
        $this->load->view('frontend/company/company_ajax.php');
    }
	
	

}

?>