<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Classes extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model("Main");
        $this->load->model("Classes_model", "classes");
        $this->load->model("Students_model", "students");
        date_default_timezone_set("Asia/Manila");
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

    // public function getClassScheds()
    // {
    //     $select = "s.schedule_id, s.sched_day, s.sched_time, s.status, c.class_id, c.class_title, b.branch_id, b.branch_name";
    //     $condition = [
    //         "c.status" => 1,
    //         "b.status" => 1
    //     ];
    //     $classscheds = $this->classes->getClassScheds($select,"tbl_schedules s",$condition,["limit"=>5,"offset"=>0],"");

    //     if(!empty($classscheds)){
    //         foreach($classscheds as $csk => $csv){
    //             $class_id = $csv->class_id;
    //             $condition = "`sc`.`class_id` = $class_id AND `sessions_attended` < `sessions` AND `deleted` = 0 AND `year` = " . date('Y');
    //             $classStudents = $this->classes->getClassStudents("*",$condition,"","count_row");
    //             $classscheds[$csk]->enrollees = $classStudents;
    //         }
    //     }
        
    //     if(!empty($classscheds)){
    //         $response = array(
    //             "success"   => true,
    //             "data"      => $classscheds
    //         );
    //     }else{
    //         $response = array(
    //             "success"   => false,
    //             "data"      => ""
    //         );
    //     }
    //     response_json($response);
    // }

    // public function getClassSchedInfo()
    // {
    //     $class_id       = $this->input->post('class_id');
    //     $attendance_id  = $this->input->post('attendance_id');

    //     $select = "s.schedule_id, s.sched_day, s.sched_time, s.status, c.class_id, c.class_title, b.branch_id, b.branch_name";
    //     $condition = [
    //         "c.status"   => 1,
    //         "b.status"   => 1,
    //         "s.class_id" => $class_id
    //     ];
    //     $classschedinfo = $this->classes->getClassScheds($select,"tbl_schedules s",$condition,"","row");

    //     if($attendance_id>0){
    //         $classschedsheld = $this->classes->getClassSchedInfo("*",["s.class_id"=>$class_id, "a.attendance_id"=>$attendance_id],"","row");
    //         $attendance = json_decode($classschedsheld->attendance);
    //         if(!empty($attendance)){
    //             $ids="";
    //             foreach($attendance as $attidk => $attidv){
    //                 $ids .= $attidv->student_id . ",";
    //             }
    //             $ids = substr($ids,0,-1);
    //         }
    //         $condition = "`sc`.`class_id` = $class_id AND s.student_id IN ($ids) AND `deleted` = 0 AND `year` = " . date('Y');
    //     }else{
    //         // $classschedsheld = $this->classes->getClassSchedInfo("*",["s.class_id"=>$class_id],["limit"=>5,"offset"=>0],"");
    //         $classschedsheld = $this->classes->getClassSchedInfo("*",["s.class_id"=>$class_id],"","");
    //         if(!empty($classschedsheld)){
    //             foreach($classschedsheld as $csk => $csv){
    //                 $attendance = json_decode($csv->attendance);
    //                 $absent = $present = 0;
    //                 foreach($attendance as $attk => $attv){
    //                     if($attv->status){ $present++; }
    //                     else{ $absent++; }
    //                 }
    //                 $classschedsheld[$csk]->absent = $absent;
    //                 $classschedsheld[$csk]->present = $present;
    //             }
    //         }
    //         $condition = "`sc`.`class_id` = $class_id AND `sessions_attended` < `sessions` AND `deleted` = 0 AND `year` = " . date('Y');
    //     }
        
    //     $classStudents = $this->classes->getClassStudents("*",$condition,"","");

    //     if(!empty($classschedinfo)){
    //         $response = array(
    //             "success"   => true,
    //             "data"      => [
    //                 "classSchedinfo" => $classschedinfo,
    //                 "classScheds"    => $classschedsheld,
    //                 "classStudents"  => $classStudents
    //             ],
    //         );
    //     }else{
    //         $response = array(
    //             "success"   => false,
    //             "data"      => ""
    //         );
    //     }
    //     response_json($response);
    // }

    // public function addNewAttendance()
    // {
    //     $data = jsondata();
    //     $datainsert = $attendanceinfo = $data['attendanceinfo'];
    //     $countexist = $this->Main->count("tbl_attendance", ["schedule_id"=>$data['schedule_id'], "schedule_date"=>$datainsert['schedule_date']]);
    //     if($countexist>0){
    //         $success = false;
    //         $type = "warning";
    //         $message = "Class Schedule Date already exists";
    //     }else{
    //         $datainsert['schedule_id'] = $data['schedule_id'];
    //         $datainsert['date_added'] = date('Y-m-d H:i:s');
    //         $datainsert['attendance'] = json_encode($attendanceinfo['attendance']);
    //         unset($datainsert['attendance_id']);
    
    //         if(!empty($attendanceinfo['attendance'])){
    //             foreach($attendanceinfo['attendance'] as $attinfo){
    //                 if($attinfo['status']){
    //                     $studpack_id = $attinfo['studpack_id'];
    //                     $student_id = $attinfo['student_id'];
    //                     $this->Main->raw("UPDATE tbl_studentpackages SET sessions_attended=sessions_attended+1 WHERE studpack_id=$studpack_id AND student_id=$student_id","","update");
    //                 }
    //             }
    //         }
    //         $result = $this->Main->insert("tbl_attendance", $datainsert, true);
    //         $success = true;
    //         $type = "success";
    //         $message = "Attendance was submitted successfully";
    //     }

    //     $response = array(
    //         'success'   => $success,
    //         'type'      => $type,
    //         'message'   => $message,
    //     );
    //     response_json($response);
    // }

    // public function saveAttendanceChanges()
    // {
    //     $data = jsondata();
    //     $attendanceinfo = $data['attendanceinfo'];
    //     $attendance_id  = $attendanceinfo['attendance_id'];
    //     $att_update = [];
    //     $condition = [
    //         "schedule_id"       => $data['schedule_id'], 
    //         "schedule_date"     => $attendanceinfo['schedule_date'],
    //         "attendance_id!="   => $attendance_id,
    //     ];
    //     $countexist = $this->Main->count("tbl_attendance", $condition);

    //     if($countexist>0){
    //         $success = false;
    //         $type = "warning";
    //         $message = "Date set already exist in another Class Schedule";
    //     }else{
    //         if(!empty($attendanceinfo['attendance'])){
    //             foreach($attendanceinfo['attendance'] as $attinfo   ){
    //                 if($attinfo['tmp_sessions_attended']=="0" || $attinfo['tmp_sessions_attended']>0){
    //                     $studpack_id = $attinfo['studpack_id'];
    //                     $student_id = $attinfo['student_id'];
    //                     $sessions_attended = $attinfo['tmp_sessions_attended'];
    //                     $this->Main->raw("UPDATE tbl_studentpackages SET sessions_attended=$sessions_attended WHERE studpack_id=$studpack_id AND student_id=$student_id","","update");
    //                 }
    //                 unset($attinfo['tmp_sessions_attended']);
    //                 unset($attinfo['origstat']);
    //                 array_push($att_update,$attinfo);

    //             }
    //         }

    //         $att_update = json_encode($att_update);
    //         $this->Main->raw("UPDATE tbl_attendance SET attendance='$att_update' WHERE attendance_id=$attendance_id","","update");

    //         $success = true;
    //         $type = "success";
    //         $message = "Attendance changes were saved successfully";
    //     }
    //     $response = array(
    //         'success'   => $success,
    //         'type'      => $type,
    //         'message'   => $message,
    //     );
    //     response_json($response);
    // }

    //new functions
    
    public function getClassesList()
    {
        $type=""; $condition = [];
        $data = jsondata();

        if(!empty($data)){
            $condition = $data['condition'];
            if(!empty($condition['c.class_id'])){ $type="row"; }
        }
        $classeslist = $this->Main->getDataOneJoin("*","tbl_classes c","",$condition,"","","",$type);
        
        if(!empty($classeslist)){
            $response = array(
                "success"   => true,
                "data"      => [
                    "classeslist" => $classeslist
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

    public function getSchedulesList()
    {
        $type=""; $condition = [];
        $data = jsondata();

        if(!empty($data)){
            $condition = $data['condition'];
            if(!empty($condition['s.schedule_id'])){ $type="row"; }
        }
        $scheduleslist = $this->classes->getSchedulesList("*","tbl_schedules s",$condition,"",$type);
        
        if(!empty($scheduleslist)){
            $response = array(
                "success"   => true,
                "data"      => [
                    "scheduleslist" => $scheduleslist
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

    public function getClassSchedulesList()
    {
        $condition = $pager = $orderby = [];
        $groupby = $type = $data = "";
        $select = "*";
        $data = jsondata();

        if(!empty($data)){
            if(!empty($data['select'])){ $select = $data['select']; }
            if(!empty($data['condition'])){ $condition = $data['condition']; }
            if(!empty($data['pager'])){ $pager = $data['pager']; }
            if(!empty($data['orderby'])){ $orderby = $data['orderby']; }
            if(!empty($data['groupby'])){ $groupby = $data['groupby']; }
            if(!empty($data['type'])){ $type = $data['type']; }
        }
        
        $classschedlist = $this->classes->getClassSchedList($select,$condition,$pager,$orderby,$groupby,$type);

        if(!empty($classschedlist)){
           
            $success = true;
            $type = "success";
            $data = [
                "classschedlist" => $classschedlist
            ];
        }else{
            $success = false;
            $type = "warning";
        }

        $response = array(
            "success"   => $success,
            "type"      => $type,
            "data"      => $data
        );
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

    public function getclassSchedInfo()
    {
        $class_id = $this->input->post('class_id');

        if(!empty($class_id)){
            $classschedinfo = $this->classes->getClassSchedList("*",['s.class_id'=>$class_id],"","","","row");

            $join = [
                "table"     => "tbl_schedules s",
                "key"       => "s.schedule_id=cs.schedule_id",
                "jointype"  => "inner"
            ];
            $classschedsheld = $this->Main->getDataOneJoin("*","tbl_classscheds cs",$join,["s.class_id"=>$class_id],"","","","");

            $condition = "
            p.`packagetype`='Regular' AND
            JSON_EXTRACT(packagedetails, '$.class')=$class_id AND
            JSON_EXTRACT(details, '$.sessions')-JSON_EXTRACT(details, '$.sessions_attended')>0
            ";
            $classstudents = $this->classes->getStudentsEnrolled("*",$condition,"","","","");
            
           
            $success = true;
            $type = "success";
            $data = [
                "classschedinfo"    => $classschedinfo,
                "classschedsheld"   => $classschedsheld,
                "classstudents"     => $classstudents
            ];
        }else{
            $success = false;
            $type = "warning";
            $data = "";
        }

        $response = array(
            "success"   => $success,
            "type"      => $type,
            "data"      => $data
        );
        response_json($response);
    }

    public function getStudentsList()
    {
        $searchInput = $this->input->post('searchInput');
        $existing = $this->input->post('existing');
        $condition = "(firstname LIKE '%$searchInput%' OR middlename LIKE '%$searchInput%' OR lastname LIKE '%$searchInput%' OR reference_id LIKE '%$searchInput%')
        AND student_id NOT IN ($existing)";
        $students = $this->students->getStudents("*","tbl_students",$condition,"","");
        
        if(!empty($students)){
            $response = array(
                "success"   => true,
                "data"      => [
                    "studentslist" => $students
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

    public function submitNewAttendanceInfo()
    {
        $data = jsondata();

        if(!empty($data)){
            $datainsert = $data['attendanceinfo'];
            $datainsert['date_added'] = date("Y-m-d H:i:s");
            $datainsert['attendance'] = json_encode($datainsert['attendance']);

            $insertquery = $this->Main->insert("tbl_classscheds",$datainsert,true);
            $lastid = $insertquery['lastid'];

            if(!empty($insertquery)){
                $success = true;
                $type = "success";
                $message = "Attendance was saved successfully.";
            }
        }else{
            $success = false;
            $type = "warning";
            $message = "Attendance was not saved";
        }

        $response = array(
            'success'   => $success,
            'type'      => $type,
            'message'   => $message,
        );
        response_json($response);
    }

}
