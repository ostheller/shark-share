<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Collections extends CI_Controller {
/* this controller is for COLLECTIONS OF SAMPLES, e.g. collection viewing, management, uploads */

/* !!!!!!!!!!!!!!!!!! Viewing !!!!!!!!!!!!!!!!!! */

// user wants to see a collection, and this loads the collection page. Not the data for the table 
// could be theirs or anothers' collection, depends on what we pass it
	public function view_collection($id)
	{
		$header['title'] = 'Collection';
		$this->load->model('user');
		$user = $this->user->view($id);
		if ($this->session->userdata('logged_in' != TRUE)) {
		// they cannot see this page
			redirect('/restricted');
		} else if ($this->session->userdata('id') != $id) { 
		// they are logged in but it's not their collection
			
			$this->load->view('partials/header', $header);
			$this->load->view('styles/user_collection');
			$this->load->view('partials/navbar');
			$this->load->view('user_collection', array('user' => $user));
			$this->load->view('partials/footer');
		} else {
			$this->load->view('partials/header', $header);
			$this->load->view('styles/user_collection');
			$this->load->view('partials/navbar');
			$this->load->view('user_collection', array('user' => $user));
			$this->load->view('partials/footer');
		}
	} // end of method

// gets the data for the table
	public function get_data($id)
	{
		$this->load->model('collection');
		$samples = $this->collection->view($id);
		echo json_encode($samples);
	}

/* !!!!!!!!!!!!!!!!!! Uploading !!!!!!!!!!!!!!!!!! */

// user wants to visit the upload sample page
	public function view_upload_page()	
	{
		if ($this->session->userdata('logged_in' != TRUE)) {
		// they cannot see this page
			redirect('/restricted');
		} else {
			$header['title'] = 'Upload';
			$this->load->view('partials/header', $header);
			$this->load->view('styles/upload');
			$this->load->view('partials/navbar');
			$this->load->view('upload');
			$this->load->view('partials/footer');
		} // end else
	} // end of method

// user wants to download the template we use to upload samples
	//Liz changed to new template...
	public function get_template()
	{
		$data = file_get_contents("assets/downloads/upload_template_427.xlsx"); // Read the file's contents
		$name = 'sampleupload.xlsx';

		force_download($name, $data);
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
        	if ($this->session->userdata('logged_in' != TRUE)) {
				// they cannot see this page
					redirect('/restricted');
			} else
	        	$message = 'There was a problem with your upload';
	         	$header['title'] = 'Upload';

	         	$this->load->view('partials/header', $header);
	         	$this->load->view('styles/upload');
				$this->load->view('partials/navbar');
	         	$this->load->view('upload', $message);
	         	$this->load->view('partials/footer');
	         } // end else		
	} // end of method

//upload was successful, pulls the data from the sheet and loads the values onto the upload screen
	public function upload_success()
	{
		if ($this->session->userdata('logged_in' != TRUE)) {
		// they cannot see this page
			redirect('/restricted');
		} else {
			$this->load->model('collection');
			$path = $this->session->userdata('file_path');
			$data = $this->collection->extract_data_xlsx($path);
			$header['title'] = 'Upload';

			$this->load->view('partials/header', $header);
			$this->load->view('styles/upload');
			$this->load->view('partials/navbar');
			$this->load->view('upload', $data);
	        $this->load->view('partials/footer');
	    }
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

			if ($this->session->userdata('logged_in' != TRUE)) {
				// they cannot see this page
				redirect('/restricted');
			} else {
				$this->load->view('partials/header', $header);
				$this->load->view('styles/upload');
				$this->load->view('partials/navbar');
				$this->load->view('upload', $message);
		        $this->load->view('partials/footer');
		    }
		}
	} // end of method

/* !!!!!!!!!!!!!!!!!! Managing !!!!!!!!!!!!!!!!!! */




}