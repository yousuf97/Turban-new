<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends Admin_Controller 
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_auth');
		$this->load->model('model_orders');
	}

	/* 
		Check if the login form is submitted, and validates the user credential
		If not submitted it redirects to the login page
	*/
	public function index()
	{
		$this->load->view('login');
	}
	public function login()
	{

		$this->logged_in();

		$this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == TRUE) {
            // true case
           	$email_exists = $this->model_auth->check_email($this->input->post('email'));

           	if($email_exists == TRUE) {
           		$login = $this->model_auth->login($this->input->post('email'), $this->input->post('password'));
//print_r($login);
           		if($login) {

           			$logged_in_sess = array(
           				'id' => $login['id'],
				        'username'  => $login['username'],
				        'email'     => $login['email'],
                    'group'=>$login['group_id'],
				        'logged_in' => TRUE
					);
				#echo $login['group_id'];
               if($login['group_id']==6)
               {
					$this->session->set_userdata($logged_in_sess);
           			redirect('user_interface', 'refresh');
               }
               else
               {
				   
				  $this->session->set_userdata($logged_in_sess);
				  
					   // redirect('dashboard', 'refresh');
					   $this->render_template('dashboard',$this->data);
               }
					
           		}
           		else {
           			$this->data['errors'] = 'Incorrect username/password combination';
           			$this->load->view('login', $this->data);
           		}
           	}
           	else {
           		$this->data['errors'] = '<p id="error">Email does not exists</p>';

           		$this->load->view('login', $this->data);
           	}	
        }
        else {
            // false case
            $this->load->view('login');
        }	
	}

	/*
		clears the session and redirects to login page
	*/
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('auth/login', 'refresh');
	}

}
