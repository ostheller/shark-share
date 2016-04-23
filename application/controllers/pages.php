<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends CI_Controller {
/* !!!!!!!!!!!!!!!!!! Methods concerning site navigation !!!!!!!!!!!!!!!!!! */

// method to view the about page
	public function view_about()
	{
		$header['title'] = 'About';
		if ($this->session->userdata('logged_in') != TRUE) {
		// if they are not logged in (get the navbar WITH the login form)

			$this->load->view('partials/header', $header);
			$this->load->view('styles/about');
			$this->load->view('partials/navbar_login');
			$this->load->view('about');
			$this->load->view('partials/footer');
		} else { 
		// they are logged in (get the navbar without the login form)
			$this->load->view('partials/header', $header);
			$this->load->view('styles/about');
			$this->load->view('partials/navbar');
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
			$this->load->view('styles/help');
			$this->load->view('partials/navbar_login');
			$this->load->view('help');
			$this->load->view('partials/footer');
		} else { 
		// they are logged in (get the navbar without the login form)
			$header['title'] = 'Help';

			$this->load->view('partials/header', $header);
			$this->load->view('styles/help');
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
			$this->load->view('styles/requests');
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
			$this->load->view('styles/restricted');
			$this->load->view('partials/navbar_login');
			$this->load->view('restricted');
			$this->load->view('partials/footer');
		} else { 
		// they are logged in (get the navbar without the login form)
			$header['title'] = 'Access Restricted';

			$this->load->view('partials/header', $header);
			$this->load->view('styles/restricted');
			$this->load->view('partials/navbar');
			$this->load->view('restricted');
			$this->load->view('partials/footer');
		}
	} // end of method


} // end of controller