<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Announcements extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model("Main");
        checkLogin();
	}
	
	public function index()
	{
        $data['title'] = "Announcements";
        $data['vueid'] = "announcements_page";
        $data['vfile'] = "page/announcements/index";
        // $data['js'] = array('pages/announcements.js');
        $this->load->view('layout/main', $data);
    }
    
}
