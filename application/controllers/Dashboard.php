<?php

class Dashboard extends CI_Controller {

	public function __construct(){

		parent::__construct();
		$this->load->helper('url');
		$this->load->model('user_model');
		$this->load->library('session');
		
		//check user is active
		if ($this->session->userdata('logged_in') != 1)
		{ 
			redirect(''.base_url().'login');
		}	

	}

	public function index()
	{		
		$this->load->view('frontend/template/header');
		$this->load->view("frontend/dashboard/dashboard.php");
		$this->load->view('frontend/template/footer'); 
	}

	public function register(){

		$this->load->view('frontend/template/header');
		$this->load->view("frontend/user/register.php");
		$this->load->view('frontend/template/footer'); 

	}

	public function forgot(){

		$this->load->view('frontend/template/header');
		$this->load->view("frontend/user/forgot.php");
		$this->load->view('frontend/template/footer'); 

	}

	public function dashboard(){

		$this->load->view('frontend/template/header');
		$this->load->view("frontend/dashboard/dashboard.php");
		$this->load->view('frontend/template/footer'); 

	}

	function login_user(){ 
		
	  /* $user_login=array(

	  'emp_epf'=>$this->input->post('emp_epf'),
	  'emp_password'=>md5($this->input->post('emp_password'))

		); */ 
		
		$user_login=array(

			'emp_epf'=>$this->input->post('emp_epf'),
			'emp_password'=>$this->input->post('emp_password')

		);
		
		//check mysql login credentials and redirect accordingly
		$data=$this->user_model->login_user($user_login['emp_epf'], $user_login['emp_password']);
			
		  if($data)
		  {		
			
			$this->session->set_userdata(array(
				'emp_id' => $data[0]['emp_id'],
				'emp_epf'   => $data[0]['emp_epf'],
				'emp_name'    => $data[0]['emp_name'],
				'emp_function' => $data[0]['emp_function'],
				'emp_email'   => $data[0]['emp_email'],
				'emp_mobile'    => $data[0]['emp_mobile'],
				'is_active'    => $data[0]['is_active'],
				'logged_in'    => '1'
			));
			
			redirect(''.base_url().'user/dashboard');
			
		  }
		  if(!$data){
					
			$this->session->set_userdata(array(
			'error_msg' => 'Error occured, Please try again.'));		
			
			redirect(''.base_url().'user');

		  }

	}

	function user_profile(){

		$this->load->view('frontend/user/user_profile.php');

	}

	public function logout(){
		
		if ($this->session->userdata('logged_in'))
		{ 
			$this->session->sess_destroy();
			ob_clean();	
			redirect(''.base_url().'user');
		}

		
	}

}

?>