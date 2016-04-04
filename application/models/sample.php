<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sample extends CI_Model {
/* this model's methods interact with the database to display and edit a single sample's data. It also handles both keyword and advanced searching, as well as a browse function based on the
user's preset preferences */

/* !!!!!!!!!!!!!!!!!! Searching !!!!!!!!!!!!!!!!!! */ 

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
		$values = $id;
        return $this->db->query($query, $values)->row_array();
    }

/* !!!!!!!!!!!!!!!!!! Searching !!!!!!!!!!!!!!!!!! */

// method to search
	public function search($post) {
		$query = "SELECT u.id, u.first_name, u.last_name, i.name, i.city, a_s.status FROM users as u
			LEFT JOIN institutions as i 
			ON u.institution_id = i.id 
			LEFT JOIN academic_statuses as a_s
			ON u.academic_status_id = a_s.id
			WHERE u.id = ?";
        $values = $id;
        return $this->db->query($query, $values)->result_array();
	} // end of method

// method to get the data to browse, based on the preferences of the user
	public function browse() {
		$query = "SELECT * FROM samples LIMIT 20;";
        return $this->db->query($query)->result_array();
	} // end of method
} // end of model ?>