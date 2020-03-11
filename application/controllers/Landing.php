<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Landing extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model("Main");
        $this->load->library("Bcrypt");
	}
	
	public function index()
	{
        $data['title'] = "Bravehearts";
        // $data['js'] = array('pages/landing.js');
        $this->load->view('page/landing/index',$data);
    }
    
}
