<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admins extends CI_Controller {
/* this controller is for all the exclusively admin functions */

// method for ONLY admins to arrive on admin dashboard and getting the data for populating the table
// data needed includes:
	public function view_admin_dashboard()
	{
		// check to see if they have the clearance
		if ($this->session->userdata('admin') === TRUE && $this->session->userdata('logged_in') === TRUE) {
        	// we request the data we need from the model

			// now we load the view
        	$this->load->view('partials/header');
			$this->load->view('partials/navbar');
			$this->load->view('admin_dashboard', $data);
			$this->load->view('partials/footer');
        // if they don't have clearance but are indeed logged in, redirect to dashboard
        } else if ($this->session->userdata('logged_in') === TRUE) {
        	redirect('/dashboard')
        } else {
        	redirect('/')
        }
	} // end of method 

// method for posting add user information, when admins choose to accept a user

// method for sending an email to the new user when accepted
	
// method for sending an email to the new user when denied

// method for admins to visit a page containing a register of all users

// method that processes the affirmation of intention to delete user and passes on to the delete method

// method for admins to remove users and return to the admin dashboard

}