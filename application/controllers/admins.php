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

        	$this->load->view('partials/header', $header);
        	$this->load->view('styles/admin_dashboard');
			$this->load->view('partials/navbar');
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
		$this->load->model('login');
		// generate a token for th euser
		$userdata = $this->login->generate_token($post);
		var_dump($userdata);
		//send email
		$this->load->library('email');

		$this->email->from('molly.ostheller@gmail.com', 'Molly Ostheller');
		$this->email->to('molly.ostheller@gmail.com'); 
		$this->email->cc('mro4@uw.edu');   

		$this->email->subject('Welcome to Shark Share!');
		$this->email->message('Hello, '.$userdata['userdata']['first_name'] .'! Please click on <a href="http://localhost:8888/setup_user/'.$userdata["token"].'">this link</a> to set up your profile.');
		// $attached_file= $_SERVER["DOCUMENT_ROOT"]."/assets/downloads/template.xlsx";
		// $this->email->attach($attached_file);
		if ($this->email->send()) {
       		echo "Mail Sent!"; 
       	} else {
        	echo "There is error in sending mail!";
   		}
	} // end of method 
	
// method for rejecting users and sending an email to the new user when denied
	public function reject_potential_user()
	{
		$post = $this->input->post();
		$this->load->model('login');
		$this->login->reject_potential_user($post);
		// WRITE THE CODE TO SEND THE EMAILS
	} // end of method 

// method for admins to visit a page containing a register of all users

// method that processes the affirmation of intention to delete user and passes on to the delete method

// method for admins to remove users and return to the admin dashboard


} // end of controller