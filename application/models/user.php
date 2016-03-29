<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Model {
/* this model's methods interact with the database to display and edit a single user's data, it also handles pulling the data to display for their dashboards. It also takes care of the admin dashboard's data needs */

// method to get the data for a single user
	public function view($id) {
		$query = "SELECT * FROM users WHERE id = ?";
        $values = $id;
        return $this->db->query($query, $values)->row_array();
	}
} // end of model ?>