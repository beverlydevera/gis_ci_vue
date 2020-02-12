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
    //index functions
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
    //end of index

    //profile function
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

        $join = [
            "table"     => "tbl_packages p",
            "key"       => "p.package_id=sp.package_id",
            "jointype"  => "inner"
        ];
        $condition = [
            "sp.student_id" => $student_id,
            "p.packagetype"   => "Regular"
        ];
        $studentpackages_regular = $this->Main->getDataOneJoin("*","tbl_studentpackages sp",$join,$condition,"","","","");

        $condition = [
            "sp.student_id" => $student_id,
            "p.packagetype"   => "Unlimited"
        ];
        $studentpackages_unlimited = $this->Main->getDataOneJoin("*","tbl_studentpackages sp",$join,$condition,"","","","");
        
        $condition = [
            "sp.student_id" => $student_id,
            "p.packagetype"   => "Summer Promo"
        ];
        $studentpackages_summerpromo = $this->Main->getDataOneJoin("*","tbl_studentpackages sp",$join,$condition,"","","","");
        
        if(!empty($studentmembership)){
            $membershiptype = $studentmembership->membership_type;
            if(strlen($membershiptype)>1){
                $memberships = explode("/",$membershiptype);
                $membershiptype = "";
                foreach($memberships as $mk => $mv){
                    $membershipname = $this->Main->getDataOneJoin("*","tbl_membership","",["membership_id"=>$mv],"","","","row")->membership_name;
                    $membershiptype .= $membershipname . "/";
                }
                $membershiptype = substr($membershiptype, 0, -1);
            }else{
                $membershiptype = $this->Main->getDataOneJoin("*","tbl_membership","",["membership_id"=>$membershiptype],"","","","row")->membership_name;
            }
        }

        $studentmembership->membership_type = $membershiptype;

        $condition = [ "student_id" => $student_id ];
        $competitionslist = $this->Main->getDataOneJoin("*","tbl_studentcompetitions","",$condition,"","","","");

        if(!empty($studentinfo)){
            $response = array(
                "success"   => true,
                "data"      => [
                    'studentprofile'    => $studentinfo,
                    'studentmembership' => $studentmembership,
                    'studentpackages'   => [
                        "regular"       => $studentpackages_regular,
                        "unlimited"     => $studentpackages_unlimited,
                        "summerpromo"   => $studentpackages_summerpromo,
                    ],
                    'competitionslist'  => $competitionslist
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

    public function getStudentAttendance()
    {
        $data = jsondata();

        if(!empty($data)){

            $schedule_id = $data['schedule_id'];
            $student_id = $data['student_id'];

            $join = [
                "table"     => "tbl_attendance a",
                "key"       => "sa.attendance_id=a.attendance_id",
                "jointype"  => "inner"
            ];
            $condition = [
                "schedule_id"   => $schedule_id,
                "student_id"    => $student_id
            ];
            $studentattendance = $this->Main->getDataOneJoin("*","tbl_studentattendance sa",$join,$condition,"","","","");

            if(!empty($studentattendance)){
                $response = array(
                    "success"   => true,
                    "data"      => [
                        "studentattendance" => $studentattendance
                    ]
                );
            }else{
                $response = array(
                    "success"   => false,
                    "message"   => "No existing attendance yet.",
                    "data"      => ""
                );
            }
        }else{
            $response = array(
                "success"   => false,
                "message"   => "Error Loading Data",
                "data"      => ""
            );
        }
        response_json($response);
    }

    public function saveStudentCompetition()
    {
        $data = jsondata();
        $result = "";
        
        if(!empty($data)){
            $student_id = $data['student_id'];
            $compinfo = $data['competition_info'];
            $compinfo["comp_awards"] = json_encode($compinfo["comp_awards"]);
            $compinfo["student_id"] = $student_id;

            $result = $this->Main->insert("tbl_studentcompetitions",$compinfo,true);
        }

        if(!empty($result)){
            $response = array(
                "success"   => true,
                "type"      => "success",
                "message"   => "Competition Information was saved successfully.",
                "data"      => [
                    "studcomp_id" => $result['lastid']
                ]
            );
        }else{
            $response = array(
                "success"   => false,
                "type"      => "warning",
                "message"   => "Competition Information was not saved.",
                "data"      => ""
            );
        }
        response_json($response);
    }
    //end of profile

    //enrollment functions
    public function newStudentRegistration()
    {
        $data['title'] = "Enroll Student";
        $data['vueid'] = "studentenroll_page";
        $data['vfile'] = "page/students/enroll";
        $data['js'] = array('pages/students/enroll.js');
        $this->load->view('layout/main', $data);
    }

    public function enroll_saveNewStudentRegistration()
    {
        $data = jsondata();
        $studentinfo = $data["studentinfo"];
        $result = $this->Main->insert("tbl_students", $studentinfo, true);

        if(!empty($result)){
            $studentid = $result['lastid'];
            $reference_id = date("Y").$studentinfo['sex']."-".str_pad($studentid, 4, '0', STR_PAD_LEFT);
            $this->Main->update("tbl_students",['student_id'=>$studentid],['reference_id'=>$reference_id]);
            
            $insert_studinvoice = $this->Main->insert("tbl_studentinvoice", ["student_id" => $studentid, "status"=>0, "amount"=>0], true);
            $invoice_id = $insert_studinvoice['lastid'];
            $invoice_number = "INV".date("Y")."-".str_pad($invoice_id, 4, '0', STR_PAD_LEFT);
            $this->Main->update("tbl_studentinvoice",['invoice_id'=>$invoice_id],['invoice_number'=>$invoice_number]);

            $insert_membership_data = [
                "student_id"      => $studentid,
                "year"            => date("Y"),
                "membership_type" => 1,
                "membership_price"=> "1000",
                "insurance"       => 0,
                "date_added"      => date('Y-m-d H:i:s'),
                "invoice_id"      => $invoice_id
            ];
            $insert_membership = $this->Main->insert("tbl_studentmembership",$insert_membership_data,true);

            $response = array(
                "success"   => true,
                "message"   => "Student Registration was saved successfully.\nContinue to insurance and packages.",
                "type"      => "success",
                "data"      => [
                    "student_id"    => $studentid,
                    "invoice_id"    => $invoice_id,
                    "invoice_number"=> $invoice_number,
                    "reference_id"  => $reference_id,
                    "studmem_id"    => $insert_membership['lastid'],
                    "result"        => $result
                ],
            );
        }else{
            $response = array(
                "success"   => false,
                "message"   => "Student Registration was not saved.",
                "type"      => "warning",
                "data"      => "",
            );
        }
        response_json($response);
    }

    public function enroll_saveNewStudentPackages()
    {
        $data = jsondata();

        if(!empty($data)){
            $invoice_id = $data["invoice_id"];
            $studmem_id = $data["studmem_id"];
            $insurance = $data["insurance"];
            $studentpackages = $data["studentpackages"];
            
            $this->Main->update("tbl_studentmembership",['invoice_id'=>$invoice_id],['insurance'=>json_encode($insurance)]);

            foreach($studentpackages as $spkey => $spval){
                $studentpackages[$spkey]['invoice_id'] = $invoice_id;
                $studentpackages[$spkey]['details'] = json_encode($spval['details']);
                unset($studentpackages[$spkey]['package_type']);
                unset($studentpackages[$spkey]['price_rate']);
            }
            
            $insert_studpackages = $this->Main->insertbatch("tbl_studentpackages", $studentpackages);
            $response = array(
                "success"   => true,
                "message"   => "Student Packages were saved successfully.\nContinue to billing.",
                "type"      => "success",
                "data"      => [
                    "result" => $insert_studpackages
                ],
            );
        }else{
            $response = array(
                "success"   => false,
                "message"   => "Insurance and Packages were not saved.",
                "type"      => "warning",
                "data"      => "",
            );
        }
        response_json($response);
    }

    public function enroll_getInvoiceDetails()
    {
        $data = jsondata();
        $student_id = $data["student_id"];
        $invoice_id = $data["invoice_id"];

        if(!empty($invoice_id)){
            $join = [
                "table" => "tbl_studentinvoice si",
                "key"   => "si.invoice_id=sm.invoice_id",
                "jointype" => "inner"
            ];
            $invoice_membership = $this->Main->getDataOneJoin("*","tbl_studentmembership sm",$join,["sm.invoice_id"=>$invoice_id],"","","","row");
            $join = [
                "table" => "tbl_packages p",
                "key"   => "p.package_id=sp.package_id",
                "jointype" => "inner"
            ];
            $invoice_packages = $this->Main->getDataOneJoin("*","tbl_studentpackages sp",$join,["sp.invoice_id"=>$invoice_id],"","","","");

            $response = array(
                "success"   => true,
                "data"      => [
                    "invoice_membership" => $invoice_membership,
                    "invoice_packages"   => $invoice_packages
                ],
            );
        }else{
            $response = array(
                "success"   => false,
                "data"      => "",
            );
        }
        response_json($response);
    }

    public function enroll_savePayment()
    {
        $data = jsondata();

        if(!empty($data)){
            $invoiceamount = $data['invoiceamount'];
            $paymentdetails = $data['paymentdetails'];
            $insertpayment = $this->Main->insert("tbl_paymentshistory", $paymentdetails, true);

            if($invoiceamount>$paymentdetails['amount']){
                $dataupdate['status'] = "partial";
            }else if($invoiceamount==$paymentdetails['amount']){
                $dataupdate['status'] = "paid";
            }else{ $dataupdate['status'] = "unpaid"; }
            $dataupdate["amount"] = $invoiceamount;
            $this->Main->update("tbl_studentinvoice",['invoice_id'=>$paymentdetails['invoice_id']],$dataupdate);

            $response = array(
                "success"   => true,
                "message"   => "Payment was saved successfully.\nRegistration complete",
                "data"      => [
                    "result"     => $insertpayment,
                ],
            );
        }else{
            $response = array(
                "success"   => false,
                "message"   => "Payment not saved.",
                "data"      => "",
            );
        }
        response_json($response);
    }
    //end of enrollment

}
