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

// user wants to visit the checkout page
	public function view_checkout()
	{
		$this->load->view('checkout');
	}

// user wants to visit the upload sample page
	public function view_upload_page()	
	{
		$this->load->view('upload');
	}

// uploading samples to a user's collection, if successful redirect to upload_success, otherwise no
	public function upload_batch()
	{
		$target_dir = "assets/uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        		redirect('samples/upload_success');
        } else {
        	$message = 'There was a problem with your upload';
         	$this->load->view('upload', $message);
        }
	}

// upload was successful, reloads the collection after drawing the data to show updated collection
	public function upload_success()
	{
		redirect('upload');
	}	
}