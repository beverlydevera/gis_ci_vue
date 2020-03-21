<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model("Main");
        date_default_timezone_set("Asia/Manila");
        checkLogin();
	}
	
	public function index()
	{
        $data['title'] = "Dashboard";
        $data['vueid'] = "dashboard_page";
        $data['vfile'] = "page/dashboard";
        $data['js'] = array('pages/dashboard.js');
        $this->load->view('layout/main', $data);
    }

    public function getReportSummary()
    {
        $data = jsondata();
        $condition = [];

        if(!empty($data)){
            $join = [
                "table" => "tbl_studentmembership sm",
                "key"   => "sm.student_id=s.student_id",
                "jointype" => "inner"
            ];
            $condition = [ "year" => date("Y") ];
            $date = date('Y-m-d', strtotime('-5 day', strtotime(date("r"))));
            $students = $this->Main->getDataOneJoin("count(*) as count","tbl_students s",$join,$condition,$pager=array(),$orderby=array(),"","row")->count;
            $condition['registration_date >='] = $date;
            $newstudents = $this->Main->getDataOneJoin("count(*) as count","tbl_students s",$join,$condition,$pager=array(),$orderby=array(),"","row")->count;
            $condition = [ "sched_day" => date("l") ];
            $classes = $this->Main->getDataOneJoin("count(*) as count","tbl_schedules s",$join=array(),$condition,$pager=array(),$orderby=array(),"","row")->count;

            $response = [
                "success" => true,
                "data"    => [
                    "reportsummary" => [
                        "students"      => $students,
                        "newstudents"   => $newstudents,
                        "classes"       => $classes,
                        "medals"        => 0
                    ]
                ]
            ];
            response_json($response);
            // classes
            // medals
        }
    }
    
}
