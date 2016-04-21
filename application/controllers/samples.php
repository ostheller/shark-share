<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Samples extends CI_Controller {
/* this controller is for INDIVIDUAL SAMPLE INTERACTION, e.g. the search, display and manipulation of the samples */

/* !!!!!!!!!!!!!!!!!! Methods concerning the SEARCH !!!!!!!!!!!!!!!!!! */

// get data from database to use for autofills
	public function get_genus()
	{
		$this->load->model('sample');
		$genus = $this->sample->get_genus();
		echo json_encode($genus);
	} // end of method
	public function get_species()
	{
		$this->load->model('sample');
		$species = $this->sample->get_species();
       	echo json_encode($species);
	} // end of method
	public function get_family()
	{
		$this->load->model('sample');
		$family = $this->sample->get_family();
		echo json_encode($family);
	} // end of method
	public function get_order()
	{
		$this->load->model('sample');
		$order = $this->sample->get_order();
		echo json_encode($order);
	} // end of method

// user enters a keyword search
	public function search()
	{
		$this->load->model('sample');
		$post = $this->input->post();
		$data = $this->sample->search($post);
		echo json_encode($data);
		// $header['title'] = 'Search';

		// $this->load->view('partials/header', $header);
		// $this->load->view('styles/search');
		// $this->load->view('partials/navbar');
		// $this->load->view('search', $data);
		// $this->load->view('partials/footer');
	} // end of method

// load the view page
	public function view_search()
	{
		if ($this->session->userdata('logged_in') != TRUE) {
		// if they are not logged in this is restricted
			redirect('/restricted');
		} else { 
			$this->load->model('sample');
			$this->load->model('login');
			$countries = $this->login->countries();
			//$user = $this->session->userdata('id');
			$types = $this->sample->get_sample_types();
			$locations = $this->sample->get_locations();
			$institutions = $this->sample->get_institutions();
			$data = $this->sample->search($this->input->post);
			$header['title'] = 'Search';
			$requests['count'] = count($this->session->userdata['requested_sample_id']);

			$this->load->view('partials/header', $header);
			$this->load->view('styles/search');
			$this->load->view('partials/navbar', $requests);
			$this->load->view('search', array('data' => $data, 'sample_types' => $types, 'countries' => $countries, 'institutions' => $institutions));
			$this->load->view('partials/footer');
		} // end else
	} // end of method

//user clicks browse, pulls the data and loads the search results page
	public function browse()
	{
		if ($this->session->userdata('logged_in') != TRUE) {
		// if they are not logged in this is restricted
			redirect('/restricted');
		} else { 
			// get samples for them to browse based on their set up preferences
			$this->load->model('sample');
			$this->load->model('login');
			$countries = $this->login->countries();
			//$user = $this->session->userdata('id');
			$types = $this->sample->get_sample_types();
			$locations = $this->sample->get_locations();
			$institutions = $this->sample->get_institutions();
			$tagged_values = $this->sample->browse();
			$header['title'] = 'Search';
			$requests['count'] = count($this->session->userdata['requested_sample_id']);

			$this->load->view('partials/header', $header);
			$this->load->view('styles/search');
			$this->load->view('partials/navbar', $requests);
			$this->load->view('search', array('data' => $tagged_values, 'sample_types' => $types, 'countries' => $countries, 'institutions' => $institutions));
			$this->load->view('partials/footer');
		} // end else
	} // end of method

/* !!!!!!!!!!!!!!!!!! Methods concerning the ONE SAMPLE !!!!!!!!!!!!!!!!!! */

// user wants to see a sample's profile page
	public function view_sample($id)
	{
		if ($this->session->userdata('logged_in') != TRUE) {
		// if they are not logged in this is restricted
			redirect('/restricted');
		} else { 
			$this->load->model('sample');
			$data = $this->sample->view($id);
			if (empty($data)) { $header['title'] = 'Sample Not Found'; }
			else {$header['title'] = 'View ' . $data['Genus'] . ' ' . $data['Species']; }		
			$requests['count'] = count($this->session->userdata['requested_sample_id']);

			$this->load->view('partials/header', $header);
			$this->load->view('styles/sample_profile');
			$this->load->view('partials/navbar', $requests);		
			$this->load->view('sample_profile', array('data' => $data));
			$this->load->view('partials/footer');
		} // end else
	} // end of method

// user wants to edit their own single sample
	public function update($id)
	{

	} // end of method

// user wants to delete selected sample(s)
	public function delete()
	{

	} // end of method

// user wants to request a sample
	public function request_sample()
	{
		$this->load->model('sample');
		$selection = $this->input->post();
		return $this->sample->request($selection);
		// foreach ($this->input->post() as $key) {
		// 	array_push($this->session->userdata['requested_sample_id'], $key);
		// }
	} // end of method
}