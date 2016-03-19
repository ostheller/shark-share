<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends CI_Controller {

	public function view($page)
	{
        if ( ! file_exists(APPPATH.'/views/pages'.$page.'.php'))
        {
                // Whoops, we don't have a page for that!
                show_404();
        }

        $data['title'] = ucfirst($page); // Capitalize the first letter

        $this->load->view('partials/header', $data);
        $this->load->view('partials/navbar', $data)
        $this->load->view("'".$page."'", $data);
        $this->load->view('partials/footer', $data);
	}
?>