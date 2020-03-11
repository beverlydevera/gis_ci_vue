<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PreRegister extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model("Main");
        $this->load->library("Bcrypt");
	}
	
	public function index()
	{
        $data['title'] = "Bravehearts | Pre-Registration";
        // $data['js'] = array('pages/preregister.js');
        $this->load->view('page/preregister/index',$data);
    }

    // public function checkifAccountExist()
    // {
    //     $data = jsondata();
    //     $success = false;
    //     $message = $type = "";
        
    //     if(!empty($data)){
    //         $inputcol = $data['inputcol'];
    //         $datacheck = $data['datacheck'];

    //         $count = $this->Main->count("tbl_users",$datacheck);
    //         if($count>0){
    //             $success = true;
    //             $type = "warning";
    //             $message = $inputcol." already exist.";
    //         }
    //     }
    //     $response = array(
    //         "success"   => $success,
    //         "type"      => $type,
    //         "message"   => $message
    //     );
    //     response_json($response);
    // }
    
}
