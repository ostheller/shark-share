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
        	redirect('/');
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

// method for downloading the full terms and conditions
	public function download_terms() {
		$this->load->helper('download');
		$data = file_get_contents("assets/downloads/terms.txt"); // Read the file's contents
		$name = 'sharkShareTerms.txt';

		force_download($name, $data);
	}

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
	// 		$data = array(
	// 		'sample_ids' => explode(",", $post['sample_ids']), 
	// 		'body' => $post['body'],
	// 		'from_email' => $post['from_email'],
	// 		'from_name' => $post['from_name'],
	// 		'cc' => $post['cc'],
	// 		'to_email' => $post['to_email'],
	// 		'subject' => $post['subject']
	// 		);

	// 	$this->load->library('email');
	// 	$this->email->from($data['from_email'], $data['from_name']);
	// 	$this->email->to($data['to_email']); 
	// 	$this->email->cc($data['cc']);   

	// 	$this->email->subject($data['subject']);
	// 	$this->email->message($data['body']);

	// 	if ($this->email->send()) {
	// 		echo "Success"
 //       	} else {
 //        	echo "There is error in sending mail!";
 //   		}

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

// method for validating reset password info
   	public function reset_password()
   	{
   		$this->load->model('login');
		$data = $this->input->post();
		$email = $this->login->check_email($data);
		if ($email) {
			$update = $this->login->change_password($data);
			if ($update){
				$data = array(
					'body' => 'Somone has reset your password for Shark Share. Your new password is: ' . $data['password']. ' If you recieved this email in error, log in to reset your password.',
					'from_email' => 'molly.ostheller@gmail.com',
					'from_name' => 'the Team @ Shark Share',
					'to_email' => $data['email'],
					'subject' => 'Your reset password for Shark Share'
					);

				$this->load->library('email');
				$this->email->from($data['from_email'], $data['from_name']);
				$this->email->to($data['to_email']);   

				$this->email->subject($data['subject']);
				$this->email->message($data['body']);
				if ($this->email->send()) {
					echo 1;
					return;
			       	} else {
			       		echo 2;
			        	return;
			   		}
			} else {
				echo 3;
				return;
			}
		} else {
			echo 4;
			return;
		}
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

// temporary method to edit the edit profile page
public function view_edit_profile()
	{		
		$this->load->model('login');
		$this->load->model('sample');
		$countries = $this->login->countries();
		$sample_types = $this->sample->get_sample_types();
		$header['title'] = 'Set Up New Profile';
		$data = array(
			'user' => array('id' => 57, 
				'first_name' => 'Top', 
				'last_name' => 'Cassidy',
				'email' => 'temporary@email.com',
				'institution' => 'Hogwarts',
				'field' => 'Sharks',
				'status' => 2,
				'city' => 'Seattle',
				'country_id' => 255
				), 
			'countries' => $countries,
			'sample_types' => $sample_types
			);
			$this->load->view('partials/header', $header);
			$this->load->view('styles/setup_profile');
			$this->load->view('partials/navbar_login');
			$this->load->view('setup_profile', $data);
			$this->load->view('partials/footer');
	} // end of method

} // end class
?>