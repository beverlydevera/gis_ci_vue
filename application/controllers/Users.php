<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model("Main");
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
