<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Classes extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model("Main");
        $this->load->model("Classes_model", "classes");
        checkLogin();
	}
	
	public function index()
	{
        $data['title'] = "Classes and Schedules";
        $data['vueid'] = "classes";
        $data['activenav'] = "classes";
        $data['vfile'] = "page/classes/index";
        $data['js'] = array('pages/classes.js');
        $this->load->view('layout/main', $data);
    }
    
    public function getClassScheds()
    {
        $classscheds = $this->classes->getClassScheds("*","tbl_classes","","","");
        
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

    public function classHistoryInfo($string = "")
    {
        $string = explode("-", $string);
        $class_id = end($string);
        $data['class_id'] = $class_id;

        $data['title'] = "Classes History";
        $data['vueid'] = "classes_page";
        $data['vfile'] = "page/classes/classhistory";
        $data['js'] = array('pages/classes.js');
        $this->load->view('layout/main', $data);
    }

    public function getClassHistoryInfo()
    {
        $class_id = $this->input->post('class_id');
        $classhistoryinfo = $this->classes->getClassHistoryInfo("*",["class_id"=>$class_id],"","");

        if(!empty($classhistoryinfo)){
            $response = array(
                "success"   => true,
                "data"      => $classhistoryinfo,
            );
        }else{
            $response = array(
                "success"   => false,
                "data"      => ""
            );
        }
        response_json($response);
    }

    public function getClassSchedInfo()
    {
        $class_id = $this->input->post('class_id');
        $attendance_id = $this->input->post('attendance_id');

        $classschedInfo = $this->classes->getClassSchedInfo("*",["attendance_id"=>$attendance_id],"","row");
        $condition_wherein = [
            'col' => "tbl_students.student_id",
            'arr' => "'".str_replace(',', "','", $classschedInfo->attendance)."'"
        ];
        $classschedprofile = $this->classes->getClassSchedStudents("*",["deleted"=>0],$condition_wherein,"","");

        if(!empty($classschedprofile)){
            $response = array(
                "success"   => true,
                "data"      => $classschedprofile,
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
