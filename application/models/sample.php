<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sample extends CI_Model {
/* this model's methods interact with the database to display and edit a single sample's data. It also handles both keyword and advanced searching, as well as a browse function based on the
user's preset preferences */

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