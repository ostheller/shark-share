<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {
/* this controller if for LOGGED IN users and manages user profiles and information, both by users and by admins */

/* !!!!!!!!!!!!!!!!!! Methods concerning the dashboard, and admin editing and deleting user profiles !!!!!!!!!!!!!!!!!! */

// method for arriving on the dashboard and getting the data for populating the table
// data needed includes: 
	public function view_user_dashboard()
	{
		// check that the user is logged in
		if ($this->session->userdata('logged_in') === TRUE) {
		// they are logged in, so we load the view
			$this->load->view('partials/header');
			$this->load->view('partials/navbar');
			$this->load->view('user_dashboard');
			$this->load->view('partials/footer');
		// if they are not logged in, redirect away;
		} else { 
			redirect('/');		
		}

// method for ONLY admins to arrive on admin dashboard and getting the data for populating the table
// data needed includes:
	public function view_admin_dashboard()
	{
		// check to see if they have the clearance
		if ($this->session->userdata('admin') === TRUE && $this->session->userdata('logged_in') === TRUE) {
        	$this->load->view('partials/header');
			$this->load->view('partials/navbar');
			$this->load->view('admin_dashboard');
			$this->load->view('partials/footer');
        // if they don't have clearance but are indeed logged in, redirect to dashboard
        } else if ($this->session->userdata('logged_in') === TRUE) {
        	redirect('/dashboard')
        } else {
        	redirect('/')
        }
	} // end of method 

// method for posting add user information, when admins choose to accept a user

// method for admins to visit a page containing a register of all users

// method that processes the affirmation of intention to delete user and passes on to the delete method

// method for admins to remove users and return to the admin dashboard

/* !!!!!!!!!!!!!!!!!! Methods concerning the profile, and user editing of their own profiles !!!!!!!!!!!!!!!!!! */

// method for users to land on a profile page, IF IT IS THEIR OWN, OR THEY ARE AN ADMIN, they come with rights to edit that page
	public function view_user()
	{
		$this->load->view('partials/header');
		$this->load->view('partials/navbar');
		$this->load->view('user_profile');
		$this->load->view('partials/footer');
	} // end of method

// method for users and admins to visit their own collections when they type in 'collection'
	public function view_user()
	{
		$this->load->view('partials/header');
		$this->load->view('partials/navbar');
		$this->load->view('user_profile');
		$this->load->view('partials/footer');
	} // end of method

// method to process form action to update email & name on profile edit pages

// method to process form action to update password on profile edit pages

// method to process form action to update description on profile edit pages

// method to upload files for profile pictures

}