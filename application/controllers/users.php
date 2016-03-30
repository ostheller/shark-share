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
			$header['title'] = 'Dashboard';
			$requests['count'] = count($this->session->userdata['requested_sample_id']);
			// now we load the view
			$this->load->view('partials/header', $header);
			$this->load->view('partials/navbar', $requests);
			$this->load->view('user_dashboard');
			$this->load->view('partials/footer');
		// if they are not logged in, redirect away;
		} else { 
			redirect('/');		
		}
	} // end of method

/* !!!!!!!!!!!!!!!!!! Methods concerning the profile, and user editing of their own profiles !!!!!!!!!!!!!!!!!! */

// method for new users to see the page where they can set up their initial profile pages
	public function view_setup_profile()
	{
		$header['title'] = 'New Profile';
		$requests['count'] = count($this->session->userdata['requested_sample_id']);

		$this->load->view('partials/header', $header);
		$this->load->view('partials/navbar', $requests);
		$this->load->view('user_profile');
		$this->load->view('partials/footer');
	} // end of method

// method for submitting the form data for their profile, sets flash data for confirmation & goes to dashboard
	public function set_preferences()
	{
		$header['title'] = 'New Profile';
		$requests['count'] = count($this->session->userdata['requested_sample_id']);
		$this->load->view('partials/header', $header);
		$this->load->view('partials/navbar', $requests);
		$this->load->view('user_profile');
		$this->load->view('partials/footer');
	} // end of method

// method for users to land on a profile page, IF IT IS THEIR OWN, OR THEY ARE AN ADMIN, they come with rights to edit that page
	public function view_user($id)
	{
		$this->load->model('user');
		$data = $this->user->view($id);
		$header['title'] = $data['first_name'] . ' ' . $data['last_name'];
		$requests['count'] = count($this->session->userdata['requested_sample_id']);

		$this->load->view('partials/header', $header);
		$this->load->view('partials/navbar', $requests);
		$this->load->view('user_profile', $data);
		$this->load->view('partials/footer');
	} // end of method

// method to process form action to update email & name on profile edit pages

// method to process form action to update password on profile edit pages

// method to process form action to update description on profile edit pages

// method to upload files for profile pictures

/* !!!!!!!!!!!!!!!!!! Methods concerning site navigation !!!!!!!!!!!!!!!!!! */

// method to view the about page
	public function view_about()
	{
		$header['title'] = 'About';
		if ($this->session->userdata('logged_in') != TRUE) {
		// if they are not logged in (get the navbar WITH the login form)

			$this->load->view('partials/header', $header);
			$this->load->view('partials/navbar_login');
			$this->load->view('about');
			$this->load->view('partials/footer');
		} else { 
			$requests['count'] = count($this->session->userdata['requested_sample_id']);
		// they are logged in (get the navbar without the login form)
			$this->load->view('partials/header', $header);
			$this->load->view('partials/navbar', $requests);
			$this->load->view('about');
			$this->load->view('partials/footer');
		}
	} // end of method

// method to view the help page
	public function view_help()
	{
		if ($this->session->userdata('logged_in') != TRUE) {
		// if they are not logged in (get the navbar WITH the login form)
			$header['title'] = 'Help';

			$this->load->view('partials/header', $header);
			$this->load->view('partials/navbar_login');
			$this->load->view('help');
			$this->load->view('partials/footer');
		} else { 
		// they are logged in (get the navbar without the login form)
			$this->load->view('partials/header', $header);
			$this->load->view('partials/navbar');
			$this->load->view('help');
			$this->load->view('partials/footer');
		}
	} // end of method

	// method to view the request samples page
	public function view_request_samples()
	{
		if ($this->session->userdata('logged_in') != TRUE) {
		// if they are not logged in this is restricted
			redirect('/restricted');
		} else { 
		// they are logged in (get the navbar without the login form)
			$data = $this->session->userdata['requested_sample_id'];

			$header['title'] = 'Request Samples';
			$this->load->view('partials/header', $header);
			$this->load->view('partials/navbar');
			$this->load->view('requests', array('id' => $data));
			$this->load->view('partials/footer');
		}
	} // end of method

// method to deal with UNAUTHORIZED access to a page
	public function restricted()
	{
		if ($this->session->userdata('logged_in') != TRUE) {
		// if they are not logged in (get the navbar WITHthe login form)
			$header['title'] = 'Access Restricted';

			$this->load->view('partials/header', $header);
			$this->load->view('partials/navbar_login');
			$this->load->view('restricted');
			$this->load->view('partials/footer');
		} else { 
		// they are logged in (get the navbar without the login form)
			$this->load->view('partials/header', $header);
			$this->load->view('partials/navbar');
			$this->load->view('restricted');
			$this->load->view('partials/footer');
		}
	} // end of method
}