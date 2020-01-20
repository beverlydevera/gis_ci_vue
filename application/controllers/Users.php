<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model("Main");
        checkLogin();
	}
	
	public function index()
	{
        $data['title'] = "Users";
        $data['vueid'] = "users_page";
        $data['vfile'] = "page/users/index";
        // $data['js'] = array('pages/users.js');
        $this->load->view('layout/main', $data);
    }

    public function logs()
	{
        $data['title'] = "User Logs";
        $data['vueid'] = "userlogs_page";
        $data['vfile'] = "page/users/userlogs";
        // $data['js'] = array('pages/users.js');
        $this->load->view('layout/main', $data);
    }

    public function logout()
    {
		// userLogs(sesdata('id') , sesdata('fullname') , "Logout", "User Logout");
		$this->session->sess_destroy();
		redirect('login');
	}
    
}
