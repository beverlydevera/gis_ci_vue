<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Classes extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model("Main");
        $this->load->model("Classes_model", "classes");
        date_default_timezone_set("Asia/Manila");
        $this->data['curdatetime'] = date('Y-m-d H:i:s');
        checkLogin();
	}
	
	public function index()
	{
        $data['title'] = "Class Schedules";
        $data['vueid'] = "classes_page";
        $data['activenav'] = "classes";
        $data['vfile'] = "page/classes/index";
        $data['js'] = array('pages/classes.js');
        $this->load->view('layout/main', $data);
    }

    public function getClassScheds()
    {
        $select = "s.schedule_id, s.sched_day, s.sched_time, s.status, c.class_id, c.class_title, b.branch_id, b.branch_name";
        $condition = [
            "c.status" => 1,
            "b.status" => 1
        ];
        $classscheds = $this->classes->getClassScheds($select,"tbl_schedules s",$condition,"","");
        
        if(!empty($classscheds)){
            $response = array(
                "success"   => true,
                "data"      => $classscheds
            );
        }else{
            $response = array(
                "success"   => false,
                "data"      => ""
            );
        }
        response_json($response);
    }

    public function classSchedInfo($string = "")
    {
        $string = explode("-", $string);
        $class_id = end($string);
        $data['class_id'] = $class_id;

        $data['title'] = "Class Information";
        $data['vueid'] = "classes_page";
        $data['vfile'] = "page/classes/classschedinfo";
        $data['js'] = array('pages/classes.js');
        $this->load->view('layout/main', $data);
    }

    public function getClassSchedInfo()
    {
        $class_id = $this->input->post('class_id');

        $select = "s.schedule_id, s.sched_day, s.sched_time, s.status, c.class_id, c.class_title, b.branch_id, b.branch_name";
        $condition = [
            "c.status"   => 1,
            "b.status"   => 1,
            "s.class_id" => $class_id
        ];
        $classschedinfo = $this->classes->getClassScheds($select,"tbl_schedules s",$condition,"","row");

        $classschedsheld = $this->classes->getClassSchedInfo("*",["s.class_id"=>$class_id],"","");
        $condition = "`sc`.`class_id` = $class_id AND `sessions_attended` < `sessions` AND `deleted` = 0 AND `year` = " . date('Y');
        $classStudents = $this->classes->getClassStudents("*",$condition,"","");

        if(!empty($classschedsheld)){
            $response = array(
                "success"   => true,
                "data"      => [
                    "classSchedinfo" => $classschedinfo,
                    "classScheds" => $classschedsheld,
                    "classStudents" => $classStudents
                ],
            );
        }else{
            $response = array(
                "success"   => false,
                "data"      => ""
            );
        }
        response_json($response);
    }

}
