<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

// loads www.example.com/ on intial load
	public function index()
	{
		$this->load->view('partials/header');
		$this->load->view('partials/navbar_login');
		$this->load->view('landing_page');
		$this->load->view('partials/footer');
	}

	public function view_landing_page()
	{
		$this->load->view('partials/header');
		$this->load->view('partials/navbar_login');
		$this->load->view('landing_page');
		$this->load->view('partials/footer');
	}

// page missing, 404
	public function load_404()
	{
		$this->load->view('partials/header');
		$this->load->view('partials/navbar');		
		$this->load->view('404');
		$this->load->view('partials/footer');
	}

// user logs in
	public function login()
	{
		$this->load->view('partials/header');
		$this->load->view('partials/navbar');
		$this->load->view('user_dashboard');
		$this->load->view('partials/footer');
	}

// user logs out
	public function logout()
	{
		$this->session->sess_destroy();
		$this->load->view('partials/header');
		$this->load->view('partials/navbar_login');
		$this->load->view('landing_page');
		$this->load->view('partials/footer');
	}

// user signs up, returns to landing page
	public function sign_up()
	{
		$this->load->view('partials/header');
		$this->load->view('partials/navbar_login');
		$this->load->view('landing_page');
		$this->load->view('partials/footer');
	}

// login successful, loads the user dashboard page
	public function login_success()
	{
		$this->load->view('partials/header');
		$this->load->view('partials/navbar');
		$this->load->view('user_dashboard');
		$this->load->view('partials/footer');
	}

// login successful, user is an admin, loads the admin dashboard page
	public function admin_login_success()
	{
		$this->load->view('partials/header');
		$this->load->view('partials/navbar');
		$this->load->view('admin_dashboard');
		$this->load->view('partials/footer');
	}

// load the user dashboard page when user is logged in
	public function view_user_dashboard()
	{
		$this->load->view('partials/header');
		$this->load->view('partials/navbar');
		$this->load->view('user_dashboard');
		$this->load->view('partials/footer');
	}

// load the admin dashboard page when an admin user is logged in
	public function view_admin_dashboard()
	{
		$this->load->view('partials/header');
		$this->load->view('partials/navbar');
		$this->load->view('user_dashboard');
		$this->load->view('partials/footer');
	}

// user wants to see a profile, pulls the data and loads the profile page. 
// could be theirs or anothers' profile, depends on what we pass it
	public function view_user()
	{
		$this->load->view('partials/header');
		$this->load->view('partials/navbar');
		$this->load->view('user_profile');
		$this->load->view('partials/footer');
	}
}