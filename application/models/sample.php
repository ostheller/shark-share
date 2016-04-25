<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sample extends CI_Model {
/* this model's methods interact with the database to display and edit a single sample's data. It also handles both keyword and advanced searching, as well as a browse function based on the
user's preset preferences */

/* !!!!!!!!!!!!!!!!!! Maintenance & Display !!!!!!!!!!!!!!!!!! */ 

// method to update sample data
	public function update($sample)
	{
		$taxonomy_id = $this->db->query("SELECT id FROM taxonomy WHERE taxonomy_genus = ?, taxonomy_species = ?, taxonomy_family = ?, taxonomy_order = ?", array($sample['genus'], $sample['species'], $sample['family'], $sample['order']));
		$sample_type_id = $this->db->query("SELECT id FROM sample_types WHERE type = ?", $sample['type']);
		$preservation_medium_id = $this->db->query("SELECT id FROM preservation_mediums WHERE medium = ?", $sample['medium']);
		$whole_specimen_id = $this->db->query("SELECT id FROM whole_specimens WHERE tag_id = ?", $sample['tag_id']);
		// update the location table
		$loc_data = array(
		               $sample['region'],
		               $sample['lat_degree'],
		               $sample['long_degree'],
		               $sample['lat_decimal'],
		               $sample['location_id']
		            );
		$loc_query = "UPDATE locations
		SET region = ?, lat_degree = ?, long_degree = ?, lat_decimal = ?,
		loc.long_decimal as 'Long.Decimal'
		WHERE id = ?";
		$this->db->query($loc_query, $loc_data);
		
		// update the sample table
		$samp_data = array(
			           $taxonomy_id,
			           $sample_type_id,
			           $preservation_medium_id,
			           $sample['photo'],
			           $sample['sample_size_mm'],
			           $sample['available_until'],
			           $sample['comments'],
			           $whole_specimen_id,
			           $sample['location_id'],
			           $sample['user_id'],
			           $sample['sample_id'],
			        );
		$samp_query = "UPDATE samples 
			SET taxonomy_id = ?, sample_type_id = ?, preservation_medium_id = ?, photo = ?, sample_size_mm = ?, available_until = ?, comments = ?, whole_specimen_id = ?, location_id = ?, user_id = ?, lab_id = ? 
			WHERE id = ?";	
		if($this->db->query($query, $data)) {
			return $this->db->insert_id();
		} else { 
			return FALSE;
		}
	}

// method to delete sample
    public function destroy($id)
    {
        $this->db->delete('samples', array('id' => $id));
	}

// method to view a single sample
		public function view($id)
	{
		$query = "SELECT taxo.taxonomy_genus as 'Genus', taxo.taxonomy_species as 'Species', stypes.type as 'Sample Type', sexes.sex as 'Sex', 
		pres.preservation_medium as 'Preservation Medium', samp.photo as 'Photo Available', samp.sample_size_mm as 'Size (mm)', samp.available_until as 'Avail. Until', 
		samp.comments as 'Comments', loc.region as 'Region', loc.lat_degree as 'Lat. Degree', loc.long_degree as 'Long. Degree', loc.lat_decimal as 'Lat. Decimal',
		loc.long_decimal as 'Long.Decimal', coun.name as 'Current Country Location', us.id as 'User id', us.first_name as 'First Name', us.last_name as 'Last Name', i.name as 'Institution Name', i.city as 'Institution City'
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
			LEFT JOIN users as us
				ON samp.user_id = us.id
			LEFT JOIN institutions as i
				ON us.institution_id = i.id
			WHERE samp.id = ?";
        return $this->db->query($query, $id)->row_array();
	} // end of method


/* !!!!!!!!!!!!!!!!!! Searching !!!!!!!!!!!!!!!!!! */

// method to autofill genus bar
public function get_genus() 
	{
		return $this->db->query("SELECT DISTINCT taxonomy_genus FROM taxonomy")->result_array();
	}
public function get_species() 
	{
		return $this->db->query("SELECT DISTINCT taxonomy_species FROM taxonomy")->result_array();
	}
public function get_family() 
	{
		return $this->db->query("SELECT DISTINCT taxonomy_family FROM taxonomy")->result_array();
	}
public function get_order() 
	{
		return $this->db->query("SELECT DISTINCT taxonomy_order FROM taxonomy")->result_array();
	}



// method to generate sample type dropdown
public function get_sample_types() 
	{
		$query = "SELECT * FROM sample_types";
	    return $this->db->query($query)->result_array();
	}
// method to generate location dropdown
public function get_locations() 
	{
		$query = "SELECT * FROM locations";
	    return $this->db->query($query)->result_array();
	}

// method to generate institution dropdown
public function get_institutions() 
	{
		$query = "SELECT * FROM institutions";
	    return $this->db->query($query)->result_array();
	}

// method to search
	public function search($post) {
		$genus = $post['genus'];
		$species = $post['species'];
		//$family = $post['family'];
		//$order = $post['order'];
		$sample_type = $post['sample_type_id'];
		$country = $post['country_id'];
		$gender = $post['gender'];
		$name = $post['name'];
		$institution = $post['institution_id'];

		$condition_array = array();

		if ($genus != '') {
			$condition_array[] = "taxo.taxonomy_genus = '$genus'";
		}
		if ($species != '') {
			$condition_array[] = "taxo.taxonomy_species = '$species'";
		}
		// if ($family != '') {
		// 	$condition_array[] = "taxonomy.taxonomy_family = '$family'";
		// }
		// 	if ($order != '') {
		// 	$condition_array[] = "taxonomy.taxonomy_order = '$order'";
		// }
		if ($sample_type != '') {
			$condition_array[] = "samp.sample_type_id = $sample_type";
		}
		if ($country != '') {
			$condition_array[] = "samp.country_id = '$country'";
		}
		if ($gender != '') {
			$condition_array[] = "whol.sex_id = $gender";
		}
		if ($name != '') {
			$condition_array[] = "(us.first_name LIKE '&$name&' OR us.last_name LIKE '&$name&')";
		}
		if ($institution != '') {
			$condition_array[] = "us.institution_id = '$institution'";
		}

		if(count($condition_array) > 0) {
		$query = "SELECT samp.id as 'id', taxo.taxonomy_genus as 'Genus', taxo.taxonomy_species as 'Species', stypes.type as 'Sample Type', sexes.sex as 'Sex', pres.preservation_medium as 'Preservation Medium', samp.photo as 'Photo Available', samp.sample_size_mm as 'Size (mm)', samp.available_until as 'Avail. Until', samp.comments as 'Comments', loc.region as 'Region', loc.lat_degree as 'Lat. Degree', loc.long_degree as 'Long. Degree', loc.lat_decimal as 'Lat. Decimal', loc.long_decimal as 'Long.Decimal', coun.name as 'Current Country Location', us.id as 'User id', us.first_name as 'First Name', us.last_name as 'Last Name', i.name as 'Institution Name', i.city as 'Institution City' 
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
			LEFT JOIN users as us
				ON samp.user_id = us.id
			LEFT JOIN institutions as i
				ON us.institution_id = i.id
			WHERE ".implode(' AND ', $condition_array);
		}
		$data = $this->db->query($query)->result_array();
		return $data;
	 } // end of method

// method to get the data to browse, based on the preferences of the user
	public function browse($id) {
		$query = "SELECT samp.id as 'id', taxo.taxonomy_genus as 'Genus', taxo.taxonomy_species as 'Species', stypes.type as 'Sample Type', sexes.sex as 'Sex', 
		pres.preservation_medium as 'Preservation Medium', samp.photo as 'Photo Available', samp.sample_size_mm as 'Size (mm)', samp.available_until as 'Avail. Until', 
		samp.comments as 'Comments', loc.region as 'Region', loc.lat_degree as 'Lat. Degree', loc.long_degree as 'Long. Degree', loc.lat_decimal as 'Lat. Decimal',
		loc.long_decimal as 'Long.Decimal', coun.name as 'Current Country Location', us.id as 'User id', us.first_name as 'First Name', us.last_name as 'Last Name', i.name as 'Institution Name', i.city as 'Institution City'
			FROM tags
			LEFT JOIN taxonomy as taxo
				ON tags.taxonomy_id = taxo.id
			LEFT JOIN samples as samp
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
			LEFT JOIN users as us
				ON samp.user_id = us.id
			LEFT JOIN institutions as i
				ON us.institution_id = i.id
			WHERE ";
        return $this->db->query($query)->result_array();
	} // end of method


// method for entering a request into the database
public function request($selection) 
	{
		$return = array(
			'exists' => array(),
			'inserted' => array()
			);
		foreach ($selection['sample_id'] as $id) {
			$check_query = "SELECT * FROM requests WHERE user_id = ? AND sample_id = ?";
			$check_values = array(
					$this->session->userdata('id'),
		  			intval($id));
			$check = $this->db->query($check_query, $check_values)->result_array();
			if (count($check) >= 1) {
				$return['exists'][] = $id;
			} else {
				$query = "INSERT INTO requests (user_id, sample_id, status_id) VALUES (?,?,1)";
				$values = array(
		  			$this->session->userdata('id'),
		  			intval($id)
		  			);
		  		$this->db->query($query, $values);
		  		$return['inserted'][] = $id;
			}
		}
		return $return;
		// $query = "INSERT INTO requests (user_id, sample_id, status_id) VALUES (?,?,1)
  // 			ON DUPLICATE KEY UPDATE status_id =1;";
  // 		if (empty($selection['sample_id'])){
  // 			echo "EMPTY";	
	 //  		} else {
	 //  		for ($i=0; $i < count($selection['sample_id']); $i++) { 
	 //  			$values = array(
		//   			$this->session->userdata('id'),
		//   			intval($selection['sample_id'][$i])
		//   			);
		//   		$this->db->query($query, $values);
		//   		} 	
	 //  	};
  		echo json_encode($this->db->query("SELECT * FROM requests WHERE user_id = ? AND status_id = 1", $this->session->userdata('id'))->result_array());
	} // end of method

// method for counting a user's request
	public function count_requests($id) 
	{
		$count = $this->db->query("SELECT DISTINCT id FROM requests WHERE user_id = ? AND status_id = 1", $id)->result_array();
		return $count;
	}

// method for showing a user's requests
	public function get_requests($id) 
	{
		$query = "SELECT DISTINCT 
			u.first_name as 'user_first_name',
			u.last_name as 'user_last_name',
			u.email as 'user_email',
			i.name as 'user_institution_name',
			i.city as 'user_institution_city',
			samp.id as 'id', 
			taxo.taxonomy_genus as 'genus', 
			taxo.taxonomy_species as 'species', 
			stypes.type as 'sample_type', 
			sexes.sex as 'sex', 
			pres.preservation_medium as 'preservation_medium', 
			samp.photo as 'photo_available', 
			samp.sample_size_mm as 'size_mm', 
			samp.available_until as 'avail_until', 
			samp.comments as 'sample_comments', 
			loc.region as 'sample_region', 
			loc.lat_degree as 'sample_lat_degree', 
			loc.long_degree as 'sample_long_degree', 
			loc.lat_decimal as 'sample_lat_decimal', 
			loc.long_decimal as 'sample_long_decimal', 
			coun.name as 'sample_current_country', 
			us.id as 'sample_user_id', 
			us.first_name as 'sample_first_name', 
			us.last_name as 'sample_last_name', 
			i.name as 'sample_institution_name', 
			i.city as 'sample_institution_city'
		FROM requests as req
		LEFT JOIN users as u
			ON req.user_id = u.id
		LEFT JOIN institutions as i
			ON u.institution_id = i.id
		LEFT JOIN samples as samp
			ON req.sample_id = samp.id
		LEFT JOIN request_statuses as stat
			ON req.status_id = stat.id
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
		LEFT JOIN users as us
			ON samp.user_id = us.id
		WHERE req.user_id = ? AND req.status_id = 1";
		return $this->db->query($query, $id)->result_array();
	}
} // end of model ?>