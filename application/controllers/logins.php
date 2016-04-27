<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logins extends CI_Controller {
/* this controller manages how NON-LOGGED IN users login and move into the site or register */

// index function that drops the user at the landing page which has the login form on the navbar
	public function index()
	{
		$header['title'] = 'Shark Share';
		if ($this->session->userdata('logged_in') != TRUE) {
		// if they are not logged in (get the navbar WITHthe login form)
			if ($this->session->userdata('login_attempt_failed') === true) {
				$header['errors'] = 'Incorrect email/password';
			} else {
				$header['errors'] = NULL;
			}
			$this->load->view('partials/header', $header);
			$this->load->view('styles/landing_page');
			$this->load->view('partials/navbar_login');
			$this->load->view('landing_page');
			$this->load->view('partials/footer');
		} else { 
		// they are logged in (get the navbar without the login form)
			$this->load->view('partials/header', $header);
			$this->load->view('styles/landing_page');
			$this->load->view('partials/navbar');
			$this->load->view('landing_page');
			$this->load->view('partials/footer');
		}
	} // end of method

// method for posting login form data and running validation checks
	public function login_validation()
	{
		$this->load->model('login');
		$data = $this->input->post();
		$user_sess = $this->login->login_user($data);
        // if the validation fails
        if ($user_sess === false) {
        	$this->session->set_userdata('login_attempt_failed', true);
        	reload();
        } else {
        	// check admin status
        	if ($user_sess['level'] == 1) {
				$user_sess['admin'] = TRUE;
				$user_sess['logged_in'] = TRUE;
				$this->session->set_userdata($user_sess);
				redirect('/admin');
			} else { // user
				$user_sess['admin'] = FALSE;
				$user_sess['logged_in'] = TRUE;
				$this->session->set_userdata($user_sess);
	        	redirect('/dashboard');
        	}
        }
    } // end of method

// method for arriving on the registration page
	public function registration_page()
	{
		$this->load->model('login');
		$countries = $this->login->countries();
		$header['title'] = 'Register';

		$this->load->view('partials/header', $header);
		$this->load->view('styles/registration');
		$this->load->view('partials/navbar_login');
		$this->load->view('registration/1', array('countries' => $countries));
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
			$countries = $this->login->countries();
			$this->load->view('partials/header', $header);
			$this->load->view('styles/registration');
			$this->load->view('partials/navbar_login');
			$this->load->view('registration/1', array('countries' => $countries));
			$this->load->view('partials/footer');
	    } // if there are no errors
	    else
	    {
	    	// put the data in session for now, put in database after accept t&c
	    	$this->session->set_userdata('potential_data', $data);
	    	$this->session->set_userdata('proceed', TRUE);
	    	redirect('/register/terms');	        
	    }
	} // end of method

// method for viewing the terms&conditions page after passing registration checks
	public function view_terms()
	{
		if ($this->session->userdata('proceed') === TRUE) {
			$header['title'] = 'Terms and Conditions';

			$this->load->view('partials/header', $header);
			$this->load->view('styles/registration');
			$this->load->view('partials/navbar_login');
			$this->load->view('registration/2');
			$this->load->view('partials/footer');
		} else {
			redirect('/restricted');
		}
	} // end of method

// method for processing the form data 
	public function terms_confirmation()
	{
		$this->load->model('login');
		$data = $this->input->post();
		if ($data['responsibility'] === 'accept' && $data['acknowledgment'] === 'accept' && $data['shipping'] === 'accept') {
			// put the data in the database
	        $person = $this->session->userdata('potential_data');
	        $this->login->on_probation($person);
	        // flag this user as having completed registration, IS NOT not logged in
	       	$this->session->set_userdata('potential_candidate', true);
	        // go to the third registration page
	        redirect('register/complete');
	    } // end if
	    else // reload the terms page w/errors
	    {
	    	$header['title'] = 'Terms and Conditions';

			$this->load->view('partials/header', $header);
			$this->load->view('styles/registration');
			$this->load->view('partials/navbar_login');
			$this->load->view('registration/2');
			$this->load->view('partials/footer');
	    }
	} // end of method

// method for visiting the  
	public function visit_welcome_page()
	{			
		if ($this->session->userdata('potential_candidate') === true) {
			$header['title'] = 'Registration Complete';
			$this->load->view('partials/header', $header);
			$this->load->view('styles/registration');
			$this->load->view('partials/navbar_login');
			$this->load->view('registration/3');
			$this->load->view('partials/footer');
		} else {
			redirect('/restricted');
		}
	}


// method for arriving on the initial landing page AFTER being logged OUT (dump session)
   	public function logout()
   	{
   		$this->session->sess_destroy();
   		redirect('/');
   	} // of method

// temporary method to view the second registration page in order to make edits to it
public function view_registration_two()
	{
		$header['title'] = 'Terms and Conditions';
			$this->load->view('partials/header', $header);
			$this->load->view('styles/registration');
			$this->load->view('partials/navbar_login');
			$this->load->view('registration/2');
			$this->load->view('partials/footer');
	} // end of method

// temporary method to view the second registration page in order to make edits to it
public function view_registration_three()
	{
		$header['title'] = 'Registration Complete';
			$this->load->view('partials/header', $header);
			$this->load->view('styles/registration');
			$this->load->view('partials/navbar_login');
			$this->load->view('registration/3');
			$this->load->view('partials/footer');
	} // end of method

} // end class
?>