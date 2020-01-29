<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventory extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model("Main");
        checkLogin();
	}
	
	public function index()
	{
        $data['title'] = "Inventory";
        $data['vueid'] = "inventory_page";
        $data['vfile'] = "page/inventory/index";
        // $data['js'] = array('pages/inventory.js');
        $this->load->view('layout/main', $data);
    }
    
}
