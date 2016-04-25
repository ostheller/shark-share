<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Requests extends CI_Controller {
/* this controller is for the cart and the checkout process */

// this function will be running to query the 'request basket' to see what the user has in their basket
	public function count_requests()
	{
		$this->load->model('sample');
		$id = $this->session->userdata('id');
		$count = $this->db->sample->count_requests($id);
		return $count;
	} // end of method

// user wants to request a sample
	public function request()
	{
		$this->load->model('sample');
		$selection = $this->input->post();
		return $this->sample->request($selection);
		// foreach ($this->input->post() as $key) {
		// 	array_push($this->session->userdata['requested_sample_id'], $key);
		// }
	} // end of method

// user wants to get request data
	public function samples() 
	{
		$this->load->model('sample');
		$id = $this->session->userdata('id');
		$data = $this->sample->get_requests($id);
		echo json_encode($data);
	}

// user wants to visit the checkout page
	public function view_request_sample_page()
	{
		$header['title'] = 'Request Samples';
		
		$this->load->view('partials/header', $header);
		$this->load->view('styles/requests');
		$this->load->view('partials/navbar');
		$this->load->view('requests');
		$this->load->view('partials/footer');
	} // end of method

}