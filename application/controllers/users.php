<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {
/* this controller if for LOGGED IN users and manages user profiles and information, both by users and by admins */

/* !!!!!!!!!!!!!!!!!! Methods concerning the dashboard !!!!!!!!!!!!!!!!!! */

// method for arriving on the dashboard and getting the data for populating the table
// data needed includes: 
	public function view_user_dashboard()
	{
		if ($this->session->userdata('logged_in') != TRUE) {
		// if they are not logged in this is restricted
			redirect('/restricted');
		} else { 
			// we request the data we need from the model
			$header['title'] = 'Dashboard';
			// now we load the view
			$this->load->view('partials/header', $header);
			$this->load->view('styles/user_dashboard');
			$this->load->view('partials/navbar');
			$this->load->view('user_dashboard');
			$this->load->view('partials/footer');
		} // end else
	} // end of method

/* !!!!!!!!!!!!!!!!!! Methods concerning the profile, and user editing of their own profiles !!!!!!!!!!!!!!!!!! */

// method for new users to see the page where they can set up their initial profile pages
	public function view_setup_profile($token)
	{
		$this->load->model('login');
		$this->load->model('sample');
		$user = $this->login->check_token($token);
		$session_data = array('setup_info' => $user);
		$this->session->set_userdata($session_data);
		$countries = $this->login->countries();
		$sample_types = $this->sample->get_sample_types();
		// var_dump($user);
		// die();
		if (empty($user)) {
			redirect('/');
		} else {
			$header['title'] = 'Set Up New Profile';
			$data = array(
				'user' => $user, 
				'countries' => $countries,
				'sample_types' => $sample_types
				);
			$this->load->view('partials/header', $header);
			$this->load->view('styles/setup_profile');
			$this->load->view('partials/navbar_login');
			$this->load->view('setup_profile', $data);
			$this->load->view('partials/footer');	
		} // end else
	} // end of method

// method for submitting the form data for their profile, sets flash data for confirmation & goes to dashboard
// if they are successful at setting up a password, they are deleted from the potential user database
	public function create_profile()
	{
		$this->load->model('user');
		$user = $this->input->post();
		$this->user->setup_user_info($user);
		echo 'done';
	} // end of method

// method for setting up their tagged preferences
	public function create_tags()
	{
		$this->load->model('user');
		$tags = $this->input->post();
		// $this->user->create($user);
		// redirect('/');
	} // end of method

// method for users to land on a profile page, IF IT IS THEIR OWN, OR THEY ARE AN ADMIN, they come with rights to edit that page
	public function view_user($id)
	{
		$this->load->model('user');
		$this->load->model('login');
		$data = $this->user->view($id);
		$countries = $this->login->countries();
		$data['countries'] = $countries;
		$header['title'] = $data['first_name'] . ' ' . $data['last_name'];

		$this->load->view('partials/header', $header);
		$this->load->view('styles/user_profile');
		$this->load->view('partials/navbar');
		$this->load->view('user_profile', $data);
		$this->load->view('partials/footer');
	} // end of method

// method to process form action to verify email & name on profile edit pages
	public function update()
	{
		$this->load->model('user');
		$user = $this->input->post();
		$this->user->update($user);
	} // end of method

// method to process form action to update password on profile edit pages

// method to process form action to update description on profile edit pages

// method to upload files for profile pictures
}