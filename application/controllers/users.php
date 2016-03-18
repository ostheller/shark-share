<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

// loads www.example.com/ on intial load
	public function index()
	{
		$this->load->view('landing_page');
	}

// user logs in
	public function login()
	{
		$this->load->view('user_dashboard');
	}

// user signs up, returns to landing page
	public function sign_up()
	{
		$this->load->view('landing_page');
	}

// login successful, loads the user dashboard page
	public function login_success()
	{
		$this->load->view('user_dashboard');
	}

// login successful, user is an admin, loads the admin dashboard page
	public function admin_login_success()
	{
		$this->load->view('admin_dashboard');
	}

// load the user dashboard page when user is logged in
	public function view_user_dashboard()
	{
		$this->load->view('user_dashboard');
	}

// load the admin dashboard page when an admin user is logged in
	public function view_admin_dashboard()
	{
		$this->load->view('user_dashboard');
	}

// user wants to see a profile, pulls the data and loads the profile page. 
// could be theirs or anothers' profile, depends on what we pass it
	public function view_user()
	{
		$this->load->view('user_profile');
	}
}