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
        $student_id = end($string);
        $data['student_id'] = $student_id;

        $data['title'] = "Students Profile";
        $data['vueid'] = "students_profile";
        $data['vfile'] = "page/students/profile";
        $data['js'] = array('pages/students.js');
        $this->load->view('layout/main', $data);
    }

    public function getStudentProfile()
    {
        $student_id = $this->input->post('student_id');
        $studentinfo = $this->student->getStudents("*","tbl_students",["student_id"=>$student_id],"","row");
        
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

    public function UpdateProfile(){

        $datas = $this->input->post();
        $student_id = $this->input->post('student_id');
        $updateresult = $this->Main->update("tbl_students",['student_id'=>$student_id],$datas);

        if(!empty($updateresult)){
            $response = array(
                "success"   => true,
                "message"   => "Profile changes saved successfully.",
                "data"      => $updateresult
            );
        }else{
            $response = array(
                "success"   => false,
                "message"   => "Profile changes were not saved.",
                "data"      => ""
            );
        }
        response_json($response);
    }
}
