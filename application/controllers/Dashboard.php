<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model("Main");
        $this->load->model("Dashboard_model","dashboard");
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
            if(sesdata('branch_id')>0) $condition['sm.branch_id'] = sesdata('branch_id');
            $students = $this->Main->getDataOneJoin("count(*) as count","tbl_students s",$join,$condition,$pager=array(),$orderby=array(),"","row")->count;

            $date = date('Y-m-d', strtotime('-5 day', strtotime(date("r"))));
            $condition['registration_date >='] = $date;
            $newstudents = $this->Main->getDataOneJoin("count(*) as count","tbl_students s",$join,$condition,$pager=array(),$orderby=array(),"","row")->count;

            $condition = [ "sched_day" => date("l") ];
            if(sesdata('branch_id')>0) $condition['branch_id'] = sesdata('branch_id');
            $classes = $this->Main->getDataOneJoin("count(*) as count","tbl_schedules sch",$join=array(),$condition,$pager=array(),$orderby=array(),"","row")->count;
            
            if(sesdata('branch_id')>0) $condition['sm.branch_id'] = sesdata('branch_id');
            $awards = $this->Main->getDataOneJoin("SUM(JSON_LENGTH(comp_awards)) AS count","tbl_studentcompetitions sc",$join,$condition=[],$pager=array(),$orderby=array(),"","row")->count;

            $response = [
                "success" => true,
                "data"    => [
                    "reportsummary" => [
                        "students"      => $students,
                        "newstudents"   => $newstudents,
                        "classes"       => $classes,
                        "awards"        => $awards
                    ]
                ]
            ];
            response_json($response);
        }
    }
    
    public function getReportDetails()
    {
        $reporttype = jsondata()['reporttype'];
        $role = sesdata('role');
        $branch_id = sesdata('branch_id');
        $groupby = "";
        
        if($reporttype=="Students"){
            if(sesdata('role')==1){ 
                $select = "branch_name, COUNT(sm.`branch_id`) AS count"; 
                $groupby = "b.branch_id"; 
                $condition = "(year=".date('Y')." OR year IS NULL)";
            }
            else{ 
                $select="reference_id as rdid,CONCAT(lastname, ', ', firstname, ' ', middlename) AS name";
                $condition = "year=".date('Y')." AND sm.branch_id=".$branch_id;
            }
            $reportdata = $this->dashboard->getReports_StudentsData($select,"tbl_branches b",$condition,$groupby,"","");
        }else if($reporttype=="Newstudents"){
            $date = date('Y-m-d', strtotime('-5 day', strtotime(date("r"))));
            if(sesdata('role')==1){ 
                $select = "branch_name, COUNT(sm.`branch_id`) AS count"; 
                $groupby = "b.branch_id"; 
                $condition = "(year=".date('Y')." OR year IS NULL) AND (registration_date>='$date' OR registration_date IS NULL)";
            }
            else{ 
                $select="reference_id as rdid,CONCAT(lastname, ', ', firstname, ' ', middlename) AS name";
                $condition = "year=".date('Y')." AND registration_date>='$date' AND sm.branch_id=".$branch_id;
            }
            $reportdata = $this->dashboard->getReports_StudentsData($select,"tbl_branches b",$condition,$groupby,"","");
        }else if($reporttype=="Classes"){
            $condition = [ "sched_day" => date("l") ];
            if(sesdata('role')==1){ $select = "branch_name, COUNT(b.`branch_id`) AS count"; $groupby = "b.branch_id"; }
            else{ $select="c.class_id as rdid,class_title AS name"; $condition['b.branch_id']=$branch_id;}
            $reportdata = $this->dashboard->getReports_ClassesData($select,"tbl_branches b",$condition,$groupby,"","");
        }else if($reporttype=="Awards"){
            if(sesdata('role')==1){ 
                $select = "branch_name, SUM(JSON_LENGTH(comp_awards)) AS count";
                $groupby = "b.branch_id"; 
                $condition = "(year(sc.date_added)=".date("Y")." OR sc.date_added IS NULL)";
            }
            else{ 
                $select="reference_id as rdid,CONCAT(lastname, ', ', firstname, ' ', middlename) AS name";
                $condition = "year(sc.date_added)=".date("Y")." AND sm.branch_id=".$branch_id;
            }
            $reportdata = $this->dashboard->getReports_AwardsData($select,"tbl_branches b",$condition,$groupby,"","");
        }

        $response = [
            "success" => true,
            "data"    => [
                "reportdata" => $reportdata,
                "role"       => sesdata('role'),
                "branch_id"  => $branch_id
            ]
        ];
        response_json($response);
    }
}
