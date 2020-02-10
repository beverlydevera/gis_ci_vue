<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model("Main");
        $this->load->library("Bcrypt");
        checkLogin();
	}
    
    //start users list
    
	public function index()
	{
        $data['title'] = "Users";
        $data['vueid'] = "users_page";
        $data['vfile'] = "page/users/index";
        $data['js'] = array('pages/users.js');
        $this->load->view('layout/main', $data);
    }

    public function getUsersList()
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
        
        $walkinlist = $this->Main->getDataOneJoin("*","tbl_users u",$join,$condition,$pager,$orderby,$groupby,$type);

        if(!empty($walkinlist)){
           
            $success = true;
            $type = "success";
            $data = $walkinlist;
        }else{
            $success = false;
            $type = "warning";
        }

        $response = array(
            "success"   => $success,
            "type"      => $type,
            "data"      => $data
        );
        response_json($response);
    }

    public function saveUserDetails()
    {
        $data = jsondata();

        if(!empty($data)){
            
            $userdetails = $data['userdetails'];
            $user_id = $userdetails['user_id'];

            unset($userdetails['branch_name']);
            unset($userdetails['date_added']);

            $updatequery = $this->Main->update("tbl_users", ["user_id"=>$user_id], $userdetails,"");

            $success = true;
            $message = "Changes were saved successfully.";
            $type = "success";
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

    public function resetUserPassword()
    {
        $data = jsondata();

        if(!empty($data)){
            $user_id = $data['user_id'];
            $password = $data['password'];

            $password = $this->bcrypt->hash_password($password);
    
            $updatequery = $this->Main->update("tbl_users", ["user_id"=>$user_id], ["password"=>$password],"");
            $success = true;
            $message = "Password was reset successfully.";
            $type = "success";
        }else{
            $success = false;
            $message = "Password was not reset.";
            $type = "warning";
        }

        $response = array(
            "success"   => $success,
            "message"   => $message,
            "type"      => $type,
        );
        response_json($response);
    }

    public function archiveUserAccount()
    {
        $data = jsondata();

        if(!empty($data)){
            $user_id = $data['user_id'];
    
            $updatequery = $this->Main->update("tbl_users", ["user_id"=>$user_id], ["status"=>0],"");
            $success = true;
            $message = "Account was archived successfully.";
            $type = "success";
        }else{
            $success = false;
            $message = "Account was not archived.";
            $type = "warning";
        }

        $response = array(
            "success"   => $success,
            "message"   => $message,
            "type"      => $type,
        );
        response_json($response);
    }
    //end of users list

    //start of user logs

    public function logs()
	{
        $data['title'] = "User Logs";
        $data['vueid'] = "userlogs_page";
        $data['vfile'] = "page/users/userlogs";
        // $data['js'] = array('pages/users.js');
        $this->load->view('layout/main', $data);
    }

    //end of user logs

    public function logout()
    {
		// userLogs(sesdata('id') , sesdata('fullname') , "Logout", "User Logout");
		$this->session->sess_destroy();
		redirect('login');
	}
    
}
