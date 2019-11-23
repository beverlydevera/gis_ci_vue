<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cashier extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model("Main");
        checkLogin();
	}
	
	public function index()
	{
        $data['title'] = "Cashier";
        $data['vueid'] = "cashier";
        $data['vfile'] = "page/cashier/index";
        // $data['js'] = array('pages/cashier.js');
        $this->load->view('layout/main', $data);
    }
    
}
