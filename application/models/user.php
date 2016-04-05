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

// method to find the user with the email generated token in order to set up their profile
	public function check_token($token)
	{
		$query = "SELECT * FROM potential_users WHERE token = ?"
		return $this->db->query($query, $token)->row_array();
	}

// method to create user
	public function create($user)
	{
		$query = ""
		$values = array();
		if($this->db->query($query, $user)) {
			return $this->db->insert_id();
		} else { 
			return FALSE;
		}
	}

// method to associate tagged preferences
	public function create_tags($post)
	{
		$query = ""
		$values = array();
		if($this->db->query($query, $user)) {
			return $this->db->insert_id();
		} else { 
			return FALSE;
		}
	}

// method to update user data
	public function update($user)
	{
		$query = ""
		$values = array();
		if($this->db->query($query, $user)) {
			return $this->db->insert_id();
		} else { 
			return FALSE;
		}
	}

// method to update tagged preferences
	public function update_tags($user)
	{
		$query = ""
		$values = array();
		if($this->db->query($query, $user)) {
			return $this->db->insert_id();
		} else { 
			return FALSE;
		}
	}

// method to delete user
	public function destroy($id)
	{
		$this->db->delete('users', array('id' => $id));
	}

// method to delete preferences
	public function destroy_tags($user)
	{
		$query = ""
		$values = array();
		if($this->db->query($query, $user)) {
			return $this->db->insert_id();
		} else { 
			return FALSE;
		}
	}
} // end of model ?>