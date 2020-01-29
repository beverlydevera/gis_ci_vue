<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Libraries extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model("Main");
        $this->load->model("Libraries_model", "libraries");
        date_default_timezone_set("Asia/Manila");
        checkLogin();
	}
	
	public function branches()
	{
        $data['title'] = "Libraries - Branches";
        $data['vueid'] = "libraries_page";
        $data['activenav'] = "libraries";
        $data['vfile'] = "page/libraries/branches";
        $data['js'] = array('pages/libraries.js');
        $this->load->view('layout/main', $data);
    }
	
	public function classes()
	{
        $data['title'] = "Libraries - Classes";
        $data['vueid'] = "libraries_page";
        $data['activenav'] = "libraries";
        $data['vfile'] = "page/libraries/classes";
        $data['js'] = array('pages/libraries.js');
        $this->load->view('layout/main', $data);
    }
	
	public function packages()
	{
        $data['title'] = "Libraries - Packages";
        $data['vueid'] = "libraries_page";
        $data['activenav'] = "libraries";
        $data['vfile'] = "page/libraries/packages";
        $data['js'] = array('pages/libraries.js');
        $this->load->view('layout/main', $data);
    }

}