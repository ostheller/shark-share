<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Collection extends CI_Model {
/* this model's methods interact with the database to upload batches of samples (and assign them into a particular user's collection), pulling the data for viewing a particular collection, deleting samples from a collection */

	public function view($id)
	{
		$query = "SELECT taxo.taxonomy_genus as 'Genus', taxo.taxonomy_species as 'Species', stypes.type as 'Sample Type', sexes.sex as 'Sex', 
		pres.preservation_medium as 'Preservation Medium', pho.status as 'Photo Available', samp.sample_size_mm as 'Size (mm)', samp.available_until as 'Avail. Until', 
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
			LEFT JOIN photo_statuses as pho
				ON samp.photo_status_id = pho.id
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
		//validate_data($data);
		return $data;
	} // end of method

// submit data to database
	public function submit_data($data) {
		end($data);
		$key = key($data);
		$counter = intval(filter_var($key, FILTER_SANITIZE_NUMBER_INT));

		// need to loop through each of the rows to insert  
		for($i=2; $i<=$counter; $i++) {
		if($data[$i."_genus"] == NULL) {
			continue;
		} else {
	// set up data, get ids for foreign keys	
		// get taxonomy id to insert into the sample
		$taxonomy_values = array(
			$data[$i."_genus"],
     		$data[$i."_species"],
     		$data[$i."_family"], 
         	$data[$i."_order"]
     		);

		$taxonomy_query = $this->db->query("SELECT id as 'id' FROM taxonomy WHERE taxonomy_genus = ? AND taxonomy_species = ? AND taxonomy_family = ? AND taxonomy_order = ?", $taxonomy_values)->row_array();
		$taxonomy_id = intval($taxonomy_query['id']);


		$sex_value = $data[$i."_sex"];
		$sex_query = $this->db->query("SELECT id as 'id' FROM sexes WHERE sex = ?", $sex_value)->row_array();
		$sex_id = intval($sex_query['id']);


		$sample_type_value = $data[$i."_sample_type"];
		$sample_type_query = $this->db->query("SELECT id as 'id' FROM sample_types WHERE type = ?", $sample_type_value)->row_array();
		$sample_type_id = intval($sample_type_query['id']);


		$preservation_medium_value = $data[$i."_preservation_medium"];
		$preservation_medium_query = $this->db->query("SELECT id as 'id' FROM preservation_mediums WHERE preservation_medium = ?", $preservation_medium_value)->row_array();
		$preservation_medium_id = intval($preservation_medium_query['id']);

        $photo_status_value = $data[$i."_photo"];
        $photo_status_query = $this->db->query("SELECT id as 'id' FROM photo_statuses WHERE status = ?", $photo_status_value)->row_array();
        $photo_status_id = intval($photo_status_query['id']);

        $sample_size_mm = $data[$i."_sample_size"];

        $location_stored_value = $data[$i."_location_stored"];
        $location_stored_query = $this->db->query("SELECT id as 'id' FROM countries WHERE name = ?", $location_stored_value)->row_array();
        $location_stored_id = intval($location_stored_query['id']);

        $available_until = (($data[$i."_avail_until"]*86400)-2209075200);

        $specimen_size_number = $data[$i."_specimen_size_number"];

        $specimen_size_unit_value = $data[$i."_specimen_size_unit"];
        $specimen_size_unit_query = $this->db->query("SELECT id as 'id' FROM units WHERE unit = ?", $specimen_size_unit_value)->row_array();
        $specimen_size_unit_id = intval($specimen_size_unit_query['id']);

        $specimen_size_type_value = $data[$i."_specimen_size_type"];
        $specimen_size_type_query = $this->db->query("SELECT id as 'id' FROM measurement_types WHERE type = ?", $specimen_size_type_value)->row_array();
		$specimen_size_type_id = intval($specimen_size_type_query['id']);

        $specimen_identifier_id = $data[$i."_specimen_identifier"];

        $sample_identifier_id = $data[$i."_sample_tag_id"];

        $ocean_collected = $data[$i."_ocean_collected"];
        $ocean_collected_query = $this->db->query("SELECT id as 'id' FROM oceans WHERE name = ?", $ocean_collected)->row_array();
        $ocean_collected_id = intval($ocean_collected_query['id']);

        $region_collected_value = $data[$i."_region_collected"];

        $lat_decimal = $data[$i."_lat_dec"];
        $long_decimal = $data[$i."_long_dec"];

        $lat_degree = $data[$i."_lat_deg"];
        $long_degree = $data[$i."_long_deg"];

        $date_tagged = (($data[$i."_date_tagged"]*86400)-2209075200);

        $lab_identifier = $data[$i."_lab_id"];

		$comment = $data[$i."_comment"];

		$user_id = $this->session->userdata('id');

	// insert into the database
		// insert region into database
		$region_array = array($region_collected_value, $ocean_collected_id, $lat_degree, $long_degree, $lat_decimal, $long_decimal);
		$this->db->query("INSERT INTO locations (region, ocean_id, lat_degree, long_degree, lat_decimal, long_decimal) VALUES (?,?,?,?,?,?)", $region_array);
		//$region_id = $this->db->query("SELECT id as 'id' FROM locations WHERE region = ? AND ocean_id = ? AND lat_degree = ? AND long_degree = ? AND lat_decimal = ? AND long_decimal = ?", $region_array)->row_array();
		$region_id = $this->db->insert_id();
		
		// insert sample into database
		$insert_query = "INSERT INTO samples 
			(taxonomy_id, sample_type_id, preservation_medium_id, photo_status_id, sample_size_mm,
			available_until, comments, location_id, country_id, user_id, tag_id, lab_id) VALUES (?,?,?,?,?,FROM_UNIXTIME(?),?,?,?,?,?,?)";
		$insert_values = array(
			$taxonomy_id, $sample_type_id, $preservation_medium_id, $photo_status_id, $sample_size_mm,
			$available_until, $comment, $region_id, $location_stored_id, $user_id, $sample_identifier_id, $lab_identifier);
		$this->db->query($insert_query, $insert_values);
		$lastid = $this->db->insert_id();

		// check to see if whole specimen already exists
		$check_whole_specimen_status = $this->db->query("SELECT id as 'id' FROM whole_specimens WHERE identification_id = ?", $specimen_identifier_id)->row_array();
		if($check_whole_specimen_status != NULL) {
			$this->db->query("INSERT INTO specimen_samples (sample_id, specimen_id) VALUES (?,?)", array($lastid, $check_whole_specimen_status['id']));
			$whole_specimen_id = $this->db->insert_id();
			$this->db->query("UPDATE samples SET whole_specimen_id = ? WHERE id = ?", array($whole_specimen_id, $lastid));
        } else {
        	$specimen_values = array($sex_id, $specimen_size_number, $specimen_size_unit_id, $specimen_size_type_id, $date_tagged, $ocean_collected_id, $specimen_identifier_id);
        	$this->db->query("INSERT INTO whole_specimens (sex_id, size_num, unit_id, measurement_type_id, date_tagged, ocean_id, identification_id) VALUES (?,?,?,?,FROM_UNIXTIME(?),?,?)", $specimen_values);
        	$whole_specimen_id = $this->db->insert_id();
        	$this->db->query("UPDATE samples SET whole_specimen_id = ? WHERE id = ?", array($whole_specimen_id, $lastid));
        }

     	}// end for loop      
    } // end else
    return TRUE;
	} // end of method
} // end of model ?>