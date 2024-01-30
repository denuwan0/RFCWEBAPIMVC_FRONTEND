<?php

class Company extends CI_Controller {

	public function __construct(){

		parent::__construct();
		$this->load->helper('url');
		$this->load->model('Company_model');
		$this->load->library('session');
		
		//check user is active
		if (!$this->session->userdata('logged_in'))
		{ 
			$this->session->sess_destroy();
			redirect(''.base_url().'login');
		}	
		
	}
		
	public function create_company(){

		$this->load->view('frontend/template/header');
		$this->load->view("frontend/company/createCompany.php");
		$this->load->view('frontend/template/footer'); 

	}
	
	public function edit_company(){

		$this->load->view('frontend/template/header');
		$this->load->view("frontend/company/editCompany.php");
		$this->load->view('frontend/template/footer'); 

	}
	
	public function view_company(){

		$this->load->view('frontend/template/header');
		$this->load->view("frontend/company/viewCompany.php");
		$this->load->view('frontend/template/footer'); 

	}	
	
	public function company_ajax() {
        $this->load->view('frontend/company/company_ajax.php');
    }
	
	

}

?>