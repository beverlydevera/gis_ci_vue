<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Students extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model("Main");
        $this->load->model("Students_model", "student");
	}
	
	public function index()
	{
        $data['title'] = "Students";
        $data['vueid'] = "students";
        $data['vfile'] = "page/students/index";
        $data['js'] = array('pages/students.js');
        $this->load->view('layout/main', $data);
    }
    
    public function getStudents()
    {
        $students = $this->student->getStudents("*","tbl_students","","","");
        
        if(!empty($students)){
            $response = array(
                "success"   => true,
                "data"      => $students
            );
        }else{
            $response = array(
                "success"   => false,
                "data"      => ""
            );
        }
        response_json($response);
    }

    public function profile($string = "")
    {
        $string = explode("-", $string);
        $studentid = end($string);

        $data['title'] = "Students";
        $data['vueid'] = "students";
        $data['vfile'] = "page/students/profile";
        $data['js'] = array('pages/students.js');
        $this->load->view('layout/main', $data);
    }

    public function getProfile()
    {
        $studentid = $this->input->post('studentid');
        $studentinfo = $this->student->getStudents("*","tbl_students",["student_id"=>$studentid],"","row");
        
        if(!empty($studentinfo)){
            $response = array(
                "success"   => true,
                "data"      => $studentinfo
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
