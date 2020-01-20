<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model("Main");
	}
	
	public function index()
	{
        $data['title'] = "Registration";
        $data['vueid'] = "register_page";
        // $data['vfile'] = "page/register";
        // $data['js'] = array('pages/register.js');
        // $this->load->view('layout/main', $data);
        $this->load->view('page/register',$data);
    }
    
}
