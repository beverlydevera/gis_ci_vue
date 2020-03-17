<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Schedules extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model("Main");
        checkLogin();
    }
    
	public function index()
	{
        $data['title'] = "Schedules";
        $data['vueid'] = "schedules_page";
        // $data['js'] = array('pages/schedules/schedules.js');
        
        if(sesdata('role')==1){
            $data['vfile'] = "page/schedules/index";
        }else{ 
            if(sesdata('branch_id')==1){ $data['vfile'] = "page/schedules/index"; }
            else if(sesdata('branch_id')==2){ $data['vfile'] = "page/schedules/arcadian"; }
            else if(sesdata('branch_id')==3){ $data['vfile'] = "page/schedules/buyagan"; }
            else if(sesdata('branch_id')==4){ $data['vfile'] = "page/schedules/itogon"; }
            else if(sesdata('branch_id')==5){ $data['vfile'] = "page/schedules/albergo"; }
        }
        $this->load->view('layout/main', $data);
    }

    public function addSchedules()
	{
        $data['title'] = "Add Schedules";
        $data['vueid'] = "scheduleadd_page";
        $data['vfile'] = "page/schedules/scheduleadd";
        $data['js'] = array('pages/schedules/scheduleadd.js');
        $this->load->view('layout/main', $data);
    }

    public function saveSchedule()
    {
        $data = jsondata();

        if(!empty($data)){
            $data['date_added'] = date("Y-m-d H:i:s");
            $insertquery = $this->Main->insert("tbl_schedules",$data,true);

            if(!empty($insertquery)){
                $success = true;
                $type = "success";
                $message = "Schedule was added successfully.";
            }
        }else{
            $success = false;
            $type = "warning";
            $message = "Schedule was not added";
        }

        $response = array(
            'success'   => $success,
            'type'      => $type,
            'message'   => $message,
        );
        response_json($response);
    }

    public function getScheduleTable()
    {
        $condition = [
            "branch_id" => jsondata()['branch_id']
        ];
        $schedlist = $this->Main->getDataOneJoin("*","tbl_scheduletable",$join=array(),$condition,$pager=array(),$orderby=array(),$groupby="",$type="");
        
        if(!empty($schedlist)){
            $response = array(
                "success"   => true,
                "data"      => [
                    "schedlist" => $schedlist
                ]
            );
        }else{
            $response = array(
                "success"   => false,
                "data"      => ""
            );
        }
        response_json($response);
    }

    public function albergo()
	{
        $data['title'] = "Schedules";
        $data['vueid'] = "schedules";
        $data['vfile'] = "page/schedules/albergo";
        // $data['js'] = array('pages/users.js');
        $this->load->view('layout/main', $data);
    }

    public function buyagan()
	{
        $data['title'] = "Schedules";
        $data['vueid'] = "schedules";
        $data['vfile'] = "page/schedules/buyagan";
        // $data['js'] = array('pages/users.js');
        $this->load->view('layout/main', $data);
    }

    public function arcadian()
	{
        $data['title'] = "Schedules";
        $data['vueid'] = "schedules";
        $data['vfile'] = "page/schedules/arcadian";
        // $data['js'] = array('pages/users.js');
        $this->load->view('layout/main', $data);
    }

    public function itogon()
	{
        $data['title'] = "Schedules";
        $data['vueid'] = "schedules";
        $data['vfile'] = "page/schedules/itogon";
        // $data['js'] = array('pages/users.js');
        $this->load->view('layout/main', $data);
    }
    
}
