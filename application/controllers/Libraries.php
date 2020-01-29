<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Libraries extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model("Main");
        $this->load->model("Libraries_model", "libraries");
        date_default_timezone_set("Asia/Manila");
        checkLogin();
	}
	
	public function branches()
	{
        $data['title'] = "Libraries - Branches";
        $data['vueid'] = "libraries_page";
        $data['activenav'] = "libraries";
        $data['vfile'] = "page/libraries/branches";
        $data['js'] = array('pages/libraries.js');
        $this->load->view('layout/main', $data);
    }
	
	public function classes()
	{
        $data['title'] = "Libraries - Classes";
        $data['vueid'] = "libraries_page";
        $data['activenav'] = "libraries";
        $data['vfile'] = "page/libraries/classes";
        $data['js'] = array('pages/libraries.js');
        $this->load->view('layout/main', $data);
    }
	
	public function packages()
	{
        $data['title'] = "Libraries - Packages";
        $data['vueid'] = "packages_page";
        $data['activenav'] = "libraries";
        $data['vfile'] = "page/libraries/packages";
        $data['js'] = array('pages/libraries/packages.js');
        $this->load->view('layout/main', $data);
    }

    public function getPackageList()
    {
        $condition = jsondata();
        $packagelist = $this->libraries->getPackages("*","tbl_packages",$condition,"","");
        
        if(!empty($packagelist)){
            $response = array(
                "success"   => true,
                "data"      => [
                    "packagelist" => $packagelist
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

    public function saveNewPackage()
    {
        $data = jsondata();
        $datainsert = $data;
        $datainsert['packagedetails'] = json_encode($data['packagedetails']);

        if(!empty($datainsert)){
            $insertquery = $this->Main->insert("tbl_packages",$datainsert,true);
            if(!empty($insertquery)){
                $success = true;
                $type = "success";
                $message = "Package was added successfully.";
            }
        }else{
            $success = false;
            $type = "warning";
            $message = "Package was not added";
        }

        $response = array(
            'success'   => $success,
            'type'      => $type,
            'message'   => $message,
        );
        response_json($response);
    }

}