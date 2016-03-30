<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sample extends CI_Model {
/* this model's methods interact with the database to display and edit a single sample's data. It also handles both keyword and advanced searching, as well as a browse function based on the
user's preset preferences */

/* !!!!!!!!!!!!!!!!!! Viewing !!!!!!!!!!!!!!!!!! */
public function view($id) {
	$query = "SELECT * FROM samples WHERE id = ?;";
	$value = array($id);
    return $this->db->query($query, $value)->row_array();
}

/* !!!!!!!!!!!!!!!!!! Searching !!!!!!!!!!!!!!!!!! */

// method to do a keyword search
	public function search($post) {

		return $data;
	}

// method to do an advanced search
	public function advanced_search($post) {

		return $data;
	}

// method to get the data to browse, based on the preferences of the user
	public function browse() {
		$query = "SELECT * FROM samples LIMIT 20;";
        return $this->db->query($query)->result_array();
	}
} // end of model ?>