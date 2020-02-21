<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model("Main");
	}
	
	public function index()
	{
        $data['title'] = "Bravehearts | User Registration";
        $data['js'] = array('pages/register.js');
        $this->load->view('page/register',$data);
    }

    public function checkifAccountExist()
    {
        $data = jsondata();
        
        if(!empty($data)){
            $inputcol = $data['inputcol'];
            $datacheck = $data['datacheck'];

            $count = $this->Main->count("tbl_users",$datacheck);
            if($count>0){
                $success = true;
                $type = "warning";
                $message = $inputcol." already exist.";
            }
        }else{
            $success = false;
            $message = $type = "";
        }
        $response = array(
            "success"   => $success,
            "type"      => $type,
            "message"   => $message
        );
        response_json($response);
    }
    
}
