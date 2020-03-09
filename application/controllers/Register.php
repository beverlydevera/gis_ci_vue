<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model("Main");
        $this->load->library("Bcrypt");
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
        $success = false;
        $message = $type = "";
        
        if(!empty($data)){
            $inputcol = $data['inputcol'];
            $datacheck = $data['datacheck'];

            $count = $this->Main->count("tbl_users",$datacheck);
            if($count>0){
                $success = true;
                $type = "warning";
                $message = $inputcol." already exist.";
            }
        }
        $response = array(
            "success"   => $success,
            "type"      => $type,
            "message"   => $message
        );
        response_json($response);
    }

    public function registerNewUser()
    {
        $data = jsondata();
        $success = false;

        if(!empty($data)){
            unset($data['confirmpass']);
            $data['status'] = 1;
            $data['role'] = 2;
            $data['password'] = $this->bcrypt->hash_password($data['password']);
            $data['date_added'] = date("Y-m-d H:i:s");

            $insertquery = $this->Main->insert("tbl_users",$data,true);

            if(!empty($insertquery)){                
                $success = true;
                $message = "Registration complete.\nYou may now login your account.";
                $type = "success";
                userLogs("Users","User Registration (user_id #".$insertquery['lastid'].")");
            }else{
                $message = "Registration Error";
                $type = "danger";                
            }
        }else{
            $message = "Please fill out required fields";
            $type = "warning";
        }
        $response = array(
            "success"   => $success,
            "type"      => $type,
            "message"   => $message
        );
        response_json($response);
    }
    
}
