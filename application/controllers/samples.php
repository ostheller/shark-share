<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Samples extends CI_Controller {
/* this controller is for INDIVIDUAL SAMPLE INTERACTION, e.g. the search, display and manipulation of the samples */

/* !!!!!!!!!!!!!!!!!! Methods concerning the SEARCH !!!!!!!!!!!!!!!!!! */

// user enters a keyword search
	public function search()
	{
		$this->load->model('sample');
		$post = $this->input->post();
		$data = $this->sample->search($post);
		$header['title'] = 'Search';

		$this->load->view('partials/header', $header);
		$this->load->view('partials/navbar');
		$this->load->view('search', $data);
		$this->load->view('partials/footer');
	} // end of method

// user uses the advanced search
	public function advanced_search()
	{
		$this->load->model('sample');
		$post = $this->input->post();
		$data = $this->sample->advanced_search($post);
		$header['title'] = 'Search';

		$this->load->view('partials/header', $header);
		$this->load->view('partials/navbar');
		$this->load->view('search', $data);
		$this->load->view('partials/footer');
	} // end of method

// load the view page
	public function view_search()
	{
		$this->load->model('sample');
		$post = $this->input->post();
		$data = $this->sample->advanced_search($post);
		$header['title'] = 'Search';

		$this->load->view('partials/header', $header);
		$this->load->view('partials/navbar');
		$this->load->view('search', $data);
		$this->load->view('partials/footer');
	} // end of method

//user clicks browse, pulls the data and loads the search results page
	public function browse()
	{
		// get samples for them to browse based on their set up preferences
		$this->load->model('sample');
		//$user = $this->session->userdata('id');
		$data = $this->sample->browse();
		$header['title'] = 'Search';
		$requests['count'] = count($this->session->userdata['requested_sample_id']);

		$this->load->view('partials/header', $header);
		$this->load->view('partials/navbar', $requests);
		$this->load->view('search', array('data' => $data));
		$this->load->view('partials/footer');
	} // end of method

/* !!!!!!!!!!!!!!!!!! Methods concerning the ONE SAMPLE !!!!!!!!!!!!!!!!!! */

// user wants to see a sample's profile page
	public function view_sample($id)
	{
		$this->load->model('sample');
		$data = $this->sample->view($id);
		if (empty($data)) { $header['title'] = 'Sample Not Found'; }
		else {$header['title'] = 'View ' . $data['Genus'] . ' ' . $data['Species']; }		
		$requests['count'] = count($this->session->userdata['requested_sample_id']);

		$this->load->view('partials/header', $header);
		$this->load->view('partials/navbar', $requests);		
		$this->load->view('sample_profile', array('data' => $data));
		$this->load->view('partials/footer');
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
		foreach ($this->input->post() as $key) {
			array_push($this->session->userdata['requested_sample_id'], $key);
		}
	} // end of method
}