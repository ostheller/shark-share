<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Samples extends CI_Controller {
/* this controller is for INDIVIDUAL SAMPLE INTERACTION, e.g. the search, display and manipulation of the samples */

/* !!!!!!!!!!!!!!!!!! Methods concerning the SEARCH !!!!!!!!!!!!!!!!!! */

// user enters a keyword search
	public function search()
	{
		$post = $this->input->post();
		$data = $this->sample->search($post);
		$data['title'] = 'Search';

		$this->load->view('partials/header', $data);
		$this->load->view('partials/navbar');
		$this->load->view('search', $data);
		$this->load->view('partials/footer');
	} // end of method

// user uses the advanced search functionality
	public function advanced_search()
	{
		$post = $this->input->post();
		$data = $this->sample->advanced_search($post);
		$data['title'] = 'Search';

		$this->load->view('partials/header');
		$this->load->view('partials/navbar');
		$this->load->view('search', $data);
		$this->load->view('partials/footer');
	} // end of method

//user clicks browse, pulls the data and loads the search results page
	public function browse()
	{
		// get samples for them to browse based on their set up preferences
		$user = $this->session->userdata('id');
		$data = $this->sample->browse($user);
		$data['title'] = 'Search';

		$this->load->view('partials/header');
		$this->load->view('partials/navbar');
		$this->load->view('search', $data);
		$this->load->view('partials/footer');
	} // end of method

/* !!!!!!!!!!!!!!!!!! Methods concerning the ONE SAMPLE !!!!!!!!!!!!!!!!!! */

// user wants to see a sample's profile page
	public function view_sample()
	{
		$user = $this->session->userdata('id');
		$data = $this->sample->browse($user);
		$title = 'View ' . $data['genus'] . ' ' . $data['species'];

		$this->load->view('partials/header');
		$this->load->view('partials/navbar');		
		$this->load->view('sample_profile', array($data, $title));
		$this->load->view('partials/footer');
	} // end of method

}