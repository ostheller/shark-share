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
            return false
        }
    } // end of method

// Method to validate the registration of one user
    public function register_user()
    {
        // validate the attempt
        $this->form_validation->set_rules("first_name", "First Name", "required|alpha|trim");
        $this->form_validation->set_rules("last_name", "Last Name", "trim|required|alpha");
        $this->form_validation->set_rules("email", "Email", "trim|required|valid_email|is_unique[users.email]");
        $this->form_validation->set_rules("password", "Password", "trim|required|min_length[7]");
        $this->form_validation->set_rules("confirm_password", "Confirm Password", "required|matches[password]");
        $this->form_validation->set_rules('is_unique', 'That email address is already registered.');
            if($this->form_validation->run() === FALSE) // i.e. if there are errors in the above rules
            {
                $this->session->set_flashdata('errors', validation_errors());
                return false;
            }  // end if failure
            else // success! let's put them in the database AS POTENTIAL CANDIDATES NEEDING VERIFICATION FROM ADMINS!
            {
                $query = "INSERT INTO potential_users (first_name, last_name, email, password, description, user_level, created_at, updated_at) VALUES (?,?,?,?,?,1,NOW(),NOW())";
                $values = array($this->input->post('first_name'), $this->input->post('last_name'),$this->input->post('email'),$this->input->post('password'),$this->input->post('description'));
                if ($this->db->query($query, $values)) {
                    return true;
                } 
                else {
                    return false; 
                }
            }
        } // end of method

// Method to register one user to the database for the first time (automatic user level of 1, normal)
     public function insert_one()
     {
         $query = "INSERT INTO users (first_name, last_name, email, password, description, user_level, created_at, updated_at) VALUES (?,?,?,?,?,1,NOW(),NOW())";
         $values = array($this->input->post('first_name'), $this->input->post('last_name'),$this->input->post('email'),$this->input->post('password'),$this->input->post('description')); 
         return $this->db->query($query, $values);
     } // end insert one

} // end of model ?>