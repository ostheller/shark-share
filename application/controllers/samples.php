<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Samples extends CI_Controller {

// user enters a search
	public function search()
	{
		$post = $this->input->post();
		$data = $this->sample->search($post);
		
		$this->load->view('partials/header');
		$this->load->view('partials/navbar');
		$this->load->view('search', array($data));
		$this->load->view('partials/footer');
	}

// user clicks browse, pulls the data and loads the search results page
	public function browse()
	{
		$this->load->view('partials/header');
		$this->load->view('partials/navbar');
		$this->load->view('search');
		$this->load->view('partials/footer');
	}

// user wants to see a collection, pulls the data and loads the collection page. 
// could be theirs or anothers' collection, depends on what we pass it
	public function view_collection()
	{
		$this->load->view('partials/header');
		$this->load->view('partials/navbar');
		$this->load->view('user_collection');
		$this->load->view('partials/footer');
	}

// user wants to see a sample's profile page
	public function view_sample()
	{
		$this->load->view('partials/header');
		$this->load->view('partials/navbar');		
		$this->load->view('sample_profile');
		$this->load->view('partials/footer');
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
		$this->load->view('partials/header');
		$this->load->view('partials/navbar');
		$this->load->view('checkout');
		$this->load->view('partials/footer');
	}

// user wants to visit the upload sample page
	public function view_upload_page()	
	{
		$this->load->view('partials/header');
		$this->load->view('partials/navbar');
		$this->load->view('upload');
		$this->load->view('partials/footer');
	}

// uploading samples to a user's collection, if successful redirect to upload_success, otherwise no
	public function upload_batch()
	{
		$target_dir = "assets/uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        		$this->session->set_userdata('file_uploaded', basename($_FILES["fileToUpload"]["name"]));
        		$this->session->set_userdata('file_path', $target_file);
        		redirect('upload/success');
        } else {
        	$message = 'There was a problem with your upload';
         	$this->load->view('partials/header');
			$this->load->view('partials/navbar');
         	$this->load->view('upload', $message);
         	$this->load->view('partials/footer');
        }
	}

//upload was successful, pulls the data from the sheet and loads the values onto the upload screen
	public function upload_success()
	{
		$this->load->model('sample');
		$path = $this->session->userdata('file_path');
		$data = $this->sample->get_data($path);

		$this->load->view('partials/header');
		$this->load->view('partials/navbar');
		$this->load->view('upload', $data);
        $this->load->view('partials/footer');
	}

	//user chooses to submit their data to the database
	public function submit_data()
	{
		$this->load->model('sample');
		$path = $this->session->userdata('file_path');
		$data = $this->sample->get_data($path);
		$result = $this->sample->submit_data($data); 
		if ($result == TRUE)
		{
			$this->session->set_userdata('file_uploaded', FALSE);
			$this->session->set_userdata('message', 'Your data is in the database, thank you!');
			$message = 'your data is in the database, thank you!';
			redirect('upload');
		} else {
			$message = 'your data failed to upload, try again or check your spreadsheet for errors';
			$this->load->view('partials/header');
			$this->load->view('partials/navbar');
			$this->load->view('upload', $message);
	        $this->load->view('partials/footer');
		}


	}

}