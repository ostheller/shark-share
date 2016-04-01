<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Model {
/* this model's methods interact with the database to display and edit a single user's data, it also handles pulling the data to display for their dashboards. It also takes care of the admin dashboard's data needs */

// method to get the data for a single user
	public function view($id) {
		$query = "SELECT u.id, u.first_name, u.last_name, i.name, i.city, a_s.status FROM users as u
		LEFT JOIN institutions as i 
		ON u.institution_id = i.id 
		LEFT JOIN academic_statuses as a_s
		ON u.academic_status_id = a_s.id
		WHERE u.id = ?";
        $values = $id;
        return $this->db->query($query, $values)->row_array();
	}
} // end of model ?>