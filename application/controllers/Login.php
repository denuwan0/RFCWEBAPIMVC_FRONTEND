<?php

class Login extends CI_Controller {

	public function __construct(){

		parent::__construct();
		$this->load->helper('url');
		$this->load->model('user_model');
		$this->load->library('session');			
	}

	public function index()
	{		
		
		if ($this->session->userdata('logged_in') == 1)
		{ 
			redirect(base_url().'dashboard');
		}
		else{
			$this->load->view('frontend/login/login.php');
		}
		
	}
	
	

	public function register(){

		//$this->load->view('frontend/template/header');
		$this->load->view("frontend/login/register.php");
		//$this->load->view('frontend/template/footer'); 

	}

	public function forgot(){

		//$this->load->view('frontend/template/header');
		$this->load->view("frontend/login/forgot.php");
		//$this->load->view('frontend/template/footer'); 

	}


	public function logout(){

		$this->session->unset_userdata('logged_in');
		$this->session->sess_destroy();
		ob_clean();	
		
		redirect(''.base_url().'login');
	}
	
	public function login_ajax() {
		//$this->session->set_userdata(array('error_msg' => 'Error occured, Please try again.'));
        $this->load->view('frontend/login/login_ajax.php');
    }
	

}

?>