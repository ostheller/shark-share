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
		$query = "SELECT u.id as 'id', u.first_name as 'First Name', u.last_name as 'Last Name', u.email as 'Email', u.field as 'Field', i.name as 'Institution Name', i.city as 'Institution City', a_s.status as 'Academic Status', u.reference_name as 'Reference Name', u.reference_email as 'Reference Email', u.token as 'Token' FROM potential_users as u
		LEFT JOIN institutions as i 
		ON u.institution_id = i.id 
		LEFT JOIN academic_statuses as a_s
		ON u.academic_status_id = a_s.id";
		return $this->db->query($query)->result_array();
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

// method to view one potential 
	public function view_potential($id)
	{
		$query = "SELECT u.id as 'id', u.first_name as 'First Name', u.last_name as 'Last Name', u.email as 'Email', u.field as 'Field', i.name as 'Institution Name', i.city as 'Institution City', a_s.status as 'Academic Status', u.reference_name as 'Reference Name', u.reference_email as 'Reference Email', u.token as 'Token' FROM potential_users as u
		LEFT JOIN institutions as i 
		ON u.institution_id = i.id 
		LEFT JOIN academic_statuses as a_s
		ON u.academic_status_id = a_s.id
		WHERE u.id = ?";
		return $this->db->query($query, $id)->row_array();
	} // end of method

// method to for user to set up their profile, with username, password and about themselves, get an automatic user level of 0 (not admin)
	public function create_user($post)
    {
        for ($i=0; $i < count($post['id']); $i++) { 
            $id = intval($post['id'][$i]);
            // get the data about the potential user
                $user_query = "SELECT * FROM potential_users WHERE id=?";
                $user = $this->db->query($user_query, $id)->row_array();
                $institution = $this->db->query("SELECT id FROM institutions WHERE name = ?", $user['institution']);
           // first add to new users
                $admit_query  = "INSERT INTO users (user_name, level, email, password, first_name, last_name, about_user, institution_id, status_id) VALUES (?,?,?,?,?,?,?,?,?)";
                $values = array('NOT SET', 0, $user['email'],'TEMP',$user['first_name'], $user['first_name'], $institution, $user['status_id']); 
            // then delete from potential users
            $delete_query = "DELETE FROM potential_users WHERE id=?";
            $this->db->query($delete_query, $id);
        }
    } // end of method

	public function setup_user_info($post)
	{
		$this->form_validation->set_rules("username", "Username", "required|alpha|trim");
        $this->form_validation->set_rules("password", "Password", "trim|required|min_length[7]|md5");
        $this->form_validation->set_rules("passconf", "Confirm Password", "required|matches[password]");
        $this->form_validation->set_rules("about", "About", "required|alpha|trim");
        if($this->form_validation->run() === FALSE) // i.e. if there are errors in the above rules
            {
                $this->session->set_flashdata('errors', validation_errors());
                return false;
            }  // end if failure
            else {
                return true;
            }
	} // end of method

// // method to associate tagged preferences
// 		$query = "";
// 		$values = array();
// 		if($this->db->query($query, $user)) {
// 			return $this->db->insert_id();
// 		} else { 
// 			return FALSE;
// 		}
	//} // end of method

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