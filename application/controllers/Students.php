<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Students extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model("Main");
        $this->load->model("Students_model", "student");
        date_default_timezone_set("Asia/Manila");
        checkLogin();
	}
	
    public function index()
    {
        $data['title'] = "Students";
        $data['vueid'] = "students_page";
        $data['vfile'] = "page/students/index";
        $data['js'] = array('pages/students/index.js');
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
        $data['vueid'] = "studentprofile_page";
        $data['vfile'] = "page/students/profile";
        $data['js'] = array('pages/students/profile.js');
        $this->load->view('layout/main', $data);
    }

    public function getStudentProfile()
    {
        $student_id = $this->input->post('student_id');
        $studentinfo = $this->student->getStudents("*","tbl_students",["student_id"=>$student_id],"","row");
        $studentmembership = $this->student->getStudents("*","tbl_studentmembership",["student_id"=>$student_id],["limit"=>1,"offset"=>0],"row");        
        $studentclasses = $this->student->getStudentClasses("*",["student_id"=>$student_id, "deleted"=>0],"","");
        
        if(!empty($studentinfo)){
            $response = array(
                "success"   => true,
                "data"      => [
                    'studentprofile'    => $studentinfo,
                    'studentclasses'    => $studentclasses,
                    'studentmembership' => $studentmembership
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

    public function UpdateProfile()
    {

        $datas = $this->input->post();
        $student_id = $this->input->post('student_id');
        $result = $this->Main->update("tbl_students",['student_id'=>$student_id],$datas);

        if(!empty($result)){
            $response = array(
                "success"   => true,
                "message"   => "Profile changes saved successfully.",
                "data"      => $result
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

    public function getClassPackage()
    {
        $class_id = $this->input->post('class_id');
        $classpackages = $this->student->getClassPackages("*","tbl_packages",['tbl_classes.class_id'=>$class_id],"","");
        
        if(!empty($classpackages)){
            $response = array(
                "success"   => true,
                "data"      => $classpackages
            );
        }else{
            $response = array(
                "success"   => false,
                "data"      => ""
            );
        }
        response_json($response);
    }

    public function getStudentClassDetails()
    {
        $student_id = $this->input->post('student_id');
        $schedule_id = $this->input->post('schedule_id');
        $studpack_id = $this->input->post('studpack_id');
        $studentclassdetails = $this->student->getStudentClasses("*",['studpack_id'=>$studpack_id, 'deleted'=>0],"","row");
        $studentattendance = $this->student->getStudentAttendance("*",['a.schedule_id'=>$schedule_id, 'sp.studpack_id'=>$studpack_id],"","");
        $studatt = [];

        if(!empty($studentattendance)){
            foreach($studentattendance as $stk => $stv){
                $attinfo = json_decode($stv->attendance);
                foreach($attinfo as $atk => $atv){
                    if($atv->student_id==$student_id){
                        $arr = [
                            'schedule_date' => $stv->schedule_date,
                            'status' => $atv->status,
                        ];
                    }
                }
                array_push($studatt,$arr);
            }
        }

        if(!empty($studentclassdetails)){
            $response = array(
                "success"   => true,
                "data"      => [
                    'studentclassdetails'   => $studentclassdetails,
                    'studentattendance'     => $studatt,
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

    public function checkPayment()
    {
        $package_id = $this->input->post('package_id');
        $classpackages = $this->student->getClassPackages("pricerate","tbl_packages",['package_id'=>$package_id],"","row");

        if(!empty($classpackages)){
            $response = array(
                "success"   => true,
                "data"      => $classpackages->pricerate
            );
        }else{
            $response = array(
                "success"   => false,
                "data"      => ""
            );
        }
        response_json($response);
    }

    public function enrollToClass()
    {
        $data = $this->input->post();
        $data['date_added'] = date('Y-m-d H:i:s');
        $result = $this->Main->insert("tbl_studentpackages", $data, true);

        if(!empty($result)){
            $response = array(
                "success"   => true,
                "message"   => "Student enrolled to class successfully.",
                "data"      => $result
            );
        }else{
            $response = array(
                "success"   => false,
                "message"   => "Student enrollment was not saved.",
                "data"      => ""
            );
        }
        response_json($response);
    }

    public function deleteStudentClass()
    {
        $studpack_id = $this->input->post('studpack_id');
        //check muna kung may payment history na bago magdelete
        //kung wala, delete row, kung meron change status
        // $result = $this->Main->delete("tbl_student_packages", ["studpack_id"=>$studpack_id]);
        $result = $this->Main->update("tbl_studentpackages", ["studpack_id"=>$studpack_id], ["deleted"=>1]);
        
        if(!empty($result)){
            $response = array(
                "success"   => true,
                "message"   => "Student Class Schedule was deleted successfully"
            );
        }else{
            $response = array(
                "success"   => false,
                "message"   => "Student Class Schedule was not deleted"
            );
        }
        response_json($response);
    }

    public function newStudentRegistration()
    {
        $data['title'] = "Enroll Student";
        $data['vueid'] = "studentenroll_page";
        $data['vfile'] = "page/students/enroll";
        $data['js'] = array('pages/students/enroll.js');
        $this->load->view('layout/main', $data);
    }

    public function saveNewStudentRegistration()
    {
        $data = jsondata();
        $studentinfo = $data["studentinfo"];
        $insurance = $data["insurance"];
        $result = $this->Main->insert("tbl_students", $studentinfo, true);

        if(!empty($result)){
            $reference_id = date("Y")."-".$studentinfo['sex'].$result['lastid'];
            $this->Main->update("tbl_students",['student_id'=>$result['lastid']],['reference_id'=>$reference_id]);
            
            $insert_membership_data = [
                "student_id"      => $result['lastid'],
                "year"            => date("Y"),
                "membership_type" => 1,
                "insurance_avail" => $insurance,
                "date_added"      => date('Y-m-d H:i:s')
            ];
            $insert_membership = $this->Main->insert("tbl_studentmembership",$insert_membership_data,true);

            $response = array(
                "success"   => true,
                "message"   => "Student Registration was saved successfully.\nContinue by adding the student to a class.",
                "data"      => [
                    "student_id"    => $result['lastid'],
                    "reference_id"  => $reference_id,
                    "studmem_id" => $insert_membership['lastid'],
                    "result"        => $result
                ],
            );
        }else{
            $response = array(
                "success"   => false,
                "message"   => "Student Registration was not saved.",
                "data"      => "",
            );
        }
        response_json($response);
    }

    public function changeMembership()
    {
        
    }

}
