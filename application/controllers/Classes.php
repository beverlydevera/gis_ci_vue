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
        $class_id       = $this->input->post('class_id');
        $attendance_id  = $this->input->post('attendance_id');

        $select = "s.schedule_id, s.sched_day, s.sched_time, s.status, c.class_id, c.class_title, b.branch_id, b.branch_name";
        $condition = [
            "c.status"   => 1,
            "b.status"   => 1,
            "s.class_id" => $class_id
        ];
        $classschedinfo = $this->classes->getClassScheds($select,"tbl_schedules s",$condition,"","row");

        if($attendance_id>0){
            $classschedsheld = $this->classes->getClassSchedInfo("*",["s.class_id"=>$class_id, "a.attendance_id"=>$attendance_id],"","row");
        }else{
            $classschedsheld = $this->classes->getClassSchedInfo("*",["s.class_id"=>$class_id],"","");
        }
        
        $condition = "`sc`.`class_id` = $class_id AND `sessions_attended` < `sessions` AND `deleted` = 0 AND `year` = " . date('Y');
        $classStudents = $this->classes->getClassStudents("*",$condition,"","");

        if(!empty($classschedinfo)){
            $response = array(
                "success"   => true,
                "data"      => [
                    "classSchedinfo" => $classschedinfo,
                    "classScheds"    => $classschedsheld,
                    "classStudents"  => $classStudents
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

    public function addNewAttendance()
    {
        $data = jsondata();
        $datainsert = $attendanceinfo = $data['attendanceinfo'];

        $countexist = $this->Main->count("tbl_attendance", ["schedule_id"=>$data['schedule_id'], "schedule_date"=>$datainsert['schedule_date']]);
        if($countexist>0){
            $success = false;
            $type = "warning";
            $message = "Class Schedule Date already exists";
        }else{
            $datainsert['schedule_id'] = $data['schedule_id'];
            $datainsert['date_added'] = $this->data['curdatetime'];
            $datainsert['attendance'] = json_encode($attendanceinfo['attendance']);
    
            if(!empty($attendanceinfo['attendance'])){
                foreach($attendanceinfo['attendance'] as $attinfo){
                    if($attinfo['status']){
                        $studpack_id = $attinfo['studpack_id'];
                        $student_id = $attinfo['student_id'];
                        $this->Main->raw("UPDATE tbl_studentpackages SET sessions_attended=sessions_attended+1 WHERE studpack_id=$studpack_id AND student_id=$student_id","","update");
                    }
                }
            }
            $result = $this->Main->insert("tbl_attendance", $datainsert, true);
            $success = true;
            $type = "success";
            $message = "Attendance was submitted successfully";
        }

        $response = array(
            'success'   => $success,
            'type'      => $type,
            'message'   => $message,
        );
        response_json($response);
    }

    public function saveAttendanceChanges()
    {
        $data = jsondata();
        $attendanceinfo = $data['attendanceinfo'];
        $attendance_id  = $attendanceinfo['attendance_id'];
        $att_update = [];
        $condition = [
            "schedule_id"       => $data['schedule_id'], 
            "schedule_date"     => $attendanceinfo['schedule_date'],
            "attendance_id!="   => $attendance_id,
        ];
        $countexist = $this->Main->count("tbl_attendance", $condition);

        if($countexist>0){
            $success = false;
            $type = "warning";
            $message = "Date set already exist in another Class Schedule";
        }else{
            if(!empty($attendanceinfo['attendance'])){
                foreach($attendanceinfo['attendance'] as $attinfo   ){
                    if(!empty($attinfo['tmp_sessions_attended'])){
                        $studpack_id = $attinfo['studpack_id'];
                        $student_id = $attinfo['student_id'];
                        $sessions_attended = $attinfo['tmp_sessions_attended'];
                        $this->Main->raw("UPDATE tbl_studentpackages SET sessions_attended=$sessions_attended WHERE studpack_id=$studpack_id AND student_id=$student_id","","update");
                        unset($attinfo['tmp_sessions_attended']);
                    }
                    unset($attinfo['origstat']);
                    array_push($att_update,$attinfo);

                }
            }

            $att_update = json_encode($att_update);
            $this->Main->raw("UPDATE tbl_attendance SET attendance='$att_update' WHERE attendance_id=$attendance_id","","update");

            $success = true;
            $type = "success";
            $message = "Attendance changeds were saved successfully";
        }
        $response = array(
            'success'   => $success,
            'type'      => $type,
            'message'   => $message,
        );
        response_json($response);
    }

}
