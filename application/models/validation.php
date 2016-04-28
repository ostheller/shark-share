<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Validation extends CI_Model {

/* this model's methods interact with the database to ensure the correct data is uploaded */

// these methods are for generic data types
	public	function check_alphanumeric($data)
	{
		// Check to make sure alphanumeric and not scripting
	} // end of method

	public function check_numeric($data)
	{

	} // end of method

	public function check_date($data)
	{
		// Check to make sure numeric and not scripting
	} // end of method

	public function check_decimal($data)
	{

	} // end of method


	public function check_degree($data)
	{

	} // end of method

// these methods are to validate against lists
	public function genus($data)
	{
		$genuses = $this->db->query('SELECT taxonomy_genus FROM taxonomy')->result_array($data);
		if (in_array(ucfirst($data), $genuses) == TRUE) {
			return TRUE;
		} else {
			return FALSE;
		}
	} // end of method

	public function species($data)
	{
		$species = $this->db->query('SELECT taxonomy_species FROM taxonomy')->result_array($data);
	} // end of method

	public function family($data)
	{
		$family = $this->db->query('SELECT taxonomy_family FROM taxonomy')->result_array($data);
	} // end of method

	public function order($data)
	{
		$order = $this->db->query('SELECT taxonomy_order FROM taxonomy')->result_array($data);
	} // end of method

	public function sex($data)
	{
		$sexes = array('Female', 'Male', 'Unspecified');
	} // end of method

	public function sample_type($data)
	{
		$sample_types = array('Fin Clipping', 'Fin Spine', 'Liver', 'Muscle Tissue', 'Stomach', 'Vertebrae', 'Whole Specimen', 'Other');
	} // end of method

	public function specimen_size_unit($data)
	{
		$units = array('mm', 'cm', 'm');
	} // end of method

	public function specimen_size_type($data)
	{
		$types = array('Disc Width', 'Fork Length', 'Pre Caudal Length', 'Stretch Total Length', 'Other');
	} // end of method


	public function preservation_medium($data)
	{
		$mediums = array('DMSO', 'Dry', 'Ethanol', 'Formaldehyde', 'Freeze dried', 'Frozen', 'Liquid Nitrogen', 'Other');
	} // end of method


	public function ocean_tagged($data)
	{
		$oceans = array('Arctic', 'Atlantic', 'Indian', 'Pacific', 'Southern');
	} // end of method

	public function photo_available($data)
	{
		$photo = array('Yes', 'No');
	} // end of method

	// this method validates all of the form at once
	public function validate_all($data)
	{
		$genuses = array();
		$species = array();
		$family = array();
		$order = array();
		$genuses_list = $this->db->query('SELECT taxonomy_genus FROM taxonomy')->result_array();
			foreach ($genuses_list as $genus => $value) {
				array_push($genuses, $value['taxonomy_genus']);
			}
		$species_list = $this->db->query('SELECT taxonomy_species FROM taxonomy')->result_array();
			foreach ($species_list as $a_species => $value) {
				array_push($species, $value['taxonomy_species']);
			}
		$family_list = $this->db->query('SELECT taxonomy_family FROM taxonomy')->result_array();
			foreach ($family_list as $a_family => $value) {
				array_push($family, $value['taxonomy_family']);
			}
		$order_list = $this->db->query('SELECT taxonomy_order FROM taxonomy')->result_array();
			foreach ($order_list as $an_order => $value) {
				array_push($order, $value['taxonomy_order']);
			}
		$sexes = array('Female', 'Male', 'Unspecified');
		$sample_types = array('Fin Clipping', 'Fin Spine', 'Liver', 'Muscle Tissue', 'Stomach', 'Vertebrae', 'Whole Specimen', 'Other');
		$units = array('mm', 'cm', 'm');
		$types = array('Disc Width', 'Fork Length', 'Pre Caudal Length', 'Stretch Total Length', 'Other');
		$mediums = array('DMSO', 'Dry', 'Ethanol', 'Formaldehyde', 'Freeze dried', 'Frozen', 'Liquid Nitrogen', 'Other');
		$oceans = array('Arctic', 'Atlantic', 'Indian', 'Pacific', 'Southern');
		$photo = array('Yes', 'No');

		end($data);
		$key = key($data);
		$counter = intval(filter_var($key, FILTER_SANITIZE_NUMBER_INT));
		
		$error_array['error'] = array();
		$error_array['valid'] = array();

		for($i=2; $i<=$counter; $i++) {
			// genus
			if(in_array($data[$i."_genus"], $genuses) == FALSE) {array_push($error_array['error'], $i."_genus");}
				else {array_push($error_array['valid'], $i."_genus");}
			if(in_array($data[$i."_species"], $species) == FALSE) {array_push($error_array['error'], $i."_species");}
				else {array_push($error_array['valid'], $i."_species");}
			if(in_array($data[$i."_family"], $family) == FALSE) {array_push($error_array['error'], $i."_family");}
				else {array_push($error_array['valid'], $i."_family");}
			if(in_array($data[$i."_order"], $order) == FALSE) {array_push($error_array['error'], $i."_order");}
				else {array_push($error_array['valid'], $i."_order");}
			if(in_array($data[$i."_sex"], $sexes) == FALSE) {array_push($error_array['error'], $i."_sex");}
				else {array_push($error_array['valid'], $i."_sex");}
			if(in_array($data[$i."_sample_type"], $sample_types) == FALSE) {array_push($error_array['error'], $i."_sample_type");}
				else {array_push($error_array['valid'], $i."_sample_type");}
			if(in_array($data[$i."_specimen_size_unit"], $units) == FALSE) {array_push($error_array['error'], $i."_specimen_size_unit");}
				else {array_push($error_array['valid'], $i."_specimen_size_unit");}
			if(in_array($data[$i."_specimen_size_type"], $types) == FALSE) {array_push($error_array['error'], $i."_specimen_size_type");}
				else {array_push($error_array['valid'], $i."_specimen_size_type");}
			if(in_array($data[$i."_preservation_medium"], $mediums) == FALSE) {array_push($error_array['error'], $i."_preservation_medium");}
				else {array_push($error_array['valid'], $i."_preservation_medium");}
			if(in_array($data[$i."_ocean_collected"], $oceans) == FALSE) {array_push($error_array['error'], $i."_ocean_collected");}
				else {array_push($error_array['valid'], $i."_ocean_collected");}
			if(in_array($data[$i."_photo"], $photo) == FALSE) {array_push($error_array['error'], $i."_photo");}
				else {array_push($error_array['valid'], $i."_photo");}
			};
		
		return $error_array;
	} // end of method

}// end of model