<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Model {
/* this model's methods interact with the database to display and edit a single user's data, it also handles pulling the data to display for their dashboards. It also takes care of the admin dashboard's data needs */

// method to see all users
	public function view_users()
	{
		$query = "SELECT u.id, u.first_name, u.last_name, i.name, i.city, a_s.status FROM users as u
		LEFT JOIN institutions as i 
		ON u.institution_id = i.id 
		LEFT JOIN academic_statuses as a_s
		ON u.academic_status_id = a_s.id";
        return $this->db->query($query)->result_array();
	} // end of method

// method to see all potential users
	public function view_potential_users()
	{
		$query = "SELECT u.id as 'id', u.first_name as 'First Name', u.last_name as 'Last Name', u.email as 'Email', u.field as 'Field', i.name as 'Institution Name', i.city as 'Institution City', a_s.status as 'Academic Status', u.reference_name as 'Reference Name', u.reference_email as 'Reference Email' FROM potential_users as u
		LEFT JOIN institutions as i 
		ON u.institution_id = i.id 
		LEFT JOIN academic_statuses as a_s
		ON u.academic_status_id = a_s.id";
		return $this->db->query($query)->result_array();
	} // end of method

// method to admit a potential user, adding them to the users database and removing from the potential database
	// method to delete user
	public function admit_potential_user($post)
	{
		for ($i=0; $i < count($post['id']); $i++) { 
			$id = intval($post['id'][$i]);
			// first add to new users

			// then delete from potential users
			$delete_query = "DELETE FROM potential_users WHERE id=?";
			$this->db->query($delete_query, $id);
		}
	} // end of method

// method to delete unwanted potential users
	// method to delete user
	public function reject_potential_user($post)
	{
		for ($i=0; $i < count($post['id']); $i++) { 
			$id = intval($post['id'][$i]);
			$query = "DELETE FROM potential_users WHERE id=?";
			$this->db->query($query, $id);
		}
	} // end of method

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
	} // end of method

// method to associate tagged preferences
	public function create_tags($post)
	{
		$query = "";
		$values = array();
		if($this->db->query($query, $user)) {
			return $this->db->insert_id();
		} else { 
			return FALSE;
		}
	} // end of method

// method to update user data
	public function update($user)
	{
		$query = "";
		$values = array();
		if($this->db->query($query, $user)) {
			return $this->db->insert_id();
		} else { 
			return FALSE;
		}
	} // end of method

// method to update tagged preferences
	public function update_tags($user)
	{
		$query = "";
		$values = array();
		if($this->db->query($query, $user)) {
			return $this->db->insert_id();
		} else { 
			return FALSE;
		}
	} // end of method

// method to delete user
	public function destroy($id)
	{
		$this->db->delete('users', array('id' => $id));
	} // end of method

// method to delete preferences
	public function destroy_tags($user)
	{
		$query = "";
		$values = array();
		if($this->db->query($query, $user)) {
			return $this->db->insert_id();
		} else { 
			return FALSE;
		}
	} // end of method
} // end of model ?>