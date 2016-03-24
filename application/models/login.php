<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Model {
/* this model's methods interact with the database to verify logins, create registration profiles, insert 
new users into the database. It covers the logical steps in the flow of login/registration */

// Method to validate the login of one user
    public function login_user() 
    {
        $query = "SELECT id, first_name, last_name, description, image_name, user_level, created_at FROM users WHERE email = ? AND password = ?";
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

// Method to validate the registration of one user
    public function registration_validation()
    {
        // validate the attempt
        $this->form_validation->set_rules("first_name", "First Name", "required|alpha|trim");
        $this->form_validation->set_rules("last_name", "Last Name", "trim|required|alpha");
        $this->form_validation->set_rules("email", "Email", "trim|required|valid_email|is_unique[users.email]");
        $this->form_validation->set_rules('is_unique', 'That email address is already registered.');
        $this->form_validation->set_rules("password", "Password", "trim|required|min_length[7]|md5");
        $this->form_validation->set_rules("passconf", "Confirm Password", "required|matches[password]");
        $this->form_validation->set_rules('institution', "Institution", "required|alpha|trim");
        $this->form_validation->set_rules('research', "Field of Research", "required|alpha|trim");
        $this->form_validation->set_rules('city', "City", "required|alpha|trim");
        $this->form_validation->set_rules('country', "Country", "required|trim");
        $this->form_validation->set_rules('reference', "Name of Reference", "required|alpha|trim");
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

// Method for putting POTENTIAL candidates into a probation table waiting for validation from admins
/* we could put a login keyword/password in their table that we could use as the link in the email we 
send when they are accepted. they would have to click that link would that long keyword that we would 
check against the database before they are allowed to setup their profile */
    public function on_probation()
    {
        $query = "INSERT INTO potential_users (first_name, last_name, email, password, description, user_level, created_at, updated_at) VALUES (?,?,?,?,?,1,NOW(),NOW())";
        $values = array($this->input->post('first_name'), $this->input->post('last_name'),$this->input->post('email'),$this->input->post('password'),$this->input->post('description'));
        if ($this->db->query($query, $values)) {
            return true;
        } 
        else {
            return false; 
        }
    } // end of method

// Method for sending an email to someone
    public function generate_email()
    {

    } // end of method

// Method to register one user to the database for the first time (automatic user level of 1, normal)
    public function create()
    {
        $query = "INSERT INTO users (first_name, last_name, email, password, description, user_level, created_at, updated_at) VALUES (?,?,?,?,?,1,NOW(),NOW())";
        $values = array($this->input->post('first_name'), $this->input->post('last_name'),$this->input->post('email'),$this->input->post('password'),$this->input->post('description')); 
        return $this->db->query($query, $values);
    } // end insert one

// Method to remove a user from the probationary table
    public function destroy()
    {
        return true;
    } // end insert one

} // end of model ?>