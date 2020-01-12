<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Schedules extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model("Main");
        checkLogin();
	}
	
	public function index()
	{
        $data['title'] = "Schedules";
        $data['vueid'] = "schedules";
        $data['vfile'] = "page/schedules/index";
        // $data['js'] = array('pages/users.js');
        $this->load->view('layout/main', $data);
    }
    
}
