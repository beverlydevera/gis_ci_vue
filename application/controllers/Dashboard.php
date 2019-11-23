<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model("Main");
        checkLogin();
	}
	
	public function index()
	{
        $data['title'] = "Dashboard";
        $data['vueid'] = "dashboard";
        $data['vfile'] = "page/dashboard";
        // $data['js'] = array('pages/dashboard.js');
        $this->load->view('layout/main', $data);
    }
    
}
