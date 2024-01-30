<?php

class Hr extends CI_Controller {

	public function __construct(){

		parent::__construct();
		$this->load->helper('url');
		$this->load->model('user_model');
		$this->load->library('session');
			
		if (!$this->session->userdata('logged_in'))
		{ 
			$this->session->sess_destroy();
			redirect(''.base_url().'login');
		}
	}
/* 
	public function index()
	{		
		$this->load->view('frontend/template/header');
		$this->load->view("frontend/user/login.php");
		$this->load->view('frontend/template/footer');
	}
 */
	public function ZZH_ACT_EMP_LIST(){

		$this->load->view('frontend/template/header');
		$this->load->view("frontend/hr/ZZH_ACT_EMP_LIST.php");
		$this->load->view('frontend/template/footer'); 

	}
	
	public function T_CODE(){

		$this->load->view('frontend/template/header');
		$this->load->view("frontend/hr/T_CODE.php");
		$this->load->view('frontend/template/footer'); 

	}

}

?>