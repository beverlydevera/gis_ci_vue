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
        $data['js'] = array('pages/inventory.js');
        $this->load->view('layout/main', $data);
    }
    
    public function getInventoryList()
    {
        $type=""; $condition = [];

        if(!empty(jsondata())){
            $condition = jsondata();
            if(!empty($condition['s.stock_id'])){ $type="row"; }
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

    public function saveNewInventoryItem()
    {
        $data = jsondata();
        $datainventory = $data['inventory'];
        $datastocks = $data['stocks'];

        if(!empty($data)){
            $insertquery = $this->Main->insert("tbl_inventory",$datainventory,true);
            $lastid = $insertquery['lastid'];
            $itemno = "ITEM-" . str_pad($lastid, 4, '0', STR_PAD_LEFT);

            $updateitemno = $this->Main->update("tbl_inventory",["inventory_id"=>$lastid],["item_no"=>$itemno],"");

            $datastocks['inventory_id'] = $lastid;
            $insertquery = $this->Main->insert("tbl_stocks",$datastocks,true);

            if(!empty($insertquery)){
                $success = true;
                $type = "success";
                $message = "Inventory Item was added successfully.";
            }
        }else{
            $success = false;
            $type = "warning";
            $message = "Inventory Item was not added";
        }

        $response = array(
            'success'   => $success,
            'type'      => $type,
            'message'   => $message,
        );
        response_json($response);
    }

}
