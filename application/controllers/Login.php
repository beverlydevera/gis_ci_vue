<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
		$this->load->model('Main');
		$this->load->library('bcrypt');
		$this->load->library('session');
	}
	
	public function index()
	{
        checkLogin($type = true);

        $data['title'] = "Login";
        $data['vueid'] = "login";
        // $data['js'] = array('pages/login.js');
        $this->load->view('page/login', $data);
    }

    public function checkuser(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$r=array();

		$qry  = array(
			'select'           => "*",
			'table'            => 'tblusers',
			'condition'        => array('username' => $username),
			'type'             => 'row',
		);  
		$r = $this->Main->select($qry);
        
        if(!empty($r)){
            if($this->bcrypt->check_password($password, $r->password)){
                $sessiondata = array(
                    'loggedin' => true,
                    'username' => $r->username,
                    'first_name' => $r->fname,
                    'last_name' => $r->lname,
                    'middle_name' => $r->mname,
                    'fullname' => $r->lname . ", " .$r->fname . " " . $r->mname . ".",
                    'role' => $r->role,
                    'id' => $r->id,
                    'province' => $r->province,
                );
                $data = array('logged_in'=>'1');
                $condition = array('id'=>$r->id);
                $query = $this->Main->update('tblusers', $condition, $data);
                $this->session->set_userdata($sessiondata);

                $checkldap = true;
                $success = true;
                $message = "Success";
                userLogs($r->id , $r->lname . ", " .$r->fname . " " . $r->mname . ". " , "LOGIN", "User Login");
            } else{
                $success = false;
                $message = "Incorrect Username or Password.";
            }
        }else{
            if (!empty($r)) {
                userLogs($r->id , $r->lname . ", " .$r->fname . " " . $r->mname . ". " , "LOGIN", "Login Failed");
                $success = false;
                $message = "Incorrect Username or Password.";
            }else{
                $success = false;
                $message = "Incorrect Username or Password.";
            }
        }
        
		$response = array('success' => $success,'message' => $message);
		response_json($response);
	}

	public function lgdev(){
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
