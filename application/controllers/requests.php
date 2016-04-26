<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Requests extends CI_Controller {
/* this controller is for the cart and the checkout process */

// this function will be running to query the 'request basket' to see what the user has in their basket
	public function count_requests()
	{
		$this->load->model('sample');
		$id = $this->session->userdata('id');
		$count = $this->sample->count_requests($id);
		echo json_encode($count);
	} // end of method

// user wants to request a sample
	public function request()
	{
		$this->load->model('sample');
		$selection = $this->input->post();
		$response = $this->sample->request($selection);
		echo json_encode($response);
		// foreach ($this->input->post() as $key) {
		// 	array_push($this->session->userdata['requested_sample_id'], $key);
		// }
	} // end of method

// user wants to get all request data
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

// user wants to remove a request
	public function remove_requests() 
	{
		$post = $this->input->post();
		$this->load->model('user');
		$this->user->destroy_requests($post);
	} // end of method

// user populate the form to choose the contributer they will send the email to
	public function get_contributers() 
	{
		$this->load->model('user');
		$post = $this->input->post();
		$id = $this->session->userdata('id');
		$data = array(
			'ids' => $post['id'], 
			'user_id' => $id
			);
		$distinct_names = $this->user->get_contributer_names($data);
		echo json_encode($distinct_names);
	} // end of method

//user SUBMITS the form to choose the contributer they will send the email to
	public function compose_email_data() 
	{
		$this->load->model('user');
		$post = $this->input->post();
		$id = $this->session->userdata('id');
		$data = array(
			$post, $id);
		$return = $this->user->get_email_data($data);		
		echo json_encode($return);
	} // end of method
} // end of controller