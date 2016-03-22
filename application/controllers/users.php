<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {
/* this controller if for LOGGED IN users and manages user profiles and information, both by users and by admins */

/* !!!!!!!!!!!!!!!!!! Methods concerning the dashboard !!!!!!!!!!!!!!!!!! */

// method for arriving on the dashboard and getting the data for populating the table
// data needed includes: 
	public function view_user_dashboard()
	{
		// check that the user is logged in
		if ($this->session->userdata('logged_in') === TRUE) {
			// we request the data we need from the model

			// now we load the view
			$this->load->view('partials/header');
			$this->load->view('partials/navbar');
			$this->load->view('user_dashboard', $data);
			$this->load->view('partials/footer');
		// if they are not logged in, redirect away;
		} else { 
			redirect('/');		
		} // end of method

/* !!!!!!!!!!!!!!!!!! Methods concerning the profile, and user editing of their own profiles !!!!!!!!!!!!!!!!!! */

// method for new users to set up their initial profile pages

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