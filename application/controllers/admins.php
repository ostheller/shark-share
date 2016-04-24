<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admins extends CI_Controller {
/* this controller is for all the exclusively admin functions */

// method for ONLY admins to arrive on admin dashboard and getting the data for populating the table
	public function view_admin_dashboard()
	{
		// check to see if they have the clearance
		if ($this->session->userdata('admin') === TRUE && $this->session->userdata('logged_in') === TRUE) {
        	// we request the data we need from the model
			//$this->sample->
			// now we load the view
        	$header['title'] = 'Admin Dashboard';
        	$requests['count'] = count($this->session->userdata['requested_sample_id']);

        	$this->load->view('partials/header', $header);
        	$this->load->view('styles/admin_dashboard');
			$this->load->view('partials/navbar', $requests);
			$this->load->view('admin_dashboard');
			$this->load->view('partials/footer');
        // if they don't have clearance but are indeed logged in, redirect to dashboard
        } else if ($this->session->userdata('logged_in') === TRUE) {
        	redirect('/dashboard');
        } else {
        	redirect('/');
        }
	} // end of method 

/*// method for posting add user information, when admins choose to accept a user
 includes a call to the model to send an acceptance email
 insert into users table and delete out of probation table */

// method to view potential users
	public function view_potential_users()
	{
		$this->load->model('user');
		$data = $this->user->view_potential_users();
		echo json_encode($data);
	} // end of method 

 // method to accept potential users
	public function confirm_new_user()
	{
		$post = $this->input->post();
	} // end of method 
	
// method for rejecting users and sending an email to the new user when denied
	public function reject_potential_user()
	{
		$post = $this->input->post();
		$this->load->model('user');
		$this->user->reject_potential_user($post);
	} // end of method 

// method for admins to visit a page containing a register of all users

// method that processes the affirmation of intention to delete user and passes on to the delete method

// method for admins to remove users and return to the admin dashboard


} // end of controller