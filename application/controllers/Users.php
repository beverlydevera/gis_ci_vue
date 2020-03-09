<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model("Main");
        $this->load->model("Users_model",'users');
        $this->load->library("Bcrypt");
        $this->load->library('session');
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
        $select = "*";
        $data = jsondata();

        if(!empty($data)){
            if(!empty($data['select'])){ $select = $data['select']; }
            if(!empty($data['join'])){ $join = $data['join']; }
            if(!empty($data['condition'])){ $condition = $data['condition']; }
            if(!empty($data['pager'])){ $pager = $data['pager']; }
            if(!empty($data['orderby'])){ $orderby = $data['orderby']; }
            if(!empty($data['groupby'])){ $groupby = $data['groupby']; }
            if(!empty($data['type'])){ $type = $data['type']; }
        }
        
        $userlist = $this->Main->getDataOneJoin($select,"tbl_users u",$join,$condition,$pager,$orderby,$groupby,$type);
        if(!empty($userlist->photo)){ $userlist->photo = base64_encode($userlist->photo); }

        if(!empty($userlist)){
           
            $success = true;
            $type = "success";
            $data = $userlist;
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
        $data = $this->input->post();
        if(!empty($_FILES)){
            $file = file_get_contents($_FILES['file']['tmp_name']);
            $dataupdate = [
                "lastname"  => $data['lastname'],
                "firstname" => $data['firstname'],
                "middlename"=> $data['middlename'],
                "contactno" => $data['contactno'],
                "emailadd"  => $data['emailadd'],
                "photo"     => $file,
            ];
        }else{
            $dataupdate = [
                "lastname"  => $data['lastname'],
                "firstname" => $data['firstname'],
                "middlename"=> $data['middlename'],
                "contactno" => $data['contactno'],
                "emailadd"  => $data['emailadd'],
            ];
        }

        if(!empty($data)){
            $user_id = $data['user_id'];
            
            if(!empty($data['branch_id'])){ $dataupdate["branch_id"]=$data['branch_id']; }
            if(!empty($data['role'])){ 
                $dataupdate["role"]=$data['role'];
                if($user_id==sesdata('id')){
                    $this->session->set_userdata('role', $data['role']);                
                }
            }

            $updatequery = $this->Main->update("tbl_users", ["user_id"=>$user_id], $dataupdate,"");

            $success = true;
            $message = "Changes were saved successfully.";
            $type = "success";            
            userLogs("Users","Edited User Profile (user_id #$user_id)");
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
            $message = "Password was changed/reset successfully.";
            $type = "success";
            userLogs("Users","Reset User Password (user_id #$user_id)");
        }else{
            $success = false;
            $message = "Password was not changed/reset.";
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
            userLogs("Users","Archive User Profile (user_id #$user_id)");
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
        $data['js'] = array('pages/userlogs.js');
        $this->load->view('layout/main', $data);
    }

    public function getUserLogs()
    {
        $count_data = 0;
        $data = [];
        
        $query = $this->input->get('query');
        $limit = $this->input->get('limit');
        $page = $this->input->get('page');
        $orderBy = !empty($this->input->get('orderBy')) ? $this->input->get('orderBy') : "userlog_id";
        
        if(!empty($this->input->get('ascending'))){
            $ascending = $this->input->get('ascending')!=1 ? $this->input->get('ascending') : "DESC";
        }else{ $ascending = "ASC"; }
        $byColumn = $this->input->get('byColumn');

        if ($page == 1) { $offset = 0; } 
        else { $offset = ($page - 1) * $limit; }
        
        $condition = array();
        $select = "userlog_id,username,CONCAT(lastname,', ',firstname) AS fullname,module,ulog_title,ul.date_added";
        $order = array(
            'col'       => $orderBy,
            'order_by'  => $ascending,
        );
        $like = array('column' => ["lastname", "firstname", "middlename", "username", "module", "ulog_title"], 'data' => $query);
        $limit = empty($query) ? $limit : 15;

        $data = $this->users->getUserLogs($select,$condition,$like,$offset,$order,$limit);

        if(!empty($data)){
            $count_data = count($data);
        }else{ $count_data=0; }
        
        $response = array(
            'count' => $count_data,
            'data'  => $data,
        );
        response_json($response);
    }

    //end of user logs

    public function logout()
    {
        userLogs("Users","User Logout (user_id #".sesdata('id').")");
		$this->session->sess_destroy();
		redirect('login');
	}
    
}
