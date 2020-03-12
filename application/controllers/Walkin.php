<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Walkin extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model("Main");
        date_default_timezone_set("Asia/Manila");
        checkLogin();
	}
	
	public function index()
	{
        $data['title'] = "Walk-in / Pre-registered";
        $data['vueid'] = "walkin_page";
        $data['vfile'] = "page/walkin/index";
        $data['js'] = array('pages/walkin.js');
        $this->load->view('layout/main', $data);
    }

    public function savenewWalkin()
    {
        $data = jsondata();

        if(!empty($data)){
            $newwalkin = $data['newWalkinInfo'];
            unset($newwalkin['age']);
            $data['date_added'] = date('Y-m-d H:i:s');

            $insertquery = $this->Main->insert("tbl_walkins", $newwalkin,true);

            $success = true;
            $message = "New Walk-in was registered successfully.";
            $type = "success";
            userLogs("Walkin","Registered New Walk-in (walkin_id #".$insertquery['lastid'].")");
        }else{
            $success = false;
            $message = "New Walk-in was not saved successfully.";
            $type = "warning";
        }

        $response = array(
            "success"   => $success,
            "message"   => $message,
            "type"      => $type,
        );
        response_json($response);
    }

    public function getWalkins()
    {
        $join = $condition = $pager = $orderby = [];
        $groupby = $type = $data = "";
        $data = jsondata();

        if(!empty($data)){
            if(!empty($data['join'])){ $join = $data['join']; }
            if(!empty($data['condition'])){ $condition = $data['condition']; }
            if(!empty($data['pager'])){ $pager = $data['pager']; }
            if(!empty($data['orderby'])){ $orderby = $data['orderby']; }
            if(!empty($data['groupby'])){ $groupby = $data['groupby']; }
            if(!empty($data['type'])){ $type = $data['type']; }
        }
        
        $walkinlist = $this->Main->getDataOneJoin("*,w.date_added AS wdate_added, w.status AS wstatus","tbl_walkins w",$join,$condition,$pager,$orderby,$groupby,$type);

        if(!empty($walkinlist)){
           
            $success = true;
            $type = "success";
            $data = $walkinlist;
        }else{
            $success = false;
            $type = "warning";
            $data = "";
        }

        $response = array(
            "success"   => $success,
            "type"      => $type,
            "data"      => $data
        );
        response_json($response);
    }

    public function saveWalkinChanges()
    {
        $data = jsondata();

        if(!empty($data)){
            
            $walkindetails = $data['walkindetails'];
            $walkin_id = $walkindetails['walkin_id'];
            $walkindetails['status'] = $walkindetails['wstatus'];

            unset($walkindetails['walkin_id']);
            unset($walkindetails['age']);
            unset($walkindetails['branch_name']);
            unset($walkindetails['date_addeddisplay']);
            unset($walkindetails['date_added']);
            unset($walkindetails['wstatus']);
            unset($walkindetails['wdate_added']);

            $updatequery = $this->Main->update("tbl_walkins", ["walkin_id"=>$walkin_id], $walkindetails,"");

            $success = true;
            $message = "Changes were saved successfully.";
            $type = "success";
            userLogs("Walkin","Edit Walk-in Info (walkin_id #".$walkin_id.")");
        }else{
            $success = false;
            $message = "Changes were not saved.";
            $type = "warning";
        }

        $response = array(
            "success"   => $success,
            "message"   => $message,
            "type"      => $type,
        );
        response_json($response);
    }
    
}
