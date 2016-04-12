<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Taxonomies extends CI_Controller {
/* this controller is for all the exclusively admin functions */
/* !!!!!!!!!!!!!!!!!! Managing the Taxonomy !!!!!!!!!!!!!!!!!! */

// user wants to visit the taxonomy maintenance page
	public function view_taxonomy()	
	{
		$header['title'] = 'Taxonomy';
		$this->load->model('taxonomy');
		$data = $this->taxonomy->select_all();
		$this->load->view('partials/header', $header);
		$this->load->view('styles/taxonomy');
		$this->load->view('partials/navbar');
		$this->load->view('taxonomy', array('rows' => $data));
		$this->load->view('partials/footer');
	} // end of method

// user wants to download the template we use to upload samples
	public function get_template()
	{
		$data = file_get_contents("assets/downloads/template.xlsx"); // Read the file's contents
		$name = 'template.xlsx';

		force_download($name, $data);
	} // end of method

// uploading samples to a user's taxonomy, if successful redirect to upload_success, otherwise no
	public function upload_batch()
	{
		$target_dir = "assets/uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        		$this->session->set_userdata('file_uploaded', basename($_FILES["fileToUpload"]["name"]));
        		$this->session->set_userdata('file_path', $target_file);
        		redirect('taxonomy/success');
        } else {
        	$message = 'There was a problem with your upload';
         	$header['title'] = 'Taxonomy';

         	$this->load->view('partials/header', $header);
         	$this->load->view('styles/taxonomy');
			$this->load->view('partials/navbar');
         	$this->load->view('taxonomy', $message);
         	$this->load->view('partials/footer');
        }
	} // end of method

//upload was successful, pulls the data from the sheet and loads the values onto the upload screen
	public function upload_success()
	{
		$this->load->model('taxonomy');
		$path = $this->session->userdata('file_path');
		$data = $this->taxonomy->extract_taxonomy_data_xlsx($path);
		$header['title'] = 'Taxonomy';

		$this->load->view('partials/header', $header);
		$this->load->view('styles/taxonomy');
		$this->load->view('partials/navbar');
		$this->load->view('taxonomy', $data);
        $this->load->view('partials/footer');
	} // end of method

//user chooses to update taxonomic information
	public function update_data()
	{
		$this->load->model('taxonomy');
		$path = $this->session->userdata('file_path');
		$data = $this->taxonomy->extract_taxonomy_data_xlsx($path);
		$result = $this->taxonomy->update_taxonomy_data($data); 
		if ($result == TRUE)
		{
			$this->session->set_userdata('file_uploaded', FALSE);
			$this->session->set_userdata('message', 'Your data is in the database, thank you!');
			$message = 'your data is in the database, thank you!';
			redirect('taxonomy');
		} else {
			$message = 'your data failed to upload, try again or check your spreadsheet for errors';
			$header['title'] = 'Taxonomy';

			$this->load->view('partials/header', $header);
			$this->load->view('styles/taxonomy');
			$this->load->view('partials/navbar');
			$this->load->view('taxonomy', $message);
	        $this->load->view('partials/footer');
		}
	} // end of method

//user chooses to submit their data to the database
	public function submit_new_taxonomy_data()
	{
		$this->load->model('taxonomy');
		$path = $this->session->userdata('file_path');
		$data = $this->taxonomy->extract_taxonomy_data_xlsx($path);
		$result = $this->taxonomy->submit_taxonomy_data($data); 
		if ($result == TRUE)
		{
			$this->session->set_userdata('file_uploaded', FALSE);
			$this->session->set_userdata('message', 'Your data is in the database, thank you!');
			$message = 'your data is in the database, thank you!';
			redirect('taxonomy');
		} else {
			$message = 'your data failed to upload, try again or check your spreadsheet for errors';
			$header['title'] = 'Taxonomy';

			$this->load->view('partials/header', $header);
			$this->load->view('styles/taxonomy');
			$this->load->view('partials/navbar');
			$this->load->view('taxonomy', $message);
	        $this->load->view('partials/footer');
		}
	} // end of method
} // end of controller