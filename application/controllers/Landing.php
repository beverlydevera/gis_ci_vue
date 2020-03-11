<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Landing extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model("Main");
        $this->load->library("Bcrypt");
        date_default_timezone_set("Asia/Manila");
	}
	
	public function index()
	{
        $data['title'] = "Bravehearts";
        // $data['js'] = array('pages/landing/index.js');
        $this->load->view('page/landing/index',$data);
    }

    public function gallery()
	{
        $data['title'] = "Bravehearts | Gallery";
        // $data['js'] = array('pages/landing/gallery.js');
        $this->load->view('page/landing/gallery',$data);
    }
    
    public function preregister()
	{
        $data['title'] = "Bravehearts | Pre-Register";
        $data['vueid'] = "preregister_page";
        $data['js'] = array('pages/landing/preregister.js');
        $this->load->view('page/landing/preregister',$data);
    }
    
    public function getBranches()
    {
        $type = $groupby = "";
        $orderby = [];

        $condition = jsondata();
        if(!empty($condition['branch_id'])){ $type="row"; }
        $orderby = [
            'column' => "branch_name",
            'order' => "ASC",
        ];
        $brancheslist = $this->Main->getDataOneJoin("*","tbl_branches","",$condition,"",$orderby,$groupby,$type);
        
        if(!empty($brancheslist)){
            $response = array(
                "success"   => true,
                "data"      => [
                    "brancheslist" => $brancheslist
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
}
