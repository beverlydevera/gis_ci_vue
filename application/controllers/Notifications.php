<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notifications extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model("Main");
        date_default_timezone_set("Asia/Manila");
        checkLogin();
	}

    public function getNewRegistrations()
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
        if(sesdata('role')==2){ $condition['n.branch_id'] = sesdata('branch_id'); }
        $preregisteredlist = $this->Main->getDataOneJoin("*,w.date_added AS wdate_added, w.status AS wstatus","tbl_walkins w",$join,$condition,$pager,$orderby,$groupby,$type);

        if(!empty($preregisteredlist)){
           
            $success = true;
            $type = "success";
            $data = [
                'preregisteredlist' => $preregisteredlist
            ];
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
    
}
