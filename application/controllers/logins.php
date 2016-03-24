<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logins extends CI_Controller {
/* this controller manages how NON-LOGGED IN users login and move into the site or register */

// index function that drops the user at the landing page which has the login form on the navbar
	public function index()
	{
		if ($this->session->userdata('logged_in') != TRUE) {
		// if they are not logged in (get the navbar WITHthe login form)
			$header['title'] = 'Shark Share';

			$this->load->view('partials/header', $header);
			$this->load->view('partials/navbar_login');
			$this->load->view('landing_page');
			$this->load->view('partials/footer');
		} else { 
		// they are logged in (get the navbar without the login form)
			$this->load->view('partials/header', $header);
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
		$header['title'] = 'Register';

		$this->load->view('partials/header', $header);
		$this->load->view('partials/navbar_login');
		$this->load->view('registration/1');
		$this->load->view('partials/footer');
	} // end of method

// method for posting registration form data and running validation checks
	public function registration_validation()
	{
		$this->load->model('login');
		$data = $this->input->post();
		$user_sess = $this->login->registration_validation($data); 
		// if there are validation errors
		if ($user_sess === false) {
			$header['title'] = 'Registration Errors';

			$this->load->view('partials/header', $header);
			$this->load->view('partials/navbar_login');
			$this->load->view('registration/1');
			$this->load->view('partials/footer');
	    } // if there are no errors
	    else
	    {
	    	// put the data in session for now, put in database after accept t&c
	    	$this->session->set_userdata('potential_data', $data);
	    	redirect('/terms');	        
	    }
	} // end of method

// method for viewing the terms&conditions page after passing registration checks
	public function view_terms()
	{
		$header['title'] = 'Terms and Conditions';

		$this->load->view('partials/header', $header);
		$this->load->view('partials/navbar_login');
		$this->load->view('registration/2');
		$this->load->view('partials/footer');
	} // end of method

// method for processing the form data 
	public function terms_confirmation()
	{
		$this->load->model('login');
		$data = $this->input->post();
		// $user_sess = $this->login->terms_validation($data); 
		// 	var_dump($user_sess);
	 //        die();
		if ($data['responsibility'] === 'accept' && $data['acknowledgment'] === 'accept' && $data['shipping'] === 'accept') {
			// put the data in the database
	        $person = $this->session->userdata('potential_data');
	        $this->login->on_probation($person);
	        // flag this user as having completed registration, IS NOT not logged in
	       	$this->session->set_userdata('potential_candidate', true);
	        // go to the third registration page
	        $header['title'] = 'Registration Complete';
			$this->load->view('partials/header', $header);
			$this->load->view('partials/navbar_login');
			$this->load->view('registration/3');
			$this->load->view('partials/footer');
	    } // end if
	    else
	    {
	    	$header['title'] = 'Terms and Conditions';

			$this->load->view('partials/header', $header);
			$this->load->view('partials/navbar_login');
			$this->load->view('registration/2');
			$this->load->view('partials/footer');
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