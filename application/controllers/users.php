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
			$data['title'] = 'Dashboard';
			// now we load the view
			$this->load->view('partials/header', $data);
			$this->load->view('partials/navbar');
			$this->load->view('user_dashboard', $data);
			$this->load->view('partials/footer');
		// if they are not logged in, redirect away;
		} else { 
			redirect('/');		
		}
	} // end of method

/* !!!!!!!!!!!!!!!!!! Methods concerning the profile, and user editing of their own profiles !!!!!!!!!!!!!!!!!! */

// method for new users to set up their initial profile pages
	public function view_setup_profile()
	{
		$data['title'] = 'New Profile';

		$this->load->view('partials/header', $data);
		$this->load->view('partials/navbar');
		$this->load->view('user_profile');
		$this->load->view('partials/footer');
	} // end of method

// method for submitting the form data for their profile, sets flash data for confirmation & goes to dashboard
	public function set_preferences()
	{
		$data['title'] = 'New Profile';

		$this->load->view('partials/header', $data);
		$this->load->view('partials/navbar');
		$this->load->view('user_profile');
		$this->load->view('partials/footer');
	} // end of method

// method for users to land on a profile page, IF IT IS THEIR OWN, OR THEY ARE AN ADMIN, they come with rights to edit that page
	public function view_user()
	{
		$user = $this->session->userdata('id');
		$data = $this->sample->view($user);
		$data['title'] = 'View ' . $data['first'] . ' ' . $data['last'];

		$this->load->view('partials/header', $data);
		$this->load->view('partials/navbar');
		$this->load->view('user_profile');
		$this->load->view('partials/footer');
	} // end of method

// method to process form action to update email & name on profile edit pages

// method to process form action to update password on profile edit pages

// method to process form action to update description on profile edit pages

// method to upload files for profile pictures

/* !!!!!!!!!!!!!!!!!! Methods concerning site navigation !!!!!!!!!!!!!!!!!! */

// method to view the help page
	public function view_help()
	{
		if ($this->session->userdata('logged_in') != TRUE) {
		// if they are not logged in (get the navbar WITHthe login form)
			$data['title'] = 'Help';

			$this->load->view('partials/header', $data);
			$this->load->view('partials/navbar_login');
			$this->load->view('help');
			$this->load->view('partials/footer');
		} else { 
		// they are logged in (get the navbar without the login form)
			$this->load->view('partials/header', $data);
			$this->load->view('partials/navbar');
			$this->load->view('help');
			$this->load->view('partials/footer');
		}
	} // end of method

// method to deal with UNAUTHORIZED access to a page
	public function restricted()
	{
		if ($this->session->userdata('logged_in') != TRUE) {
		// if they are not logged in (get the navbar WITHthe login form)
			$data['title'] = 'Access Restricted';

			$this->load->view('partials/header', $data);
			$this->load->view('partials/navbar_login');
			$this->load->view('restricted');
			$this->load->view('partials/footer');
		} else { 
		// they are logged in (get the navbar without the login form)
			$this->load->view('partials/header', $data);
			$this->load->view('partials/navbar');
			$this->load->view('restricted');
			$this->load->view('partials/footer');
		}
	} // end of method
}