<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Classes extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model("Main");
        $this->load->model("Classes_model", "classes");
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
        $schedule_id = end($string);
        $data['schedule_id'] = $schedule_id;

        $data['title'] = "Class Information";
        $data['vueid'] = "classes_page";
        $data['vfile'] = "page/classes/classschedinfo";
        $data['js'] = array('pages/classes.js');
        $this->load->view('layout/main', $data);
    }

    public function getclassSchedInfo()
    {
        $schedule_id = $this->input->post('schedule_id');

        if(!empty($schedule_id)){
            $classschedinfo = $this->classes->getClassSchedList("*",['s.schedule_id'=>$schedule_id],"","","","row");
            $class_id = $classschedinfo->class_id;

            $join = [
                "table"     => "tbl_schedules s",
                "key"       => "s.schedule_id=cs.schedule_id",
                "jointype"  => "inner"
            ];
            $orderby = [
                "column" => "schedule_date",
                "order"  => "DESC"
            ];
            $classschedsheld = $this->Main->getDataOneJoin("*","tbl_classscheds cs",$join,["s.class_id"=>$class_id],"",$orderby,"","");

            $condition = "
            p.`packagetype`='Regular' AND
            JSON_EXTRACT(packagedetails, '$.class')=$class_id AND
            JSON_EXTRACT(details, '$.sessions')-JSON_EXTRACT(details, '$.sessions_attended')>0
            ";
            $orderby = [
                "column" => "lastname",
                "order"  => "ASC"
            ];
            $classstudents = $this->classes->getStudentsEnrolled("s.student_id,studpack_id,reference_id,lastname,firstname,middlename,sex,details",$condition,"",$orderby,"","");
           
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
        AND s.student_id NOT IN ($existing)";
        $students  = $this->classes->getStudentsEnrolled("s.student_id,reference_id,lastname,firstname,middlename,sex",$condition,"","","","");
        
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
            $classsched_id = $insertquery['lastid'];

            $studattarr = [];
            foreach($data['attendanceinfo']['attendance'] as $dtk => $dtv){
                $studatt = [
                    "student_id"    => $dtv['student_id'],
                    "classsched_id" => $classsched_id,
                    "status"        => $dtv['status'],
                    "date_added"    => date("Y-m-d H:i:s")
                ];
                array_push($studattarr,$studatt);

                if($dtv['status']){
                    $studpack_id = $dtv['studpack_id'];
                    $sessions_attended = $this->Main->raw("SELECT JSON_EXTRACT(details, '$.sessions_attended') as sessions_attended FROM tbl_studentpackages WHERE studpack_id=$studpack_id",true)->sessions_attended;
                    $this->Main->raw("UPDATE tbl_studentpackages SET details = JSON_SET(details,'$.sessions_attended',$sessions_attended+1) WHERE studpack_id=$studpack_id","","update");
                }
            }
            $this->Main->insertbatch("tbl_studentattendance",$studattarr);

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

    public function getClassAttendanceInfo()
    {
        $classsched_id = $this->input->post('classsched_id');
        $classattendanceinfo = $this->Main->getDataOneJoin("*","tbl_classscheds","",["classsched_id"=>$classsched_id],"","","","row");
        $select = "st.student_id,reference_id,lastname,firstname,middlename,sex,sp.details,sp.studpack_id";
        $classattendancestudents = $this->classes->getClassStudentsInfo($select,["ca.classsched_id"=>$classsched_id],"","","","");

        if(!empty($classattendanceinfo)){
            $response = array(
                "success"   => true,
                "data"      => [
                    "classattendanceinfo"       => $classattendanceinfo,
                    "classattendancestudents"   => $classattendancestudents
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

    public function saveAttendanceChanges()
    {
        $data = jsondata();

        if(!empty($data)){
            $attendanceinfo = $data['attendanceinfo'];
            
            $classsched_id = $attendanceinfo['classsched_id'];
            unset($attendanceinfo['classsched_id']);
            unset($attendanceinfo['schedule_id']);
            unset($attendanceinfo['date_added']);

            foreach($attendanceinfo['attendance'] as $attk => $attv){
                if(!empty($attv['origstat'])){
                    unset($attv['origstat']);
                }
                if(!empty($attv['studpack_id'])){
                    $studpack_id = $attv['studpack_id'];
                    unset($attv['studpack_id']);
                }
                if(!empty($attv['tmp_sessions_attended'])){
                    $sessions_attended = $attv['tmp_sessions_attended'];
                    $this->Main->raw("UPDATE tbl_studentpackages SET details = JSON_SET(details,'$.sessions_attended',$sessions_attended) WHERE studpack_id=$studpack_id","","update");
                    unset($attv['tmp_sessions_attended']);
                }
                $attendanceinfo['attendance'][$attk] = $attv;
            }
            $attendanceinfo['attendance'] = json_encode($attendanceinfo['attendance']);
            $this->Main->update("tbl_classscheds",["classsched_id"=>$classsched_id],$attendanceinfo);

            $response = array(
                "success"   => true,
                "type"      => "success",
                "message"   => "Attendance changes were saved successfully"
            );
        }else{
            $response = array(
                "success"   => false,
                "type"      => "warning",
                "message"   => "Changes were not saved"
            );
        }
        response_json($response);
    }

}
