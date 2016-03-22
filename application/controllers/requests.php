<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Requests extends CI_Controller {
/* this controller is for the cart and the checkout process */

// this function will be running to query the 'checkout cart' to see what the user has in their basket
	public function check_cart()
	{

	} // end of method

// user requests a sample, adding it to the 'checkout cart' that we have running
	public function request()
	{
	} // end of method

// user wants to visit the checkout page
	public function view_checkout()
	{
		$this->load->view('partials/header');
		$this->load->view('partials/navbar');
		$this->load->view('checkout');
		$this->load->view('partials/footer');
	} // end of method

}