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
        // $data['js'] = array('pages/landing/index.js');
        $this->load->view('page/landing/index',$data);
    }

    public function gallery()
	{
        $data['title'] = "Bravehearts | Gallery";
        // $data['js'] = array('pages/landing/gallery.js');
        $this->load->view('page/landing/gallery',$data);
    }
    
    public function preregister()
	{
        $data['title'] = "Bravehearts | Pre-Register";
        // $data['js'] = array('pages/landing/preregister.js');
        $this->load->view('page/landing/preregister',$data);
    }
    
}
