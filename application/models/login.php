<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Model {
/* this model's methods interact with the database to verify logins, create registration profiles, insert new users into the database. It covers the logical steps in the flow of login/registration */

// Method to validate the login of one user
    public function login_user() 
    {
        $query = "SELECT id, first_name, last_name, email, level FROM users WHERE email = ? AND password = ?";
        $values = array($this->input->post('email'), $this->input->post('password'));
        $user = $this->db->query($query, $values)->row_array();
        if (!empty($user)) {
            return $user;
        } // end if credentials match
        else 
        {
            $this->session->set_flashdata('errors', 'Incorrect email/password.');
            return false;
        }
    } // end of method

// Method to get countries to populate the form
    public function countries()
    {
        return $this->db->query("SELECT * FROM countries")->result_array();
    }

// Method to check existance of email
    public function check_email($data)
    {
        $emails = $this->db->query("SELECT email FROM users")->result_array();
        for ($i=0; $i < count($emails); $i++) { 
            if ($emails[$i]['email'] == $data['email']) {
                return true;
            } else {
                return false;
            }
        }
    }

// Method to change password
    public function change_password($data)
    {
        $query = 'UPDATE users SET password = ? WHERE email = ?';
        $values = array($data['password'], $data['email']);
        $update = $this->db->query($query, $values);
        if ($update) {
            return true;
        } else {
            return false;
        }
    }

// Method to validate the registration of one user
    public function registration_validation()
    {
        // validate the attempt
        $this->form_validation->set_rules("first_name", "First Name", "required|alpha|trim");
        $this->form_validation->set_rules("last_name", "Last Name", "trim|required|alpha");
        $this->form_validation->set_rules("email", "Email", "trim|required|valid_email|is_unique[users.email]");
        $this->form_validation->set_rules('is_unique', 'That email address is already registered.');
        $this->form_validation->set_rules('institution', "Institution", "required|trim");
        $this->form_validation->set_rules('field', "Field of Research", "required|trim");
        $this->form_validation->set_rules('status_id', "Field of Research", "required");
        $this->form_validation->set_rules('city', "City", "required|trim");
        $this->form_validation->set_rules('country', "Country", "required");
        $this->form_validation->set_rules('reference_name', "Name of Reference", "required|trim");
        $this->form_validation->set_rules('reference_email', "Email of Reference", "required|valid_email|trim");
            if($this->form_validation->run() === FALSE) // i.e. if there are errors in the above rules
            {
                $this->session->set_flashdata('errors', validation_errors());
                return false;
            }  // end if failure
            else {
                return true;
            }
        } // end of method

 //Method to ensure all boxes are checked
    public function terms_validation()
    {
        $this->form_validation->set_rules("responsiblity", "Responsibility", "required");
        $this->form_validation->set_rules("acknowledgment", "Acknowledgment", "required");
        $this->form_validation->set_rules("shipping", "Shipping Terms", "required");
        if($this->form_validation->run() === FALSE) // i.e. if there are errors in the above rules
            {
                $this->session->set_flashdata('errors', validation_errors());
                return false;
            }  // end if failure
            else {
                return true;
            }
        } // end of method

// Method for putting POTENTIAL candidates into a probation table waiting for validation from admins, including a token for registering later */
    public function on_probation($person)
    {
        // check to see if institution exists by getting the id
        $institution_query = "SELECT * FROM institutions WHERE name = ?";
        $institution_name = $person['institution'];
        $institution = $this->db->query($institution_query, $institution_name)->row_array();
        if (empty($institution)) {
            $data = array(
               'name' => $person['institution'] ,
               'city' => $person['city'] ,
               'country_id' => $person['country']
                );
            $this->db->insert('institutions', $data); 
            $institution['id'] = $this->db->insert_id();
        }

        // write the query
        $query = "INSERT INTO potential_users (first_name, last_name, email, field, institution_id, academic_status_id, reference_name, reference_email) VALUES (?,?,?,?,?,?,?,?)";
        $values = array($person['first_name'], $person['last_name'],$person['email'],$person['field'], $institution['id'], intval($person['status_id']), $person['reference_name'],$person['reference_email']);
        if ($this->db->query($query, $values)) {
            return true;
        } 
        else {
            $this->session->set_flashdata('errors', 'Failed to connect to database');
            return false; 
        }
    } // end of method

// Method for getting the data to generate a token for a potential user and send an email to someone containing their token in a link
    public function generate_token($post)
    {
        for ($i=0; $i < count($post['id']); $i++) { 
            $id = intval($post['id'][$i]);
            $user = $this->db->query("SELECT * FROM potential_users WHERE id = ?", $id)->row_array();
            $token = bin2hex(openssl_random_pseudo_bytes(32));
            $userdata = array('userdata' => $user, 'token' => $token);
            $values = array($token, $id);
            $this->db->query("UPDATE potential_users SET token = ? WHERE id = ?", $values);
        }
        return $userdata;
    } // end of method

// method to find the user with the email generated token in order to set up their profile
    public function check_token($token)
    {
        $query = "SELECT u.id, u.first_name, u.last_name, u.email, u.field, i.name as 'institution', i.city as 'city', i.country_id as 'country_id', a_s.id as 'status' FROM potential_users as u
        LEFT JOIN institutions as i 
        ON u.institution_id = i.id 
        LEFT JOIN academic_statuses as a_s
        ON u.academic_status_id = a_s.id
        WHERE u.token = ?";
        return $this->db->query($query, $token)->row_array();
    }

// Method to validate the registration of one user
    public function creation_validation()
    {
        // validate the attempt
        $this->form_validation->set_rules("first_name", "First Name", "required|alpha|trim");
        $this->form_validation->set_rules("last_name", "Last Name", "trim|required|alpha");
        $this->form_validation->set_rules("email", "Email", "trim|required|valid_email|is_unique[users.email]");
        $this->form_validation->set_rules('is_unique', 'That email address is already registered.');
        $this->form_validation->set_rules("password", "Password", "trim|required|min_length[7]|md5");
        $this->form_validation->set_rules("passconf", "Confirm Password", "required|matches[password]");
        $this->form_validation->set_rules('institution', "Institution", "required|trim");
        $this->form_validation->set_rules('research', "Field of Research", "required|trim");
        $this->form_validation->set_rules('city', "City", "required|trim");
        $this->form_validation->set_rules('country', "Country", "required|trim");
        $this->form_validation->set_rules('reference', "Name of Reference", "required|trim");
        $this->form_validation->set_rules('reference_email', "Email of Reference", "required|valid_email|trim");
            if($this->form_validation->run() === FALSE) // i.e. if there are errors in the above rules
            {
                $this->session->set_flashdata('errors', validation_errors());
                return false;
            }  // end if failure
            else {
                return true;
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

} // end of model ?>