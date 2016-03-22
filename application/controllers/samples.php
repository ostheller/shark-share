<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Samples extends CI_Controller {
/* this controller is for INDIVIDUAL SAMPLE INTERACTION, e.g. the search, display and manipulation of the samples */

/* !!!!!!!!!!!!!!!!!! Methods concerning the SEARCH !!!!!!!!!!!!!!!!!! */

// user enters a keyword search
	public function search()
	{
		$post = $this->input->post();
		$data = $this->sample->search($post);
		
		$this->load->view('partials/header');
		$this->load->view('partials/navbar');
		$this->load->view('search', $data);
		$this->load->view('partials/footer');
	} // end of method

// user uses the advanced search functionality
	public function advanced_search()
	{
		$post = $this->input->post();
		$data = $this->sample->search($post);
		
		$this->load->view('partials/header');
		$this->load->view('partials/navbar');
		$this->load->view('search', $data);
		$this->load->view('partials/footer');
	} // end of method

//user clicks browse, pulls the data and loads the search results page
	public function browse()
	{
		$this->load->view('partials/header');
		$this->load->view('partials/navbar');
		$this->load->view('search');
		$this->load->view('partials/footer');
	} // end of method

/* !!!!!!!!!!!!!!!!!! Methods concerning the ONE SAMPLE !!!!!!!!!!!!!!!!!! */

// user wants to see a sample's profile page
	public function view_sample()
	{
		$this->load->view('partials/header');
		$this->load->view('partials/navbar');		
		$this->load->view('sample_profile');
		$this->load->view('partials/footer');
	} // end of method

}