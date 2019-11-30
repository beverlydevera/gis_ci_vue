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

    public function classSchedInfo($string = "")
    {
        $string = explode("-", $string);
        $class_id = end($string);
        $data['class_id'] = $class_id;

        $data['title'] = "Class Sched Information";
        $data['vueid'] = "classes_profile";
        $data['vfile'] = "page/classes/classprofile";
        $data['js'] = array('pages/classes.js');
        $this->load->view('layout/main', $data);
    }

    public function getClassSchedInfo()
    {
        $class_id = $this->input->post('class_id');
        $classschedprofile = $this->classes->getClassSchedProfile("*",["tbl_classes.class_id"=>$class_id,"deleted"=>0],"","");

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
