<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Walkin extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model("Main");
        checkLogin();
	}
	
	public function index()
	{
        $data['title'] = "Walk-in / Pre-registered";
        $data['vueid'] = "walkin_page";
        $data['vfile'] = "page/walkin/index";
        // $data['js'] = array('pages/walkin.js');
        $this->load->view('layout/main', $data);
    }
    
}
