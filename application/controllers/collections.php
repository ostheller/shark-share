<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Collections extends CI_Controller {
/* this controller is for COLLECTIONS OF SAMPLES, e.g. collection viewing, management, uploads */

/* !!!!!!!!!!!!!!!!!! Viewing !!!!!!!!!!!!!!!!!! */

// user wants to see a collection, pulls the data and loads the collection page. 
// could be theirs or anothers' collection, depends on what we pass it
	public function view_collection($id)
	{
		$header['title'] = 'Collection';
		if ($this->session->userdata('logged_in' != TRUE)) {
		// they cannot see this page
			redirect('/restricted');
		} else if ($this->session->userdata('id') != $id) { 
		// they are logged in but it's not their collection
			
			$this->load->view('partials/header', $header);
			$this->load->view('partials/navbar');
			$this->load->view('user_collection', $data);
			$this->load->view('partials/footer');
		} else {
			$this->load->view('partials/header', $header);
			$this->load->view('partials/navbar');
			$this->load->view('user_collection', $data);
			$this->load->view('partials/footer');
		}
	} // end of method

/* !!!!!!!!!!!!!!!!!! Uploading !!!!!!!!!!!!!!!!!! */

// user wants to visit the upload sample page
	public function view_upload_page()	
	{
		$header['title'] = 'Upload';
		$this->load->view('partials/header', $header);
		$this->load->view('partials/navbar');
		$this->load->view('upload');
		$this->load->view('partials/footer');
	} // end of method

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
         	$header['title'] = 'Upload';

         	$this->load->view('partials/header', $header);
			$this->load->view('partials/navbar');
         	$this->load->view('upload', $message);
         	$this->load->view('partials/footer');
        }
	} // end of method

//upload was successful, pulls the data from the sheet and loads the values onto the upload screen
	public function upload_success()
	{
		$this->load->model('collection');
		$path = $this->session->userdata('file_path');
		$data = $this->collection->extract_data_xlsx($path);
		$header['title'] = 'Upload';

		$this->load->view('partials/header', $header);
		$this->load->view('partials/navbar');
		$this->load->view('upload', $data);
        $this->load->view('partials/footer');
	} // end of method

//user chooses to submit their data to the database
	public function submit_data()
	{
		$this->load->model('collection');
		$path = $this->session->userdata('file_path');
		$data = $this->collection->extract_data_xlsx($path);
		$result = $this->collection->submit_data($data); 
		if ($result == TRUE)
		{
			$this->session->set_userdata('file_uploaded', FALSE);
			$this->session->set_userdata('message', 'Your data is in the database, thank you!');
			$message = 'your data is in the database, thank you!';
			redirect('upload');
		} else {
			$message = 'your data failed to upload, try again or check your spreadsheet for errors';
			$header['title'] = 'Upload';

			$this->load->view('partials/header', $header);
			$this->load->view('partials/navbar');
			$this->load->view('upload', $message);
	        $this->load->view('partials/footer');
		}
	} // end of method

/* !!!!!!!!!!!!!!!!!! Managing !!!!!!!!!!!!!!!!!! */




}