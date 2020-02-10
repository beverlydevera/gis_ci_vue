<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Walkin extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model("Main");
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
            unset($newwalkin['branchname']);
            
            $insertquery = $this->Main->insert("tbl_walkins", $newwalkin,true);

            $success = true;
            $message = "New Walk-in was registered successfully.";
            $type = "success";
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
    
}
