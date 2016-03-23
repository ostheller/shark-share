<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logins extends CI_Controller {
/* this controller manages how NON-LOGGED IN users login and move into the site or register */

// index function that drops the user at the landing page which has the login form on the navbar
	public function index()
	{
		if ($this->session->userdata('logged_in') != TRUE) {
		// if they are not logged in (get the navbar WITHthe login form)
			$this->load->view('partials/header');
			$this->load->view('partials/navbar_login');
			$this->load->view('landing_page');
			$this->load->view('partials/footer');
		} else { 
		// they are logged in (get the navbar without the login form)
			$this->load->view('partials/header');
			$this->load->view('partials/navbar');
			$this->load->view('landing_page');
			$this->load->view('partials/footer');
		}
	} // end of method

// method for posting login form data and running validation checks
	public function login_validation()
	{
		$data = $this->input->post();
		$user_sess = $this->login->login_user($data); 
        // if the validation fails
        if ($user_sess === false) {
        	redirect('/');
        } else {
        	// put the data into session
        	$this->session->set_userdata($user_sess);
	        // if admin, go to admin dashboard, users to user dashboard
	        if ($this->session->userdata('admin') === TRUE) {
	        	redirect('/admin');
	        } else {
	        	redirect('/dashboard');
        	}
        }
    } // end of method

// method for arriving on the registration page
	public function registration_page()
	{
		$this->load->view('partials/header');
		$this->load->view('partials/navbar_login');
		$this->load->view('register');
		$this->load->view('partials/footer');
	} // end of method

// method for terms and conditions form submittal
	// public function accept_terms()
	// {
	// 	// if they accept the terms, continue
	// 	if ();
	// 	// else fail
	// 	redirect('/')
	// } // end of method

// method for posting registration form data and running validation checks
	public function registration_validation()
	{
		$data = $this->input->post();
		$user_sess = $this->login->rregistration_validation($data); 
		if ($user_sess === false) {
			redirect('/');
	    } // end if
	    else
	    {
	    	// set the user data
	        $this->session->set_userdata('potential_candidate', true);
	        redirect('/');
	    }
	} // end of method

// method for arriving on the initial landing page AFTER being logged OUT (dump session)
   	public function logout()
   	{
   		$this->session->sess_destroy();
   		redirect('/');
   	} // of method

} // end class
?>