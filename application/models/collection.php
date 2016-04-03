<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Collection extends CI_Model {
/* this model's methods interact with the database to upload batches of samples (and assign them into a particular user's collection), pulling the data for viewing a particular collection, deleting samples from a collection */

	public function view($id)
	{
		$query = "SELECT taxo.taxonomy_genus as 'Genus', taxo.taxonomy_species as 'Species', stypes.type as 'Sample Type', sexes.sex as 'Sex', 
		pres.preservation_medium as 'Preservation Medium', samp.photo as 'Photo Available', samp.sample_size_mm as 'Size (mm)', samp.available_until as 'Avail. Until', 
		samp.comments as 'Comments', loc.region as 'Region', loc.lat_degree as 'Lat. Degree', loc.long_degree as 'Long. Degree', loc.lat_decimal as 'Lat. Decimal',
		loc.long_decimal as 'Long.Decimal', coun.name as 'Current Country Location', samp.id as 'id'
			FROM sharkshare.samples as samp
			LEFT JOIN taxonomy as taxo
				ON samp.taxonomy_id = taxo.id
			LEFT JOIN sample_types as stypes
				ON samp.sample_type_id = stypes.id
			LEFT JOIN preservation_mediums as pres
				ON samp.preservation_medium_id = pres.id
			LEFT JOIN whole_specimens as whol
				ON samp.whole_specimen_id = whol.id
			LEFT JOIN sexes
				ON whol.sex_id = sexes.id
			LEFT JOIN locations as loc
				ON samp.location_id = loc.id
			LEFT JOIN countries as coun
				ON samp.country_id = coun.id
			WHERE user_id = ?";
		$values = $id;
        return $this->db->query($query, $values)->result_array();
    }// end of method

/* !!!!!!!!!!!!!!!!!! Uploading !!!!!!!!!!!!!!!!!! */

// method to read the data out of the excel file and put it into an array
	public function extract_data_xlsx($file) {

		$objPHPExcel = PHPExcel_IOFactory::load($file);
		 
		//get only the Cell Collection
		$cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
		 
		//extract to a PHP readable array format
		foreach ($cell_collection as $cell) {
		    $column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
		    $row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
		    $data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();
		 
		    //header will/should be in row 1 only. of course this can be modified to suit your need.
		    if ($row == 1) {
		        $header[$row][$column] = $data_value;
		    } else {
		        $arr_data[$row][$column] = $data_value;
		    }
		}
		 
		//send the data in an array format
		$data['header'] = $header;
		$data['values'] = $arr_data;
		return $data;
	} // end of method

// method to validate the data prior to submission
	public function validate_data() 
	{
	} // end of method

} // end of model ?>