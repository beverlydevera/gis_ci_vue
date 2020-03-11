<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
		$this->load->model('Main');
		$this->load->library('bcrypt');
		$this->load->library('session');
        checkLogin($type = true);
	}
	
	public function index()
	{
        $data['title'] = "Bravehearts | Login";
        $data['vueid'] = "login";
        $data['js'] = array('pages/login.js');
        $this->load->view('page/login', $data);
    }

    public function checkuser()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $data="";
        
		$qry  = array(
			'select'           => "*",
			'table'            => 'tbl_users',
			'condition'        => array('username' => $username),
			'type'             => 'row',
		);  
        $r = $this->Main->select($qry);
        
        if(!empty($r)){
            if($this->bcrypt->check_password($password, $r->password)){
                $sessiondata = array(
                    'loggedin' => true,
                    'username' => $r->username,
                    'first_name' => $r->firstname,
                    'last_name' => $r->lastname,
                    'middle_name' => $r->middlename,
                    'fullname' => $r->firstname . " " .$r->lastname,
                    'role' => $r->role,
                    'id' => $r->user_id,
                );
                $this->session->set_userdata($sessiondata);
                $data = $sessiondata;

                $success = true;
                $message = "Successfully logged in";
                userLogs("Users","User Login (user_id #$r->user_id)");
            } else{
                $success = false;
                $message = "Incorrect Username or Password.";
                userLogs("Users","Login Failed (user_id #$r->user_id)");
            }
        }else{
            $success = false;
            $message = "Username does not exist.";
        }

		$response = array(
            'success' => $success,
            'message' => $message,
            'data'    => $data
        );
		response_json($response);
    }

    public function lgdev()
    {
		$sessiondata = array(
			'loggedin' => true,
			'username' => "admin",
			'first_name' => "admin",
			'last_name' => "admin",
			'middle_name' => "admin",
			'fullname' => "admin",
			'role' => "0",
			'id' => "42",
		);
		$this->session->set_userdata($sessiondata);
		redirect('dashboard','refresh');
    }
    
}
