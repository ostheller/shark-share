<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Requests extends CI_Controller {
/* this controller is for the cart and the checkout process */

// this function will be running to query the 'request basket' to see what the user has in their basket
	public function count_requests()
	{

	} // end of method

// user requests a sample, adding it to the 'request basket' that we have running
	public function request()
	{
	} // end of method

// user wants to visit the checkout page
	public function view_request_samples()
	{
		$header['title'] = 'Request Samples';
		$this->load->view('partials/header');
		$this->load->view('partials/navbar');
		$this->load->view('requests');
		$this->load->view('partials/footer');
	} // end of method

}