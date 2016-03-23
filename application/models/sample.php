<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sample extends CI_Model {
/* this model's methods interact with the database to display and edit a single sample's data
it also handles both keyword and advanced searching, as well as a browse function based on the
user's preset preferences */

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
	public function browse($user) {

		return $data;
	}
} // end of model ?>