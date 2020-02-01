<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventory extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model("Main");
        $this->load->model("Inventory_model","inventory");
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
    
    public function getInventoryList()
    {
        $type=""; $condition = [];

        // $condition['s.stocks>'] = "0";
        if(!empty(jsondata())){
            $condition = jsondata();
            if(!empty($condition['s.stock_id'])){ $type="row"; }
            // $condition['s.stocks>'] = "0";
        }
        $inventorylist = $this->inventory->getInventoryList("*","tbl_inventory i",$condition,"","",$type);
        
        if(!empty($inventorylist)){
            $response = array(
                "success"   => true,
                "data"      => [
                    "inventorylist" => $inventorylist
                ]
            );
        }else{
            $response = array(
                "success"   => false,
                "data"      => ""
            );
        }
        response_json($response);
    }

}
