<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model("Main");
        checkLogin();
	}
	
	public function index()
	{
        $data['title'] = "Invoice";
        $data['vueid'] = "invoice";
        $data['vfile'] = "page/invoice/index";
        // $data['js'] = array('pages/invoice.js');
        $this->load->view('layout/main', $data);
    }
    
}
