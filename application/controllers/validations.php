<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Validations extends CI_Controller {
/* this controller is for all the upload validation functions */

// these methods are for generic data types
	public function check_alphanumeric()
	{
		$this->load->model('validation');	
		$post = $this->input->post();
		$this->validation->check_alphanumeric($post);
	} // end of method

	public function check_numeric()
	{
		$this->load->model('validation');	
		$post = $this->input->post();
		$this->validation->check_numeric($post);
	} // end of method

	public function check_date()
	{
		$this->load->model('validation');		
		$post = $this->input->post();
		$this->validation->check_date($post);
	} // end of method

	public function check_decimal()
	{
		$this->load->model('validation');		
		$post = $this->input->post();
		$this->validation->check_decimal($post);
	} // end of method

	public function check_degree()
	{
		$this->load->model('validation');		
		$post = $this->input->post();
		$this->validation->check_degree($post);
	} // end of method

// these methods are to validate against lists
	public function genus()
	{
		$this->load->model('validation');
		$post = $this->input->post();
		$this->validation->genus($post);
	} // end of method

	public function species()
	{
		$this->load->model('validation');	
		$post = $this->input->post();
		$this->validation->species($post);
	} // end of method

	public function family()
	{
		$this->load->model('validation');
		$post = $this->input->post();
		$this->validation->family($post);
	} // end of method

	public function order()
	{
		$this->load->model('validation');
		$post = $this->input->post();
		$this->validation->order($post);
	} // end of method

	public function sex()
	{
		$this->load->model('validation');
		$post = $this->input->post();	
		$this->validation->sex($post);
	} // end of method

	public function sample_type()
	{
		$this->load->model('validation');		
		$post = $this->input->post();
		$this->validation->sample_type($post);
	} // end of method

	public function specimen_size_unit()
	{
		$this->load->model('validation');		
		$post = $this->input->post();
		$this->validation->specimen_size_unit($post);
	} // end of method

	public function specimen_size_type()
	{
		$this->load->model('validation');		
		$post = $this->input->post();
		$this->validation->specimen_size_type($post);
	} // end of method


	public function preservation_medium()
	{
		$this->load->model('validation');		
		$post = $this->input->post();
		$this->validation->preservation_medium($post);
	} // end of method


	public function ocean_tagged()
	{
		$this->load->model('validation');		
		$post = $this->input->post();
		$this->validation->ocean_tagged($post);
	} // end of method

	public function photo_available()
	{
		$this->load->model('validation');		
		$post = $this->input->post();
		$this->validation->photo_available($post);
	} // end of method

// this method validates all of the form at once
	public function validate_all()
	{
		$this->load->model('validation');		
		$post = $this->input->post();
		echo json_encode($this->validation->validate_all($post));
	} // end of method
} // end of controller