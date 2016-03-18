<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Samples extends CI_Controller {

// user enters a search
	public function search()
	{
		$post = $this->input->post();
		$data = $this->sample->search($post);
		$this->load->view('search', array($data));
	}

// user clicks browse, pulls the data and loads the search results page
	public function browse()
	{
		$this->load->view('search');
	}

// user wants to see a collection, pulls the data and loads the collection page. 
// could be theirs or anothers' collection, depends on what we pass it
	public function view_collection()
	{
		$this->load->view('user_collection');
	}

// user wants to see a sample's profile page
	public function view_sample()
	{
		$this->load->view('sample_profile');
	}

// user requests a sample, adding it to the 'checkout cart' that we have running
	public function request()
	{
	}

// this function will be running to query the 'checkout cart' to see what the user has in their basket
	public function check_cart()
	{

	}

// uploading samples to a user's collection, if successful redirect to upload_success, otherwise no
	public function upload()
	{
		
	}

// uploading samples to a user's collection, if successful redirect to 
	public function upload_success()
	{
		$this->load->view('user_collection');
	}	
}