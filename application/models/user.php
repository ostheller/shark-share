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
		$query = "SELECT u.id, u.user_name, u.first_name, u.last_name, u.email, u.date_created as 'date', u.about_user as 'about', u.field, i.name, i.country_id, i.city, u.academic_status_id as 'status', a_s.status as 'status_name' FROM users as u
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

// method to delete requests
	public function destroy_requests($post)
	{
		for ($i=0; $i < count($post['id']); $i++) { 
            $values = array(
            	intval($post['id'][$i]),
            	$this->session->userdata('id')
            	);
            $query = "DELETE FROM requests WHERE sample_id = ? AND user_id= ? ";
            $this->db->query($query, $values);
        }
	} // end of method

// method to get unique names of contributers of all of the samples requested by a user
	public function get_contributer_names($data) {
			$return = array();
			$query = "SELECT users.id as id, users.first_name as first, users.last_name as last, institutions.name as uni, institutions.city as city, countries.name as country
			FROM requests
			LEFT JOIN samples
				ON requests.sample_id = samples.id
			LEFT JOIN users
				ON samples.user_id = users.id
			LEFT JOIN institutions
				ON users.institution_id = institutions.id
			LEFT JOIN countries
				ON institutions.country_id = countries.id
			WHERE requests.user_id = ? AND samples.id = ?";
		for ($i = 0; $i < count($data['ids']); $i++) {
			$values = array(intval($data['user_id']), intval($data['ids'][$i]));
			$row = $this->db->query($query, $values)->row_array();
			if (!array_key_exists($row['id'], $return)) {
				$return[$row['id']] = array('id' => $row['id'], 'first' => $row['first'], 'last' => $row['last'], 'institution' => $row['uni'], 'city' => $row['city'], 'country' => $row['country']);
			}
		}
		return $return;
	} // end of method

// method to get all the data needed to compose an email to a specific contributer
	public function get_email_data($data)
	{
		/// NOTE TO SELF: ADD THE DATA NEEDED, GET IT TO POPULATE EMAIL TEMPLATE
		$return = array();
		$query = "SELECT samp.id as 'id', taxo.taxonomy_genus as 'Genus', taxo.taxonomy_species as 'Species', stypes.type as 'Sample Type', sexes.sex as 'Sex', 
		pres.preservation_medium as 'Preservation Medium', pho.status as 'Photo Available', samp.sample_size_mm as 'Size (mm)', samp.available_until as 'Avail. Until', 
		samp.comments as 'Comments', loc.region as 'Region', loc.lat_degree as 'Lat. Degree', loc.long_degree as 'Long. Degree', loc.lat_decimal as 'Lat. Decimal',
		loc.long_decimal as 'Long.Decimal', coun.name as 'Current Country Location', us.id as 'User id', us.first_name as 'First Name', us.last_name as 'Last Name', us.email as 'Contributer Email', i.name as 'Institution Name', i.city as 'Institution City'
			FROM requests as req
			LEFT JOIN sharkshare.samples as samp
				ON req.sample_id = samp.id
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
			LEFT JOIN photo_statuses as pho
				ON samp.photo_status_id = pho.id
			WHERE req.sample_id = ?";
	        for ($i = 0; $i < count($data['ids']); $i++) {
	        	$user_id = $this->db->query("SELECT user_id as id FROM samples WHERE id = ?", $data['ids'][$i])->row_array();
	        	if($user_id['id'] == $data['contributer_id']) {
	        		$values = intval($data['ids'][$i]);
	        		$row = $this->db->query($query, $values)->row_array();
					$row['user_email'] = $this->session->userdata('email');
					$row['user_first_name'] = $this->session->userdata('first_name');
					$row['user_last_name'] = $this->session->userdata('last_name');
					array_push($return, $row);
	        	}
			}
			return $return;
  
	} // end of method

// method to create the specific excel sheet with the requested samples
	public function create_email_spreadsheet($samples)
	{

	$objTpl = PHPExcel_IOFactory::load("assets/downloads/requesttemplate.xlsx");
	$objTpl->setActiveSheetIndex(0);  //set first sheet as active
	
	for ($i = 0; $i < count($samples); $i++) {
		$objTpl->getActiveSheet()->setCellValue('A'.($i+2), stripslashes($samples[$i]['Genus']));
		$objTpl->getActiveSheet()->setCellValue('B'.($i+2), stripslashes($samples[$i]['Species']));
		$objTpl->getActiveSheet()->setCellValue('C'.($i+2), stripslashes($samples[$i]['Sex']));
		$objTpl->getActiveSheet()->setCellValue('D'.($i+2), stripslashes($samples[$i]['Sample Type']));
		$objTpl->getActiveSheet()->setCellValue('E'.($i+2), stripslashes($samples[$i]['Current Country Location']));
		$objTpl->getActiveSheet()->setCellValue('F'.($i+2), stripslashes($samples[$i]['Avail. Until']));
		$objTpl->getActiveSheet()->setCellValue('G'.($i+2), stripslashes($samples[$i]['Specimen Size Num']));
		$objTpl->getActiveSheet()->setCellValue('H'.($i+2), stripslashes($samples[$i]['Unit']));
		$objTpl->getActiveSheet()->setCellValue('I'.($i+2), stripslashes($samples[$i]['Measurement Type']));
		$objTpl->getActiveSheet()->setCellValue('J'.($i+2), stripslashes($samples[$i]['Tag ID']));
		$objTpl->getActiveSheet()->setCellValue('K'.($i+2), stripslashes($samples[$i]['Preservation Medium']));
		$objTpl->getActiveSheet()->setCellValue('L'.($i+2), stripslashes($samples[$i]['Size (mm)']));
		$objTpl->getActiveSheet()->setCellValue('M'.($i+2), stripslashes($samples[$i]['Ocean']));
		$objTpl->getActiveSheet()->setCellValue('N'.($i+2), stripslashes($samples[$i]['Region']));
		$objTpl->getActiveSheet()->setCellValue('O'.($i+2), stripslashes($samples[$i]['Lat. Decimal']));
		$objTpl->getActiveSheet()->setCellValue('P'.($i+2), stripslashes($samples[$i]['Long.Decimal']));
		$objTpl->getActiveSheet()->setCellValue('Q'.($i+2), stripslashes($samples[$i]['Lat. Degree']));
		$objTpl->getActiveSheet()->setCellValue('R'.($i+2), stripslashes($samples[$i]['Long. Degree']));
		$objTpl->getActiveSheet()->setCellValue('S'.($i+2), stripslashes($samples[$i]['Date Tagged']));
		$objTpl->getActiveSheet()->setCellValue('T'.($i+2), stripslashes($samples[$i]['Photo Available']));
		$objTpl->getActiveSheet()->setCellValue('U'.($i+2), stripslashes($samples[$i]['Comments']));
	}
	 
	$target_dir = "assets/requests/";
    $target_file = $target_dir . basename($samples[0]['Last Name'].$samples[0]['requester_name'].'.xls');				
	// Do your stuff here
	$writer = PHPExcel_IOFactory::createWriter($objTpl, 'Excel5');
	$writer->save($target_file);
	} // end of method
		
} // end of model ?>